.. _price_list_configuration:
.. _pricing-configuration:


Pricing Configuration
=====================

.. start

In the Pricing Configuration section, you will learn how to adjust price, currency, and other related configuration options on the global and website levels and customize your price lists per website, customer group, and customers through the management console.

Price Calculation Optimization
------------------------------

Before you start working with prices in the system configuration, you can enable price list sharding to improve the throughput and overall performance of high volume transaction processing.

* :ref:`Configure Price List Sharding <admin-price-list-sharding>`

Also, you can set up your software and hardware to enhance the efficiency of website indexation and price recalculation processes.

* :ref:`Optimize Website Indexation and Price Recalculation <admin-website-index-and-price-calc>`


Pricing Configuration Options
-----------------------------

OroCommerce groups price configuration options into the following categories:

.. raw:: html

   <div class="guideline">
      <div class="guideline__item">
          <div style="text-align: center">
            <h3>Currency <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="admin-guide/pricing/global-currency">Global Currency Configuration</a></li>
                   <li><a class="reference internal" href="admin-guide/pricing/org-currency">Currency Configuration per Organization</a></li>
                   <li><a class="reference internal" href="admin-guide/pricing/website-currency">Currency Configuration Per Website</a></li>
                </ul>
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
            <h3>Pricing <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="user-guide/marketing-web-catalog">Web Catalogs</a></li>
                   <li><a class="reference internal" href="user-guide/master-catalog">Master Catalog</a></li>
                   <li><a class="reference internal" href="user-guide/marketing-landing-pages">Landing Pages</a></li>
                   <li><a class="reference internal" href="user-guide/marketing-content-blocks">Content Blocks</a></li>
               </ul>
          </div>
      </div>
      <div class="guideline__item" >
          <div style="text-align: center">
            <h3>Price List <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="user-guide/customers/customer-groups">Customer Groups</a></li>
                   <li><a class="reference internal" href="user-guide/customers/customers">Customers</a></li>
                   <li><a class="reference internal" href="user-guide/customers/customer-users">Customer Users</a></li>
                   <li><a class="reference internal" href="user-guide/consents">GDPR Compliance</a></li>
                </ul>
          </div>
      </div>
   </div>

1. **Currency Configuration**

   * :ref:`Global Currency Configuration <sys--config--sysconfig--general-setup--currency>`, where you can:

     * Add and remove currencies from the **Allowed Currencies** list.
     * Set the base currency.
     * Define the order that is used to display the currencies to the storefront and management console users.
     * Toggle between the currency display formats (currency code, e.g. USD, and currency symbol, e.g. $).

..  Specify the conversion rate to and from the base currency.

   * :ref:`Currency Configuration per Website <sys--websites--sysconfig--currency>`, where you can:

     * Enable all or some currencies from the **Allowed Currencies** list to be used in OroCommerce storefront and management console for this website.
     * Select the currency to show by default in the OroCommerce storefront and management console for this website.

2. **Pricing Configuration**

   * :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>`, where you can:

     * Set price precision and price rounding strategy.
     * Configure default price lists, their priority and merge strategy to get the necessary resulting combination of prices that are shown on the websites and for the customers whenever their price list settings fall back to the system default.
     * Specify an offset in hours that helps launch combined price list recalculation before price change is activated.
     * Enable all or some currencies from the **Allowed Currencies** list to be used in OroCommerce storefront and management console.
     * Select the currency to show by default in the OroCommerce storefront and management console.

3.  **Price List Configuration**, where you can configure default price lists, their priority and merge strategy to get the necessary resulting combination of prices that are shown on the websites and for the customers whenever their price list settings are customized. See :ref:`Understanding Price List Configuration <understanding-price-list-configuration>` for more information on the configuration priorities, default settings, and fallback strategies.

  * Default --- See the **Price Lists** option description in the :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>` topic.
  * :ref:`Per Website <sys--website--edit--price-lists>`
  * :ref:`Per Customer Group <customers--customer-groups--edit--price-lists>`
  * :ref:`Per Customer <customers--customers--edit--price-lists>`

* :ref:`Product Price Attributes Setup <user-guide--products--price-attributes>`
* :ref:`Product Units Setup <sys--commerce--product--product-units>`

OroCommerce groups price configuration options into the following categories:

.. contents:: :local:

Global Currency Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/global_currency.rst
   :start-after: begin_global_currency_settings
   :end-before: finish_global_currency_settings

Currency Configuration per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/website_pricing.rst
   :start-after: begin
   :end-before: finish

Global Pricing Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/global_pricing.rst
   :start-after: begin
   :end-before: finish

Price List Configuration
~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/price_list_configuration_overview.rst
   :start-after: begin
   :end-before: finish

Default
^^^^^^^

See **Price Lists** option description in the :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>` topic.

Per Website
^^^^^^^^^^^

.. include:: /admin_guide/pricing/website_price_lists.rst
   :start-after: begin
   :end-before: finish

Per Customer Group
^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/pricing/customer_group_price_lists.rst
   :start-after: begin
   :end-before: finish

Per Customer
^^^^^^^^^^^^

.. include:: /admin_guide/pricing/customer_price_lists.rst
   :start-after: begin
   :end-before: finish


.. stop

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   common_price_list_configuration_options

   customer_group_price_lists

   customer_price_lists

   global_currency

   global_pricing

   price_list_configuration_overview

   website_price_lists

   website_pricing

   price_list_sharding

   optimize_index_and_price_calculation

   org_currency
