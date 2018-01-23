.. _sys--config--sysconfig--general-setup--currency:

Global Currency Configuration
-----------------------------

.. begin

Global currency configuration helps you:

* Add and remove currencies from the allowed currencies list.

* Set the base currency.

* Specify the conversion rate to and from the base currency.

* Define the order used when the currencies are displayed to the storefront and management console users.

* Toggle between the currency display formats (currency code, e.g. USD, and currency symbol, e.g. $).

.. note:: The website level configuration has higher priority and overrides these configuration settings.

To change the default global currency settings:

1. Navigate to **System > Configuration** in the main menu.

2. Select **System Configuration > General Setup > Currency** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The **Currency Settings** page opens. It contains the following information:

   .. image:: /configuration_guide/img/configuration/general/currency.png
      :class: with-border

   * **Base** --- A flag that marks the base currency that is used by default to display totals, budgets, and amounts.

   * **Currency Name** --- International name of the currency that follows ISO 4217 standard (e.g. US dollar).

   * **Currency Code** --- International currency code that follows ISO 4217 standard (e.g. USD).

   * **Currency Symbol** --- Graphical symbol that is used to denote a currency (e.g. $).

   * **Rate From** --- The conversion rate from the selected currency to the base currency. Used to calculate transaction amounts (e.g. opportunity budget) in the base currency if they were entered in other currencies. Maximum precision is 10 digits.

   * **Rate To** ---  The conversion rate from the base currency to the selected currency. Used to calculate new exchange rates when the base currency is changed. Maximum precision is 10 digits.

   * **Display Format** --- A toggle between the ISO code and symbol representation of the currency.

     The order subtotal when the display format is set to *Currency Code*:

     .. image:: /configuration_guide/img/configuration/general/currency_code.png

     The order subtotal when the display format is set to *Currency Symbol*:

     .. image:: /configuration_guide/img/configuration/general/currency_symbol.png

3. To customize the **Display Format**:

     a) Clear the **Use Default** check box next to the option.
     b) Select the new option value (either *Currency Code* or *Currency Symbol*).

#. To change the base currency, click the **Base** option in the corresponding row.

   Before:

   .. image:: /configuration_guide/img/configuration/general/currency_base1.png

   After:

   .. image:: /configuration_guide/img/configuration/general/currency_base3.png

   .. important:: Changing base currency requires manual update of the money values (budgets, totals, revenues, etc.). You will be prompted to confirm the change.

#. To modify the currency exchange rate to and from the base currency, edit the **Rate To** and **Rate From** values in the corresponding row.

#. To add a currency to the allowed currencies list:

   a) Select the currency from the **Allowed Currencies** list and click **Add** next to it.

      .. image:: /configuration_guide/img/configuration/general/currency_add.png

      The currency is appended to the top of the list.

      .. image:: /configuration_guide/img/configuration/general/currency_add3.png

   c) Fill in the exchange rate to and from the base currency.

#. To delete a currency from the allowed currencies list, click the |IcDeactivate| **Delete Currency** icon at the end of the corresponding row.

   .. note:: Deleting base currency is restricted. To unblock delete action for the currency that is set as base, switch to a different base currency.

#. To change the currency sort order, click and hold the |IcReorder| **Sort** icon, and drag the currency up or down the list.

#. To roll back any changes to the currency settings, click **Revert** on the top right.

4. Click **Save Settings**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

Related Articles
^^^^^^^^^^^^^^^^

* :ref:`Pricing Overview <user-guide--pricing>`
* :ref:`Price List Configuration <price_list_configuration>`