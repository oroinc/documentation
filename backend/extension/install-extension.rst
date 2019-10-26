.. _admin-package-manager:
.. _dev-cookbook-framework-how-to-manage-extensions:
.. _cookbook-extensions-composer:

.. index::
    single: Extension; Install extension
    single: Extension; Install extension from command line
    single: Extension

Installing an Extension
=======================

.. caution::

    Before installing an extension it is recommended to back up the database and the application
    source code. There is no simple way to uninstall an extension.

You can install extensions from the command-line.

Start with upgrading Composer to the latest version. This may be needed in case the extension to be
installed uses some bleeding edge feature in its ``composer.json`` file:

.. code-block:: bash

    $ composer self-update
    # add and download extension

Then, install the extension's Composer package using the Composer ``require`` command:

.. code-block:: bash

    $ composer require <extension name>:<extension-version> --prefer-dist --update-no-dev

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


.. include:: /include/include-links.rst
   :start-after: begin