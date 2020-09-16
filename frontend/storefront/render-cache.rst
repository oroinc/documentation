OroCommerce Render Cache Extension
==================================

One of the ways to significantly improve website performance is to enable caching.
OroCommerce Render Cache Extension provides the server-side cache for OroCommerce storefront
layouts. With a few layout-block options, you can enable cache for specific layout blocks
permanently or for a particular time and invalidate it with the cache tags from a regular
Symfony service when needed. The extension also supports complex caching strategies using
the custom cache metadata provider PHP class.

Installation
------------

1. Install the extension using the composer:

   .. code-block:: bash

      composer require oro/layout-cache

2. Clear the application cache:

   .. code-block:: bash

      php bin/console cache:clear --env=prod

Cache Layout Blocks
-------------------

To cache a block in the layout tree, you have to provide cache metadata with
the ``cache`` block option.

.. note:: Layout block cache does not support blocks that were rendered using iteration over data,
   because it relies on a block id that is reused multiple times when iteration over data is used.

Enable the Cache
~~~~~~~~~~~~~~~~

To enable the layout block cache, provide the ``cache`` block option.

``cache: true`` means the block is cached forever

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue: true

Disable the Cache
~~~~~~~~~~~~~~~~~

By default, the cache is disabled for all the blocks. You can also disable the cache enabled by another layout update.

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue: null


Configuration Reference
~~~~~~~~~~~~~~~~~~~~~~~

maxAge
^^^^^^

**type: `integer` optional, default: null**

Indicates how long the block can be cached. To make the block always
return the fresh content, you can set ``maxAge`` to ``0`` (it is used
for post-cache substitution).

**For example**, store the cache item for 10 minutes:

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue:
             maxAge: 600

varyBy
^^^^^^

**type: `array of scalar items` optional, default: []**

Defines the items that the block cache varies by (e.g., product id, whether the
user is logged in or not).

**For example**, vary the cache item by a product id:

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue:
             varyBy:
               product: '=data["product"].getId()'

tags
^^^^

**type: `array of scalar items` optional, default: []**

Cache tags provide a way to track which cache items depend on certain data.
Tags are used for the cache invalidation.

**For example** tag the cache item with a product id:

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue:
             tags:
               - '="product_" ~data["product"].getId()' # For product with id = 14 it's evaluated to `product_14`

if
^^

**type: `boolean` optional, default: true**

Indicates when the cache must be enabled.

**For example**, enable the cache only for not logged in users:

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: <block-id>
           optionName: cache
           optionValue:
             if: '=!context["is_logged_in"]'

.. note:: All the options can apply layout expressions and must be evaluated to scalar values.
   Also, layout expressions for the cache option must not depend on other block options.

Layout Update Example
---------------------

Cache the layout block with the ``product_view_container`` id for anonymous
users for 10 minutes. The cache varies for different products and is tagged
with the ``product_ID`` tag:

.. code-block:: yaml
   :caption: src/AcmeDemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/cache_product_view.yml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: product_view_container
           optionName: cache
           optionValue:
             maxAge: 600                                  # Cache the block for 600 seconds (10 minutes)
             if: '=!context["is_logged_in"]'               # Enable cache only when user is not logged in
             varyBy:
               product: '=data["product"].getId()'        # Cache varies per product
             tags:
               - '="product_" ~data["product"].getId()'   # Tag is used to invalidate the cache
                                                          # when required, by calling the `invalidateTags()` method
                                                          # on the `@cache.oro_layout.render` service

.. note:: You can use layout update conditions to set cache options depending on the context. **For example**:

   .. code-block:: yaml

      layout:
        actions:
          # ...
        conditions: 'context["is_logged_in"]'

Post-Cache Substitution
-----------------------

Post-cache substitution allows you to cache a block but substitute
sub-block content dynamically, or cache a sub-block with different
settings.

**For example**:

- Cache the whole ``product_view_container`` block forever, but render the ``product_price_container`` block dynamically:

  .. code-block:: yaml
     :linenos:
     :caption: src/AcmeDemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/cache_product_view.yml

     layout:
       actions:
         - '@setOption':
             id: product_view_container
             optionName: cache
             optionValue:
               varyBy:
                 product: '=data["product"].getId()'
         - '@setOption':
             id: product_price_container
             optionName: cache
             optionValue:
                 varyBy:
                   product: '=data["product"].getId()'
                 maxAge: 0 # force disable the cache for a child block

-  Cache the whole ``product_view_container`` block for 1 day, but the ``product_price_container`` block only for 15 minutes:

   .. code-block:: yaml
      :linenos:
      :caption: src/AcmeDemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/cache_product_view.yml

      layout:
        actions:
          - '@setOption':
              id: product_view_container
              optionName: cache
              optionValue:
                varyBy:
                  product: '=data["product"].getId()'
                  maxAge: 86400 # 1 day in seconds
          - '@setOption':
              id: product_price_container
              optionName: cache
              optionValue:
                  varyBy:
                    product: '=data["product"].getId()'
                  maxAge: 900 # cache a child block only for 15 minutes


Cache Block Visibility
----------------------

For security reasons, block visibility is not cached. If you do not want to
calculate block visibility every time, override it to the static value
with the layout update or cache a wrapping container instead.

.. code-block:: yaml
   :linenos:

   layout:
     actions:
       - '@setOption':
           id: product_view_container
           optionName: visible
           optionValue: true
     conditions: 'context["is_logged_in"]'

Make Cache Items Always Vary By Some Data
-----------------------------------------

Out of the box, all cache items vary by *localization*,
*theme*, and *website*.

To add additional data to all ``varyBy`` cache items, create a service
that implements the
``Oro\Bundle\LayoutCacheBundle\Cache\Extension\RenderCacheExtensionInterface``
interface and mark it with the ``layout_cache.extension`` DI tag.

**For example**, vary all the cache items by a day of the week:

.. code-block:: php
   :caption: src/AcmeDemoBundle/Cache/Extension/DayOfWeekExtension.php
   :linenos:

   <?php

   namespace AcmeDemoBundle\Cache\Extension;

   use Oro\Bundle\LayoutCacheBundle\Cache\Extension\RenderCacheExtensionInterface;

   class DayOfWeekExtension implements RenderCacheExtensionInterface
   {
       public function alwaysVaryBy(): array
       {
           return ['day_of_week' => date('l')];
       }
   }

.. code-block:: yaml
   :caption: src/AcmeDemoBundle/Resources/config/services.yml
   :linenos:

   services:
     AcmeDemoBundle\Cache\Extension\DayOfWeekExtension:
       tags: [layout_cache.extension]

Cache Layout Blocks with PHP
----------------------------

Sometimes, layout updates are not flexible enough to cover all the cases
with the block caching. In this case, you can create a custom
metadata provider service that implements the
``Oro\Bundle\LayoutCacheBundle\Cache\Metadata\CacheMetadataProviderInterface``
interface and mark it with the ``layout_cache.metadata_provider`` DI tag.

**For example**, disable the cache for all the blocks if the user is
logged in:

.. code-block:: php
   :caption: src/AcmeDemoBundle/Cache/Metadata/DisableCacheForLoggedInUsersCacheMetadataProvider.php
   :linenos:

   <?php

   namespace AcmeDemoBundle\Cache\Cache\Metadata;

   use Oro\Bundle\LayoutCacheBundle\Cache\Metadata\CacheMetadataProviderInterface;
   use Oro\Bundle\LayoutCacheBundle\Cache\Metadata\LayoutCacheMetadata;
   use Oro\Component\Layout\BlockView;
   use Oro\Component\Layout\ContextInterface;

   class DisableCacheForLoggedInUsersCacheMetadataProvider implements CacheMetadataProviderInterface
   {
       public function getCacheMetadata(BlockView $blockView, ContextInterface $context): ?LayoutCacheMetadata
       {
           if (!$context->get('is_logged_in')) {
               # Do nothing if the user is not logged in
               return null;
           }

           # Return cache metadata with max age equal to 0, if the user is logged in
           return (new LayoutCacheMetadata())->setMaxAge(0);
       }
   }

.. code-block:: yaml
   :caption: src/AcmeDemoBundle/Resources/config/services.yml
   :linenos:

   services:
     AcmeDemoBundle\Cache\Cache\Metadata\DisableCacheForLoggedInUsersCacheMetadataProvider:
       tags: [layout_cache.metadata_provider]

Invalidating Cache by Tags
--------------------------

To invalidate tagged cache items, you have to call the
``invalidateTags()`` method of the ``@cache.oro_layout.render`` service.

**For example**, let's invalidate a cache for a block that depends on a specific
product information when product has been updated:

1. Tag the block that renders product information

   .. code-block:: yaml
      :linenos:
      :caption: src/AcmeDemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/cache_product_view.yml

      layout:
        actions:
          - '@setOption':
              id: product_view_container
              optionName: cache
              optionValue:
                tags:
                  - '="product_" ~data["product"].getId()'

2. Create an event listener that will call the ``invalidateTags()`` method
   on post update event:

   .. code-block:: php
      :linenos:
      :caption: src/AcmeDemoBundle/EventListeners/ProductUpdateListener.php

      <?php

      namespace AcmeDemoBundle\EventListeners;

      use Doctrine\ORM\Event\LifecycleEventArgs;
      use Oro\Bundle\ProductBundle\Entity\Product;
      use Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
      use Symfony\Contracts\Cache\TagAwareCacheInterface;

      class ProductUpdateListener
      {
          /** @var TagAwareAdapterInterface */
          private $cache;

          public function __construct(TagAwareCacheInterface $cache)
          {
              $this->cache = $cache;
          }

          public function postUpdate(LifecycleEventArgs $args)
          {
              $entity = $args->getEntity();
              if ($entity instanceof Product) {
                  $this->cache->invalidateTags(['product_'.$entity->getId()]);
              }
          }
      }

3. Register the listener in a service container:

   .. code-block:: yaml
      :linenos:
      :caption: src/AcmeDemoBundle/Resources/config/services.yml

      services:
        Oro\Bundle\LayoutCacheBundle\EventListeners\ProductUpdateListener:
          arguments:
            - '@cache.oro_layout.render'
          tags:
            - { name: doctrine.event_listener, event: postUpdate }

Configure the Cache Storage
---------------------------

You can use filesystem or Redis as a cache storage. By default, render
cache uses filesystem cache storage.

To enable **Redis** support, append the following config to the
``config/config.yml`` file.

.. code-block:: yaml
   :linenos:
   :caption: config/config.yml

   framework:
     cache:
       pools:
         cache.oro_layout.render:
           adapter: cache.adapter.doctrine
           provider: oro.layout_cache.cache_provider
           tags: true

Pay attention, that Redis configuration is not compatible with the
filesystem cache storage. To enable filesystem storage back, remove the
above mentioned configuration.

When using Redis, it is recommended to use a separate server for the
render cache. To configure it:

1. |Define a new client| in the ``snc_redis`` configuration section and specify the connection DSN, e.g.,:

   .. code-block:: yaml
      :linenos:
      :caption: config/config.yml

      snc_redis:
          clients:
              render_cache:
                  type: predis
                  dsn: redis://localhost/5

2. Override the ``oro.layout_cache.cache_provider`` service to use a new
   Redis client:

   .. code-block:: yaml
      :linenos:
      :caption: src/AcmeDemoBundle/Resources/config/services.yml

      services:
        oro.layout_cache.cache_provider:
          class: Doctrine\Common\Cache\PredisCache
          arguments:
            - '@snc_redis.render_cache'

Clear the Render Cache
----------------------

To clear the render cache, run the command below:

.. code-block:: bash

   php bin/console cache:pool:clear cache.oro_layout.render

.. note:: It is recommended to clear the render cache after any cache-related changes.

.. include:: /include/include-links-dev.rst
   :start-after: begin
