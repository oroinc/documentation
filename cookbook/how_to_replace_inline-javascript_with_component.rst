How to replace inline-javascript with a component
=================================================

Page Component is a controller that is related not for whole application page,
but for its part with certain functionality. It's responsible for:

 * creating related views, collections, models or even sub-components
 * handling environment events
 * disposing obsolete instances

.. note::

    More about Page Component: :doc:`/book/frontend_architecture` and
    `Page Component`_.


Common Problem
--------------

Commonly inline-javascript is used to bind some interactive functionality
into particular markup fragment.

.. code-block:: html

 <select id="my-select">
    <option value="foo">Foo</option>
    <option value="bar">Bar</option>
 </select>
 <script type="text/javascript">
     require(['jquery', 'jquery.select2'], function ($) {
        $('#my-select').select2({
            placeholder: 'Select one ...',
            allowClear: true
        });
     });
 </script>

Often inline-script is much bigger than this and may have twig-code inside. This
kind of code is impossible to reuse, to extend or to test, hard to maintain.

Beside problems above, there is much bigger issue. Lifecycle of this instance
is undefined. Who is going to take care of it, when the control is not in use
anymore. We just rely on jQuery on cleaning the memory. And most time jQuery
does it fine. But there's no 100% guarantee that jQuery handle this
successfully without our help. Memory leak issue is critical for the
Web Applications.

Create Page Component Module
----------------------------
As solution, we create the component. The component takes role of controller, it is responsible for:

 * creates needed views, collections, models or even sub-components
 * handles environment events
 * disposes obsolete internal instances

We implement select2 initialization in this component.

.. code-block:: javascript

    // src/Acme/UIBundle/Resources/public/js/app/components/select2-component.js

    define(function (require) {
        'use strict';

        var Select2Component,
            BaseComponent = require('oroui/js/app/components/base/component');
        require('jquery.select2');

        Select2Component = BaseComponent.extend({
            /**
             * Initializes Select2 Component
             *
             * @param {Object} options
             */
            initialize: function (options) {
                // _sourceElement refers to HTMLElement that has the component declaration
                this.$elem = options._sourceElement;
                delete options._sourceElement;
                this.$elem.select2(options);
                Select2Component.__super__.initialize.call(this, options);
            },

            /**
             * Disposes the component
             */
            dispose: function () {
                if (this.disposed) {
                    // component is already removed
                    return;
                }
                this.$elem.select2('destroy');
                delete this.$elem;
                Select2Component.__super__.dispose.call(this);
            }
        });

        return Select2Component;
    });


Now we have the code that can be tested, extended and reused. But most important,
it covers the lifecycle problem. The component has ``initialize`` and ``dispose``
methods that restrict  existence of the select2 instance.

Declare Page Component in HTML
------------------------------

For next step we have to declare what component is related to HTMLElement:

.. code-block:: html+jinja

 {% set options = {
    placeholder: 'Select one ...',
    allowClear: true
 } %}

 {# assign the component module name and initialization options to HTML #}
 <select
    data-page-component-module="acmeui/js/app/components/select2-component"
    data-page-component-options="{{ options|json_encode }}">
    <option value="foo">Foo</option>
    <option value="bar">Bar</option>
 </select>

To do so, we have defined two attributes:

 * ``data-page-component-module`` -- name of the module
 * ``data-page-component-options`` -- safe JSON-string with configuration options

Once this HTML gets into document, PageController will execute ``layout:init``
handler and the component will be initialized.

Use View Component
------------------

The problem looks solved. But there's still thing that we can do better.
In our component (that performs role of controller) we work with DOM-element
(jQuery objects) directly. It's better to move such activities to a View instance.

Let's create Select2View.

.. code-block:: javascript

    // src/Acme/UIBundle/Resources/public/js/app/views/select2-view.js

    define(function (require) {
        'use strict';

        var Select2View,
            BaseView = require('oroui/js/app/views/base/view');
        require('jquery.select2');

        Select2View = BaseView.extend({
            autoRender: true,

            /**
             * Renders select2 view
             */
            render: function () {
                this.$el.select2(this.options);
                return Select2View.__super__.render.call(this);
            },

            /**
             * Disposes the view
             */
            dispose: function () {
                if (this.disposed) {
                    // view is already removed
                    return;
                }
                this.$el.select2('destroy');
                Select2View.__super__.dispose.call(this);
            }
        });

        return Select2View;
    });

It's pretty close to the component that we've created before. And it is exact
place where it should be.

But we still need the component to instantiate our ``Select2View``. For this
purpose we can user existing component -- ``ViewComponent``. This component
was created to instantiate a view for the HTMLElement.

We have to specify what view we want to instantiate for the HTMLElement.
Add to component init-options the module name of view
``'acmeui/js/app/views/select2-view'`` and declare
``'oroui/js/app/components/view-component'`` as page-component-module
for the HTMLElement.

.. code-block:: html+jinja

 {% set options = {
    view: 'acmeui/js/app/views/select2-view',
    placeholder: 'Select one ...',
    allowClear: true
 } %}

 {# assign the component module name and initialization options to HTML #}
 <select
    data-page-component-module="oroui/js/app/components/view-component"
    data-page-component-options="{{ options|json_encode }}">
    <option value="foo">Foo</option>
    <option value="bar">Bar</option>
 </select>

Here is how the ``ViewComponent`` is implemented:

.. code-block:: javascript

    // 'oroui/js/app/components/view-component' module

    define(function (require) {
        'use strict';

        var ViewComponent,
            _ = require('underscore'),
            tools = require('oroui/js/tools'),
            BaseComponent = require('oroui/js/app/components/base/component');

        /**
         * Creates a view passed through 'view' option and binds it with _sourceElement
         */
        ViewComponent = BaseComponent.extend({
            /**
             * @constructor
             * @param {Object} options
             */
            initialize: function (options) {
                this._deferredInit();
                tools.loadModules(options.view, function (View) {
                    var viewOptions = _.extend(
                            _.omit(options, ['_sourceElement', 'view']),
                            { el: options._sourceElement }
                        );
                    this.view = new View(viewOptions);
                    this._resolveDeferredInit();
                }, this);
            }
        });

        return ViewComponent;
    });

The ``ViewComponent`` loads required module, fetches ``view`` and ``_sourceElement``
from options and instantiate the view. This view instance is attached to the
component instance. Once the component gets disposed it automatically invoke
dispose methods of all attached instances (if they have such).

Pay attention. Due to we instantiate the view in the module load callback,
we deal with asynchronous process. So, the component is not ready to use after
initialize method is finished its work. We need to inform the super controller that
this is async initialization. To do so, first we call ``this._deferredInit()``
that creates promise object, and once initialization is done we invoke
``this._resolveDeferredInit()`` that resolve this promise. This way, the
super controller gets informed that component is initialized.

Configure RequireJS
-------------------

And last thing we need to do is to update RequireJS configuration.

.. code-block:: yaml

    # src/Acme/UIBundle/Resources/config/requirejs.yml

    config:
        paths:
            'acmeui/js/app/views/select2-view': 'bundles/acmeui/js/app/views/select2-view.js'
            # or
            'acmeui/js/app/components/select2-component': 'bundles/acmeui/js/app/components/select2-component.js'

Either way, you've created your own component or a view (that is instantiated by
ViewComponent), you have to add the module name into RequireJS configuration.
Otherwise RequireJS is won't be able to trace this module and include into build file.

.. note::

    To see your component in action, you need to do few more things:

     - clear Symfony application cache ``php app/console cache:clear``. To update the cache and RequireJS config in it.
     - reinstall assets ``php app/console assets:install``, if your assets are not installed as symlink's.
     - rebuild js ``php app/console oro:requirejs:build``, if you are in production mode.

.. _`Page Component`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
