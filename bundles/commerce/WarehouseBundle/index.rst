.. _bundle-docs-commerce-warehouse-bundle:

Inventory Levels in WarehouseBundle
===================================

The WarehouseBundle provides advanced inventory level management for products across multiple warehouses. Inventory levels can be displayed in the storefront, managed in the back-office, and integrated into search, datagrid results, shopping list, checkout, quick order pages, product view pages, and into the similar, related, and upsell product blocks.

Configuration
-------------

.. note::
   All configuration options below are available on the :ref:`global <configuration--guide--commerce--configuration--inventory--warehouses>`, :ref:`organization <warehouses-organization>`, :ref:`website <warehouses-website>`, :ref:`customer group <user-guide--customers--customer-group--inventory-settings>`, and :ref:`customer <user-guide--customers--inventory-settings>` levels.

Inventory level display is controlled by the following configuration options, available under **System Configuration > Commerce > Inventory > Warehouses**:

- **display_inventory_levels_in_product_listing_and_search_results**: If enabled, inventory levels are shown in product listings and search results.
- **display_inventory_levels_on_product_view_page**: If enabled, inventory levels are shown on product view page.
- **display_inventory_levels_in_shopping_list**: If enabled, inventory levels are shown on shopping list page.
- **display_inventory_levels_during_checkout**: If enabled, inventory levels are shown during checkout steps.
- **display_inventory_levels_on_quick_order_page**: If enabled, inventory levels are shown on quick order page.
- **display_inventory_levels_in_related_products**: If enabled, inventory levels are shown in related products blocks.
- **display_inventory_levels_in_upsell_products**: If enabled, inventory levels are shown in upsell products blocks.
- **display_inventory_levels_in_similar_products_on_product_view_page**: If enabled, inventory levels are shown in similar products blocks on the product view page.
- **display_inventory_levels_in_similar_products_on_shopping_list_page**: If enabled, inventory levels are shown in similar products blocks on the shopping list page.
- **displayed_warehouses**: Controls which warehouses' inventory levels are displayed. Options include:

  - ``all_enabled_warehouses``
  - ``all_enabled_warehouses_with_non_zero_quantity`` (default)
  - ``sum_across_all_enabled_warehouses``
  - ``only_first_enabled_warehouse_with_non_zero_quantity``

.. image:: /user/img/system/config_commerce/inventory/Warehouses.png
   :alt: Global warehouses configuration settings

.. note::
   A new checkbox option **display_inventory_levels** is available for :ref:`product segment content widget <content-widgets-product-segment>`. When enabled (default: true), inventory levels will be displayed in the widget's product listings.


Adding a New Inventory Level Visibility/Formatting Strategy
-----------------------------------------------------------

To add a new strategy for displaying or formatting inventory levels:

1. **Implement the Formatter Interface**

   Create a class that implements ``\Oro\Bundle\WarehouseBundle\Layout\Formatter\InventoryLevelFormatterInterface``. Your class should implement two methods:

   - ``format(array $inventoryLevels): array`` — Accepts an array of inventory levels and returns a formatted array for display.
   - ``isApplicable(): bool`` — Returns true if this formatter should be used for the current configuration.

2. **Register the Formatter as a Service**

   Register your formatter as a service and tag it with ``oro_warehouse.inventory_level_formatter``:

   .. code-block:: yaml

      services:
          my_custom.inventory_level_formatter:
              class: 'Acme\Bundle\MyBundle\Layout\Formatter\MyCustomInventoryLevelFormatter'
              arguments:
                  - '@oro_config.manager'
              tags:
                  - { name: oro_warehouse.inventory_level_formatter }

**Examples of Built-in Formatters**

- ``\Oro\Bundle\WarehouseBundle\Layout\Formatter\AllWarehousesInventoryLevelFormatter``: Displays inventory levels for all warehouses.
- ``\Oro\Bundle\WarehouseBundle\Layout\Formatter\NonZeroQuantityInventoryLevelFormatter``: Displays inventory levels only for warehouses with non-zero quantity.

See the source code for more examples and implementation details.

Displaying Inventory Levels in Layouts
--------------------------------------

To display inventory levels in layouts, use the ``\Oro\Bundle\WarehouseBundle\Layout\DataProvider\InventoryLevelsDataProvider``:

This provider fetches and formats inventory levels for the given product IDs, taking into account enabled warehouses and configuration.

Getting Formatted Inventory Levels in PHP
-----------------------------------------

To get formatted inventory levels in PHP code, use the ``\Oro\Bundle\WarehouseBundle\Provider\WarehouseInventoryLevelProvider``:

.. code-block:: php

   $formattedLevels = $warehouseInventoryLevelProvider->getFilteredFormattedInventoryLevels($scalarInventoryLevels);

This is commonly used in event listeners, such as ``\Oro\Bundle\WarehouseBundle\EventListener\Datagrid\InventoryLevelsOnProductListingDatagridListener``, to add inventory data to datagrids or other data sources.

Performance Considerations
--------------------------

- Inventory levels are managed as associative arrays indexed by product IDs (e.g., `[123 => [...], 456 => [...]]`) rather than simple enumerated arrays or hydrated entity objects. This structure allows for efficient lookups and direct mapping of inventory data to products, especially when handling large datasets.

.. note::
   Inventory levels are always loaded for upsell, related, similar products, and product segments, but are only displayed if the corresponding configuration or content widget option is enabled. This ensures flexibility in display but may have performance implications when handling large product collections.

Recalculation Triggers
----------------------

Inventory levels are automatically recalculated in the search index when:

- The enabled warehouses configuration changes.
- Inventory level quantities are updated.
- "main" websitesearch reindex event is triggered.

This ensures that displayed and indexed inventory data is always up to date.

.. note::
   For more details, see the implementation in the ``\Oro\Bundle\WarehouseBundle\EventListener\WebsiteSearch\InventoryLevelsIndexerListener`` and related event listeners.

.. include:: /include/include-links-dev.rst
   :start-after: begin
