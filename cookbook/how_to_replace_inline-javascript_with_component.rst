How to Replace Inline-Javascript with a Component
=================================================

Page Component is a controller used not for a whole page of an application,
but for its part with a certain functionality. A Page Component is responsible for the following:

 * creating related views, collections, models and even sub-components
 * handling environment events
 * disposing obsolete instances

.. note::

    You can find more information on the Page Component in: :doc:`/book/frontend_architecture` and
    `Page Component`_.


Common Problems
---------------

Commonly, inline-javascript is used to bind some interactive functionalities
into a particular markup fragment.

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

The inline-script is often much bigger than in the example above and may have 
some twig-code inside. This kind of code is impossible to reuse, to extend or to test,
and hard to maintain.

Beside the problems listed above, there is a much bigger 
issue:
Lifecycle of its instances is not defined and it is not specified how they will be disposed, when 
the control is not in used anymore. We have to rely on jQuery to clean the memory. And most 
of the time, jQuery does it fine. However, there's no 100% guarantee that jQuery can always 
handle this successfully without our help. Memory leak issue is critical for
Web Applications.

Create Page Component Module
----------------------------
As a solution, we can create a component that defines lifecycle for Select2 instance.

.. code-block:: javascript

    // src/Acme/UIBundle/Resources/public/js/app/components/select2-component.js

    define(function (require) {
        'use strict';

        var Select2Component,
            BaseComponent = require('oroui/js/app/components/base/component');
        require('jquery.select2');

        Select2Component = BaseComponent.extend({
            /**
             * Initializes Select2 component
             *
             * @param {Object} options
             */
            initialize: function (options) {
                // _sourceElement refers to the HTMLElement
                // that contains the component declaration
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


Now we have the code that can be tested, extended and reused. What is even
more important, the component has ``initialize`` and ``dispose`` methods that 
restrict existence of the select2 instance, and thus define its lifesycle and
minimize the risk of a memory leak.

Declare Page Component in HTML
------------------------------

At the next step, we have to declare the component related to the HTMLElement:

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

To do so, we have defined the two attributes:

 * ``data-page-component-module`` -- name of the module
 * ``data-page-component-options`` -- safe JSON-string with configuration options

Once this HTML gets into the document, PageController will execute ``layout:init``
handler and the component will be initialized.

Use View Component
------------------

The problem looks solved. But there's still one thing that we can improve.
In our component (that performs the role of a controller) we work with a DOM-element
(jQuery objects) directly. It's better to move such activities to a View instance.

Let's create a Select2View.

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
             * Renders a select2 view
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
                    // the view is already removed
                    return;
                }
                this.$el.select2('destroy');
                Select2View.__super__.dispose.call(this);
            }
        });

        return Select2View;
    });

It's pretty similar to the component that we've created before but the view is
a much more suitable place for it.

However, we still need the component to instantiate our ``Select2View``. For this
purpose already have the ``ViewComponent`` that we have created to instantiate a view for the
HTMLElement.

To specify what view we want to instantiate for the HTMLElement, add the module name of view 
to the init-options of the controller ``'acmeui/js/app/views/select2-view'`` and declare
``'oroui/js/app/components/view-component'`` as a page-component-module for the HTMLElement.

.. code-block:: html+jinja

 {% set options = {
    view: 'acmeui/js/app/views/select2-view',
    placeholder: 'Select one ...',
    allowClear: true
 } %}

 {# assign the component module name and initialization options to the HTML #}
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
         * Creates a view instance from the module defined with the 'view' 
         * option and binds it with the _sourceElement
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
from options and instantiates the View instance. This View instance is attached to the
component instance. Once the component gets disposed, it automatically invokes
dispose methods of all the attached instances (if such a method is defined for them).

Please note that as we instantiate the view in the module load callback,
we deal with asynchronous process. Therefore, the component is not ready for use right after
the initialization method has finished its work. We need to inform the super controller that
this is async initialization. To do so, we first call ``this._deferredInit()``
that creates promise object, and once the initialization is over, we invoke
``this._resolveDeferredInit()`` that resolves this promise. This way the
super controller gets informed that the component is initialized.

Configure RequireJS
-------------------

And at the end we need to update the RequireJS configuration.

.. code-block:: yaml

    # src/Acme/UIBundle/Resources/config/requirejs.yml

    config:
        paths:
            'acmeui/js/app/views/select2-view': 'bundles/acmeui/js/app/views/select2-view.js'
            # or
            'acmeui/js/app/components/select2-component': 'bundles/acmeui/js/app/components/select2-component.js'

Whether you have created your own component or a view (that is instantiated by the
ViewComponent), you have to add the module name into RequireJS configuration, so it 
can trace this module and include it into the build file.

.. note::

    To see your component in action, you need to do several more things:

     - Clear Symfony application cache ``php app/console cache:clear`` to update the cache and the RequireJS config in it.
     - Reinstall assets ``php app/console assets:install`` if your assets are not installed as symlink's.
     - Rebuild js ``php app/console oro:requirejs:build`` if you are in the production mode.

.. _`Page Component`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
