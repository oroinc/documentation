.. _entity-aliases:

Entity Aliases
==============

|Entity aliases| were introduced to provide a simple way of referring to entities.

The usages for entity aliases can be numerous, but they come in handy when specifying entities in the API, removing the need to use bulky FQCNs.

You can use entity aliases with the help of |EntityAliasResolver|, which provides necessary functions for obtaining aliases for given class names and visa versa.

Define Entity Aliases
---------------------

In most cases, aliases are generated automatically.

The generation rules are the following:

- For all Oro entities (all classes starting with "Oro"), the lowercase short class name is used, e.g., ``Oro\Bundle\CalendarBundle\Entity\CalendarEvent`` = ``calendarevent``.

- For non-Oro (3-rd party) entities, the bundle name is prepended to the short class name if it does not already start with the bundle name, e.g., ``Acme\Bundle\DemoBundle\Entity\MyEntity`` = ``demomyentity``, ``Acme\Bundle\DemoBundle\Entity\DemoEntity`` = ``demoentity``.

- For "enums", the enum code is used as the entity alias, but the underscore (_) character is removed.

- For custom entities, the lowercase short class name is used prepended with the "extend" keyword.

- Hidden entities are ignored.

It is possible, however, to define custom rules for entity aliases in the ``Resources/config/oro/entity.yml`` configuration file.
This can help avoid naming conflicts or make entity aliases more readable or user-friendly.

You can explicitly define aliases for a specific entity in the ``entity_aliases`` section of ``Resources/config/oro/entity.yml``:

.. code-block:: yaml

    oro_entity:
        entity_aliases:
            Oro\Component\MessageQueue\Job:
                alias:        job
                plural_alias: jobs

To exclude certain entities from the alias generation process, for example, some internal entities, you can add the ``entity_alias_exclusions`` section:

.. code-block:: yaml

    oro_entity:
        entity_alias_exclusions:
            - Oro\Bundle\ConfigBundle\Entity\Config
            - Oro\Bundle\ConfigBundle\Entity\ConfigValue


Entity Alias Provider
---------------------

When you need more complicated rules for creating entity aliases that cannot be configured via the ``Resources/config/oro/entity.yml`` file, create an entity alias provider.

For this, you need to implement the |EntityAliasProviderInterface| interface in your provider class:

.. code-block:: php

    use Oro\Bundle\EmailBundle\Entity\Manager\EmailAddressManager;
    use Oro\Bundle\EntityBundle\Model\EntityAlias;
    use Oro\Bundle\EntityBundle\Provider\EntityAliasProviderInterface;

    class EmailEntityAliasProvider implements EntityAliasProviderInterface
    {
        /** @var string */
        protected $emailAddressProxyClass;

        /**
         * @param EmailAddressManager $emailAddressManager
         */
        public function __construct(EmailAddressManager $emailAddressManager)
        {
            $this->emailAddressProxyClass = $emailAddressManager->getEmailAddressProxyClass();
        }

        /**
         * {@inheritdoc}
         */
        public function getEntityAlias($entityClass)
        {
            if ($entityClass === $this->emailAddressProxyClass) {
                return new EntityAlias('emailaddress', 'emailaddresses');
            }

            return null;
        }
    }

Register your provider service in the DI container with the ``oro_entity.alias_provider`` tag:

.. code-block:: yaml

    oro_email.entity_alias_provider:
        class: Oro\Bundle\EmailBundle\Provider\EmailEntityAliasProvider
        public: false
        arguments:
            - '@oro_email.email.address.manager'
        tags:
            - { name: oro_entity.alias_provider, priority: 100 }


.. note:: You can specify the priority for the alias provider. The bigger the priority number is, the earlier the provider is executed. The priority value is optional and defaults to 0.

View Existing Entity Aliases
----------------------------

Use the ``php bin/console oro:entity-alias:debug`` CLI command to see all the aliases.

The output example:

.. code-block:: yaml

    Class                                                    Alias                  Plural Alias
    Oro\Bundle\ActivityListBundle\Entity\ActivityList        activitylist           activitylists
    Oro\Bundle\AddressBundle\Entity\Address                  address                addresses
    Oro\Bundle\AddressBundle\Entity\AddressType              addresstype            addresstypes
    Oro\Bundle\AddressBundle\Entity\Country                  country                countries
    Oro\Bundle\AddressBundle\Entity\Region                   region                 regions
    Oro\Bundle\AttachmentBundle\Entity\Attachment            attachment             attachments
    Oro\Bundle\AttachmentBundle\Entity\File                  file                   files
    Oro\Bundle\CalendarBundle\Entity\Calendar                calendar               calendars
    Oro\Bundle\CalendarBundle\Entity\CalendarEvent           calendarevent          calendarevents


Suggestions for Naming Aliases
------------------------------

To solve the conflict situations when the auto-generated entity alias is already in use, follow the naming rules described below:

- For Oro entities, in most cases, it is sufficient to prepend the short class name with the bundle name, e.g., ``Oro\Bundle\SalesBundle\Entity\Customer`` = ``salescustomer``.

- More general entities should have a more general alias, e.g., ``Oro\Bundle\EmailBundle\Entity\Email`` = ``email``, ``Oro\Bundle\ContactBundle\Entity\ContactEmail`` = ``contactemail``. If the bundle and short class names are the same, they should be used as the alias. The bundle name should be used as a prefix for other entities with the same short class.

- For non-Oro entities, if you are unsure that the auto-generated alias is unique enough and it is likely (usually it is) that such entity will be added in the Oro core, you can prefix the alias with the bundle vendor (and category if needed), e.g., ``Acme\Bundle\BlogBundle\Entity\MyEntity`` = ``acmeblogmyentity``, ``Acme\Bundle\Social\BlogBundle\Entity\MyEntity`` = ``acmesocialblogmyentity``.


.. include:: /include/include-links-dev.rst
   :start-after: begin