:oro_documentation_types: OroCommerce

.. _user-guide--pricing--price-list-auto:

Generate a Product Price Automatically
======================================

Automate a Price List
---------------------

The following simplified product catalog will be used in examples: 

+--------+---------------+----------------+----------+------------+-------+------+----------+
| Item # | Product       | Is in stock?   | Category | List Price | Price | Unit | Currency |
+========+===============+================+==========+============+=======+======+==========+
| A      | Laptop        | yes            | 1        | 2500       | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| B      | Pen           | yes            | 2        | 0.5        | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| C      | Office chair  | yes            | 3        | 300        | -     | item | EUR      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| D      | Office shelve | yes            | 4        | 250        | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+
| E      | Server        | no             | 5        | 30000      | -     | item | USD      |
+--------+---------------+----------------+----------+------------+-------+------+----------+

To automatically generate a price list in OroCommerce:

#. Navigate to **Sales > Price Lists** in the main menu.

#. Start editing the required price list or click **Create Price List** to create a new one.

#. In the **Product Assignment** section, set up the product list. To complete this, in the **Rule** field, enter criteria to filter products in the catalog with the |Symfony2 expression language|.

   .. Once you enter the expression into the **Products Assignment** field, the filtered products get into the price list.

   For example, to include all products in categories 1 and 5, use the following expression:

   .. code-block:: rst
      :linenos:

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

   The following example illustrates filtering products in stock with the list price (also known as manufacturer’s suggested retail price - MSRP) that is higher than 100 USD per item:

   .. code-block:: rst
       :linenos:

       product.msrp.value > 100 and product.msrp.currency == ‘USD’ and
       product.msrp.unit == ‘item’ and product.inventory_status == ‘in_stock’

   This filtering will result in the following product list:

   **Price list B**

   +--------+---------------+----------------+----------+------------+-------+------+----------+
   | Item # | Product       | Is in stock?   | Category | List Price | Price | Unit | Currency |
   +========+===============+================+==========+============+=======+======+==========+
   | A      | Laptop        | yes            | 1        | 2500       | -     | item | USD      |
   +--------+---------------+----------------+----------+------------+-------+------+----------+
   | D      | Office shelve | yes            | 4        | 250        | -     | item | USD      |
   +--------+---------------+----------------+----------+------------+-------+------+----------+

   .. hint:: You can customize the automatically generated price list and add more products manually.

#. Set up the price.

   To enable outstanding pricing flexibility, for the price list that automatically calculates the price for the products selected. The pricing behavior is configured in the **Price Calculation Rule** section.

   a. In the **Price for Quantity**, enter the quantity, select a product unit and currency that the rule will be applied to.

   b. In the **Calculate As** field, enter a price formula.

      For example:

      To set the price for all products to 99 USD, use the following expression:

      .. code-block:: rst
          :linenos:

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

      To set the price (for one item in US dollars) to be 5 USD more than the target margin (custom property of the product category), use the following expression:

      .. code-block:: rst
           :linenos:

               product.msrp.value * product.category.margin + 5


      The result will be the following:

      **Price list B**

      +--------+---------------+--------------+----------+------------+--------+----------+------+----------+
      | Item # | Product       | Is in stock? | Category | List price | Margin | Price    | Unit | Currency |
      +========+===============+==============+==========+============+========+==========+======+==========+
      | A      | Laptop        | yes          | 1        | 2500       | 1.2    | **3005** | item | USD      |
      +--------+---------------+--------------+----------+------------+--------+----------+------+----------+
      | D      | Office shelve | yes          | 4        | 250        | 1.5    | **380**  | item | USD      |
      +--------+---------------+--------------+----------+------------+--------+----------+------+----------+

      In this expression, the (price formula) may contain product and product-related items properties of the numeric type, numbers and arithmetic operations.

   c. In the **Condition** field, enter a product filtering expression.

      For example, you have decided to set price 99 USD only to the products from the category 1. Then you have entered *99* in the **Calculate As** field (see step a. the first example. In the **Condition** field, enter the following expression:

      .. code-block:: rst
          :linenos:

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

      The (product filtering expression) is based on a |Symfony2 expression language| that additionally filters the list of products generated in step 3 to limit the products the price shall apply to.

   d. In the **Priority** field, specify the precedence for this rule. See `Filters, Priorities, and Matching Units in the Automatically Generated Price List`_ for more information.

   e. If you need to set up prices for another range of products selected into the price list, or for another currency / unit, click **+Add** and repeat steps 4.a‒d.

   .. hint::

      * You can use :ref:`autocomplete <user-guide--pricing--price-list-auto--autocomplete>` to simplify the expression creation.
      * For more information, see :ref:`Filtering Expression Syntax <user-guide--pricing--auto--expression>`.
      * For more help on expressions creation, see :ref:`Price Rules Automation Examples <price-rules--auto--examples>`.

Filters, Priorities, and Matching Units in the Automatically Generated Price List
---------------------------------------------------------------------------------

**Funnel effect:** Condition filter is applied only to the products assigned to the price list in step two in the process above and not the complete catalog.

**Default units and currency:** If the currency and unit are not specified as filtering criteria, OroCommerce applies *USD* as the default currency and *item* as a default unit. When currency and unit values are included in the filtering criteria, they override the default values.

**Automatic updates:** OroCommerce automatically updates price lists and recalculates prices whenever product-related data is updated. The trigger could be a new product, category structure changes, or the product that moved to another category.

**Matching units:** During price generation, OroCommerce precisely matches the rule units and product units to ensure calculations are correct. For example, when you sell stuffed toys and the supported units are items and bundles of 10 items, your price calculation rule configured only for kilograms will not apply and the price will not be generated.

**Multiple price rules that are targeting the same product:** When several price calculation rules apply to the same product in the price list, OroCommerce uses the rule with the highest priority.

**Enforcing the price:** Prices that were provided manually have higher priority than those generated automatically. Once you manually set the price for the automatically assigned product, it will not change after price recalculation anymore.

.. _price-rules--auto--examples:

Price Rules Automation Examples
-------------------------------

In this topic you can find examples of expressions for automatic generation of price lists. The examples cover only common use cases. For all the examples it is assumed that we set USD prices for one item.

* :ref:`Different discounts based on the current price <price-rules--auto--examples--1>`
* :ref:`Fixed price for similar SKUs <price-rules--auto--examples--2>`
* :ref:`15% more than MSRP for products created after May 1, 2017 <price-rules--auto--examples--3>`
* :ref:`MAP price for all featured products in certain category <price-rules--auto--examples--4>`
* :ref:`Price for selected products <price-rules--auto--examples--5>`
* :ref:`Discounted price for all products except of the selected brand <price-rules--auto--examples--6>`
* :ref:`Price depends on the custom property <price-rules--auto--examples--7>`

.. _price-rules--auto--examples--1:

Example 1. Different Discounts Based on the Current Price
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have a group of 'golden' wholesale customers to whom you would like to offer the $1 discount for products that cost less than $10, and $2.5 discount for products that cost $10 and more.

You have the standard price list Wholesale which you want to base a new price list on. The Wholesale pricelist ID is 2.

Then use the following expressions.

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

    product.id in pricelist[2].assignedProducts

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

You need to enter 2 price calculation rules in this section.

The first one defines that the price must be set $1 less than the current if the current price itself is less than $10:

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[2].prices.value - 1

**Condition**

.. code-block:: rst
   :linenos:

   pricelist[2].prices.value < 10

Then click **+Add**, and the second rule that defines that the price must be set $2.5 less than the current if the current price itself is equal or more than $10:

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[2].prices.value - 2.5

**Condition**

.. code-block:: rst
   :linenos:

   pricelist[2].prices.value >= 10


.. _price-rules--auto--examples--2:

Example 2. Fixed Price for Similar SKUs
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You and your customer have come to terms on the fixed price for medical tags: it should be $20 for all kinds of tags that you supply.

You store medical tags with SKUs like: TAG1, TAG2, TAG3, etc.

Create a new price list with the following settings.

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

   product.sku matches 'TAG%'

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

**Calculate As**

.. code-block:: rst
   :linenos:

   20

.. _price-rules--auto--examples--3:

Example 3. 15% More than MSRP for Products Created After May 1, 2017
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You need to make the price for the products added after May 1, 2017 a 15% more than their msrp price.

Create a new price list with the following settings.

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

   product.createdAt > '1/5/2017'

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

**Calculate As**

.. code-block:: rst
   :linenos:

   product.msrp.value * 1.15

.. _price-rules--auto--examples--4:

Example 4. MAP Price for all Featured Products in Certain Category
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have decided to set the MAP (minimum advertised price) price attribute value for all 'featured' products price in category 'Office Furniture' (category ID is 7),

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

   product.featured == true and product.category.id == 7

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

**Calculate As**

.. code-block:: rst
   :linenos:

   product.map.value

.. _price-rules--auto--examples--5:

Example 5. Price for Selected Products
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have decided to set the price $10 more than in the default price list (ID 1) for selected products, product IDs: 14, 10, 312, 62.

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

   product.id in [14,10,312,62]


.. hint::

   You can also use product SKUs instead of IDs. But note that then you need to enter them as strings:

   ``product.sku in ['1GS46','2TK59','8DO33','6VC22']``

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[1].prices.value + 5

.. _price-rules--auto--examples--6:

Example 6. Discounted Price for all Products Except of the Selected Brand
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You wish to set discounted price for all products in the default price list (ID 1), except those whose brand is 'Super' (brand ID is 5).

Product Assignment
~~~~~~~~~~~~~~~~~~

.. code-block:: rst
   :linenos:

   product.brand.id != 5

Price Calculation Rule
~~~~~~~~~~~~~~~~~~~~~~

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[1].prices.value * 0.9

.. _price-rules--auto--examples--7:

Example 7. Price Depends on the Custom Property
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Imagine that your customer’s marketing department needs a price list with all products of yellow color where the price is increased by 10% to prepare for the ‘go yellow’ promo next month and balance the prices in the default price list that are scheduled to drop down.

As a prerequisite, you ensured that the product entity has the ‘color’ attribute. It was not there originally, but you added it as a custom property.

.. tip:: To add custom properties to the product or category entity, use entity management (**System > Entities > Entity Management**). Update the schema to apply changes.

Next, you entered the actual color for every product, and some of them indeed were yellow.

Here is the product assignment rule that builds a price list of all yellow items in the catalog:

.. code-block:: rst
    :linenos:

    product.color == “yellow”

And price rule that adds 10% to the list price:

.. code-block:: rst
    :linenos:

    pricelist[1].prices.value * 1.1

.. _user-guide--pricing--auto--expression:

Filtering Expression Syntax
---------------------------

The filtering expression for the product assignment rule and the price calculation condition follow the |Symfony2 expression language| syntax and may contain the following elements:

* Entity properties :ref:`stored as table columns <user-guide--pricing--auto--expression--storage-type>`, including:

  - **Product properties**: product.id, product.sku, product.status, product.createdAt, product.updatedAt, product.inventory_status, etc.

  - Properties of product’s children entities, like:

      + **Category properties**: product.category.id, product.category.left, product.category.right, product.category.level, product.category.root, product.category.createdAt, and product.category.updatedAt

      + Any **custom properties** added to the product entity (e.g. product.awesomeness), or to the product children entity (e.g. product.category.priority and product.price.season)

  - **Price properties**: pricelist[N].prices.currency, pricelist[N].prices.productSku, pricelist[N].prices.quantity, and pricelist[N].prices.value, where `N` is the ID of the pricelist that the product belongs to.

  - **Relations** (for example, product.owner, product.organization, product.primaryUnitPrecision, product.category, and any virtual relations created in OroCommerce for entities of product and its children.

    .. note::
       + To keep the filter behavior predictable, OroCommerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of the “one-to-many” relation (including the custom ones).
       + When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”).
       + Any product, price and category entity attribute is accessible by field name.

* **Operators:** +, -,  *,  / , %, ** , ==, ===, !=, !==, <, >, <=, >=, matches (string) (e.g. matches 't-shirt'; you can also use the following wildcards in the string: % --- replaces any number of symbols, _ --- any single symbol, e.g., matches ' t_shirt' returns both 't-shirt' and 't shirt') and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Developer Notice
^^^^^^^^^^^^^^^^

The expression is converted into internal Nodes tree. This tree is converted into QueryBuilder which is used in Insert From Select to fill prices and assignment with one query. Virtual relations and virtual fields are managed by AbstractQueryConverter, that is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules have their cache by ID. When a rule or an assignment rule is changed, the cached QueryBuilder is recalculated.

.. _user-guide--pricing--auto--expression--storage-type:

Use Only Fields with Table Storage in Filtering Expressions
-----------------------------------------------------------

In filtering expression for the price assignment rule, you can use only fields stored as table columns.

Serialized fields cannot be used in the filtering expressions for price lists.

To check a storage type of a field:

#. Navigate to **System > Entity > Entity Management** in the main menu.
#. Click the required entity in the list to open it.
#. Scroll down to the **Fields** section, find the required field, and check its **Storage Type** property.

   .. image:: /user/img/sales/pricelist/field_storage_type.png
      :alt: The list of fields under the Product entity ordered by the storage type

.. include:: /include/include-links-user.rst
   :start-after: begin