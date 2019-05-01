.. _user-guide--marketing--promotions--conditions:

Add Conditions to Promotions
----------------------------

.. begin

Promotions can be triggered by coupons, a combination of coupons and conditions, and conditions only. 

To add one or more conditions to a specific promotion, you need to use a special expression language to evaluate customers by a particular attribute. 

:ref:`Expressions <user-guide--promotion--expression>` can be represented by any entity that is used at the checkout. It could be a customer or a customer user, and/or any of their attributes to which you can add a name, an email or a custom field. For example, the expression for a customer with ID equalling 1 is represented by the customer.id=1 expression.

As an example, we are going to illustrate how to trigger a promotion based on the combination of a system field from the *Order* :ref:`entity <admin-guide-entity-interface>`, with a custom field (in this case customer level) created and assigned to the *Customer* entity. In this example, the promotion is restricted to silver customers who will receive $100 off all their orders if they purchase more than 500 items within one order. Having these conditions means that we need to provide two expressions, one to filter customers by the customer level, and the other one to filter by the number of items in the shopping list for the order.

We also need to make sure we have a custom field Customer Level created beforehand and assign the Company A customer the Silver customer level.

.. image:: /img/marketing/promotions/customer_level.png
   :alt: Custom field created for the customer entity

When creating a new promotion, we specify the following general details and discount options:

* **Triggered By** --- Conditions Only
* **Discount** --- Order Total
* **Type** --- Fixed Amount
* **Discount Value** --- $100

The expressions for these conditions are the following:

.. code:: bash
   
   customer.customer_lvl.name = "Silver"
   and
   lineItems.sum(lineItem.quantity) > 500

* **Items to Discount** --- All Products

.. image:: /img/marketing/promotions/promotion_with_conditions.png
   :alt: A promotion with two expressions 

In the storefront, the customer user of the company (customer) with the Silver customer level set to Silver will see the discount at the checkout.

.. image:: /img/marketing/promotions/discount_applied_customer_level.png
   :alt: The discount applied at checkout for customers with the required customer level

Similarly, you can add any conditions of your choice. For expression language guidelines, check out the :ref:`Expression Language for Promotions <user-guide--promotion--expression>` topic.

**Related Topics**

* :ref:`Create a Promotion <user-guide--marketing--promotions--create>`
* :ref:`Expression Syntax for Promotions <user-guide--promotion--expression>`
* :ref:`Manage Discounts in Order <user-guide--sales--orders--promotions>`
* :ref:`Create and Manage Coupons <user-guide--marketing--promotions--coupons>`