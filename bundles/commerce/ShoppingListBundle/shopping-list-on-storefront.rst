.. _bundle-docs-commerce-shopping-list-bundle-shopping-list-on-storefront:

Shopping List in the Storefront
===============================

A shopping list on a storefront is a controller action templated by :ref:`layout engine <dev-doc-frontend-layouts-layout>` and displaying a **shopping list line items datagrid**. A shopping list in the storefront is presented by two routes and two datagrids:

- **oro_shopping_list_frontend_view** route with the `frontend-customer-user-shopping-list-grid` datagrid represents the "view" version of a shopping list
- **oro_shopping_list_frontend_update** route with the `frontend-customer-user-shopping-list-edit-grid` datagrid represents the "edit" version of a shopping list.

Datagrid Frontend Rendering
---------------------------

Due to the high requirements for performance, **shopping list line items datagrid** skips the backend rendering of cells and utilizes frontend rendering instead. For example:

.. code-block:: yaml
    :caption: config/oro/datagrids.yml

    frontend-customer-user-shopping-list-grid:
        # ...
        columns:
            # ...
            quantity:
                frontend_type: html-template
                frontend_template: tpl-loader!oroshoppinglist/templates/datagrid/cell/quantity.html
            # ...


Datagrid Line Items Data
------------------------

It is impossible to fetch all data needed to be shown in the **shopping list line items datagrid** via the datagrid query, so OroShoppingListBundle introduced the mechanism that enables you to add data for each line item, such as visibility state, validation messages, etc.

The entry point for this mechanism is the datagrid event listener ``\Oro\Bundle\ProductBundle\DataGrid\EventListener\FrontendLineItemsGrid\LineItemsDataOnResultAfterListener`` that listens to the ``\Oro\Bundle\DataGridBundle\Event\OrmResultAfter`` event to collect shopping list line items coming from the datagrid datasource and dispatches in its turn its own event ``oro_product.datagrid_line_items_data``. Every **datagrid line items data listener** of this event gets the ``\Oro\Bundle\ProductBundle\Event\DatagridLineItemsDataEvent`` event object, which can be used to add/modify line items data that will be sent to the frontend.


Datagrid Kit Line Items Data
----------------------------

A product kit line item is a complex structure that, under the hood, consists of **product kit item line items**. The data needed to be collected for regular line items partly intersect with **product kit item line items**, e.g., product name, image, quantity, etc. To make it possible to reuse existing **datagrid line items data listeners**, OroShoppingListBundle introduced a similar mechanism that allows adding data for each **product kit item line item**.

The entry point for this mechanism is the **datagrid line items data listener** ``\Oro\Bundle\ProductBundle\EventListener\DatagridKitLineItemsDataListener`` that dispatches in its turn its own event - ``oro_product.datagrid_kit_item_line_items_data``. Every **datagrid kit item line items data listener** of this event gets the ``\Oro\Bundle\ProductBundle\Event\DatagridKitLineItemsDataEvent`` event object which can be used to add/modify **product kit item line items** data that will be sent to the frontend.
