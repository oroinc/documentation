:oro_documentation_types: OroCommerce

.. _user-guide--taxes--tax-configuration:


Tax Calculation
^^^^^^^^^^^^^^^

.. begin

.. important:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

By default, OroCommerce calculates tax using a rate defined in the built-in tax rule for the default shipping origin address.

To customize the following tax calculation settings that impact the way OroCommerce implies tax in the order or quote, perform the following steps:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Taxation > Tax Calculation** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/taxation/TaxCalculation.png
      :alt: Global tax calculation configuration

   .. note:: Remember to clear the **Use default** check box before setting a custom option.

3. In the **Enable Taxation** section, enable or disable taxation by setting or clearing the **Enabled** box. Whenever you use the built-in or third-party tax provider, the taxation should be enabled.

4. In the **Tax Provider** section, select the required tax provider. The **Built-in Table Rates** option is the default one that specifies that you use the OroCommerce tax management functionality. You can also use an external tax management and compliance system, like AvaTax or Vertex, as a tax provider with some customization. In such case, select your custom tax management system.

5. In the **Calculator** section, select whether to pply taxes per single item in the purchase order or per total for the requested amount of the items of same kind. This may minimize roundoff accumulated error and guard you and your customers against over or under paying.

   a) For the **Start Calculation With** option, specify the formula for tax calculation. Tax is calculated either for a unit price or for a product total price. The formula for *Unit price* is:
      tax = [ ( unit price * tax rate ) * unit quantity ] + ... + [ ( unit price * tax rate ) * unit quantity ].
      The formula for *Row Total* is:
      tax = [ (unit price * unit quantity) * tax rate ] + ... + [ (unit price * unit quantity) * tax rate ].
   b) For the **Start Calculation On** option, select when the rounding off should happen. For **Item**, the taxable amount is rounded up for every item. For **Total**, the total tax is aggregated as is, and the final amount is rounded up.

   c) Set or clear the **Product prices include tax** option. When product prices include tax, the tax amount is subtracted from the unit, product, or total price. Otherwise, the tax is added on top of the unit, product, or total price. See the :ref:`use cases <tax-concept-guide-tax-rules-in-use>` in the Tax Management concept guide.

6. In the **Matcher** section:

   a) Configure how OroCommerce selects the core jurisdiction for which tax rules should be applied in a purchase order tax calculation. Tax jurisdiction may be defined by either shipping origin, billing address or shipping destination for your home state:

      * For the origin-based jurisdiction, select **Shipping Origin** and define the default address in the Origin section below.

      * For the destination-based jurisdiction, select **Destination** and define the whether to use the shipping address or billing to as a reference for calculating the customers's local tax rate in the Destination field.

      .. image:: /user/img/system/config_commerce/taxation/tax_jur_configuration.png
         :alt: Global tax jurisdiction configuration

   b) Set up any tax jurisdiction exceptions - countries and states where tax jurisdiction selection deviates from the core rule. For example, when the main tax jurisdiction is at the sale shipping destination, the exception may be for some countries and states to use shipping origin instead. Click **+ Add**, select a country, type in a state or a region and select the alternative tax jurisdiction base.

   c) If you use destination as tax jurisdiction base by default or for any exclusions, select either **Shipping Address** or **Billing Address** as **Destination**.

7. In the **Origin** section, provide the origin address (e.g. location of your warehouse or the company legal address) that will be used system-wide for origin-based tax. When the shipping origin is a core jurisdiction, OroCommerce will use the address provided here to find the matching built-in tax jurisdiction rules for tax calculation.

8. Click **Save**.

