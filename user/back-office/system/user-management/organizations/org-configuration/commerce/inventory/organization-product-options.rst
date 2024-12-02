.. _sys--conf--commerce--inventory--product-options--organization:

Configure Product Options Settings per Organization
===================================================

To customize the default product options per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Inventory > Product Options** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/inventory/product_options_org.png
      :alt: Product options configuration per organization

4. To customize both inventory and upcoming products options, clear the **Use System** checkbox next to the option and select the required value.


   **Product Inventory Options**

    .. csv-table::
       :header: "Name", "Description"
       :widths: 30, 60

       "**Managed Inventory**","This options indicates whether the product inventory is handled by OroCommerce vs external application."
       "**Inventory Threshold**","A minimum quantity of the product that is treated as *In stock*. When a product quantity reaches this threshold value, the product inventory status falls back to *Out Of Stock*."
       "**Backorders**","A flag that indicates whether OroCommerce accepts backorders (available for the Enterprise edition only). When set to yes, buyers and sales people can order products in the quantities that are not currently available in the warehouses. The remaining portion of the order will be sustained until the product gets back in stock."
       "**Decrement Inventory**","A flag that indicates whether OroCommerce decrements inventory upon order. When both **Decrement Inventory** and **Backorders** are enabled, product quantity may get negative."
       "**Highlight Low Inventory**","This option indicates whether wholesale buyers are able to see that there might not be enough product left in stock for their purchase."
       "**Low Inventory Threshold**","The minimum stock level defined for the product. Reaching the defined level will trigger a warning message to the buyer in the storefront."



   **Upcoming Products**

   **Hide Labels Past Availability Date** - When enabled, the label for the upcoming products will be removed automatically once the availability date has passed. If the option is disabled, the label will remain displayed as long as the product is marked as upcoming regardless of its availability date.


5. Click **Save Settings**.


.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin


