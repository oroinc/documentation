.. _architecture-oro-php-application-structure:

.. begin_oro_php_app_structure

Application Structure
=====================

Source Code Repositories
------------------------

Source code of the Community Editions of OroPlatform, OroCRM, and OroCommerce applications is open and is available for download, contribution, and collaboration on GitHub, in the |OroInc| organization.

The repositories in the OroInc organization may vary by type and contain the source code of the projects of various scales:

* Applications
* Packages
* Components

You can use any Oro application and packages in the following modes:

* Oro application may be installed and immediately used in the production environment
* Oro application or Oro package source code may be used as a base for a custom application. Clone the Oro application repository, fork it, or download the source code as an archive and customize and extend the code as necessary.
* Oro packages may be embedded as ready-to-use features into any application. Create your own application from scratch and add Oro packages as composer dependencies. Read more about composer dependency manager in the `Distribution Model`_ section below.

An **application** repository stores a complete solution created to automate activities for the business domain (e.g., customer relationship management, B2B commerce, marketing automation, etc.) Oro application provides a set of features and delivers many benefits to the end user. Besides the source code that implements business logic for the application features, Oro application repositories contain minimal configuration and initialization scripts for installing and running the Oro application in the dev, test, or prod environment.

Sample applications: |OroCRM|, |OroCommerce|, |OroPlatform|.

A **package** repository contains a module that groups a set of ready-to-use features, usually those related to a particular business subdomain, and may be included in any Oro application. To enable an Oro package in the Oro application, add it as a dependency/prerequisite before you start the Oro application installation. As long as the Oro application uses the Symfony framework, packages may contain |Bundles|.

For example, the |Marketing| package is, by default, enabled in OroCRM and OroCommerce applications.

A component repository contains the source code of the reusable development module that enables a set of commonly used functions that you can use as third-party libraries without the Oro application. Rather than a complete business feature, the Oro component can handle generic functionality that is not bound to the business domain. Component repositories are typically published as read-only subtree distributions of independent package bundles or components.

Sample component: |OroMessageQueueBundle|

You can find a complete list of OroInc public repositories at |https://github.com/oroinc/|.

Distribution Model
------------------

Oro application uses |composer| as an application-level dependency manager. It is widely used and popular in the PHP development community.

With composer, you can manage dependencies by editing the composer.json file (see |composer.json| sample and |composer documentation| for more information).

Every Oro application contains a composer.json file in the application root directory.

.. note:: Installation requires the `composer.json` file to define the package dependencies and the minimum required version for every package. However, with a composer.lock (a file created as an artifact after the installation), the package dependencies can be additionally locked to the exact package version per package. This is used to avoid unexpected behavior that may occur whenever the newer version of the package diverges from the older version and introduces changes to the critical features.

The required packages (dependencies) are listed in the following way:

.. code-block:: none

   ...

   "require": {
        "oro/crm": "2.x-dev",
        "oro/platform-serialised-fields": "2.x-dev",
        "oro/crm-hangouts-call-bundle": "2.x-dev",
        "oro/mailchimp": "2.x-dev",
        "oro/crm-dotmailer": "2.x-dev",
        "oro/crm-zendesk": "2.x-dev"
        },

   ...

Oro packages are registered in the |Packagist| and |OroPackagist| which enables their installation (in |CLI| or |IDE|) via |composer|.

You can register these packages at:

* The public |Packagist| (e.g., a third-party package)
* |OroPackagist| (e.g., other Oro package registered earlier)
* Bower or NPM packages from |Oro Asset Packagist|.

For registration, Oro application or package submits the metadata to the composer using the *composer.json* file located in the root directory of the application/package source code in the GitHub repository:

.. code-block:: none

   "name": "oro/commerce-crm-application",
   "description": "OroCommerce - an open-source Business to Business Commerce application.\\This package contains a sample application.",
   "license": "OSL-3.0",
   "authors": [
     {
       "name": "Oro, Inc",
       "homepage": "https://www.oroinc.com/orocommerce"
     }
   ],

After registration, the **package** is listed in the |Packagist|  and |OroPackagist|. You can browse registered OroInc packages at |https://packagist.oroinc.com/explore/|.

.. note:: The **package** links to the package source code repository and may also contain information about the package required dependencies, configuration, scripts that should be executed during the package installation (e.g., post-install and post-update scripts), etc. You may use the package as a dependency in your custom application like Oro applications use Oro packages.

See sample |composer.json|.

File System Structure
---------------------

Oro PHP Application File System Structure
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

From a file system perspective, the Oro PHP application contains a structured combination of configuration and initialization files used to build application source code. Typically, Oro application folders are organized in the following way:

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

  * **data** - a local filesystem path to store private adapter files (attachments, import and export files, etc.)
  * **cache** - framework and application cache files
  * **logs** - application logs

* **vendor** folder - code of 3rd party vendors installed based on the definition of dependencies in composer.json.
* **composer.json** file - definition of application dependencies
* **composer.lock** file - the list of initialized dependencies
* **README.md** file - a brief description of the application

Oro Package File System Structure
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A package contains reusable code for Oro applications. During the Oro application installation, the package code is installed in the application's vendor folder. It should not be modified by customization as it is overwritten with the original version upon the system upgrade. The source code of the package includes:

* composer.json file with package metadata that includes package definition and dependencies.
* LICENSE - license information
* README.md file with a detailed description of the package
* Folders with the source code organized into implementing package functionality. The package source code can be organized differently and typically defines one or more Bundle, Bridge and/or Component.

We recommend to include additional files, like:

* UPGRADE.md - information about upgrading from the old version of the package to the new one
* CHANGELOG.md - list of changes made in the package since the previous version
* phpunit.xml.dist - template of phpunit.xml, which can be used to run package tests

.. finish_oro_php_app_structure

**Related Articles**

* :ref:`Bundle-less Structure <dev-backend-architecture-bundle-less-structure>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin