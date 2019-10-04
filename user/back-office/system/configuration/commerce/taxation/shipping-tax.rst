:oro_documentation_types: commerce

.. _sys--conf--commerce--taxation--shipping-tax:

.. System > Configuration > Commerce > Taxation > Shipping Tax

Shipping
--------

.. begin

You can select a shipping tax code that should be used for shipping total cost calculation and specify if the shipping cost already contains a tax.

To change the shipping tax configuration:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Taxation > Shipping** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/taxation/shipping_tax_config.png
      :class: with-border

   The following options are available on the page:

   * Tax Code - a tax identifier that in combination with :ref:`tax rules <tax-rules>` defines the tax rate that is applied for the shipping tax calculation.

   * Shipping Rates Include Tax - select the box to avoid adding the calculated shipping tax to the shipping cost.

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Modify the tax code list: click **x** to remove the item, type in the new code value and press **Enter**.
     c) Select/deselect the **Shipping Rates Include Tax** option.

4. Click **Save**.