Customize CRUD Pages
--------------------

OroCommerce provides powerful UIs for managing both simple and complex data entities, including all entity attributes (fields) and relations. As a developer, you can enable standard CRUD pages for a new entity, and just as easily add more fields to entities you created earlier: add new entity properties, create a migration script, and modify the templates if necessary.

But what if you need to add a few more fields to one of the OroCommerce built-in entities or to an entity that somebody else's extension has created?

Editing the OroCommerce source code or third-party extension code is never a good idea. This article shows how to customize the CRUD pages of existing entities with custom code in your own bundle.

.. note:: CRUD stands for Create, Read, Update and Delete operations. They are commonly accompanied by some listing or navigation that allows retrieving, sorting, and filtering multiple records at once. In the context of OroCommerce, the data management UIs for the above operations are represented by the following pages:

   * **List** – represented by the data grids (for example, select **Products → Products** in the main navigation menu). For more information on customization of the data grids, see the :ref:`Customizing Data Grids in OroCommerce <customizing-data-grid-in-orocommerce>` section.

   * **Create** – an entity creation screen (for example, go to **Products → Products** and click on the **Create Product** button above the product data grid). In most cases, the entity creation screen and entity editing screen look and work the same, although there may be exceptions to this rule.

   * **Read** – an entity view page (for example, go to **Products → Products** and click on any product in the grid).

   * **Update** – an entity editing page (for example, go to **Products → Products** and select Edit in the action column, or click on the **Edit** button on the product view page).

   * **Delete** – there is no special screen for entity deletion other than the confirmation popup window (go to **Products → Products** select **Delete** in the action column, or click on the Delete button on the product view or edit page).

For example, let's add a new text field to the product edit and view screens from our custom bundle.

Prerequisites
^^^^^^^^^^^^^

Before writing code, create a new bundle in your application. If you are not familiar with the bundle creation process yet, check :ref:`how to create a new bundle in your Oro application <how-to-create-new-bundle>`. If you already created a bundle for your app customizations, reuse it here and in other tutorials.

Custom Data Entity
~~~~~~~~~~~~~~~~~~

First, create a new entity to store custom data. You can still create new product entity fields from your custom bundle, but here we show how to add data stored elsewhere (it can also be calculated on the fly or submitted to an external web service for storage).

.. note:: See the :ref:`How to Create Entities <create-entities>` article to learn more.

Let's also make the entity compliant with the |ProductHolderInterface|, so you can reuse it elsewhere (for example, in reports). Besides the product reference, our entity has only one text field to store our data. You can add multiple fields and use other data types as needed:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Entity/ProductOptions.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Entity/ProductOptions.php
    :language: php
    :lines: 1-22, 30-37, 102


Installation And Migrations
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create the installation and migration scripts if you plan to distribute your custom bundle or deploy it later to another application or machine. The installation script creates the required database structures during application installation, and the migration scripts update your module to a specific version.

.. note:: More information about migrations is available in the :ref:`OroMigrationBundle <backend-entities-migrations>` documentation.

This blog post has only one version of our custom bundle, so the installation and migration code look similar.

Installation:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Migrations/Schema/OroBlogPostExampleBundleInstaller.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Migrations/Schema/OroBlogPostExampleBundleInstaller.php
    :language: php

Migration:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Migrations/Schema/v1_0/OroBlogPostExampleBundle.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Migrations/Schema/v1_0/OroBlogPostExampleBundle.php
    :language: php

Form Types
^^^^^^^^^^

To customize the new product field, implement a corresponding form type for the main form on the product create and edit pages:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Form/Type/ProductOptionsType.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Form/Type/ProductOptionsType.php
    :language: php
    :lines: 1-9, 13-


The setDataClass method adds flexibility and lets you reuse this form type. Using it this way is optional.

Once you have your new form type, register it in the service container so Symfony's form factory can recognize it:


.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/form_types.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/form_types.yml
    :language: none
    :lines: 1-5


Form Type Extension
^^^^^^^^^^^^^^^^^^^

Integrations between different form types within OroCommerce can use a form type extension to tie the form types together. In our case, we listen for the following form events:

 * **FormEvents::POST_SET_DATA** – used to assign values to the form from our custom entity object;
 * **FormEvents::POST_SUBMIT** – used to convert, validate and persist our custom values.

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Form/Extension/ProductOptionsFormTypeExtension.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Form/Extension/ProductOptionsFormTypeExtension.php
    :language: php
    :lines: 1-16, 21-


Register the new form type extension in the service container:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/form_types.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/form_types.yml
    :language: none
    :lines: 1,7-13

UI Data Targets and Listener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once the entity, the form type, and the form type extension are created, you can start customizing the User Interface.

.. note:: See the :ref:`Layout <dev-doc-frontend-layouts-layout>` section for more information about the UI customization.

Add custom data to the product view and edit/create pages. Use the following dataTargets:

* product-view - used to display our custom data on the product view page;
* product-edit - used to show our custom data on the product edit page;
* product-create-step-two - used to add our custom data to the product creation page.

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/config/services.yml
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/config/services.yml
    :language: none


You can implement the event listener this way:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/EventListener/ProductFormListener.php
    :caption: src/Oro/Bundle/BlogPostExampleBundle/EventListener/ProductFormListener.php
    :language: php
    :lines: 1-12, 16-



Templates

Finally, define the templates. One for the form:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/views/Product/product_options_update.html.twig
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/views/Product/product_options_update.html.twig
    :language: php


And one for the view:

.. literalinclude:: ../../code_examples_untested/customizing_crud/product-options/Resources/views/Product/product_options_view.html.twig
    :caption: src/Oro/Bundle/BlogPostExampleBundle/Resources/views/Product/product_options_view.html.twig
    :language: php


As a result, the following blocks will be displayed on the product edit and create pages:

.. image:: /img/backend/entities/crud_result_edit.png

In view mode, the block looks as follows:

.. image:: /img/backend/entities/crud_result_view.png

A fully working example, organized into a custom bundle, is available in the |OroB2BBlogPostExampleBundle|.

To add this bundle to your application:

* Extract the content of the zip archive into a source code directory recognized by your composer autoload settings;
* Clear the application cache with the following command:

  .. code-block:: none

    `php bin/console cache:clear`

* Run the migrations with the following command:

  .. code-block:: none

     `app oro:migration:load --force --bundles=OroBlogPostExampleBundle`


.. include:: /include/include-links-dev.rst
   :start-after: begin
