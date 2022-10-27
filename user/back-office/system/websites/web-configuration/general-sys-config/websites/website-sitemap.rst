:oro_documentation_types: OroCommerce

.. _sys--websites--sysconfig--websites--sitemap:

Configure Sitemap Settings per Website
======================================

You can control the way sitemap is generated for the specific website in OroCommerce.

.. note:: The website level configuration overrides :ref:`global sitemap <sys--config--sysconfig--websites--sitemap>` configuration.

To change the default sitemap settings for the website:

1. Navigate to the system configuration (click **System > Websites** in the main menu).

2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > Websites > Sitemap** in the menu to the left.

   .. image:: /user/img/system/websites/web_configuration/website-sitemaps.png
      :class: with-border

   The frequency and priority options may be configured globally or specifically for product, category and the cms page level.

4. To customize any of these options:

     a) Clear the **Use Organization** box next to the option.
     b) Select the new option.

5. To configure which pages to include and exclude from the sitemap file, enable the following options:

   * **Exclude Direct URLs Of Landing Pages** - Enable the option to include only landing pages that are assigned to particular web catalog nodes into the website's sitemap and exclude those accessed via direct URL. Enabling the option prevents landing page duplication in the sitemap file.

   * **Include Landing Pages Not Used In Web Catalog** - Enable the option to include both assigned to web catalog nodes and unassigned landing pages into the sitemap file.

Possible combinations

.. image:: /user/img/system/config_system/sitemap-config-options.png
   :alt: Table that explains what landing pages are included and excluded into the sitemap file depending on the selected config options


6. Click **Save**.


.. finish

.. include:: /include/include-images.rst
   :start-after: begin
