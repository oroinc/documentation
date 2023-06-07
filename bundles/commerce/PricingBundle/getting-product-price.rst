.. _bundle-docs-commerce-pricing-bundle-getting-product-price:

Getting a Product Price
=======================

A product price is represented by the classes implementing the following interfaces:

- ``\Oro\Bundle\PricingBundle\Model\ProductPriceInterface``
- ``\Oro\Bundle\PricingBundle\ProductKit\ProductPrice\ProductKitPriceInterface`` and ``\Oro\Bundle\PricingBundle\ProductKit\ProductPrice\ProductKitItemPriceInterface``.

To get a correct price for a product, make sure you take into account the following parameters:

- **Product**
- **Website**
- **Customer**
- **Currency**
- **Product Unit** (optional)
- **Quantity** (optional)

These parameters are organized by four DTO models to make working with them easier:

- ``\Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteria`` - **price scope criteria model** encapsulating website, customer, and additional context (for example, Order, Shopping List, etc.).
- ``\Oro\Bundle\PricingBundle\Model\ProductPriceCriteria`` - **product price criteria model** for simple products encapsulating product, product unit, quantity, and currency.
- ``\Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\ProductKitPriceCriteria`` - **product kit price criteria model** for product kits that extends ``ProductPriceCriteria`` by adding the ability to encapsulate price criteria for the products of underlying product kit items.
- ``\Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\ProductKitItemPriceCriteria`` - **product kit item price criteria model** for product kit items that extends ``ProductPriceCriteria`` by adding the ability to specify the related product kit item.

The lowest level of getting a product price is directly through :ref:`price storage <bundle-docs-commerce-pricing-bundle-price-storage>`. However, it is not recommended until you know what exactly you want to achieve by working directly with it. Instead, it would be sufficient to use `ProductPriceProvider` in most cases.

Product Price Provider
----------------------

The main entry point for getting a price for a product is ``\Oro\Bundle\PricingBundle\Provider\ProductPriceProvider`` (service ``oro_pricing.provider.product_price``) that returns product prices taking into account the **price scope criteria** (website, customer). `ProductPriceProvider` consists of the following methods:

- **getPricesByScopeCriteriaAndProducts** - to get all product prices for the specified products, product units, and currencies, considering **price scope criteria**. In other words, it can return the prices for multiple product units, currencies, and quantity tiers.
- **getMatchedPrices** - to get prices for the specified **product price criteria** taking into account **price scope criteria**. In other words, it returns the prices matching the desired quantity, product unit, and currency.
- **getMatchedProductPrices** - to get product prices for the specified **product price criteria** taking into account **price scope criteria**. In other words, it returns the prices matching the desired quantity, product unit, and currency. The only difference to the previous method is that it returns a collection of `ProductPriceInterface` objects instead of ``\Oro\Bundle\CurrencyBundle\Entity\Price``.

To get product prices, pass to `ProductPriceProvider` the preliminarily prepared **price scope criteria** and **product price criteria** (for the prices matching desired product unit, quantity, and currency).

.. note::
  ``ProductPriceProvider`` implements ``\Oro\Bundle\PricingBundle\Provider\ProductPriceProviderInterface`` and ``\Oro\Bundle\PricingBundle\Provider\MatchedProductPriceProviderInterface`` interfaces that you can override or customize, if necessary.

Price Scope Criteria
--------------------

**Price scope criteria** is implemented by ``\Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteria``. It can be created in the following ways:

- using ``\Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaFactory`` (service ``oro_pricing.model.product_price_scope_criteria_factory``): via `create` method - manually or via `createByContext` - from the existing context object, i.e., from an object implementing ``\Oro\Bundle\WebsiteBundle\Entity\WebsiteAwareInterface`` or ``\Oro\Bundle\CustomerBundle\Entity\CustomerOwnerAwareInterface`` interfaces.
- using ``\Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaRequestHandler`` (service ``oro_pricing.model.product_price_scope_criteria_request_handler``): via `getPriceScopeCriteria` - from the current context scope, i.e., from current website and customer.

.. note::
  ``ProductPriceScopeCriteriaFactory`` implements ``\Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaFactoryInterface`` interface that you can override or customize, if necessary.

Product Price Criteria
----------------------

The main entry point for creating a **product price criteria** is ``\Oro\Bundle\PricingBundle\Model\ProductPriceCriteriaFactory``. It provides multiple methods:

- **create** - to create manually a **product price criteria**.
- **buildFromProduct** - to start building a **product price criteria** via builder. You will get a builder suitable for the product you pass, i.e., ``\Oro\Bundle\PricingBundle\Model\ProductPriceCriteriaBuilder\ProductPriceCriteriaBuilderInterface`` for a simple or configurable product, and ``\Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\Builder\ProductKitPriceCriteriaBuilderInterface`` for a product kit.
- **createFromProductLineItem** - to create a **product price criteria** from a **product line item**, i.e. any instance of a ``\Oro\Bundle\ProductBundle\Model\ProductLineItemInterface``. Creates a ``\Oro\Bundle\PricingBundle\Model\ProductPriceCriteria`` for a regular **product line item** and ``\Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\ProductKitPriceCriteria`` for a **product kit line item** (i.e., that is a line item of a product kit that additionally implements ``\Oro\Bundle\ProductBundle\Model\ProductKitItemLineItemsAwareInterface``).
- **createListFromProductLineItems** - to create a list of **product price criteria** objects from a collection of **product line item** objects, i.e., instances of a ``\Oro\Bundle\ProductBundle\Model\ProductLineItemInterface``.

.. note::
		 ``ProductPriceCriteriaFactory`` implements ``\Oro\Bundle\PricingBundle\Model\ProductPriceCriteriaFactoryInterface`` interface that you can override or customize, if necessary.

Examples
--------

1. You have a product and want to get all product prices relevant to the currently logged-in customer user:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\PricingBundle\Model\ProductPriceInterface;
    use Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaRequestHandler;
    use Oro\Bundle\PricingBundle\Provider\ProductPriceProviderInterface;
    use Oro\Bundle\ProductBundle\Entity\Product;

    class MyCustomService
    {
        private ProductPriceProviderInterface $productPriceProvider;
        private ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler;

        public function __construct(
            ProductPriceProviderInterface $productPriceProvider,
            ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler
        ) {
            $this->productPriceProvider = $productPriceProvider;
            $this->priceScopeCriteriaRequestHandler = $priceScopeCriteriaRequestHandler;
        }

        public function myCustomMethod(Product $product)
        {
            // ...

            $priceScopeCriteria = $this->priceScopeCriteriaRequestHandler->getPriceScopeCriteria();
            $currencies = $this->productPriceProvider->getSupportedCurrencies($priceScopeCriteria);

            /** @var array<int,array<ProductPriceInterface>> $productPrices */
            $productPrices = $this->productPriceProvider->getPricesByScopeCriteriaAndProducts(
                $priceScopeCriteria,
                [$product],
                $currencies
            );

            // ...
        }
    }

2. You have a product and want to get a price relevant to the currently logged-in customer user that matches the desired quantity and product unit:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\CurrencyBundle\Entity\Price;
    use Oro\Bundle\PricingBundle\Model\ProductPriceCriteriaFactoryInterface;
    use Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaRequestHandler;
    use Oro\Bundle\PricingBundle\Provider\ProductPriceProviderInterface;
    use Oro\Bundle\ProductBundle\Entity\Product;

    class MyCustomService
    {
        private ProductPriceProviderInterface $productPriceProvider;
        private ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler;
        private ProductPriceCriteriaFactoryInterface $productPriceCriteriaFactory;

        public function __construct(
            ProductPriceProviderInterface $productPriceProvider,
            ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler,
            ProductPriceCriteriaFactoryInterface $productPriceCriteriaFactory
        ) {
            $this->productPriceProvider = $productPriceProvider;
            $this->priceScopeCriteriaRequestHandler = $priceScopeCriteriaRequestHandler;
            $this->productPriceCriteriaFactory = $productPriceCriteriaFactory;
        }

        public function myCustomMethod(Product $product, float $quantity)
        {
            // ...

            $priceScopeCriteria = $this->priceScopeCriteriaRequestHandler->getPriceScopeCriteria();
            $productPriceCriteria = $this->productPriceCriteriaFactory->create(
                $product,
                $product->getPrimaryUnitPrecision()->getProductUnit(),
                $quantity
            );
            /** @var array<string,Price> $matchedPrices */
            $matchedPrices = $this->productPriceProvider->getMatchedPrices(
                [$productPriceCriteria],
                $priceScopeCriteria
            );
            $matchedPrice = $matchedPrices[$productPriceCriteria->getIdentifier()];

            // ...
        }
    }

3. You have a product kit and want to get a product kit price relevant to the currently logged-in customer user and that matches the desired quantity, product unit and the first product our of each product kit item (with the minimum allowed quantity):

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Pricing;

    use Oro\Bundle\PricingBundle\Model\ProductPriceCriteriaFactoryInterface;
    use Oro\Bundle\PricingBundle\Model\ProductPriceInterface;
    use Oro\Bundle\PricingBundle\Model\ProductPriceScopeCriteriaRequestHandler;
    use Oro\Bundle\PricingBundle\ProductKit\ProductPrice\ProductKitPriceInterface;
    use Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\Builder\ProductKitPriceCriteriaBuilderInterface;
    use Oro\Bundle\PricingBundle\ProductKit\ProductPriceCriteria\ProductKitItemPriceCriteria;
    use Oro\Bundle\PricingBundle\Provider\MatchedProductPriceProviderInterface;
    use Oro\Bundle\ProductBundle\Entity\Product;

    class MyCustomService
    {
        private MatchedProductPriceProviderInterface $matchedProductPriceProvider;
        private ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler;
        private ProductPriceCriteriaFactoryInterface $productPriceCriteriaFactory;

        public function __construct(
            MatchedProductPriceProviderInterface $matchedProductPriceProvider,
            ProductPriceScopeCriteriaRequestHandler $priceScopeCriteriaRequestHandler,
            ProductPriceCriteriaFactoryInterface $productPriceCriteriaFactory
        ) {
            $this->matchedProductPriceProvider = $matchedProductPriceProvider;
            $this->priceScopeCriteriaRequestHandler = $priceScopeCriteriaRequestHandler;
            $this->productPriceCriteriaFactory = $productPriceCriteriaFactory;
        }

        public function myCustomMethod(Product $product, float $quantity)
        {
            // ...

            $productPriceCriteriaBuilder = $this->productPriceCriteriaFactory
                ->buildFromProduct($product)
                ->setProductUnit($product->getPrimaryUnitPrecision()->getProductUnit())
                ->setQuantity($quantity);

            if (!$productPriceCriteriaBuilder instanceof ProductKitPriceCriteriaBuilderInterface) {
                throw new \LogicException('Product is not a kit');
            }

            foreach ($product->getKitItems() as $kitItem) {
                $productPriceCriteriaBuilder->addKitItemProduct($kitItem, $kitItem->getProducts()->first());
            }

            /** @var ProductKitItemPriceCriteria $productKitPriceCriteria */
            $productKitPriceCriteria = $productPriceCriteriaBuilder->create();

            $priceScopeCriteria = $this->priceScopeCriteriaRequestHandler->getPriceScopeCriteria();

            /** @var array<string,ProductPriceInterface> $matchedProductPrices */
            $matchedProductPrices = $this->matchedProductPriceProvider->getMatchedProductPrices(
                [$productKitPriceCriteria],
                $priceScopeCriteria
            );
            /** @var ProductKitPriceInterface $matchedProductKitPrice */
            $matchedProductKitPrice = $matchedProductPrices[$productKitPriceCriteria->getIdentifier()];

            // ...
        }
    }
