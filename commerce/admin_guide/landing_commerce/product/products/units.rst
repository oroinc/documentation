.. _sys--commerce--product--product-units:

Configure Product Units
-----------------------

.. begin

In the system configuration, you are in control of the product unit options that apply system-wide. You may:

* Select the rounding algorithm for product units.
* Enable/disable the single unit mode for all products and toggle visibility of the unit code.
* Select the primary unit and its precision.

To update the product unit settings:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Product Unit** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens.

.. image:: /admin_guide/img/configuration/product/product_unit/ProductUnit.png
   :class: with-border

The following options are available:

   * **Unit Rounding Type** -- An algorithm that is used to round the volume specified for this unit (ceil, floor, half down, or half up).
   * **Single Unit** -- When enabled, it limits the product unit to just one default value and restricts adding new product units.
   * **Show Unit Code** -- When enabled, the unit appears next to the requested quantity; when disabled, the unit name is hidden and only quantity is displayed. This option is available only when the **Single Unit** is enabled. 
   * **Default Primary Unit** -- The product unit that is shown by default in the website.
   * **Default Primary Unit Precision** -- The number of digits after the floating point that limits the Primary unit precision (e.g., 1 for 0.x, 2 for 0.xx, 3 for 0.xxx and so on).

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Enter the updated quantity.

4. Click **Save**.

.. finish
