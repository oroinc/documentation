.. _sys--conf--commerce--guest-access--website:

Configure Guest Website Access Settings per Website
===================================================

.. hint:: This section is part of the :ref:`Guest Functions <sys--conf--commerce--guest>` topic that provides a general understanding of the guest access concept in OroCommerce.

To manage guest access per website:

1. Navigate to **System > Websites**.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > Website Access** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/websites/web_configuration/GuestAccessWeb.png
   :alt: Guest access configuration per website

4. Clear the **Use Organization** checkbox to change the organization-wide setting.

5. In the Website Access section, toggle the **Enable Guest Access** checkbox to enable or disable guest users from browsing the website.

   When **Enable Guest Access** is disabled, the storefront becomes inaccessible to guest users except for the login/forgot/reset password page and any system or landing pages explicitly allowed by the administrator.

   In this case, the following additional options become available (available starting from OroCommerce version 6.0.9):

   * **Allow Guest Access to System Pages** — Select the system pages that should remain available to guest users.

   * **Allow Guest Access to Landing Pages** — Select the landing (CMS) pages that should remain available to guest users.

6. Click **Save Settings**.




.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin