.. _system-configuration-orders-external-order-import:

Configure Global External Order Import Settings
===============================================

.. note:: The feature is available as of OroCommerce version 6.1.2.

.. hint:: The External Order Import feature can be enabled globally and :ref:`per organization <configuration--commerce--orders--external-order-import--org>`.

The External Order Import feature enables administrators to access a complete order history by importing legacy orders in JSON format. This feature is especially useful for businesses migrating from ERP systems or consolidating historical data.

.. important:: Please consider the following when working with imported external orders:

    * This feature supports **import only**. Export of legacy order data is not available.
    * Imported orders are marked as **This order has been imported from the ERP**. Administrators cannot edit these orders after import.
    * Tax calculations, promotional discounts, and payment transactions are not available for legacy orders.
    * All order line items are imported as *free-form line items*. They will link to products only if the product SKU in the import file matches an existing product SKU.
    * Line items without matching SKUs will still be imported but may not be accurately reflected in *Previously Purchased* widgets, *Best Sellers* reports, or similar analytics.

.. image:: /user/img/system/config_commerce/order/external-order-import.png
   :alt: External Order Import configuration settings and the appeared Import File button on the Orders page

To enable this feature globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Orders > External Order Import** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **External Order Import** section:

   a) Clear the **Use Default** checkbox to adjust the system settings.
   b) Select the checkbox next to **Enable JSON Order Import** to enable the feature.
   c) Once enabled, the **Import file** button appears on the Open Orders page in the back-office for administrators to :ref:`upload a JSON file containing the legacy order data <user-guide--sales--orders--external-orders-import>`. A sample file is available for download to guide formatting and structure.

4. Click **Save Settings**.

.. include:: /include/include-links-user.rst
   :start-after: begin