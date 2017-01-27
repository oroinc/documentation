Configuring Product Options
---------------------------

.. begin

You can control the way product inventory is managed for every product in the OroCommerce product catalog.

To customize the default product inventory options:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Inventory > Product Options** in the menu to the left.
   The following page opens:

   .. image:: /user_guide/img/system/configuration/inventory/product_options.png
      :class: with-border

   The following table describes the options available on the page:

   +---------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Name                | Description                                                                                                                                                                                                                                                                                |
   +=====================+============================================================================================================================================================================================================================================================================================+
   | Managed Inventory   | This options indicates whether the product inventory is handled by OroCommerce vs external application.                                                                                                                                                                                    |
   +---------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Inventory Threshold | A minimum quantity of the product that is treated as *In stock*. When a product quantity reaches this threshold value, the product inventory status fallback to *Out Of Stock*.                                                                                                            |
   +---------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Backorders          | A flag that indicates whether OroCommerce accepts backorders. When set to yes, buyers and sales people can order products in the quantities that are not currently available in the warehouses. The remaining portion of the order will be sustained until the product gets back in stock. |
   +---------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Decrement Inventory | A flag that indicates whether OroCommerce decrements inventory upon order. When both **Decrement Inventory** and **Backorders** are enabled, product quantity may get negative.                                                                                                            |
   +---------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select **Yes/No** for the flag-like options, and type in the updated value for the threshold-like options.

4. Click **Save**.

.. comment FIXME Clarify Managed Inventory purpose. 