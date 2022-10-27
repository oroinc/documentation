.. _dev-entities-custom-field-validaton:

Custom Field Validation
=======================

Using the `oro_entity.manager.entity_field_validator` service, you can add custom field validation that you can place in your bundle.

Example:

.. code-block:: none

    # Validator
    oro_acme.validator.acme_custom_grid_field_validator:
        class: Acme\Bundle\DemoBundle\Entity\Manager\Field\CustomGridFeildValidator
        tags:
            - {name: oro_entity.custom_grid_field_validator, entity_name: Acme_Bundle_DemoBundle_Entity_Foo }

Each validator should implement ``Oro\Bundle\EntityBundle\Entity\Manager\Field\CustomGridFieldValidatorInterface`` and add a tag description.

The tag should contain `name` and `entity_name`:

* `entity_name` - should contain the entity name which will be performed. Use ``str_replace('\\', '_', ClassUtils::getClass($entity))`` transformation of the object to get the `entity_name` which could be written into the service tag block.
