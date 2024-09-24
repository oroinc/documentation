.. _bundle-docs-commerce-tax-bundle:

OroTaxBundle
============

|OroTaxBundle| introduces tax-related features in the OroCommerce application.

The bundle enables back-office users to create taxes, configure tax types for products, customers, and jurisdictions, as well as setup tax application rules based on the tax types.

With the corresponding configuration of the bundle, customers can view applied taxes for orders and quotes.

The bundle also provides an interface that enables developers to implement integrations with additional third-party tax providers to the OroCommerce applications.

Create Custom Tax Provider
--------------------------

You can add your own custom tax logic with custom tax provider.

1. Create tax provider that implements |TaxProviderInterface| interface:

.. code-block:: php

   namespace Acme\Bundle\DemoBundle\Provider;

   use Oro\Bundle\TaxBundle\Provider\TaxProviderInterface;

   class DemoTaxProvider implements TaxProviderInterface
   {
       const LABEL = 'acme.demo.providers.demo.label';

       #[\Override]
       public function getLabel()
       {
           return self::LABEL;
       }

       #[\Override]
       public function isApplicable()
       {
           return true;
       }

       #[\Override]
       public function loadTax($object)
       {
           // implement your loadTax() method.
       }

       #[\Override]
       public function getTax($object)
       {
           // implement your getTax() method.
       }

       #[\Override]
       public function saveTax($object)
       {
           // implement your saveTax() method.
       }

       #[\Override]
       public function removeTax($object)
       {
           // implement your removeTax() method.
       }
   }


2. Register your own tax provider in the service container using the ``oro_tax.tax_provider`` tag with the ``alias`` attribute that contains a unique name of the tax provider:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   services:
       acme_demo.tax_provider.demo:
           class: Acme\Bundle\DemoBundle\Provider\DemoTaxProvider
           tags:
               - { name: oro_tax.tax_provider, alias: demo, priority: 10 }


3. Navigate to the admin panel under System > Configuration > Commerce > Taxation > Tax Calculation and chose your own custom **Tax Provider** in the dropdown list.

.. _bundle-docs-commerce-tax-bundle-kits:

Calculate Taxes for Product Kits
--------------------------------

Typically, the total tax is calculated by adding up the taxes for each individual order line item. In terms of product kits, which can aggregate several products in the set, the taxes should be applied to each product kit line item. However, not all products within the set are taxable. In such cases, taxes need to be calculated individually for each product.

Let's consider the following cases for a product kit:

.. code-block:: none

   product kit `KIT` - $3000
      kit item 1 `SIMPLE 1` - $100
      kit item 2 `SIMPLE 2` - $200

1. The tax for the **KIT** and **SIMPLE 1** products is 10%. The **SIMPLE 2** product is exempt from tax.

.. image:: /img/backend/tax/tax-kit-case1.png
    :alt: The 10% tax is applied to the KIT and SIMPLE 1 products

2. The 10% tax is applied to the **SIMPLE 1** product only.

.. image:: /img/backend/tax/tax-kit-case2.png
    :alt: The 10% tax is applied to the SIMPLE 1 product only

3. The 10% tax is applied to the **KIT** and **SIMPLE 1** products. Additionally, there is a promotion discount of 10% for order line item. There are two options available for tax calculation depending on the **Calculate Taxes After Promotions** configuration status, which you can set under :ref:`System Configuration > Commerce > Taxation > Tax Calculation <user-guide--taxes--tax-configuration>` in the back-office. When the option is enabled, the taxes are calculated on the :ref:`reduced price <user-guide--marketing--promotions>` after the discounts are applied. If this option is disabled, the taxes are calculated based on the full price before the discounts are applied.

When calculating taxes after promotions for a product kit, you need to distribute its discounts subtotal proportionally between the product kit subtotal.

For instance,

.. code-block:: rst

   product kit `KIT` - $3000, taxable
      kit item 1 `SIMPLE 1` - $100, taxable
      kit item 2 `SIMPLE 2` - $200, non-taxable

   $3300 subtotal
   - 10% promotion discount ($330, all products are eligible for the discount)
   + 10% tax (KIT and SIMPLE 1)

   taxes before promotions: $3000*10% + $100*10% = $300 + $10 = $310
   taxes after promotions: ($3000-$300)*10% + ($100-$10)*10% = $270 + $9 = $279


.. image:: /img/backend/tax/tax-kit-case3.png
    :alt: The 10% tax is applied to the KIT and SIMPLE 1 products based on the enabled Calculate Taxes After Promotions option


.. include:: /include/include-links-dev.rst
   :start-after: begin