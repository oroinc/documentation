.. _user-guide-multi-currency:

Multi-Currency 
==============

.. contents:: :local:
    :depth: 2

Overview
--------

Multiple currency functionality for OroCRM is a useful tool for companies that do business internationally and negotiate deals in various currencies.

.. note:: This feature is only available in the Enterprise edition.

Currency configuration allows to:

- Create and manage the list of currencies that will be available for selection in multi-currency fields (e.g. opportunity budget).
- Designate one currency as base.

Think of a US-based business that is shipping certain goods to the UK. Its base currency is US dollars, which means that this is the currency that its business’s turnover is usually in. The contract between the US and the UK companies, however, is to be signed in British pounds for the total value of £20 000. When creating a new opportunity for the mentioned contract, a sales manager of the US company would need to add the **Budget Amount** in pounds rather than dollars.

With OroCRM Enterprise multi-currency feature, the system can make the necessary recalculations of this budget amount into the base currency for you. This means that if you enter the amount of £20 000 into the Budget Amount field, this value will be converted into your base currency and constitute $25 050, as illustrated in the screenshot below. This conversion is calculated according to the currency rate, determined beforehand.

.. image:: ../img/multi_currency/budget_recalculated.png
   :alt: The price is recalculated while selecting a currency

With this example in mind, let us have a look at how you can configure your currencies and rates.

.. note:: So far, opportunity is the only OroCRM entity to have received multi-currency functionality out-of-the-box.

Configure Multi-Currency
------------------------

.. include:: /admin_guide/multi_currency/configure_currency.rst
   :start-after: begin_global_currency
   :end-before: finish_global_currency

.. include:: /admin_guide/multi_currency/configure_currency.rst
   :start-after: begin_org_currency
   :end-before: finish_org_currency

Visualization
-------------

When the rates are configured, you can use them to record multi-currency sales and utilize exchange rates.

-	Currencies are switched with a dropdown control next to the amount entry field in all multi-currency fields, such an Opportunity budget or Close Revenue.
-	When you change the amount currency, the converted value in base currency appears below the control. 
-	Both Opportunity budget and Close Revenue can be entered in non-base currencies and these currencies might not match. This can be useful if you discuss budgets with overseas clients in their currency, but the actual deal is specified in your currency.

.. image:: ../img/multi_currency/mc_visualization.gif

.. toctree::
   :hidden:

   configure_currency

.. include:: /img/buttons/include_images.rst
   :start-after: begin