.. _architecture--customization--how-to-customize:
.. _architecture--customization--customize:

Application Customization
=========================

When a company acquires a new tool, it would more likely than not require a degree of customization. Oro applications are highly customizable, and you can adapt them to fit your existing business processes.

* **Enable control over the custom data flow to and from the Oro application**
  *Example:* A product catalog for the B2B storefront is populated with the existing ERP system's data and the Oro application's purchase statistics fuels the ERP reporting engine.

* **Process custom domain-specific data (via the enhanced structure, like custom attributes and relationships, and advanced workflows)**
  *Example:* A checkout process may involve collaboration with more than one party (such as a legal and financial department review) and require a status confirmation from an external system (a customer ERP service with approvals or details on behalf of the customer).

* **Synchronize data with an external system**
  *Examples:*

  * You can synchronize orders created via the Oro application into an external system for shipping processing, with the shipping tracking number reported back to the Oro application.
  * For the existing Oro features, you can adjust import and export via CSV files.
  * You can use information from external systems to adjust to the existing pricing policies and strategies.

* **Substitute features of the Oro application with similar operations already fulfilled by the third-party systems**
  *Example:* A company can replace customer registration in the Oro application with the integrated service they already use (using embedded forms or via data synchronization)

* **Enhance or adjust existing features to support custom processes**
  *Examples:*

  * You can modify quotes to act as temporary orders that sales representatives create on behalf of the customers.
  * You can adapt the functionality of the related item to display additional information (e.g., cross-sales) in a buyer's shopping list.

* **Customize the design of the Oro application components (e.g., storefront, email notifications, etc.)**
  *Examples:*

  * Restructure page layouts and create new pages
  * Adjust website style to the brand identity (colors, fonts, etc.)
  * Change templates of email notifications (add corporate headers, footers, etc.)

The following sections introduce the recommended ways of adjusting and customizing the Oro application specifically for your needs.

Customize the Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^

In addition to existing extensions, you can create your own customization of the Oro application source code and either use it internally or publish it to the Oro Extensions Store.

.. hint:: For more information on installing extensions from the Oro Extensions Store, see the :ref:`Installing and extension <cookbook-extensions-composer>` guide.

.. warning:: Customization may apply to the application only and should be created in a custom bundle in the src folder of your Oro application. Do not customize packages, Oro and Symfony bundles, and components to avoid difficulties when upgrading the customized system.

Prepare for Source Code Customization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Before you begin customizing your Oro application, follow the guidance provided in the :ref:`Custom Application <dev-guide-application-web-framework>` topic to set up your custom application repository for the version control, and install the Oro application from your custom repository.

Running the application in development mode (via the ``http://<oro-application-base-url>/index_dev.php/`` link) helps you debug and test your customization steps.

Implement the Customization
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: We recommend that you follow |Symfony Best Practices| for any custom application you build on top of the Oro applications. Please refer to the :ref:`Oro application structure <architecture-oro-php-application-structure>` and |Symfony Bundle System| for more information.

Use the src directory in the root of your Oro application as a working directory for your custom project.

Create a new bundle to put all your custom code and updated configuration files. To customize your Oro application source code and adjust your Oro application behavior, use the methods described in the sections below.

.. note:: Methods originating from the Symfony framework are marked with the *[Symfony]* prefix, while Oro-specific methods are labeled with the *[Oro]* prefix. Oro-specific methods significantly speed up the development process, like the dynamic modification of the content created at the vendor level and quick definition of the new workflows, configuration options, and navigation sets. Generic PHP-enabled methods are marked with the *[PHP]* prefix.

.. contents:: :local:

[PHP] Add a Third-Party Component or Library via Composer
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""

Add an existing third-party program component or a library available via |composer| to use it in your custom Oro application code.

For example, in the root directory of your Oro application, run the following command to add a math library using composer:

   ```composer require numphp/numphp```

After that, you can use features from the math library in the custom source code:

.. code-block:: none

   ...

   use \NumPHP\NumArray;

   ...

      $vector = new NumArray([0.12, 6/7, -9]);

   ...

[Symfony] Add a Third-Party Symfony-Compatible Bundle
"""""""""""""""""""""""""""""""""""""""""""""""""""""

Similarly, add a Symfony-compatible bundle to your Oro application via composer using the following command:

   "`composer require friendsofsymfony/rest-bundle` "

To enable it in the Oro application, register the bundle in the bundles.yml file in your custom bundle:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/bundles.yml

   bundles:
     -  { name: FOS\RestBundle\FOSRestBundle, priority: 100 }

.. note:: See the topic on :ref:`Differences to Common Symfony Applications <book_differences>` for more information on the bundle registration effect.

This immediately enforces the customization changes defined in the bundle to apply to your Oro application.
Next, you may need to implement custom changes in the existing business logic to benefit from the enabled capabilities.

..
    [Symfony] Extend the Existing Bundle via Inheritance or Using Compiler Passes
    """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

    Use Symfony inheritance (e.g., override controllers, templates, routes of this parent bundle) to customize the existing Oro application bundle. For detailed information, please, see  |How to use compiler passes| in Symfony documentation.

    .. note:: Inheritance techniques are easier to implement and maintain than the compiler pass approach.

[Symfony] Replace Services
""""""""""""""""""""""""""

Decorate existing services to change their default behavior. For more information, see |How to decorate services| topic in Symfony documentation.

[Symfony] Use Dependency Injection Tags
"""""""""""""""""""""""""""""""""""""""

With the dependency injection tags, you can register a service of a specific type (for example, a data provider for the layout, custom action for the workflow system, etc.) in the dependency injection container. To do so, tag your service with a specified dependency injection tag to make it part of the Oro application.

For example, to add a new payment method to your OroCommerce application, first, create your own implementation of the *PaymentMethodProviderInterface* and tag it with the existing *oro_payment.payment_method_provider* tag, like in the following example:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   demo_bundle.method.provider.payment_method_name:
       class: Acme\Bundle\DemoBundle\Method\Provider\NameOfMethodProvider
       public: false
       tags:
            - { name: oro_payment.payment_method_provider }

The behavior that has already been applied to the default payment methods is also automatically applied to the tagged service.

[Symfony] Events and Event Listeners
""""""""""""""""""""""""""""""""""""

Use event listeners to interfere with the existing data processing flow and customize it. You can also design new business logic for processing the events. For example, to log several web browsers connected to the application server through the WebSockets (WS) protocol, create your own listener of the gos_web_socket.client_connected event:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   demo_bundle.wss.listener:
       class: Acme\Bundle\DemoBundle\EventListener\WssConnectionEventListener
       tags:
            - { name: kernel.event_listener, event: gos_web_socket.client_connected, method: onClientConnect }

Remember to implement custom processing of the registered changes, if necessary.

To get the list of listeners registered in the event dispatcher, use the following command:

```php bin/console debug:event-dispatcher```

See the |Event dispatcher| topic in the Symfony documentation for more information.

[Oro] Customization via Configuration Files
"""""""""""""""""""""""""""""""""""""""""""

Many items in the Oro application features, like workflows, navigation trees, datagrids, and dashboard widgets, are defined in the YAML configuration files. You can easily adjust existing and add new items by modifying these files. For example, to add new sections in the System Configuration UI, modify the *Resources/config/oro/system_configuration.yml* file in your custom bundle to add a new configuration option.

Once added, the option may be displayed in the UI or may affect the Oro application behavior. You may need to implement new or customize existing features to use the new configuration option.

Please, see the :ref:`System Configuration <ref-format-system-configuration>` topic for sample configuration files.

[Oro] Customization Using Twig Placeholders
"""""""""""""""""""""""""""""""""""""""""""

In the Oro application, you can use a new Twig template {placeholder} token/tag that triggers an event-like behavior when the template is rendered. For example, you can add new markup to the existing template generated at the vendor level and keep other parts of the template intact. Please, see the :ref:`Introduction to Placeholders <bundle-docs-platform-ui-bundle-twig-placeholders>` topic for more details.

[Oro] Customization by Modifying the Database Schema
""""""""""""""""""""""""""""""""""""""""""""""""""""

Use the Oro data migration mechanism to fine-tune the database schema and load initial data to the Oro application. The mechanism that is enabled in the :ref:`MigrationBundle <backend-entities-migrations>` uses specific PHP files and classes (migrations and fixtures) that help you to fulfill:

* **Data model changes:** Modify the database schema to fit your custom business process
* **Data initialization:** Add required initial data to the database
* **Multi-step data schema modification:** Add sequential and incremental changes to the database in a predefined order if they depend on the preceding migration completion. Sequential changes could have happened during the different stages of development. Sample sequential changes are:

  * Add a new user table with id and name columns (initial implementation).
  * Add an email column to the user table (the change was implemented at a later stage to cover missing data for the integration).
  * Rename the email column to user email (the column name was lined up with the integrated system).

* **Multi-step data modification:** Adjust the data in the database via fixtures that may depend on other fixtures and be processed after them.
* **Deployment:** Migration of the database-level changes (database schema and data) from the development and staging environments to the production environment.

Please, see the :ref:`OroMigrationBundle <backend-entities-migrations>` documentation for more details on database structure and model modification.

Publish Your Complete Customization as a Package on the Oro Extensions Store
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Once your customization is ready, you can publish it in a dedicated repository that follows the :ref:`package repository requirements <architecture-oro-php-application-structure>`, create a reusable package, and share it on the Oro Extensions Store. See :ref:`How to add extension to the Oro Extensions Store <dev--extend--how-to-publish-extension-on-the-marketplace>` for more information.

Customize via UI
^^^^^^^^^^^^^^^^

For data model and business process customization, Oro applications provide the entity and workflow management tools in the web UI (e.g., OroCRM and OroCommerce back-office). You can use these tools for quick updates of the existing data structure, for example, to add a new field to the existing entity data, change the value options, etc.) and enable easy and fast prototyping, for example, for A/B testing of new business process automation.

.. warning:: Results of the customization via UI are stored in the database. Porting such customization from staging to the production environment happens on the database level using data migration. Compared to programmatic customization, customization via UI lacks versioning and portability. Please consider using the source code level customization to keep the upgrade process simple.

In the **System > Entity Management**, you can create a data model for a new business entity (e.g., add information about the purchase orders and link them to the B2B orders in OroCommerce) and start using it immediately after field and relationships configuration. See :ref:`Entities Management <entities-management>` for detailed information.

In the **System > Workflows**, you can automate a workflow to reflect a custom business process in your organization. See :ref:`Workflows <doc--system--workflow-management>` for detailed information.

Related Articles
^^^^^^^^^^^^^^^^

* :ref:`Bundle-less Structure <dev-backend-architecture-bundle-less-structure>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin