.. _bundle-docs-platform-ui-bundle-mediator-handlers:

Mediator Handlers
=================

OroUIBundle declares some mediator handlers. It's preferable to use indirect method execution with `mediator.execute()` in all components which follows Chaplin architecture. 

Application
-----------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`retrieveOption`", "Returns application's initialization option by its name"
   "`retrievePath`", "Removes root prefix from passed path and returns meaningful part of path"
   "`combineRouteUrl`", "Accepts path and query parts and combines url"
   "`combineFullUrl`","Accepts path and query parts and combines full url (with root prefix)"
   "`changeURL`", "Accepts route and options for `Backbone.history.navigate`, allows to change url without dispatching new route"

.. seealso::

    See |oroui/js/app/application| module for details.

Page Controller
---------------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`isInAction`", "Allows to detect if controller is in action (period of time between `'page:beforeChange'` and `'page:afterChange'` events)"
   "`redirectTo`", "Perform redirect to a new location, accepts two parameters: object with location information and navigation options"
   "`refreshPage`","Reloads current page, accepts navigation options"
   "`submitPage`", "Performs submit form action via save call for a model, accepts options object with packed in data"

.. seealso::

    See |oroui/js/app/controllers/page-controller| module for details

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

    See |oroui/js/messenger| module for details

Widgets (Widget Manager)
------------------------

.. csv-table::
   :header: "Handler Name", "Method", "Description"
   :widths: 20, 20, 20

   "`widgets:getByIdAsync`", "`widgetManager.getWidgetInstance`", "Asynchronously fetches widget instance by widget id"
   "`widgets:getByAliasAsync`", "`widgetManager.getWidgetInstanceByAlias`", "Asynchronously fetches widget instance its alias"

.. seealso::

    See |oroui/js/widget-manager| module for details

PageLoadingMaskView
-------------------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`showLoading`", "Shows loading mask"
   "`hideLoading`", "Hides loading mask"

Layout
------

.. csv-table::
   :header: "Handler Name","Description"
   :widths: 20, 20

   "`layout:init`", "Initializes proper widgets and plugins in the container"
   "`layout:dispose`", "Removes some plugins and widgets from child elements of the container"

.. include:: /include/include-links-dev.rst
   :start-after: begin