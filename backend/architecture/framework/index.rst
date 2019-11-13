.. _dev-guide-application-web-framework:

Application Framework
=====================

**Application Framework** functionality is a part of **OroPlatform** that determines the structure of the Oro application (code
organization, file structure, application flow routine) and the way of interaction between independent components in the application.

In this section, you'll find a description of the main principles on how to organize your adjustments to Oro applications.

How It Works
------------

Application Framework functionality in OroPlatform is based on the |Symfony Framework| and extends it in the
|OroPlatformBundle| and |OroDistributionBundle| to improve several aspects of development experience.

Please refer to the :ref:`Architecture Principles of Oro Applications <dev-guide-application-web-framework-symfony>` article
for the synopsis of structural aspects of the Oro applications:

* :ref:`Symfony Role in OroPlatform <dev-guide-application-web-framework-symfony-symfony-role-in-oroplatform>`
* :ref:`HTTP Request Application Flow <dev-guide-application-web-framework-symfony-http-request-application-flow>`
* :ref:`Event System <dev-guide-application-web-framework-symfony-event-system>`
* :ref:`Inversion of Control Principle <dev-guide-application-web-framework-symfony-inversion-of-control-principle>`
* :ref:`Bundle System <dev-guide-application-web-framework-symfony-bundle-system>`
* :ref:`Application Directory Structure <dev-guide-application-web-framework-symfony-application-directory-structure>`
* :ref:`Application Configuration <dev-guide-application-web-framework-symfony-application-configuration>`
* :ref:`Templating System <dev-guide-application-web-framework-symfony-templating-system>`
* :ref:`Security System (Data Access Management) <dev-guide-application-web-framework-symfony-security-system-data-access-management>`
* :ref:`Databases Management (Doctrine ORM) <dev-guide-application-web-framework-symfony-databases-management-doctrine-orm>`
* :ref:`CLI Application <dev-guide-application-web-framework-symfony-cli-application>`
* :ref:`List of Symfony Components Used in Oro Applications <dev-guide-application-web-framework-symfony-list-of-symfony-components-used-in-oro-applications>`

Getting Started
---------------

If you want to adjust Oro application functionality, the **first step** to organize your changes always should be
`Prepare Your Custom Application`_:

* `Create a Custom Application`_ and
* `Create a New Bundle`_.

**Next steps** depend on whether you're going to `Create a New Functionality`_ or to
`Change an Existing Functionality`_.

**Finally**, if you're ready to pack and share your adjustments to Oro application, you can
`Create and Publish an Extension`_ to the |Oro marketplace|.

Prepare Your Custom Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Create a Custom Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see the :ref:`Create Custom Oro Application <dev-cookbook-create-custom-oro-application>` cookbook article.

Create a New Bundle
^^^^^^^^^^^^^^^^^^^

Please see the :ref:`How To Create New Bundle <dev-cookbook-framework-how-to-create-new-bundle>` article.

Create a New Functionality
~~~~~~~~~~~~~~~~~~~~~~~~~~

Please see the basic example on how to create a new functionality in the
:ref:`Create a Simple CRUD <dev-cookbook-framework-create-simple-crud>` article.

Change an Existing Functionality
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you want to change the existing behavior of Oro application, please refer to the
:ref:`Oro Application Customization <architecture--customization--customize>` section of the Architecture Guide
for the guidance.

Create and Publish an Extension
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you are ready to publish your adjustment in Oro application for free or paid usage of community members, see the
:ref:`How to Add an Extension to the OroPlatform Marketplace <dev-cookbook-framework-how-to-add-extension-to-marketplace>`
article for the details on how to do this.

Related Cookbook Articles
-------------------------

* :ref:`Create Custom Oro Application <dev-cookbook-create-custom-oro-application>`
* :ref:`Create a Simple CRUD <dev-cookbook-framework-create-simple-crud>`
* :ref:`How to Create a New Bundle <dev-cookbook-framework-how-to-create-new-bundle>`
* :ref:`How to Add an Extension to the OroCRM Marketplace <dev-cookbook-framework-how-to-add-extension-to-marketplace>`
* :ref:`How to Manage OroPlatform Extensions <dev-cookbook-framework-how-to-manage-extensions>`

.. toctree::
   :hidden:

   architecture-principles


.. Future Subsections of this guide:Symfony (Application, Application Structure, Bundle, Bundle Structure, Entity, Controller, Templates, DI container, Extensions)+PlatformBundle (auto-dicsovery of configuration files and maintenance mode, lazy services, disable listeners, global options for all commands)+DistributionBundle (bundles auto-registration, routing auto-registration, package management)ConfigBundle InstallerBundle FeatureToggleBundle

.. Currently we describe only Symfony, PlatformBundle and DistributionBundle parts

.. include:: /include/include-links-dev.rst
   :start-after: begin