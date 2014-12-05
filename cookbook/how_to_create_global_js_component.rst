How to create global js component
=================================

Global component or global view is an instance that exists beyond the content
area and is not re-created in the course of navigation between the pages. Good example of
a global component is the Pin Bar.

.. image:: /cookbook/img/how_to_create_global_js_component/global-component-of-pin-bar.png
  :width: 800

.. note::

    You can find more information about global component and global view. and learn about the App
    Module here: :doc:`/book/frontend_architecture` and `Page Component`_.


Create Page Component Module
----------------------------
First of all, you need to define the Page Component module in your Bundle

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

You can implement all the desired functionality inside the component.

The component plays a role of the controller. It is responsible for the following:
 * create necessary views, collections, models and even sub-components
 * handle environment events
 * dispose obsolete internal instances

Create App Module
-----------------

To instantiate your component at the moment of application start, you need to create the App Module.

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

In the example above, we have defined that the controller shall load the module of 
our component before any/the first action, and shall re-use its composition between 
the actions. The following three arguments define the composition:

 - name of the composition
 - the constructor
 - settings of the constructor

.. note::

    You can find more information about  compositions in the `Chaplin.Composer`_ documentation.

Declare App Module
------------------

The final stepp is adding your App Module to the list of ``appmodules`` in the requirejs config.

.. code-block:: yaml

    # src/Acme/UIBundle/Resources/config/requirejs.yml

    config:
        paths:
            'acmeui/js/app/modules/my-module': 'bundles/acmeui/js/app/modules/my-module.js'
        appmodules:
            - acmeui/js/app/modules/my-module


First, we've added the module name to the ``config.paths`` section. Without it, the building
script couldn't trace the dependency and the model wouldn't be added to the (oro.min.js) js-build.
After that, we've added the module to the ``config.appmodules``list. 
Now the application will invoke this module aat the start.

To see your component in action, you need to do few more things:

 - Clear the Symfony application cache ``php app/console cache:clear`` to update the cache and requirejs config in it.
 - Reinstall assets ``php app/console assets:install`` if your assets are not installed as symlink's.
 - Rebuild js ``php app/console oro:requirejs:build`` if you are in production mode.

.. _`Page Component`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
