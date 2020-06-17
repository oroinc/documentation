:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest--enable--guest_quotes:

Configure Global Settings for Quotes
====================================

.. begin_guest_quote

To issue quotes to guest customers via direct links, enable guest quotes in the system configuration.

.. note:: Keep in mind that the following options must be enabled, too:

          * :ref:`Guest Website Access <sys--conf--commerce--guest--enable--access>`
          * :ref:`Guest Checkout <user-guide--system-configuration--commerce-sales-checkout>`
          * :ref:`Guest RFQ <user-guide--system-configuration--commerce-sales--rfq>`
          * :ref:`Guest Shopping List <user-guide--system-configuration--commerce-sales-shopping-list>`

To enable guest quotes:
 
1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Quotes** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/enable_guest_quote.png
      :alt: System configuration option for enabling guest quotes

3. Clear the **Use Default** check box.
4. Select the **Enable Guest Quote** check box. This enables the generation of unique links for sending quotes to guest users.
5. Click **Save Settings**.

.. finish_guest_quote

**Related Topics**

* :ref:`Send a Guest Quote in the Back-Office <user-guide--sales--guest-quotes>`
* :ref:`Send a Guest Quote in the Storefront <frontstore-guide--guest-quotes>`