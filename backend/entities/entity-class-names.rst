.. _dev-entities-entity-class-name-provider:

Entity Class Name Provider
==========================

This service aims to provide human-readable representation in **English** of an entity class name. OroPlatform uses this provider to generate a description of REST API resources that are generated on the fly. See |DictionaryEntityApiDocHandler| for details.

**Interface of an entity class name provider**

The |entity class name provider| service is a "chain" service. It works by asking a set of prioritized providers to get a human-readable representation of an entity class name. Each child service must implement |EntityClassNameProviderInterface|. This interface declares the following methods:

- *getEntityClassName* - returns a human-readable representation for an entity class.
- *getEntityClassPluralName* - returns a human-readable representation in plural for an entity class.

**Create custom entity class name provider**

To create own provider just create a class implementing |EntityClassNameProviderInterface| and register it in DI container with the tag **oro_entity.class_name_provider**. You can also use the existing |abstract provider| as a superclass for your provider.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Provider;

    use Oro\Bundle\EntityBundle\Provider\AbstractEntityClassNameProvider;
    use Oro\Bundle\EntityBundle\Provider\EntityClassNameProviderInterface;

    class AcmeClassNameProvider extends AbstractEntityClassNameProvider implements EntityClassNameProviderInterface
    {
        /**
         * @inheritDoc
         */
        public function getEntityClassName(string $entityClass): ?string
        {
            // add your implementation here
        }

        /**
         * @inheritDoc
         */
        public function getEntityClassPluralName(string $entityClass): ?string
        {
            // add your implementation here
        }
    }

.. code-block:: yaml

    entity_class_name_provider.acme:
        class: Acme\Bundle\DemoBundle\Provider\AcmeClassNameProvider
        public: false
        tags:
            - { name: oro_entity.name_provider, priority: 100 }

You can specify the priority to move the provider up or down the provider's chain. The bigger the priority number is, the earlier the provider will be executed. The priority value is optional and defaults to 0.

.. include:: /include/include-links-dev.rst
   :start-after: begin