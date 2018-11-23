.. _dev-guide-development-practice-setup-dev-env:

Setup Development Environment
=============================

To setup the development environment for Oro applications customization tasks, please follow the steps outlined in the sections below.

.. contents::
    :local:
    :depth: 2
    :backlinks: entry

.. _dev-guide-development-practice-setup-dev-env-requirements:

Meet the Hardware and OS Requirements
-------------------------------------

* **Operating System**

  The recommended OS for Oro applications is CentOS. However, it is possible to set up the development environment on any Linux, Mac, or Windows OS.

* **Disk Drive**

  A solid-state drive (SSD) is recommended. As Oro application uses lots of files (vendors, cache), a SSD makes everyday development operations much faster than when using HDD.

* **Available RAM**

  The recommended amount of available RAM is 8Gb for most development operations (e.g., upgrading the application or updating Composer dependencies). However, 2Gb of available RAM is usually enough to run the application.

.. _dev-guide-development-practice-setup-dev-env-prepare-tools:

Prepare Development Tools
-------------------------

.. https://oroinc.com/b2b-ecommerce/doc/current/community/contribute/code-dev-env

1. `Install Git <https://git-scm.com/book/en/v2/Getting-Started-Installing-Git>`_.

#. `Install Node.js <https://nodejs.org/en/download/package-manager/>`_ to build application assets.

#. `Install PHPStorm <https://www.jetbrains.com/help/phpstorm/install-and-set-up-product.html>`_ as the recommended IDE.

    .. note:: Although PHPStorm is recommended, it is not the required IDE for Oro application development. If you use a different IDE, skip the the PHPStorm configuration steps below.

#. Configure PHPStorm:

    #. Install and configure `Symfony plugin <https://plugins.jetbrains.com/plugin/7219-symfony-plugin>`_ and `Oro plugin <https://plugins.jetbrains.com/plugin/8449-oro-phpstorm-plugin>`_ by following the `official PHPStorm plugin management instructions <https://www.jetbrains.com/help/phpstorm/managing-plugins.html>`_.

    #. Exclude the following directories in PhpStorm (to avoid class duplication and indexation overhead) by right clicking on the directory and selecting **Mark Directory As > Excluded**:

       * var/cache
       * public/bundles

    #. Enable code quality checks in PHPStorm:

       * `Enable PHP Code Sniffer <https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm>`_ (use PSR2 or Symfony2 code standards)

       * `Enable PHP Mess Detector <https://confluence.jetbrains.com/display/PhpStorm/PHP+Mess+Detector+in+PhpStorm>`_ making sure that:

          * **Cyclomatic complexity** DOES NOT exceed the limit of **15**.
          * The limit of the **NPath complexity** is set to **200** (the default PHPMD limit).

.. _dev-guide-development-practice-setup-dev-env-create-app:

Create a Custom Application
---------------------------

1. Fork Oro application repository.

   Use the `Github guide on forking a repo <https://help.github.com/articles/fork-a-repo/>`_ as an illustration of how to fork Oro application repository.

   .. note:: Pay attention to the `Keep your fork synced <https://help.github.com/articles/fork-a-repo/#keep-your-fork-synced>`__ section of this Github guide. You have to set the original Oro application repository as the remote upstream in order to be able to pull improvements and fixes from the original Oro application.

4. (optional) Change the **README.md** file in your repo to describe your application.

5. (optional) Change the package name of your application in the **compser.json** file.

.. important:: Please be aware that in accordance with the :ref:`Oro PHP Application structure <architecture-oro-php-application-structure>`, you have to use only the following folders and files to place your code in your custom application:

    * **src**: the main folder for your customization code
    * **templates**: the folder for template files
    * **config**: folder the folder for config files
    * **translations**: the folder for translation files
    * **README.MD**: the file for the description of your custom application
    * **composer.json**: the file which you can change if you want to `make a package <https://symfonycasts.com/screencast/question-answer-day/create-composer-package>`_ from your custom application

.. _dev-guide-development-practice-setup-dev-env-setup-env:

Setup Application Environment
-----------------------------

Please, follow the **Step 1: Environment Setup** and **Step 2: Pre-installation Environment Configuration** of the :ref:`Installation Guide <install-for-dev>` to set up the environment for your custom application.

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

However, these features assume that all application code is **organized in bundles**. For this reason, you have to create your own bundle for your custom code in order to perform customization tasks.

Please, follow the `How to Create a New Bundle <https://oroinc.com/oroplatform/doc/current/dev-cookbook/framework/how-to-create-new-bundle>`_ cookbook article to create a bundle in your custom application.


.. Learn more

    customization_techniques
    development_routine/index
    ...
