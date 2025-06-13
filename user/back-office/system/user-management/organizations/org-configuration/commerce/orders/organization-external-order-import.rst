.. _configuration--commerce--orders--external-order-import--org:

Configure External Order Import Settings per Organization
=========================================================

.. hint:: The External Order Import feature can be enabled :ref:`globally <system-configuration-orders-external-order-import>` and per organization.


The External Order Import feature enables administrators to access a complete order history by importing legacy orders in JSON format. This feature is especially useful for businesses migrating from ERP systems or consolidating historical data.

.. important:: Please consider the following when working with imported external orders:

    * This feature supports **import only**. Export of legacy order data is not available.
    * Imported orders are marked as **This order has been imported from the ERP**. Administrators cannot edit these orders after import.
    * Tax calculations, promotional discounts, and payment transactions are not available for legacy orders.
    * All order line items are imported as *free-form line items*. They will link to products only if the product SKU in the import file matches an existing product SKU.
    * Line items without matching SKUs will still be imported but may not be accurately reflected in *Previously Purchased* widgets, *Best Sellers* reports, or similar analytics.

To enable this feature per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Orders > External Order Import** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **External Order Import** section:

   a) Clear the **Use Default** checkbox to adjust the system settings.
   b) Select the checkbox next to **Enable JSON Order Import** to enable the feature.
   c) Once enabled, the **Import file** button appears on the Open Orders page in the back-office for administrators to :ref:`upload a JSON file containing the legacy order data <user-guide--sales--orders--external-orders-import>`. A sample file is available for download to guide formatting and structure.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin