.. _user-guide--promotion--expression:

.. promotion_expressions_begin

Add Expressions to Promotions
-----------------------------

Expression language for promotions expressions is a user-friendly and business oriented extension of the |Symfony Expression Language|. It is easy to use and, on top of usual comparison and logical operators, it allows iterating through the collections of items using *(collection).all* and *(collection).any* operations. Keep in mind that out-of-the-box, you can add any custom fields to the required entity in addition to the attributes listed below.

.. note:: Note that the *float* values require using a number with a fractional part (a floating-point number), for example, lineItem.quantity != **1.0** instead of lineItem.quantity != **1**.

Attributes Supported in Promotion Expressions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Attributes
""""""""""

**Financial**

* shippingCost *float*
* paymentMethod *string*
* paymentMethods Collection *string*
* currency *string*
* subtotal *float*

**Geographies**

*billingAddress*

* billingAddress.street *string*
* billingAddress.street2 *string*
* billingAddress.city *string*
* billingAddress.regionName *string*
* billingAddress.regionCode *string*
* billingAddress.postalCode *string*
* billingAddress.countryName *string*
* billingAddress.countryIso3 *string*
* billingAddress.countryIso2 *string*

To find the whole list of fields available for *billingAddress*, navigate to System > Entities > Entity Management > Order Address. More details on the entity fields management are described :ref:`here <admin-guide-manage-entity-fields>`.

*shippingAddress*

* shippingAddress.street *string*
* shippingAddress.street2 *string*
* shippingAddress.city *string*
* shippingAddress.regionName *string*
* shippingAddress.regionCode *string*
* shippingAddress.postalCode *string*
* shippingAddress.countryName *string*
* shippingAddress.countryIso3 *string*
* shippingAddress.countryIso2 *string*

**Business**

*Customer*

* customer.id *int*
* customer.name *string*
* customer.group.id *int*
* customer.group.name *string*
* customer.payment_term_7c4f1e8e.label *string* (Payment Term)
* customer.payment_term_7c4f1e8e.id *int* (Payment Term)

To find the whole list of fields available for *customer*, navigate to System > Entities > Entity Management > Customer. More details on the entity fields management are described :ref:`here <admin-guide-manage-entity-fields>`.

*Customer User*

* customerUser.id *int*
* customerUser.email *string*
* customerUser.firstName *string*
* customerUser.middleName *string*
* customerUser.lastName *string*
* customerUser.lastName *string* (which is a customerUser.firstName ~ ‘ ‘ ~ customerUser.lastName, e.g. 'Amanda Cole')

To find the whole list of fields available for *customerUser*, navigate to System > Entities > Entity Management > Customer User. More details on the entity fields management are described :ref:`here <admin-guide-manage-entity-fields>`.


.. note:: Please note that if you enable guest checkout on your website, `customerUser` will be empty on the first two checkout steps. To prevent promotion calculation errors, you can add an additional condition, "customerUser and", before the first usage of the `customerUser` variable, for example, `subtotal > 500.0 and customerUser and customerUser.email = ""`


*Customer Group*

* customerGroup.id *int*
* customerGroup.name *string*


Collections
"""""""""""

* **lineItems** is a collection of line items (products and their quantity, units, price) that are being ordered.

* **lineItems[X].product.unitPrecisions** is a collection of unit precisions that is available in OroCommerce for the lineItem product in the order.

* **lineItems[X].product.inventoryLevels** is a collection of inventory levels - available quantities of the particular product in various units in warehouses that are available in OroCommerce.

* **customer.users** is a collection of customer users that belong to the customer the order is submitted for.

* **customerGroup.customers** is a collection of customers that belong to the customer group.


lineItems Collection
""""""""""""""""""""

**Attributes**

  .. note:: Use the items with LineItem prefix when processing the lineItems collection using .any() and .all() expressions. Alternatively, address the item in the collection directly, e.g. lineItems[1].product.sku.

* lineItem.product.id *int*
* lineItem.product.sku *string*
* lineItem.product.primaryUnitPrecision.id *int*
* lineItem.product.primaryUnitPrecision.precision *int*
* lineItem.product.primaryUnitPrecision.sell *bool*
* lineItem.product.category.id *int*
* lineItem.product.inventoryLevels **collection**
* lineItem.productUnitCode *string*
* lineItem.quantity *float*
* lineItem.price.value *float*
* lineItem.price.currency *string*
* lineItem.product.unitPrecisions **collection**

To find the whole list of fields available for:

* *lineItem* --- navigate to System > Entities > Entity Management > Order Line Item
* *lineItem.product* --- navigate to System > Entities > Entity Management > Product
* *lineItem.product.productUnit* ---  navigate to System > Entities > Entity Management > Product Unit

More details on the entity fields management are described :ref:`here <admin-guide-manage-entity-fields>`.


lineItems[X].product.unitPrecisions Collection
""""""""""""""""""""""""""""""""""""""""""""""

**Attributes**

  .. note:: Use the items with unitPrecision prefix when processing the unitPrecisions collection using LineItem.product.unitPrecisions.any() and LineItem.product.unitPrecisions.all() expressions. Alternatively, address the item in the collection directly, e.g. LineItem.product.unitPrecisions[1].unit.code.

  - unitPrecision.unit.code *string*
  - unitPrecision.precision *int*
  - unitPrecision.sell *bool*

lineItems[X].product.inventoryLevels Collection
"""""""""""""""""""""""""""""""""""""""""""""""

**Attributes**

  .. note:: Use the items with inventoryLevel prefix when processing the inventoryLevels collection using LineItem.product.inventoryLevels.any() and LineItem.product.inventoryLevels.all() expressions.  Alternatively, address the item in the collection directly, e.g. LineItem.product.inventoryLevels[1].warehouse.id.

  * inventoryLevel.id *int*
  * inventoryLevel.quantity *int*
  * inventoryLevel.productUnitPrecision.unit.code *string*
  * inventoryLevel.productUnitPrecision.precision *int*
  * inventoryLevel.productUnitPrecision.sell *bool*
  * inventoryLevel.warehouse.id *int*
  * inventoryLevel.warehouse.name *string*

To find the whole list of fields available for *inventoryLevel*, navigate to System > Entities > Entity Management > Inventory Level. More details on the entity fields management are described :ref:`here <admin-guide-manage-entity-fields>`.

customer.users Collection
"""""""""""""""""""""""""

**Attributes**

  .. note:: Use the items with user prefix when processing the customer.users collection using customer.users.any() and customer.users.all() expressions.  Alternatively, address the item in the collection directly, e.g. customer.users[1].email.

* user.id *int*
* user.email *string*
* user.firstName *string*
* user.middleName *string*
* user.lastName *string*

customerGroup.customers Collection
""""""""""""""""""""""""""""""""""

**Attributes**

  .. note:: Use the items with user prefix when processing the customerGroup.customers collection using customerGroup.customers.any() and customerGroup.customers.all() expressions.  Alternatively, address the item in the collection directly, e.g. customerGroup.customers[1].name.

* customer.id *int*
* customer.name *string*
* customer.group.id *int*
* customer.group.name *string*

Expression Syntax
^^^^^^^^^^^^^^^^^

You can use the following elements to build the expression that identifies the cases when shipping or payment rule should be applied.

**Supported Data**

* Text enclosed in quotes (') or double quotes (")
* Numbers (e.g. 32)
* Arrays (e.g. [1, 5], and ["Option A", "Option B"])
* Boolean values (true and false)
* null
* Attributes and data structures listed in the `Attributes Supported in Promotion Expressions`_, e.g. subtotal > 100000 or lineItems.all(lineItem.quantity > 1000).

  - Use *lineItems.all(expression)* and *lineItems.any(expression)* to assess the collection of line items (products and their quantity, units, price, weight, and dimensions) in the order, quote or request for quote. Inside the expression, use *lineItem.product.<fieldname>* phrase to access the product field value. Separate the field from the item with a period.
  - Use lineItems.sum(expression) to sum up results of complex calculations that use the collection items and their properties as parameters. For example, you can get a total weight of the order using the following expression: *lineItems.sum(lineItem.weight.value * lineItem.quantity)*.
  - Outside the collection operations, you can assess an element of the array using *item[id].fieldname* phrase (e.g. lineItems[1].product.price > 1000.00). Separate the field from the item with a period.

See more information about using collections in the **Collection Validation** section below.

**Supported operators**

* Arithmetic:

  - add: +
  - subtract: -
  - multiply: *
  - divide: /
  - mod (a remainder of division): %
  - power: **

* Operations with text:

  - concatenate: ~

* Comparison:

  - equal: =
  - not equal: !=
  - less: <
  - more: >
  - less or equal: <=
  - more or equal: >=
  - matches (regexp)
  - in
  - not in

* Logical:

  - and
  - or
  - not
  - ``..`` (range, like in 1..10)


**Collection Validation** with *any (OR)* and *all (AND)* Operations

To validate all items in the collection (e.g. products in the order being submitted), or ensure that at least one value has a particular quality (e.g. it meets bulk quantity requirements), use *items.all(sub-condition)* and *items.any(sub-condition)*  expression phrases. The sub-condition is an expression that applies to every item. Note that it is enclosed in brackets, and no single/double quotes ('/") are used as they are reserved for the text values.

When you are using `all` or `any` method, you provide the named collection of elements (e.g. products) and Oro automatically guesses the name of the single element (e.g. product). It is produced by stripping the trailing 's' for countable nouns and by adding a leading 'Item' the uncountable ones, like in: `milk.all(milkItem.isfresh)`.

The `items.all(nested_expression)` expression is `true` when the nested condition is satisfied for every item in the collection. When an item evaluation results in `false`, the `items.all()` immediately returns `false` without processing the remaining items.

Vise versa, `items.any(nested_expression)` is `true` if a nested expression evaluates to `true` for at least one item. Remaining items are not processed either.


Sample Expression
^^^^^^^^^^^^^^^^^

For example, you need to ensure that all products are available in the requested quantity in the particular warehouse (inventory levels in the warehouse A is greater than the line item quantity in the order).

You can refer to the `Attributes Supported in Promotion Expressions`_ to build the expression.

For expression evaluation, OroCommerce walks through the *lineItems* collection and for every item in the collection it checks that this product is available in the warehouse A in the units that were ordered, that it is enabled for sale from the warehouse A, and that it is in stock in the required quantity.

.. code-block:: none


   lineItems.all(
    lineItem.product.inventoryLevels.any(
        inventoryLevel.warehouse.name = 'Additional Warehouse'
          and
        inventoryLevel.quantity >= lineItem.quantity
          and
        inventoryLevel.productUnitPrecision.unit.code = lineItem.productUnit.code
          and
        inventoryLevel.productUnitPrecision.sell
      )
   )

The `lineItems.all(...)` expression is a loop through the elements of `lineItems` collection. It exposes every element of the collection inside the loop (in round brackets) as a `lineItem`.

In the example, for every line item, the following condition is verified to be true:

.. code-block:: none


    ...

     lineItem.product.inventoryLevels.any(
       inventoryLevel.warehouse.name = 'Additional Warehouse'
         and
       inventoryLevel.quantity >= lineItem.quantity
         and
       inventoryLevel.productUnitPrecision.unit.code = lineItem.productUnit.code
         and
       inventoryLevel.productUnitPrecision.sell
     )

    ...

`inventoryLevels` is another collection being decomposed in the nested loop: `lineItem.product.inventoryLevels.any(..)`

Inside the loop, OroCommerce checks every inventory level to find the one that is related to the warehouse A and verify the remaining conditions to evaluate the quantity is enough, like the following:

`inventoryLevel.productUnitPrecision.unit.code = lineItem.productUnit.code`

.. promotion_expressions_end


.. include:: /include/include-links-user.rst
   :start-after: begin
