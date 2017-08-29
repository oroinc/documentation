How to Replace Inline-Javascript with a Component
=================================================

Embedding Functionality in a Page
---------------------------------

Commonly, inline JavaScript is used to bind some interactive functionality into the particular markup
fragment:

.. code-block:: html
    :linenos:

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

Inline scripts are often larger than in the example above and may also make use of inline Twig code.
It is impossible to reuse this code, extend it or test it. Additionally, it's hard to maintain it.

Furthermore, the lifecycle of its instances is not defined and it is not specified how the function
will be disabled when the control is not used anymore. Instead, one has to rely on jQuery to
properly clean the memory. Most of the time, jQuery does this fine. However, there's no
guarantee that jQuery would always handle this task successfully without developer's help.

The solution for the problems explained above is a Page Component.

A Page Component
----------------

A Page Component is a controller that is used to implement certain parts of the page functionality.
It is responsible for the following things:

 * creating related views, collections, models and even sub-components
 * handling environment events
 * disposing obsolete instances

.. seealso::

    You can find more information about Page Components in the
    :doc:`Frontend Architecture chapter </book/ui/frontend_architecture>` and in the
    `Page Component documentation`_.

Creating a Page Component
-------------------------

A Page Component is a JavaScript object based on the ``BaseComponent``. The inline JavaScript from
the introduction will be replaced by the new ``Select2Component``. Start with creating the ``select2-component.js``
file that lives in the ``Resources/public/js/app/components`` directory of your bundle.

.. code-block:: javascript
    :linenos:

    // src/Acme/DemoBundle/Resources/public/js/app/components/select2-component.js
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

This code can be tested, extended and reused. What's even more important is that the component
provides two methods ``initialize()`` and ``dispose()`` which restrict the existence of the
``select2`` instance. Thus, it defines its own lifesycle and therefore minimizes the risk of
memory leaks.

Declaring a Page Component in HTML
----------------------------------

Next, the HTML code of the related template has to be modified to tell the ``Layout`` which
HTML elements are related to the ``Select2Component`` component:

.. code-block:: html+jinja
    :linenos:

    {% set options = {
        placeholder: 'Select one ...',
        allowClear: true
    } %}

    {# assign the component module name and initialization options to HTML #}
    <select
        data-page-component-module="acmedemo/js/app/components/select2-component"
        data-page-component-options="{{ options|json_encode }}">
        <option value="foo">Foo</option>
        <option value="bar">Bar</option>
    </select>

The ``Layout`` uses two attributes to resolve the Component module associated with an HTML element
when ``layout:init`` is executed by the `PageController`_:

``data-page-component-module``
    The name of the module
``data-page-component-options``
    A JSON encoded string containing module configuration options

Once this HTML code is injected into the document, the ``PageController`` will execute the
``layout:init`` handler and the component will be initialized.

Using the View Component
------------------------

The code is now reusable. Though it can be improved by separating business logic from the view
layer. Therefore, replace the ``Select2Component`` with the ``Select2View`` class in the file named
``select2-view.js`` that lives in the ``Resources/public/js/app/views`` directory of your bundle
and that extends the ``BaseView`` class:

.. code-block:: javascript
    :linenos:

    // src/Acme/DemoBundle/Resources/public/js/app/views/select2-view.js
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

This looks pretty much like the initially created ``Select2Component`` except that you don't have
to deal with retrieving the associated HTML element and that you don't have to parse the options.
This is done for you by the ``ViewComponent``.

However, you still need to tell the component to instantiate your ``Select2View``. For this purpose
OroPlatform is shipped with the ``ViewComponent`` that instantiates views for HTML elements.
To make use of the ``ViewComponent``, replace the value of ``data-page-component-module`` attribute
with the ``oroui/js/app/components/view-component`` and use the ``view`` option to point to your new
``Select2View``:

.. code-block:: html+jinja
    :linenos:

    {% set options = {
        view: 'acmedemo/js/app/views/select2-view',
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

The ``ViewComponent`` loads the required module, fetches the ``view`` and the ``_sourceElement``
from the options and instantiates the View instance. This View instance is attached to the
component instance. Once the component gets disposed, it automatically invokes the ``dispose()``
methods of all attached instances (if the ``dispose()`` method was defined for the instance).

Please note that as we instantiate the view in the module load callback,
we deal with asynchronous process. Therefore, the component is not ready for use right after
the initialization method has finished its work. We need to inform the super controller that
this is async initialization. To do so, we first call ``this._deferredInit()``
that creates a promise object, and once the initialization is over, we invoke
``this._resolveDeferredInit()`` that resolves this promise. This way the
super controller gets informed that the component is initialized.

Configure RequireJS
-------------------

Finally, you need to make your new classes known to RequireJS:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requirejs.yml
    config:
        paths:
            # for the Select2View class
            'acmedemo/js/app/views/select2-view': 'bundles/acmeui/js/app/views/select2-view.js'
            # for the Select2Component class
            'acmedemo/js/app/components/select2-component': 'bundles/acmeui/js/app/components/select2-component.js'

Whether you have created your own component or a view (that is instantiated by the ViewComponent),
you'll have to add the module name into RequireJS configuration, so that it can trace this module
and include it into the build file.

.. note::

    To see your component in action, you need to do several more things:

    - Clear the Symfony application cache to update the cache and the included RequireJS config:

      .. code-block:: bash

        $ php app/console cache:clear

    - Reinstall your assets if you don't deploy them via symlinks:

      .. code-block:: bash

          $ php app/console oro:assets:install

    - In production mode, you also have to rebuild the JavaScript code:

      .. code-block:: bash

          $ php app/console oro:requirejs:build

.. _`Page Component documentation`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
.. _`PageController`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/public/js/app/controllers/page-controller.js
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
