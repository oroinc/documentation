Entity Create or Select Form Type
=================================


Entity create or select form type provides the functionality to create a new entity, select or edit an existing one.

Form type has four modes - create (default), edit, grid, and select.

**Create mode** shows the entity form and allows a user to enter all the required data to create a new entity. This form
includes frontend and backend validation. In this mode, a user can click the button **Select Existing**, which redirects a user to the grid mode.

**Edit mode** shows forms for both create and view mode, enabling users to edit the entity using the form for the create mode.
This mode is currently supported by `oro_entity_create_or_select_choice` type only.

**Grid mode** shows the grid with existing entities and enables users to select any of them by clicking on the appropriate row.
This mode has two buttons - "Cancel," which returns a user to the previous mode (create or view), and "Create New", which
that redirects users to the create mode.

**View mode** shows information about the selected existing entity (one or several widgets). In this mode, there are
two buttons - `Select another` that redirects a user to grid mode, and `Create new` that shows a create entity form
in the create mode.

As a result, the form type can return a new not persisted entity (create mode), existing entity instance (view mode) or
null (grid mode).

Form Type Configuration
-----------------------

Entity create or select form type enables a user to configure rendering information in each mode. Existing options are:

* **class** (required) - a fully-qualified class name used both in the create and view mode to return an instance of this class;

* **create_entity_form_type** (required) - the form type used to create a new form in the create mode or edit an existing record in the edit mode, it is usually the name of an existing and already configured form type for a specific entity; In case you pass the data-default-value attribute in fields of this type, these will be default values after the transition from the edit to the create mode.

* **create_entity_form_options** - additional options for the create entity form type;

* **grid_name** (required) - the name of the grid used to render a list of existing entities in the grid mode; the grid must contain an entity identifier and data required to render widgets in the view mode;

* **existing_entity_grid_id** - the grid column name that contains an existing entity identifier used to select am existing entity; the default value is "id";

* **view_widgets** (required) - an array that contains the configuration for entity widgets in the view mode, each element must be an array with following keys:

  * *route_name* (required) - the name of the route used to render a widget
  * *route_parameters* - an array of parameters for the route, where a key is the parameter name and value is either a static value or PropertyPath used to extract the value from the entity; the deault value is `['id' => new PropertyPath('id')]`
  * *grid_row_to_route* - array used to map grid row values to route parameters, key is grid column name, value is route parameter name, default value is `['id' => 'id']`
  * *widget_alias* - an alias of the created widget, the default value is generated automatically based on the form name and the route name

* **mode** - the default mode used to render form type the first time; the default mode is the create mode.

Backend Implementation
----------------------

Entity create or select form type is a compound form type that consists of three fields:

* **new_entity** - a field built based on `create_entity_form_type` and `create_entity_form_option` 's and used to return new entity instance, `data_class` option is overridden by the  "class" option of the main form type;

* **existing_entity** - a field of form type `oro_entity_identifier`, rendered in the frontend as a hidden field that receives a value when a user clicks on a row in an existing entity grid; it returns an instance of an existing entity;

* **mode** - a hidden field that contains the current mode.

The form type uses the custom data transformer `EntityCreateOrSelectTransformer` to convert data from complex a three field representation into one entity or a null value. It defines the current mode based on the input value (create for the not existing entity, view for the existing entity, default mode from "mode" option for null value) and returns appropriate entity based on specified mode (new_entity for create, existing_entity for view, null for grid).

The form type has a preSubmit listener that disables the validation of the create new entity field for the grid and view modes.

Frontend Implementation
-----------------------

Entity create or select form type is rendered using Twig templates for a custom form type.

The form type uses the following blocks:

* **oro_entity_create_or_select_row** - contains blocks to render errors, label, and widget, and includes a JavaScript handler (create-select-type-handler.js) that processes the change of the current mode;

* **oro_entity_create_or_select_label** - contains the field label and buttons used to switch between modes;

* **oro_entity_create_or_select_widget** - contains a widgets for `existing_entity` and mode fields, and blocks for modes:

  * *create* - renders new_entity field widget;
  * *grid* - renders datagrid with existing entities, row click action of this grid will be disabled and replaced with a row click action that selects an entity and switches to the view mode;
  * *view* - renders all widgets specified in the `view_widgets` option.

JavaScript handler `create-select-type-handler.js` processes switching between modes, enabling/disabling frontend validation for the create entity form, and rendering view widgets for the selected entity according to the specified view widget options.