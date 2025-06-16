.. _user-guide--marketing--promotions--conditions:

Add Conditions to Promotions
----------------------------

.. begin

Promotions can be triggered by coupons, a combination of coupons and conditions, and conditions only. 

To add one or more conditions to a specific promotion, you need to use a special expression language to evaluate customers by a particular attribute. 

:ref:`Expressions <user-guide--promotion--expression>` can be represented by any entity that is used at the checkout. It could be a customer or a customer user, and/or any of their attributes to which you can add a name, an email or a custom field. For example, the expression for a customer with ID 1 is represented by the customer.id=1 expression.

For example, let's say we want to trigger a promotion for a specific customer whose customer users purchase more than 500 items of a particular product. If the customer users are eligible for the promotion, they will receive a discount of $200 on their order total. To implement this, we need to create two expressions: one to filter customers and the other to filter by the number of items in the shopping list.

When creating a new promotion, specify the following general details and discount options:

* **Triggered By** --- Conditions Only
* **Discount** --- Order Total
* **Type** --- Fixed Amount
* **Discount Value** --- $200
* **Items to Discount** --- All Products

The customer eligible for this promotion is customer `Company A` with ID 1.

The expressions for these conditions are the following:

.. code-block:: none
   
   customer.id=1
   and
   lineItems.all(lineItem.quantity > 500)

.. image:: /user/img/marketing/promotions/promotion_with_conditions.png
   :alt: A promotion with two expressions 

Once the promotion is saved, the customer user of Company A, Amanda Cole, should be able to receive the discount when placing her order at the checkout when purchasing more than 500 items of eligible products.

.. image:: /user/img/marketing/promotions/expression-applied.png
   :alt: The discount applied at checkout for customers with the required customer level

You can add any conditions of your choice in a similar way. For expression language guidelines, check out the :ref:`Expression Language for Promotions <user-guide--promotion--expression>` topic.

**Related Topics**

* :ref:`Create a Promotion <user-guide--marketing--promotions--create>`
* :ref:`Expression Syntax for Promotions <user-guide--promotion--expression>`
* :ref:`Manage Discounts in Order <user-guide--sales--orders--promotions>`
* :ref:`Create and Manage Coupons <user-guide--marketing--promotions--coupons>`