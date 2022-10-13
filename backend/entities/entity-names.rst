.. _dev-entities-entity-name-resolver:

Entity Name Resolver and Providers
==================================

Entity Name Resolver
--------------------

The |Entity Name Resolver| service has been introduced to make the configuring of entity name formatting more flexible.

It provides two functions for getting the entity name:

- string *public* *getName*(object *entity*[, string *format*, string *locale*])

You can use this method to get a text representation of an entity formatted according to the format notation passed (e.g., "full", "short", etc.). If the format is not specified, the default one is used.

You can pass the *locale* parameter to format the text representation using a specific locale:

- string *public* *getNameDQL*(string *className*, string *alias*[, string *format*, string *locale*])

This method helps get a DQL expression that can be used to get a text representation of the given type of entities formatted according to the format notation passed (e.g., "full", "short", etc.). If the format is not specified, the default one is used.

You can pass the *locale* parameter to get a text representation using a specific locale.

Example of usage:

.. code-block:: php

    $entityNameResolver = $container->get('oro_entity.entity_name_resolver');
    $user->setFirstName('John');
    $user->setLastName('Doe');
    echo $entityNameResolver->getName($user); // outputs: John Doe
    echo $entityNameResolver->getNameDQL('Oro\Bundle\UserBundle\Entity\User', 'u'); // outputs: CONCAT(u.firstName, CONCAT(u.lastName, ' ')

You can configure the available entity formats in the `entity_name_formats` section of ``Resources/config/oro/entity.yml`` file:

.. code-block:: yaml

    oro_entity:
        entity_name_formats:
            full:
                fallback: short
            short: ~

Note that it is possible to specify the fallback format for the entity that will be used when no providers do not implement the given format.

Entity Name Providers
---------------------

The Entity Name Resolver does not know how to get the entity name by itself but instead, it expects to have a collection of Entity Name Providers that will do the job.
The first provider that can return a reliable result wins. The rest of the providers will not be asked.

To create an Entity Name Provider, you should implement the |EntityNameProviderInterface|:

.. code-block:: php


    use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;

    class FullNameProvider implements EntityNameProviderInterface
    {
        /**
         * {@inheritdoc}
         */
        public function getName($format, $locale, $entity)
        {
            if ($format === self::FULL && $this->isFullFormatSupported(get_class($entity))) {
                // return entity format
            }

            return false;
        }

        /**
         * {@inheritdoc}
         */
        public function getNameDQL($format, $locale, $className, $alias)
        {
            if ($format === self::FULL && $this->isFullFormatSupported($className)) {
                // return DQL to get entity format
            }

            return false;
        }

        /**
         * @param string $className
         *
         * @return bool
         */
        protected function isFullFormatSupported($className)
        {
            // check if $className supports full name formatting, e.g. implements some required interfaces
        }
    }

If the provider cannot return a reliable result, FALSE should be returned to keep looking for the other providers in the chain.

Entity name providers are registered in the DI container by the `oro_entity.name_provider` tag:

.. code-block:: yaml

    oro_entity.entity_name_provider.default:
        class: Oro\Bundle\EntityBundle\Provider\EntityNameProvider
        public: false
        arguments:
            - '@doctrine'
        tags:
            - { name: oro_entity.name_provider, priority: -100 }

You can specify the priority to move the provider up or down the provider's chain. The bigger the priority number is, the earlier the provider will be executed. The priority value is optional and defaults to 0.

**Default behavior**

The bundled provider ``Oro\Bundle\EntityBundle\Provider\EntityNameProvider`` will resolve entity titles by trying to find appropriate fields in the entity. For the 'short' format, it tries to use one string field from the list 'firstName', 'name', 'title', and 'subject' (in that order). For 'full,' it will use a space-delimited concatenation of all non-serialized string fields. If some fields are found, but the resulting title is empty (i.e., the value of the fields is null), it will return the entity id.

If no appropriate fields are available (e.g., the entity does not have any string fields), then another provider ``Oro\Bundle\EntityBundle\Provider\FallbackEntityNameProvider`` will try to construct a title in the form of 'Item #1' from the entity identifier, and `oro.entity.item` translation key.

.. include:: /include/include-links-dev.rst
   :start-after: begin