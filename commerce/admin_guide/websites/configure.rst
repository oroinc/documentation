.. _user-guide--system-websites--configure-website:

Configure a Website
^^^^^^^^^^^^^^^^^^^

.. contents:: :local:

In OroCommerce, you can configure the website-related settings on the system level and per a specific website.

Global Website-Related Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This section guides you through the OroCommerce Storefront website-related system configuration options, such as routing and sitemap. These options apply to all organizations, websites, and users unless their configuration overrides the default ones.

Routing
"""""""

You can control the way OroCommerce routes the HTTP requests to the components that service these requests. Some of these options may be configured only globally, on a system level, and some are applicable to the individual websites.

For the information on how to configure the website routing settings on the system level, refer to the :ref:`Global Routing Configuration <sys--config--sysconfig--websites--routing>` section.

Sitemap
"""""""

A sitemap is a file that explains the structure of your site to the search engines. Sitemap helps improve indexing the site contents by the search engine (e.g. by providing metrics like page priority, update frequency and content uniqueness).

OroCommerce automatically generates the sitemap files for every website based on the routing configuration (e.g. secure vs insecure website URL, direct vs system canonical URLs, page priority configuration, etc). Sitemap files for the default website are stored in the `public/sitemaps/actual/` folder. To communicate the sitemap location to the external search engines, the sitemap files generated for the default website are mentioned in the *robots.txt* file in the OroCommerce root folder.

.. note:: Only one sitemap may be included in the robots.txt file. To help search engines index the websites other than the default one, a webmaster can manually upload the automatically generated sitemap files using dedicated webmaster tools exposed by the search engine provider.

The frequency of the sitemap files generation (e.g. daily) depends on the system configuration.

You can launch the sitemap generation manually using the following command:

`oro:cron:sitemap:generate`

For the information on how to configure the website sitemap settings on the system level, refer to the :ref:`Global Sitemap Configuration <sys--config--sysconfig--websites--sitemap>` section.

Website-Level Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

By default, global system configuration settings apply to all newly created websites.

To define the custom configuration options for the particular website:

1. Navigate to **System > Websites** using the main menu.

   .. image:: /admin_guide/img/websites/all_websites_page.png
      :alt: The list of available websites

2. Click on the website you would like to customize configuration for (e.g. Australia).

   .. image:: /admin_guide/img/websites/view_website_australia.png
      :alt: View the details of Australia website

3. On the website details page, click |IcConfig| **Configuration**. The following page opens:

   .. image:: /admin_guide/img/websites/website_config.png
      :alt: The configuration page of Australia website


   .. include:: /admin_guide/config_levels/website.rst
      :start-after: begin


4. Once you complete configuring the website-level settings in the option group, click **Save Settings**.

**Related Topics**

* :ref:`Website Management <user-guide--system-websites>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin
