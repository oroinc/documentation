.. _price_list_configuration:
.. _pricing-configuration:


Pricing Configuration
=====================

.. start

In the Pricing Configuration section, you will learn how to adjust price, currency, and other related configuration options on the global, organization, and website levels and customize your price lists per website, customer group, and customers through the management console.

Price Calculation Optimization
------------------------------

* :ref:`Configure Price List Sharding <admin-price-list-sharding>` -- Before you start working with prices in the system configuration, you can enable price list sharding to improve the throughput and overall performance of high volume transaction processing.

* :ref:`Optimize Website Indexation and Price Recalculation <admin-website-index-and-price-calc>` -- Also, you can set up your software and hardware to enhance the efficiency of website indexation and price recalculation processes.


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
                   <li><a class="reference internal" href="currency-config#admin-configuration-currency">Configure Currency Globally</a></li>
                   <li><a class="reference internal" href="currency-config#admin-configuration-currency-org">Configure Currency per Organization</a></li>
                   <li><a class="reference internal" href="website-currency">Configure Currency per Website</a></li>
                </ul>
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
            <h3>Pricing <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="global-pricing">Configure Pricing Globally</a></li>
                   <li><a class="reference internal" href="website-currency">Configure Pricing per Website</a></li>
               </ul>
          </div>
      </div>
      <div class="guideline__item" >
          <div style="text-align: center">
            <h3>Price List <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="price-list-configuration-overview">Understand Price List Configuration</a></li>
                   <li><a class="reference internal" href="website-price-lists">Configure Price List per Website</a></li>
                   <li><a class="reference internal" href="customer-group-price-lists">Configure Price List per Customer Group</a></li>
                   <li><a class="reference internal" href="customer-price-lists">Configure Price List per Customer</a></li>
                </ul>
          </div>
      </div>
   </div>

.. stop

.. toctree::
   :hidden:
   :maxdepth: 1


   price_list_sharding

   optimize_index_and_price_calculation

   currency_config

   global_pricing

   price_list_configuration_overview

   website_price_lists

   customer_group_price_lists

   customer_price_lists