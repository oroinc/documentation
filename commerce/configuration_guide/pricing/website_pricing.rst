.. _sys--websites--sysconfig--currency:

Currency Configuration Per Website
----------------------------------

.. begin

Currency configuration a the particular website helps you:

* Enable all or some currencies from the allowed currencies list to be used in OroCommerce front store and management console for this website.

* Select the currency that is shown by default in the OroCommerce front store and management console for this website.

.. note:: The website level configuration has higher priority and overrides these configuration settings.

To change the default currency settings for the website:

1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **Commerce > Catalog > Pricing** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

   .. image:: /configuration_guide/img/websites/config_commerce_catalog_pricing.png
      :class: with-border

   * **Enabled Currencies** --- The subset of :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` that is available for the customer user by default on this website.

     .. image:: /configuration_guide/img/configuration/catalog/pricing/currency_on_the_front_store.png

   * **Default Currency** --- The currency used by default to show prices in the front store on this website.

4. To customize any of these options:

     a) Clear the **Use System** check box next to the option.
     b) Select the new option.

5. Click **Save**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
