.. begin_multi_currency_opportunities

Multi-currency Opportunities
----------------------------

Multi-currency feature is available for OroCRM Enterprise Edition only. You can find a complete guide on multi-currency in :ref:`multi-currency guide <user-guide-multi-currency>`.

Currency configuration allows to track and record sales made in different currencies, specifically:

-	Create and manage the list of currencies that will be available for selection in multi-currency fields, e.g. the opportunity budget.
-	Designate one base currency which would serve as the default one for all multi-currency fields, in addition to being the currency to which values in other currencies will be converted.
-	Manage exchange rate for all currencies to calculate opportunity budget, close revenue, etc. from the deal currency to the base currency.
-	Identify currencies in the system with a three-letter ISO code or a symbol.


At the organization level, it is possible only to remove unnecessary currencies, not add the new ones.

To be able to manage currencies and change the rates:

-	Navigate to **System>User Management>Organizations**.
-	Select your organization and click **Configuration** in the top right corner.
-	In the left menu, click **General Setup>Currency**.
-	Unlock the currency grid by unticking **Use System**.
-	Enter the numbers in the corresponding field of the **Rate From/To** columns.

In the following example, the base currency is US dollars, the currency format is set to Currency Symbol and three deal currencies are set to Euro, British Pound and Ukrainian Hryvnia.

.. image:: ../../../img/opportunities_2.0/currencies_config.jpg



These exchange rates to the base currency will be used to calculate and convert the actual budget value, close revenue, the total number of orders (for OroCommerce), etc.

This is how multi-currency feature is displayed in the **Create Opportunity** form:


.. image:: ../../../img/opportunities_2.0/currency_opp_form.jpg


You can select one of the enabled currencies in the currency selector for the **Budget Amount** field. They are represented by a currency symbol, as configured in the settings.

Note that the Close Revenue and the Budget Amount can be specified in different currencies.

As you can see from the screenshot, the budget amount entered in Euro (€15000) has been recalculated to the base currency ($16,350) according to the defined exchange rate.


.. image:: ../../../img/opportunities_2.0/opp_abc_view.jpg

The same budget amounts will be available in the grid view and Reports and Segments.

.. note:: In dashboard widgets, only amounts in the base currency will be displayed.


If you change the currency exchange rate, the changes will be displayed for all **open** opportunities. Rates for closed opportunities are fixed.

.. image:: ../../../img/opportunities_2.0/currency_changed.jpg

.. image:: ../../../img/opportunities_2.0/exchange_rate_changed.jpg

As you can see from the screenshots, the rate of Euro towards US dollar was changed from 1.09 to 1.15 consequently changing the value of the base currency for budget amount from $16350 to $17250.

.. important:: If you are not using the **Opportunity Management Flow**, you will be able to edit the budget amount/close revenue for a closed opportunity.

.. finish_multi_currency_opportunities
