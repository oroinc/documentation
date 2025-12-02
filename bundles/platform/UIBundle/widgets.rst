.. _bundle-docs-platform-ui-bundle-widgets:

Widgets
=======

A **widget** is a UI element placed inside a widget container. Most widgets represent backend actions.

Examples of widgets include: contact information, opportunity information, address book, add address form, import form, workflow transitions, and more.

**Widget container** is a part of the UI where widgets are displayed. A widget container can host different types of widgets.

Examples of implemented BAP widget containers:

- Dialog windows
- Buttons
- Content blocks

Goals
-----

Widgets are designed to allow developers to reuse content across different containers on the frontend.

The content of a widget can be HTML (either a fragment of a page or an entire page) generated separately by a controller method.

The system can have various types of containers, such as dialog windows or content blocks. Widgets also provide additional functionality around their content, including:

- Remote content loading
- Widget action handling
- Embedded forms processing

The widget manager enables interaction between widgets and pages through Backbone events and direct use of the widgets API, supporting:

- Widget-to-widget interaction
- Widget-to-page interaction
- Page-to-widget interaction

Each widget on a page has a unique widget identifier.


JS Modules Services
^^^^^^^^^^^^^^^^^^^

- **oroui/js/widget-manager** - Widget manager
- **oro/block-widget** - Block widget
- **oro/buttons-widget** - Buttons widget
- **oro/dialog-widget** - Dialog widget
- **oroui/js/widget/abstract-widget** - Abstract widget, cannot be used standalone

Widgets
-------

A **widget** is any controller/action or static content rendered inside a widget container.

The `#[Template]` attribute supports the ``_widgetContainer`` request variable, which determines the template to use according to the following rules:

1. If a template exists for the specified container, it is selected using the pattern: ``<widgetContainer>/<action>.<format>.<templateEngine>``.
   Example: ``dialog/example.html.twig``

2. If no container-specific template is found, the default widget template is used: ``widget/<action>.<format>.<templateEngine>``.
   Example: ``widget/example.html.twig``

3. If no template is found at all, the default action template is rendered:
   Example: ``example.html.twig``

Widgets can be rendered in Twig using the function: ``oro_widget_render($options)``.

For proper integration with other page elements, the Twig template for a widget must have a root `div` element with the class ``widget-content``: ``<div class="widget-content">``

Frontend Widget Container
-------------------------

Responsibilities
^^^^^^^^^^^^^^^^

A **widget container** is responsible for displaying a widget and loading its data from the server.
Widget containers are implemented as Backbone views, which means you can leverage all standard Backbone view features, including events.

The widget content must be placed inside an element with the class **widget-content**. The container also handles AJAX requests for any included forms and provides functionality for different action areas. All form actions placed inside an element with the class **widget-actions** are moved to the **adopted actions** section automatically.

The container adds the following parameters to all requests:

* ``_widgetContainer`` – used to determine the proper template for the current container
* ``_wid`` – allows the widget to retrieve an instance of its container from the widget manager

Containers
^^^^^^^^^^

* **Dialog window** – displays widget content in a dialog window
* **Button** – displays the included content only, without a title or actions
* **Block** – embeds widget content directly on the page

API
^^^

abstract-widget.js options
~~~~~~~~~~~~~~~~~~~~~~~~~~

- **type** - widget type name
- **el** - widget element selector (inherit from Backbone.View options)
- **actionsEl** - selector or element from which widget actions will be adopted
- **url** - URL used to load remote content
- **elementFirst** - flag, if set and both element and url are given then on first load element content will be used to render widget without AJAX request
- **title** - widget title
- **alias** - widget alias
- **wid** - unique widget identifier
- **loadingMaskEnabled** - flag, indicated enabled state of loading mask
- **loadingElement** - element, hidden under loading mask. By default el is used. To hide the whole page, use the 'body' selector.

abstract-widget.js events
~~~~~~~~~~~~~~~~~~~~~~~~~

Widget container events:

 - **widgetRemove** - triggered when widget is removed
 - **adoptedFormSubmitClick** - triggered when adopted form submit button is clicked
 - **adoptedFormResetClick** - triggered when adopted form reset button is clicked
 - **adoptedFormSubmit** - triggered when adopted form is submitted
 - **reset** - triggered when adopted form is reset
 - **beforeContentLoad** - triggered before content loading started
 - **contentLoad** - triggered on content load
 - **contentLoadError** - triggered in case of content loading error
 - **widget:add:action:section:action_key** - triggered when action is added, triggered when action is added,
   section is action section name passed to addAction method,
   section is action section name passed to addAction method,
   action_key is action name passed to addAction method
 - **renderStart** - triggered before widget rendering
 - **widgetRender** - triggered on widget rendering
 - **renderComplete** - triggered on widget rendering complete

Global events triggered on mediator:

 - **widget_remove** - triggered on mediator when widget is removed
 - **widget_initialize** - triggered on mediator when widget is created
 - **widget:render:wid** - triggered on widget render, wid is widget identifier string

abstract-widget.js Methods
^^^^^^^^^^^^^^^^^^^^^^^^^^

addAction(key, section, actionElement)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Add action element to specified section

Parameters:

.. csv-table::
   :header: "Name","Type", "Description"
   :widths: 20, 20, 20

   "key","string","action name"
   "section","string ","section name"
   "actionElement","HTMLElement","-"

getAction(key, section, callback)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get action element when after render.

Parameters:

.. csv-table::
   :header: "Name", "Type", "Description"
   :widths: 20, 20, 20

   "key","string","action name"
   "section","string ","section name"
   "callback","function","callback method for processing action element"

getActions() → {Object}
~~~~~~~~~~~~~~~~~~~~~~~

Get all registered actions

Returns: Type: Object

getActionsElement()
~~~~~~~~~~~~~~~~~~~

Get actions container element

getAlias() → {string|null}
~~~~~~~~~~~~~~~~~~~~~~~~~~

Get widget alias

Returns: Type: string or null

getWid() → {string}
~~~~~~~~~~~~~~~~~~~

Get unique widget identifier

Returns: Type: string

hasAction(key, section) → {boolean}
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Check action availability.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "key","string","action name"
   "section","string ","section name"

Returns: Type: boolean

initializeWidget()
~~~~~~~~~~~~~~~~~~

Initialize

loadContent(data, method)
~~~~~~~~~~~~~~~~~~~~~~~~~
Load content

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "data","Object or null","-"
   "method", "String or null","-"

remove()
~~~~~~~~

Remove widget

removeAction(key, section)
~~~~~~~~~~~~~~~~~~~~~~~~~~

Remove action from section

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "key","string","action name"
   "section","string ","section name"

render()
~~~~~~~~

Render widget

setTitle(title)
~~~~~~~~~~~~~~~

Set widget title.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "title","string","-"

setUrl(url)
~~~~~~~~~~~

Set url

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "url","string","-"

setWidToElement(el)
~~~~~~~~~~~~~~~~~~~

Add data-wid attribute to the given element.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "el","HTMLElement","-"

show()
~~~~~~

General implementation of show logic.

**block-widget.js options**

- titleContainer - selector for title container inside template
- contentContainer - selector for content container inside template
- contentClasses - additional CSS classes added to content element
- template - widget underscore template

**dialog-widget.js options**

- dialogOptions - Extended ui.dialog options
- stateEnabled - flag, enables window state saving, enabled by default
- incrementalPosition - flag, enables window incremental positioning, enabled by default
- mobileLoadingBar: flag, enables loading bar for dialog on mobile devices, enabled by default
- desktopLoadingBar: flag, enables loading bar for dialog on desktop, disabled by default

Frontend Widget Manager
-----------------------

Responsibilities
^^^^^^^^^^^^^^^^

The **widget manager** acts as a mediator that enables different parts of the system—including widgets themselves—to interact with widget container instances using either a unique widget identifier or a widget alias.

It maintains a registry of all widget container instances currently present on the page. Registration and removal of widget instances are handled automatically through the ``widget_initialize`` and ``widget_remove`` events.

Interaction Example
^^^^^^^^^^^^^^^^^^^

This example demonstrates how a widget can trigger a *formSave* event when a form is successfully submitted.

**Page content**

.. code-block:: php

    <div id="poll-widget" {{ UI.renderPageComponentAttributes({
        'module': 'your/widget/creator'
    })></div>

A JavaScript module must be created to initialize the widget ``'your/widget/creator'`` as shown below.
Remember to add this module to the ``dynamic-imports`` section in ``jsmodules.yml``.

.. code-block:: javascript

    import widgetManager from 'oroui/js/widget-manager';
    import BlockWidget from 'oro/block-widget';

    export default function(options) {
        var widgetInstance = new BlockWidget({
            el: '#poll-widget',
            url: '/my-poll-widget',
            title: 'Satisfaction survey'
        });
        addWidgetInstance.render();

        widgetInstance.on('formSave', function() {
            alert('Form saved');
        });
    }

**Widget content**

.. code-block:: php

    <div class="widget-content">
        <form action="/my-poll-widget" method="post">
            <label for="variant">Are you satisfied?</label>
            <select name="variant" id="variant">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <div class="widget-actions">
                <button type="submit">Vote</button>
            </div>
        </form>

        {% if isSaved %}
        <div {{ UI.renderPageComponentAttributes({
             'module': 'your/widget/handler',
             'options': {wid: app.request.get('_wid')}
        })></div>
        {% endif %}
    </div>

Next, create a JavaScript module for the handler ``'your/widget/handler'`` as shown below.
Remember to add this module to the ``dynamic-imports`` section in ``jsmodules.yml``.

.. code-block:: javascript

    import widgetManager from 'oroui/js/widget-manager';

    export default function(options) {
        widgetManager.getWidgetInstance(options.wid, widget => {
            widget.trigger('formSave');
        });
    }

API
^^^

widget-manager.js Events
~~~~~~~~~~~~~~~~~~~~~~~~

Global events triggered on mediator:

* **widget_registration:wid:** - triggered when widget instance added

widget-manager.js Methods
~~~~~~~~~~~~~~~~~~~~~~~~~

* **resetWidgets()** - Reset manager to initial state.

* **addWidgetInstance(widget)** - Add widget instance to registry.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "widget","oroui.widget.AbstractWidget","widget instance"

* **getWidgetInstance(wid, callback)** -  Get widget instance by widget identifier and pass it to callback when became available.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "wid","string","unique widget identifier"
   "callback","function","widget handler"

* **getWidgetInstanceByAlias(alias, callback)** - Get widget instance by alias and pass it to callback when became available.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "alias","string","widget alias"
   "callback","function","widget handler"

* **removeWidget(wid)** - Remove widget instance from registry.

Parameters:

.. csv-table::
   :header: "Name", "Type","Description"
   :widths: 20, 20, 20

   "wid","string","unique widget identifier"

Backend
-------

Widget Context Provider
^^^^^^^^^^^^^^^^^^^^^^^

The **Widget Context Provider** allows you to determine the current context of the application during rendering.
It enables customization of the application behavior based on the active widget context.

This provider is registered as a DI service with the name ``oro_ui.provider.widget_context``.
It can also be injected as a global variable in Twig templates.

API
^^^

isActive
~~~~~~~~

Returns whether the current **widget context** is active (`TRUE`) or not (`FALSE`).

getWid
~~~~~~

Returns the unique widget identifier.

