Frontend Architecture
=====================

Intro
-----
Client Side Architecture of the Oro Platform is built over `Chaplin`_
(an architecture for JavaScript web applications based on the `Backbone.js`_
library).

Backbone provides little structure above simple routing, individual models,
views and their binding. Chaplin addresses these limitations by providing
a light-weight but flexible structure which leverages well-proven design
patterns and best practises.

But, due to we have pages with distributed by bundles functionality
(several bundles can extend a page with own functionality). We had to extend
a bit `Chaplin`_'s approach for our needs.

Technology stack
----------------
The libraries that the Oro Platform use on a client side:
 * RequireJS
 * jQuery + jQuery-UI
 * Bootstrap
 * Backbone + underscore
 * Chaplin

This is not whole list, it's just items which makes a skeleton of client
architecture.

Most of this libraries are placed in OroUIBundle (as the bundle which is
responsible for user interface). And each of them defined as module in RequireJS
config with short module_id. So, there's not need to use whole path each time
(e.g. module_id is ``jquery`` instead of ``oroui/lib/jquery``).

Naming convention
-----------------
For files structure and naming convention was taken practise from Backbone's
world and adopted with a bit extend.

.. code-block:: txt

    ├── css
    │   └── style.css
    ├── templates // frontend templates
    │   ├── projects
    │   │   ├── project-item.html
    │   │   └── projects-list.html
    │   └── users
    │       ├── user-item.html
    │       └── users-list.html
    ├── js
    │   ├── app // code which fully supports Chaplin architecture
    │   │   ├── components
    │   │   │   ├── view-component.js
    │   │   │   └── widget-component.js
    │   │   ├── controllers // Chaplin's controllers
    │   │   │   └── page-controller.js
    │   │   ├── models
    │   │   │   ├── projects
    │   │   │   │   ├── project-model.js
    │   │   │   │   └── projects-collection.js
    │   │   │   └── users
    │   │   │       ├── user-model.js
    │   │   │       └── users-collection.js
    │   │   ├── modules
    │   │   │   ├── layout-module.js
    │   │   │   └── views-module.js
    │   │   └── views
    │   │       ├── projects
    │   │       │   ├── project-item-view.js
    │   │       │   └── projects-view.js
    │   │       └── users
    │   │           ├── user-item-view.js
    │   │           └── users-view.js
    │   │ // utility code or other kind of architectural solutions
    │   ├── app.js
    │   ├── tools.js
    │   └── ...
    └── libs // place for third party libraries
        ├── jquery
        │   └── jquery.min.js
        ├── backbone
        │   └── backbone.min.js
        └── underscore
            └── underscore.min.js

.. note::

  Summery:
   * in ``app`` folder placed RequireJS modules which fully supports Chaplin architecture;
   * inside ``app`` folder code is grouped on five types:
       * ``components`` -- Page Components, purpose for this type see below;
       * ``controllers`` -- Chaplin's controllers, for now there's only one ``PageController`` in application;
       * ``models`` -- common folder for Chaplin's (Backbone's) models and collections, inside may be grouped by functionality;
       * ``modules`` -- App Modules, purpose for this type see below;
       * ``views`` -- common folder for Chaplin's views and collection-views, inside this folder files are grouped by functionality;
   * each file name has its prefix which corresponds to its type (e.g. ``-view.js``, ``-model.js``, ``-component.js``);
   * all files and folders are named in lowercase with minus (``-``) symbol as word separator;
   * outside ``app`` folder lays utility code or other kind of architectural solutions (e.g. jQuery-UI widgets).

Application Workflow
--------------------

Chaplin extends Backbone concept introducing missing parts (such as controller)
and providing solid lifecycle for application's components:

.. image:: /book/img/frontend_architecture/chaplin-lifecycle.png
   :target: http://docs.chaplinjs.org/
   :width: 800

As result a controller and all its models and views live only between
navigation actions. Ones route is changed, active controller gets disposed
and all its nested views and related models as well. New controller is created
for current route, in active controller its own views and models are created.
This approach, where lifecycle is defined for application components, solves
problems with memory leaks. Rest components, such as ``application`` itself,
``router``, ``dispatcher``, ``layout`` and ``composer`` (see picture above)
lives across navigation.

To cover our needs we had to extend this solution. In the Oro Platform a page
content is defined with an one bundle and might be extended with many others
bundles. So there's no single place where client side controller can be defined.
As a solutions, we have only one ``PageController`` which corresponds to every
url.

.. code-block:: javascript

    // in the routes module only one route mask
    // which leads to PageController::index action point
    define(function () {
        'use strict';
        return [
            ['*pathname', 'page#index']
        ];
    });

Thus, on each navigation action, the disposed and created controllers are
instances of same constructor, which exist in different lifecycles of the application.
This ``PageController`` loads page content over ``PageModel`` and notifies
environment with series of system events that the page content is changed.

.. note::

    Chain of system events of page update flow:
     * page:beforeChange
     * page:request
     * page:update
     * page:afterChange

.. image:: https://raw.githubusercontent.com/orocrm/platform/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-controller.png
  :width: 800

These events are handled by global views (which lives across navigation actions).
``PageContentView`` one of them, this view listens ``page:update`` and updates
page content area with HTML from ``PageModel``.

After that (between ``page:update`` and ``page:afterChange`` events), the active
controller executes handler ``'layout:init'``. Which does number of things and
one of them is initialization declared in HTML PageComponents.

Page Component
--------------
Due to page functionality depends on its content, which is generated by number
of bundles, we don't have single controller responsible for this page. We had to
introduce approach which allows us to have number of controllers responsible for
certain functionality and related to certain part of HTML. Since the role of
Controller already exists in Chaplin, controller which is related to part of a page
is named Page Component.

Page Component is an invisible component that takes responsibility of
the controller for certain functionality. It accepts options object,
performs initialization actions, and, at appropriate time, destroys initialized
elements (views, models, collections, or even sub-components).

Definition
~~~~~~~~~~
To define ``PageComponent`` for a block you need to define two data-attributes for
the HTML node:

 * ``data-page-component-module`` with the name of the module
 * ``data-page-component-options`` and with safe JSON-string

.. code-block:: html+jinja

    {% set options  = {
        metadata: metaData,
        data: data
    } %}
    <div data-page-component-module="mybundle/js/app/components/grid-component"
         data-page-component-options="{{ options|json_encode }}"></div>

How it works
~~~~~~~~~~~~

``PageController`` loads a page, triggering ``'page:update'`` event. Once all
global views have updated their content, ``PageController`` executes
``'layout:init'`` handler. This handler performs series of actions for the container
it has received (``document.body`` in this case), one of such actions is
``initPageComponents``. This method:

 * collects all elements with proper data-attributes.
 * loads defined modules of PageComponents.
 * initializes PageComponents, executing init method with passed-in options.
 * once all components are initialized, resolves initialization promise with passed array of components.

``PageController`` handles this promise and attaches all received components to itself in order to dispose them once controller got disposed.

.. seealso::

    For more details see `Page Component`_ documentation.

App Module
----------
App Modules are atomic parts of general application, responsible for:

* defining global view (which live beside active controller);
* register handlers in ``mediator`` (see `Chaplin.mediator`_);
* and do all actions which precede creating an instance of application.

App Modules are not actually modules in terms of RequireJS, they export
nothing. It's ``requirejs()`` call, which is executed right before the
application is started. It's called App Module because it makes whole
application modular. These modules are loaded right before Application
instantiated and guarantee that whole functionality spread by bundles
are ready to work.

App Modules are declared in ``requirejs.yml`` configuration file,
in custom section ``appmodules``:

.. code-block:: yaml

    config:
        appmodules:
            - oroui/js/app/modules/views-module
            - oroui/js/app/modules/messenger-module

This approach allows to define in each bundle code which should
be executed on the application start.

Let's go through couple examples.

Example 1
~~~~~~~~~

``oroui/js/app/modules/views-module`` -- declares global views which
will be instantiated right before an action point of controller gains control.

.. code-block:: javascript

    require([
        'oroui/js/app/controllers/base/controller'
    ], function (BaseController) {
        'use strict';
        /* ... */

        /**
         * Init PageContentView
         */
        BaseController.loadBeforeAction([
            'oroui/js/app/views/page/content-view'
        ], function (PageContentView) {
            BaseController.addToReuse('content', PageContentView, {
                el: 'mainContainer'
            });
        });
        /* ... */
    });

``BaseController`` has two static methods which allow to define what should
be done before application starts:
 * ``BaseController.loadBeforeAction`` -- loads required modules before next action (or before first action, in case it's in ``appmodule``)
 * ``BaseController.addToReuse`` -- it's wrapper over `Chaplin.Composer`_'s method ``reuse``. This static methods fills in internal array with arguments and applies them to ``reuse`` method, once  ``beforeAction`` method of active controller gets invoked.

Example 2
~~~~~~~~~

``oroui/js/app/modules/messenger-module`` -- declares ``messenger``'s handlers in mediator

.. code-block:: javascript

    require([
        'oroui/js/mediator',
        'oroui/js/app/controllers/base/controller'
    ], function (mediator, BaseController) {
        'use strict';

        /**
         * Init messenger's handlers
         */
        BaseController.loadBeforeAction([
            'oroui/js/messenger'
        ], function (messenger) {
            mediator.setHandler('addMessage', messenger.addMessage, messenger);
            mediator.setHandler('showMessage', messenger.notificationMessage, messenger);
            mediator.setHandler('showFlashMessage', messenger.notificationFlashMessage, messenger);
            mediator.setHandler('showErrorMessage', messenger.showErrorMessage, messenger);
        });
    });

This way we guarantee that handlers are declared before their use. Any
component or view which lives inside of Chaplin's lifecycle can execute these
handlers.

.. code-block:: javascript

    mediator.execute('showMessage', 'success', 'Record is saved');

.. seealso::

    For more details see `Chaplin documentation`_ and `Client Side Architecture`_.


.. _`Chaplin`: http://chaplinjs.org/
.. _`Chaplin documentation`: http://docs.chaplinjs.org/
.. _`Chaplin.mediator`: http://docs.chaplinjs.org/chaplin.mediator.html
.. _`Chaplin.Composer`: http://docs.chaplinjs.org/chaplin.composer.html
.. _`Backbone.js`: http://backbonejs.org/
.. _`Client Side Architecture`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/client-side-architecture.md
.. _`Page Component`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/page-component.md
