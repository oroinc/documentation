.. _dev-doc-frontend-javascript:


JavaScript Architecture
=======================

Introduction
------------

Client-side architecture of OroPlatform, OroCRM, and OroCommerce is built on |Chaplin|
(an architecture for JavaScript Web applications based on the |Backbone.js|
library).

The Backbone provides little structure above simple routing, individual models,
views and their binding. Chaplin addresses these limitations by providing
a light-weight but flexible structure which leverages well-proven design
patterns and best practices.

However, as we distribute functionality of some pages over multiple bundles
(several bundles can extend a page with own functionalities), we had to extend the
|Chaplin| approach for our needs.

Technology Stack
----------------

Libraries used by OroPlatform on the client side:

 * RequireJS
 * jQuery + jQuery-UI
 * Bootstrap
 * Backbone + underscore
 * Chaplin

It is not the whole list, but only the main items that make the skeleton
of the client.

Most of these libraries are placed in OroUIBundle (as the bundle which is
responsible for the user interface). Each of these libraries is defined
as a module in RequireJS config with short module_id, so there is no need
to use the full path every time (e.g., the module_id is ``jquery`` instead
of ``oroui/lib/jquery``).

Naming Conventions
------------------

File structures and naming conventions use best practices of Backbone
development adopted for Oro needs.

.. code-block:: text
    :linenos:

    AcmeBundle/Resources/public
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
    │   ├── app // code that fully supports Chaplin architecture
    │   │   ├── components
    │   │   │   ├── view-component.js
    │   │   │   └── widget-component.js
    │   │   ├── controllers // Chaplin controllers
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
    └── lib // for the third party libraries
        ├── jquery
        │   └── jquery.min.js
        ├── backbone
        │   └── backbone.min.js
        └── underscore
            └── underscore.min.js

.. topic:: Summary

   * Modules that fully support Chaplin architecture are placed in the ``app`` folder.
   * There are five folders inside the "app" directory, one for each module with the following roles:
       * ``components`` -- page components, described in the :ref:`Page Component <frontend-architecture-page-component>` section
       * ``controllers`` -- Chaplin controllers. Currently, ``PageController`` is the only controller in the application
       * ``models`` -- a folder for Chaplin (Backbone) models and collections; modules inside the folder may be grouped by their functionality
       * ``modules`` -- app modules, described in the :ref:`App Modules <frontend-architecture-app-module>` section
       * ``views`` -- a common folder for Chaplin views and collection views; the files inside the folder are grouped by their functionality

   * each file name ends with a suffix that corresponds to its type (e.g., ``-view.js``, ``-model.js``, ``-component.js``)
   * names of all the files and folders can contain only lowercase alphabetic symbols with the minus (``-``) symbol as a word separator
   * outside the ``app`` folder, there is a utility code or other kinds of architectural solutions (e.g., jQuery-UI widgets)

Application Lifecycle
---------------------

Chaplin extends Backbone concept introducing missing parts (such as a controller)
and providing a solid lifecycle for the application components:

.. image:: /img/frontend/frontend_architecture/chaplin-lifecycle.png
   :target: http://docs.chaplinjs.org/


As a result, a controller and all of its models and views exist only between the
navigation actions. Once the route is changed, the active controller gets disposed,
as well as all of its nested views and related models. A new controller is created
for the current route, and new views and models are created in the new
active controller. This approach of the limited lifecycle of application components
solves memory leak issues. The rest of the components, such as the ``application`` itself,
``router``, ``dispatcher``, ``layout``, and ``composer`` (see the picture above)
exist all through the navigation.

To meet our needs, we had to extend this solution. In OroPlatform, a page
content is defined by one bundle and might be extended by many other
bundles. This way, there is no place where a client-side controller
can be defined. As a solution, we have a common controller for all pages
(:ref:`PageController <frontend-architecture-page-controller>`)
that handles route changes and numerous small controllers (:ref:`PageComponent <frontend-architecture-page-component>`)
defined in the HTML and dedicated to certain feature implementation.

.. _frontend-architecture-js-templates:

JS Templates (Underscore.js)
----------------------------

For Front-rendered templates, Oro applications use Underscore.js templates. JS templates belong to specific JS components defined as RequireJS modules and can be overridden the same way as any other RequireJS modules.

Fore more details see:
    - |Underscore.js template function documentation|
    - :ref:`JavaScript Modularity of OroPlatform based applications<dev-doc-frontend-javascript-modularity>`
    - :ref:`Overriding RequireJS modules<dev-doc-frontend-overriding-requirejs-modules>`


.. _frontend-architecture-page-layout-view:

Page Layout View
----------------

|Chaplin| introduces |Chaplin.Layout|, which is the top-level application view.
The view is initialized for the ``body`` element and is kept in memory, even when the active
controller is changed. We have extended this approach and created ``PageLayoutView``.
In addition to handling clicks on the application-internal links, it collects
form data and prepares navigation options for the AJAX POST request.
It also implements the ``ComponentContainer`` interface and initializes the top-level
:ref:`Page Component <frontend-architecture-page-component>` defined in the page's HTML.
This enables to create the so-called global views. These views are kept in the memory,
as well as ``PageLayoutView``, when the active controller is changed.

.. _frontend-architecture-page-controller:

Page Controller
---------------

The route module contains the only route mask that always leads to the PageController::index action point.

.. code-block:: javascript
    :linenos:

    define(function () {
        'use strict';
        return [
            ['*pathname', 'page#index']
        ];
    });

This way, the disposed and created controllers for each navigation action are
instances of the same constructor, which exists in different life cycles of the application.

This ``PageController`` loads the page content over ``PageModel`` and sends a
series of system events to notify the environment that the page content has changed.

.. note::

    The page update flow contains the following system events:
     * page:beforeChange
     * page:request
     * page:update
     * page:afterChange

.. image:: /img/frontend/frontend_architecture/page-controller.png

These events are handled by global views (views and components that exist throughout
the navigation and are not deleted by the page change. See
:ref:`Page Layout View <frontend-architecture-page-layout-view>` for more information).
One of them is ``PageContentView`` that listens to ``page:update`` and updates
page content area with HTML from ``PageModel``.

.. _frontend-architecture-page-component:

Page Component
--------------

As the functionality of a page depends on its content, and this content is generated by multiple
bundles, we cannot use a single controller to be responsible for it. We have introduced
an alternative approach that enables to use multiple controllers, each of which
is responsible for certain functionality and is related to a certain part of the HTML.

Such controllers are called a Page Component. Functionally, a "Page Component"
is similar to the "Controller" component in Chaplin, however, it implements a different
flow:

 * The "Controller" represents one screen of the application and is created when the page URL is changed
 * The "Page Component" represents a part of the page with certain functionality and is created in the course of page processing, subject to the settings declared in the HTML.

Define a Page Component
^^^^^^^^^^^^^^^^^^^^^^^

To define ``PageComponent`` for a block, specify the following two
data-attributes in the HTML node:

 * ``data-page-component-module`` --- the name of the module
 * ``data-page-component-options`` --- a safe JSON-string

.. code-block:: html+jinja
    :linenos:

    {% set options  = {
        metadata: metaData,
        data: data
    } %}
    <div data-page-component-module="mybundle/js/app/components/grid-component"
         data-page-component-options="{{ options|json_encode }}"></div>

How It Works
^^^^^^^^^^^^

The ``PageController`` loads a page and, thus, triggers the ``page:update`` event.
Global views (see :ref:`Page Layout View <frontend-architecture-page-layout-view>`)
handle the event and update its HTML content. After that, views invoke the ``initLayout``
method. It performs a series of actions to its element. One of the actions is
``initPageComponents``. This method performs the following:

 * collects all the elements with proper data-attributes
 * loads defined modules of PageComponents
 * executes the init method with the received options to initialize the PageComponents
 * resolves the initialization promise with the array of components after all components initialization

The ``PageController`` collects all promises from ``page:update`` event handlers,
and once all of them are resolved, it triggers the ``page:afterChange`` event.

.. seealso::

    For more details, see the |Page Component| documentation.

.. _frontend-architecture-app-module:

App Module
----------

App Modules are atomic parts of the general application, and they are responsible for the following:

 * register handlers in ``mediator`` (see |Chaplin.mediator| )
 * subscribe to the `mediator` events
 * perform all the preliminary actions before an instance of the application is created

App modules export nothing. They are the callback functions executed before launching the application.
They make the whole application modular and the functionality distributed among the bundles ready to work.

App Modules are declared in the ``requirejs.yml`` configuration file in the custom ``appmodules`` section:

.. code-block:: yaml
    :linenos:

    config:
        appmodules:
            - oroui/js/app/modules/messenger-module

This way, you can define the code to be executed at the application start for every bundle.

An example of using App Modules is provided in the section below.

Example
^^^^^^^

``oroui/js/app/modules/messenger-module`` declares handlers of the messenger in ``mediator``.

.. code-block:: javascript
    :linenos:

    define(function(require) {
        'use strict';

        var mediator = require('oroui/js/mediator');
        var messenger = require('oroui/js/messenger');

        /**
         * Init messenger's handlers
         */
        mediator.setHandler('showMessage',
            messenger.notificationMessage, messenger);
        mediator.setHandler('showFlashMessage',
            messenger.notificationFlashMessage, messenger);
        /* ... */
    });

This way, we guarantee that all the necessary handlers are declared before
they are used. The handlers can be executed by any component or view
in the Chaplin lifecycle.

.. code-block:: javascript
    :linenos:

    mediator.execute('showMessage', 'success', 'Record is saved');

.. seealso::

    For more details, see |Chaplin documentation| and |Client Side Architecture|.

Related Topics
--------------

.. toctree::
    :titlesonly:
    :maxdepth: 1

    javascript-modularity
    how-to-replace-inline-javascript-with-component




.. include:: /include/include-links-dev.rst
   :start-after: begin
