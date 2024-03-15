.. _organization-config-website-sitemap:

Configure Website Sitemap Settings per Organization
===================================================

You can control the way sitemap is generated for specific organization in OroCommerce:

1. Navigate to **System > Configuration > User Management > Organizations** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > Websites > Sitemap** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Under **Robots.txt**, a user can modify **Robots.Txt Template**, granting or restricting permission for site crawlers to navigate through the specified URLs within your website domain. Initially, the system obtains the default values from the *config/robots.txt.dist* or *robots.%domain.name%.txt* files automatically. Once a user modifies the values in the **Robots.Txt Template** configuration, the system starts adhering to these adjusted values only, subsequently updating the *robots.txt* and *sitemap* files accordingly.

   .. image:: /user/img/system/user_management/org_configuration/websites/sitemap-org.png

5. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin