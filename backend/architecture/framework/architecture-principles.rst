.. _dev-guide-application-web-framework-symfony:

Architecture Principles of Oro Applications
===========================================

.. _dev-guide-application-web-framework-symfony-symfony-role-in-oroplatform:

Symfony Role in OroPlatform
---------------------------

.. note:: We use |Symfony Framework| v. 4.4 LTS in Oro Applications v.4.x.

Currently Symfony is the most mature PHP framework that provides a wide range of functions that are typical for any web
application. Symfony takes care of numerous tasks, for instance:

- Receiving a user request and transforming it into a response for the user’s browser
- Organizing the source code in a conventional structure
- Providing tools for continuous storage of application data, validation of income data against some set of rules
- etc.

For more information on Symfony, its purpose and benefits, please have a look at the following articles on the symfony website:

* |Symfony versus Flat PHP: Why is Symfony better than just opening up a file and writing flat PHP?|.
* |7 Good Reasons to Use Symfony Framework for Your Project|
* |Why Symfony? Seven Facts|

Using Symfony allows web applications to avoid the development of low-level components which are responsible for the organization of the application, and focus on developing a functionality that is specific to a particular web application.

Oro applications have a lot in common with regular Symfony applications that are based on the 3th version of the framework. So, if you are not familiar with Symfony yet - start your acquaintance with Oro application from the *Getting Started* and *Guides* sections of the official |Symfony documentation|.

There are a number of Symfony features which had a substantial impact on the architecture of all Oro applications. Some of them are listed below, along with the description of how these features were adjusted and altered specifically for Oro applications comparing to other Symfony-based applications.

.. _dev-guide-application-web-framework-symfony-http-request-application-flow:

HTTP Request Application Flow
-----------------------------

Symfony framework (and its |HttpKernel component|) determines
the main flow of Oro web application, i.e. the transformation of user requests into responses.

This flow in Oro applications is similar to the flows of other |Symfony applications|, in particular:

1. A client sends an HTTP request to the application.
2. The request is executed by the application's front controller (index.php) file which takes a request, boots the application and passes the request information to it.
3. Internally, the application uses registered routes, controllers, event dispatchers and event subscribers to process the request and create a response object.
4. The application turns the response object into the text headers and content which are sent back to the client.

.. image:: /img/backend/architecture/request-flow.png
    :alt: Oro HTTP Request Application Flow

This routine defines several important architectural features of Oro applications, such as the usage of the **Front Controller** and **MVC** structural patterns, and an **Event system** to organize the application functionality and manage the application flow.

.. _dev-guide-application-web-framework-symfony-event-system:

Event System
------------

Oro applications actively use |Symfony Event Dispatcher| to create
and use the points of functional extension and control of the application flow.

As illustrated throughout the Developer Guide, a significant part of Oro application's functionality allows you to adjust the application behavior by creating listeners or subscribers for system events.

.. _dev-guide-application-web-framework-symfony-inversion-of-control-principle:

Inversion of Control Principle
------------------------------

The |Inversion of Control principle| is widely used in the architecture of Oro applications to loosen the coupling between classes and objects, facilitate extensibility and eliminate code duplication.

The principle is embodied in the |Symfony's Service container| and the |Dependency Injection Component| used to create and manage all objects and organize the interaction between them in Oro applications.

.. _dev-guide-application-web-framework-symfony-bundle-system:

Bundle System
-------------

The |bundle system| is one of the main principles of feature and code organization in Oro applications. However, there are some differences in it between the Symfony framework and Oro applications.

At the beginning of Oro applications' development, there were certain constraints with Symfony bundle management system that we decided to address, namely:

- Installing a bundle was too cumbersome
- Removing a bundle was even more cumbersome

As a workaround, we changed the bundle registration system in Oro applications in such a way that the bundles acquired the option of auto-registration in the application without the need to modify any of the application files.

In Oro applications, for the bundle to be registered and enabled, it is sufficient to mention the bundle in its  *Resources/config/oro/bundles.yml* file. More precisely, you can activate any bundle in the application simply by putting its main class name in the *Resources/config/oro/bundles.yml* of your bundle (keep in mind, though, that the bundle must first be physically installed with the help of Composer).

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/bundles.yml
   
        bundles:
            - { name: Acme\Bundle\DemoBundle\AcmeDemoBundle, priority: 70 }

.. note:: For more details on how to create a bundle, please refer to the :ref:`How to Create a New Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

.. _dev-guide-application-web-framework-symfony-application-directory-structure:

Application Directory Structure
-------------------------------

Oro applications follow the recommendations of Symfony in terms of organizing the structure of the application files and source code.

Please refer to the :ref:`Architecture Guide <architecture-oro-php-application-structure>` for the detailed description of Oro application directory structure.

.. _dev-guide-application-web-framework-symfony-application-configuration:

Application Configuration
-------------------------

Oro widely uses Symfony conventions to configure the application and certain features in YAML configuration files.

On the application level (|according to Symfony conventions|), the configuration is divided into infrastructure-related (*config/parameters.yml*) and application-related (*config/config.yml* file).

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
   :caption:  src/Acme/DemoBundle/Resources/config/oro/navigation.yml
   
        menu_config:
            items:
                new_menu_item:
                    label: New Menu Item
                    route: acme_demo_new

            tree:
                application_menu:
                    children:
                        new_menu_item: ~

.. _dev-guide-application-web-framework-symfony-templating-system:

Templating System
-----------------

|Symfony Templating| is widely extended in Oro Applications by the |Layouts| concept, which allows to address
Symfony’s limitations in UI extension and composition.

However, all features of the |TWIG templating engine| and |Symfony Templating Component| are widely used in Oro
applications in UI building.

It is, therefore, highly recommended to get acquainted with |Symfony Templating| documentation in order to work with Oro applications.

.. _dev-guide-application-web-framework-symfony-security-system-data-access-management:

Security System (Data Access Management)
----------------------------------------

Data Access Management in OroPlatform is based on the proprietary |Role Based Access Control| system as it is necessary in
business applications.

.. note:: More information on this is available in the next section of this guide which is dedicated to OroPlatform and its Security System.

However, this RBAC system of Oro applications widely uses |Symfony Security Components|. It is, therefore, important that you  familiarize yourself with them to be able to work with Oro applications.

.. _dev-guide-application-web-framework-symfony-databases-management-doctrine-orm:

Databases Management (Doctrine ORM)
-----------------------------------

Oro applications support storage of application data in relational databases, such as MySQL, MariaDB, PostgreSQL,
EnterpriseDB. Support for these databases is provided by the |Doctrine| layer.

Oro applications widely use all Doctrine features to manage the persistent data: Database Abstraction Layer,
Object Relation Mapping, Event Manager, etc.

However, Doctrine Migrations, which is one of most popular Doctrine projects, was entirely replaced by proprietary
. This was done in
order to allow versioning management of the databases scheme using specific migration classes on the bundle level, not the application level.

In addition, due to the fact that Oro application functionality was constantly evolving, there was a need of extend the
Doctrine data types and DQL functions. As the result, |Oro Doctrine Extensions| component was created.

.. _dev-guide-application-web-framework-symfony-cli-application:

CLI Application
---------------

All Symfony-based applications |come with a command line interface tool| (bin/console) that helps you
maintain your application. It provides commands that boost your productivity by automating
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

    php bin/console list oro

.. _dev-guide-application-web-framework-symfony-list-of-symfony-components-used-in-oro-applications:

List of Symfony Components Used in Oro Applications
---------------------------------------------------

Symfony is a *set of program components* and a *web framework*. Components represent separate independent parts
of the functionality used to perform typical web programming tasks, while the framework is a functionality responsible for organizing the interaction of these independent components in a web application.

Description of the Symfony's contribution to the Oro applications architecture would not be complete without
mentioning Symfony components that are actively used in the development of Oro applications:

- |Asset Component|
- |Console Component|
- |DependencyInjection Component|
- |EventDispatcher Component|
- |ExpressionLanguage Component|
- |Form Component|
- |HttpFoundation Component|
- |HttpKernel Component|
- |OptionsResolver Component|
- |PropertyAccess Component|
- |Routing Component|
- |Security Component|
- |Serializer Component|
- |Templating Component|
- |Translation Component|
- |Validator Component|
- |Yaml Component|

You have to be familiar with these components in order to work comfortably with Oro applications.



.. include:: /include/include-links-dev.rst
   :start-after: begin
