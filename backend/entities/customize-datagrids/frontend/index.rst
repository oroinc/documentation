.. _customizing-data-grid-in-orocommerce-frontend:

Frontend Datagrid
=================

Oro/datagrid Events
-------------------

Mediator Events
^^^^^^^^^^^^^^^

Datagrid listens on mediator for events:

- `datagrid:setParam:<gridName>` - `param`, `value`
  Set additional datagrid parameters

- `datagrid:removeParam:<gridName>` - `param`
  Remove additional datagrid parameter

- `datagrid:restoreState:<gridName>` - `columnName`, `dataField`, `included`, `excluded`
  Restore checkboxes state

- `datagrid:restoreChangeset:<gridName>` - `dataField`, `changeset`
  Restore select-cells state

- `datagrid:doRefresh:<gridName>`
  Refresh datagrid

- `datagrid:doReset:<gridName>`
  Reset datagrid state

- `datagrid:changeColumnParam:<gridName>` - `columnName`, `option`, `value`
  Sets column option value

DOM Events
^^^^^^^^^^

Datagrid emits DOM events on its $el element:

- `datagrid:change:<gridName>` - `model`

.. _customizing-data-grid-in-orocommerce-frontend-render:

Datagrid Render
---------------

Datagrid provide twig macros for datagrid render.

Usage example:

.. code-block:: html

   {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}
   {{ dataGrid.renderGrid(name, params, renderParams) }}


`renderParams` provide ability to configure grid view.

Usage example:

.. code-block:: html
   :linenos:

    <script type="text/template" id="row-template-selector">
        <b><%= model.label %></b><br/>
        <%= model.description %>
    </script>

    {% set renderParams = {
        themeOptions: {
            tagName: 'div', #change grid table tags to div
            headerHide: true, #hide grid elements, allowed prefixes: header, footer
            bodyClassName: 'grid-my-body', #change element class name, allowed prefixes: header, headerRow, body, row, footer
            rowTemplateSelector: '#row-template-selector' #disable standard row renderer by cells and use given template for full row
        }
    } %}

.. _customize-datagrid-settings:

Datagrid Settings Manager
-------------------------

Datagrid Settings allows to:

- show/hide a column or filters
- change the order of columns
- save columns state in :ref:`Grid View <customize-datagrids-extensions-grid-views>`.

Datagrid Settings operates with columns' attributes:

- `renderable` show/hide the column/filters (if is not defined the column is shown)
- `order` is used to sort only columns in a row
- `required` if `true` the column/filters can not be hidden (but can be ordered)
- `manageable` if `false` the column does not appear in Datagrid Settings (generally is used for system columns such as `actions` or `selectRow`)

There's the option that allows to turn off Datagrid Settings over `datagrids.yml` configuration:

.. code-block:: yaml
   :linenos:

    datagrids:
        my-grid:
            ...
            options:
                toolbarOptions:
                    datagridSettingsManager: false

.. _customizing-data-grid-in-orocommerce-frontend-widget:

Datagrid Widget
---------------

Datagrid widget provide ability to render datagrid by name as widget.
When datagrid is rendered inside widget it's rowClickAction will be disabled and replaced with dummy action. This action will trigger `grid-row-select` event on widget instance with data parameter of next structure:

.. code-block:: javascript
   :linenos:

    {
        datagrid: datagridInstance,
        model: selectedModel
    }


Usage example:

.. code-block:: none
   :linenos:

    {% import 'OroUIBundle::macros.html.twig' as UI %}

    <div>
        {{ oro_widget_render({
            'widgetType': 'block',
            'url': path('oro_datagrid_widget', {gridName: 'groups-grid'}),
            'title': 'User Groups'|trans,
            'alias': 'user-groups-widget'
        }) }}
        <div {{ UI.renderPageComponentAttributes({
            'module': 'your/row-selection/handler',
            'options': {
                'alias': 'user-groups-widget'
            }
        })></div>
    </div>


Create js module with the handler definition ``your/row-selection/handler`` as shown in example below, don't forget to add this module to the list of `dynamic-imports` in `jsmodules.yml`

.. code-block:: javascript
   :linenos:

    import widgetManager from 'oroui/js/widget-manager';

    export default function(options) {
        widgetManager.getWidgetInstanceByAlias(options.alias, function(widget) {
            widget.on('grid-row-select', function(data) {
                console.log(data.datagrid);        // datagrid instance
                console.log(data.model);           // row data object
                console.log(data.model.get('id')); // row attribute
            });
        });
    };

.. _customizing-data-grid-in-orocommerce-frontend-layouts:

Grid Customization Through Layouts
----------------------------------

Grid can become customizable through option `split_to_cells` of `datagrid` block type in the layout configuration file:

.. code-block:: yaml
   :linenos:

    id: account_users
    ...
    blockType: datagrid
    options:
        grid_name: frontend-account-account-user-grid
        split_to_cells: true

.. note:: By default, grid builds without layouts blocks (`split_to_cells: false`)

According to `split_to_cells` option layout tree of the grid will have hierarchy like this:

.. code::

    account_users
        account_users_header_row
            account_users_header_cell_firstName
            account_users_header_cell_lastName
            account_users_header_cell_email
            account_users_header_cell_enabled
            account_users_header_cell_confirmed
        account_users_row
            account_users_cell_firstName
                account_users_cell_firstName_value
            account_users_cell_lastName
                account_users_cell_lastName_value
            account_users_cell_email
                account_users_cell_email_value
            account_users_cell_enabled
                account_users_cell_enabled_value
            account_users_cell_confirmed
                account_users_cell_confirmed_value


Where `account_users` is the main block, which corresponds to block `id` of `datagrid` type.
Block `account_users` contains two other blocks: `account_users_header_row` and `account_users_row`. First responds to the table header, second - table row. In `account_users_header_row` we can see `<block_id>_cell_<column1...N>` blocks which corresponds to  `<th>...</th>` HTML structure. Columns `column1` ... `columnN` were taken from `datagrids.yml` config file:

.. code-block:: yaml
   :linenos:

    columns:
        firstName:
            type:      string
            data_name: accountUser.firstName
        lastName:
            type:      string
            data_name: accountUser.lastName
        email:
            type:      string
            data_name: accountUser.email
        enabled:
            type:      boolean
            data_name: accountUser.enabled
        confirmed:
            type:      boolean
            data_name: accountUser.confirmed

Block `account_users_row` consists of `<block_id>_<column1...N>` which corresponds to `<td>...</td>`. Leaf blocks `<block_id>_cell_<column1...N>_value` holds cell value for row value.

Just after grid was divided into cells we can manipulate its blocks.

.. note::
    Good choice to investigate grid structure is :ref:`Layout Developer Toolbar <dev-doc-frontend-layouts-debugging>`.

For example, we want to hide column `email` from `frontend-account-account-user-grid`. Just remove appropriate header and row columns:

.. code-block:: yaml
   :linenos:

    - '@remove':
        id: account_users_header_cell_email

    - '@remove':
        id: account_users_cell_email


In another case, suppose we want make `bold` content of column `firstName`. In `layout.yml.twig` you should create template like this:

.. code-block:: twig
   :linenos:

    {% block _account_users_cell_firstName_value_widget %}
        <b>{{ block_widget(block) }}</b>
    {% endblock %}

Grid Layout Configuring
-----------------------

Basic settings for layout grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In ``layouts/some_theme/layout.yml`` specify:

.. code-block:: yaml
   :linenos:

    layout:
        imports:
            -
                id: datagrid
                root: __root

        actions:
            - '@setOption':
                id: __datagrid
                optionName: grid_name
                optionValue: frontend-some-grid


2. In ``/config/oro/datagrids.yml`` should be defined:

.. code-block:: yaml
   :linenos:

    datagrids:
        frontend-some-grid:
    ...

As we see in `layout.yml`, we need to extend generic layout block first. Later defined in `OroDataGridBundle` (`imports` directive used). Also we should to specify `optionName` with `grid_name` and `optionValue` with grid identifier value defined in `datagrids.yml`.

If we open generic layout block for `base` theme (``base/imports/datagrid/layout.yml``) we could see other related with datagrid block: `datagrid_toolbar`:

.. code-block:: yaml
   :linenos:

    layout:
        imports:
             -
                 id: datagrid_toolbar
                 root: __root

        actions:
            - '@addTree':
                items:
                    __datagrid:
                        blockType: datagrid
                tree:
                    __root:
                        __datagrid: ~


This block is responsible for rendering grid toolbar, and it consists of different blocks like page_size, pagination, sorting, etc. which also customisable using layouts.

Layout Grid Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^

Through layout directives like `visible` , `@move`, `@setOption`, etc. we can configure grid settings and params on layout level.

For example, we can set block visibility based on some logic using Symfony expression language:

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@add':
                id: products
                parentId: page_content
                blockType: datagrid
                options:
                    grid_name: products-grid
                    visible: '=data["feature"].isFeatureEnabled("product_feature")'


In ``DataGridBundle/Layout/Block/Type/DatagridType.php`` defined additional parameters used for grid rendering:

.. code-block:: php
   :linenos:

    'grid_parameters' => [],
    'grid_render_parameters' => [],
    'split_to_cells' => false,

Using `split_to_cells` parameter we can manipulate grid layout on more detailed level - table cells. How to use this param described in :ref:`Grid customization through 'split to cells' option <backend-entities-filters-grid-extension>`.
Other params defined in Twig macros `renderGrid` (``DataGridBundle/Resources/views/macros.html.twig``):

- `grid_parameters` - parameters need to be passed to grid request
- `grid_render_parameters` - render parameters need to be set for grid rendering

Suppose we need to change some parameters that affects grid layouts on **Account > Quotes** frontend page.

Using :ref:`Layout Developer Toolbar <dev-doc-frontend-layouts-debugging>` in developer mode we can quickly find out grid layout identifiers: `quotes_datagrid` and `quotes_datagrid_toolbar`. On `Build Block` view we can see `grid_name` parameter: `frontend-quotes-grid`.

Lets change some options for this grid layout.

In ``SaleBundle/Resources/views/layouts/default/imports/oro_sale_quote_grid/layout.yml`` we can specify css class that will be used for grid rendering:

.. code-block:: yaml
   :linenos:

    - '@setOption':
        id: __datagrid
        optionName: grid_render_parameters
        optionValue:
            cssClass: 'some-css-class'

If we inspect HTML page with grid we see that class atrribute was added to div element: `class="some-css-class"`

In order to pass some extra param to grid request lets specify for example `web_catalog_id` context param:

.. code-block:: yaml
   :linenos:

    - '@setOption':
        id: __datagrid
        optionName: grid_parameters
        optionValue:
            web_catalog_id: '=context["web_catalog_id"]'

If we make some actions with grid like sorting, we see that additional request attribute `web_catalog_id` was added:

.. code-block:: none

    ...
    frontend-quotes-grid[originalRoute]:oro_sale_quote_frontend_index
    frontend-quotes-grid[web_catalog_id]:1
    appearanceType:grid
    frontend-quotes-grid[_pager][_page]:1
    frontend-quotes-grid[_pager][_per_page]:25
    ...


Suppose we want to modify datagrid toolbar. Lets hide block with page size:

.. code-block:: none

    - '@setOption':
        id: __datagrid_toolbar_page_size
        optionName: visible
        optionValue: false

After refresh page `Page size` will be hidden.

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:

   extensions/mass-action-configuration