:oro_show_local_toc: false

:orphan:

.. _op-structure--cache:

Cache in Oro Application
========================

The ``OroCacheBundle`` is responsible for operations with various kinds of caches.

Abstract Cache Services
-----------------------

There are two abstract services you can use as a parent for your cache services:

-  ``oro.file_cache.abstract`` - this cache should be used for caching
   data private for each node in a web farm
-  ``oro.cache.abstract`` - this cache should be used for caching data
   that need to be shared between nodes in a web farm

The following example shows how these services can be used:

.. code-block:: none
    :linenos:

    services:
        acme.test.cache:
            public: false
            parent: oro.cache.abstract
            calls:
                - [ setNamespace, [ 'acme_test' ] ]

Also each of these abstract services can be re-declared in the application configuration file, for example:

.. code-block:: none
    :linenos:

    services:
        oro.cache.abstract:
            abstract: true
            class:                Oro\Bundle\CacheBundle\Provider\PhpFileCache
            arguments:            [%kernel.cache_dir%/oro_data]


The `oro.cache.abstract.without_memory_cache service` is always declared automatically based on `oro.cache.abstract` service.

.. _op-structure--cache--warmup:

Warm Up Config Cache
--------------------

The purpose is to update only cache that will be needed by the application without updating the cache of those resources,
that have not been changed. This gives a big performance over the approach when the all cache is updated. Cache warming
occurs in debug mode whenever you updated the resource files.

The following example shows how this services can be used:

.. code-block:: none
    :linenos:

    ```yaml
    # To register your config dumper:
    oro.config.dumper:
        class: 'Oro\Example\Dumper\CumulativeConfigMetadataDumper'
        public: false

    # To register your config warmer with oro.config_cache_warmer.provider tag:
    oro.configuration.provider.test:
        class: 'Oro\Example\Dumper\ConfigurationProvider'
        tags:
            - { name: oro.config_cache_warmer.provider, dumper: 'oro.config.dumper' }

    ```

    ```php
    <?php

    namespace Oro\Example\Dumper;

    use Symfony\Component\DependencyInjection\ContainerBuilder;

    use Oro\Component\Config\Dumper\ConfigMetadataDumperInterface;
    use Oro\Bundle\CacheBundle\Provider\ConfigCacheWarmerInterface;

    class CumulativeConfigMetadataDumper implements ConfigMetadataDumperInterface
    {

        /**
         * Write meta file with resources related to specific config type
         *
         * @param ContainerBuilder $container container with resources to dump
         */
        public function dump(ContainerBuilder $container)
        {
        }

        /**
         * Check are config resources fresh?
         *
         * @return bool true if data in cache is present and up to date, false otherwise
         */
        public function isFresh()
        {
            return true;
        }
    }

    class ConfigurationProvider implements ConfigCacheWarmerInterface
    {
        /**
        * @param ContainerBuilder $containerBuilder
        */
        public function warmUpResourceCache(ContainerBuilder $containerBuilder)
        {
            // some logic
            $resource = new CumulativeResource();
            $containerBuilder->addResource($resource);
        }
    }
    ```

.. _op-structure--cache--policy:

Caching Policy
^^^^^^^^^^^^^^

Memory Based Cache
~~~~~~~~~~~~~~~~~~

One of the most important things when dealing with caches is proper cache
invalidation. When using memory based cache, we need to make sure that we
do not keep old values in the memory. Consider this example:

.. code-block:: php
    :linenos:

    <?php

    class LocalizationManager
    {
        /** @var \Doctrine\Common\Cache\ArrayCache */
        private $cacheProvider;

        public function getLocalization($id)
        {
            $localization = $this->cacheProvider->fetch($id);

            // ... all other operations, fetch from DB if cache is empty
            // ... save in cache data from DB

            return $localization;
        }

    }

Since ``$cacheProvider`` in our example is an implementation of memory
``ArrayCache``, we will keep the data there until the process ends. With
HTTP request this would work perfectly well, but when our
``LocalizationManager`` is used in some long-running cli
processes, we have to manually clear memory cache after every change
with Localizations. Missing cache clearing for any of these cases leads
to outdated data in ``LocalizationManager``.

Persistent or Shared Cache
~~~~~~~~~~~~~~~~~~~~~~~~~~

Let us have a look at our example once again. Since
``LocalizationManager`` is used in the CLI and we do not have the shared
memory, we would not be able to invalidate the cache between different
processes. We probably would go for some more persistent (shared) way of
caching, for example, ``FilesystemCache``. Now, we are able to share
cache between processes, but this approach causes performance
degradation. In general, the memory cache is much faster than the persistent
one.

Cache Chaining
~~~~~~~~~~~~~~

The solution to the issue mentioned above is to keep a healthy balance
between the fast and shared cache. It is implemented in the |ChainCache| class.

.. code-block:: php
    :linenos:

    <?php

    namespace Oro\Bundle\CacheBundle\Provider;

    use Doctrine\Common\Cache\ArrayCache;
    use Doctrine\Common\Cache\ChainCache;

    class MemoryCacheChain extends ChainCache
    {
        /**
         * {@inheritdoc}
         */
        public function __construct($cacheProviders = [])
        {
            if (PHP_SAPI !== 'cli') {
                array_unshift($cacheProviders, new ArrayCache());
            }

            parent::__construct($cacheProviders);
        }
    }

This class checks whether a request comes from the CLI. If not, the
memory ``ArrayCache`` is added to the top of the cache providers which
are being used for caching. With these priorities set, all HTTP requests
gain performance when dealing with caches in memory and the CLI
processes have no issues with the outdated data as they use the
persistent cache.

Default Cache Implementation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

There are two abstract services you can use
as a parent for your cache services. Default implementations are
following: - for CLI requests: ``MemoryCacheChain`` with only
``Oro\Bundle\CacheBundle\Provider\FilesystemCache`` as a cache provider
- for other requests: ``MemoryCacheChain`` with ``ArrayCache`` on the
top of ``FilesystemCache``

For services based on `oro.cache.abstract.without_memory_cache` the MemoryCacheChain is not used.

.. _Memory based cache: #memory-based-cache
.. _Persistent/shared cache: #persistent/shared-cache
.. _Cache chaining: #cache-chaining
.. _Default cache implementation: #default-cache-implementation


.. _op-structure--cache--validation-rules:

Caching of Symfony Validation Rules
-----------------------------------

By default, rules for |Symfony Validation Component| are cached using
``oro.cache.abstract`` service, but you can change this to make
validation caching suit some custom requirements. To do this, you need
to redefine the ``oro_cache.provider.validation`` service.


.. include:: /include/include-links-dev.rst
   :start-after: begin