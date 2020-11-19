:oro_documentation_types: OroCommerce

.. _pricing-currency-website:
.. _sys--websites--sysconfig--currency:

Configure Pricing Settings (Currencies) per Website
===================================================

.. note:: The website level configuration has higher priority and overrides the global configuration settings.

.. important:: Please, be aware that the configuration settings described below are for the default pricing feature (combined price list pricing) that comes out-of-the-box with your OroCommerce application. If you have :ref:`flat pricing configured for the whole application <dev-guide-setup-flat-pricing>` (a simple pricing engine without strategies and merges), then the configuration page will have the Display Currency and General/Price List Settings. Flat pricing is also available on :ref:`organization <configuration--guide--commerce--configuration--catalog--pricing--organization>` level. :ref:`It is enabled <dev-guide-setup-flat-pricing>` by your system administrator via the console, not the UI.

          .. image:: /user/img/system/websites/web_configuration/flat-pricing-website-config.png
             :alt: Website pricing configuration page when flat pricing is enabled

To enable currencies per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Catalog > Pricing** in the menu to the left.
4. In the **Display Currencies** section, the following options are available:

   .. note:: The **Display Currencies** field is only available in the Enterprise edition.

   * **Enabled Currencies** --- The subset of :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` that is available for the customer user by default.

   .. image:: /user/img/system/websites/web_configuration/currency_on_the_front_store.png
      :alt: Currency in the storefront

   * **Default Currency** --- The currency that is used by default to show prices in the storefront.

   To customize the option configuration:

   a) Clear the **Use Organization** check box next to the option.
   b) Select or type in the new option value.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin
