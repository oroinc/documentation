.. _sys--conf--commerce--sales--promotions-organization:

Configure Promotions Settings per Organization
==============================================

The settings controls whether to enable or disable entering coupon codes that are different only by letter case (e.g., *SpringSale*, *SPRINGSALE*, *springsale*) during the checkout. Depending on the configuration you set, the coupon codes can be considered either equal or different.

.. note:: The configuration is available :ref:`globally <sys-config--commerce--sales--promotions>` in Community edition. In Enterprise edition, it’s available at the organization level only.

To configure the setting per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Promotions** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/sales/promotions-org.png
      :alt: Configure promotions per organization

4. Clear the **Use System** checkbox to customize the setting.

5. **Case-Insensitive Coupon Codes** --- The option determines whether to consider or ignore the letter case of the applied coupon codes. By default, the option is disabled, meaning that the system carefully checks the entered coupon code against the letter case, so *SpringSale*, *SPRINGSALE*, and *springsale*, are considered to be the three different codes. When the option is enabled, the mentioned codes will be considered equal.

6. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin

