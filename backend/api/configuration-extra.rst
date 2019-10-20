.. _web-api--configuration-extra:

Configuration Extras
====================

The configuration extras are the way to get varying configuration information.

There are two types of the configuration extras:

-  A configuration extra used to request additional configuration options for existing configuration sections. This extra is represented by  ``Oro\Bundle\ApiBundle\Config\Extra\ConfigExtraInterface``.
-  A configuration extra used to request additional configuration sections. This extra is represented by ``Oro\Bundle\ApiBundle\Config\Extra\ConfigExtraSectionInterface``.

Both types of the configuration extras works in the following way:

-  The actions like :ref:`get <web-api--actions>`, :ref:`get\_list <web-api--actions>` or :ref:`delete <web-api--actions>` register the configuration extras in the :ref:`Context <web-api--actions>` using the ``addConfigExtra`` method. All required extras must be registered before any of the ``getConfig``, ``getConfigOf``, ``getConfigOfFilters`` or ``getConfigOfSorters`` methods of the Context is called. Typically the registration happens in processors from ``initialize`` group. For example |InitializeConfigExtras|.
-  When a processor needs a configuration, it calls the appropriate method of the :ref:`Context <web-api--actions>`. For example ``getConfig``, ``getConfigOf``, ``getConfigOfFilters`` or ``getConfigOfSorters``. The first call of any of these methods causes loading of the configuration.
-  The loading of the configuration is performed by the :ref:`get\_config <web-api--actions>` action. Any of processors registered for this action can check which configuration data is requested. There are two ways of  how a processor can find out which configuration data is requested. The first one is to use the :ref:`processor conditions <web-api--processors>`. The second one is to use the ``hasExtra`` method of the  |ConfigContext|.

For more details on the config structure, sections, properties, etc., see the :ref:`Configuration Reference <web-api--configuration>`.

.. _web-api--configuration-extra-configextrainterface:

ConfigExtraInterface
--------------------

The |ConfigExtraInterface| has the following methods:

- **getName** - Returns a string which is used as unique identifier of configuration data.
- **getCacheKeyPart** - Returns a string to add to a cache key used by the |configuration providers|. In most cases this method returns the same value as the ``getName`` method.  However, more complicated extras can build the cache key part based on other properties, e.g. |MaxRelatedEntitiesConfigExtra|.
- **configureContext** - Adds additional values into the |ConfigContext|. For example, the mentioned above |MaxRelatedEntitiesConfigExtra| adds the maximum number of related entities into the context of the :ref:`get\_config <web-api--actions>` action and this value is used by the |SetMaxRelatedEntities| processor to make necessary modifications to the configuration.
- **isPropagable** - Indicates whether this config extra should be used when a configuration of related entities is built. For example,  |DescriptionsConfigExtra| is propagable and as result field value data transformers will be returned for the main entity and all related entities.

.. _web-api--configuration-extra-configextrasectioninterface:

ConfigExtraSectionInterface
---------------------------

The |ConfigExtraSectionInterface| extends |ConfigExtraInterface| and has one additional method:

-  **getConfigType** - Returns the configuration type that should be loaded into the corresponding section. The |ConfigLoaderFactory| uses the return value of this method to find the appropriate loader.

There is a list of existing configuration extras that implement this interface:

- |FiltersConfigExtra|
- |SortersConfigExtra|

.. _web-api--configuration-extra-example:

Example of configuration extra
------------------------------

The |DescriptionsConfigExtra| is used to request human-readable descriptions of entities and their fields:

.. code:: php

    <?php

    namespace Oro\Bundle\ApiBundle\Config;

    use Oro\Bundle\ApiBundle\Processor\GetConfig\ConfigContext;

    class DescriptionsConfigExtra implements ConfigExtraInterface
    {
        const NAME = 'descriptions';

        public function getName()
        {
            return self::NAME;
        }

        public function configureContext(ConfigContext $context)
        {
            // no modifications of the ConfigContext are required
        }

        public function isPropagable()
        {
            return false;
        }

        public function getCacheKeyPart()
        {
            return self::NAME;
        }
    }

Usually configuration extras are added to the context by the ``InitializeConfigExtras`` processors which belong to the ``initialize group``, e.g., the |InitializeConfigExtras| processor for the ``get`` action. However, the API documentation requires human-readable descriptions. Therefore, |DescriptionsConfigExtra| is added by |RestDocHandler|.

The |CompleteDescriptions| processor adds descriptions for entity, fields, and filters. This processor is registered as a service in |processors.get_config.yml|. Please note, the processor tag contains the ``extra`` attribute with ``descriptions&definition`` value. This means that the processor will be executed only if the extra configuration (in this case ``description`` and ``definition``) were requested. For more details see :ref:`processor conditions <web-api--processors>`.

.. include:: /include/include-links.rst
   :start-after: begin
