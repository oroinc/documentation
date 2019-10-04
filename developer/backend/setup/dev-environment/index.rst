.. _dev-guide-development-practice-setup-dev-env:

Setup Development Environment
=============================

To set up the development environment for Oro applications customization tasks, please follow the steps outlined in the sections below.

.. _dev-guide-development-practice-setup-dev-env-requirements:

Meet the Hardware and OS Requirements
-------------------------------------

* **Operating System**

  The recommended OS for Oro applications is CentOS. However, it is possible to set up the development environment on any Linux, Mac, or Windows OS.

* **Disk Drive**

  A solid-state drive (SSD) is recommended. As Oro application uses lots of files (vendors, cache), an SSD makes everyday development operations much faster than when using HDD.

* **Available RAM**

  The recommended amount of available RAM is 8Gb for most development operations (e.g., upgrading the application or updating Composer dependencies). However, 2Gb of available RAM is usually enough to run the application.

.. _dev-guide-development-practice-setup-dev-env-prepare-tools:

Prepare Development Tools
-------------------------

1. |Install Git|.

#. |Install Node.js| to build application assets.

#. |Install PHPStorm| as the recommended IDE.

    .. note:: Although PHPStorm is recommended, it is not the required IDE for Oro application development. If you use a different IDE, skip the PHPStorm configuration steps below.

#. Configure PHPStorm:

    #. Install and configure |Symfony plugin| and |Oro plugin| by following the |official PHPStorm plugin management instructions|.

    #. Exclude the following directories in PhpStorm (to avoid class duplication and indexation overhead) by right-clicking on the directory and selecting **Mark Directory As > Excluded**:

       * var/cache
       * public/bundles

    #. Enable code quality checks in PHPStorm:

       * |Enable PHP Code Sniffer| (use PSR2 or Symfony2 code standards)

       * |Enable PHP Mess Detector|, making sure that:

          * **Cyclomatic complexity** DOES NOT exceed the limit of **15**.
          * The limit of the **NPath complexity** is set to **200** (the default PHPMD limit).

.. _dev-guide-development-practice-setup-dev-env-create-app:

Create a Custom Application
---------------------------

1. Fork Oro application repository.

   Use the |Github guide on forking a repo| as an illustration of how to fork the Oro application repository.

   .. note:: Pay attention to the |Keep your fork synced| section of this Github guide. You have to set the original Oro application repository as the remote upstream in order to be able to pull improvements and fixes from the original Oro application.

4. (optional) Change the **README.md** file in your repo to describe your application.

5. (optional) Change the package name of your application in the **composer.json** file.

.. important:: Please be aware that in accordance with the :ref:`Oro PHP Application structure <architecture-oro-php-application-structure>`, you have to use only the following folders and files to place your code in your custom application:

    * **src**: the main folder for your customization code
    * **templates**: the folder for template files
    * **config**: folder the folder for config files
    * **translations**: the folder for translation files
    * **README.MD**: the file for the description of your custom application
    * **composer.json**: the file which you can change if you want to |make a package| from your custom application

.. _dev-guide-development-practice-setup-dev-env-setup-env:

Setup Application Environment
-----------------------------

Please, follow **Step 1: Environment Setup** and **Step 2: Pre-installation Environment Configuration** of the :ref:`Installation Guide <install-for-dev>` to set up the environment for your custom application.

.. note:: If the OS on your development machine is other than CentOS, consider using a virtual machine running on CentOS to create the environment for your custom application.

.. @todo Later add alternative - use Vagrant to create a development environment

.. _dev-guide-development-practice-setup-dev-env-install-app:

Install Your Application
------------------------

When the environment is set up, follow the instructions in **Step 3: OroPlatform Application Installation** and **Step 4: Post-installation Environment Configuration** sections of the :ref:`Installation Guide <install-for-dev>` to install your application.

.. _dev-guide-development-practice-setup-dev-env-create-bundle:

Create a Custom Bundle
----------------------

All OroPlatform-based applications have unique features that facilitate smooth development routine, like autoregistration of bundles and configuration files, for example.

However, these features assume that all application code is **organized in bundles**. For this reason, you have to create your own bundle for your custom code to perform customization tasks.

Please, follow the :ref:`How to Create a New Bundle <how-to-create-new-bundle>` cookbook article to create a bundle in your custom application.

.. note::

   A **priority** parameter of your bundle should be greater than **210** to make the bundle loaded after all Oro application bundles and to allow override of configuration files from Oro bundles.

.. toctree::
   :titlesonly:
   :hidden:
   :maxdepth: 1

   local-server-setup/index

.. include:: /include/include-links.rst
   :start-after: begin