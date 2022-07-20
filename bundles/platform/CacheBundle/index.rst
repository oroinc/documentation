:oro_show_local_toc: true

.. _bundle-docs-platform-cache-bundle:

.. index::
    single: Cache

OroCacheBundle
==============

OroCacheBundle introduces the configuration of the application data cache storage used by the application bundles
for different cache types.

.. _bundle-docs-platform-cache-bundle--data-cache-service:

Data Cache Service
------------------

We recommend using service ``oro.data.cache`` to cache the application data. This service uses |ChainAdapter| to improve cache operations.

You can inject it into the service where you need to cache the data:

.. code-block:: none

    services:
        acme_demo.my_data_cache.service:
            class: Acme\Bundle\DemoBundle\Provider\CacheService
            public: false
            arguments:
                - '@oro.data.cache'

You can also set a namespace for the cache pool that extends ``oro.data.cache``:

.. code-block:: none

    services:
        acme_demo.data.cache:
            parent: oro.data.cache
            tags:
                - { name: 'cache.pool', namespace: 'acme_demo' }

        acme_demo.my_data_cache.service:
            class: Acme\Bundle\DemoBundle\Provider\CacheService
            arguments:
                - '@acme.data.cache'

.. _bundle-docs-platform-cache-bundle--caching-static-configs:

Caching Static Configuration
----------------------------

A static configuration is defined in the configuration files and does not depend on the application data.
Usually such configuration is loaded from configuration files located in different bundles, e.g. from
`Resources/config/oro/my_config.yml` files that can be located in any bundle.
There are several possible ways to store the collected configuration to avoid loading and merging it
on each request:

1. As a parameter in the dependency injection container.
   The disadvantage of this approach is not very good DX (Developer Experience) because each time when
   the configuration is changed the whole container should be rebuilt.
2. As a data file in the system cache.
   This approach has better DX as this is the only file that needs rebuilding after the configuration is changed.
   However, the disadvantage is that data should be deserialized every time it is requested.
3. As a PHP file in the system cache.
   It has the same DX as the previous approach but with two important additional advantages:
   the deserialization of the data is not needed and the loaded data is cached by |OPcache|.

To implement 3rd approach for your configuration, you need to take the following steps:

1. Create PHP class that defines the schema of your configuration and validation and merging rules for it. E.g.:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\DependencyInjection;

    use Symfony\Component\Config\Definition\Builder\TreeBuilder;
    use Symfony\Component\Config\Definition\ConfigurationInterface;

    class MyConfiguration implements ConfigurationInterface
    {
        /**
         * @inheritDoc
         */
        public function getConfigTreeBuilder(): TreeBuilder
        {
            $treeBuilder = new TreeBuilder('my_config');

            // build the configuration tree here

            return $treeBuilder;
        }
    }

2. Create the configuration provider PHP class that you will use to get the configuration data. E.g.:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Provider;

    use Acme\Bundle\DemoBundle\DependencyInjection\MyConfiguration;
    use Oro\Bundle\ActionBundle\Configuration\ConfigurationProviderInterface;
    use Oro\Component\Config\Cache\PhpArrayConfigProvider;
    use Oro\Component\Config\Loader\CumulativeConfigLoader;
    use Oro\Component\Config\Loader\CumulativeConfigProcessorUtil;
    use Oro\Component\Config\Loader\YamlCumulativeFileLoader;
    use Oro\Component\Config\ResourcesContainerInterface;

    class MyConfigurationProvider extends PhpArrayConfigProvider  implements ConfigurationProviderInterface
    {
        private const CONFIG_FILE = 'Resources/config/oro/my_config.yml';

        /**
         * @inheritDoc
         */
        public function getConfiguration(): array
        {
            return $this->doGetConfig();
        }

        /**
         * {@inheritdoc}
         */
        protected function doLoadConfig(ResourcesContainerInterface $resourcesContainer)
        {
            $configs      = [];
            $configLoader = new CumulativeConfigLoader(
                'my_config',
                new YamlCumulativeFileLoader(self::CONFIG_FILE)
            );
            $resources    = $configLoader->load($resourcesContainer);
            foreach ($resources as $resource) {
                $configs[] = $resource->data;
            }

            return CumulativeConfigProcessorUtil::processConfiguration(
                self::CONFIG_FILE,
                new MyConfiguration(),
                $configs
            );
        }
    }

3. Register the created configuration provider as a service using ``oro.static_config_provider.abstract`` service
   as the parent one. E.g.:

.. code-block:: yaml

    services:
        acme_demo.my_configuration_provider:
            class: Acme\Bundle\DemoBundle\Provider\MyConfigurationProvider
            public: false
            parent: oro.static_config_provider.abstract
            arguments:
                - '%kernel.cache_dir%/oro/my_config.php'
                - '%kernel.debug%'

The cache warmer is registered automatically with the priority ``200``. This priority adds the warmer at the begin
of the warmers chain that prevents double warmup in case some Application cache depends on the static config cache.
The warmer service ID is the configuration provider service ID prefixed with ``.warmer``. If you want to change
the priority or use your own warmer, you can register the service following these naming conventions.
In this case a default warmer will not be registered for your configuration provider.

An example of a custom warmer:

.. code-block:: yaml

    services:
        acme_demo.my_configuration_provider.warmer:
            class: Oro\Component\Config\Cache\ConfigCacheWarmer
            public: false
            arguments:
                - '@acme_demo.my_configuration_provider'
            tags:
                - { name: kernel.cache_warmer }

If your Application cache depends on your configuration, use ``isCacheFresh($timestamp)`` and ``getCacheTimestamp()``
methods of the configuration provider to check if the Application cache needs to be rebuilt.
Here is an example how to use these methods:

.. code-block:: php

    private function ensureConfigLoaded()
    {
        if (null !== $this->configuration) {
            return;
        }

        $cacheItem = $this->cache->getItem(self::CACHE_KEY);
        $config = $this->fetchConfigFromCache($cacheItem);
        if (null === $config) {
            $config = $this->loadConfig();
            $this->saveConfigToCache($cacheItem, $config);
        }
        $this->configuration = $config;
    }

    private function fetchConfigFromCache(CacheItemInterface $cacheItem): ?array
    {
        $config = null;
        if ($cacheItem->isHit()) {
            [$timestamp, $value] = $cacheItem->get();
            if ($this->mappingConfigProvider->isCacheFresh($timestamp)) {
                $config = $value;
            }
        }

        return $config;
    }

    private function saveMappingConfigToCache(CacheItemInterface $cacheItem, array $config): void
    {
        $cacheItem->set([$this->mappingConfigProvider->getCacheTimestamp(), $config]);
        $this->cache->save($cacheItem);
    }

    private function loadConfig(): array
    {
        $config = $this->configProvider->getConfiguration();

        // add some additional processing of the configuration here

        return $config;
    }

.. _bundle-docs-platform-cache-bundle--caching-validation-rules:

Caching Symfony Validation Rules
--------------------------------

By default, rules for |Symfony Validation Component| are cached using ``oro.cache.adapter.persistent`` service,
but you can change this to make validation caching suit some custom requirements. To do this, you need
to redefine the ``cache.validator`` cache pool configuring some custom service provider.

.. _bundle-docs-platform-cache-bundle--memory-based-cache:

Memory Based Cache
------------------

One of the most important things when dealing with caches is proper cache invalidation. When using memory based cache,
we need to make sure that we do not keep old values in the memory. Consider this example:

.. code-block:: php

    class LocalizationManager
    {
        private Symfony\Component\Cache\Adapter\ArrayAdapter $cacheProvider;

        public function getLocalization($id)
        {
            $localization = $this->cacheProvider->get($id, function () {
                // ... all other operations, fetch from DB if cache is empty
                // ... save in cache data from DB, see Symfony\Contracts\Cache\CacheInterface
            });

            return $localization;
        }

    }

Since ``$cacheProvider`` in our example is an implementation of memory ``ArrayAdapter``, we will keep the data
there until the process ends. With HTTP request this would work perfectly well, but when our
``LocalizationManager`` is used in some long-running CLI processes, we have to manually clear memory cache
after every change with Localizations. Missing cache clearing for any of these cases leads
to outdated data in ``LocalizationManager``.

The |MemoryCache| class can be used when you need fast implementation of a memory cache.

.. _bundle-docs-platform-cache-bundle--persistent-or-shared-cache:

Persistent or Shared Cache
--------------------------

Let us have a look at our example once again. Since ``LocalizationManager`` is used in the CLI and we do not have
the shared memory, we would not be able to invalidate the cache between different processes. We probably would go for
some more persistent (shared) way of caching, for example, |FilesystemCache|. Now, we are able to share cache
between processes, but this approach causes performance degradation. In general, the memory cache is much faster than
the persistent one.

.. _bundle-docs-platform-cache-bundle--default-implementation:

Default Cache Implementation
----------------------------

There are two abstract services you can use as a parent for your cache services. Default implementations is
following:

For services based on ``oro.data.cache`` the: |ChainAdapter| with |ArrayAdapter| on the top of |FilesystemAdapter|

For services based on ``oro.data.cache.without_memory_cache`` the |ChainAdapter| is not used.

.. _bundle-docs-platform-cache-bundle--complex-objects-keys:

Caching Data based on Complex Objects
-------------------------------------

Cache Hit Ratio is an important measure of cache efficiency. Choosing the right Cache Key might be a complex task,
especially when the cache key should depend on the data stored in a Complex Object. Cache key generation strategy can vary
in different cases and rely on different fields of the same object. To configure cache metadata for different scopes, use
`Resources/config/oro/cache_metadata.yml` files that can be located in any bundle.

Here is an example of such configuration:

.. code-block:: yaml

    Oro\Bundle\OrderBundle\Entity\OrderAddress:
        attributes:
            id:
                groups: ['shipping_context']
            country:
                groups: ['shipping_context', 'promotion']

Data from this configuration is used by the ``oro.cache.generator.object_cache_key`` service to provide cache keys for the
given object and scope.

Sometimes there is a need to configure cache key generation metadata for objects that cannot be normalized by
the default normalizer ``GetSetMethodNormalizer``. In such case new normalizer should be created and registered as a service
tagged with ``oro_cache_generator_normalizer``.

.. code-block:: yaml

    acme_demo.serializer.normalizer:
        class: Acme\Bundle\DemoBundle\Normalizer\CustomObjectNormalizer
        tags:
            - { name: 'oro_cache_generator_normalizer' }

.. include:: /include/include-links-dev.rst
    :start-after: begin
