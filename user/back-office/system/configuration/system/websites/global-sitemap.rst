.. _sys--config--sysconfig--websites--sitemap:

Configure Global Sitemap Settings
=================================

You can control the way sitemap is generated for all websites.

.. note:: :ref:`Website level configuration <sys--websites--sysconfig--websites--sitemap>` has higher priority and overrides this configuration settings.

To change the default global sitemap settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > Websites > Sitemap** in the menu to the left.

   .. image:: /user/img/system/config_system/sitemaps.png
      :alt: Global website sitemap configuration

   The frequency and priority options may be configured globally or specifically for product, category and the cms page level.

3. To customize any of these options:

   a) Clear the **Use Default** box next to the option.
   b) Select the new option.

4. To configure which pages to include and exclude from the sitemap file, enable the following options:

   * **Exclude Direct URLs Of Landing Pages** - Enable the option to include only landing pages that are assigned to particular web catalog nodes into the website's sitemap and exclude those accessed via direct URL. Enabling the option prevents landing page duplication in the sitemap file.

   * **Include Landing Pages Not Used In Web Catalog** - Enable the option to include both assigned to web catalog nodes and unassigned landing pages into the sitemap file.

Possible combinations

.. image:: /user/img/system/config_system/sitemap-config-options.png
   :alt: Table that explains what landing pages are included and excluded into the sitemap file depending on the selected config options


5. Click **Save**.

