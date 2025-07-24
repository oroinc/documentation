.. _sys--websites-quotes:

Configure Quote Settings per Website
====================================

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

The section describes how to enable or disable the quote functionality for the registered and guest users for a particular  website.

.. note:: Keep in mind that the following options must be enabled, too:

          * :ref:`Guest Website Access per Website <sys--conf--commerce--guest-access--website>`
          * :ref:`Guest Checkout per Website <user-guide--system-configuration--commerce-sales-checkout-website>`
          * :ref:`Guest RFQ per Website <user-guide--system-configuration--commerce-sales--rfq--website>`
          * :ref:`Guest Shopping List per Website <user-guide--system-configuration--commerce-sales-shopping-list-per-website>`


1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.

3. Select **Commerce > Sales > Quotes** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/website_quote_config.png
      :alt: Quote configuration options per website

4. Clear the **Use Organization** checkbox to change the value.

5. In the **General** section, customize the following options:

   * **Enable Quote (Storefront)** --- the option to display or hide the Quote section under the Account menu for registered customers.

   .. note:: The Enable Quote Project Name feature was introduced in OroCommerce versions 6.1.3 and 6.1.4.

   * **Enable Quote Project Name** --- this option enables project name management for quotes in the storefront. In the back-office, the feature is enabled automatically if it is turned on for an organization or for at least one website within that organization. Once active, a Project Name field appears on quote edit pages, and a Project Name column is added to the quotes grid in the back-office. The project name serves as an optional identifier that helps users search for and track quotes by name, particularly when records originate from external systems or third parties.

6. In the **Guest Quote** section, select the **Enable Guest Quote** checkbox to generate unique links for sending quotes to guest users.

7. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
