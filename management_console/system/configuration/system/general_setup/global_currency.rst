.. _sys--config--sysconfig--general-setup--currency:
.. _admin-configuration-currency:

Currency
========

.. contents:: :local:
   :depth: 3

Currency configuration helps you:

* Add and remove currencies from the allowed currencies list.
* Set the base currency.
* Specify the conversion rate to and from the base currency.
* Define the order used when the currencies are displayed to the storefront and management console users.
* Toggle between the currency display formats (currency code, e.g. USD, and currency symbol, e.g. $).

.. hint::
    Currency configuration is available on three levels, globally, :ref:`per organization <admin-configuration-currency-org>` and :ref:`per website <sys--websites--sysconfig--currency>`.

.. note:: The organization-level configuration for base currency and display format has higher priority and overrides the system setting. However, to enable a currency on the organization level, you should add it to the list of allowed currencies at the system level first.

To change the default currency setting globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > Currency** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

Currency Settings
-----------------

The following sections are available within the **Currency** tab:

.. image:: ../img/multi_currency/currency.png

+------------------------+-----------------------------------------------------------------------------------------------------------------+
| **Name**               | Description                                                                                                     |
+========================+=================================================================================================================+
| **Allowed currencies** | **Allowed currencies** list allows you to select some of all available currencies to enable them in OroCommerce.|
|                        |                                                                                                                 |
|                        | To add the allowed currency, select it from the list and click **Add**.                                         |
|                        |                                                                                                                 |
|                        | The new row is added to the allowed currencies options table, where you can configure the exchange rates        |
|                        | for the newly added currency and may set it as a base currency.                                                 |
|                        | See `Allowed Currencies Options`_ for more information.                                                         |
|                        |                                                                                                                 |
+------------------------+-----------------------------------------------------------------------------------------------------------------+
| **Display format**     | This setting controls how the currencies will be displayed within the system, as a 3-letter ISO code            |
|                        | (e.g. GBP) or as the currency symbol (e.g. £).                                                                  |
|                        |                                                                                                                 |
|                        | To customize the **Display Format**:                                                                            |
|                        |                                                                                                                 |
|                        | a) Clear the **Use Default** check box next to the option.                                                      |
|                        | b) Select the new option value (either *Currency Code* or *Currency Symbol*).                                   |
|                        |                                                                                                                 |
|                        | **Note:** Not all currencies might have symbols. For such currencies, ISO codes are used instead.               |
|                        |                                                                                                                 |
|                        | The order subtotal when the display format is set to *Currency Code*:                                           |
|                        |                                                                                                                 |
|                        | .. image:: /admin_guide/img/configuration/general/currency_code.png                                             |
|                        |                                                                                                                 |
|                        | The order subtotal when the display format is set to *Currency Symbol*:                                         |
|                        |                                                                                                                 |
|                        | .. image:: /admin_guide/img/configuration/general/currency_symbol.png                                           |
|                        |                                                                                                                 |
+------------------------+-----------------------------------------------------------------------------------------------------------------+

Allowed Currencies Options
--------------------------

The information about the allowed currencies options is grouped in the following columns:

.. note:: This feature is only available in the Enterprise edition.

+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Name**               | Description                                                                                                 |
+========================+=============================================================================================================+
| **Base**               | A flag helps you to select the base currency.                                                               |
|                        | Base currency is used by default to display totals, budgets, and amounts.                                   |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Currency Name**      | International name of the currency that follows ISO 4217 standard (e.g. US dollar).                         |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Currency Code**      | International currency code that follows ISO 4217 standard (e.g. USD).                                      |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Currency Symbol**    | Graphical symbol that is used to denote a currency (e.g. $).                                                |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Rate From**          | The conversion rate from the selected currency to the base currency. Used to calculate transaction amounts  |
|                        | (e.g. opportunity budget) in the base currency if they were entered in other currencies.                    |
|                        | Maximum precision is 10 digits.                                                                             |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Rate To**            | The conversion rate from the base currency to the selected currency. Used to calculate new exchange rates   |
|                        | when the base currency is changed. Maximum precision is 10 digits.                                          |
+------------------------+-------------------------------------------------------------------------------------------------------------+

1. To change the base currency, click the **Base** option in the corresponding row. This will lead to reconversion of all multi-currency data to the new base currency, and all values will be re-converted according to the current rates.

   Before:

   .. image:: ../img/multi_currency/currency_base1.png

   After:

   .. image:: ../img/multi_currency/currency_base3.png

.. important:: Changing base currency requires manual update of the money values (budgets, totals, revenues, etc.). You will be prompted to confirm the change.

In the example below, the base currency is British pounds but the budget of the opportunity deal is in US dollars.

.. image:: ../img/multi_currency/example_base_and_us_budget.png

When you close a deal (determined by opportunity status), the exchange rate for it becomes locked and will no longer take rate changes into account.

Dashboard widgets with monetary values (e.g. Forecast) and monetary metrics work in the base currency irrespective of the currency that the deals were made in.

.. image:: ../img/multi_currency/widgets_base_currency.png

2. To modify the currency exchange rate to and from the base currency, edit the **Rate To** and **Rate From** values in the corresponding row.

   For example, if the rate of US dollar to British pound is 1:0.76, enter 0.76 in the Rate From field for US Dollar. The system will automatically calculate the Rate To value for US Dollar which will constitute 1.315789.

   .. image:: ../img/multi_currency/rate_recalculation.png

   .. note:: The base currency rate is always 1 to 1 and cannot be changed.

3. To add a currency to the allowed currencies list:

   a) Select the currency from the **Allowed Currencies** list and click **Add** next to it.

      .. image:: ../img/multi_currency/currency_add.png

      The currency is appended to the top of the list.

      .. image:: ../img/multi_currency/currency_add3.png

   b) Fill in the exchange rate to and from the base currency.

4. To delete a currency from the allowed currencies list, click the |IcDeactivate| **Delete Currency** icon at the end of the corresponding row.

   .. note:: Deleting base currency is restricted. To unlock the delete action for the currency that is set as base, switch to a different base currency.

5. To change the currency sort order, click and hold the |IcReorder| **Sort** icon, and drag the currency up or down the list.

6. To roll back any changes to the currency settings, click **Reset** on the top right.

7. Click **Save Settings**.

.. finish_global_currency

**Related Articles**

* :ref:`Pricing Overview <user-guide--pricing>`
* :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin