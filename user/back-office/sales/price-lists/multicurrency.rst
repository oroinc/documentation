:oro_documentation_types: commerce

.. _user-guide--pricing--multiple--currencies:

Manage Prices in Multiple Currencies
====================================

.. note:: Before you begin, ensure that the necessary currencies are enabled in the :ref:`global <sys--config--sysconfig--general-setup--currency>` and :ref:`website <sys--websites--sysconfig--currency>` configuration.

Enable Multiple Currencies for the Price List
---------------------------------------------

To add or remove currencies that may be used in a price list:

1. Navigate to **Sales > Price Lists** in the main menu.

   .. image:: /user/img/sales/pricelist/PriceLists.png
      :class: with-border

2. Click the |IcMore| **More Options** menu to the right of the price list and then click the |IcEdit| **Edit** icon to start editing the price list details.

3. In the **General** section, next to the **Currencies**, select the currencies you would like to enable for the price list (e.g. USD, EUR, PND) and unselect those you would like to disable.

   .. image:: /user/img/sales/pricelist/PriceListsCurrencies.png

4. Once you enable the necessary currencies for the price list, click **Save**.

Add Price in Specific Currency to the Price List
------------------------------------------------

When adding a product price manually or using a rule that automates price generation, you always specify the currency it is in.
You can add only one price per combination of product quantity tier and currency (e.g. one price for 1 item in USD or per 10 items in EUR).
For detailed information on adding product prices in particular currencies, see :ref:`Manual Price Management <user-guide--pricing--price-list-manual>` and :ref:`Automated Rule-Based Price Management <user-guide--pricing--price-list-auto>`.

View Price in Specific Currency in the Storefront
-------------------------------------------------

By default, prices in the OroCommerce storefront are shown in the default currency.

.. image:: /user/img/sales/pricelist/price_currency_change1.png
   :class: with-border

However, you may select a different currency with a currency picker on the top right.

.. image::  /user/img/sales/pricelist/currency_on_the_front_store.png

After the new currency is selected, product prices automatically adjust to show the unit prices in the selected currency.

.. note:: When the price list does not contain price for the product in the selected currency, the price information is missing. You can still add the product to the shopping list and request a quote to clarify the pricing in the specific currency.

**Sample: Prices in Euro are Provided**

.. image:: /user/img/sales/pricelist/price_currency_change2.png
   :class: with-border

**Sample: Prices in Euro are Missing**

.. image:: /user/img/sales/pricelist/price_currency_change_no_price_in_selected_currency.png
   :class: with-border


.. include:: /include/include-images.rst
   :start-after: begin