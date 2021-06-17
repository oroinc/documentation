:oro_documentation_types: OroCommerce

.. _user-guide--taxes--org--promotions:

Tax Calculation
===============

.. note:: This Tax Calculation configuration option is also available on the :ref:`global <user-guide--taxes--tax-configuration>` level.

You can control whether you want to calculate taxes before or after discounts are applied at the storefront checkout and when creating orders from the back-office:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.

3. Select **Commerce > Taxation** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/user_management/org_configuration/taxation/tax-calculation-org.png
   :alt: Calculate Taxes After Promotions configuration option on organization level

4. You can enable or disable the **Calculate Taxes After Promotions** option. Select the check box if you wish to have your taxes calculated on the :ref:`reduced price <user-guide--marketing--promotions>` after the discounts are applied. If this option is disabled, taxes are calculated based on the full price before the discounts are applied.

  .. note:: When a discount applies to the entire order, it is proportionally distributed among all line items and subtracted from the subtotal of each of them. Tax is calculated for each taxable line item after that.

     For example:

     * Line item 1 subtotal = 1000$
     * Line item 2 subtotal = 100$
     * Total discount amount = 10$
     * Tax = 10%

     Discount distribution among all line items:

     * Line item 1 discount amount = (1000 * 10) / (1000 + 100) = 9.09$
     * Line item 2 discount amount = (100 * 10) / (1000 + 100) = 0.91$

     Taxes for line items:

     * Taxable Line item 1 tax: (1000$ - 9.09$) * 0.1 = 99.091$
     * Taxable Line item 2 tax: (100$ - 0.91$) * 0.1 = 9.909$
     * Total tax amount after discounts: 99.091$ + 9.909$ = 109$

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin