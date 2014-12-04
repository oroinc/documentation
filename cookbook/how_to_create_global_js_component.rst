How to create global js component
=================================

Global component or global view is an instance that lives aside of content
area and is not re-created during navigation between pages. Good example of
global component is Pin Bar.

.. image:: /cookbook/img/how_to_create_global_js_component/global-component-of-pin-bar.png
  :width: 800

.. note::

    What is the global component or global view in details, and what is App
    Module you can find here: :doc:`/book/frontend_architecture` and `Page Component`_.


Create Page Component module
----------------------------
First that you need to do is to define Page Component module in your Bundle

.. code-block:: javascript

    // src/Acme/UIBundle/Resources/public/js/app/components/my-component.js

    define(function (require) {
        'use strict';

        var MyComponent,
            BaseComponent = require('oroui/js/app/components/base/component');

        MyComponent = BaseComponent.extend({
            initialize: function (options) {
                console.log('MyComponent is initialized', options);
            }
        });

        return MyComponent;
    });

Inside the component implement all desired functionality.

The component takes role of controller, it is responsible for:
 * creates needed views, collections, models or even sub-components
 * handles environment events
 * disposes obsolete internal instances

Create App Module
-----------------

To instantiate your component at the moment of application start you need to create App Module.

.. code-block:: javascript

    // src/Acme/UIBundle/Resources/public/js/app/modules/my-module.js

    require([
        'oroui/js/app/controllers/base/controller'
    ], function (BaseController) {
        'use strict';

        BaseController.loadBeforeAction([
            'acmeui/js/app/components/my-component'
        ], function (MyComponent) {
            /* add composition to reuse between controller actions */
            BaseController.addToReuse('myComponent', MyComponent, {
                /* define options for your component here, like: */
                keepServerConnection: true
            });
        });
    });

Here we have defined that before an action controller have to load module of
our component and reuse its composition between actions. To define a composition
we have passed three arguments:

 - name of composition
 - constructor
 - and its options

.. note::

    See about compositions in documentation of `Chaplin.Composer`_.

Declare App Module
------------------

And last thing is to add your App Module to the list of ``appmodules`` in requirejs config.

.. code-block:: yaml

    # src/Acme/UIBundle/Resources/config/requirejs.yml

    config:
        paths:
            'acmeui/js/app/modules/my-module': 'bundles/acmeui/js/app/modules/my-module.js'
        appmodules:
            - acmeui/js/app/modules/my-module


First, we've added the module name to ``config.paths`` section. To make the
module get into js-build (oro.min.js), otherwise building script won't be able
to trace this dependency. And after we've added the module to ``config.appmodules``
list. And now the application will invoke this module on its start.

To see your component in action, you need to do few more things:

 - clear Symfony application cache ``php app/console cache:clear``. To update the cache and requirejs config in it.
 - reinstall assets ``php app/console assets:install``, if your assets are not installed as symlink's.
 - rebuild js ``php app/console oro:requirejs:build``, if you are in production mode.

.. _`Page Component`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
