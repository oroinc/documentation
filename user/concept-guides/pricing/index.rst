.. _user-guide--pricing:

:oro_documentation_types: OroCommerce

Price Management
================

Price list management is one of the most important aspects of any e-Commerce business and even more so for Business to Business (B2B) e-Commerce companies. B2B businesses require a high level of flexibility to support the most advanced use cases, including a highly structured approach to account management and versatile sales processes that are often customized to the needs of specific customer groups or large individual accounts. This is why OroCommerce has one of the most advanced price list management features.

Overall, price management enables you to:

* Set up flexible product prices for different websites, customer groups, and customers.
* Assign prices for newly added products automatically.
* Schedule temporary or permanent price changes.
* Override the automatically assigned price with the manually adjusted value.

Below you can find the complete reference of topics that provide a 360-degree view of price management in OroCommerce.

* :ref:`Understanding Pricing in OroCommerce <user-guide--pricing--overview>` --- provides the overview of price-related definitions in OroCommerce, such as:

   * Price Currencies
   * Product Quantities and Tier Prices
   * Price Lists
   * Price Selection Strategy
   * Combining Price Lists
   * Auto-Generated Price Lists
   * Price List Calculation

* :ref:`Price Lists <user-guide--pricing--pricelist--management>` --- aggregates practical information on how to work with price lists and adapt them to your business needs:

   * :ref:`Create a Price List <user-guide--pricing--create-pricelist>`
   * :ref:`Schedule Price Adjustments <user-guide--pricing--schedule-price-adjustments>`
   * :ref:`Import and Export Prices <user-guide--pricing--import--export>`
   * :ref:`Duplicate a Price List <user-guide--pricing--duplicate-price-lists>`
   * :ref:`Manage Product Price Manually <user-guide--pricing--price-list-manual>`
   * :ref:`Generate Product Price Automatically <user-guide--pricing--price-list-auto>`
   * :ref:`Review Examples of Price Rule Automation <price-rules--auto--examples>`
   * :ref:`Set Prices in Multiple Currencies <user-guide--pricing--multiple--currencies>`
   * :ref:`Filtering Expression Syntax <user-guide--pricing--auto--expression>`, :ref:`Autocomplete <user-guide--pricing--price-list-auto--autocomplete>` and :ref:`Storage Type <user-guide--pricing--auto--expression--storage-type>`

* :ref:`Price Calculation in the Storefront <user-guide--pricing-calculation>` --- describes how prices are calculated for the storefront and what price selection strategies you can apply (minimal price vs priority-based):

   * Minimal Prices Strategy
   * Merge by Priority Strategy

.. note:: For more information on pricing configuration in the back-office, see the following topics:

          * :ref:`Pricing Configuration <pricing-configuration>`
          * :ref:`Currency Configuration <admin-configuration-currency>`
          * :ref:`Pricing Calculation Optimization <admin-website-index-and-price-calc>`
          * :ref:`Configure Price Lists per Customer <customers--customer-groups--edit--price-lists>` and :ref:`Customer Group <customers--customer-groups--edit--price-lists>`


.. toctree::
   :hidden:
   :titlesonly:

   pricing-overview
   calculation
   optimize-index-and-price-calculation
   price-list-sharding

.. include:: /include/include-images.rst
   :start-after: begin