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

The datagrid provides Twig macros for rendering.

Usage example:

.. code-block:: html

   {% import '@OroDataGrid/macros.html.twig' as dataGrid %}
   {{ dataGrid.renderGrid(name, params, renderParams) }}


`renderParams` lets you configure the grid view.

Usage example:

.. code-block:: html

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

Datagrid Settings lets you:

- show/hide a column or filters
- change the order of columns
- save columns state in :ref:`Grid View <customize-datagrids-extensions-grid-views>`.

Datagrid Settings operates with columns' attributes:

- `renderable` show/hide the column/filters (if is not defined the column is shown)
- `order` is used to sort only columns in a row
- `required` if `true` the column/filters cannot be hidden (but can be ordered)
- `manageable` if `false` the column does not appear in Datagrid Settings (generally is used for system columns such as `actions` or `selectRow`)

You can turn off Datagrid Settings in the `datagrids.yml` configuration:

.. code-block:: yaml

    datagrids:
        my-grid:
            ...
            options:
                toolbarOptions:
                    addDatagridSettingsManager: false

.. _customizing-data-grid-in-orocommerce-frontend-widget:

Datagrid Widget
---------------

The datagrid widget lets you render a datagrid by name as a widget.

When a datagrid is rendered inside a widget it's rowClickAction is disabled and replaced with a dummy action. This action triggers a `grid-row-select` event on the widget instance, with a data parameter of the following structure:

.. code-block:: javascript

    {
        datagrid: datagridInstance,
        model: selectedModel
    }


Usage example:

.. code-block:: none

    {% import '@OroUI/macros.html.twig' as UI %}

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


Create a JS module with the handler definition ``your/row-selection/handler`` as shown in the example below. Do not forget to add this module to the list of `dynamic-imports` in `jsmodules.yml`.

.. code-block:: javascript

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

You can make a grid customizable through the `split_to_cells` option of the `datagrid` block type in the layout configuration file:

.. code-block:: yaml

    id: account_users
    ...
    blockType: datagrid
    options:
        grid_name: frontend-account-account-user-grid
        split_to_cells: true

.. note:: By default, grid builds without layouts blocks (`split_to_cells: false`)

With the `split_to_cells` option, the grid's layout tree has a hierarchy like this:

.. code-block:: none

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


Here `account_users` is the main block, which corresponds to the block `id` of the `datagrid` type.

Block `account_users` contains two other blocks: `account_users_header_row` and `account_users_row`. The first corresponds to the table header, the second to the table row.

In `account_users_header_row`, the `<block_id>_cell_<column1...N>` blocks correspond to the `<th>...</th>` HTML structure. Columns `column1` ... `columnN` come from the `datagrids.yml` config file:

.. code-block:: yaml

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

Block `account_users_row` consists of `<block_id>_<column1...N>` blocks, which correspond to `<td>...</td>`. The leaf blocks `<block_id>_cell_<column1...N>_value` hold the cell value for the row value.

Once the grid is divided into cells, you can manipulate its blocks.

.. note::
    Good choice to investigate grid structure is :ref:`Layout Developer Toolbar <dev-doc-frontend-layouts-debugging>`.

For example, to hide the column `email` from `frontend-account-account-user-grid`, remove the appropriate header and row columns:

.. code-block:: yaml

    - '@remove':
        id: account_users_header_cell_email

    - '@remove':
        id: account_users_cell_email


In another case, suppose we want to make the content of column `firstName` `bold`. In `layout.yml.twig`, create a template like this:

.. code-block:: twig

    {% block _account_users_cell_firstName_value_widget %}
        <b>{{ block_widget(block) }}</b>
    {% endblock %}

Grid Layout Configuring
-----------------------

Basic settings for layout grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In ``layouts/some_theme/layout.yml`` specify:

.. code-block:: yaml

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

    datagrids:
        frontend-some-grid:
    ...

As shown in `layout.yml`, we first need to extend the generic layout block, which is defined in `OroDataGridBundle` (using the `imports` directive). We should also specify `optionName` as `grid_name` and `optionValue` as the grid identifier value defined in `datagrids.yml`.

If we open the generic layout block for the `base` theme (``base/imports/datagrid/layout.yml``), we can see another block related to the datagrid: `datagrid_toolbar`:

.. code-block:: yaml

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


This block renders the grid toolbar. It consists of different blocks like page_size, pagination, sorting, etc., which are also customizable using layouts.

Layout Grid Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^

Layout directives like `visible`, `@move`, `@setOption`, etc. let us configure grid settings and params at the layout level.

For example, we can set block visibility based on some logic using Symfony expression language:

.. code-block:: yaml

    layout:
        actions:
            - '@add':
                id: products
                parentId: page_content
                blockType: datagrid
                options:
                    grid_name: products-grid
                    visible: '=data["feature"].isFeatureEnabled("product_feature")'


``DataGridBundle/Layout/Block/Type/DatagridType.php`` defines additional parameters used for grid rendering:

.. code-block:: php

    'grid_parameters' => [],
    'grid_render_parameters' => [],
    'split_to_cells' => false,

The `split_to_cells` parameter lets us manipulate the grid layout at a more detailed level --- table cells. Its usage is described in :ref:`Grid customization through 'split to cells' option <backend-entities-filters-grid-extension>`.

The other params are defined in the Twig macro `renderGrid` (``DataGridBundle/Resources/views/macros.html.twig``):

- `grid_parameters` - parameters need to be passed to grid request
- `grid_render_parameters` - render parameters need to be set for grid rendering

Suppose we need to change some parameters that affect grid layouts on the **Account > Quotes** frontend page.

Using the :ref:`Layout Developer Toolbar <dev-doc-frontend-layouts-debugging>` in developer mode, we can quickly find the grid layout identifiers: `quotes_datagrid` and `quotes_datagrid_toolbar`. In the `Build Block` view, we can see the `grid_name` parameter: `frontend-quotes-grid`.

Let's change some options for this grid layout.

In ``SaleBundle/Resources/views/layouts/default/imports/oro_sale_quote_grid/layout.yml``, we can specify a CSS class used for grid rendering:

.. code-block:: yaml

    - '@setOption':
        id: __datagrid
        optionName: grid_render_parameters
        optionValue:
            cssClass: 'some-css-class'

If we inspect the HTML page with the grid, we see that a class attribute was added to the div element: `class="some-css-class"`

To pass an extra param to the grid request, let's specify, for example, the `web_catalog_id` context param:

.. code-block:: yaml

    - '@setOption':
        id: __datagrid
        optionName: grid_parameters
        optionValue:
            web_catalog_id: '=context["web_catalog_id"]'

If we perform some actions with the grid, like sorting, we see that the additional request attribute `web_catalog_id` was added:

.. code-block:: none

    ...
    frontend-quotes-grid[originalRoute]:oro_sale_quote_frontend_index
    frontend-quotes-grid[web_catalog_id]:1
    appearanceType:grid
    frontend-quotes-grid[_pager][_page]:1
    frontend-quotes-grid[_pager][_per_page]:25
    ...


Suppose we want to modify the datagrid toolbar. Let's hide the block with page size:

.. code-block:: none

    - '@setOption':
        id: __datagrid_toolbar_page_size
        optionName: visible
        optionValue: false

After refreshing the page, `Page size` will be hidden.

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:

   extensions/mass-action-configuration
