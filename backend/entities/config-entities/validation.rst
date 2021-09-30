.. _book-entities-entity-configuration-validation:

Entity Config Validations
=========================

You can use this configuration to validate the entity config attribute before saving it.

To add config validation to your bundle:

1. Create a configuration file that implements ``EntityConfigInterface`` or ``FieldConfigInterface``. For entity config, use ``EntityConfigInterface`` and the class that ends with EntityConfiguration. For field config, use ``FieldConfigInterface`` and the class that ends with FieldConfiguration.

Example:

.. code-block:: php

    namespace Oro\Bundle\SecurityProBundle\Config\Validation;

    use Oro\Bundle\EntityConfigBundle\Config\Validation\EntityConfigInterface;
    use Symfony\Component\Config\Definition\Builder\NodeBuilder;

    /**
     * Configuration for security section
     */
    class SecurityEntityConfiguration implements EntityConfigInterface
    {
        public function getSectionName(): string
        {
            return 'security';
        }

        public function configure(NodeBuilder $nodeBuilder): void
        {
            $nodeBuilder
                ->variableNode('share_scopes')->end()
            ;
        }
    }

2. Add this class to ``services.yml`` with tag ``oro_entity_config.validation.entity_config`` .

Example:

.. code-block:: yaml

    Oro\Bundle\SecurityProBundle\Config\Validation\SecurityEntityConfiguration:
        tags:
            - oro_entity_config.validation.entity_config
