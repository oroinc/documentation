.. _bundle-docs-platform-ui-bundle-widgets:

Widgets
=======

**Widget** is a UI element that is placed inside a widget container. Most widgets are backend actions.

Examples of widgets are: contact information, opportunity information, address book, add address form, import form, workflow transitions, etc.

**Widget container** is a part of UI where widgets are shown. A Widget Container can show different types of widgets.

Examples of implemented BAP widget containers:

- Dialog windows
- Buttons
- Content blocks

Goals
-----

Widgets are created to give developers the ability to use one content inside different containers on frontend.

HTML can be used as content (a fragment of a page or the whole page) generated separately by the method of a controller.

System may have different containers: dialog windows, blocks, etc. Also widgets provides additional functionality around
widget content: remote content loading, widget actions handling, embedded forms processing. Widget manager adds the ability of
widget-to-widget, widget-to-page and page-to-widget interaction based on Backbone events and direct usage of widgets API.
Each widget on page has a unique widget identifier.

JS Modules Services
^^^^^^^^^^^^^^^^^^^

 - **oroui/js/widget-manager** - Widget manager
 - **oro/block-widget** - Block widget
 - **oro/buttons-widget** - Buttons widget
 - **oro/dialog-widget** - Dialog widget
 - **oroui/js/widget/abstract-widget** - Abstract widget, can not be used standalone

Widgets
-------

Widget is any controller/action or static content rendered inside the widget container.
@Template annotation supports the `\_widgetContainer` request variable, based on which an appropriate template is chosen by the following rule:

`\<widgetContainer\>/\<action\>.\<format\>.\<templateEngine\> (dialog/example.html.twig)`.

When no template for a specific container is found, the `widget/\<action\>.\<format\>.\<templateEngine\> (widget/example.html.twig)` template is rendered.

If no such template is found, then the default template for action is rendered (example.html.twig).
Widgets may be rendered with twig function `oro_widget_render($options)`.

Frontend Widget Container
-------------------------

Responsibilities
^^^^^^^^^^^^^^^^

A widget container is responsible for displaying a widget, and loading widget data from the server. Widget containers are Backbone views,
so you can use all Backbone views features, like events. You need to place widget content inside element with class **widget-content**.
Widget container adds AJAX handling for included form. A widget container provides the functionality for actions with different action areas.
All form actions are moved to the **adopted** actions section if they are placed in an element with class **widget-actions**.

Widget container adds `\_widgetContainer=\<widgetContainerType\>&\_wid=\<widgetIdentifier\>` to all requests.

* **\_widgetContainer** variable is used to determine the proper template for the current container;

* **\_wid** variable can be used by widget to get an instance of a widget container from the widget manager.

Containers
^^^^^^^^^^

- **Dialog window** showns widget content in a dialog window
- **Button** shows only included content without a title or actions
- **Block** displays embedded widget content on a page

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
 - **widget:add:action:&lt;section&gt;:&lt;action_key&gt;** - triggered when action is added,
   &lt;section&gt; is action section name passed to addAction method,
   &lt;action_key&gt; is action name passed to addAction method
 - **renderStart** - triggered before widget rendering
 - **widgetRender** - triggered on widget rendering
 - **renderComplete** - triggered on widget rendering complete

Global events triggered on mediator:

 - **widget_remove** - triggered on mediator when widget is removed
 - **widget_initialize** - triggered on mediator when widget is created
 - **widget:render:&lt;wid&gt;** - triggered on widget render
    &lt;wid&gt; is widget identifier string

abstract-widget.js Methods
^^^^^^^^^^^^^^^^^^^^^^^^^^

addAction(key, section, actionElement)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Add action element to specified section

Parameters:

.. csv-table::
   :header: "Name","Type", "Description"
   :widths: 20, 20, 20

   "key","string","action name"
   "section","string ","section name"
   "actionElement","HTMLElement","-"

getAction(key, section, callback)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get action element when after render.

Parameters:

.. csv-table::
   :header: "Name", ""Type", "Description"
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

Widget manager is a mediator that allow different parts of system, including widgets them self, interact with widget
container instances by unique widget identifier or by widget alias. Widget manager contains registry of all widget
container instances present on page.  Widget instance registering/removing performed automatically on widget\_initialize/widget\_remove events.

Interaction Example
^^^^^^^^^^^^^^^^^^^

Let's assume that a widget needs to trigger a *formSave* event when a form is successfully saved.

**Page content**

.. code-block:: html
   :linenos:

    <div id="poll-widget"></div>
    <script type="text/javascript">
    loadModules(['oroui/js/widget-manager', 'oro/block-widget'],
    function(widgetManager, BlockWidget) {
        var widgetInstance = new BlockWidget({
            el: '#poll-widget',
            url: '/my-poll-widget',
            title: 'Satisfaction survey'
        });
        addWidgetInstance.render();

        widgetInstance.on('formSave', function() {
            alert('Form saved');
        });
    });
    </script>

**Widget content**

.. code-block:: html
   :linenos:

    <div class="widget-content">
        <form action="/my-poll-widget" method="post">
            <label for="variant">Are you satisfied</label>
            <select name="variant" id="variant">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <div class="widget-actions">
                <button type="submit">Vote</button>
            </div>
        </form>

        {% if isSaved %}
        <script type="text/javascript">
            loadModules(['oroui/js/widget-manager'],
            function(widgetManager) {
                widgetManager.getWidgetInstance({{ app.request.get('_wid')|json_encode|raw }}, function(widget) {
                    widget.trigger('formSave');
                });
            });
        </script>
        {% endif %}
    </div>

API
^^^

widget-manager.js Events
~~~~~~~~~~~~~~~~~~~~~~~~

Global events triggered on mediator:

- **widget_registration:wid:&lt;wid&gt;** - triggered when widget instance added &lt;wid&gt; is widget identifier string

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

Widget Context Provider provides the possibility to know the current context of the application during rendering. It enables you to customize the application based on the current context.
It is registered as DI service named `oro_ui.provider.widget_context`. You can inject it as a global variable for twig templates.
 
API
^^^

isActive
~~~~~~~~

Returns whether current **widget context** is in active state.
 
getWid
~~~~~~

Returns unique widget identifier if **widget context** is active or `FALSE` otherwise.
