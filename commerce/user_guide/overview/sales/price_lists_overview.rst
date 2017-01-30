Overview
========

.. begin

The post on `price list management <https://www.orocommerce.com/blog/price-list-management-in-orocommerce>`_ triggered a number of questions around the optimal and easy-to-build price list configuration and specifically the steps it takes in Oro Commerce to set up a price list that is flexible, adjustable and exactly matches your pricing strategy. 

For most B2B eCommerce users, getting a price list that is automatically adjusted whenever there is a change to the key indicators, like product availability, recommended price, and cost, is a must-have option. However, this is not always easy and usually triggers a time consuming and sometimes error-prone process of export, conversion, and import of the price information. 

In the worst case scenario, someone's daily duty is to adjust prices manually, and while it still can be tangible for a small online shop selling directly to their customers, the corporate commerce serving businesses can hardly afford this lack of automation.

While a custom script-based or workflow-based automation usually can well do the necessary adjustments to the prices, this in-house project with all the maintenance and eventual updates to meet the price strategy fluctuations promises to be quite expensive.

In Oro Commerce, price list generation and updates are moved to a whole new level. You get the complete price list for thousands and millions of items ready in literally no time. Products automatically get into the price list whenever they match the special criteria - a price list's product assignment rule. You can set up flexible pricing rules, for example, to meet the price regulations requirements, maintain an international location aware price list, or to stimulate the demand and update the price following the in stock availability trends.

Additionally, automated pricing rules are a single source of truth for your price list. You can easily trace what impacts the price change, share the vision of the pricing strategy and make sure the price is absolutely correct and meets the demanding needs of your pricing policies.

Automating a price list
~~~~~~~~~~~~~~~~~~~~~~~

**Note:** We'll use this simplified product catalog in the examples below:

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

#. Open the price list or create a brand new one in **Sales > Price Lists**.

#. **Set up the product list**

   With a `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_, set up  criteria to filter products in the catalog. Once you enter the expression into the Products Assignment box, the filtered products get into the price list.

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
   
   Another example, that filters products in stock with list price (also known as manufacturer’s suggested retail price - MSRP) that is higher than 100 USD per item:
   
   .. code-block:: rst
       :linenos:

      product.msrp.value > 100 and product.msrp.currency == ‘USD’ and 
      product.msrp.unit == ‘item’ and product.inventory_status == ‘in_stock’
   
   This will result in the following product list:
   
   **Price list B**
   
   +--------+---------------+----------------+----------+------------+-------+------+----------+
   | Item # | Product       | Is in stock?   | Category | List Price | Price | Unit | Currency |
   +========+===============+================+==========+============+=======+======+==========+
   | A      | Laptop        | yes            | 1        | 2500       | -     | item | USD      |
   +--------+---------------+----------------+----------+------------+-------+------+----------+
   | D      | Office shelve | yes            | 4        | 250        | -     | item | USD      |
   +--------+---------------+----------------+----------+------------+-------+------+----------+
   
   You are welcome to customize the automatically generated price list and add more products manually. 
   
   **Note:** For more information, see `Filtering Expression Syntax`_ and `Using custom properties in price list generation`_.

#. **Set up the price**

   To enable outstanding pricing flexibility, Oro Commerce introduced a new option for the price list that automatically calculates the price for the automatically listed products. 
   
   The pricing behavior is configured in the Price Calculation Rule box, using the following expression:
   
   .. code-block:: rst
       :linenos:

          Rule: (price formula), Condition: (product filtering expression)
   
   In this expression, the (price formula) may contain product (and/or it’s children) properties of the numeric type, numbers and arithmetic operations, and (product filtering expression) is a `Symfony2 expression <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ that additionally filters the list of products that were generated in step two to limit the products this price shall apply to.
   
   For example, to set the price (per one item) for all products in category 1 to 99 USD, use the following expression:
   
   .. code-block:: rst
       :linenos:

          Rule: 99, Condition: product.category == 1
   
   In our sample, this will set the following scene:
   
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

Quick facts
~~~~~~~~~~~

**Funnel effect:** Condition filter is applied only to the products assigned to the price list on step two in the process above, and not the complete catalog. 

**Default units and currency:** If the currency and unit are not specified as filtering criteria, Oro Commerce applies the *USD* as default currency and *item* as a default unit. When currency and unit values are included in the filtering criteria, they override the default values.

**Automatic updates:** Oro Commerce automatically updates the price lists and recalculates prices whenever the product-related data is updated. Trigger could be a new product, category structure changes, or the product that moved to another category.

**Matching units:** During price generation, Oro Commerce precisely matches the rule units and product units to ensure calculations are correct. For example, when you sell stuffed toys and the supported units are items and bundles of 10 items, your price calculation rule that is configured only for kilograms will not apply and the price will not be generated.

**Multiple price rules targeting the same product:** When several price calculation rules apply to the same product in the price list, Oro Commerce uses the rule with the highest priority.

**Enforcing the price:** Prices that were provided manually have higher priority than the automatically generated ones. Once you manually set the price for the automatically assigned product, it will not change after price recalculation anymore. 

Using custom properties in price list generation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Imagine your customer’s marketing department needs a price list with all products of yellow color where the price is increased by 10% to prepare for the ‘go yellow’ promo next month, when the price will drop down.

As a prerequisite, you ensured that the product entity has the ‘color’ attribute. It was not there originally, but you added it as a custom property.

**Note:** To add custom properties to the product or category entity, use entity management (**System > Entities > Entity Management**) (Only table properties are supported). Update the schema to apply changes.

Next, you entered the actual color for every product, and some of them indeed were yellow.

Here is the product assignment rule that builds a price list of all yellow items in the catalog:

.. code-block:: rst
    :linenos:

   product.color == “yellow”

and price rule that adds 10% to the list price. 

.. code-block:: rst
    :linenos:

   Rule: product.msrp.value * 1.1


Filtering expression syntax
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Filtering expression for product assignment rule, as well as the price calculation condition, follow the `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ syntax and may contain the following elements:

* Entity properties, including:

 - **Product properties**: product.id, product.sku, product.status, product.createdAt, product.updatedAt, product.inventory_status, etc.

 - Properties of product’s children entities, like:

     + **Category properties**: product.category.id, product.category.left, product.category.right, product.category.level, product.category.root, product.category.createdAt, and product.category.updatedAt 

     + **Price properties**: product.price.value, product.price.unit, product.price.quantity, and product.price.currency
       
     + Any **custom properties** added to the product entity (e.g. product.awesomeness), or to the product children entity (e.g. product.category.priority and product.price.season)

 - **Relations** (for example, product.owner, product.organization, product.primaryUnitPrecision, product.category, and any virtual relations created in Oro Commerce for entities of product and its children. **Notes:**

     + To keep the filter behavior predictable, Oro Commerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of “one-to-many” relation (including the custom ones). 
     
     + When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”). 
     
     + Generally, any product, price and category entity attribute is accessible by field name.

* **Operators:** +, -,  *,  / , %, **, ==, ===, !=, !==, <, >, <=, >=, matches (regexp), and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Developer notice
~~~~~~~~~~~~~~~~

The expression is converted into internal Nodes tree. This tree is converted into QueryBuilder which is used in Insert From Select to fill prices and assignment with one query. Virtual relations and virtual fields are managed by AbstractQueryConverter, that is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules has their own cache by ID. When assignment rule or rule is changed, the cached QueryBuilder is recalculated.