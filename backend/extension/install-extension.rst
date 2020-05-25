.. _admin-package-manager:
.. _dev-cookbook-framework-how-to-manage-extensions:
.. _cookbook-extensions-composer:

.. index::
    single: Extension; Install extension
    single: Extension; Install extension from command line
    single: Extension

Install Extension from the Oro Marketplace
==========================================

.. caution::

    Before installing an extension it is recommended to back up the database and the application
    source code. There is no simple way to uninstall an extension.

Installing an extension from the Oro marketplace is the least resource-consuming way to expand the existing functionality of the Oro application.

Oro application’s marketplace is a catalog service for sharing packages that extend a particular Oro application. On the marketplace, Oro and third-party vendors may publish free or chargeable custom packages to distribute commonly-used extension solutions to the Oro community.

.. note:: See the :ref:`Oro PHP application structure <architecture-oro-php-application-structure>` topic for more information on the definition of a package and levels of extension and customization.

Browse published extensions for Oro applications on the following marketplaces:

* OroPlatform --- |https://marketplace.oroinc.com/oroplatform|
* OroCRM --- |https://marketplace.orocrm.com/|
* OroCommerce --- |https://marketplace.orocommerce.com/|

.. note:: Once the Oro application extension package is :ref:`published on the Oro marketplace <dev--extend--how-to-publish-extension-on-the-marketplace>`, it is automatically registered in the |Oro Packagist repository|. See a topic on a :ref:`Distribution Model <architecture-oro-php-application-structure>` for more information on using composer service with Packagist and OroPackagist repositories.

You can install extensions from the command-line.

Start with upgrading Composer to the latest version. This may be needed in case the extension to be
installed uses some bleeding edge feature in its ``composer.json`` file:

.. code-block:: bash

    $ composer self-update
    # add and download extension

Then, install the extension's Composer package using the Composer ``require`` command:

.. code-block:: bash

    $ composer require <extension name> --prefer-dist --update-no-dev

    .. note:: Find the required extension name on the extension view page on the Oro marketplace website.

            .. image:: /img/backend/extension/extension_name.png
               :alt: Classes of OroImportExportBundle

Next, remove old cache:

.. code-block:: bash

    sudo rm -rf var/cache/prod

Repeat this for any other extension you want to install. When you are finished with adding new
packages, use the ``oro:platform:update`` command to make the application aware of the newly
installed extensions:

.. code-block:: bash

    $ php bin/console oro:platform:update --env=prod --force

Finally, make sure to properly clean the cache:

.. code-block:: bash

    $ php bin/console cache:clear --env=prod


.. include:: /include/include-links-dev.rst
   :start-after: begin