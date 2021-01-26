.. _dev-entities-attributes:

Attributes Configuration
========================

Attributes allow you to dynamically create additional entity fields. An attribute is a configuration field with an assigned value. Every attribute has a dedicated CRUD and field types, similarly to the extend fields. For easier management, attributes can be grouped and nested into attribute families.

Enabling Attributes for an Entity
---------------------------------

You can enable attributes for any extendable and configurable entity by doing the following: 

1. Add @Config annotation to the class with the 'attributes' scope and add key 'has_attributes' set to `true`.
2. Add the **attributeFamily** field with many-to-one relation to ``Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamily``. Make field configurable, activate import if necessary, and add migration.
3. Implement **AttributeFamilyAwareInterface** and accessors for the **attributeFamily** field.

The following example illustrates enabling attributes for the *Product* entity:

.. code-block:: php

    <?php
    /**
     * @ORM\Entity
     * @Config(
     *  defaultValues={
     *      "attributes"={
     *          "has_attributes"=true
     *      }
     *  }
     * )
     */
    class Product extends ExtendProduct implements AttributeFamilyAwareInterface
    {
        /**
         * @var AttributeFamily
         *
         * @ORM\ManyToOne(targetEntity="Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamily")
         * @ORM\JoinColumn(name="attribute_family_id", referencedColumnName="id", onDelete="RESTRICT")
         * @ConfigField(
         *      defaultValues={
         *          "dataaudit"={
         *              "auditable"=false
         *          },
         *          "importexport"={
         *              "order"=10
         *          }
         *      }
         *  )
         */
        protected $attributeFamily;

        /**
         * @param AttributeFamily $attributeFamily
         * @return $this
         */
        public function setAttributeFamily(AttributeFamily $attributeFamily)
        {
            $this->attributeFamily = $attributeFamily;

            return $this;
        }

        /**
         * @return AttributeFamily
         */
        public function getAttributeFamily()
        {
            return $this->attributeFamily;
        }

        ...
    }


.. note:: Remember to clear cache and update configuration after these changes.

Creating an Attribute
---------------------

After enabling attributes for an entity, you can use routes - *oro_attribute_index*, *oro_attribute_family_index*, etc - to create and manipulate the attributes. Alias of your entity class should be passed in the route parameters to help controller's action identify the necessary entity. The action is not accessible when the alias is missing or invalid, and when no 'attributes' are configured for the provided entity.

You can add routes to the navigation tree to simplify access, like in the following example:

.. code-block:: yaml

    product_attributes_index:
        label: 'oro.product.menu.product_attributes'
        route: 'oro_attribute_index'
        route_parameters:
            alias: 'product'
        extras:
            routes: ['oro_attribute_*']

The 'oro_attribute_create' route is responsible for creating a new attribute. Attribute creation is split into two steps. In step 1, a user provides the attribute code used as a unique slug representation and attribute type (string, bigint, select, etc) that defines the data that should be captured in the following step. In step 2, a user provides a label used to display an attribute on the website (e.g., OroCommerce Web Store) and any other information that should be captured about the attribute. Oro application can store the attribute as a *serialized field* or as a *table column*. The type of storage is selected based on the attribute type (simple types vs Select and Multi-Select), as well as setting of the *Filterable* and *Sortable* options. The product attribute storage type is set to *table column* for the attribute with Select of Multi-Select data type, and also for an attribute of any type with Filterable or Sortable option enabled. This data type requires reindex that is launched by the user when they click **Update schema** on the *All Product Attributes* page. This triggers the field to be physically created in the table.

.. note:: Attributes created by user are labeled as custom, while attributes created during migrations are labeled as system. For system attributes deleting is disabled.

Attribute Families and Groups
-----------------------------

An entity has no direct relation to the attribute. Attributes are bound to the entity using the *AttributeFamily*. You can create a new attribute family for the entity using the *oro_attribute_family_create* route with the corresponding alias. The *AttributeFamily* contains a collection of *AttributeGroups*. *AttributeFamily* requires *Code* and *Labels* values to be provided and must contain at least on attribute group. Attribute groups can be created directly on family create/edit page by simply adding new group to collection. Each group (a collection element) has a required field 'Label' and a select control that allows to pick one or many attributes that were previously created for the entity (in a certain class). Attributes can be added to the group, moved from one group to another, and deleted from the group (except for the system attributes that are moved to the default group on deletion).

Attribute ACL
-------------

Attributes provide supplementary logic that helps extend entity fields marked as attributes despite limited access to the entity management.
