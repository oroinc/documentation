.. index::
    single: Application; Co-install applications
    single: Application

How to Add OroCommerce Capabilities to the OroCRM Application
=============================================================

.. note:: Before install OroCommerce over OroCRM you should change default parameter ``web_backend_prefix`` to some non-empty prefix, f.e. - '/admin'.

.. warning:: To avoid access permissions issues, please review the Symfony `Setting up or Fixing File Permissions <http://symfony.com/doc/current/setup/file_permissions.html>`_ guide before running any commands. On top of that, consider running the command(s) below with `sudo -u [web server user name]` prefix.

To install OroCommerce and OroCRM from scratch, please `install OroCommerce application <https://oroinc.com/orocommerce/doc/current/install-upgrade>`_ that has OroCRM capabilities embedded out-of the-box.

To add OroCommerce to the existing instance of OroCRM, please follow the ordinary :ref:`upgrade process <upgrade>` and ensure you add the OroCommerce package as a dependency during the step 5. Once the upgrade process is complete, please run following commands to add necessary initial OroCommerce configuration:

.. code-block:: bash

    app/console oro:config:update oro_website.url https://unsecure.url
    app/console oro:config:update oro_website.secure_url http://secure.url

where `https://unsecure.url` and `http://secure.url` are urls for the OroCommerce storefront.