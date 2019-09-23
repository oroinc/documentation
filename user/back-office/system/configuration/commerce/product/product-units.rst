.. _sys--commerce--product--product-units:

Product Units
=============

In the system configuration, you are in control of the product unit options that apply system-wide. You may:

* Select the rounding algorithm for product units.
* Enable/disable the single unit mode for all products and toggle visibility of the unit code.
* Select the primary unit and its precision.

To update the product unit settings:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Product Unit** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/product/ProductUnit.png
      :alt: The product units configuration page
      :class: with-border

The following options are available:

   * **Unit Rounding Type** -- An algorithm that is used to round the volume specified for this unit (ceil, floor, half down, or half up).
   * **Single Unit** -- When enabled, it limits the product unit to just one default value and restricts adding new product units. This setting must be enabled at the very beginning of the production mode, so that no additional units of quantity could be added to products. 
   
     .. .. note:: If you start using several product units in the system with Single Unit mode disabled but then enabled this mode later on, no changes will be applied to the behavior of product units in the system. You will be able to continue using the product units that have been configured previously. 

   * **Show Unit Code** -- When enabled, the unit appears next to the requested quantity; when disabled, the unit name is hidden and only quantity is displayed. This option is available only when the **Single Unit** is enabled. 
   * **Default Primary Unit** -- The product unit that is shown by default in the website.
   * **Default Primary Unit Precision** -- The number of digits after the floating point that limits the Primary unit precision (e.g., 1 for 0.x, 2 for 0.xx, 3 for 0.xxx and so on).

.. note:: Please keep in mind that when importing products into the application the *Product Single Unit Mode* setting is not checked. This means that even if the *Single Unit* setting is enabled, the admin can still create and import products with additional product units using API. In addition, if *Single Unit* is enabled and *Show Unit Code* is disabled, unit codes are not displayed anywhere, except for the product page and shopping list bucket.

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Enter the updated quantity.

4. Click **Save**.

**Related Articles**

* :ref:`Product Units in Use <user-guide--products--product-units-in-use>`

