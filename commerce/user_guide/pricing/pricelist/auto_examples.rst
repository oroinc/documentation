.. _price-rules--auto--examples:

Price Rules Automation Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In this topic you can find examples of expressions for automatic generation of price lists. The examples cover only common use cases. For all the examples it is assumed that we set USD prices for one item.

.. begin_price_rules_auto_examples

* :ref:`Different discounts based on the current price <price-rules--auto--examples--1>`
* :ref:`Fixed price for similar SKUs <price-rules--auto--examples--2>`
* :ref:`15% more than MSRP for products created after May 1, 2017 <price-rules--auto--examples--3>`
* :ref:`MAP price for all featured products in certain category <price-rules--auto--examples--4>`
* :ref:`Price for selected products <price-rules--auto--examples--5>`
* :ref:`Discounted price for all products except of the selected brand <price-rules--auto--examples--6>`
* :ref:`Price depends on the custom property <price-rules--auto--examples--7>`

.. finish_price_rules_auto_examples


.. _price-rules--auto--examples--1:

Example 1. Different Discounts Based on the Current Price
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You have a group of 'golden' wholesale customers to whom you would like to offer the $1 discount for products that cost less than $10, and $2.5 discount for products that cost $10 and more.

You have the standard price list Wholesale which you want to base a new price list on. The Wholesale pricelist ID is 2.

Then use the following expressions.

Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

    product.id in pricelist[2].assignedProducts

Price Calculation Rule
""""""""""""""""""""""

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
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You and your customer have come to terms on the fixed price for medical tags: it should be $20 for all kinds of tags that you supply.

You store medical tags with SKUs like: TAG1, TAG2, TAG3, etc.

Create a new price list with the following settings.

Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

   product.sku matches 'TAG%'

Price Calculation Rule
""""""""""""""""""""""

**Calculate As**

.. code-block:: rst
   :linenos:

   20

.. _price-rules--auto--examples--3:

Example 3. 15% More than MSRP for Products Created After May 1, 2017
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You need to make the price for the products added after May 1, 2017 a 15% more than their msrp price.

Create a new price list with the following settings.

Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

   product.createdAt > '1/5/2017'

Price Calculation Rule
""""""""""""""""""""""

**Calculate As**

.. code-block:: rst
   :linenos:

   product.msrp.value * 1.15

.. _price-rules--auto--examples--4:

Example 4. MAP Price for all Featured Products in Certain Category
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You have decided to set the MAP (minimum advertised price) price attribute value for all 'featured' products price in category 'Office Furniture' (category ID is 7),

Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

   product.featured == true and product.category.id == 7

Price Calculation Rule
""""""""""""""""""""""

**Calculate As**

.. code-block:: rst
   :linenos:

   product.map.value

.. _price-rules--auto--examples--5:

Example 5. Price for Selected Products
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You have decided to set the price $10 more than in the default price list (ID 1) for selected products, product IDs: 14, 10, 312, 62.


Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

   product.id in [14,10,312,62]


.. hint::

   You can also use product SKUs instead of IDs. But note that then you need to enter them as strings:

   ``product.sku in ['1GS46','2TK59','8DO33','6VC22']``

Price Calculation Rule
""""""""""""""""""""""

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[1].prices.value + 5

.. _price-rules--auto--examples--6:

Example 6. Discounted Price for all Products Except of the Selected Brand
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You wish to set discounted price for all products in the default price list (ID 1), except those whose brand is 'Super' (brand ID is 5).

Product Assignment
""""""""""""""""""

.. code-block:: rst
   :linenos:

   product.brand.id != 5


Price Calculation Rule
""""""""""""""""""""""

**Calculate As**

.. code-block:: rst
   :linenos:

   pricelist[1].prices.value * 0.9

.. _price-rules--auto--examples--7:

Example 7. Price Depends on the Custom Property
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
