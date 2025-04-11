.. _user-guide--pricing--price-list-auto:

Generate a Product Price Automatically
======================================

OroCommerce enables you to automate the creation of price lists based on predefined pricing strategies, generate new price lists from a selected source price list, and filter which products to include using categories, tags, product types, etc. It is particularly useful for managing complex product hierarchies and applying consistent pricing logic across large catalogs.

Automate a Price List
---------------------

To automatically generate a price list in OroCommerce:

#. Navigate to **Sales > Price Lists** in the main menu.

#. Start editing the required price list or click **Create Price List** to create a new one.

.. image:: /user/img/sales/pricelist/all-price-lists.png
   :alt: A list of all price lists available in the system

The following simplified product catalog is used in examples:

+--------+---------------+----------------+----------+------------+-------+------+----------+
| Item # | Product       | Is in stock?   | Category | List Price | Price | Unit | Currency |
+========+===============+================+==========+============+=======+======+==========+
| A      | Laptop        | yes            | 1        | 2500       | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| B      | Pen           | yes            | 2        | 0.5        | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| C      | Office chair  | yes            | 3        | 300        | -     | item | EUR      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| D      | Office shelf  | yes            | 4        | 250        | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| E      | Server        | no             | 5        | 30000      | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+


Assign Products to the Price List
---------------------------------

In the **Product Assignment** section, you can configure which products will be included in the generated price list. You can either select specific products or the entire product categories. To complete this, in the **Rule** field, insert criteria into the text area to filter products in the catalog with the |Symfony2 expression language| and the operators from the left. The system validates the expression syntax to make sure it is error-free (as illustrated in the screenshot below). To view available properties used in filtering expressions, see the `Filtering Expression Syntax`_ topic below.

.. image:: /user/img/sales/pricelist/advanced-query-builder.png
   :alt: The advanced query builder in the Product Assignment section

**Example 1**

For example, to include all products in categories 1 and 5, use the following expression:

.. code-block:: rst

   product.category == 1 or product.category == 5

For the sample catalog, this will generate the following product list:

**Price list A**

+--------+---------+----------------+----------+------------+-------+------+----------+
| Item # | Product | Is in stock?   | Category | List price | Price | Unit | Currency |
+========+=========+================+==========+============+=======+======+==========+
| A      | Laptop  | yes            | 1        | 2500       | -     | item | USD      |
+--------+---------+----------------+----------+------------+-------+------+----------+
| E      | Server  | no             | 5        | 30000      | -     | item | USD      |
+--------+---------+----------------+----------+------------+-------+------+----------+

**Example 2**

The following example illustrates filtering products in stock with the list price (also known as manufacturer’s suggested retail price - MSRP) higher than 100 USD per item:

.. code-block:: rst

   product.msrp.value > 100 and product.msrp.currency == 'USD' and
   product.msrp.unit == 'item' and product.inventory_status == 'in_stock'

**Price list B**

+--------+---------------+----------------+----------+------------+-------+------+----------+
| Item # | Product       | Is in stock?   | Category | List Price | Price | Unit | Currency |
+========+===============+================+==========+============+=======+======+==========+
| A      | Laptop        | yes            | 1        | 2500       | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| D      | Office shelf  | yes            | 4        | 250        | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+

.. hint:: You can customize the automatically generated price list and add more products manually.

Configure Price Calculation Rules
---------------------------------

In the **Price Calculation Rule** section, you can define how product prices are calculated and what final prices will appear in the price list.

.. image:: /user/img/sales/pricelist/price-calculation-rules-section.png
   :alt: The Price Calculation Rules section

1. In the **Price for Quantity**, enter the quantity, select a product unit, and the currency to which the rule will be applied. The list of currencies displayed in the dropdown depends on the :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` enabled in the system configuration.

2. In the **Calculate As** field, insert a price formula into the text area with the |Symfony2 expression language| and the operators from the left. The system validates the expression syntax to make sure it is error-free. To view available properties used in filtering expressions, see the `Filtering Expression Syntax`_ topic below.

**Example 1**

To set the price for all products to 99 USD, use the following expression:

.. code-block:: rst

   99

The result will be the following:

**Price list A**

+--------+---------+----------------+----------+------------+--------+------+----------+
| Item # | Product | Is in stock?   | Category | List Price | Price  | Unit | Currency |
+========+=========+================+==========+============+========+======+==========+
| A      | Laptop  | yes            | 1        | 2500       | **99** | item | USD      |
+--------+---------+----------------+----------+------------+--------+------+----------+
| E      | Server  | no             | 5        | 30000      | **99** | item | USD      |
+--------+---------+----------------+----------+------------+--------+------+----------+

**Example 2**

To set the price (for one item in US dollars) to be 5 USD more than the target margin (custom property of the product category), use the following expression:

.. code-block:: rst

   product.msrp.value * product.category.margin + 5


The result will be the following:

**Price list B**

+--------+---------------+--------------+----------+------------+--------+----------+------+----------+
| Item # | Product       | Is in stock? | Category | List price | Margin | Price    | Unit | Currency |
+========+===============+==============+==========+============+========+==========+======+==========+
| A      | Laptop        | yes          | 1        | 2500       | 1.2    | **3005** | item | USD      |
+--------+---------------+--------------+----------+------------+--------+----------+------+----------+
| D      | Office shelf  | yes          | 4        | 250        | 1.5    | **380**  | item | USD      |
+--------+---------------+--------------+----------+------------+--------+----------+------+----------+

In this expression, the (price formula) may contain product and product-related items properties of the numeric type, numbers and arithmetic operations.

3. In the **Condition** field, insert a product filtering expression into the text area into the text area with the |Symfony2 expression language| and the operators from the left. The system validates the expression syntax to make sure it is error-free. To view available properties used in filtering expressions, see the `Filtering Expression Syntax`_ topic below.

**Example 1**

For example, you have decided to set the price of 99 USD only for the products from category 1. Then you have entered *99* in the **Calculate As** field (see Step 2: Example 1.) In the **Condition** field, enter the following expression:

.. code-block:: rst

   product.category == 1

The result will be the following:

**Price list A**

+--------+---------+----------------+----------+------------+--------+------+----------+
| Item # | Product | Is in stock?   | Category | List Price | Price  | Unit | Currency |
+========+=========+================+==========+============+========+======+==========+
| A      | Laptop  | yes            | 1        | 2500       | **99** | item | USD      |
+--------+---------+----------------+----------+------------+--------+------+----------+
| E      | Server  | no             | 5        | 30000      |   -    | item | USD      |
+--------+---------+----------------+----------+------------+--------+------+----------+

4. In the **Priority** field, specify the precedence for this rule. See `Filters, Priorities, and Matching Units in the Automatically Generated Price List`_ for more information.

5. If you need to set up prices for another range of products selected into the price list or for another currency/unit, click **+Add** and repeat steps 1-4.

   .. hint::

      * You can use :ref:`autocomplete <user-guide--pricing--price-list-auto--autocomplete>` to simplify the expression creation.
      * For available properties used in filtering expressions, see :ref:`Filtering Expression Syntax <user-guide--pricing--auto--expression>`.
      * For more help on expressions creation, see :ref:`Price Rules Automation Examples <price-rules--auto--examples>`.

Filters, Priorities, and Matching Units in the Automatically Generated Price List
---------------------------------------------------------------------------------

**Funnel effect:** Condition filter is applied only to the products assigned to the price list in step two in the process above, not the complete catalog.

**Default units and currency:** If the currency and unit are not specified as filtering criteria, OroCommerce applies *USD* as the default currency and *item* as a default unit. When currency and unit values are included in the filtering criteria, they override the default values.

**Automatic updates:** OroCommerce automatically updates price lists and recalculates prices whenever product-related data is updated. The trigger could be a new product, category structure changes, or the product that moved to another category.

**Matching units:** During price generation, OroCommerce precisely matches the rule units and product units to ensure calculations are correct. For example, when you sell stuffed toys and the supported units are items and bundles of 10 items, your price calculation rule configured only for kilograms will not apply, and the price will not be generated.

**Multiple price rules targeting the same product:** When several price calculation rules apply to the same product in the price list, OroCommerce uses the rule with the highest priority.

**Enforcing the price:** Prices provided manually have higher priority than those generated automatically. Once you manually set the price for the automatically assigned product, it will no longer change after price recalculation.

.. _price-rules--auto--examples:

Price Rules Automation Examples
-------------------------------

In this topic, you can find examples of expressions for the automatic generation of price lists. The examples cover general use cases. We assume that the USD prices are set for one item for all the examples.

* :ref:`Different discounts based on the current price <price-rules--auto--examples--1>`
* :ref:`Fixed price for similar SKUs <price-rules--auto--examples--2>`
* :ref:`15% more than MSRP for products created after May 1, 2022 <price-rules--auto--examples--3>`
* :ref:`MAP price for all featured products in a certain category <price-rules--auto--examples--4>`
* :ref:`Price for selected products <price-rules--auto--examples--5>`
* :ref:`Discounted price for all products except for the selected brand <price-rules--auto--examples--6>`
* :ref:`Price depends on the custom property <price-rules--auto--examples--7>`
* :ref:`Price Based on the Currency Rate <price-rules--auto--examples--8>`

.. _price-rules--auto--examples--1:

Example 1. Different Discounts Based on the Current Price
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have a group of 'golden' wholesale customers to whom you would like to offer a $1 discount for products that cost less than $10 and $2.5 discount for products that cost $10 and more.

You have Wholesale's standard price list, on which you want to base a new price list. The Wholesale pricelist ID is 2.

Then use the following expressions.

**1. Product Assignment**

.. code-block:: rst

    product.id in pricelist[2].assignedProducts

**2. Price Calculation Rule**

You need to enter two price calculation rules in this section.

The first one defines that the price must be set as $1 less than the current if the current price itself is less than $10:

**Calculate As**

.. code-block:: rst

   pricelist[2].prices.value - 1

**Condition**

.. code-block:: rst


   pricelist[2].prices.value < 10

Then click **+Add**, and the second rule that defines that the price must be set $2.5 less than the current if the current price itself is equal to or more than $10:

**Calculate As**

.. code-block:: rst

   pricelist[2].prices.value - 2.5

**Condition**

.. code-block:: rst

   pricelist[2].prices.value >= 10


.. _price-rules--auto--examples--2:

Example 2. Fixed Price for Similar SKUs
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You and your customer have agreed on a fixed price of $20 for all types of medical tags you supply.

You store medical tags with SKUs like TAG1, TAG2, TAG3, etc.

Create a new price list with the following settings.

**1. Product Assignment**

.. code-block:: rst

   product.sku matches 'TAG%'

**2. Price Calculation Rule**

**Calculate As**

.. code-block:: rst

   20

.. _price-rules--auto--examples--3:

Example 3. 15% More than MSRP for Products Created After May 1, 2022
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You need to make the price for the products added after May 1, 2022 a 15% more than their MSRP price.

Create a new price list with the following settings.

**1. Product Assignment**

.. code-block:: rst

   product.createdAt > '1/5/2022'

**2. Price Calculation Rule**

**Calculate As**

.. code-block:: rst

   product.msrp.value * 1.15

.. _price-rules--auto--examples--4:

Example 4. MAP Price for all Featured Products in Certain Category
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have decided to set the MAP (minimum advertised price) price attribute value for all 'featured' products price in the category 'Office Furniture' (category ID is 7),

**1. Product Assignment**

.. code-block:: rst

   product.featured == true and product.category.id == 7

**2. Price Calculation Rule**

**Calculate As**

.. code-block:: rst

   product.map.value

.. _price-rules--auto--examples--5:

Example 5. Price for Selected Products
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have decided to set the price $10 more than in the default price list (ID 1) for selected products, product IDs: 14, 10, 312, 62.

**1. Product Assignment**

.. code-block:: rst

   product.id in [14,10,312,62]

.. hint::

   You can also use product SKUs instead of IDs. But note that then you need to enter them as strings:

   ``product.sku in ['1GS46','2TK59','8DO33','6VC22']``

**2. Price Calculation Rule**

**Calculate As**

.. code-block:: rst

   pricelist[1].prices.value + 5

.. _price-rules--auto--examples--6:

Example 6. Discounted Price for all Products Except of the Selected Brand
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You wish to set a discounted price for all products in the default price list (ID 1), except those whose brand is 'Super' (brand ID is 5).

**1. Product Assignment**

.. code-block:: rst

   product.brand.id != 5

**2. Price Calculation Rule**

**Calculate As**

.. code-block:: rst

   pricelist[1].prices.value * 0.9

.. _price-rules--auto--examples--7:

Example 7. Price Depends on the Custom Property
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Suppose your customer’s marketing department needs a price list with all products of yellow color where the price is increased by 10% to prepare for the ‘go yellow’ promo next month and balance the prices in the default price list that are scheduled to drop down.

You ensured that the product entity has the ‘color’ attribute as a prerequisite. It was not there originally, but you added it as a custom property.

.. tip:: To add custom properties to the product or category entity, use :ref:`entity management <doc-entities>` (**System > Entities > Entity Management**). Update the schema to apply changes.

Next, you entered the actual color for every product, and some of them indeed were yellow.

**1. Product Assignment**

Here is the product assignment rule that builds a price list of all yellow items in the catalog:

.. code-block:: rst

    product.color == “yellow”

**2. Price Calculation Rule**

And price rule that adds 10% to the list price:

.. code-block:: rst

    pricelist[1].prices.value * 1.1

.. _price-rules--auto--examples--8:

Example 8. Price Based on the Currency Rate
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: The currency rates management is only available in the Enterprise edition.

.. note:: The price list recalculation based on the currency rate is available as of OroCommerce version 6.1.1.


To simplify price management in multiple currencies, price calculation rules can directly use the :ref:`currency conversion rates <sys--config--sysconfig--general-setup--currency>` defined in the system configuration. However, currency rates are not updated automatically. If you need to recalculate prices due to a change in exchange rates, you must manually update the currency conversion rate in the system configuration. This update will trigger a full recalculation of all price lists that depend on that currency.

.. image:: /user/img/sales/pricelist/currency-rates.png
   :alt: The global currency configuration settings

Suppose your business operates internationally, and you need product prices in non-default currencies, such as EUR, to automatically reflect exchange rate changes, based on prices defined in your default currency.

Let's assume that your default currency is USD, and you want to automatically generate prices in EUR based on the USD prices from the default price list.


**1. Price Calculation Rule**

To work with exchange rates, you need to set the target currency and define a condition to restrict the source prices to the desired source currency.

**Currency**

.. code-block:: rst

    EUR

**Calculate As**

.. code-block:: rst

    pricelist[1].prices.value * rate.USD_EUR

**Condition**

.. code-block:: rst

    pricelist[1].prices.currency == 'USD'

.. _user-guide--pricing--auto--expression:

Filtering Expression Syntax
---------------------------

The filtering expression for the product assignment rule and the price calculation condition follow the |Symfony2 expression language| syntax and may contain the following elements:

1. Entity properties :ref:`stored as table columns <user-guide--pricing--auto--expression--storage-type>`, including:

* **Product properties**: product.id, product.sku, product.status, product.createdAt, product.updatedAt, product.inventory_status, etc.

* **Properties of the product’s children entities**, such as:

    + **Category properties**: product.category.id, product.category.left, product.category.right, product.category.level, product.category.root, product.category.createdAt, and product.category.updatedAt

    + Any **custom properties** added to the product entity (e.g., product.awesomeness), or the product children entity (e.g., product.category.priority and product.price.season)

* **Price properties**: pricelist[N].prices.currency, pricelist[N].prices.productSku, pricelist[N].prices.quantity, and pricelist[N].prices.value, where `N` is the ID of the pricelist that the product belongs to.

* **Exchange rate properties** (is available as of OroCommerce Enterprise version 6.1.1): rate.<SourceCurrencyCode_TargetCurrencyCode> (e.g., rate.USD_EUR, rate.EUR_USD. Virtual field generated for each possible currency pair enabled in :ref:`the system configuration <sys--config--sysconfig--general-setup--currency>`)

* **Relations** (for example, product.owner, product.organization, product.primaryUnitPrecision, product.category, and any virtual relations created in OroCommerce for entities of product and its children.

.. note::
    + To keep the filter behavior predictable, OroCommerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of the “one-to-many” relation (including the custom ones).
    + When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”).
    + Any product, price, and category entity attribute is accessible by field name.

2. **Operators:** +, -,  *,  / , %, ** , ==, ===, !=, !==, <, >, <=, >=, matches (string) (e.g. matches 't-shirt'; you can also use the following wildcards in the string: % --- replaces any number of symbols, _ --- any single symbol, e.g., matches ' t_shirt' returns both 't-shirt' and 't shirt') and, or, not, ~ (concatenation), in, not in, and .. (range).

3. **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Developer Notice
^^^^^^^^^^^^^^^^

The expression is converted into an internal Nodes tree. This tree is converted into QueryBuilder used in Insert From Select to fill prices and assignments with one query. AbstractQueryConverter manages virtual relations and virtual fields; it is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules have its cache by ID. When a rule or an assignment rule is changed, the cached QueryBuilder is recalculated.

.. _user-guide--pricing--auto--expression--storage-type:

Use Only Fields with Table Storage in Filtering Expressions
-----------------------------------------------------------

In filtering expressions for the price assignment rule, you can use only fields stored as **table columns**. :ref:`Serialized fields <book-entities-extended-entities-serialized-fields>` cannot be used in the filtering expressions for price lists.

To check a storage type of a field:

#. Navigate to **System > Entity > Entity Management** in the main menu.
#. Click the required entity in the list to open it.
#. Scroll down to the **Fields** section, find the required field, and check its **Storage Type** property.

   .. image:: /user/img/sales/pricelist/field_storage_type.png
      :alt: The list of fields under the Product entity ordered by the storage type

.. include:: /include/include-links-user.rst
   :start-after: begin
