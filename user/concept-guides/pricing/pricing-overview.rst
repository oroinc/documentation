.. _user-guide--pricing--overview:

:oro_documentation_types: commerce

Understanding Pricing in OroCommerce
------------------------------------

.. begin

Price management in OroCommerce enables you to:

* Set up flexible product prices for different websites, customer groups, and customers.
* Assign prices for newly added products automatically.
* Schedule temporary or permanent price changes.
* Override the automatically assigned price with the manually adjusted value.

Understanding Price Currencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A ``base currency`` is a currency that is used to display financial statistics (budgets, sales amounts, etc.) on the back-office.
A ``display currency`` is a currency that is used to display prices to customer users in the storefront.

.. The storefront uses the exact value entered by the price manager when a customer requires prices in a selected display currency and the prices in the same base currency are available in the calculated price list. If the price list does not have the price in the selected currency, then additional currency conversion rules are used.

To enable your customer users to switch between the base currency and additional display currencies when they view the prices on the storefront, set up currency conversion rules for each of the additional display currencies. See :ref:`Global Currency Configuration <sys--config--sysconfig--general-setup--currency>` for more information on the necessary steps.

Understanding Product Quantities and Tier Prices
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A ``product quantity`` is an amount of product that can be sold expressed in a certain unit of quantity.


A product quantity could be a whole number (integer) or a number with a fractional part (a floating-point number). Whether or not the quantity should be a whole or fractional number, and how many digits are allowed in the fractional part is defined by the settings of the selected unit of measurement. For example, by default, “kilogram” allows entering up to 3 numbers after the decimal point, and “each” requires a whole number entry.

A ``tier price`` is a price determined by the system for the specified product quantity.

For example, you set the following prices in the price list:

+------------+-----------+---------+
| Product    | Quantity  | Price   |
+============+===========+=========+
| Product A  | 1 piece   | $100.00 |
+------------+-----------+---------+
| Product A  | 10 pieces | $90.00  |
+------------+-----------+---------+

OroCommerce uses $90.00 as a price per piece when a customer user is buying 10 or more pieces and $100.00 as a price per piece when a customer user is buying 9 or fewer pieces.

Price tiers for a selected product can be derived from the same price list, or from the different price lists if they allow price merge.

Understanding Price Lists
^^^^^^^^^^^^^^^^^^^^^^^^^

Price lists are used in OroCommerce to match the product quantities with their prices in one or more currencies.

Price lists are used as a reference that helps calculate the price for the products that customer user sees on the storefront.

For example, you can have one or multiple price lists with prices in US dollars and Euros that apply to all your customers.

At the same time, a different price list with prices in US dollars only may have higher priority for your large-volume US-based distributors.

Finally, a dedicated price list with prices in Euros may be available only to some of your selected European partners.

.. A calculated price list (also called combined price list) is an internal representation of all prices available to all customer users of the selected customer on the storefront.

For example, let's imagine that one of your customer users logs into your storefront. They may see prices for both product A and product B. The product A prices come from the default price list available to everybody. The product B prices are from a custom price list that you have created to override default product B pricing only for this specific customer. Even though you can see all price lists and switch between them in your store back-office, your customer users can see only those prices on the storefront that you have made available to them by configuring price lists and their settings.

Price Selection Strategy
^^^^^^^^^^^^^^^^^^^^^^^^

Whether your customer user gets the most attractive price or the one you have marked with the higher priority depends on the :ref:`global price selection strategy <sys--config--commerce--catalog--pricing>`.

.. note:: By default, the minimal price is configured in OroCommerce 2.2.x and priority-based price is used in the earlier versions of OroCommerce.

Combining Price Lists
^^^^^^^^^^^^^^^^^^^^^

``Price list priority`` determines the order in which the product prices should be combined when there are prices for the same price tier in the multiple price lists available to a customer.

**For example:**

You specified $90.00 as a unit price for 10 or more sets of Product A in the Price List 1, and $85.00 as a unit price for 10 or more sets of the same Product A in the Price List 2, and both price lists are available to a customer.

If Price List 1 has a higher priority than Price List 2, the customer will see $90.00 as a unit price when buying 10 or more sets of Product A.

Otherwise, the customer will see $85.00 as a unit price for 10 or more sets of Product A.

``Merge Allowed`` is a price list configuration setting that defines whether the system should combine price tiers of the same product from multiple price lists. This setting is displayed as **Merge Allowed** option next to the price list names on the customer, customer group, website edit pages, or on the pricing settings page (**System Configuration > Catalog > Pricing**).

.. note:: Price tier merging is possible only when the priority-based pricing strategy is enabled. Please, see :ref:`global pricing configuration <sys--config--commerce--catalog--pricing>` for more information.

**For example:**

You specified the price for 1 item of Product A in Price List 1, and the price for 10 items of Product A in Price List 2.

If both price lists are available to a customer user, they will see two price tiers. The first price tier will be for *1 through 9* items, and the second price tier will be for *10 or more* items.

If you decided keep ``Merge Allowed`` off, the customer users to whom both price lists are available, will see only the price tier from the price list with higher priority (e.g. only *10 or more* items from Price List 2).


``Price list fallback`` is a configuration setting at the customer, customer group, or website level that enables (or disables) access to the higher level price lists.

**For example:**

In a default configuration, all customers users have access to all price lists assigned to their customers and the price lists assigned to the customer group that their customer belongs to, as well as to the price lists assigned to the website they are currently browsing and the default price lists configured at the system level.

If you disable the fallback configuration at the customer level and assign a selected price list to a customer, this price list becomes the only price list that the users of this customer will see the prices from. In this case, the customer group pricing, the website pricing, and the default pricing at the system level will no longer be available to the users of this customer.

If you disable fallback configuration at the customer group level, then all customers that belong to this customer group will no longer have access to the website pricing and the default pricing at the system level.

Auto-Generated Price Lists
^^^^^^^^^^^^^^^^^^^^^^^^^^

In OroCommerce, you can set up a price list that is flexible, adjustable and exactly matches your pricing strategy.

With the automated pricing that may rely on the key indicators, like product availability, recommended price, and production cost, you get the complete price list for thousands and millions of items ready in literally no time.

Products automatically get into the price list whenever they match the special criteria - a price list's product assignment rule. You can set up flexible pricing rules, for example, to meet the price regulations requirements, maintain an international location-aware price list, or to stimulate the demand and update the price following the stock availability trends.

Automated pricing rules are a single source of truth for your price list. You can easily trace what impacts the price change, share the vision of the pricing strategy, and make sure the price is correct and meets the needs of your pricing policies.

Price List Calculation
^^^^^^^^^^^^^^^^^^^^^^

To provide an optimized user experience on the storefront and in the store back-office, and maintain the desired level of system performance, we provide a way to fine-tune the price list calculation behavior.

OroCommerce performs a non-resource-consuming part of price recalculation immediately after the price change is submitted by the user in the back-office (e.g., when a user submits the product edit form, or adds a price via the price list management, or modifies price list priority on a customer edit page, etc.).

The resource-consuming part of recalculation (e.g., when the price auto-calculation formula depends on the attribute of the item that is not directly related to the product) is deferred to eliminate unnecessary recalculations every time the price is updated and launch them only when the price is going to be used soon. The schedule of this recalculation is defined using the :ref:`Offset Of Processing CPL Prices <offset-of-processing-cpl-prices>` value in hours.


**Related Articles**

* :ref:`Price List Management <user-guide--pricing--pricelist--management>`

* :ref:`Price Calculation in the Storefront <user-guide--pricing-calculation>`