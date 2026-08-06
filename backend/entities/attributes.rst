.. _dev-entities-attributes:

Attributes Configuration
========================

Attributes allow you to create additional entity fields dynamically. An attribute is a configuration field with an assigned value. Every attribute has a dedicated CRUD and field types, similar to the extend fields. For easier management, attributes can be grouped and nested into attribute families.

Enabling Attributes for an Entity
---------------------------------

You can enable attributes for any extendable and configurable entity by doing the following:

1. Add #[Config] attribute to the class with the 'attribute' scope and add key 'has_attributes' set to `true`.
2. Add the **attributeFamily** field with many-to-one relation to ``Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamily``. Make the field configurable, activate import if necessary, and add migration.
3. Implement **AttributeFamilyAwareInterface** and accessors for the **attributeFamily** field.

The following example illustrates enabling attributes for the *Document* entity:

.. oro_integrity_check:: 6b893012dab1a48c041f7510af8212c65c920c35

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 17-19, 22, 27, 47-51, 60, 55, 60, 136-160


.. oro_integrity_check:: 680f39c18e400d938ffaa763f577707f80e427c0

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_9/AddAttributeFamilyField.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_9/AddAttributeFamilyField.php
       :language: php
       :lines: 3-30

.. note:: Remember to clear cache and update configuration after these changes.

Creating an Attribute
---------------------

After enabling attributes for an entity, use routes such as *oro_attribute_index* and *oro_attribute_family_index* to create and manage the attributes. Pass your entity class alias in the route parameters so the controller's action can identify the entity. The action is unavailable when the alias is missing or invalid, or when no attributes are configured for the entity.

You can add routes to the navigation tree to simplify access, like in the following example:

.. oro_integrity_check:: a8cd11ff80b2ac52cc0316fcc3ab66c37a463fe3

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/navigation.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml
       :language: yaml
       :lines: 73-86


The ``oro_attribute_create`` route creates a new attribute in two steps.

In step 1, the user provides the attribute code (a unique slug) and the attribute type (string, bigint, select, etc.), which defines the data captured in the next step.

In step 2, the user provides a label to display the attribute on the website (e.g., OroCommerce Web Store) and any other information to capture about the attribute.

The Oro application stores the attribute either as a *serialized field* or as a *table column*. The storage type is selected based on the attribute type (simple types vs. Select and Multi-Select) and on the *Filterable* and *Sortable* settings.

The product attribute storage type is set to *table column* for an attribute with the Select or Multi-Select data type, and for an attribute of any type with the Filterable or Sortable option enabled. This storage type requires a reindex, which the user launches by clicking **Update schema** on the *All Product Attributes* page. This physically creates the field in the table.

.. note:: Attributes created by the user are labeled as custom, while attributes created during migrations are labeled as a system. For system attributes, deleting is disabled.

.. warning:: Schema changes are permanent and cannot be easily rolled back. We recommend that developers back up data before any database schema change if changes have to be rolled back.

Attribute Families and Groups
-----------------------------

An entity has no direct relation to the attribute. Instead, attributes are bound to the entity through the *AttributeFamily*. You can create a new attribute family for the entity using the *oro_attribute_family_create* route with the corresponding alias.

An *AttributeFamily* contains a collection of *AttributeGroups*. It requires *Code* and *Labels* values and must contain at least one attribute group.

Create attribute groups directly on the family create/edit page by adding a new group to the collection. Each group (a collection element) has a required field, 'Label', and a select control for picking one or many attributes previously created for the entity (in a specific class).

You can add attributes to a group, move them from one group to another, and delete them from a group. System attributes are an exception: on deletion, they move to the default group instead.

Attribute ACL
-------------

Attributes provide supplementary logic that helps extend entity fields marked as attributes despite limited access to the entity management.

.. note:: Next, you can modify the shape of the Document so that there are several steps when creating the entity. For example, you can use OroProductBundle.
