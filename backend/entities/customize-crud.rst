Customize CRUD Pages
--------------------

.. https://www.oroinc.com/orocommerce/blog/customizing-crud-orocommerce

OroCommerce equips users and developers with powerful UIs that they can use to manage both simple and complex data entities, including all entity attributes (fields) and relations. As a developer, you can easily enable standard CRUD pages for a new entity, and with the same ease, you can add more fields to any of the entities that you have created before. Just add new entity properties, create a migration script and modify the templates if necessary.

But what if you need to add a few more fields to one of the OroCommerce built-in entities, or to an entity that has been created by somebody else’s extension? Where would you start?

Editing the OroCommerce source code or the code for third party extensions is never a good idea. In this article, we will show you how to customize the CRUD pages of the existing entities with the custom code in your own bundle.

.. note:: CRUD stands for Create, Read, Update and Delete operations. They are commonly accompanied by some sort of listing or navigation that allows to retrieve, sort and filter multiple records at once. In the context of OroCommerce the data management UIs for the above operations are represented by the following pages:

   * **List** – represented by the data grids (for example, select **Products → Products** in the main navigation menu). For more information on customization of the data grids, see the `Customizing Data Grids in OroCommerce <customizing-data-grid-in-orocommerce>`_ section.

   * **Create** – an entity creation screen (for example, go to **Products → Products** and click on the **Create Product** button above the product data grid). In most cases, the entity creation screen and entity editing screen look and work exactly the same, though there may be exceptions to this rule.

   * **Read** – an entity view page (for example, go to **Products → Products** and click on any product in the grid).

   * **Update** – an entity editing page (for example, go to **Products → Products** and select Edit in the action column, or click on the **Edit** button on the product view page).

   * **Delete** – there is no special screen for entity deletion other than the confirmation popup window (go to **Products → Products** select **Delete** in the action column, or click on the Delete button on the product view or edit page).

For the purpose of the today’s exercise, we will be adding a new text field to the product edit and view screens from our custom bundle.

Prerequisites
^^^^^^^^^^^^^

Before we start writing code, you should create a new bundle in your application. If you are not familiar with bundle creation process yet, please check the article about `how to create a new bundle in OroPlatform, OroCRM, or OroCommerce <how-to-create-new-bundle>`_. If you have already created a bundle for your app customizations, you are good to go and may reuse it in other tutorials as well.

Custom Data Entity
~~~~~~~~~~~~~~~~~~

As the first step we will create a new entity to store our custom data. It is still possible to create new product entity fields from your custom bundle, but we will show how you can add some data that is stored elsewhere (it may as well be calculated on the fly or submitted to an external web-service for storage).

.. note:: Please check the `How to Create Entities <entities/creating-entities>`_ article in the OroCookbook to learn more.

Let’s also make our entity compliant with the |ProductHolderInterface|, so it will be possible to reuse it in other places (e.g. reports). Other than the reference to the product, our entity will have only one text field to store our data. You can add multiple fields and use other data types according to your requirements.

This is how our custom entity will look like:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Entity/ProductOptions.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Entity/ProductOptions.php
    :language: php
    :lines: 1-9, 12-41, 106
    :linenos:

Installation And Migrations
^^^^^^^^^^^^^^^^^^^^^^^^^^^

It might be not necessary for this exercise, but if you plan to distribute your custom bundle, or if you want to deploy it later to another application or machine, you have to create the installation and migration scripts. The installation script should create the required database structures during application installation, and the migration scripts will be used to update your module in the application to a specific version.

.. note:: More information about migrations is available in the |OroMigrationBundle| documentation.

We are going to have only one version of our custom bundle in this blog post, so the installation and migration code will look very similar.

Installation:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Migrations/Schema/OroBlogPostExampleBundleInstaller.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Migrations/Schema/OroBlogPostExampleBundleInstaller.php
    :language: php
    :linenos:

Migration:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Migrations/Schema/v1_0/OroBlogPostExampleBundle.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Migrations/Schema/v1_0/OroBlogPostExampleBundle.php
    :language: php
    :linenos:

Form Types
^^^^^^^^^^

In order to customize the new product field, we need to implement a corresponding form type that will be used in the main form on the product create and edit pages:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Form/Type/ProductOptionsType.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Form/Type/ProductOptionsType.php
    :language: php
    :lines: 1-9, 13-
    :linenos:

The setDataClass method is used here to provide more flexibility while allowing for the re-use of this form type. Using it like this is optional.

Once you have your new form type, it should be registered in the service container to be recognizable by the Symfony’s form factory:


.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/form_types.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/form_types.yml
    :language: none
    :lines: 1-5
    :linenos:

Form Type Extension
^^^^^^^^^^^^^^^^^^^

Any integrations between different form types within OroCommerce can use form type extension to tie in the form types together. In our case, we need to list the following form events:

 * **FormEvents::POST_SET_DATA** – it will be used to assign values to the form from our custom entity object;
 * **FormEvents::POST_SUBMIT** – it will be used to convert, validate and persist our custom values.

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Form/Extension/ProductOptionsFormTypeExtension.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Form/Extension/ProductOptionsFormTypeExtension.php
    :language: php
    :lines: 1-16, 21-
    :linenos:

Our new form type extension should also be registered in the service container:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/form_types.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/form_types.yml
    :language: none
    :lines: 1,7-13
    :linenos:


UI Data Targets and Listener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once the entity, the form type, and the form type extension are created, we can start customizing the User Interface.

.. note:: Additional information about the UI customization is available `in the Layout seciton <../theme/layout>`_.

In our case, the custom data should be added to the product view page and the product edit/create pages, so we will use the following dataTargets:

* product-view will be used to display our custom data on the product view page;
* product-edit will be used to show our custom data on the product edit page;
* product-create-step-two will be used to add our custom data to the product creation page.

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/services.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/services.yml
    :language: none
    :linenos:

The event listener may be implemented as follows:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/EventListener/ProductFormListener.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/EventListener/ProductFormListener.php
    :language: php
    :lines: 1-12, 16-
    :linenos:


Templates

And finally, we can define the templates – one for the form:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/views/Product/product_options_update.html.twig
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/views/Product/product_options_update.html.twig
    :language: php
    :linenos:

and one for the view:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/views/Product/product_options_view.html.twig
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/views/Product/product_options_view.html.twig
    :language: php
    :linenos:

As a result, the following blocks will be shown on the product edit and create pages:

.. image:: /img/backend/entities/crud_result_edit.png

In view mode, the block looks as follows:

.. image:: /img/backend/entities/crud_result_view.png

A fully working example, organized into a custom bundle is available `here <https://github.com/oroinc/orocommerce-sample-extensions/releases/download/0.1/OroB2BBlogPostExampleBundle.zip>`_.

In order to add this bundle to your application:

* Please extract the content of the zip archive into a source code directory that is recognized by your composer autoload settings;
* Clear the application cache with the following command:
  
  `php bin/console clear:cache`

  and run the migrations with the following command:

  `app oro:migration:load --force --bundles=OroBlogPostExampleBundle`


.. include:: /include/include-links.rst
   :start-after: begin



