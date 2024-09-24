.. _dev-cookbook-framework-create-simple-crud:

CRUD Operations
===============

To let the users create new questions and edit existing ones, follow these steps:

#. :ref:`Create a form type for the Question entity <cookbook-entity-form-type>`.

#. :ref:`Create a controller <cookbook-entity-controller>`.

#. :ref:`Render the form in a template <cookbook-entity-template>`.

#. :ref:`Link data grid entries to the controller <controller-entity-grid-create-edit-link>`.

.. _cookbook-entity-form-type:

The Form Type
-------------

First, you need to create a form type that makes it possible to let the user enter all the data
needed to describe a question:

.. oro_integrity_check:: 5dbe4aa445092339a9c50eaf7fa705af95fc3a36

   .. literalinclude:: /code_examples/commerce/demo/Form/Type/QuestionType.php
       :caption: src/Acme/Bundle/DemoBundle/Form/Type/QuestionType.php
       :language: php
       :lines: 3-

.. seealso:: Learn more about |form types in the Symfony documentation|.

.. _cookbook-entity-controller:

The Controllers
---------------

You then need to create a controller class that comes with two actions: one that is called when a new question should be created and one that can fetch an existing question to let the user modify its data:

.. oro_integrity_check:: 94e69cf5d41446a70dbe143efd12fd338282c0b7

   .. literalinclude:: /code_examples/commerce/demo/Controller/QuestionController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/QuestionController.php
       :language: php
       :lines: 3-41, 52-


Then, make sure that the controller is loaded in your routing configuration so that Symfony knows
which controller needs to be called for particular routes:

.. oro_integrity_check:: 286ae005d3a46e9359b8a167282c3b662af2161f

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/routing.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/routing.yml
       :language: yaml
       :lines: 1-4

.. _cookbook-entity-template:

The Template
------------

The template that is responsible for displaying the form fields should extend the base template ``@OroUI/actions/update.html.twig`` from the OroUIBundle. This template defines some basic blocks that you can use. This way, your own forms will provide the same look and feel as the ones coming with OroPlatform:

.. oro_integrity_check:: 80a97568b7fa531c416275bd07fb836de0a0706b

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Question/update.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Question/update.html.twig
       :language: html


.. _controller-entity-grid-create-edit-link:

Linking the Data Grid
---------------------

Finally, link both actions on the page that displays the list of questions:

**1. Add a link to create new questions**

The base ``@OroUI/actions/index.html.twig`` template from the OroUIBundle that you :ref:`already used <cookbook-entities-grid-controller>` to embed the data grid comes with a pre-defined ``navButtons`` block, which you can use to add a button that links to the *create a question action*:

.. oro_integrity_check:: cf823e20d28a039622d7093fd11cb3b4db831d82

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Question/index.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Question/index.html.twig
       :language: html

**2. Link question rows to the related update action**

To make it possible to modify each question, you need to define a property that describes how the URL of the update action is built, and then add this URL to the list of available actions in your data grid configuration:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-demo-question:
            # ...
            properties:
                id: ~
                update_link:
                    type: url
                    route: acme_demo_question_update
                    params:
                        - id
                # ...
            actions:
                # ...
                edit:
                    type: navigate
                    label: Edit
                    link: update_link
                    icon: edit

.. _book-crud-delete:

Deleting Entities
-----------------

You can delete a question through the ``DELETE`` operation available for all entities by default or through the customized one. When running ``DELETE``, ensure that your entity has a route from the ``routeName`` option of the entity configuration.

You can delete an entity through the :ref:`DELETE operation <bundle-docs-platform-action-bundle-default-operations>` which is enabled by default for all entities. To run the operation, you need to ensure that your entity has the ``routeName`` option of the entity configuration, which will be used as a route name to redirect a user after the ``DELETE`` operation (as in the example below).


.. oro_integrity_check:: e62086d76ecb2047bae3ea096b82d64977f365da

   .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
       :language: php
       :lines: 21-23, 26, 32, 42-43


See the sample configuration of the default ``DELETE`` operation in the |Actions| topic.

If the default configuration is not valid for your particular case, create your own operation that would inherit from the default one, following the example:

.. code-block:: yaml

    DELETE:
        exclude_entities:
            - Oro\Bundle\CatalogBundle\Entity\Category

    oro_catalog_category_delete:
        extends: DELETE
        replace:
            - exclude_entities
            - entities
            - for_all_datagrids
            - for_all_entities
        for_all_datagrids: false
        for_all_entities: false
        entities:
            - Oro\Bundle\CatalogBundle\Entity\Category
        preconditions:
            '@and':
                - '@not_equal': [$.data.parentCategory, null]

.. note:: When creating your own operation, make sure to exclude the entity from the default operation. See more details on :ref:`available operations and their configuration <bundle-docs-platform-action-bundle-operations>` in the related article.


.. include:: /include/include-links-dev.rst
    :start-after: begin
