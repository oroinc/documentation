:orphan:

.. _user-guide--pricing--auto--expression:

Filtering Expression Syntax
===========================

.. begin

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
  
  .. finish