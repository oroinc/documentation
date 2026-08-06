.. _system-websites--prepare-to-host-a-website-in-the-domain-sub-folder:

Installation in Sub-Folder
==========================

.. hint:: This section is part of the :ref:`Multi-Website Configuration <website-management-concept-guide>` concept guide topic that provides a general understanding of the multiple-website configuration concept in Oro applications.

In OroCommerce, websites can be exposed on separate domains or hosted in sub-folders of the same domain. For example, the sites that target the United States and the United Kingdom may be available at *https://us-store.com* and *https://uk-store.com* respectively, or at *https://store.com/us* and *https://store.com/uk*.

Websites with dedicated domains can use the default OroCommerce installation, where all websites are installed into the web folder of the OroCommerce instance. To support websites that share a domain (e.g., *https://store.com/us* and *https://store.com/uk*), move or copy the website into a sub-directory instead.

To prepare files for the website located in the sub-directory (e.g., /uk), do the following:

1. Copy index.php from *public* directory into the new location (e.g., public/uk/) and modify it to update the relative paths (e.g., adding extra */..* prefix to the path).

   For example:

   .. code-block:: php

       require_once __DIR__.'/../vendor/autoload_runtime.php';

   should be changed to

   .. code-block:: php

       require_once __DIR__.'/../../vendor/autoload_runtime.php';

2. Add WEBSITE_PATH environment variable before return fn() => new AppKernel('dev', true);. This parameter value should be the new website folder name.

   .. code-block:: php

        // ...
        $_ENV['WEBSITE_PATH'] = '/<yoursitename>';

        return fn() => new AppKernel('dev', true);

where <yoursitename> is *uk* in our example.

Now, when you use the ``http://localhost/<yoursitename>/index.php`` address, the asset files (styles.css, app.js, etc.) are taken from the root folder on the domain instead of the dedicated website sub-folder.

**Related User Guide Topics**

* :ref:`Configure a Website <user-guide--system-websites--configure-website>`
* :ref:`Manage a Website <user-guide--system-websites--manage-websites>`


.. include:: /include/include-links-user.rst
   :start-after: begin
