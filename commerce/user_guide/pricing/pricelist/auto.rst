.. _user-guide--pricing--price-list-auto:

Automated Rule-Based Price Management
=====================================

.. contents:: :local:

.. begin

Automate a Price List
---------------------

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

To automatically generate a price list in OroCommerce:

#. Navigate to **Sales > Price Lists** in the main menu.

#. Start editing the required price list or click **Create Price List** to create a new one.

#. In the **Product Assignment** section, set up the product list. To complete this, in the **Rule** field, enter criteria to filter products in the catalog with the `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_.

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

      The (product filtering expression) is based on a `Symfony2 expression <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ that additionally filters the list of products generated in step 3 to limit the products the price shall apply to.

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

Price Rules Automation Examples
-------------------------------

.. include:: /user_guide/pricing/pricelist/auto_examples.rst
   :start-after: begin_price_rules_auto_examples
   :end-before: finish_price_rules_auto_examples

Filtering Expression Syntax
---------------------------

.. include:: /user_guide/pricing/pricelist/filtering_expression.rst
   :start-after: begin
   :end-before: finish


Developer Notice
----------------

The expression is converted into internal Nodes tree. This tree is converted into QueryBuilder which is used in Insert From Select to fill prices and assignment with one query. Virtual relations and virtual fields are managed by AbstractQueryConverter, that is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules have their cache by ID. When a rule or an assignment rule is changed, the cached QueryBuilder is recalculated.

.. end_pricelist_management

.. finish
