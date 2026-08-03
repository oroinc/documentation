.. _dev-entities-entity-name-resolver:

Entity Name Resolver and Providers
==================================

Entity Name Resolver
--------------------

The |Entity Name Resolver| service makes configuring entity name formatting more flexible.

It provides two functions for getting the entity name:

- string *public* *getName*(object *entity*[, string *format*, string *locale*])

Use this method to get a text representation of an entity, formatted according to the format passed (for example, "full" or "short"). If you omit the format, the default one is used.

You can pass the *locale* parameter to format the text representation using a specific locale:

- string *public* *getNameDQL*(string *className*, string *alias*[, string *format*, string *locale*])

This method returns a DQL expression for getting a text representation of the given type of entities, formatted according to the format passed (for example, "full" or "short"). If you omit the format, the default one is used.

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

You can specify a fallback format for the entity, used when no provider implements the given format.

Entity Name Providers
---------------------

The Entity Name Resolver does not resolve entity names by itself. Instead, it relies on a collection of Entity Name Providers to do the job.
The first provider that returns a reliable result wins; the rest are not asked.

To create an Entity Name Provider, you should implement the |EntityNameProviderInterface|:

.. code-block:: php


    use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;

    class FullNameProvider implements EntityNameProviderInterface
    {
        #[\Override]
        public function getName($format, $locale, $entity)
        {
            if ($format === self::FULL && $this->isFullFormatSupported(get_class($entity))) {
                // return entity format
            }

            return false;
        }

        #[\Override]
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
            // check if $className supports full name formatting, e.g., implements some required interfaces
        }
    }

If the provider cannot return a reliable result, it should return FALSE so the resolver keeps checking the other providers in the chain.

Entity name providers are registered in the DI container by the `oro_entity.name_provider` tag:

.. code-block:: yaml

    oro_entity.entity_name_provider.default:
        class: Oro\Bundle\EntityBundle\Provider\EntityNameProvider
        public: false
        arguments:
            - '@doctrine'
        tags:
            - { name: oro_entity.name_provider, priority: -100 }

You can specify the priority to move the provider up or down the chain. The bigger the priority number, the earlier the provider runs. The priority is optional and defaults to 0.

In simple cases, you can configure fields that should be used to get an entity name via ``oro_entity.entity_name_representation`` in `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, for example:

.. code-block:: yaml

    oro_entity:
        entity_name_representation:
            Oro\Bundle\OrganizationBundle\Entity\Organization:
                full: [ name ]
                short: [ name ]

**Default behavior**

The bundled provider ``Oro\Bundle\EntityBundle\Provider\EntityNameProvider`` resolves entity titles by finding appropriate fields in the entity. For the 'short' format, it uses the first available string field from 'firstName', 'name', 'title', and 'subject' (in that order). For 'full', it uses a space-delimited concatenation of all non-serialized string fields. If fields are found but the resulting title is empty (that is, the field values are null), it returns the entity id.

If no appropriate fields are available (for example, the entity has no string fields), another provider ``Oro\Bundle\EntityBundle\Provider\FallbackEntityNameProvider`` constructs a title like 'Item #1' from the entity identifier and the `oro.entity.item` translation key.

.. include:: /include/include-links-dev.rst
   :start-after: begin
