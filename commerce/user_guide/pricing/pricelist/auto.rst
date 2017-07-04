:orphan:

.. _user-guide--pricing--price-list-auto:

Automated Rule-Based Price Management
-------------------------------------

.. begin

Automate a Price List
~~~~~~~~~~~~~~~~~~~~~

.. begin_pricelist_management

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

To automatically generate a price list in Oro Commerce:

#. Navigate to **Sales > Price Lists** in the main menu and open the required price list or create a new one.

#. Set up the product list.

   With a `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_, set up criteria to filter products in the catalog. Once you enter the expression into the **Products Assignment** field, the filtered products get into the price list.

   For example, to include all products in categories 1 and 5, use the following expression:

   .. code-block:: rst
      :linenos:

      product.category == 1 and product.category == 5

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

   .. hint:: For more information, see `Filtering Expression Syntax`_ and `Using custom properties in price list generation`_.
   
   .. note:: You can customize the automatically generated price list and add more products manually.



#. Set up the price.

   To enable outstanding pricing flexibility, Oro Commerce introduced a new option for the price list that automatically calculates the price for the automatically listed products.

   The pricing behavior is configured in the **Price Calculation Rule** field using the following expression:

   .. code-block:: rst
       :linenos:

          Rule: (price formula), Condition: (product filtering expression)

   In this expression, the (price formula) may contain product and product related items properties of the numeric type, numbers and arithmetic operations. The (product filtering expression) is a `Symfony2 expression <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ that additionally filters the list of products generated in step two to limit the products this price shall apply to.

   For example, to set the price (per one item) for all products in category 1 to 99 USD, use the following expression:

   .. code-block:: rst
       :linenos:

          Rule: 99, Condition: product.category == 1

   The result will be the following:

   **Price list A**

   +--------+---------+----------------+----------+------------+--------+------+----------+
   | Item # | Product | Is in stock?   | Category | List Price | Price  | Unit | Currency |
   +========+=========+================+==========+============+========+======+==========+
   | A      | Laptop  | yes            | 1        | 2500       | **99** | item | USD      |
   +--------+---------+----------------+----------+------------+--------+------+----------+
   | E      | Server  | no             | 5        | 30000      | -      | item | USD      |
   +--------+---------+----------------+----------+------------+--------+------+----------+


   Alternatively, to set the price (for one item in US dollars) to be 5 US dollars more than the target margin (custom property of the product), use the following expression:

   .. code-block:: rst
       :linenos:

          product.msrp.value * product.category.margin + 5

   **Price list B**

   +--------+---------------+--------------+----------+------------+--------+----------+------+----------+
   | Item # | Product       | Is in stock? | Category | List price | Margin | Price    | Unit | Currency |
   +========+===============+==============+==========+============+========+==========+======+==========+
   | A      | Laptop        | yes          | 1        | 2500       | 1.2    | **3005** | item | USD      |
   +--------+---------------+--------------+----------+------------+--------+----------+------+----------+
   | D      | Office shelve | yes          | 4        | 250        | 1.5    | **380**  | item | USD      |
   +--------+---------------+--------------+----------+------------+--------+----------+------+----------+

Quick Facts
"""""""""""

**Funnel effect:** Condition filter is applied only to the products assigned to the price list in step two in the process above and not the complete catalog.

**Default units and currency:** If the currency and unit are not specified as filtering criteria, Oro Commerce applies *USD* as the default currency and *item* as a default unit. When currency and unit values are included in the filtering criteria, they override the default values.

**Automatic updates:** Oro Commerce automatically updates price lists and recalculates prices whenever product-related data is updated. The trigger could be a new product, category structure changes, or the product that moved to another category.

**Matching units:** During price generation, Oro Commerce precisely matches the rule units and product units to ensure calculations are correct. For example, when you sell stuffed toys and the supported units are items and bundles of 10 items, your price calculation rule configured only for kilograms will not apply and the price will not be generated.

**Multiple price rules that are targeting the same product:** When several price calculation rules apply to the same product in the price list, Oro Commerce uses the rule with the highest priority.

**Enforcing the price:** Prices that were provided manually have higher priority than those generated automatically. Once you manually set the price for the automatically assigned product, it will not change after price recalculation anymore.

Using Custom Properties in Price List Generation
""""""""""""""""""""""""""""""""""""""""""""""""
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

    Rule: product.msrp.value * 1.1


Filtering Expression Syntax
"""""""""""""""""""""""""""

The filtering expression for the product assignment rule and the price calculation condition follow the `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ syntax and may contain the following elements:

* Entity properties, including:

 - **Product properties**: product.id, product.sku, product.status, product.createdAt, product.updatedAt, product.inventory_status, etc.

 - Properties of product’s children entities, like:

     + **Category properties**: product.category.id, product.category.left, product.category.right, product.category.level, product.category.root, product.category.createdAt, and product.category.updatedAt

     + **Price properties**: product.price.value, product.price.unit, product.price.quantity, and product.price.currency

     + Any **custom properties** added to the product entity (e.g. product.awesomeness), or to the product children entity (e.g. product.category.priority and product.price.season)

 - **Relations** (for example, product.owner, product.organization, product.primaryUnitPrecision, product.category, and any virtual relations created in Oro Commerce for entities of product and its children. **Notes:**

     + To keep the filter behavior predictable, Oro Commerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of the “one-to-many” relation (including the custom ones).

     + When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”).

     + Any product, price and category entity attribute is accessible by field name.

* **Operators:** +, -,  *,  / , %, **, ==, ===, !=, !==, <, >, <=, >=, matches (regexp), and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Developer Notice
""""""""""""""""

The expression is converted into internal Nodes tree. This tree is converted into QueryBuilder which is used in Insert From Select to fill prices and assignment with one query. Virtual relations and virtual fields are managed by AbstractQueryConverter, that is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules have their cache by ID. When a rule or an assignment rule is changed, the cached QueryBuilder is recalculated.

.. end_pricelist_management
.. finish
