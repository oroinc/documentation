.. _organization-config-website-routing:

Configure Website Routing Settings per Organization
===================================================

To change the default currency settings per organization:

1. Navigate to **System > Configuration > User Management > Organizations** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > Websites > Routing** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **General** section, define the following options:

   * **Main Navigation Menu** - Select which :ref:`storefront menu <menu-management-concept-guide>` will represent the :ref:`main menu <frontstore-guide--navigation-main-menu>` in the storefront.

   * **Homepage** - When no web catalog is available, you can choose any of the available landing pages as your homepage. Please note that on clean installations of Oro applications, the default homepage is blank.

  * **Prefer Self-Contained Web Catalog Canonical URLs** - This option is enabled by default. When disabled, the canonical URLs point to the direct URLs of the underlying content types if they are available. This option is available only when a web catalog is used as storefront menu.

   .. image:: /user/img/system/user_management/org_configuration/websites/self-contained-url.png
      :alt: Routing configuration at organization level displaying option Prefer Self-Contained Web Catalog Canonical URLs

5. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin