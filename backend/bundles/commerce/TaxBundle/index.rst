:oro_show_local_toc: false

.. _bundle-docs-commerce-tax-bundle:

OroTaxBundle
============

OroTaxBundle introduces tax-related features in the OroCommerce application.

The bundle enables back-office users to create taxes, configure tax types for products, customers, and jurisdictions, as well as setup tax application rules based on the tax types.

With the corresponding configuration of the bundle, customers can view applied taxes for orders and quotes.

The bundle also provides an interface that enables developers to implement integrations with additional third-party tax providers to the OroCommerce applications.

Create Custom Tax Provider
--------------------------

You can add your own custom tax logic with custom tax provider.

1. Create tax provider that implements |TaxProviderInterface| interface:

.. code-block:: php
   :linenos:

   <?php

   namespace Acme\Bundle\DemoBundle\Provider;

   use Oro\Bundle\TaxBundle\Provider\TaxProviderInterface;

   class DemoTaxProvider implements TaxProviderInterface
   {
       const LABEL = 'acme.demo.providers.demo.label';

       /**
        * {@inheritdoc}
        */
       public function getLabel()
       {
           return self::LABEL;
       }

       /**
        * {@inheritdoc}
        */
       public function isApplicable()
       {
           return true;
       }

       /**
        * {@inheritdoc}
        */
       public function loadTax($object)
       {
           // implement your loadTax() method.
       }

       /**
        * {@inheritdoc}
        */
       public function getTax($object)
       {
           // implement your getTax() method.
       }

       /**
        * {@inheritdoc}
        */
       public function saveTax($object)
       {
           // implement your saveTax() method.
       }

       /**
        * {@inheritdoc}
        */
       public function removeTax($object)
       {
           // implement your removeTax() method.
       }
   }


2. Register your own tax provider in the service container using the ``oro_tax.tax_provider`` tag with the ``alias`` attribute that contains a unique name of the tax provider:

.. code-block:: yaml
   :linenos:

   # src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   services:
       acme_demo.tax_provider.demo:
           class: Acme\Bundle\DemoBundle\Provider\DemoTaxProvider
           tags:
               - { name: oro_tax.tax_provider, alias: demo, priority: 10 }


3. Navigate to the admin panel under System > Configuration > Taxation > Tax Calculation and chose your own custom **Tax Provider** in the dropdown list.


.. include:: /include/include-links-dev.rst
   :start-after: begin
