.. _org--conf--commerce--taxation--shipping-tax:

.. System > Configuration > Commerce > Taxation > Shipping Tax

Configure Global Shipping Tax Settings
======================================

.. hint:: This section is part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides a general understanding of the tax configuration and management in OroCommerce.

You can select a shipping tax code that should be used for shipping total cost calculation and specify if the shipping cost already contains a tax.

To change the shipping tax configuration:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.

3. Select **Commerce > Taxation > Shipping** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use System** checkbox to change the global setting.

5. In the **Shipping Tax** section, configure the options:

   * **Tax Code** - Select the tax code (tax identifier) that in combination with :ref:`tax rules <tax-rules>` defines the tax rate that is applied for the shipping tax calculation.

   * **Shipping Rates Include Tax** - Enable the checkbox to avoid charging taxes on shipping twice if the shipping rates provided by the shipping carrier(s) or entered manually in the back-office already include tax.

6. Click **Save**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin