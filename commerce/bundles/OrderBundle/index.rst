.. _bundle-docs-commerce-order-bundle:

OroOrderBundle
==============

OroOrderBundle adds the Order entity to the OroCommerce application and enables OroCommerce users in the management console and customer users in the storefront to create and manage orders.

**Table of Contents**

* `Previously Purchased Products <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md>`__

  The Previously Purchased Products functionality adds the previously purchased products grid to the customer pages under Account > Previously Purchased on the frontend. By default, previously purchased products are disabled. To enable this functionality, navigate to System > Configuration > Orders > Purchase History > Enabled Purchase History in the admin panel.

  * `Configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#config>`__
  * `Website Search Index <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#website-search-index>`__

    * `onWebsiteSearchIndex <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#onwebsitesearchindex>`__
    * `Index field <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#index-field>`__

  * `Reindex Listeners <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#reindex-listeners>`__

    * `ReindexProductLineItemListener <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#reindexproductlineitemlistener>`_
    * `ReindexProductOrderListener <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#reindexproductorderlistener>`__
    * `PreviouslyPurchasedFeatureToggleListener <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#previouslypurchasedfeaturetogglelistener>`__

  * `Managers <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#managers>`__

    * `ProductReindexManager <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#productreindexmanager>`__

  * `Providers <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#providers>`__

    * `PreviouslyPurchasedConfigProvider <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#previouslypurchasedconfigprovider>`__
    * `LatestOrderedProductsInfoProvider <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#latestorderedproductsinfoprovider>`__
    * `PreviouslyPurchasedOrderStatusesProvider <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#previouslypurchasedorderstatusesprovider>`__
    * `PreviouslyPurchasedOrderStatusesProvider <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/OrderBundle/Resources/doc/previously-purchased-products.md#previouslypurchasedorderstatusesprovider>`__

