.. _user-guide--pricing:

Pricing
=======

This topic contains the following sections:

.. contents:: :local:

Overview
--------

.. include:: /user_guide/overview/sales/price_lists_overview.rst
  :start-after: begin

Configuration
-------------

To align the price list behavior with your needs, you can adjust the price, currency, and other related configuration options that are grouped in OroCommerce in the following way:

* :ref:`Global Currency Configuration <sys--config--sysconfig--general-setup--currency>`, where you can:

  * Add and remove currencies from the **Allowed Currencies** list.
  * Set the base currency.
  * Define the order that is used to display the currencies to the front store and management console users.
  * Toggle between the currency display formats (currency code, e.g. USD, and currency symbol, e.g. $).

..  Specify the conversion rate to and from the base currency.

* :ref:`Currency Configuration per Website <sys--websites--sysconfig--currency>`, where you can:

  * Enable all or some currencies from the **Allowed Currencies** list to be used in OroCommerce front store and management console for this website.
  * Select the currency to show by default in the OroCommerce front store and management console for this website.

* :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>`, where you can:

  * Set price precision and price rounding strategy.
  * Configure default price lists, their priority and merge strategy to get the necessary resulting combination of prices that are shown on the websites and for the customers whenever their price list settings fall back to the system default.
  * Specify an offset in hours that helps launch combined price list recalculation before price change is activated.
  * Enable all or some currencies from the **Allowed Currencies** list to be used in OroCommerce front store and management console.
  * Select the currency to show by default in the OroCommerce front store and management console.

* **Price List Configuration**, where you can configure default price lists, their priority and merge strategy to get the necessary resulting combination of prices that are shown on the websites and for the customers whenever their price list settings are customized. See :ref:`Understanding Price List Configuration <understanding-price-list-configuration>` for more information on the configuration priorities, default settings, and fallback strategies.

  * Default --- See the **Price Lists** option description in the :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>` topic.
  * :ref:`Per Website <sys--website--edit--price-lists>`
  * :ref:`Per Customer Group <customers--customer-groups--edit--price-lists>`
  * :ref:`Per Customer <customers--customers--edit--price-lists>`

* :ref:`Product Price Attributes Setup <user-guide--products--price-attributes>`
* :ref:`Product Units Setup <sys--commerce--product--product-units>`

.. TODO Product Units Setup

Price List Management
---------------------

.. include:: /user_guide/pricing/pricelist/index.rst
   :start-after: start_pricelist_management
   :end-before: stop_pricelist_management

Price Calculation on the Front Store
------------------------------------

.. include:: /user_guide/pricing/calculation.rst
   :start-after: begin
   :end-before: finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 2
   :hidden:

   configuration/index

   pricelist/index


