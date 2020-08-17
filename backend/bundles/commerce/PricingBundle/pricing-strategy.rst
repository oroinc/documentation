Pricing Strategy
================

To combine prices for Customers, there are  two predefined Pricing Strategies:

- Merge by priority
- Minimal prices

To create your own strategy, implement the `PriceCombiningStrategyInterface` interface and register the service with the '`oro_pricing.price_strategy`' tag.

Example:

.. code-block:: none
   :linenos:

    oro_pricing.pricing_strategy.merge_price_combining_strategy:
        class: Acme\Bundle\AcmeBundle\PricingStrategy\YourPricingStrategy
        parent: acme.pricing_strategy.your_pricing_strategy
        tags:
            - { name: acme.price_strategy, alias: your_strategy }
            
After this, your strategy will be available in the **System\Configuration\Commerce\Catalog\Pricing\Pricing Strategy** in the OroCommerce back-office.

Merge By Priority
-----------------

Merge By Priority Strategy picks the first price from the given sequence of the Price Lists for an empty slot.

The `Merge Allowed` flag shows whether a particular Price List is allowed to be merged with the other prices. When Merge Allowed is disabled for a price list, its price will be exclusively used for the product that has no price provided in other price lists with higher priority.

Example1:

+---------+--------------------+-------------+--------------+
| Product | Price List         | Price       | Merge Allowed|
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 9$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item | true         |
+---------+--------------------+-------------+--------------+

Result:

+---------+-------------+
| Product |  Price      | 
+---------+-------------+
| SKU1    | 9$ / 1 item |
+---------+-------------+
| SKU1    | 8$ / 2 item |
+---------+-------------+
| SKU1    | 7$ / 4 item |
+---------+-------------+
| SKU1    | 6$ / 5 item |
+---------+-------------+

Example 2:

+---------+--------------------+-------------+--------------+
| Product | Price List         | Price       | Merge Allowed|
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 9$ / 1 item | false        |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item | false        |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item | false        |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item | true         |
+---------+--------------------+-------------+--------------+

Result:

+---------+-------------+
| Product |  Price      | 
+---------+-------------+
| SKU1    | 9$ / 1 item |
+---------+-------------+
| SKU1    | 8$ / 2 item |
+---------+-------------+
| SKU1    | 6$ / 5 item |
+---------+-------------+

Example 3:

+---------+--------------------+---------------+--------------+
| Product | Price List         | Price         | Merge Allowed|
+---------+--------------------+---------------+--------------+
| SKU1    | Default PriceList  | 9$ / 1 item   | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item   | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item   | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item   | false        |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item   | false        |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item   | false        |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom2 PriceList  | 5$ / 10 item  | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom2 PriceList  | 4$ / 100 item | true         |
+---------+--------------------+---------------+--------------+

Result:

+---------+---------------+
| Product |  Price        | 
+---------+---------------+
| SKU1    | 9$ / 1 item   |
+---------+---------------+
| SKU1    | 8$ / 2 item   |
+---------+---------------+
| SKU1    | 6$ / 5 item   |
+---------+---------------+
| SKU1    | 5$ / 10 item  |
+---------+---------------+
| SKU1    | 4$ / 100 item |
+---------+---------------+

Minimal Prices
--------------

Minimal Prices Strategy picks the minimum price from the given sequence of Price Lists.

+---------+--------------------+-------------+
| Product | Price List         | Price       |
+---------+--------------------+-------------+
| SKU1    | Default PriceList  | 9$ / 1 item |
+---------+--------------------+-------------+
| SKU1    | Default PriceList  | 8$ / 2 item |
+---------+--------------------+-------------+
| SKU1    | Default PriceList  | 6$ / 4 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 8$ / 1 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 7$ / 2 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 7$ / 4 item |
+---------+--------------------+-------------+

Result:

+---------+-------------+
| Product |  Price      | 
+---------+-------------+
| SKU1    | 8$ / 1 item |
+---------+-------------+
| SKU1    | 7$ / 2 item |
+---------+-------------+
| SKU1    | 6$ / 4 item |
+---------+-------------+
