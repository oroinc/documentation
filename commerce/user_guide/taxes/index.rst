Taxes
=====

This topic contains the following sections:

.. contents:: :local:
   :depth: 2

Overview
--------

.. include:: /user_guide/taxes/tax_rules/tax_rules_overview.rst
  :start-after: begin

Before You Begin: Taxation Configuration
----------------------------------------

.. include:: /admin_guide/landing_commerce/taxation/taxes/index.rst
   :start-after: begin
   :end-before: stop 1

Understanding Tax Rules
-----------------------

.. include:: /user_guide/taxes/tax_rules/tax_rules_overview.rst
   :start-after: begin

.. image:: /user_guide/img/taxes/tax_rules/All_TaxRules_Taxes.png
   :class: with-border

.. _tax-rule--prerequisites:

Tax Rules Creation Prerequisites
--------------------------------

Before setting up a tax rule, make sure to complete the following actions:

1. Create a customer tax code and apply it to a certain customer or a customer group who has fixed tax rates.
2. Create a product tax code and apply it to the required products with fixed tax rates so that only the products that are subject to be taxed are taxed during a checkout.
3. Create a tax jurisdiction (country, state, and a range of zip codes) to determine where and how the company should pay their sales or VAT tax.
4. Create a tax rate (%) defined by the tax jurisdiction for the customers you are serving and the products you are selling.
5. Finally, create a tax rule that associates the customer tax code, the product tax code, and the tax jurisdiction with the tax rate or the tax exemption (zero rate).

.. contents:: :local:
   :depth: 2

.. note::
   See a short demo on `how to create tax codes and jurisdictions in OroCommerce <https://www.orocommerce.com/media-library/create-tax-code-and-jurisdictions>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/3Bra02GiKZE" frameborder="0" allowfullscreen></iframe>


Create a Customer Tax Code
^^^^^^^^^^^^^^^^^^^^^^^^^^

A customer tax code is a label for a group of customers that indicates the tax obligations and exemptions that a customer has. These tax obligations are considered when a customer submits an order.

.. include:: /user_guide/taxes/customer_tax_codes/create.rst
   :start-after: begin
   :end-before: stop

Link the Tax Code to a Customer or a Customer Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/taxes/link_a_tax_code_to_a_customer.rst
   :start-after: begin
   :end-before: stop

More details on how to manage customer tax codes are described in the :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>` section.

Create a Product Tax Code
^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/taxes/product_tax_codes/create.rst
   :start-after: begin
   :end-before: stop

Link the Tax Code to a Product
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/taxes/link_a_tax_code_to_a_product.rst
   :start-after: begin
   :end-before: stop

More information on how to manage product tax codes is provided in the :ref:`Product Tax Codes <taxes--product-tax-code>` section.

Now that you have created both customer and product tax codes and assigned them to the required customers and products, you need to create a tax jurisdiction which is an address that has defined taxation policies. A tax jurisdiction is used to specify what rates should be used depending on the tax status of the products you sell and the customers you sell to.

Create a Tax Jurisdiction
^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/taxes/tax_jurisdictions/create.rst
   :start-after: begin
   :end-before: stop

For more details on how to manage a tax jurisdiction, refer to the :ref:`Tax Jurisdiction <taxes--tax-jurisdiction>` section.

Once the tax jurisdiction is created, you need to create a tax rate for this jurisdiction to determine the percentage of a sale or order that is required to be paid as a tax in a certain tax area (country or state).

Create a Tax Rate
^^^^^^^^^^^^^^^^^

.. include:: /user_guide/taxes/taxes/create.rst
   :start-after: begin
   :end-before: stop

Export Tax Rates
~~~~~~~~~~~~~~~~

You can export the tax rate details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import Tax Rates
~~~~~~~~~~~~~~~~

You can import the bulk details of tax rate information in the .csv format following the steps described in the :ref:`Importing Taxes <import-taxes>` guide.


More details on how to manage tax rates are described in the :ref:`Taxes (Tax Rates) <user-guide--taxes--tax-rates>` section.

Now that you have set corresponding tax rates, you need to create a tax rule that associates this tax rate or tax exemption (zero rate) with other tax components, such as customer tax codes, product tax codes, and tax jurisdictions.

Create a Tax Rule
-----------------

.. include:: /user_guide/taxes/tax_rules/create.rst
   :start-after: begin
   :end-before: stop

Export Tax Rules
^^^^^^^^^^^^^^^^

You can export the tax rule details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import Tax Rules
^^^^^^^^^^^^^^^^

You can import the bulk details of tax rule information in the .csv format following the steps described in the :ref:`Importing Tax Rules <import-tax-rules>` guide.

For more information on how to manage tax rules, refer to the :ref:`Tax Rules <tax-rules>` section.


**Related Information**

.. toctree::
   :maxdepth: 1

   customer_tax_codes/index

   link_a_tax_code_to_a_customer

   product_tax_codes/index

   link_a_tax_code_to_a_product

   tax_jurisdictions/index

   taxes/index

   tax_rules/index

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin