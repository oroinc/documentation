.. _web-api--configuration-extra:

Configuration Extras
====================

Overview
--------

The configuration extras are the way to get varying configuration information.

There are two types of the configuration extras:

-  a configuration extra that is used to request additional configuration options for existing configuration sections. This extra is represented by ``Oro\Bundle\ApiBundle\Config\ConfigExtraInterface``.
-  a configuration extra that is used to request additional configuration section. This extra is represented by ``Oro\Bundle\ApiBundle\Config\ConfigExtraSectionInterface``.

The both types of the configuration extras works in the following way:

-  The actions like :ref:`get <web-api--actions>`, :ref:`get\_list <web-api--actions>` or :ref:`delete <web-api--actions>` register the configuration extras in the :ref:`Context <web-api--actions>` using the ``addConfigExtra`` method. All required extras must be registered before any of the ``getConfig``, ``getConfigOf``, ``getConfigOfFilters`` or ``getConfigOfSorters`` methods of the Context is called. Typically the registration happens in processors from
   ``initialize`` group. For example |InitializeConfigExtras|.
-  When some processor needs a configuration it calls appropriate method of the :ref:`Context <web-api--actions>`. For example ``getConfig``, ``getConfigOf``, ``getConfigOfFilters`` or ``getConfigOfSorters``. The first call of any of these methods causes the loading of the configuration.
-  The loading of the configuration is performed by the :ref:`get\_config <web-api--actions>` action. Any of processors registered for this action can check which configuration data is requested and will do suitable work. There are two ways how a processor can find out which configuration data is requested. The first is to use the :ref:`processor conditions <web-api--processors>`. The second one is to use the ``hasExtra`` method of the  |ConfigContext|.

Also, please take a look into :ref:`Configuration Reference <web-api--configuration>` for more details about config structure, sections, properties etc.

ConfigExtraInterface
--------------------

|The ConfigExtraInterface| has the following methods:

- **getName** - Returns a string which is used as unique identifier of configuration data.
- **getCacheKeyPart** - Returns a string that should be added to a cache key used by |configuration providers|. In most cases this method returns the same value as the ``getName`` method. But some more complicated extras can build the cache key part based on own properties, e.g. |MaxRelatedEntitiesConfigExtra|.
- **configureContext** - This method can be used to add additional values into the |ConfigContext|. For example, the mentioned above |MaxRelatedEntitiesConfigExtra| adds the maximum number of related entities into the context of the
   :ref:`get\_config <web-api--actions>` action and this value is used by the |SetMaxRelatedEntities| processor to make necessary modifications to the configuration.
- **isPropagable** - Indicates whether this config extra should be used when a configuration of related entities will be built. For example |DescriptionsConfigExtra| is propagable and it means that we will get human-readable descriptions of main entity and all the related entities. If this extra was not propagable the descriptions of main entity would be returned.

ConfigExtraSectionInterface
---------------------------

The ConfigExtraSectionInterface extends ConfigExtraInterface and has one additional method:

-  **getConfigType** - Returns the configuration type that should be loaded into this section. This string is used by |ConfigLoaderFactory| to find the appropriate loader.

There is a list of existing configuration extras that implement this interface:

- |FiltersConfigExtra|
- |SortersConfigExtra|

Example of configuration extra
------------------------------

Let's take a look into |DescriptionsConfigExtra| which is used to request human-readable descriptions of entities and its' fields.

.. code:: php

    <?php

    namespace Oro\Bundle\ApiBundle\Config;

    use Oro\Bundle\ApiBundle\Processor\Config\ConfigContext;

    class DescriptionsConfigExtra implements ConfigExtraInterface
    {
        const NAME = 'descriptions';

        public function getName()
        {
            return self::NAME;
        }

        public function configureContext(ConfigContext $context)
        {
            // no any modifications of the ConfigContext is required
        }

        public function isPropagable()
        {
            return true;
        }

        public function getCacheKeyPart()
        {
            return self::NAME;
        }
    }

Usually configuration extras are added to the Context by ``InitializeConfigExtras`` processors which belong to ``initialize`` group, e.g. |InitializeConfigExtras| processor for ``get`` action. But human-readable descriptions are required only for generation documentation for Data API. So, |DescriptionsConfigExtra| is added by |RestDocHandler|.

The processor which adds descriptions for entity, fields and filters is |CompleteDescriptions|. This processor is registered as services in |processors.get_config.yml|. Please note, the processor tag contains the ``extra`` attribute with ``descriptions&definition`` value. This means that the processor will be executed only if the
extra configuration (in this case ``description`` and ``definition``) were requested. For more details see :ref:`processor conditions <web-api--processors>`.

.. include:: /include/include-links.rst
   :start-after: begin