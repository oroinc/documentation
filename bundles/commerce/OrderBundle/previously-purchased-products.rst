.. _bundle-docs-commerce-order-bundle-previously-purchased-products:

Previously Purchased Products
=============================

The Previously Purchased Products functionality adds the previously purchased products grid to the customer pages under `Account >  Previously Purchased` on the frontend. By default, previously purchased products are disabled. To enable this functionality, navigate to **System > Configuration > Orders > Purchase History > Enabled Purchase History** in the admin panel.

.. _previously-purchased-products-config:

Configuration
-------------

Here is an example of the system config section.

.. code-block:: yaml
   :linenos:

    purchase_history:
        children:
             purchase_history:
                 children:
                     - oro_order.enable_purchase_history
                     - oro_order.order_previously_purchased_period

The ``oro_order.enable_purchase_history`` option turns the feature on or off.
The ``oro_order.order_previously_purchased_period`` option stores the number of days that the purchase history should cover. The products listed as previously purchased are filtered using this timeframe and are displayed in the |previously purchased products grid|.

For more information about system_config.yml, please see the relevant |system configuration documentation|.

.. _previously-purchased-products-website-search-index:

Website Search Index
--------------------

Class |WebsiteSearchProductIndexerListener|. This listener contains methods which are called when reindex process is running.

onWebsiteSearchIndex
^^^^^^^^^^^^^^^^^^^^

.. code-block:: php

   public function onWebsiteSearchIndex(IndexEntityEvent $event)


This method is triggered when search reindex process starts running. For example, we can start the reindex process with the ``oro:website-search:reindex`` command.
This method adds new columns to the records with the `oro_product_WEBSITE_ID` index and based on order created_at, customer_user_id, and product_id.

Index Field
^^^^^^^^^^^

|website_search.yml|

.. code-block:: yaml
   :linenos:

    Oro\Bundle\ProductBundle\Entity\Product:
        alias: oro_product_WEBSITE_ID
        fields:
          -
            name: ordered_at_by_CUSTOMER_USER_ID
            type: datetime


The index field which stores information about the date of the last purchase of the product.

This field is used to select a query in the grid config for select, filter and sort data. For more information, please see |datagrids.yml|.

.. code-block:: yaml
   :linenos:

   query:
       select:
           - datetime.ordered_at_by_CUSTOMER_USER_ID as recency
       where:
           and:
               - datetime.ordered_at_by_CUSTOMER_USER_ID >= @oro_order.previously_purchased.configuration->getPreviouslyPurchasedStartDateString()

.. _previously-purchased-products-reindex-listeners:

Reindex Listeners
^^^^^^^^^^^^^^^^^

.. _previously-purchased-products-reindex-product-line-item-listener:

**ReindexProductLineItemListener**


Class |ReindexProductLineItemListener|.

This listener contains methods which are called when the |OrderLineItem| entity is changed, and if all conditions are correct, a message is sent to the message queue to reindex product data.

**reindexProductOnLineItemCreateOrDelete**

.. code-block:: php
   :linenos:

   public function reindexProductOnLineItemCreateOrDelete(OrderLineItem $lineItem, LifecycleEventArgs $args)

This method is triggered when we create or delete an order line item. Once the order line item is created or deleted, a message is sent to the message queue informing that reindex for a product entity is required. However, if the order has unsuitable status, or the feature has been disabled, the message for reindex is not sent.

**reindexProductOnLineItemUpdate**

.. code-block:: php
   :linenos:

   public function reindexProductOnLineItemUpdate(OrderLineItem $lineItem, PreUpdateEventArgs $event)

This method is triggered when we update the "product" field in the order line item entity, and a message is sent to the message queue that reindex for the product entity is required. However, if the order has unsuitable status, or the feature has been disabled, the message is not sent for reindex.

.. _previously-purchased-products-reindex-product-order-listener:

**ReindexProductOrderListener**

Class |ReindexProductOrderListener|.

This listener contains methods which are called when the |Order entity| is changed, and if all conditions are correct, a message is sent to the message queue to reindex product data.

**processIndexOnOrderStatusChange**

.. code-block:: php
   :linenos:

   public function processIndexOnOrderStatusChange(Order $order, PreUpdateEventArgs $event)

This method is triggered when order status is changed. But if order status is not applicable, the message for reindex is not sent.

**processIndexOnOrderWebsiteChange**

.. code-block:: php
   :linenos:

   public function processIndexOnOrderWebsiteChange(Order $order, PreUpdateEventArgs $event)

This method is triggered when order website is changed. But if order status is not applicable, the message for reindex is not sent.

**processOrderRemove**

.. code-block:: php
   :linenos:

   public function processOrderRemove(Order $order)

This method is triggered when an order is removed. But if order status is not applicable, the message for reindex process is not sent.

**processIndexOnCustomerUserChange**

.. code-block:: php
   :linenos:

   public function processIndexOnCustomerUserChange(Order $order, PreUpdateEventArgs $event)

This method is triggered when order is updated and the `customerUser` field is changed. However, if order status is not applicable, the message for reindex process is not sent.

**processIndexOnOrderCreatedAtChange**

.. code-block:: php
   :linenos:

   public function processIndexOnOrderCreatedAtChange(Order $order, PreUpdateEventArgs $event)

This method is triggered when order is updated and the `createdAt` field is changed. However, if order status is not applicable, the message for reindex process is not sent.

**PreviouslyPurchasedFeatureToggleListener**

Class |PreviouslyPurchasedFeatureToggleListener|.

This listener contains methods which are called when we turn the feature on or off from the system config. 

**reindexProducts**

.. code-block:: php
   :linenos:

   public function reindexProducts(ConfigUpdateEvent $event)

This method is triggered when we change the `enable_purchase_history` config setting. Once the setting is changed, a message is sent to reindex products in the global or website scope. 

.. _previously-purchased-products-managers:

Managers
--------

ProductReindexManager
^^^^^^^^^^^^^^^^^^^^^

Class |ProductReindexManager|.

This manager contains methods which are used when we need to reindex a product or a collection of products. Use it when you need
to reindex product data. 

**reindexProduct**

.. code-block:: php
   :linenos:

   public function reindexProduct(Product $product, $websiteId = null)

This method triggers reindex process for the current product. If the websiteId is not present, this method takes the default website id.

**triggerReindexationRequestEvent**

.. code-block:: php
   :linenos:

   public function triggerReindexationRequestEvent(array $productIds, $websiteId = null, $isScheduled = true)

This method triggers reindex process for a collection of product ids. 

.. _previously-purchased-products-providers:

Providers
---------

**PreviouslyPurchasedConfigProvider**

Class |PreviouslyPurchasedConfigProvider|.

This provider provides you with the configuration for previously purchased products.

Here is a quick overview of its usage:

**getDaysPeriod**

.. code-block:: php
   :linenos:

   $this->get('oro_order.previously_purchased.configuration')->getDaysPeriod();

Returns the count of days for previously purchased products.

**getPreviouslyPurchasedStartDateString**


.. code-block:: php
   :linenos:

    $this->get('oro_order.previously_purchased.configuration')->getPreviouslyPurchasedStartDateString()


Returns the start date in string format for previously purchased products.

.. _previously-purchased-products-latest-ordered-products-info-provider:

**LatestOrderedProductsInfoProvider**

Class |LatestOrderedProductsInfoProvider|.

This provider is used when we need more information about who and when bought products in the order.

**getLatestOrderedProductsInfo**

.. code-block:: php
   :linenos:

    /**
     * Returns information about who and when bought those products
     * [
     *      product id => [
     *          'customer_user_id' => customer user who bought,
     *          'created_at'       => order create \DateTime,
     *      ],
     *      ...
     * ]
     *
     * @param array $productIds
     * @param int   $websiteId
     *
     * @return array
     */
    public function getLatestOrderedProductsInfo(array $productIds, $websiteId)

Returns information about who and when bought the products.

**PreviouslyPurchasedOrderStatusesProvider**

Class |PreviouslyPurchasedOrderStatusesProvider|.

This service implements |OrderStatusesProviderInterface| and contains methods which return applicable statuses for the order. For example:

.. code-block:: php
   :linenos:

    /**
     * @param AbstractEnumValue|null $status
     * @return bool
     */
    protected function isAllowedStatus(AbstractEnumValue $status = null)
    {
        // statusProvider implements OrderStatusesProviderInterface
        $availableStatuses = $this->statusesProvider->getAvailableStatuses();
        $statusId = $status !== null ? $status->getId() : null;

        return in_array($statusId, $availableStatuses);
    }

**getAvailableStatuses**

.. code-block:: php
   :linenos:

   public function getAvailableStatuses()

This method returns an array of applicable statuses for an order. It is used in :ref:`ReindexProductOrderListener <previously-purchased-products-reindex-product-order-listener>`, :ref:`ReindexProductLineItemListener <previously-purchased-products-reindex-product-line-item-listener>` and :ref:`LatestOrderedProductsInfoProvider <previously-purchased-products-latest-ordered-products-info-provider>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin