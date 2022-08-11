.. _how-to-add-wysiwyg-field:

How to Add WYSIWYG Field
========================

There are two ways to add a WYSIWYG field - via the Entity Management UI and programmatically.

.. hint:: The ability to add a WYSIWYG field in the two abovementioned ways is available starting from OroCommerce v5.0.6. To check which application version you are running, see the :ref:`system information <system-information>`.

.. _how-to-add-wysiwyg-field-via-ui:

Add a WYSIWYG Field via Entity Management UI
--------------------------------------------

To add a WYSIWYG field via the Entity Management UI:

1. Create :ref:`an extended entity field <doc-entity-fields-create>` of the WYSIWYG type.

2. The system manages the WYSIWYG fields similarly to all other extended fields, considering the ``Show on Form`` and ``Show on View`` entity field config options.

For example, if you add a WYSIWYG field called ``teaser`` to an entity, the system automatically creates the ``teaser_style`` and ``teaser_properties`` fields. Entity getters and setters of these fields will be ``getTeaserStyle``/``setTeaserStyle`` and ``getTeaserProperties``/``setTeaserProperties`` correspondingly.

.. _how-to-add-wysiwyg-field-programmatically:

Add a WYSIWYG Field Programmatically
------------------------------------

You can add a WYSIWYG field programmatically in two ways:

1. :ref:`As an extended field <how-to-add-wysiwyg-field-programmatically-as-extended>` if the target entity class cannot be modified. Use the option if you add the field to the default Oro entity or any other entity provided by a vendor.

2. :ref:`Explicitly <how-to-add-wysiwyg-field-programmatically-explicitly>` if the target entity class can be modified. Use the option if you want to create and manage the WYSIWYG field, and have a total control over its validation and representation.

.. _how-to-add-wysiwyg-field-programmatically-as-extended:

Add a WYSIWYG Field as Extended Field
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In terms of the final outcome, this way is similar to :ref:`adding a field via the entity management UI <how-to-add-wysiwyg-field-via-ui>`, as the system is responsible for the WYSIWYG field management, its validation, and representation.

To add a WYSIWYG field as an :ref:`extended field <book-entities-extended-entities-add-fields>`:

1. Create a migration that adds 3 columns of the following types: ``wysiwyg``, ``wysiwyg_style``, and ``wysiwyg_properties``.

.. oro_integrity_check:: 8afa284035159852ecf237ba7bba42c25cd5bc55

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/AddTeaserField.php
        :language: php
        :linenos:

2. Entity getters and setters are generated automatically: ``getTeaser/setTeaser``, ``getTeaserStyle``/``setTeaserStyle``,
``getTeaserProperties``/``setTeaserProperties``.

.. note::
    You can add an extended field to the Product entity as a product attribute during the schema migration. For that, set the ``attribute.is_attribute`` entity field config option to ``true`` in the Oro options of the field column.

.. _how-to-add-wysiwyg-field-programmatically-explicitly:

Add a WYSIWYG Field Explicitly
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To add a WYSIWYG field explicitly:

1. Create a migration that adds 3 columns of the following types: ``wysiwyg``, ``wysiwyg_style``, and ``wysiwyg_properties``:

.. oro_integrity_check:: 1efaa7333e3511d92df701a61025a52e2087dc65

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/AddExtraContentField.php
        :language: php
        :linenos:

2. Add the corresponding properties, getters, and setters to the target entity class:

.. code-block:: php
    :caption: src/Acme/WysiwygBundle/Entity/BlogPost.php

    class BlogPost extends ExtendBlogPost implements DatesAwareInterface
    {
        // ...

        /**
         * @ORM\Column(name="extra_content", type="wysiwyg", nullable=true)
         * @ConfigField(
         *      defaultValues={
         *          "attachment"={
         *              "acl_protected"=false
         *          }
         *      }
         * )
         */
        protected $extraContent;

        /**
         * @ORM\Column(name="extra_content_style", type="wysiwyg_style", nullable=true)
         * @ConfigField(
         *      defaultValues={
         *          "attachment"={
         *              "acl_protected"=false
         *          }
         *      }
         * )
         */
        protected $extraContentStyle;

        /**
         * @ORM\Column(name="extra_content_properties", type="wysiwyg_properties", nullable=true)
         */
        protected $extraContentProperties;

        public function getExtraContent(): ?string
        {
            return $this->extraContent;
        }

        public function setExtraContent(?string $extraContent): self
        {
            $this->extraContent = $extraContent;

            return $this;
        }

        public function getExtraContentStyle(): ?string
        {
            return $this->extraContentStyle;
        }

        public function setExtraContentStyle(?string $extraContentStyle): self
        {
            $this->extraContentStyle = $extraContentStyle;

            return $this;
        }

        public function getExtraContentProperties(): ?array
        {
            return $this->extraContentProperties;
        }

        public function setExtraContentProperties(?array $extraContentProperties): self
        {
            $this->extraContentProperties = $extraContentProperties;

            return $this;
        }

        // ...
    }

.. note::

    The entity field config ``attachment.acl_protected`` is set to ``false`` to disable ACL for the images and files uploaded     to the WYSIWYG field to make them publicly accessible.

3. Declare validation constraints:

.. code-block:: yaml
    :caption: src/Acme/WysiwygBundle/Resources/config/validation.yml

    ACME\Bundle\WysiwygBundle\Entity\BlogPost:
        properties:
            # ...

            extraContent:
                - Oro\Bundle\CMSBundle\Validator\Constraints\TwigContent: ~
                - Oro\Bundle\CMSBundle\Validator\Constraints\WYSIWYG: ~
            extraContentStyle:
                - Oro\Bundle\CMSBundle\Validator\Constraints\TwigContent: ~
                - Oro\Bundle\CMSBundle\Validator\Constraints\WYSIWYG: ~

            # ...

For more details on the WYSIWYG field representation, refer to the :ref:`How to Display a WYSIWYG Field <how-to-display-wysiwyg-field>` topic.

.. include:: /include/include-links-dev.rst
   :start-after: begin
