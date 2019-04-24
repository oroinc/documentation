.. _user-guide--products--product-units-in-use:

Product Units
=============

.. contents:: :local:

Product units represent a measurement system of products or their combinations. All products in OroCommerce must have a product unit assigned to them for the customer users to be able to add items to the shopping list and determine their quantity in the OroCommerce storefront. Product units are also used throughout the system for inventory and pricing control. Each product in OroCommerce can be assigned multiple units with custom pricing added to each particular product unit.
 
Out-of-the-box, OroCommerce offers the following product units:

* each
* hour
* item
* kilogram
* piece
* set

By default, *each* is set as the primary product unit but you can mark any of the available units as primary in the :ref:`system configuration <sys--commerce--product--product-units>`. 

.. note:: You cannot add new product units or modify the existing ones from the OroCommerce management console UI, but this can be achieved :ref:`with the help of the API <web-services-api>`.

Single and Multiple Product Units
---------------------------------

.. hint:: See the article on :ref:`creating a new product <doc--products--actions--create>` with step-by-step explanations and illustrations of the process, including adding product units.

You can add one or multiple units to a single product when creating new products, or through import. 

Although the primary unit must always be added to a product, multiple units can be used to sell products in different weight or size options. For instance, sugar can be sold loose in *kilograms* or in packs of 5kg in *items*.

To add additional units when creating a new product or editing an existing one, click **+Add** next to the **Additional Units** field, and select the desired unit from the list.

.. image:: /img/products/products/add_additional_product_unit.png
   :alt: Additional product unit 

You will be prompted to provide unit details, such as unit precision, conversion rate, and mark them for the sale in the storefront, or keep invisible for internal usage. You need to provide these details for every additional unit that you add to a product, including prices to be displayed to customer users in the storefront.

.. note:: Keep in mind that to be able to add multiple product units to products, the **Single Product Unit Mode** must be disabled in the system configuration.

Determine Unit Precision
^^^^^^^^^^^^^^^^^^^^^^^^

You can determine any desired precision for each product unit selected for the product. Precision represents a number of digits after the decimal point for the number of products that a customer can order or add to the shopping list. Although *items* and *sets* are usually whole numbers (5, 6, 15), units like *kilograms* may require specific precision. For instance, you may set precision to 2 which would allow buying a custom volume of kilograms and grams, such as 0.5 kg or 10.95 meters. 

When no product unit precision is selected (i.e. it is left at 0), this means that the unit is represented by a whole number.

Set Unit Conversion Rate
^^^^^^^^^^^^^^^^^^^^^^^^

When you select additional units of quantity, you can set a conversion rate compared to the primary unit of quantity selected for the product.

Have a look at how the Unit of Quantity and Additional Units fields are filled in the following example:

.. image:: /img/products/products/product_unit_primary_additional.png
   :alt: Primary and additional product unit added to a new product

* The **Unit of Quantity** field is set to a *kilogram* with a **Precision** of 2.
* The **Additional Units** field is set to an *item* with a **Precision** remaining a zero and the **Conversion Rate** set to 5 kg. This means that one item contains 5 kgs of sugar if we convert one unit into another.


Another example is for a product with 3 units: *item, set and kilogram*, where *an item* is the primary unit that equals 0.5 kg., *a set* contains 10 items and *a kilogram* is 2 items.

.. image:: /img/products/products/three_units_per_product.png
   :alt: Two additional units added to the product

.. note:: Please keep in mind that unit conversion in the OroCommerce storefront does not happen automatically, e.g if a set is 10 items and the customer adds 10 items to the shopping list, items are not converted into sets. Units are selected manually in the storefront.

Control Unit Visibility: Sell
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can control the visibility of product units in the storefront by either enabling or disabling the *Sell* check box next to the required product unit when creating or editing a product. 

When *Sell* is enabled for a product unit, this makes the unit visible to the customer users in the storefront when they are viewing this product. When *Sell* is disabled, the product unit is only visible in the management console and is hidden from the customer users in the OroCommerce storefront.
 
.. image:: /img/products/products/sell_checkbox_for_product_unit.png
   :alt: Enables sell checkbox for a product unit

Keeping product units visible only for internal operations in the management console might come in handy in a number of situations. For instance, if you buy your products in bulk in kilograms but sell them in items and sets, it makes sense to hide *kilograms* as a product unit option from the storefront and only use it for internal wholesale purchases.
 
Alternatively, while preparing sets of certain items for a holiday season sale, you might want to keep them hidden from the storefront until the actual sale day; you can, however, still track these sets through warehouses and add prices to them. 
 
Manage Product Units in Pricing
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can add custom and tier pricing to every product unit of a specific product. 

For example, if you sell paint brushes in items and sets, you can specify the dollar amount for the specific quantity that you want to sell. In the following example, 1 set contains 5 items (i.e. the conversion rate for *set* is 5). 

.. image:: /img/products/products/example_brushes_items_sets.png
   :alt: Paintbrushes are sold in items and sets

The product units available for pricing in the **Product Prices** section depend on the units selected for the product in the **General** section.

.. note:: Prices can be added manually when creating or editing a product, or through import. See the section on :ref:`price lists in OroCommerce <user-guide--pricing--pricelist--management>` for more information and examples.

.. image:: /img/products/products/tier_pricing_units.png
    :alt: Tier pricing for a product in items and sets

As illustrated in the screenshot, pricing for each quantity and product unit variation is added separately, depending on your pricing strategy. 

In the storefront, the tier pricing is reflected in the following way:

.. image:: /img/products/products/tier_pricing_storefront.png

* If you buy 1 item, it would cost you $9.50 for 1 piece. 
* If you buy 10 items, the price per item is lowered to $9.10
* If you buy 50 items, the price per item is lowered further to $8.99

However, if you buy the same product in sets, the price is even lower:

* If you buy 1 set, 1 item within it goes for $8.80
* If you buy 10 sets, 1 item within the set goes for $8.6.

Depending on the quantity selected for the product unit, **Your Price** in the storefront will be different. 

**Listed Price** is the pricing assigned to the available product units and their variations of quantity. **Your Price** is the *Listed* price under your current tier pricing configuration. 

For instance:

* For 1 brush, your price is $9.50 per item, the same as the listed price. 

  .. image:: /img/products/products/your_listed_pricing_equal.png
     :alt: Your price and listed price are the same in the storefront

* However, if you choose 50 items, your price is recalculated to $8.99 because this is the tier pricing set for the quantity of 50 brushes. 

  .. image:: //img/products/products/your_price_recalculated_after_tier_application.png
     :alt: Your price and listed price are different because the pricing tier is applied

* The same goes for sets:

.. image:: /img/products/products/your_price_recalculated_sets.png
   :alt: Your price is recalculated for sets

Use Units in Promotions
^^^^^^^^^^^^^^^^^^^^^^^

Two types of promotions, *Order Line Items* and *Buy X Get Y (Same Product)* require a unit of quantity added to the promotion setup. To make sure that promotion is going to be successfully triggered, the units of products added to the promotion must correspond to the units of quantity selected for the products. The promotion that offers you to buy 10 *pairs* of contact lenses and get 1 *pair* for free will not be triggered if the products (contact lenses) added to the promotion are sold as *each* or *set*.

.. note:: A *pair* here is used for illustration purposes, this unit does not come out-of-the-box.

If the product added to the promotion has more than one product unit, the promotion will be triggered if in the storefront the customer user selects the product unit defined in the promotion's conditions. For instance, if contact lenses are sold both in *each* and *pair* but the promotion is configured to be triggered for *pairs*, then no discount will be provided for customers who add the same product to the shopping list in *each*.

.. note:: If you want the promotion to be applied to all available units of one product, you need to create separate promotions with each of these additional units.

For more information, check out the :ref:`Promotions <user-guide--marketing--promotions>` topic.

Product Units in Inventory
--------------------------

Each product unit assigned to a product is listed on the inventory list where product quantity can be managed and adjusted for the required warehouse. If one product is sold in several units, all these units are displayed in the inventory table.

.. image:: /img/products/products/units_inventory.png
   :alt: Product units displayed in the inventory table

More information on inventory is available in the :ref:`Warehouse and Inventory <user-guide--inventory>` section.

**Related Topics**

* :ref:`Configure Product Units <sys--commerce--product--product-units>`
* :ref:`Understand Products' Life Cycle <doc--products--before-you-begin>`
