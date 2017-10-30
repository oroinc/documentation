Create a Tax Rule
~~~~~~~~~~~~~~~~~

.. note::
    See a short demo on `how to create tax rules in OroCommerce <https://www.orocommerce.com/media-library/create-tax-rules>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/Ma0JOwn9VVs" frameborder="0" allowfullscreen></iframe>

To create tax rules for a particular tax jurisdiction:

1. `Create a tax jurisdiction <./tax-jurisdictions/create>`_ (country, state and a range of zip codes) where a special taxation rules apply.

2. Create customer tax codes for every group of buyers that have fixed tax rates in this tax jurisdiction. :ref:`Link the customer groups to their respective tax codes <user-guide--taxes--link-a-tax-code-to-a-customer>`.

3. Create product tax codes for every group of products that have fixed tax rates in this tax jurisdiction. Ensure that these tax codes are :ref:`assigned to the products <user-guide--taxes--link-a-tax-code_to_a_product>`.

4. Create all `the tax rates <./taxes/create>`_ defined by the tax jurisdiction for the customers you are serving and products you are selling.

5. Finally, for every valid combination of the tax rates, product types and customer types, create a tax rule:

     a) Navigate to **Taxes > Tax Rules** and click **Create Tax Rule**.

        .. image:: /user_guide/img/taxes/tax_rules/CreateTaxRule_TaxRules_Taxes_drop.png

     b) In the lists select the Account Tax Code (customer tax code), product tax code, tax jurisdiction, and tax (tax rate). Optionally, add description of the tax rate applied.

     c) Click **Save** or **Save and Close**.

.. stop
