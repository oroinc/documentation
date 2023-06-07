Getting Price for a Product Line Item
=====================================

A **product line item** is a combination of a product, product unit, and quantity. All classes representing a **product line item** implement the ``\Oro\Bundle\ProductBundle\Model\ProductLineItemInterface`` interface. For example, each of these classes is a **product line item**:

- ``\Oro\Bundle\ShoppingListBundle\Entity\LineItem``
- ``\Oro\Bundle\CheckoutBundle\Entity\CheckoutLineItem``
- ``\Oro\Bundle\OrderBundle\Entity\OrderLineItem`` and many more.

Developers frequently need to :ref:`retrieve a product price <bundle-docs-commerce-pricing-bundle-getting-product-price>` for product line items. The OroPricingBundle contains a `ProductLineItemPriceProvider` to simplify getting and working with pricing data for a consumer product line item.

ProductLineItemPriceProvider
----------------------------

The main entry point for getting **product line item prices** is ``\Oro\Bundle\PricingBundle\Provider\ProductLineItemPriceProvider`` (service ``oro_pricing.provider.product_line_item_price``). It provides the following methods:

- **getProductLineItemsPrices** - to get **product line item prices** for the specified **product line items**, **price scope criteria** and **currency**. **Price scope criteria** and **currency**, if not specified, are detected automatically based on the current context.
- **getProductLineItemsPricesForLineItemsHolder** - to get **product line item prices** for the specified **product line items holder** (``\Oro\Bundle\ProductBundle\Model\ProductLineItemsHolderInterface``) and **currency**. **Price scope criteria** is detected automatically based on the specified **product line items holder**. **Currency**, if not specified, is detected automatically based on the current context.

.. note::
  ``ProductLineItemPriceProvider`` implements ``\Oro\Bundle\PricingBundle\Provider\ProductLineItemPriceProviderInterface`` interface so it can be easily overridden or customized if needed.

Provider returns a collection of **product line item price** objects:

- ``\Oro\Bundle\PricingBundle\Model\ProductLineItemPrice\ProductLineItemPrice`` - represents a price of a **regular product line item**.
- ``\Oro\Bundle\PricingBundle\ProductKit\ProductLineItemPrice\ProductKitLineItemPrice`` - represents a price of a **product kit line item** (i.e., that is a line item of a product kit - additionally implements ``\Oro\Bundle\ProductBundle\Model\ProductKitItemLineItemsAwareInterface``). Contains ``\Oro\Bundle\PricingBundle\ProductKit\ProductLineItemPrice\ProductKitItemLineItemPrice`` objects representing prices for its kit item line items.

Examples
--------

1. You have a shopping list and want to get prices for all of its line items:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\PricingBundle\Provider\ProductLineItemPriceProviderInterface;
    use Oro\Bundle\ShoppingListBundle\Entity\ShoppingList;

    class MyCustomService
    {
        private ProductLineItemPriceProviderInterface $productLineItemPriceProvider;

        public function __construct(ProductLineItemPriceProviderInterface $productLineItemPriceProvider)
        {
            $this->productLineItemPriceProvider = $productLineItemPriceProvider;
        }

        public function myCustomMethod(ShoppingList $shoppingList)
        {
            // ...

            $productLineItemsPrices = $this->productLineItemPriceProvider
                ->getProductLineItemsPricesForLineItemsHolder($shoppingList);

            foreach ($shoppingList->getLineItems() as $key => $lineItem) {
                $productLineItemPrice = $productLineItemsPrices[$key] ?? null;
                // ...
                $price = $productLineItemPrice->getPrice();
                $subtotal = $productLineItemPrice->getSubtotal();

                // ...
            }

            // ...
        }
    }

2. You have a shopping list and want to get prices for part of its line items:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaFactoryInterface;
    use Oro\Bundle\PricingBundle\Provider\ProductLineItemPriceProviderInterface;
    use Oro\Bundle\ShoppingListBundle\Entity\ShoppingList;

    class MyCustomService
    {
        private ProductLineItemPriceProviderInterface $productLineItemPriceProvider;
        private ProductPriceScopeCriteriaFactoryInterface $productPriceScopeCriteriaFactory;

        public function __construct(
            ProductLineItemPriceProviderInterface $productLineItemPriceProvider,
            ProductPriceScopeCriteriaFactoryInterface $productPriceScopeCriteriaFactory
        ) {
            $this->productLineItemPriceProvider = $productLineItemPriceProvider;
            $this->productPriceScopeCriteriaFactory = $productPriceScopeCriteriaFactory;
        }

        public function myCustomMethod(ShoppingList $shoppingList)
        {
            // ...

            $lineItem1 = $shoppingList->getLineItems()->first();
            $lineItem2 = $shoppingList->getLineItems()->last();

            $priceScopeCriteria = $this->productPriceScopeCriteriaFactory->createByContext($shoppingList);
            $productLineItemsPrices = $this->productLineItemPriceProvider
                ->getProductLineItemsPrices([$lineItem1, $lineItem2], $priceScopeCriteria);

            foreach ($productLineItemsPrices as $productLineItemPrice) {
                $price = $productLineItemPrice->getPrice();
                $subtotal = $productLineItemPrice->getSubtotal();
                // ...
            }
            // ...
        }
    }

3. You have a **product kit line item** in a shopping list and want to get a price for it and its kit item line items:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\PricingBundle\ProductKit\ProductLineItemPrice\ProductKitLineItemPrice;
    use Oro\Bundle\PricingBundle\Provider\ProductLineItemPriceProviderInterface;
    use Oro\Bundle\ShoppingListBundle\Entity\LineItem;

    class MyCustomService
    {
        private ProductLineItemPriceProviderInterface $productLineItemPriceProvider;

        public function __construct(ProductLineItemPriceProviderInterface $productLineItemPriceProvider)
        {
            $this->productLineItemPriceProvider = $productLineItemPriceProvider;
        }

        public function myCustomMethod(LineItem $kitLineItem)
        {
            // ...

            $productLineItemsPrices = $this->productLineItemPriceProvider->getProductLineItemsPrices([$kitLineItem]);

            foreach ($productLineItemsPrices as $productLineItemPrice) {
                if ($productLineItemPrice instanceof ProductKitLineItemPrice) {
                    $price = $productLineItemPrice->getPrice();
                    $subtotal = $productLineItemPrice->getSubtotal();
                    // ...
                    foreach ($productLineItemPrice->getKitItemLineItemPrices() as $kitItemLineItemPrice) {
                        $kitItemPrice = $kitItemLineItemPrice->getPrice();
                        $kitItemSubtotal = $kitItemLineItemPrice->getSubtotal();
                        // ...
                    }
                    // ...
                }
                // ...
            }
            // ...
        }
    }

