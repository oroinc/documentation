.. _user-guide--pricing--auto--expression:

Filtering Expression Syntax
===========================

.. begin

The filtering expression for the product assignment rule and the price calculation condition follow the `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ syntax and may contain the following elements:

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


  .. finish

.. toctree::
   :hidden:

   storage_type
