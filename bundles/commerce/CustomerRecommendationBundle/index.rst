.. _bundles--commerce--customer-recommendation:


Customer Recommendation Bundle
==============================

The bundle adds two features to boost full-text search results using customer history - by customer actions and by total product revenue.

It helps provide customers with a better user experience, displaying them the most relevant products based on the history of all other customers.


Setup
-----

You can enable customer action boost and total product revenue boost in the System Configuration under the Commerce > Search > Customer Recommendations section. Once you enable the features, the application starts collecting customer actions by default. If you already have some customer history, you can manually create the required customer actions in advance. For that:

1. Write a data fixture.
2. Create the ``RecommendationAction`` entities inside it.
3. Execute this fixture.

Product revenue boost relies on the order history and automatically uses all the orders stored in the application, so no extra actions are required.


Customer Action Boost
---------------------

There are three actions taken into account for this type of boost:

* how many registered customer users viewed the product (VIEWS);
* how many registered customer users added the product to a shopping list (ADDS_TO_SL);
* how many registered customer users purchased the product (PURCHASES).

There are several system configuration options that provide a flexible way to customize and tune the customer action boost:

* **Enabled** checkbox activates the customer action boost functionality.
* **Product View Ratio** (VIEWS_RATIO) sets a ratio for the number of customer users who viewed the product.
* **Added To Shopping List Ratio** (ADDS_TO_SL_RATIO) sets a ratio for the number of customer users who added the product to a shopping list.
* **Product Purchase Ratio** (PURCHASES_RATIO) sets a ratio for the number of customer users who purchased the product.
* **Score Multiplier Formula** enables one of the formulas to calculate the score multiplier that boosts specific products.

The system supports the following formulas:

**Weighted Sum**

.. code-block:: none

    MULTIPLIER = VIEWS * VIEWS_RATIO + ADDS_TO_SL * ADDS_TO_SL_RATIO + PURCHASES * PURCHASES_RATIO + 1

**Square Root of Weighted Sum**

.. code-block:: none

    MULTIPLIER = SQRT(VIEWS * VIEWS_RATIO + ADDS_TO_SL * ADDS_TO_SL_RATIO + PURCHASES * PURCHASES_RATIO) + 1

**Natural Logarithm of Weighted Sum**

.. code-block:: none

    MULTIPLIER = LN(VIEWS * VIEWS_RATIO + ADDS_TO_SL * ADDS_TO_SL_RATIO + PURCHASES * PURCHASES_RATIO + 1) + 1

**Weighted Arithmetic Mean**

.. code-block:: none

    MULTIPLIER = (VIEWS * VIEWS_RATIO + ADDS_TO_SL * ADDS_TO_SL_RATIO + PURCHASES * PURCHASES_RATIO) / (VIEWS + ADDS_TO_SL + PURCHASES + 1) + 1


**Formula Specifics**

The first three formulas use *weighted sum*, which means the more actions appeared, the bigger the boost.

The difference is only in the progression of the multiplier - linear, square root, or logarithmic.

The recommended progression is logarithmic.

The fourth formula that uses *weighted arithmetic mean* has a slightly different effect. The bigger the purchases/views ratio, the bigger the boost.

Example
^^^^^^^

Suppose that there are two identical products, A and B. Both products were added to a shopping list and purchased only once, but product A was viewed by 1000 customer users, while product B was viewed only by 10 customer users.

The *weighted sum* formulas will place A in front of B because product A has more total actions than product B.

The *Weighted arithmetic mean* formula will place B in front of A because it has been purchased by a bigger percentage of customer users who viewed it. Product B has been bought by 10% of customer users who viewed it, while product A has been bought only by 0.1% of customer users who viewed it.


Product Revenue Boost
---------------------

Product revenue boost boosts products based on their total revenue (hereinafter REVENUE). In other words, the more revenue the product has generated, the bigger the boost is applied.

There are several configuration options available for this type of boost:

* **Enabled** checkbox activates the product revenue boost functionality.
* **Product Revenue Multiplier** (REVENUE_MULTIPLIER) sets a multiplier for the product's total revenue.
* **Score Multiplier Formula** enables one of the formulas to calculate the score multiplier that boosts specific products.

The system supports the following formulas:

**Revenue Ratio**

.. code-block:: none

    MULTIPLIER = REVENUE * REVENUE_MULTIPLIER + 1

**Square Root of Revenue Ratio**

.. code-block:: none

    MULTIPLIER = SQRT(REVENUE * REVENUE_MULTIPLIER) + 1

**Natural Logarithm of Revenue Ratio**

.. code-block:: none

    MULTIPLIER = LN(REVENUE * REVENUE_MULTIPLIER + 1) + 1


**Formula Specifics**

All three formulas work similarly. They calculate the boost multiplier based on the product's total revenue and the revenue multiplier.

The difference is only in the progression of the multiplier - linear, square root, or logarithmic.

The recommended progression is logarithmic.

Example
^^^^^^^

Suppose that there are two identical products, A and B. Product A costs $10 and has been sold 20 times. Product B costs $50, and it has been sold 15 times. The total revenue is $200 for product A and $750 for product B. So, the application will place product B in front of A because customers spent more money to buy it.


Best Practices
--------------

It would be better to consider your business use cases to select the most appropriate boost type.

Several checkpoints can help you decide which boost type to activate:

Think of:

1. Whether your customers want to buy the most viewed or the most purchased products.
2. Whether you want to promote products based on their profitability.
3. Which promotions your customers would most likely pay attention to, based on the global purchase history, the total revenue, or the product data only.

It is also recommended to check the actual boost multipliers for some products to understand the effect for each product. You may need to do it periodically to adjust options in the system configuration to provide the best user experience.

