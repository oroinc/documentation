.. _dev-doc-frontend-quick-start:

Quick Start Guide
=================

There are several ways to implement custom logic in Oro applications. You can use **AppModule**, **View**, **Component**, or other entities, but each has a different purpose.

This section discusses correct approaches for implementing javascript components in your Oro application.

Before You Begin
------------------

Make sure that you place all JS modules in the bundle's public folder. If there is no bundle yet, create one following the instruction in the :ref:`Create a Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

Next, open your work folder  ``cd userFolder/project/commerce-crm-ee/`` in the terminal. To build the application after changes, run the ``npm run build`` command.  To rebuild the application automatically, run the ``npm run watch`` command.

Keep in mind that if you create a new bundle or fail to create symlinks when installing the application, you need to run the following command ``bin/console assets:install --symlink``. For more information, please see :ref:`OroAssetBundle <bundle-docs-platform-asset-bundle>` documentation.

.. note:: Before starting work, run the webpack in watch mode in the terminal using the``npm run watch`` command.

Make sure you also follow the **Naming Conventions** for public files outlined in the :ref:`JavaScript Architecture <dev-doc-frontend-javascript-naming-conventions>` documentation.

View vs Component
-----------------

* **Component**. This is an invisible component that takes responsibility of the controller for certain functionality. It accepts the options' object, performs initialization actions, and destroys initialized elements (views, models, collections, or even sub-components) when required. It provides the correct life cycle for various entities within itself.

  .. hint:: For more information, see the :ref:`Page Component <dev-doc-frontend-page-component>` topic.

* **View**. It is essential to organize your interface into logical views (backed by models) that can be updated independently when the model changes, without redrawing the page. Instead of digging into the JSON object, looking up an element in the DOM, and updating the HTML by hand, you can bind your view's render function to the model's *change* event. This way, this model data are always immediately up-to-date wherever they are displayed in the UI.

  .. hint:: For more information, see |Backbone View| documentation.

Create Interactive Markup with a Single View
--------------------------------------------

A single view has the following capabilities:

* It adds interactivity to an existing HTML,
* It provides the ability to filter list items in real-time,
* It hides list items that do not match the search string,
* It enables you to select an active element whose label is displayed in the header,
* It handles a click on the button to clear the search field.

.. image:: /img/frontend/frontend_architecture/javascript-example-1.png
   :alt: Interactive filtering view

To create interactive markup with a single view:

1. Create file ``src/{YourBundleName}/Resources/public/js/app/views/filter-view.js`` and copy and paste the code below. Remember to replace ``{YourBundleName}`` with your bundle name.

   .. code-block:: javascript

        import {escape} from 'underscore';
        import BaseView from 'oroui/js/app/views/base/view';

        const FilterView = BaseView.extend({
            autoRender: true,

            // Define DOM event inside view element
            events: {
                'click .list-item': 'selectActive',
                'input .search': 'onInputSearch',
                'click .clear-field': 'resetSearchFieldValue'
            },

            /**
             * Named constructor
             * @param {Object} options
             */
            constructor: function FilterView(options) {
                FilterView.__super__.constructor.call(this, options);
            },

            /**
             * Handler for user typing text in field
             * @param {Event} event
             */
            onInputSearch(event) {
                const searchText = event.target.value;

                // Check reset search button visibility
                this.toggleVisibilityClearFieldButton(!searchText.length);

                this.filterListItemToShow(escape(searchText));
            },

            /**
             * Reset search field value
             * @param {MouseEvent} event
             */
            resetSearchFieldValue(event) {
                event.preventDefault();

                this.$('.search')
                    .val('')
                    .trigger('input');
            },

            /**
             * Filter and change list item visibility depend of search text
             * @param {string} searchText
             */
            filterListItemToShow(searchText) {
                if (!searchText.length) {
                    this.$('.list-item.hide').removeClass('hide');
                    return;
                }

                this.$('.list-item').each((index, item) => {
                    const $item = this.$(item);
                    $item.toggleClass('hide',
                        !$item.text().toLowerCase().includes(searchText.toLowerCase())
                    );
                });
            },

            /**
             * Change reset search button visibility
             * @param {boolean} visible
             */
            toggleVisibilityClearFieldButton(visible) {
                this.$('.clear-field').toggleClass('hide', visible);
            },

            /**
             * Handling click on list items
             * When user click list, it should set as active
             * @param {MouseEvent} event
             */
            selectActive(event) {
                event.preventDefault();

                // Make list item an active
                this.$(event.target)
                    .addClass('active')
                    .siblings()
                    .removeClass('active');

                // Update header title
                this.$('.selected').text(
                    escape(event.target.innerText)
                );
            }
        });

        export default FilterView;

   .. important::
               * Call method of the ``__super__`` prototype to invoke initial functionality
               * Use a named constructor like ``constructor: function FooPageView(options)`` to simplify debugging in the feature
               * In components, do not declare event listeners directly in methods. Use a declarative approach, define a list of event listeners in ``events`` and ``listen``.

2. Register a new module in ``src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml``. If the file does not exist, create one, as described in the :ref:`JS Modules <reference-format-jsmodules>` topic. In addition, define ``dynamic-imports`` because the view appends to the DOM element as attribute ``data-page-component-view`` in a widget in the twig file. Remember to replace ``{yourbundlename}`` with your bundle name.

   .. code-block:: yaml

        dynamic-imports:
            {yourbundlename}:
                - {yourbundlename}/js/app/views/filter-view

   In the example above, paths to files (such as js, twig, yaml, and others) are for the storefront layout themes. For the back-office, place the same files into the config folder ``src/{YourBundleName}/Resources/config/``. To create a storefront theme, see the :ref:`Themes <dev-doc-frontend-layouts-theming>` topic.

   .. important:: If bundle name changes, update all paths to JS modules in ``twig`` and ``yml`` files depending on the bundle name.

3. Append the view module to the DOM element by defining the ``data-page-component-module`` attribute and adding a path for the view module as options in the ``data-page-component-options`` attribute. For more information, see :ref:`Page Component <dev-doc-frontend-page-component>`. Next, create file ``src/{YourBundleName}/Resources/views/layouts/{theme}/layout.html.twig`` as illustrated below:

   .. code-block:: html+jinja

        {% block _custom_view_block_widget %}
            {% set attr = attr|merge({
                'data-page-component-view': '{yourbundlename}/js/app/views/filter-view'
            }) %}

            <div {{ block('block_attributes') }}>
                <h1 class="mb-3">Selected: <span class="selected">Belt</span></h1>

                <div class="search-container">
                    <input type="text" class="input search" placeholder="Search items...">
                    <button class="btn btn--plain ml-3 clear-field hide">
                        <span class="fa-close" aria-hidden="true"></span>
                    </button>
                </div>

                <div class="list mb-5 mt-5">
                    <div class="list-item active">Belt</div>
                    <div class="list-item">Gloves</div>
                    <div class="list-item">Top</div>
                    <div class="list-item">Cravat</div>
                    <div class="list-item">Waistcoat</div>
                    <div class="list-item">Suit</div>
                    <div class="list-item">Kilt</div>
                    <div class="list-item">T-Shirt</div>
                    <div class="list-item">Coat</div>
                </div>
            </div>
        {% endblock %}

   ``ViewComponent`` extends from ``BaseComponent``, which helps dynamically initialize the view module from the path that passes from options.

   .. note::
       Be aware that attribute ``data-page-component-view`` is s shortcut for call ``view-component`` to initialize the view instance. For more information on shortcuts, see :ref:`Component Shortcuts <dev-doc-frontend-component-shortcuts>`. For more information on using twig templates, see :ref:`Templates (Twig) <templates-twig>`.

4. Register a new widget and append it to a page container in the layout. Next, create file ``src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml``. For more information on layout update, see :ref:`Layout <dev-doc-frontend-layouts-layout>`.

   .. code-block:: yaml

        layout:
            actions:
                - '@setBlockTheme':
                    themes: 'layout.html.twig'

                - '@add':
                    id: custom_view_block
                    parentId: page_container
                    prepend: true
                    blockType: block

Executing Code Before Starting the Application
----------------------------------------------

You can use the app module in the following cases:

* Setting up a form validator
* Loading a custom form validator
* Creating a listener for viewport changes
* Creating a listener for a custom page scroll
* Removing unnecessary input widgets using the example of ``number`` and ``select2``

**App Modules** are atomic parts of the general application executed before initializing the application. Each time the page loads, the code is executed again. App modules export nothing. They make the whole application modular and the functionality distributed among the bundles ready to work. For more information, see the :ref:`App Module <frontend-architecture-app-module>` topic.

.. important:: In the single page application, the app module is executed once when the page is loaded in the browser.

If it is a new bundle, or you install the application without symlinks, run command ``bin/console assets:install --symlink``.

Register the new module in ``src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml``. If the file does not exist, create one.

.. code-block:: yaml

    app-modules:
        - {yourbundlename}/js/app/modules/validation-module
        - {yourbundlename}/js/app/modules/listeners-module
        - {yourbundlename}/js/app/modules/custom-input-widgets-module

Modifying form validator behavior is used to add or update the default validator settings or load custom validation rule modules. To modify form validator behavior, create file ``src/{YourBundleName}/Resources/public/js/app/modules/validation-module.js`` and copy and paste the code below:

.. code-block:: javascript

    import $ from 'jquery'; // Import jQuery library

    // set default properties for validator
    $.validator.setDefaults({
        errorClass: 'validation-message-failed',
    });

    // load custom validation rules, it not real module
    $.validator.loadMethod('{yourbundlename}/js/validator/not-blank');

Adding global mediator listeners or listening to DOM events globally is used to listen to the change of the ``viewport`` state when a user resizes the browser window or scrolls through the page. To add global mediator listeners, create app module ``src/{YourBundleName}/Resources/public/js/app/modules/listeners-module.js`` and copy and paste the code below:

.. code-block:: javascript

    import $ from 'jquery'; // Import jQuery library
    import mediator from 'oroui/js/mediator'; // Import mediator instance

     // Add mediator listener
    mediator.on('viewport:change', viewport => {
        console.log(viewport.width);
    });

    // DOM events, listen page scroll
    $(window).on('scroll', event => {
        console.log('onScroll', event);
    });

The application contains a form input widget like select2, custom checkboxes, numbers, and others. Sometimes you need to disable some widgets for certain conditions, for example, when a user opens the application on a mobile device. You can also modify input widget options or change the widget constructor. For this, create app module ``src/{YourBundleName}/Resources/public/js/app/modules/custom-input-widgets-module.js`` and copy and paste the code below:

.. code-block:: javascript

    import InputWidgetManager from 'oroui/js/input-widget-manager'; // import inputWidgetManager
    import Select2InputWidget from 'oroui/js/app/views/input-widget/select2'; // import Select2InputWidget constructor
    import tools from 'oroui/js/tools'

    // remove number and checkbox widgets for mobile view
    if (tools.isMobile()) {
        InputWidgetManager.removeWidget('number');
        InputWidgetManager.removeWidget('checkbox');
    }

    // remove Select2 input widget
    InputWidgetManager.removeWidget('select2');

    // register Select2 input widget with new selector
    InputWidgetManager.addWidget('select2', {
        selector: 'select:not(.do-not-use-select2-widget)',
        Widget: Select2InputWidget
    });

For more information on input widgets, see :ref:`Input Widgets <bundle-docs-platform-ui-bundle-input-widgets>`.

.. important:: **Be aware that global modules can affect the entire application.**

Create a Page Component with a Dynamic View and Two-Way Binding
---------------------------------------------------------------

You can create an interactive UI feature to edit your content by creating a Backbone model to control the data state. The view updates when the model changes its state. Initialization of **Model** and **View** happens in the page component. The **Base Component** provides the right life cycle for **Model** and **View**.

The main goal of the page component is to ensure the correct life cycle of the component itself and all of its properties. It has two different modes, view and edit.

To create a page component with a dynamic view and two-way binding:

1. Create a page component ``content-component.js`` and copy and paste the code below to ``src/{YourBundleName}/Resources/public/js/app/components/content-component.js``, as illustrated below.

    .. code-block:: javascript

        import BaseComponent from 'oroui/js/app/components/base/component';
        import ContentModel from '../models/content-model';
        import ContentView from '../views/content-view';
        import EditContentView from '../views/edit-content-view';

        const ContentComponent = BaseComponent.extend({
            constructor: function ContentComponent(options) {
                ContentComponent.__super__.constructor.call(this, options);
            },

            /**
             * Initialize
             * @param {Object} initState
             * @param {HTMLElement} _sourceElement
             */
            initialize({initState: data = {}, _sourceElement}) {
                this.initModel(data);
                this.initView(_sourceElement);
                this.initEditView(_sourceElement);
            },

            /**
             * Create model for control data state
             * @param {Object} data
             */
            initModel(data = {}) {
                this.model = new ContentModel(data);
            },

            /**
             * Create content view
             * put `model` as options for view
             *
             * @param {HTMLElement} _sourceElement
             */
            initView(_sourceElement) {
                this.view = new ContentView({
                    container: _sourceElement,
                    model: this.model
                });
            },

            /**
             * Create edit content view
             * put `model` as options for view
             *
             * @param {HTMLElement} _sourceElement
             */
            initEditView(_sourceElement) {
                this.editView = new EditContentView({
                    container: _sourceElement,
                    model: this.model
                });
            }
        });

        export default ContentComponent;

   .. important:: The component automatically disposes of all its assigned properties such as **model**, **view**, **editView** when required (depending on the component life cycle).

2. To ensure communication between the views, create a **Model**. It can store properties and, parameters and trigger events if a property has changed. Copy and paste the code below to ``src/{YourBundleName}/Resources/public/js/app/models/content-model.js``:

   .. code-block:: javascript

      import BaseModel from 'oroui/js/app/models/base/model';

      const ContentModel = BaseModel.extend({
          // Set default state for model
          defaults: {
              title: 'Demo title',
              content: '',
              editMode: false
          },

          constructor: function ContentModel(options) {
              ContentModel.__super__.constructor.call(this, options);
          },

          /**
           * Return `true` if edit mode on
           * @returns {boolean}
           */
          isEditMode() {
              return this.get('editMode');
          },

          /**
           * Return `true` if view mode on
           * @returns {boolean}
           */
          isViewMode() {
              return !this.get('editMode');
          }
      });

      export default ContentModel;

3. Create a view representation of content for the page component. Copy and paste the code below to ``src/{YourBundleName}/Resources/public/js/app/views/content-view.js``

   .. image:: /img/frontend/frontend_architecture/javascript-example-2-view.png
      :alt: Two way binding view mode

   .. code-block:: javascript

        import BaseView from 'oroui/js/app/views/base/view';
        import template from 'tpl-loader!../../../templates/content-view-template.html';

        const ContentView = BaseView.extend({
            // Set `true` for render view immediate
            autoRender: true,

            // Set class name for root view element
            className: 'content',

            // Set up view template
            template,

            // Declare DOM events listener
            events: {
                'click .edit-mode': 'changeEditMode'
            },

            // Declare model events listener
            listen: {
                'change model': 'onModelChange'
            },

            constructor: function ContentView(options) {
                ContentView.__super__.constructor.call(this, options);
            },

            /**
             * Modifying render method
             * Check view mode after render over
             */
            render() {
                ContentView.__super__.render.call(this);

                this.checkVisibility();
            },

            /**
             * Change view mode
             * Edit mode on
             */
            changeEditMode() {
                this.model.set('editMode', true);
            },

            /**
             * If is not view mode, add `hide` class
             */
            checkVisibility() {
                this.$el.toggleClass('hide', !this.model.isViewMode());
            },

            /**
             * Rerender view if model changed
             */
            onModelChange() {
                this.render();
            }
        });

        export default ContentView;

   .. important:: Create templates in separate files and import them to the JS module only via ``tpl-loader!``.

4. Create a template for the view. Copy and paste the code below to ``src/{YourBundleName}/Resources/public/templates/content-view-template.html``

   .. code-block:: none

        <h1><%- title %></h1>

        <p><%- content %></p>

        <button class="btn edit-mode">Edit</button>

   .. important:: The most correct and safe method is to declare templates as separate modules and import them via a special loader.

5. To implement editing mode, create an edit content view. Copy and paste the code below to ``src/{YourBundleName}/Resources/public/js/app/views/edit-content-view.js``

   .. image:: /img/frontend/frontend_architecture/javascript-example-2-edit.png
      :alt: Two way binding edit mode

   .. code-block:: javascript

        import BaseView from 'oroui/js/app/views/base/view';
        import template from 'tpl-loader!../../../templates/content-edit-view-template.html';

        const EditContentView = BaseView.extend({
            // Set `true` for render view immediate
            autoRender: true,

            // Set class name for root view element
            className: 'content-edit hide',

            // Set up view template
            template,

            // Declare DOM events listener
            events: {
                'submit form': 'updateContent',
                'click .cancel': 'onClickCancel'
            },

            // Declare model events listener
            listen: {
                'change model': 'onModelChange'
            },

            constructor: function EditContentView(options) {
                EditContentView.__super__.constructor.call(this, options);
            },

            /**
             * Modifying render method
             * Check view mode after render over
             */
            render() {
                EditContentView.__super__.render.call(this);

                this.checkVisibility();
            },

            /**
             * If is not view mode, add `hide` class
             */
            checkVisibility() {
                this.$el.toggleClass('hide', !this.model.isEditMode());
            },

            /**
             * Update model on user submit form
             * @param {Event} event
             */
            updateContent(event) {
                event.preventDefault();

                this.model.set({
                    title: this.$('[name="title"]').val(),
                    content: this.$('[name="content"]').val(),
                    editMode: false
                });
            },

            /**
             * Rerender view if model changed
             */
            onModelChange() {
                this.render();
            },

            /**
             * Cancel changes and exit edit mode
             * @param event
             */
            onClickCancel(event) {
                event.preventDefault();

                this.model.set('editMode', false);
            }
        });

        export default EditContentView;

6. Create a template for the edit mode. Copy and paste the code below to ``src/{YourBundleName}/Resources/public/templates/content-edit-view-template.html``

   .. code-block:: none

        <form class="grid">
            <div class="grid__row">
                <label for="name">Title</label>
                <input type="text" id="name" class="input" name="title" value="<%- title %>">
            </div>
            <div class="grid__row">
                <label for="content">Content</label>
                <textarea class="input" id="content" name="content"><%- content %></textarea>
            </div>
            <div class="grid__row">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="reset" class="btn">Reset</button>
            </div>
        </form>

7. Once the page component is created, declare it in the template of the required page. Copy and paste the code below to ``src/{YourBundleName}/Resources/views/layout.html.twig``

   .. code-block:: html+jinja

        {% block _custom_block_widget %}
            {% set attr = layout_attr_defaults(attr, {
                'data-page-component-module': '{yourbundlename}/js/app/components/content-component',
                'data-page-component-options': {
                    'initState': {
                        'title': 'Initial title'
                    }
                }
            }) %}

            <div {{ block('block_attributes') }}>
                {{ block_widget(block) }}
            </div>
        {% endblock %}

8. Register your new widget and append it to the page container in layout. For this, create file ``src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml``. For more on layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

   .. code-block:: yaml

        layout:
            actions:
                - '@setBlockTheme':
                    themes: 'layout.html.twig'

                - '@add':
                    id: custom_block
                    parentId: page_container
                    prepend: true
                    blockType: block

9. Declare the page component in the yaml config ``jsmodules.yml``. Copy and paste the code below to ``Resources/views/layout/{theme}/jsmodules.yml``

   .. code-block:: yaml

        dynamic-imports:
            {yourbundlename}:
                - {yourbundlename}/js/app/components/content-component

**References:**

* |oroui/js/app/components/base/component|
* |oroui/js/app/views/base/view|
* |oroui/js/app/modules/input-widgets|
* |Backbone View|

.. include:: /include/include-links-dev.rst
   :start-after: begin
