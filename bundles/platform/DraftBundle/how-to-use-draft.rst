.. _draft-bundle--use-draft:

How to Use Drafts
=================

This topic describes how to use *draft*.

For example, let’s create a simple bundle using instructions provided in the :ref:`How to create a new bundle <how-to-create-new-bundle>` topic.

Following the steps described below, the released bundle will implement all the functionality provided by DraftBundle.

Add and Configure an Entity
---------------------------

Create an entity with 2 fields: **title** and **content** and implement the entity from ``DraftableInterface``.

+---------+--------+
| Name    | Type   |
+=========+========+
| title   | string |
+---------+--------+
| content | text   |
+---------+--------+

.. note::
    For simplicity, use the predefined ``DraftableTrait`` trait:

.. oro_integrity_check:: 9950ebf55c027833061bd606238982ecdaa59b2a

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Entity/Block.php
        :language: php


Then, add the entity configuration to the **title** and **content** fields. The **draftable** parameter ensures that the field is involved in the draft operation.

Follow the instructions provided in the :ref:`Configure Entities <book-entities-entity-configuration>` topic.

.. oro_integrity_check:: 85387d83bdab20ca132d7fda720078b888ebdfa5

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Entity/Block.php
        :language: php
        :lines: 49-61


.. important::
    To be able to restrict the entity from using ACL, follow the instructions provided in the :ref:`Protect Entities Using ACLs <coobook-entities-acl-enable>` topic.

Restrictions for drafts have specific peculiarities. For more information, see the :ref:`How to use draft ACL <draft-bundle--use-draft-acl>` topic.

Create an Installer/Migration
-----------------------------

An installer :ref:`migration <backend-entities-migrations>` ensures that upon the application installation, the database will contain the entity with the fields defined within bundle.
Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic for more details.

The fields responsible for the draft must match the interface and have the appropriate types.

+------------------+-----------+------------+
| Name             | Type      | Attributes |
+==================+===========+============+
| draft_project_id | ManyToOne | nullable   |
+------------------+-----------+------------+
| draft_source_id  | ManyToOne | nullable   |
+------------------+-----------+------------+
| draft_uuid       | guid      | nullable   |
+------------------+-----------+------------+
| draft_owner_id   | ManyToOne | nullable   |
+------------------+-----------+------------+

After you complete it, you will have the ``installer`` with the following content:

.. oro_integrity_check:: b75926a0d547466c76ea6787ca826ea101e96458

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Migrations/Schema/AcmeCMSBundleInstaller.php
        :language: php


Create a Controller
-------------------

To work with draft entities, you must use the controller for the actions of non-draft entities.

For more details on how to create a controller and navigation, see the following guides:

* :ref:`Entity controller <cookbook-entity-controller>`
* :ref:`Navigation <doc-managing-app-menu>`

.. oro_integrity_check:: c26eaa9527e5e013e7bc98c95c9599c3a1a7fdd7

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Controller/BlockController.php
        :language: php


.. note::
    A draft realizes the **DraftKernelListener** class. Listener receives the controller's original argument, replaces it with a draft, and injects the argument to the controller again. It allows us to use a single entry point for all entities.


Add a Draft Grid
----------------

To manage the entity, we need to create a grid to display original and draft entities. Follow the instructions provided in the :ref:`Configure grid <reference-format-datagrids>` topic for more details.

1. Create a grid for entities

.. oro_integrity_check:: 3216c38a26940823a206b2dab9a94c5ae5be7866

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Resources/config/oro/datagrids.yml
        :language: php
        :lines: 2-33


2. Create a grid for draft entities

.. oro_integrity_check:: 07681c8ecdda003fcca3a71f26c0b6fab3f03229

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Resources/config/oro/datagrids.yml
        :language: php
        :lines: 35-56


.. important::
    Use the ``showDrafts`` option in the grid configuration.
    This parameter is responsible for the enable/disable draft filter.
    This configuration changes the behavior of the grid, and the grid only reflects draft entities.

3. Add grid operations to the grid with draft entities

Operations for the draft entities must be configured separately in ``action.yml``.

Follow the instructions provided in the :ref:`Work with Operations <bundle-docs-platform-action-bundle-operations>` topic.

.. oro_integrity_check:: 4b839ccb2ec3673ff81e4849516938a5a77a15f9

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Resources/config/oro/actions.yml
        :language: php
        :lines: 2-29



Create a Form Type
------------------

Create a form type to handle the draft entity.

Follow the instructions provided in the :ref:`The Form Type <cookbook-entity-form-type>` topic for more details.

.. oro_integrity_check:: d24a10c064b2ef6428692f045233e3e6c7b0bd4f

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Form/Type/BlockType.php
        :language: php


Use the Extension
-----------------

Using the extension, you can change the property value when creating the draft entity. Follow the instructions provided in the :ref:`How to use draft extension <draft-bundle--use-draft-extension>` topic.

Take the following three steps to create an extension:

1. Create a filter
2. Create a matcher
3. Create an extension

Create a Filter
^^^^^^^^^^^^^^^

``Filter`` is a class that can modify the property value and be used in conjunction with ``Matcher``.

.. oro_integrity_check:: caf6feb86a6a5623b244ed408a9332e465d8eda0

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Duplicator/Filter/UniqueTitleFilter.php
        :language: php


Create a Matcher
^^^^^^^^^^^^^^^^

``Matcher`` is a class that points to the field that ``Filter`` can work on. Matcher checks whether the specified field meets the criteria and applies the filter to this field.

.. oro_integrity_check:: 4f38f23b19f663da4d8ebb3d9f8b1c1a2e20dede

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Duplicator/Matcher/BlockTitleMatcher.php
        :language: php


Create an Extension
^^^^^^^^^^^^^^^^^^^

``Extension`` is a class that combines the logic of ``Filter`` and ``Matcher``.

.. oro_integrity_check:: f3ff2fbffd1ec5848b1cc421cba2374dd18cc4e3

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Duplicator/Extension/BlockTitleExtension.php
        :language: php


Create a Template
-----------------

Draft entities use the default templates, so you can use them.
To identify a draft entity, you can create a block that shows whether the entity is a draft entity.

Follow the instructions provided in the :ref:`Template <templates-twig>` topic.

.. oro_integrity_check:: e46cc44901e5611db38e7c682ab89c316576f844

    .. literalinclude:: ../../../code_examples_untested/drafts/draftable-blocks/Resources/views/Block/view.html.twig
        :language: php
        :lines: 18-27


.. include:: ../../../include/include-links-dev.rst
   :start-after: begin
