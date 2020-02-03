.. _user-guide--pricing-calculation:

:oro_documentation_types: OroCommerce

Price Calculation in the Storefront
------------------------------------

.. begin

Product prices on the storefront are taken from the combination of the price lists that are enabled on the system level, website level, customer group and customer level.

Based on the fallback configuration, OroCommerce identifies the enabled price lists (see scenarios below) and selects one price per product quantity tier in the active currency to show it to the buyer as the listing price on the storefront.
As there might be multiple prices matching the selection criteria in the enabled price lists, OroCommerce follows the configured :ref:`price selection strategy <sys--config--commerce--catalog--pricing>` (minimal price vs priority-based).

The enabled price lists for different fallback options setup is illustrated in the table below.

+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+
| Configuration Level (Price Lists)                                                           | Fallback Option           | Configuration 1               | Configuration 2       | Config. 3    | Config. 4 |
+=============================================================================================+===========================+===============================+=======================+==============+===========+
| :ref:`System <sys--config--commerce--catalog--pricing>` (X, Y, Z)                           | None                      | N/A                           | N/A                   | N/A          | N/A       |
+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+
| :ref:`Website <sys--website--edit--price-lists>` (A, B, C)                                  | Config                    | +                             | o                     | N/A          | N/A       |
+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+
| :ref:`Website for Customer Group <customers--customer-groups--edit--price-lists>` (D, E, F) | Website                   | +                             | +                     | o            | N/A       |
+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+
| :ref:`Website for Customer <customers--customers--edit--price-lists>` (G)                   | Customer Group            | +                             | +                     | +            | o         |
+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+
| **Resulting active price lists**                                                                                        |*X, Y, Z, A, B, C, D, E, F, G* | *A, B, C, D, E, F, G* | *D, E, F, G* | *G only*  |
+---------------------------------------------------------------------------------------------+---------------------------+-------------------------------+-----------------------+--------------+-----------+

Whether the buyer will get the minimal price or the price from the price list with the highest priority, depends on the pricing strategy configured :ref:`globally <sys--config--commerce--catalog--pricing>`.

Minimal Prices Strategy
^^^^^^^^^^^^^^^^^^^^^^^

When Minimal Prices Strategy is selected, the OroCommerce uses the minimum price per tier that is found in the available (enabled) price lists.

For example, let's use the product prices in two price lists:

+---------+--------------------+-------------+
| Product | Price List         | Price       | 
+=========+====================+=============+
| SKU1    | Default PriceList  | 9$ / 1 item |
+---------+--------------------+-------------+
| SKU1    | Default PriceList  | 8$ / 2 item |
+---------+--------------------+-------------+
| SKU1    | Default PriceList  | 6$ / 4 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 8$ / 1 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 7$ / 2 item |
+---------+--------------------+-------------+
| SKU1    | Custom PriceList   | 7$ / 4 item |
+---------+--------------------+-------------+

The following minimal tier prices will be shown to the buyer. 

**SKU1**:

* 8$ / 1 item
* 7$ / 2 item
* 6$ / 4 item

Merge By Priority Strategy
^^^^^^^^^^^^^^^^^^^^^^^^^^

Merge By Priority Strategy picks the first price from the given sequence of the Price Lists for a missing price tier in the given currency.

In the price list priority configuration, the `Merge Allowed` flag shows whether a particular Price List is allowed to be merged with the other prices. When Merge Allowed is disabled for a price list, its price will be exclusively used for the product that has no price provided in other price lists with higher priority.

Let's take a look at the following example: product price is defined in two price lists that allow price merge.

+---------+--------------------+-------------+--------------+
| Product | Price List         | Price       | Merge Allowed|
+=========+====================+=============+==============+
| SKU1    | Default PriceList  | 9$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item | true         |
+---------+--------------------+-------------+--------------+
| ---     | ---                | ---         | ---          |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item | true         |
+---------+--------------------+-------------+--------------+

The product's price calculation will result in the following list prices:

**SKU1**:

* 9$ / 1 item
* 8$ / 2 item
* 7$ / 4 item
* 6$ / 5 item

Now let's see what changes if the merge is not allowed in the price list with higher priority:

+---------+--------------------+-------------+--------------+
| Product | Price List         | Price       | Merge Allowed|
+=========+====================+=============+==============+
| SKU1    | Default PriceList  | 9$ / 1 item | false        |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item | false        |
+---------+--------------------+-------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item | false        |
+---------+--------------------+-------------+--------------+
| ---     | ---                | ---         | ---          |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item | true         |
+---------+--------------------+-------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item | true         |
+---------+--------------------+-------------+--------------+

The product's price calculation will result in the following list prices:

**SKU1**:

* 9$ / 1 item
* 8$ / 2 item
* 6$ / 5 item

Note that the price for 4 items from the Custom Price List is not used.

Finally, let's consider the mixed example, where the merge is allowed for some price lists, including the one of the top priority. However, there is one price list that does not allow merge.

+---------+--------------------+---------------+--------------+
| Product | Price List         | Price         | Merge Allowed|
+=========+====================+===============+==============+
| SKU1    | Default PriceList  | 9$ / 1 item   | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Default PriceList  | 8$ / 2 item   | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Default PriceList  | 6$ / 5 item   | true         |
+---------+--------------------+---------------+--------------+
| ---     | ---                | ---           | ---          |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 8$ / 1 item   | false        |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 2 item   | false        |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom PriceList   | 7$ / 4 item   | false        |
+---------+--------------------+---------------+--------------+
| ---     | ---                | ---           | ---          |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom2 PriceList  | 5$ / 10 item  | true         |
+---------+--------------------+---------------+--------------+
| SKU1    | Custom2 PriceList  | 4$ / 100 item | true         |
+---------+--------------------+---------------+--------------+

Now the product will have the following list prices:

**SKU1**:

* 9$ / 1 item
* 8$ / 2 item
* 6$ / 5 item
* 5$ / 10 item
* 4$ / 100 item

The prices from the Custom Price List, where **Merge Allowed** is off, are omitted.

.. finish


**Related Articles**

* :ref:`Understanding Pricing in OroCommerce <user-guide--pricing--overview>`

* :ref:`Price List Management <user-guide--pricing--pricelist--management>`