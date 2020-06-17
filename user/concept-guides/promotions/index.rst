:oro_documentation_types: OroCommerce

.. _concept-guides--promotion-management:

Promotion Management Concept Guide
==================================

Loyalty programs, discounts, and other :ref:`promotions <user-guide--marketing--promotions>` are an intelligent marketing tool that helps companies generate more revenue, increase purchase frequency, elevate brand image, and drive customer satisfaction. OroCommerce offers a promotions engine that supports several promotion types and coupon campaigns that enable you to:

* Apply various discount options for orders or line items
* Trigger promotions by coupons, a combination of coupons and conditions, and custom conditions only
* Build a strategic schedule for promotions
* Set visibility restrictions to target specific customers
* Add and generate coupons
* Manage discounts in placed orders in the back-office

These promotional tools help encourage new leads, motivate returning customers, and effectively convert shoppers into buyers.

Discount Types
--------------

It is important to select the right discount metrics to reach your sales goals and benefit your business. Offering discounts can drive more sales volume to your business, attract new customers, and help them choose your services over competitors.

OroCommerce offers :ref:`four promotion options <user-guide--marketing--promotions--create>` to suit the needs of any business. B2B sellers can configure promotions by:

.. image:: /user/img/concept-guides/promotions/discount-types.png
   :alt: Discount type dropdown

* **Order**

  The discount is applied to the total amount. This type of discount can be used to encourage larger orders, instead of a series of small ones.

* **Line Item**

  The discount is applied to the line item total. This discount strategy may be used to decrease inventory levels, or retain customers.

* **Buy X Get Y**

  When buyers order product X, they receive a discount on item Y (of the same product). The discount can be calculated separately or on the total of both X and Y products. For Buy One Get One Free offer, set the discount for Y item to 100%. Buy X Get Y (of the same product) is a simple discount strategy that can prompt impulse buys, moving inventory, or increase the sale of less popular products.

* **Shipping**

  The discount is applied to the shipping method configured into the promotion. Free, or discounted shipping, can help increase sales and reduce cart abandonment rates. To make sure that shipping discounts pay off, you can try offering it when an order reaches a certain amount. You may need to create a separate shipping rule to apply only to higher order amounts.

These four discounts can be represented by a fixed amount or a certain percent.

.. hint:: With some developer assistance, implementers can add any custom business-specific promotion types, in addition to the four types that come out-of-the-box.

Conditions
----------

To customize promotions, you can add a variety of :ref:`conditions <user-guide--marketing--promotions--conditions>` to them. You may require developer assistance, as conditions use a :ref:`special expression language <user-guide--promotion--expression>`. Expressions can be represented by any entity that is used at the checkout. For instance, it can be a customer or a customer user, and/or any of their attributes to which you can add a name, an email, or a custom field.

In addition, you can apply restrictions to every promotion, controlling its visibility for customers, customer groups, or a specific website. It means that you can configure promotions only for guest users, prompting them to register and get a discount off their first order, or only for wholesalers to order larger quantities of products for a 10% off the order.
In OroCommerce Enterprise Edition, you can also restrict your promotion to one or multiple websites if your product collections differ for various countries or websites.

Conditions with restrictions allow you to evaluate customers and orders by particular attributes (e.g., the attribute being the dollar amount in the cart). So when you are further narrowing down the promotion to customers with specific requirements,  you can provide conditions in the expression language. For instance, you could write an expression which would offer Free Shipping to VIP customers when they spend over a specific dollar amount; or restrict a promotion to silver customers who will receive $100 off all their orders if they purchase more than 500 items within one order.

.. image:: /user/img/concept-guides/promotions/expression-example.png
   :alt: Example of an expression

Coupons
-------

Like promotions, :ref:`coupons <user-guide--marketing--promotions--coupons>` are an effective marketing tool. Because coupon codes are easy to track, you can measure the success of coupon-tagged promotions more precisely than couponless campaigns.

You can use coupons to:

* Spark interest when pre-launching new products or services.
* Promote newly launched products or services and offer free trials.
* Reward customer loyalty and improve retention.
* Increase order volume.
* Discount prices in exchange for referrals or product feedback.
* Incentivize buyers to convert abandoned carts.
* Use coupons to drive traffic and increase sales.

Coupons are always used in conjunction with promotions. It means that coupons cannot be created on their own, and they always need to be linked to a specific promotion. That said, you can create one or one thousand coupons separately and link them to a promotion later when the need arises.

Depending on the type of promotion you are going for, you can generate either a small or a large number of coupons in one go with the same value and conditions. Individual coupons help provide an exclusive discount to encourage a prospective customer to convert immediately or reward a loyal customer with an exclusive discount. Batch coupons support promotional campaigns where your goal is to increase your reach and sales volume.

In OroCommerce, you are also in control of the coupons' names and codes. You can customize them for any sale, holiday, or event, control the expiration date and time for the coupon, and even the number of times one coupon can be used. Once distributed to customers, :ref:`coupons are applied at the checkout <frontstore-guide--orders-checkout--promotions>` with the discount displayed in the order summary before the order is submitted, and afterward in :ref:`the order details <user-guide--sales--orders--promotions>` both in the storefront and back-office.

.. image:: /user/img/concept-guides/promotions/coupon-code-application.png
   :alt: Coupons applied to the order at checkout

Post Sale Discounts
-------------------

You can control any :ref:`discounts from the back-office <user-guide--sales--orders--promotions>` of the application after the order has been placed. Specifically, you can:

* View all promotions and coupons applied to the order.
* Add an unlimited number of coupons to the order as long as each coupon is linked to a different promotion.
* Manage coupons while editing the order (add, view, and deactivate coupon codes).
* Add special discounts to give customers the incentive to come back to your store.

.. image:: /user/img/concept-guides/promotions/post-order-promotions.png
   :alt: Discounts in order

Discounts via Price Lists and Promotions
----------------------------------------

You can use price lists in conjunction with promotions to build a sustainable marketing message. When weighing why use one over another, have a look at the differences between the two below:

.. csv-table::
   :header: "Pricing", "Promotions"
   :widths: 20, 20

   "Prices are visible all around the application", "Discounts are visible in Checkout and Order"
   "Use Pricing for the default/standard prices", "Use Discounts for unusual prices"
   "Use Pricing if a discount is applicable to all products", "Use Discounts for a small scope of products"

Here is an example of how you can go about combining two discount strategies:

* The basic price for a product is $100 (for example, in MSRP, or a different price attribute)
* The price displayed to the customer is the basic price +10% margin = $110 (via the price list)
* With the discount for wholesalers, the price is $104.5 (via the price list)
* With the Christmas sale for selected items, the price for this product is $99.99 (either via price list or promotions)
* With a coupon code for a 30% discount, the price is $77 (via promotions)
* Gift certificates for free products (via promotions)
* If a customer already has product A in the shopping list, product B in the same category has 50% off which drops the price further to $55 (via promotions)
* If a customer purchases products for the total amount higher than $X amount, the price drops by 10% to $104 (via promotions)

**Related Topics**

* :ref:`Configure Promotions <sys-config--commerce--sales--promotions>`
* :ref:`Create Promotions <user-guide--marketing--promotions--create>`
* :ref:`Add Conditions to Promotions <user-guide--marketing--promotions--conditions>`
* :ref:`Manage Discounts in Orders <user-guide--sales--orders--promotions>`
* :ref:`Calculate Order Total in Promotions (Example) <user-guide--marketing--promotions--price-calculation>`
* :ref:`Expression Language for Promotions <user-guide--promotion--expression>`
* :ref:`Review Promotions-related FAQs <user-guide--marketing--promotions--issues>`
* :ref:`Generate Coupons <user-guide--marketing--promotions--coupons>`
* :ref:`Manage Coupons in Orders <user-guide--marketing--promotions--coupons--manage>`
