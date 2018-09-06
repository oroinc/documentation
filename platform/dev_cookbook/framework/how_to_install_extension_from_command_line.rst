.. _dev-cookbook-framework-how-to-manage-extensions:

How to Manage OroPlatform Extensions
====================================

Install an Extension
--------------------

.. caution::

    Before installing an extension, it is recommended to back up the database and the application
    source code, as uninstalling the extension later may prove to be fairly complex.
    
There are two ways to install extensions from the command-line:

#. :ref:`Use the package manager <cookbook-extensions-package-manager>` if the extension is
   available via the `OroCRM Marketplace`_.
#. Alternatively, :ref:`you can use Composer <cookbook-extensions-composer>` to download an
   extension.

.. _cookbook-extensions-package-manager:

Use the Package Manager
~~~~~~~~~~~~~~~~~~~~~~~

1. Clear the cache to make sure that the package reads the list of packages from the server:

   .. code-block:: bash
   
       $ php bin/console cache:clear --env=prod
   
2. Use the ``oro:package:install`` command to install the extension:

   .. code-block:: bash
   
       $ php bin/console oro:package:install <extension name> <extension-version> --env=prod
   
3. Finish the installation by clearing the cache again:

   .. code-block:: bash
   
       $ php bin/console cache:clear --env=prod
   
.. _cookbook-extensions-composer:

Use Composer
~~~~~~~~~~~~

1. Upgrading Composer to the latest version. 

   This may be necessary if the extension you are installing uses a bleeding edge feature in its ``composer.json`` file:

   .. code-block:: bash
   
       $ composer self-update

2. Install the extension's Composer package using the Composer ``require`` command:

   .. code-block:: bash
   
       $ composer require <extension name>:<extension-version> --prefer-dist --update-no-dev

   Repeat this for any other extension that you want to install. 
   
3. When you are finished adding new packages, use the ``oro:platform:update`` command to make the application aware of the newly
   installed extensions:
   
   .. code-block:: bash
   
       $ php bin/console oro:platform:update --env=prod --force
   
4. Clean the cache:

   .. code-block:: bash
   
       $ php bin/console cache:clear --env=prod

Query Extension Information
---------------------------

There are two commands that can help you get an overview of the extension.

* The ``oro:package:available`` command can be used to retrieve a list of all available extensions:

  .. code-block:: bash
  
      $ php bin/console oro:package:available --env=prod

* If you are only interested in the currently installed extensions, run the ``oro:package:installed`` command:

  .. code-block:: bash
  
      $ php bin/console oro:package:installed --env=prod

.. _`OroCRM Marketplace`: http://marketplace.orocrm.com/
