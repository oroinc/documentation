.. _user-guide--pricing:

:oro_documentation_types: OroCommerce

Price Management
================

:ref:`Price list <user-guide--pricing--pricelist--management>` management is one of the most important aspects of any e-commerce business and even more so for Business to Business (B2B) e-commerce companies. This is why OroCommerce provides advanced features that enable you to easily set up and customize different price lists for specific customers, customer groups, and websites. You can build aggregated price lists with any amount of price points, :term:`price tiers <Tier Price>`, or currencies.

Overall, price management enables you to:

* Set up flexible product prices for different websites, customer groups, and customers.
* Assign prices for newly added products automatically.
* Schedule temporary or permanent price changes.
* Override the automatically assigned price with the manually adjusted value.

As an illustration of the product pricing dependency on a particular price list, let's take an example of the *Lumen Headlamp* product with the original price of $100. This amount is reflected in your *Default Price List*, which is straight and general for wholesalers, retailers, guests, and other visitors of your web store.

Once you sign a contract with Customer A under the terms of providing them a 20% discount on products from certain categories for the duration of the contract, you can then create a price list that recalculates prices for selected product categories based on the agreed discount and display the relevant prices in the storefront for all the users registered under the Customer A until the contract expires.

You can also have a separate price list for the Wholesalers customer group that displays the prices with a 10% discount. All wholesale customers (e.g., Company B, C, D) who belong to this group can purchase the *Lumen Headlamp* product for $90. By introducing loyalty programs and giving extra discounts to your Platinum, Gold, or Silver wholesale customers, they can purchase the same item for $75, $80, and $85 respectively.

You can also have one or multiple price lists with prices entered in US dollars and Euros defining the pricing for all your customers, a different price list with prices in US dollars available only to your large-volume US-based distributors, and another price list with prices in Euros available only to some selected European partners of your company.

.. _price-selection-strategy-differences:

Price Selection Strategy
------------------------

When one of your customers logs into the storefront, they may see prices for both product A and product B where the price for product A is taken from the default price list available to everybody, and the price for product B is from a custom price list created to override the default product B pricing for a specific customer. So while you can see all price lists and switch between them in the back-office, your customers in the storefront can see the prices you want them to see, depending on the price list you configured for them.

Pricing strategy is the approach you take when considering which prices from the existing ones to use for your customers. Different prices depend on different situations. You can select whether your customers will see the lowest prices, or prices from a higher priority price list, as described in the :ref:`global price selection strategy <sys--config--commerce--catalog--pricing>` topic. A website, customer group, and customer can have their own set of price lists that overrides the default configuration.

.. note:: The minimal price selection strategy is enabled by default since OroCommerce version 2.2. The priority-based price merging was the default configuration in the earlier OroCommerce versions.

.. image:: /user/img/concept-guides/prices/price_selection_strategy.png
   :alt: Set a pricing selection strategy in the system configuration

The best way to illustrate the strategy differences is to compare prices for one product, e.g., *220 Lumen Rechargeable Headlamp*, in different price lists.

Let's consider the following scenario:

.. csv-table::
   :header: "","**Stock Clearance PL**","**Customer A PL**","**Partner B PL**","**Wholesale PL**","**Spring Sale 2020 PL**"

   "**Product Discount**","20%","15%","5%","10%","10% for purchasing less than 49 items, 13% for more than 50 items"
   "**Product Price with Discount**","$80 / 1 item","$85 / 1 item","$95 / 1 item","$90 / 1 item","$90 / 1 item"

Customer A is assigned three price lists from the five available -- *Stock Clearance PL*, *Customer A PL*, and *Spring Sale 2020 PL*.

.. image:: /user/img/concept-guides/prices/price_lists_for_customerA.png
   :alt: View the three price lists assigned to Customer A

Minimal Prices (default)
^^^^^^^^^^^^^^^^^^^^^^^^

When you select the Minimal Prices strategy, all your price lists are combined together, displaying the lowest prices per quantity tier that are found among the available (enabled) price lists.

In our example, the minimal price per item for Customer A is $80 from the *Stock Clearance PL*.

.. csv-table::
   :header: "","**Stock Clearance PL**","**Customer A PL**","**Partner B PL**","**Wholesale PL**","**Spring Sale 2020 PL**"

   "**Product Discount**","20%","15%","5%","10%","10% for purchasing less than 49 items, 13% for more than 50 items"
   "**Product Price with Discount**","**$80 / 1 item**","$85 / 1 item","$95 / 1 item","$90 / 1 item","$90 / 1 item"


When diving deeper into the price tiers of the three assigned price lists, we can see how OroCommerce determines the price to present to Customer A in the storefront:

.. csv-table::
   :header: "**Quantity Tier**","**Stock Clearance PL**","**Customer A PL**","**Spring Sale PL**","**Minimal Price**"

   "1+ items","$80","$85","$90","**$80**"
   "10+ items","$77.60","$82.45","$87.30","**$77.60**"
   "20+ items","--","$77.05","$83.70","**$77.05**"
   "50+ items","--","$74.80","$76.56","**$74.80**"
   "100+ items","--","--","$73.95","**$73.95**"

.. image:: /user/img/concept-guides/prices/lamp_minimal_prices.png
   :alt: View all prices per tier for the lumen headlamp configured based on the selected minimal prices strategy
   :scale: 100%

Merge by Priority
^^^^^^^^^^^^^^^^^

When you select the Merge by Priority strategy, you determine the order in which the product prices should be combined when there are prices for the same price tier in the multiple price lists available to a customer.

Based on the price lists priority that you have set for Customer A, the lumen headlamp price would be different:

.. csv-table::
   :header: "**Quantity Tier**","**Stock Clearance PL**","**Customer A PL**","**Spring Sale PL**"

   "1+ items","$80","$85","$90"
   "10+ items","$77.60","$82.45","$87.30"
   "20+ items","--","$77.05","$83.70"
   "50+ items","--","$74.80","$76.56"
   "100+ items","--","--","$73.95"


1. Prioritizing the *Stock Clearance PL*, you enable only the two price tiers available in this price list. As other quantity tiers are not defined in the price list, they are not displayed in the storefront.

   .. image:: /user/img/concept-guides/prices/merge_by_priority_example1.png
      :alt: View all prices per tier for the lumen headlamp provided that the Stock Clearance PL is prioritized
      :scale: 80%

2. Change the priority dragging the *Customer A PL* up to display the prices with 15% discounts as defined by the contract with Customer A.

   .. image:: /user/img/concept-guides/prices/merge_by_priority_example2.png
      :alt: View all prices per tier for the lumen headlamp provided that the Customer A PL is prioritized
      :scale: 80%

**Merge Allowed**

**Merge Allowed** is a price list configuration setting that defines whether the system should combine price tiers of the same product from multiple price lists.

If we enable the Merge Allowed option for all price lists available for the Customer A, we combine them all together, allowing the system to fill the empty price tiers for the lumen headlamp from other price lists in the priority order. The price will then be displayed as follows, where the first four price tiers for *1 through 99* items are taken from the *Customer A PL* which has the highest priority. As the *Customer A PL* does not define the price for 100+ items, the system then searches for the relevant price in the second priority price list, the *Stock Clearance PL*. It does not specify the required price either. Only the third priority price list, the *Spring Sale 2020 Pl*, has the required price for 100+ items which is taken by the system to display in the storefront.

.. image:: /user/img/concept-guides/prices/merge_by_priority_example3.png
   :alt: View all prices per tier for the lumen headlamp provided that Merge Allowed is enabled for all three price lists
   :scale: 80%

Price Lists
-----------

OroCommerce provides unlimited flexibility to create price lists and cover any of your pricing scenarios with conditions and rules of your choice.

Once the price list is created, and the price selection strategy is selected, you can then assign the price list to:

* A :ref:`customer <customers--customers--edit--price-lists>`
* A :ref:`customer group <customers--customer-groups--edit--price-lists>`
* A :ref:`website <sys--website--edit--price-lists>`
* :ref:`System-wide <pricing-configuration>`

.. note:: The website level configuration has higher priority and overrides the global configuration settings. Customer group configuration overrides configuration on the website level. Custom configuration on the customer level has the highest priority.

You can activate and deactivate price lists manually or automatically, allowing to :ref:`display prices at scheduled times <user-guide--pricing--schedule-price-adjustments>`. You can add as many dates and times as necessary. This option is great for running a special sale or promotion campaign that occurs at a specified time. If no schedule is set, the price list is immediately visible to buyers. You can define multiple time slots as well.

.. image:: /user/img/concept-guides/prices/schedule_price_list.png
   :alt: Schedule a price list by setting the date when to activate and deactivate it

As prices tend to be negotiated and are affected by market dynamics, it is important to keep up with the demand and be reactive to the constant price changing. OroCommerce enables you to decide on whether to use a static or dynamic pricing system for your web store depending on your business processes and needs.

Price lists can be imported, created manually, or generated automatically based on product assignment and price calculation rules. These features enable you to adjust prices in real-time quickly and more effectively, recalculate the prices in another currency, autocomplete the prices for a group of products in a certain category, or set the prices that depend on a custom product property (e.g., size, color, brand).

Product Assignment
^^^^^^^^^^^^^^^^^^

The OroCommerce product assignment option defines the products or a group of products to be included in the price list. With the required criteria mentioned in the **Rule** field, you can filter the products segment that will or will not be used in the price list. You can either type the expression manually or use the drop-down autocomplete function.

The *Customer A Price List* was generated based on the *Default PL* (1) using the following syntax:

.. image:: /user/img/concept-guides/prices/product_assignment.png
   :alt: A sample of the syntax used to generate the Customer A Price List based on the Default PL

You can build even more advanced expressions on top of the product properties, use operators, numeric, boolean, and string values as described in the :ref:`Filtering Expression Syntax <user-guide--pricing--auto--expression>` topic.


Price Calculation Rules
^^^^^^^^^^^^^^^^^^^^^^^

Price calculation rules specify conditions and expressions to calculate new prices that will be applied to the selected list of products.

As for the *Customer A Price List*, we have used the base prices for products from the *Default PL* to offer a 15% discount on these products:

.. image:: /user/img/concept-guides/prices/price_calculation_rules.png
   :alt: The rule that is applied to the Customer A PL to calculate all prices with 15% discount

In the same way, you can create exclusive sales, season sales on a certain group of products, provide discounted prices for the products that have reached the low inventory threshold or for the products that are new. For more use cases, follow the :ref:`Price Rules Automation Examples <price-rules--auto--examples>` section.


.. _price-lists-fallback-config:

Price Lists Fallback
^^^^^^^^^^^^^^^^^^^^

With the fallback option, you enable (or disable) the selected price list's access to the price lists of the higher priority.

In a default configuration, all customers users have access to all price lists assigned to their customers and the price lists assigned to the customer group that their customer belongs to, as well as to the price lists assigned to the website they are currently browsing and the default price lists configured at the system level.

The fallback configuration logic for the registered users is: **Current Customer PLs > Current Customer Group PLs > Current Website PLs > Global PLs**. It means that if no matching price is found in the price list created for the selected customer, the application goes further to the price lists configured for the customer group, then to the website pricing, and the default pricing at the system level to fill in the missing product price.

.. image:: /user/img/concept-guides/prices/price_list_fallback.png
   :alt: The fallback configuration logic for the registered users

Whenever you disable fallback configuration at one level, deeper levels in the fallback chain are no longer available. For example, disabling fallback settings at the customer group level restricts access to the website and global pricing for all customers that belong to this customer group.

.. image:: /user/img/concept-guides/prices/price_list_fallback_dimmed.png
   :alt: Illustration of the fallback logic when the fallback settings are disabled at the customer group level


Best Practices
--------------

* Use price list fallbacks instead of full copies of price lists
* Do not create separate price lists for one product - combine them together instead
* Do not create rules for fixed values - create fixed prices instead
* Do not create rules to substitute fallbacks - use actual fallbacks

**Related Articles**

* :ref:`Price Lists User Guide <user-guide--pricing--pricelist--management>` --- aggregates practical information on how to work with price lists and adapt them to your business needs:

   * :ref:`Schedule Price Adjustments <user-guide--pricing--schedule-price-adjustments>`
   * :ref:`Manage Product Price Manually <user-guide--pricing--price-list-manual>`
   * :ref:`Generate Product Price Automatically <user-guide--pricing--price-list-auto>`
   * :ref:`Review Examples of Price Rule Automation <price-rules--auto--examples>`
   * :ref:`Filtering Expression Syntax <user-guide--pricing--auto--expression>`, :ref:`Autocomplete <user-guide--pricing--price-list-auto--autocomplete>` and :ref:`Storage Type <user-guide--pricing--auto--expression--storage-type>`
* :ref:`Global Pricing Configuration <pricing-configuration>`
* :ref:`Price Lists Configuration per Website <sys--website--edit--price-lists>`
* :ref:`Price Lists Configuration per Customer Group <customers--customer-groups--edit--price-lists>`
* :ref:`Price Lists Configuration per Customer <customers--customer-groups--edit--price-lists>`
* :ref:`Currency Configuration <admin-configuration-currency>`

.. include:: /include/include-images.rst
   :start-after: begin