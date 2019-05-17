.. _system-websites--prepare-to-host-a-website-in-the-domain-sub-folder:

Setup a Website Host
====================

In OroCommerce, websites may be exposed via different domains, or reside in the sub-folders of the same domain (e.g. the two websites that target the United States and the United Kingdom may be available at the *https://us-store.com* and *https://uk-store.com* respectively, or they may be reachable via *https://store.com/us* and *https://store.com/uk*).

For the websites with dedicated domains, you may use default OroCommerce installation, where all websites are installed into the web folder of the OroCommerce instance. However, you can move or copy the website to the sub-directory to support the websites with the shared domain (e.g. *https://store.com/us* and *https://store.com/uk*).

To prepare files for the website located in the sub-directory (e.g /uk), do the following:

1. Copy app.php from *web* directory into the new location (e.g. web/uk/) and modify it to update the relative paths (e.g. adding extra */..* prefix to the path).

   For example:

   .. code-block:: php
       :linenos:

       require_once __DIR__.'/../src/AppKernel.php';

   should be changed to

   .. code-block:: php
       :linenos:

       require_once __DIR__.'/../../src/AppKernel.php';

2. Add WEBSITE_PATH parameter to ServerBag before $response = $kernel->handle($request); This parameter value should be the new website folder name.

        ...
        $request = Request::createFromGlobals();
        $request->server->add(['WEBSITE_PATH' => '/<yoursitename>']);
        $response = $kernel->handle($request);
        ...

where <yoursitename> is *uk* in our example.

Now when you use the http://localhost/<yoursitename>/index_dev.php address, the asset files (styles.css, require.js, etc.) are taken from the root folder on the domain instead of the dedicated website sub-folder.

**Related Topics**

* :ref:`Configure a Website <user-guide--system-websites--configure-website>`
* :ref:`Manage a Website <user-guide--system-websites--manage-websites>`