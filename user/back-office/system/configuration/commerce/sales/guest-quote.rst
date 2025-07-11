.. _sys--conf--commerce--guest--enable--guest_quotes:

Configure Global Settings for Quotes
====================================

.. begin_guest_quote

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

The section describes how to enable or disable the quote functionality for the registered and guest users. The settings can be configured on three levels, :ref:`global <sys--conf--commerce--guest--enable--guest_quotes>`, :ref:`organization <sys--organization-quotes>`, and :ref:`website <sys--websites-quotes>`.

.. note:: Keep in mind that the following options must be enabled, too:

          * :ref:`Guest Website Access <sys--conf--commerce--guest--enable--access>`
          * :ref:`Guest Checkout <user-guide--system-configuration--commerce-sales-checkout>`
          * :ref:`Guest RFQ <user-guide--system-configuration--commerce-sales--rfq>`
          * :ref:`Guest Shopping List <user-guide--system-configuration--commerce-sales-shopping-list>`


1. Navigate to **System > Configuration** in the main menu.

2. Select **Commerce > Sales > Quotes** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/global_quote_config.png
      :alt: System configuration option for enabling quotes

3. Clear the **Use Default** checkbox to change the value.

4. In the **General** section, toggle the following options:

   * **Enable Quote (Storefront)** --- allows you to control whether to display or hide the Quote section under the Account menu for registered customers.

   * **Enable Quote Project Name** --- this option enables project name management for quotes in the storefront. In the back-office, the feature is enabled automatically if it is turned on for an organization or for at least one website within that organization. Once active, a Project Name field appears on quote edit pages, and a Project Name column is added to the quotes grid in the back-office. The project name serves as an optional identifier that helps users search for and track quotes by name, particularly when records originate from external systems or third parties.

5. In the **Guest Quote** section, select the **Enable Guest Quote** checkbox to generate unique links for sending quotes to guest users.

6. Click **Save Settings**.

.. finish_guest_quote

**Related Topics**

* :ref:`Send a Guest Quote in the Back-Office <user-guide--sales--guest-quotes>`
* :ref:`Send a Guest Quote in the Storefront <frontstore-guide--guest-quotes>`
