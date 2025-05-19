.. begin_multi_currency_opportunities

Multi-Currency Opportunities
============================

The multi-currency feature is available for the Enterprise Edition only. You can find a complete guide on multi-currency in :ref:`multi-currency guide <user-guide-multi-currency>`.

Currency configuration allows to track and record sales made in different currencies, specifically:

-  Create and manage the list of currencies available for selection in multi-currency fields, e.g., the opportunity budget.
-  Designate one base currency that serves as the default one for all multi-currency fields, in addition to being the currency to which values in other currencies are converted.
-  Manage exchange rate for all currencies to calculate opportunity budget, close revenue, etc., from the deal currency to the base currency.
-  Identify currencies in the system with a three-letter ISO code or a symbol.

At the organization level, it is possible only to remove unnecessary currencies, not add new ones.

To be able to manage currencies and change the rates:

-  Navigate to **System > User Management > Organizations**.
-  Select your organization and click **Configuration** in the top right corner.
-  In the left menu, click **General Setup > Currency**.
-  Unlock the currency grid by clearing the **Use System** checkbox.
-  Enter the numbers in the corresponding field of the **Rate From/To** columns.

In the following example, the base currency is US dollars, the currency format is set to Currency Symbol, and two deal currencies are set to Euro, and British Pound.

.. image:: /user/img/sales/opportunities/currencies_config.jpg
   :alt: Currency settings

These exchange rates to the base currency are used to calculate and convert the actual budget value, close revenue, the total number of orders, etc.

Below is an illustration of how the multi-currency feature may be represented in the **Create Opportunity** form:

.. image:: /user/img/sales/opportunities/currency_opp_form.jpg
   :alt: Use currency for opportunities

You can select one of the enabled currencies in the currency selector for the **Budget Amount** field. They are represented by a currency symbol, as configured in the settings. You can also specify the Close Revenue and the Budget Amount in different currencies.

As you can see from the screenshot, the budget amount entered in British Pounds (£15000) has been recalculated to the base currency ($18,300) according to the exchange rate defined in the system currency configuration earlier.

.. image:: /user/img/sales/opportunities/opp_abc_view.jpg
   :alt: Budget amount recalculated to the base currency based on the exchange rate

.. important:: A few important things to note:

                * The same budget amounts will be available in the grid view and Reports and Segments.
                * Dashboard widgets display amounts only in the base currency.
                * If you change the currency exchange rate, the changes will be displayed for all **open** opportunities. Rates for closed opportunities are fixed.
                * If you do not use the **Opportunity Management Flow**, you can edit the budget amount/close revenue for a closed opportunity.

.. finish_multi_currency_opportunities