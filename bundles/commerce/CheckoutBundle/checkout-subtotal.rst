Checkout Subtotal
=================

The data from the Subtotal column (sum of all checkout items) is stored in the database. It is required to assemble the open orders (checkouts) datagrid efficiently. The data gets updated after the following actions:

When there is a change in the price list of a product, it will automatically recalculate the subtotal for all checkouts with the affected products included.

The list of events:

* ``Oro\Bundle\PricingBundle\Event\CombinedPriceList\CombinedPriceListsUpdateEvent`` (``oro_pricing.combined_price_list.update``)
* ``Oro\Bundle\PricingBundle\Event\CustomerGroupCPLUpdateEvent`` (``oro_pricing.customer_group.combined_price_list.update``)
* ``Oro\Bundle\PricingBundle\Event\CustomerCPLUpdateEvent`` (``oro_pricing.customer.combined_price_list.update``)
* ``Oro\Bundle\PricingBundle\Event\WebsiteCPLUpdateEvent`` (``oro_pricing.website.combined_price_list.update``)
* ``Oro\Bundle\PricingBundle\Event\ConfigCPLUpdateEvent`` (``oro_pricing.config.combined_price_list.update``)

Subtotals are also recalculated within the HTTP request at each step of the checkout process.

The subtotals are recalculated when a request for datagrid information is received in the open orders section. However, this only occurs if the price list of the related product has been changed and the subtotal was not previously updated in the message queue.
