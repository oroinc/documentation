.. _user-guide--taxes--tax-configuration:

Configure Global Tax Calculation Settings
=========================================

.. hint:: This section is part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides a general understanding of the tax configuration and management in OroCommerce.

By default, OroCommerce calculates tax using a rate defined in the built-in tax rule for the default shipping origin address.

To customize the following tax calculation settings that impact the way OroCommerce implies tax to orders, perform the following steps:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Taxation > Tax Calculation** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/taxation/TaxCalculation.png
   :alt: Global tax calculation configuration

3. To customize the option configuration, clear the **Use Default** checkbox next to the option and select or type in the new option value.

4. Click **Reset** at the top right to roll back any changes to the tax calculation settings.

5. Click **Save Settings** to save the changes.


Enable Taxation
---------------

In the **Enable Taxation** section, enable or disable taxation by setting or clearing the **Enabled** box. Whenever you use the built-in or third-party tax provider, the taxation should be enabled.

Tax Provider
------------

In the **Tax Provider** section, select the required tax provider. The **Built-in Table Rates** option is the default one that specifies that you use the OroCommerce tax management functionality. You can also use an external tax management and compliance system, like AvaTax or Vertex, as a tax provider with some customization. In this case, select your custom tax management system.

Tax Calculator
--------------

In the **Calculator** section, select whether to apply taxes to each individual item in the purchase order or to the total amount for items of the same kind. This approach helps minimize rounding errors and ensures accurate calculations, protecting both you and your customers from overpayment or underpayment.

.. hint:: For more information on price calculation precision and the different types of pricing rounding, refer to the :ref:`Pricing Settings <sys--config--commerce--catalog--pricing-rounding>` documentation.

Start Calculation With
^^^^^^^^^^^^^^^^^^^^^^

**Start Calculation With** - The option allows you to specify how taxes should be calculated — either per **Unit Price** or based on the **Row Total** (total price for all units of the same product).

* **Unit Price Formula** --- This setting calculates taxes at the **unit level** before summing them up for the entire order. It multiplies the :ref:`rounded price <sys--config--commerce--catalog--pricing-rounding>` of a single unit by the tax rate and then by the quantity. This method ensures that each unit's tax is computed individually. The parentheses ``()`` in the formula denote where rounding is applied.

+----------------------------------------------------------------------------------------------------------------------+
|                                                                                                                      |
|  ``Total Tax = [(Unit Price) x Tax Rate x Unit Quantity] + ... + [(Unit Price) x Tax Rate x Unit Quantity]``         |
|                                                                                                                      |
+----------------------------------------------------------------------------------------------------------------------+

* **Row Total Formula** --- This setting calculates taxes based on the **row total** (the total price for all units of the product) rather than the unit price. It first multiplies the unit price by the quantity to get the total price for that product, rounds the result :ref:`based on the configuration <sys--config--commerce--catalog--pricing-rounding>` and then applies the tax rate. The parentheses ``()`` in the formula denote where rounding is applied.

+----------------------------------------------------------------------------------------------------------------------+
|                                                                                                                      |
|  ``Total Tax = [(Unit Price x Unit Quantity) x Tax Rate] + ... + [(Unit Price x Unit Quantity) x Tax Rate]``         |
|                                                                                                                      |
+----------------------------------------------------------------------------------------------------------------------+


.. image:: /user/img/system/config_commerce/taxation/start-calculation-with.png
   :alt: Start Calculation With configuration option

Start Calculation On
^^^^^^^^^^^^^^^^^^^^

**Start Calculation On** --- The option specifies when additional rounding is applied during the tax calculation process. For **Item**, the taxable amount is rounded up for every item individually and then summed up. For **Total**, the total tax is aggregated as is, and the final amount is rounded up.

.. image:: /user/img/system/config_commerce/taxation/start-calculation-on.png
   :alt: Start Calculation On configuration option

Let's illustrate the calculation and rounding logic using the following example:

.. csv-table::
    :header: "Product", "Price", "Quantity", "Tax Rate", "Rounding Precision", "Pricing Rounding Type"

    "A", "$0.005", "100", "9% (0.09)", "2 decimal places", "Half Up"
    "B", "$23.575", "100", "9% (0.09)", "2 decimal places", "Half Up"
    "C", "$55.555", "100", "9% (0.09)", "2 decimal places", "Half Up"

Calculation Examples
^^^^^^^^^^^^^^^^^^^^

**Example 1: Start Calculation With = Unit Price** and **Start Calculation On = Item**

Tax is calculated for each unit of the product individually, rounded based on configuration, and then summed up to determine the total tax. The parentheses ``()`` in the formula denote where rounding is applied.

.. parsed-literal::

    **Unit Price Formula:**

    ``Total Tax = [((Unit Price) x Tax Rate x Unit Quantity)] + ... + [((Unit Price) x Tax Rate x Unit Quantity)]``

    * Tax per unit (Product A) = ((0.005) x 0.09 x 100) = (0.01 x 0.09 x 100) = **(0.09)** = **0.09**
    * Tax per unit (Product B) = ((23.575) x 0.09 x 100) = (23.58 x 0.09 x 100) = **(212.22)** = **212.22**
    * Tax per unit (Product C) = ((5.555) x 0.09 x 100) = (55.56 x 0.09 x 100) = **(500.04)** = **500.04**

    * **Total Tax = 0.09 + 212.22 + 500.04 = 712.35**

.. image:: /user/img/system/config_commerce/taxation/unit-price-item-config-sf.png
   :alt: Illustration showing tax calculation for products A,B, and C on the checkout storefront page following the Example 1 configuration

.. image:: /user/img/system/config_commerce/taxation/unit-price-item-config-bo.png
   :alt: Illustration showing tax calculation for products A,B, and C on the order view page in the back-office

.. hint:: Keep in mind that in the back-office, tax amounts are always rounded to 2 decimal places, regardless of the tax calculation formula or price precision settings. This approach ensures compliance with regulations in many countries that require displaying taxes per unit. Additionally, since most jurisdictions mandate rounding for tax filings, small discrepancies may arise between the tax collected and the amount reported.

**Example 2: Start Calculation With = Unit Price** and **Start Calculation On = Total**

Tax is calculated for each unit of the product individually, summed up as is, and the final amount is rounded up. The parentheses ``()`` in the formula denote where rounding is applied.

.. parsed-literal::

    **Unit Price Formula:**

    ``Total Tax = ( [(Unit Price) x Tax Rate x Unit Quantity] + ... + [(Unit Price) x Tax Rate x Unit Quantity] )``

    * Tax per unit (Product A) = (0.005) x 0.09 x 100 = 0.01 x 0.09 x 100 = **0.09**
    * Tax per unit (Product B) = (23.575) x 0.09 x 100 = 23.58 x 0.09 x 100 = **212.22**
    * Tax per unit (Product C) = (5.555) x 0.09 x 100 = 55.56 x 0.09 x 100 = **500.04**

    * **Total Tax = (0.09 + 212.22 + 500.04) = (712.35) = 712.35**


.. image:: /user/img/system/config_commerce/taxation/unit-price-total-config-sf.png
   :alt: Illustration showing tax calculation for products A,B, and C on the checkout storefront page following the Example 2 configuration

.. image:: /user/img/system/config_commerce/taxation/unit-price-total-config-bo.png
   :alt: Illustration showing tax calculation for products A,B, and C on the order view page in the back-office

.. hint:: Keep in mind that in the back-office, tax amounts are always rounded to 2 decimal places, regardless of the tax calculation formula or price precision settings. This approach ensures compliance with regulations in many countries that require displaying taxes per unit. Additionally, since most jurisdictions mandate rounding for tax filings, small discrepancies may arise between the tax collected and the amount reported.


**Example 3: Start Calculation With = Row Total** and **Start Calculation On = Item**

Tax is calculated for the total row amount first, then the tax is applied to the entire amount. The tax is then rounded based on configuration and summed up to determine the total tax. The parentheses ``()`` in the formula denote where rounding is applied.

.. parsed-literal::

    **Row Total Formula:**

    ``Total Tax = [((Unit Price x Unit Quantity) x Tax Rate)] + ... + [((Unit Price x Unit Quantity) x Tax Rate)]``

    * Tax per unit (Product A) = ((0.005 x 100) x 0.09) = ((0.5) x 0.09) = (0.5 x 0.09) = **(0.045)** = **0.05**
    * Tax per unit (Product B) = ((23.575 x 100) x 0.09) = ((2357.5) x 0.09) = (2357.5 x 0.09) = **(212.175)** = **212.18**
    * Tax per unit (Product C) = ((55.555 x 100) x 0.09) = ((5555.5) x 0.09) = (5555.5 x 0.09) = **(499.995)** = **500**

    * **Total Tax = 0.05 + 212.18 + 500 = 712.23**

.. image:: /user/img/system/config_commerce/taxation/row-total-item-config-sf.png
   :alt: Illustration showing tax calculation for products A,B, and C on the checkout storefront page following the Example 3 configuration

.. image:: /user/img/system/config_commerce/taxation/row-total-item-config-bo.png
   :alt: Illustration showing tax calculation for products A,B, and C on the order view page in the back-office

.. hint:: Keep in mind that in the back-office, tax amounts are always rounded to 2 decimal places, regardless of the tax calculation formula or price precision settings. This approach ensures compliance with regulations in many countries that require displaying taxes per unit. Additionally, since most jurisdictions mandate rounding for tax filings, small discrepancies may arise between the tax collected and the amount reported.

**Example 4: Start Calculation With = Row Total** and **Start Calculation On = Total**

Tax is calculated for the total row amount first, then the tax is applied to the entire amount, summed up as is, and the final amount is rounded up. The parentheses ``()`` in the formula denote where rounding is applied.

.. parsed-literal::

    **Row Total Formula:**

    ``Total Tax = ( [(Unit Price x Unit Quantity) x Tax Rate] + ... + [(Unit Price x Unit Quantity) x Tax Rate] )``

    * Tax per unit (Product A) = (0.005 x 100) x 0.09 = (0.5) x 0.09 = 0.5 x 0.09 = 0.045
    * Tax per unit (Product B) = (23.575 x 100) x 0.09 = (2357.5) x 0.09 = 2357.5 x 0.09 = 212.175
    * Tax per unit (Product C) = (55.555 x 100) x 0.09 = (5555.5) x 0.09 = 5555.5 x 0.09 = 499.995

    * **Total Tax = (0.045 + 212.175 + 499.995) = (712.215) = 712.22**

.. image:: /user/img/system/config_commerce/taxation/row-total-total-config-sf.png
   :alt: Illustration showing tax calculation for products A,B, and C on the checkout storefront page following the Example 4 configuration

.. image:: /user/img/system/config_commerce/taxation/row-total-total-config-bo.png
   :alt: Illustration showing tax calculation for products A,B, and C on the order view page in the back-office

.. hint:: Keep in mind that in the back-office, tax amounts are always rounded to 2 decimal places, regardless of the tax calculation formula or price precision settings. This approach ensures compliance with regulations in many countries that require displaying taxes per unit. Additionally, since most jurisdictions mandate rounding for tax filings, small discrepancies may arise between the tax collected and the amount reported.

Product Prices Include Tax
^^^^^^^^^^^^^^^^^^^^^^^^^^

**Product Prices Include Tax** --- The option determines whether taxes are already included in the product prices or need to be added on top. When product prices include tax, product prices displayed to customers **already include the tax amount**. During checkout, the system calculates the tax portion within the price and subtracts it from the unit, product, or total price. Otherwise, the tax is added on top of the unit, product, or total price.

**Example 1: Product Prices Include Tax = True**

To illustrate the tax portion calculation, let's consider an example, where the product price is listed as $10.00, and the tax rate is 10% (0.1).

.. parsed-literal::

    **The formula to calculate the tax portion in a product price is:**

    ``Tax Portion Formula: Tax = (Price Including Tax x Tax Rate) / (1 + Tax Rate)``

    ``Base Price = Price Including Tax - Tax``

    * Tax Portion (Product A) = (10 x 0.1) / (1 + 0.1) = 1 / 1.1 = **0.91**
    * Price Without Tax (Product A) = 10 - 0.91 = **9.09**

The setting applies when you want to **include the taxes** to the product prices and display the *final price* to your customers when they browse the storefront. In this case, you have to create related price lists that would reflect the prices with taxes per each customer individually, depending on their local tax rates.

With this configuration, the tax is just displayed as a reference and is not charged twice.

.. image:: /user/img/system/config_commerce/taxation/price-including-tax.png
   :alt: Order summary showing Product A's tax-included price with no change to the final total

**Example 2: Product Prices Include Tax = False**

When product prices **do not include the tax amount**, the tax is calculated and added on top during checkout based on the **Start Calculation With** and **Start Calculation On** settings described previously. In our case, the product price is listed as $10.00 (tax-excluded), and the tax rate is 10%; the tax is added on top, increasing the order total.

.. image:: /user/img/system/config_commerce/taxation/price-excluding-tax.png
   :alt: Order summary showing Product A's tax-excluded price with taxes added on top of the price changing the final total

.. note:: See also the :ref:`use cases <tax-concept-guide-tax-rules-in-use>` in the Tax Management concept guide.


Matcher
-------

In the **Matcher** section:

1. Configure how OroCommerce selects the core jurisdiction for which tax rules should be applied in a purchase order tax calculation. Tax jurisdiction may be defined by either shipping origin, billing address, or shipping destination for your home state:

* For the origin-based jurisdiction, select **Origin** and define the default address in the Origin section below.

* For the destination-based jurisdiction, select **Destination** and define whether to use the shipping address or billing as a reference for calculating the customer's local tax rate in the Destination field.

.. image:: /user/img/system/config_commerce/taxation/tax_jur_configuration.png
   :alt: Global tax jurisdiction configuration

2. Set up any tax jurisdiction exceptions - countries and states where tax jurisdiction selection deviates from the core rule. For example, when the main tax jurisdiction is at the sale shipping destination, the exception may be for some countries and states to use shipping origin instead. Click **+ Add**, select a country, type in a state or a region, and select the alternative tax jurisdiction base.

3. If you use destination as tax jurisdiction base by default or for any exclusions, select either **Shipping Address** or **Billing Address** as **Destination**.

4. In the **Address Resolver Granularity**, define what information the tax resolver should consider when matching addresses against tax jurisdictions for the tax to be calculated properly and applied accordingly. There are several options:

* *Only Country* --- Tax jurisdiction should contain only country. The region and zip code fields should be empty, or no  tax will be applied.
* *Only Country and Region* --- Tax jurisdiction should contain country and region. Zip code should be empty, otherwise no tax will be applied, even if the shipping address contains the country and region that match the tax jurisdiction.
* *Only Country and Zip* --- Tax jurisdiction should contain country and zip code. The region field is ignored even if it is mentioned in the address. Tax is applied anyway, regardless of whether region is defined or not.
* *Country, Region and Zip* --- Tax jurisdiction should contain all data (Country, Region, and Zip code) for the tax to be applied.

Origin
------

In the **Origin** section, provide the origin address (e.g. location of your warehouse or the company legal address) that will be used system-wide for origin-based tax. When the shipping origin is a core jurisdiction, OroCommerce will use the address provided here to find the matching built-in tax jurisdiction rules for tax calculation.

Promotions
----------

In the **Promotions** section, select the **Calculate Taxes After Promotions** checkbox, if you wish to have your taxes calculated on the :ref:`reduced price <user-guide--marketing--promotions>` after the discounts are applied. If this option is disabled, taxes are calculated based on the full price before the discounts are applied. This configuration option is also available on the :ref:`organization configuration level <user-guide--taxes--org--promotions>`.

When a discount applies to the entire order, it is proportionally distributed among all items based on their subtotals. Tax is then calculated for each item after the discount is subtracted.

For example:

.. csv-table::
    :header: "Line Item", "Line Item Subtotal", "Discount Amount", "Tax Rate", "Rounding Precision", "Pricing Rounding Type"

    "Product A", "$1000", "$10", "10% (0.1)", "2 decimal places", "Half Up"
    "Product B", "$100", "$10", "10% (0.1)", "2 decimal places", "Half Up"

Discount distribution among line items following the formula:

.. parsed-literal::

    ``Line Item Discount = (Line Item Subtotal x Discount Amount) / Total Order Subtotal``

    * Product A discount amount = (1000 * 10) / (1000 + 100) = 10000 / 1100 = $9.09
    * Product B discount amount = (100 * 10) / (1000 + 100) = 1000 / 1100 = $0.91

Taxes per line item:

.. parsed-literal::

    ``Line Item Tax = (Line Item Subtotal - Line Item Discount) x Tax Rate``

    * Tax for Product A: ($1000 - $9.09) * 0.1 = $99.091 = Round(99.091) = $99.09
    * Taxable Product A tax: ($100 - $0.91) * 0.1 = $9.909 = Round(9.909) = $9.91
    * Total tax amount after discounts: $99.09 + $9.91 = $109


