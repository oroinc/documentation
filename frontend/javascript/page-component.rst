.. _dev-doc-frontend-page-component:

Page Component
==============

Page Component is an invisible component that takes responsibility of the controller for certain functionality. It accepts options object, performs initialization actions, and, at appropriate time, destroys initialized elements (views, models, collections, or even sub-components).

Definition
----------

To define PageComponent for a block define several data-attributes for the HTML node:

- `data-page-component-module` with the name of the module
- `data-page-component-options` with safe JSON-string
- `data-page-component-name` optional, allows to get access to the component by name

.. code-block:: twig


    {% set options  = {
        metadata: metaData,
        data: data
    } %}
    <div data-page-component-module="mybundle/js/app/components/grid-component"
         data-page-component-options="{{ options|json_encode }}"></div>


.. hint::
        See also :ref:`Component Shortcuts <dev-doc-frontend-component-shortcuts>`

How It Works
------------

`PageController` loads a page, triggering `'page:update'` event. Global views (`PageRegionView`) have updated their contents. And once it is done — each `PageRegionView` executes `initLayout` method for it's layout element (in common case it's the view element). Inside this method, the view excutes `'layout:init'` handler, that initializes system UI-controls (such as ScrollSpy, ToolTips, PopOvers and other), after that invokes `initPageComponents` method, that initializes components defined in HTML. This method:

- collects all elements with proper data-attributes.
- loads defined modules of PageComponents.
- initializes PageComponents, executing init method with passed-in options.
- returns promise object, allowing handle initialization process.

`PageController` handles promises from all global views and once they all resolved — triggers next event `'page:afterChange'`.

Development
-----------

There are two kinds of PageComponents:

- an extension of `BaseComponent`.
- just a function for trivial cases.

Extending BaseComponent
-----------------------

BaseComponent is a module |oroui/js/app/components/base/component| very similar to `Backbone.View`. The difference is that it is not visible and has no functionality to interact with DOM.

It has two static methods:

- `extend`, the same as other `Backbone` components have.
- `init`, that accepts options and creates an instance of the current component. If the component instance has no `defer` property (meaning tha component has been created synchronously) `init` method returns this component. If it has `defer` property, `init` method returns a promise object. Once the component get initialized, it should resolve `defer` with its instance.

An instance of BaseComponent has several methods:

- `initialize`, that accepts options and performs initialization;
- `dispose`, that besides removing all kind of event subscriptions like all `Chaplin` components do goes though `subComponents` property (that is an array), disposes all its sub-components, and then tries to call `dispose` method for all other properties;
- `delegateListeners`, implements support of listeners declaration over `listen` property (see |Chaplin.View documentation|)
- `delegateListener`, adds listener for a corresponded target: `'model'`, `'collection'`, `'mediator'` or itself (if no target passed);
- `_deferredInit`, create flag of deferred initialization
- `_resolveDeferredInit`, resolves deferred initialization and executes promise's handlers

.. code-block:: javascript


    MyComponent = BaseComponent.extend({
        initialize: function (options) {
            options = options || {};
            this.processOptions(options);
            if (!_.isEmpty(options.modules)) {
                // deferred init start, means myView will be initialized in async way
                this._deferredInit();
                // there are some modules we need to load before init view
                loadModules(options.modules, function (modules) {
                    _.extend(options.viewOptions, modules);
                    this.initView(options.viewOptions);
                    // resolves deferred initialization once view gets ready
                    self._resolveDeferredInit();
                }, this);
            } else {
                // initialize view immediately
                this.initView(options);
            }
        },
        processOptions: function (options) {
            /* manipulate options, merge them with defaults, etc. */
        },
        initView: function (options) {
            this.view = new MyView(options);
        }
    });

Function as a Component
-----------------------

For some trivial cases writing the entire component as extension from `BaseComponent` is redundant. This is definitely the case if you don't need to:

- dispose this component (the result is self-disposable), or
- extend the component for other cases.

In this case it's better to define a function that accepts options and performs the initialization:

.. code-block:: javascript


    define(['jquery', 'js/my-widget'], function ($) {
        return function (options) {
            $(options.el).myWidget(options.widgetOptions);
        };
    }

Initialize Components on DOM Events
-----------------------------------

You can postpone initialization for some components until a specific DOM event occurs to improve page performance.

You can do this for components that do not change the UI ( i.e., have no visual impact on a page), for example, when an initially hidden popup/dropdown has initialized.

For that purpose, the component's DOM-element or its container has to have an additional attribute ``data-page-component-init-on`` defined. A value is an event name or a comma-separated list of events.

The following three events are currently supported: ``"click"``, ``"focusin"`` and ``"mouseover"``.

.. code-block:: html

    <button data-page-component-init-on="click,focusin"
         data-page-component-module="mybundle/js/app/components/foo-component">Show more...</button>

Below is another example illustrating several components within the `init-on` container:

.. code-block:: html

    <form data-page-component-init-on="click,focusin">
        <label>
            Country <input name="country"
                           data-page-component-module="mybundle/js/app/components/country-suggest-component"/>
        </label>
        <div data-page-component-view="mybundle/js/app/views/company-addresses-view"></div>
    </form>

When the `init-on` container includes a view-component that renders HTML and has to be initialized immediately, define a specific value in the ``data-page-component-init-on="asap"`` attribute for the element responsible for that view-component. This way, the view-component will be initialized as soon as possible even though it is within the `init-on` container.

.. code-block:: html

    <form data-page-component-init-on="click,focusin">
        <label>
            Country <input name="country"
                           data-page-component-module="mybundle/js/app/components/country-suggest-component"/>
        </label>
        <div data-page-component-init-on="asap"
             data-page-component-view="mybundle/js/app/views/company-addresses-view"></div>
    </form>

In this example, ``company-addresses-view`` is initialized and rendered without a user's interaction with the interface.


.. include:: /include/include-links-dev.rst
   :start-after: begin