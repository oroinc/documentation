.. _dev-guide-development-practice-setup-dev-env:
.. _doc--dev-env-best-practices:

Set Up Development Environment for OroPlatform Based Application
================================================================

Please follow the steps outlined in the sections below to set up the development environment for Oro application customization tasks.

.. admonition:: Business Tip

    Are you searching for the |best B2B eCommerce solution|? Utilize our platform comparison chart to weigh your alternatives.


.. _dev-guide-development-practice-setup-dev-env-requirements:

Meet the Hardware and OS Requirements
-------------------------------------

* **Operating System**

  The recommended OS for Oro applications is Oracle Linux. However, it is possible to set up the development environment on any Linux, Mac, or Windows with WSL2.

* **Disk Drive**

  A solid-state drive (SSD) is recommended. As the Oro application uses many files (vendors, cache), an SSD speeds up everyday development operations much faster than an HDD.

* **Available RAM**

  The recommended amount of available RAM is 8Gb for most development operations (e.g., upgrading the application or updating Composer dependencies). However, 2Gb of available RAM is usually enough to run the application.

.. _dev-guide-development-practice-setup-dev-env-prepare-tools:

Prepare Development Tools
-------------------------

1. |Install Git|.

#. |Install PHPStorm| as the recommended IDE.

   .. note:: Although PHPStorm is recommended, it is not the required IDE for Oro application development. If you use a different IDE, skip the PHPStorm configuration steps below.

#. Configure PHPStorm:

   * Install and configure |Symfony plugin| and |Oro plugin| by following the |official PHPStorm plugin management instructions|.

   * Exclude the following directories in PhpStorm (to avoid class duplication and indexation overhead) by right-clicking on the directory and selecting **Mark Directory As > Excluded**:

     * var/cache
     * public/bundles

   * Enable code quality checks in PHPStorm:

     * |Enable PHP Code Sniffer| (use PSR2 or Symfony2 code standards)
     * |Enable PHP Mess Detector|, making sure that:

       * **Cyclomatic complexity** DOES NOT exceed the limit of **15**.
       * The limit of the **NPath complexity** is set to **200** (the default PHPMD limit).
     * |Enable PHP CS Fixer| (use |PHP CS Fixer settings| )

   * Configure xDebug

     * Integrate a debugging tool into your IDE that provides a range of features to improve the PHP development experience. See |how to set up integration between PhpStorm and xDebug| for more information.

   * Configure PhpUnit

     * If you write tests for your code, integrate |PhpUnit with PhpStorm| and use it |for actual testing|.

     .. note:: You can also set the default configuration for the PhpUnit test runner (path to phpunit.xml, the working directory, etc.). Then you can right-click a test file and select **Run <file>** to run all tests from the file.

.. _dev-guide-development-practice-setup-dev-env-create-app:

Create a Custom Application
---------------------------

1. Fork Oro application repository.

   Use the |Github guide on forking a repo| as an illustration of how to fork the Oro application repository.

   .. note:: Pay attention to the |Keep your fork synced| section of this Github guide. You have to set the original Oro application repository as the remote upstream in order to be able to pull improvements and fixes from the original Oro application.

2. (optional) Change the **README.md** file in your repo to describe your application.

3. (optional) Change the package name of your application in the **composer.json** file.

.. important:: Please be aware that in accordance with the :ref:`Oro PHP Application structure <architecture-oro-php-application-structure>`, you have to use only the following folders and files to place your code in your custom application:

    * **src**: the main folder for your customization code
    * **templates**: the folder for template files
    * **config**: folder the folder for config files
    * **translations**: the folder for translation files
    * **README.MD**: the file for the description of your custom application
    * **composer.json**: the file which you can change if you want to |make a package| from your custom application

.. _dev-guide-development-practice-setup-dev-env-setup-env:

Set Up Application Environment
------------------------------

We recommend using :ref:`Docker and Symfony Server <setup-dev-env-docker-symfony>` to set up the environment for your custom Oro application.

.. hint::

   There are quick guides to set up the Docker and Symfony Server development stack:

   - :ref:`Setup on Mac OS X <setup-dev-env-docker-symfony_mac>`
   - :ref:`Setup on Ubuntu 24.04 LTS <setup-dev-env-docker-symfony_ubuntu>`
   - :ref:`Setup on Windows Subsystem for Linux (WSL) 2 <setup-dev-env-docker-symfony_windows>`

Alternatively, to have a fully dockerized environment, you can use |Docker images and stacks for OroPlatform based applications by the Kiboko team|.

To check that the environment meets the application requirements, use the ``oro:check-requirements`` command:

.. code-block:: none

   php bin/console oro:check-requirements

By default, this command shows only errors, but you can increase the verbosity to see warnings and informational messages too:

.. code-block:: none

   php bin/console oro:check-requirements -v

.. code-block:: none

   php bin/console oro:check-requirements -vv

The command will return 0 on exit if all application requirements are met and 1 if some of the requirements are not fulfilled.

.. _dev-guide-development-practice-setup-dev-env-install-app:

Install Your Application
------------------------

When the environment is set up, follow the instructions in the :ref:`Installation Guide <install-for-dev>` to install your application.

.. note::

   If you use :ref:`Docker and Symfony Server <setup-dev-env-docker-symfony>`, follow :ref:`this guide <setup-dev-env-docker-symfony-install-application>`.


.. _dev-guide-development-practice-setup-dev-env-create-bundle:

Create a Custom Bundle
----------------------

All OroPlatform-based applications have unique features that facilitate smooth development routines, like autoregistration of bundles and configuration files, for example.

However, these features assume that all application code is **organized in bundles**. For this reason, you have to create your own bundle for your custom code to perform customization tasks.

Please, follow the :ref:`How to Create a New Bundle <how-to-create-new-bundle>` cookbook article to create a bundle in your custom application.

.. note::

   A **priority** parameter of your bundle should be greater than **210** to make the bundle loaded after all Oro application bundles and to allow override of configuration files from Oro bundles.

.. toctree::
   :titlesonly:
   :hidden:
   :maxdepth: 1

   Setup on Ubuntu <ubuntu>
   Setup on macOS <mac>
   Setup on Windows <windows>
   Docker & Symfony Server <docker-and-symfony/index>
   Web Server Configuration <web-server-config>
   Configuration Parameters <parameters-yml>
   Environment Variables <env-vars>
   Healthcheck and Data Monitoring <monitoring>
   Setup From Database Dump <setup-from-db-dump>
   Oro Devbox VM <orodevbox>


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
