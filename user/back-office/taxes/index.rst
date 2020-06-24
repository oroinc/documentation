:oro_documentation_types: OroCommerce

:title: Taxes Management in the OroCommerce Back-Office

.. meta::
   :description: Tax rules configuration and management guides for the OroCommerce back-office users

.. _user-guide--taxes:

Manage Taxes in the Back-Office
===============================

.. hint:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

Tax rules help OroCommerce find the correct tax rate that should be used for the products listed in the purchase order by matching the product tax code that indicates:

* Tax status of the product
* Customer tax code that indicates the tax status of the buying company
* Tax jurisdiction where the tax is due

OroCommerce supports a tax exemption mechanism: you can set a zero tax rate for some customers and/or products.

A :ref:`tax rule <tax-rules>` binds the following items:

* :ref:`Customer tax code <user-guide--taxes--customer_tax_codes>` - a label for a customer or customer group that follows similar taxation rules in at least one tax jurisdiction.

* :ref:`Product tax code <taxes--product-tax-code>` - a label for a group of products that have similar taxation rules in at least one tax jurisdiction.

* :ref:`Tax jurisdiction <taxes--tax-jurisdiction>` - an address, usually a state in a country that has defined taxation policies that determine when and how the company should pay its sales or VAT tax, and what rates should be used, depending on the tax status of the products you sell and the parties you sell to.

* :ref:`Tax rate <user-guide--taxes--tax-rates>` - the percentage of the sales income that should be paid as a tax in the particular tax jurisdiction for a certain type of products sold to a group of customers with the same tax status.

.. image:: /user/img/taxes/all_tax_rules.png
   :alt: The general page of all tax rates

Taxation Configuration
----------------------

OroCommerce groups taxation configuration options into the following categories that should be customized in the :ref:`system configuration <configuration--guide--commerce--configuration--taxation>`:

* :ref:`Tax Calculation <user-guide--taxes--tax-configuration>`

* :ref:`US Sales Tax for Digital Products <user-guide--taxes--us>`

* :ref:`EU VAT Tax for Digital Products <user-guide--taxes--eu>`


.. _tax-rule--prerequisites:

Tax Rules Creation Prerequisites
--------------------------------

Before setting up a tax rule, make sure to complete the following actions:

1. :ref:`Create a customer tax code <user-guide--taxes--customer_tax_codes-create>`

Create a customer tax code and apply it to a certain customer or a customer group who has fixed tax rates.

2. :ref:`Create a product tax code <taxes--product-tax-code-create>`

Create a product tax code and apply it to the required products with fixed tax rates so that only the products that are subject to be taxed are taxed during a checkout.

3. :ref:`Create a tax jurisdiction <taxes--tax-jurisdiction-create>`

Once you have created both customer and product tax codes and assigned them to the required customers and products, you need to create a tax jurisdiction (country, state, and a range of zip codes) with defined taxation policies to determine where and how the company should pay their sales or VAT tax. A tax jurisdiction specifies what rates should be used depending on the tax status of the products you sell and the customers you sell to.

4. :ref:`Create a tax rate <user-guide--taxes--tax-rates-create>`

Create a tax rate(%) defined by the tax jurisdiction for the customers you are serving and the products you are selling. A tax rate determines the percentage of a sale or order that is required to be paid as a tax in a certain tax area (country or state).

5. :ref:`Create a tax rule <tax-rules-create>`

Finally, create a tax rule that associates the customer tax code, the product tax code, and the tax jurisdiction with the tax rate or the tax exemption (zero rate).

.. note::
   See the two short demos for the guidance on how to create tax rules.

   |Creating tax codes and jurisdictions in OroCommerce|

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/3Bra02GiKZE" frameborder="0" allowfullscreen></iframe>


   |Creating tax rules|

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/Ma0JOwn9VVs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


**Related Articles**

* :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`

* :ref:`Product Tax Codes <taxes--product-tax-code>`

* :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`

* :ref:`Tax Rates <user-guide--taxes--tax-rates>`

* :ref:`Tax Rules <tax-rules>`


.. toctree::
   :maxdepth: 1
   :hidden:

   Product Tax Codes <product-tax-codes/index>
   Customer Tax Codes <customer-tax-codes/index>
   Taxes (Tax Rates) <taxes/index>
   Tax Rules <tax-rules/index>
   Tax Jurisdictions <tax-jurisdictions/index>

.. finish


.. include:: /include/include-links-user.rst
   :start-after: begin