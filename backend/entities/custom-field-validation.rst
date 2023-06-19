.. _dev-entities-custom-field-validaton:

Custom Field Validation
=======================

Using the `oro_entity.manager.entity_field_validator` service, you can add custom field validation that you can place in your bundle.

Example:

.. oro_integrity_check:: 548b0dc5b8642f75a1001c9f352fb8c4950a4a1b

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 55-61

Each validator should implement ``Oro\Bundle\EntityBundle\Entity\Manager\Field\CustomGridFieldValidatorInterface`` and add a tag description.

The tag should contain `name` and `entity_name`:

* `entity_name` - should contain the entity name which will be performed. Use ``str_replace('\\', '_', ClassUtils::getClass($entity))`` transformation of the object to get the `entity_name` which could be written into the service tag block.

Example:

.. oro_integrity_check:: a0961cdf3da9d03500f2f408859acbabbd4eb043

   .. literalinclude:: /code_examples/commerce/demo/Validator/CustomGridFieldValidator.php
       :caption: src/Acme/Bundle/DemoBundle/Validator/CustomGridFieldValidator.php
       :language: php
       :lines: 3-61
