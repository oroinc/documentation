.. _dev-guide-application-web-framework-symfony:

Architecture Principles of Oro Applications
===========================================

.. contents::
    :local:
    :depth: 2
    :backlinks: entry

.. _dev-guide-application-web-framework-symfony-symfony-role-in-oroplatform:

Symfony Role in OroPlatform
---------------------------

.. note:: We are using `Symfony Framework <https://symfony.com/>`_ v. 3.4 LTS in Oro Applications v.3.x.

Currently Symfony is the most mature PHP framework that provides a wide range of functions that are typical for any web
application. Symfony takes care of numerous tasks, for instance:

- Receiving a user request and transforming it into a response for the user’s browser
- Organizing the source code in a conventional structure
- Providing tools for continuous storage of application data, validation of income data against some set of rules
- etc.

For more information on Symfony, its purpose and benefits, please have a look at the following articles on the symfony website:

* `Symfony versus Flat PHP: Why is Symfony better than just opening up a file and writing flat PHP? <https://symfony.com/doc/3.4/introduction/from_flat_php_to_symfony2.html>`_.
* `7 Good Reasons to Use Symfony Framework for Your Project <https://hackernoon.com/7-good-reasons-to-use-symfony-framework-for-your-project-265f96dcf759>`_
* `Why Symfony? Seven Facts <https://matthiasnoback.nl/2013/08/why-symfony-seven-facts/>`_

Using Symfony allows web applications to avoid the development of low-level components which are responsible for the organization of the application, and focus on developing a functionality that is specific to a particular web application.

Oro applications have a lot in common with regular Symfony applications that are based on the 3th version of the framework. So, if you are not familiar with Symfony yet - start your acquaintance with Oro application from the *Getting Started* and *Guides* sections of the official `Symfony documentation <https://symfony.com/doc/3.4/index.html>`_.

There are a number of Symfony features which had a substantial impact on the architecture of all Oro applications. Some of them are listed below, along with the description of how these features were adjusted and altered specifically for Oro applications comparing to other Symfony-based applications.

.. _dev-guide-application-web-framework-symfony-http-request-application-flow:

HTTP Request Application Flow
-----------------------------

Symfony framework (and its `HttpKernel component <https://symfony.com/doc/3.4/components/http_kernel.html>`_) determines
the main flow of Oro web application, i.e. the transformation of user requests into responses.
 
This flow in Oro applications is similar to the flows of other `Symfony applications <https://symfony.com/doc/3.4/introduction/http_fundamentals.html#the-symfony-application-flow>`_, in particular:

1. A client sends an HTTP request to the application.
2. The request is executed by the application's front controller (index.php) file which takes a request, boots the application and passes the request information to it.
3. Internally, the application uses registered routes, controllers, event dispatchers and event subscribers to process the request and create a response object.
4. The application turns the response object into the text headers and content which are sent back to the client.

.. image:: /dev_guide/img/web_framework/request-flow.png
    :alt: Oro HTTP Request Application Flow

This routine defines several important architectural features of Oro applications, such as the usage of the **Front Controller** and **MVC** structural patterns, and an **Event system** to organize the application functionality and manage the application flow.

.. _dev-guide-application-web-framework-symfony-event-system:

Event System
------------

Oro applications actively use `Symfony Event Dispatcher <https://symfony.com/doc/3.4/event_dispatcher.html>`_ to create
and use the points of functional extension and control of the application flow.

As illustrated throughout the Developer Guide, a significant part of Oro application's functionality allows you to adjust the application behavior by creating listeners or subscribers for system events.

.. _dev-guide-application-web-framework-symfony-inversion-of-control-principle:

Inversion of Control Principle
------------------------------

The `Inversion of Control principle <https://en.wikipedia.org/wiki/Inversion_of_control>`_ is widely used in the architecture of Oro applications to loosen the coupling between classes and objects, facilitate extensibility and eliminate code duplication.

The principle is embodied in the `Symfony's Service container <http://symfony.com/doc/3.4/service_container.html>`_ and the `Dependency Injection Component <https://symfony.com/doc/current/components/dependency_injection.html>`_ used to create and manage all objects and organize the interaction between them in Oro applications.

.. _dev-guide-application-web-framework-symfony-bundle-system:

Bundle System
-------------

The `bundle system <https://symfony.com/doc/3.4/bundles.html>`_ is one of the main principles of feature and code organization in Oro applications. However, there are some differences in it between the Symfony framework and Oro applications.

At the beginning of Oro applications' development, there were certain constraints with Symfony bundle management system that we decided to address, namely:
  
- Installing a bundle was too cumbersome
- Removing a bundle was even more cumbersome

At the time there was no `Flex <https://symfony.com/doc/3.4/setup/flex.html>`_ to address these issues. 

.. hint:: Have a look at the `article <https://medium.com/@fabpot/fabien-potencier-4574622d6a7e>`_  written by Fabien Potensier in which he discusses Symfony Flex. 

As a workaround, we changed the bundle registration system in Oro applications in such a way that the bundles acquired the option of auto-registration in the application without the need to modify any of the application files.

In Oro applications, for the bundle to be registered and enabled, it is sufficient to mention the bundle in its  *Resources/config/oro/bundles.yml* file. More precisely, you can activate any bundle in the application simply by putting its main class name in the *Resources/config/oro/bundles.yml* of your bundle (keep in mind, though, that the bundle must first be physically installed with the help of Composer).

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/config/oro/bundles.yml
        bundles:
            - { name: Acme\Bundle\DemoBundle\AcmeDemoBundle, priority: 70 }

.. note:: For more details on how to create a bundle, please refer to the :ref:`How to Create a New Bundle <dev-cookbook-framework-how-to-create-new-bundle>` cookbook recipe.

.. note:: **Using Symfony Flex**

    In the 4th version of the Symfony Framework, the default way to manage bundles is by using Symfony Flex.

    As mentioned at the beginning of this article, current versions of Oro applications (v.3.x) use Symfony v.3.4.
    Fabien Potensier `recommends to consider Flex as an alpha up to 4th versions of Symfony <https://medium.com/@fabpot/fabien-potencier-4574622d6a7e>`_. Consequently, Oro applications of the current version do not use Flex as the main way to manage the bundles but we intend to introduce it after switching to the 4.4-th version of Symfony Framework (the first LTS version of the 4th generation of Symfony framework).

.. However, you have the technical possibility to switch to using Flex in your custom applications. Since Symfony
    provides the possibility to use Flex from version 3.3, and the `only mandatory requirement for the transition to Flex use is the change the directory structure in accordance with the 4th version of the Symfony Framework <https://symfony.com/doc/current/setup/flex.html#upgrading-existing-applications-to-flex>`_,
    which is already done in the current versions of Oro applications. Please see `Application Directory Structure`_
    section for more details about Oro applications directory structure.

.. _dev-guide-application-web-framework-symfony-application-directory-structure:

Application Directory Structure
-------------------------------

Oro applications follow the recommendations of Symfony in terms of organizing the structure of the application files and source code.

Despite the fact that current versions of Oro applications use the 3.4th version of Symfony Framework, the structure of Oro application directories has already adopted `Symfony 4 recommendations <http://fabien.potencier.org/symfony4-directory-structure.html>`_.

Please refer to the :ref:`Architecture Guide <architecture-oro-php-application-structure>` for the detailed description of Oro application directory structure.

.. _dev-guide-application-web-framework-symfony-application-configuration:

Application Configuration
-------------------------

Oro widely uses Symfony conventions to configure the application and certain features in YAML configuration files.

On the application level (`according to Symfony conventions <https://symfony.com/doc/3.4/best_practices/configuration.html>`_), the configuration is divided into infrastructure-related (*config/parameters.yml*) and application-related (*config/config.yml* file).

On the bundle level, Oro applications have small changes in the technologies of configuration but a considerable shift in the role and purpose of the configuration files.

Simultaneously with :ref:`bundle auto-registration <dev-guide-application-web-framework-symfony-bundle-system>` in the *Resources/config/oro/bundles.yml* file, the policy of auto-registration of the feature's configuration files that follow special naming conventions was enabled.

For example, the files named

- *Resource/config/oro/api.yml*
- *Resource/config/oro/navigation.yml*
- *Resource/config/oro/datagrids.yml*

are auto-discovered and applied to the configuration of corresponding features.

The role of the configuration files underwent most changes. In Oro application, Yaml configuration files of many features are used not only to configure a feature but also as a way to create parts of application functionality.

For example, there are three ways in Oro applications to create navigation items in the UI:

1. Use admin UI to manage the navigation items.
2. Declare new navigation items in the DI service with a special dependency injection tag "oro_menu.builder"
3. Add navigation item information to the *Resources/config/oro/navigation.yml* file of your bundle:

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/config/oro/navigation.yml
        menu_config:
            items:
                new_menu_item:
                    label: New Menu Item
                    route: acme_demo_new

            tree:
                application_menu:
                    children:
                        new_menu_item: ~

.. @todo Add here a list of auto-discovered yaml configuration files after guide creating

.. @todo note:: Uncomment this note after adding the section with description of the admin UI, which allows to manage application parameters

    In addition to using YAML configuration files, OroPlatform enables developers in all Oro applications to create
    application configuration variables that are aimed to be managed by application users through the UI. This way is widely used in Oro applications for features that should be configured by application users rather than developers.

.. _dev-guide-application-web-framework-symfony-templating-system:

Templating System
-----------------

`Symfony Templating`_ is widely extended in Oro Applications by the
`Layouts <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/LayoutBundle>`_ concept, which allows to address
Symfony’s limitations in UI extension and composition.

However, all features of the `TWIG templating engine <https://twig.symfony.com/>`_ and
`Symfony Templating Component <https://symfony.com/doc/3.4/components/templating.html>`_ are widely used in Oro
applications in UI building.

It is, therefore, highly recommended to get acquainted with `Symfony Templating`_ documentation in order to work with Oro applications.

.. _dev-guide-application-web-framework-symfony-security-system-data-access-management:

Security System (Data Access Management)
----------------------------------------

Data Access Management in OroPlatform is based on the proprietary
`Role Based Access Control <https://en.wikipedia.org/wiki/Role-based_access_control>`_ system as it is necessary in
business applications. 

.. note:: More information on this is available in the next section of this guide which is dedicated to OroPlatform and its Security System.

However, this RBAC system of Oro applications widely uses
`Symfony Security Components <https://symfony.com/doc/3.4/components/security.html>`_. It is, therefore, important that you  familiarize yourself with them to be able to work with Oro applications.

.. _dev-guide-application-web-framework-symfony-databases-management-doctrine-orm:

Databases Management (Doctrine ORM)
-----------------------------------

Oro applications support storage of application data in relational databases, such as MySQL, MariaDB, PostgreSQL,
EnterpriseDB. Support for these databases is provided by the `Doctrine <https://www.doctrine-project.org/>`_
layer.

Oro applications widely use all Doctrine features to manage the persistent data: Database Abstraction Layer,
Object Relation Mapping, Event Manager, etc.

However, Doctrine Migrations, which is one of most popular Doctrine projects, was entirely replaced by proprietary
`OroMigrationBundle <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/MigrationBundle>`_. This was done in
order to allow versioning management of the databases scheme using specific migration classes on the bundle level, not the application level.

In addition, due to the fact that Oro application functionality was constantly evolving, there was a need of extend the
Doctrine data types and DQL functions. As the result, `Oro Doctrine Extensions <https://github.com/oroinc/doctrine-extensions>`_ component was created.

.. _dev-guide-application-web-framework-symfony-cli-application:

CLI Application
---------------

All Symfony-based applications `come with a command line interface tool <https://symfony.com/doc/3.4/console.html>`_
(bin/console) that helps you maintain your application. It provides commands that boost your productivity by automating
tedious and repetitive tasks, such as clearing the application cache, debugging routing, viewing the list of registered commands, etc.

Oro application follows this convention and extends the set of the CLI tools by commands for:

- Database migrations management (see `Databases Management (Doctrine ORM)`_ above)
- Translations management
- Application upgrading
- Periodical task management
- Unit tests generation
- etc.

To see all Oro applications console commands, run the following command in the console:

.. code-block:: bash

    bin/console list oro

.. _dev-guide-application-web-framework-symfony-list-of-symfony-components-used-in-oro-applications:

List of Symfony Components Used in Oro Applications
---------------------------------------------------

Symfony is a *set of program components* and a *web framework*. Components represent separate independent parts
of the functionality used to perform typical web programming tasks, while the framework is a functionality responsible for organizing the interaction of these independent components in a web application.

Description of the Symfony's contribution to the Oro applications architecture would not be complete without
mentioning Symfony components that are actively used in the development of Oro applications:

- The Asset Component (https://symfony.com/doc/3.4/components/asset.html)
- The Console Component (https://symfony.com/doc/3.4/components/console.html)
- The DependencyInjection Component (https://symfony.com/doc/3.4/components/dependency_injection.html)
- The EventDispatcher Component (https://symfony.com/doc/3.4/components/event_dispatcher.html)
- The ExpressionLanguage Component (The ExpressionLanguage Component)
- The Form Component (https://symfony.com/doc/3.4/components/form.html)
- The HttpFoundation Component (https://symfony.com/doc/3.4/components/http_foundation.html)
- The HttpKernel Component (https://symfony.com/doc/3.4/components/http_kernel.html)
- The OptionsResolver Component (https://symfony.com/doc/3.4/components/options_resolver.html)
- The PropertyAccess Component (https://symfony.com/doc/3.4/components/property_access.html)
- The Routing Component (https://symfony.com/doc/3.4/components/routing.html)
- The Security Component (https://symfony.com/doc/3.4/components/security.html)
- The Serializer Component (https://symfony.com/doc/3.4/components/serializer.html)
- The Templating Component (https://symfony.com/doc/3.4/components/templating.html)
- The Translation Component (https://symfony.com/doc/3.4/components/translation.html)
- The Validator Component (https://symfony.com/doc/3.4/components/validator.html)
- The Yaml Component (https://symfony.com/doc/3.4/components/yaml.html)

You have to be familiar with these components in order to work comfortably with Oro applications.

.. _`Symfony Templating`: https://symfony.com/doc/current/templating.html
