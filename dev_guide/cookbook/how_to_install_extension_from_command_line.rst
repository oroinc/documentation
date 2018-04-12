.. index::
    single: Extension; Install extension
    single: Extension; Install extension from command line
    single: Extension

.. _admin-package-manager:

How to Manage OroPlatform Extensions
=====================================

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

Installing an Extension
-----------------------

.. caution::

    Before installing an extension it is recommended to back up the database and the application
    source code. There is no simple way to uninstall an extension.

There are two ways to install extensions from the command-line:

#. :ref:`Use the package manager <cookbook-extensions-package-manager>` if the extension is
   available via the `OroCRM Marketplace`_.
#. Alternatively, :ref:`you can use Composer <cookbook-extensions-composer>` to download an
   extension.

.. _cookbook-extensions-package-manager:

Using the Package Manager
~~~~~~~~~~~~~~~~~~~~~~~~~

First, clear the cache to make sure that the package reads the list of packages from the server:

.. code-block:: bash

    $ php app/console cache:clear --env=prod

Then use the ``oro:package:install`` command to install the extension:

.. code-block:: bash

    $ php app/console oro:package:install <extension name> <extension-version> --env=prod

Finish the installation by clearing the cache again:

.. code-block:: bash

    $ php app/console cache:clear --env=prod

.. _cookbook-extensions-composer:

Using Composer
~~~~~~~~~~~~~~

Start with upgrading Composer to the latest version. This may be needed in case the extension to be
installed uses some bleeding edge feature in its ``composer.json`` file:

.. code-block:: bash

    $ composer self-update
    # add and download extension

Then, install the extension's Composer package using the Composer ``require`` command:

.. code-block:: bash

    $ composer require <extension name>:<extension-version> --prefer-dist --update-no-dev

Repeat this for any other extension you want to install. When you are finished with adding new
packages, use the ``oro:platform:update`` command to make the application aware of the newly
installed extensions:

.. code-block:: bash

    $ php app/console oro:platform:update --env=prod --force

Finally, make sure to properly clean the cache:

.. code-block:: bash

    $ php app/console cache:clear --env=prod

Querying Extension Information
------------------------------

There are two commands that can help you get an overview of the extension.

The ``oro:package:available`` command can be used to retrieve a list of all available extensions:

.. code-block:: bash

    $ php app/console oro:package:available --env=prod

If you are only interested in the currently installed extensions, run the ``oro:package:installed``
command:

.. code-block:: bash

    $ php app/console oro:package:installed --env=prod

.. _`OroCRM Marketplace`: http://marketplace.orocrm.com/
