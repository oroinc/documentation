.. _architecture-oro-php-application-structure:

.. begin_oro_php_app_structure

Oro PHP Application Structure
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**Table of Contents**

.. contents:: :local:

Source Code Repositories
^^^^^^^^^^^^^^^^^^^^^^^^

Source code of the Community Editions of OroPlatform, OroCRM, and OroCommerce applications is open and is available for download, contribution and collaboration on GitHub, in the `OroInc <https://github.com/oroinc/>`_ organization.

The repositories in OroInc organization may vary by type and contain the source code of the projects of various scale:

* Applications
* Packages
* Components

Any Oro application and packages may be used in the following modes:

* Oro application may by installed and immediately used in the production environment
* Oro application or Oro package source code may be used as a base for a custom application. Clone the Oro application repository, fork it, or download the source code as an archive and customize and extend the code as necessary.
* Oro packages may be embedded as ready-to-use features into any application. Create your own application from scratch and add Oro packages as composer dependencies. Read more about composer dependency manager in the Distribution Model section below.

An **application** repository stores a complete solution created to automate activities for the business domain (e.g. customer relationship management, B2B commerce, marketing automation, etc.) Oro application provides a set of features and delivers number of benefits to the end user. Apart from the source code that implements business logic for the application features, Oro application repositories contain minimal set of configuration and initialization scripts for installing and running Oro application in dev, test, or prod environment.

Sample applications: `OroCRM <https://github.com/oroinc/crm-application>`_, `OroCommerce <https://github.com/oroinc/orocommerce-application>`_, `OroPlatform <https://github.com/oroinc/platform-application>`_

A **package** repository contains a module that groups a set of ready-to-use features, usually those related to a particular business subdomain, and may be included into any Oro application. To enable Oro package in the Oro application, add it as a dependency/prerequisite before you start Oro application installation. As long as Oro application uses Symfony framework, packages may contain `Bundles <https://symfony.com/doc/current/bundles.html>`_.

For example, `Marketing <https://github.com/oroinc/OroCRMMarketingBundle>`_ package is enabled out of the box in OroCRM and OroCommerce applications.

A component repository contains a source code of the reusable development module that enables a set of commonly used functions that may be used as third party libraries, without Oro application. Rather than a complete business feature, Oro component may handle generic functionality that is not bound to the business domain. Component repositories are typically published as read-only subtree distributions of independent package bundles or components.

Sample component: `OroMessageQueueBundle <https://github.com/oroinc/OroMessageQueueBundle>`_

You can find a complete list of OroInc public repositories at https://github.com/oroinc/.

.. note:: Any Oro application and packages may be used in the following modes:

   * Oro application may by installed and immediately used in the production environment
   * Oro application or Oro package source code may be used as a base for a custom application. Clone the Oro application repository, fork it, or download the source code as an archive and customize and extend the code as necessary.
   * Any PHP application may use Oro component(s) as a third party library. In a similar way, Oro packages may be embedded into any PHP application as ready-to-use features. Create your own application from scratch and add Oro packages as composer dependencies. Keep reading for more information about composer dependency manager.

Distribution Model
^^^^^^^^^^^^^^^^^^

Oro application uses `composer <https://getcomposer.org/>`_ as an application-level dependency manager. It was selected for being massively used and highly popular with the PHP development community.

With composer, you can manage dependencies by editing the composer.json file (see `composer.json <https://github.com/oroinc/crm-application/blob/master/composer.json>`_ sample and `composer documentation <https://getcomposer.org/doc/>`_ for more information).

Every Oro application contains a composer.json file in the application root directory.

.. note:: Note that installation requires `composer.json` file to define the package dependencies and the minimal required version for every package. However, with a composer.lock which is a file that is created as an artifact after the installation, the package dependencies may be additionally locked to the exact package version per package. This is used to avoid unexpected behaviour that may occur whenever the newer version of the package diverges from the older version and introduces changes to the critical features.

The required packages (dependencies) are listed in the following way:

.. code::

   ...

   "require": {
        "oro/crm": "2.x-dev",
        "oro/platform-serialised-fields": "2.x-dev",
        "oro/crm-hangouts-call-bundle": "2.x-dev",
        "oro/abandoned-cart": "2.x-dev",
        "oro/crm-magento-embedded-contact-us": "2.x-dev",
        "oro/mailchimp": "2.x-dev",
        "oro/crm-dotmailer": "2.x-dev",
        "oro/crm-zendesk": "2.x-dev"
        },

   ...

Oro packages are registered in the `Packagist <https://packagist.org/>`_ and `OroPackagist <https://packagist.oroinc.com/>`_ which enables their installation (in `CLI <https://getcomposer.org/doc/03-cli.md>`_ or `IDE <https://www.jetbrains.com/help/phpstorm/composer-dependency-manager.html>`_) via `composer <https://getcomposer.org/>`_.

These packages may be registered at:

* The public `Packagist <https://packagist.org/>`_ (e.g. a third-party package)
* `OroPackagist <https://packagist.oroinc.com/>`_ (e.g. other Oro package that was registered earlier)
* Bower or NPM packages from `Oro Asset Packagist <https://asset-packagist.oroinc.com/>`_.

For registration, Oro application or package submits the metadata to the composer using *composer.json* file located in the root directory of the application/package source code in the github repository:

.. code::

   "name": "oro/commerce-crm-application",
   "description": "OroCommerce - an open-source Business to Business Commerce application.\\This package contains a sample application.",
   "license": "OSL-3.0",
   "authors": [
     {
       "name": "Oro, Inc",
       "homepage": "https://www.oroinc.com/orocommerce"
     }
   ],

After registration, the **package** is listed in the `Packagist <https://packagist.org/>`_  and `OroPackagist <https://packagist.oroinc.com/>`_. You can browse registered OroInc packages at https://packagist.oroinc.com/explore/.

Note: The **package** links to the package source code repository and may also contain information about the package required dependencies, configuration, scripts that should be executed during the package installation (e.g. post-install and post-update scripts), etc. You may use the package as a dependency in your custom application, like Oro applications use Oro packages.

See sample `composer.json <https://github.com/oroinc/crm-application/blob/master/composer.json>`_ .

File System Structure
^^^^^^^^^^^^^^^^^^^^^

Oro PHP Application File System Structure
"""""""""""""""""""""""""""""""""""""""""

From a file system perspective, Oro PHP application contains a structured combination of configuration and initialization files used to build application source code. Typically, Oro application folders are organized in the following way:

* **bin** folder - executable scripts for application maintenance
* **config** folder - application configuration files
* **public** folder - the web server root directory with accessible public files

   * **bundles** - static assets created based on public resources of application dependencies (third-party bundles and packages)
   * **css** - CSS files generated based on bundle Resources/config/oro/assets.yml definitions
   * **images** - images pre-processed by Symfony Assetic and optimized for the web
   * **js** - javascript files generated based on the source code of the application packages: routes, translations, minified files, etc.
   * **media** - the folder for application media (images) cache generation
   * **uploads** - writable folder for uploading user files
   * **index.php** - the main application entry point

* **src** folder - application customization PHP source code
* **templates** folder - application customization templates
* **translations** folder - application customization translation files
* **var** folder - application generated files

   * **attachment** - files uploaded to the application as attachments
   * **cache** - framework and application cache files
   * **import_export** - files generated during data import and export
   * **logs** - application logs

* **vendor** folder - code of 3rd party vendors installed based on the definition of dependencies in composer.json.
* **composer.json** file - definition of application dependencies
* **composer.lock** file - the list of initialized dependencies
* **README.md** file - a brief description of the application

Oro Package File System Structure
"""""""""""""""""""""""""""""""""

A package contains a reusable code for Oro applications. During the Oro application installation, the package code is installed in the vendor folder of the application and should not be modified by customization as it is overwritten with the original version upon the system upgrade. The source code of the package includes:

* composer.json file with package metadata that includes package definition and dependencies.
* LICENSE - license information
* README.md file with detail description of the package
* Folders with the source code organized into implementing package functionality. Package source code can be organized in a different ways and typically defines one or more Bundle, Bridge and/or Component.

It is recommended to include additional files, like:

* UPGRADE.md - information about upgrading from old version of the package to new one
* CHANGELOG.md - list of changes made in the package since previous version
* phpunit.xml.dist - template of phpunit.xml which can be used to run package tests


.. finish_oro_php_app_structure

.. Next step: :ref:`??? <>`
