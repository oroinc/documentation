:orphan:

.. _admin-configuration-currency-organization:
.. _sys--config--sysconfig--general-setup--currency-organization:

Currency Configuration for Organization
---------------------------------------

.. begin_org_currency

Similarly to the the :ref:`global currency configuration <admin-configuration-currency>`, you can specify currency settings for the organization.

.. note:: The organization-level configuration for base currency and display format has higher priority and overrides the system setting. However, to enable a currency on the organization level, you should add it to the list of allowed currencies at the system level first.

To change the default currency settings for organization:

1. Navigate to **System > User Management > Organization** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > General Setup > Currency** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

Currency Settings
^^^^^^^^^^^^^^^^^

The following sections are available within the **Currency** tab:

.. image:: /admin_guide/img/configuration/general/currency.png

+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Name**               | Description                                                                                                 |
+========================+=============================================================================================================+
| **Allowed currencies** | **Allowed currencies** list allows you to select some of all available currencies to enable them in OroCRM. |
|                        |                                                                                                             |
|                        | To add the allowed currency, clear **Use system** box, select the currency from the list and click **Add**. |
|                        |                                                                                                             |
|                        | The new row is added to the allowed currencies options table, where you can configure the exchange rates    |
|                        | for the newly added currency and may set it as a base currency.                                             |
|                        | See :ref:`Allowed Currencies Options <admin-configuration-currency-allowed-currencies-settings>`            |
|                        | for more information.                                                                                       |
|                        |                                                                                                             |
+------------------------+-------------------------------------------------------------------------------------------------------------+
| **Display format**     | This setting controls how the currencies will be displayed within the system, as a 3-letter ISO code        |
|                        | (e.g. GBP) or as the currency symbol (e.g. £).                                                              |
|                        |                                                                                                             |
|                        | To customize the **Display Format**:                                                                        |
|                        |                                                                                                             |
|                        | a) Clear the **Use System** check box next to the option.                                                   |
|                        | b) Select the new option value (either *Currency Code* or *Currency Symbol*).                               |
|                        |                                                                                                             |
|                        | Note: Not all currencies might have symbols. For such currencies, ISO codes are used instead.               |
|                        |                                                                                                             |
|                        | The order subtotal when the display format is set to *Currency Code*:                                       |
|                        |                                                                                                             |
|                        |      .. image:: /admin_guide/img/configuration/general/currency_code.png                                    |
|                        |                                                                                                             |
|                        |      The order subtotal when the display format is set to *Currency Symbol*:                                |
|                        |                                                                                                             |
|                        |      .. image:: /admin_guide/img/configuration/general/currency_symbol.png                                  |
|                        |                                                                                                             |
+------------------------+-------------------------------------------------------------------------------------------------------------+

.. image::  /admin_guide/img/multi_currency/allowed_currencies_dropdown.png

.. image::  /admin_guide/img/multi_currency/display_format.png

.. finish_org_currency

.. include:: /img/buttons/include_images.rst
   :start-after: begin

Related Articles
^^^^^^^^^^^^^^^^

* :ref:`Multi-currency guide <user-guide-multi-currency>`