:oro_show_local_toc: false

.. _bundle-docs-commerce-multi-website-bundle:

OroMultiWebsiteBundle
=====================

.. note:: This bundle is only available in the Enterprise edition.

The OroMultiWebsiteBundle feature allows for the management of multiple websites in a single storefront.

Create a Website
----------------

A MultiWebsiteBundle allows you to create several websites that share the same OroCommerce Management Console and expose a subset of the information available in the system (e.g., a dedicated web catalog with localized products).

In OroCommerce, websites may be exposed via different domains or reside in the sub-folders of the same domain (e.g., the two websites that target the United States and the United Kingdom may be available at *https://us-store.com* and *https://uk-store.com*, respectively, or they may be reachable via *https://store.com/us* and *https://store.com/uk*).

For websites with dedicated domains, you may use the default OroCommerce installation, where all websites are installed into the web folder of the OroCommerce instance. However, you can move or copy the website to the subdirectory to support websites with the shared domain (e.g., *https://store.com/us* and *https://store.com/uk*).

To prepare files for the website located in the sub-directory (e.g /uk):

1. Copy index.php from *public* directory into the new location (e.g. public/uk/) and modify it to update the relative paths (e.g. adding extra */..* prefix to the path).

   For example:

   .. code-block:: php

      require_once __DIR__.'/../vendor/autoload_runtime.php';

   should be changed to

   .. code-block:: php

      require_once __DIR__.'/../../vendor/autoload_runtime.php';

2. Add WEBSITE_PATH environment variable before `return fn() => new AppKernel('dev', true);`. This parameter value should be the new website folder name.

   .. code-block:: php

      ...
      $_ENV['WEBSITE_PATH'] = '/<yoursitename>';

      return fn() => new AppKernel('dev', true);
      ...
      
   where \<yoursitename\> is *uk* in our example.

When you use the http://localhost/<yoursitename>/index_dev.php address, the asset files (styles.css, app.js, etc.) are taken from the root folder on the domain instead of the dedicated website sub-folder.

Once your files are ready to service requests to the website, create and configure the websites in the OroCommerce back-office. For more information, see :ref:`Configure Websites in Back-Office <user-guide--system-websites>` and :ref:`Multiple Websites Concept Guide <website-management-concept-guide>`.

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   email-templates


.. include:: /include/include-links-dev.rst
   :start-after: begin
