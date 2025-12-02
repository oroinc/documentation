.. _bundle-docs-platform-ui-bundle-mediator-handlers:

Mediator Handlers
=================

OroUIBundle provides a set of mediator handlers.
Following the Chaplin architecture, it is recommended to execute actions indirectly using `mediator.execute()` in all components.

Application
-----------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`retrieveOption`", "Returns an application's initialization option by its name"
   "`retrievePath`", "Removes the root prefix from a given path and returns the meaningful part"
   "`combineRouteUrl`", "Combines path and query parts to generate a URL"
   "`combineFullUrl`", "Combines path and query parts into a full URL including root prefix"
   "`changeURL`", "Changes the URL using `Backbone.history.navigate` with route and options, without dispatching a new route"

.. seealso::

    See the |oroui/js/app/application| module for details.

Page Controller
---------------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`isInAction`", "Detects whether the controller is currently in an action (between `'page:beforeChange'` and `'page:afterChange'` events)"
   "`redirectTo`", "Performs a redirect to a new location; accepts an object with location info and navigation options"
   "`refreshPage`", "Reloads the current page with optional navigation options"
   "`submitPage`", "Submits a form action via the model's save method; accepts an options object with data"

.. seealso::

    See the |oroui/js/app/controllers/page-controller| module for details.

Messenger
---------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`addMessage`", "`messenger.addMessage`"
   "`showMessage`", "`messenger.notificationMessage`"
   "`showFlashMessage`", "`messenger.notificationFlashMessage`"
   "`showErrorMessage`", "`messenger.showErrorMessage`"

.. seealso::

    See the |oroui/js/messenger| module for details.

Widgets (Widget Manager)
------------------------

.. csv-table::
   :header: "Handler Name", "Method", "Description"
   :widths: 20, 20, 20

   "`widgets:getByIdAsync`", "`widgetManager.getWidgetInstance`", "Asynchronously fetches a widget instance by its ID"
   "`widgets:getByAliasAsync`", "`widgetManager.getWidgetInstanceByAlias`", "Asynchronously fetches a widget instance by its alias"

.. seealso::

    See the |oroui/js/widget-manager| module for details.

PageLoadingMaskView
-------------------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`showLoading`", "Displays the loading mask"
   "`hideLoading`", "Hides the loading mask"

Layout
------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`layout:init`", "Initializes widgets and plugins inside the container"
   "`layout:dispose`", "Removes widgets and plugins from child elements of the container"

.. include:: /include/include-links-dev.rst
   :start-after: begin
