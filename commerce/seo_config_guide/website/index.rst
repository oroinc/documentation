.. _seo-config-guide--website:

Website Configuration
=====================

This section guides you through the OroCommerce Front Store website-related system configuration options.

Routing
~~~~~~~

You can control the way OroCommerce routes the HTTP requests to the components that service these requests. Some of these options may be configured only globally, on a system level, and some are applicable to the individual websites.

Sitemap
~~~~~~~

A sitemap is a file that explains the structure of your site to the search engines. Sitemap helps improve indexing the site contents by the search engine (e.g. by providing metrics like page priority, update frequency and content uniqueness).

OroCommerce automatically generates the sitemap files for every website based on the routing configuration (e.g. secure vs insecure website URL, direct vs system canonical URLs, page priority configuration, etc). Sitemap files for the default website are stored in the `web/sitemaps/actual/` folder. To communicate the sitemap location to the external search engines, the sitemap files generated for the default website are mentioned in the *robots.txt* file in the OroCommerce root folder.

.. note:: Only one sitemap may be included in the robots.txt file. To help search engines index the websites other than the default one, a webmaster can manually upload the automatically generated sitemap files using dedicated webmaster tools exposed by the search engine provider.

The frequency of the sitemap files generation (e.g. daily) depend on the system configuration.

You can launch the sitemap generation manually using the following command:

`oro:cron:sitemap:generate`

Routing and Sitemap Configuration
---------------------------------

.. include:: /configuration_guide/landing_system_configuration/websites/routing_sitemap/index.rst
   :start-after: begin_zero
   :end-before: finish_zero

.. include:: /configuration_guide/landing_system_configuration/websites/routing_sitemap/index.rst
   :start-after: begin_one
   :end-before: finish_one

.. include:: /configuration_guide/landing_system_configuration/websites/routing_sitemap/index.rst
   :start-after: begin_two
   :end-before: finish_two

.. include:: /configuration_guide/landing_system_configuration/websites/routing_sitemap/index.rst
   :start-after: begin_three
   :end-before: finish_three

.. include:: /configuration_guide/landing_system_configuration/websites/routing_sitemap/index.rst
   :start-after: begin_four
   :end-before: finish_four

.. include:: /user_guide/include_images.rst
   :start-after: begin

