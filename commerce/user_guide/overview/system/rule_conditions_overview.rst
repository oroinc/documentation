:orphan:

.. begin

Filtering Expression Syntax
---------------------------

* Entity properties, that may vary depending on the context (see `Shipping Rules`_ and `Payment Rules`_ sections below for details).

.. note::
   To keep the filter behavior predictable, Oro Commerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of “one-to-many” relation (including the custom ones).
   When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”).
   Generally, any product, price and category entity attribute is accessible by field name.

* **Operators:** +, -,  *,  / , %, **, ==, ===, !=, !==, <, >, <=, >=, matches (regexp), and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Collections:** You can refer to the particular item in the collection using collection[id] expression.

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Shipping Rules
~~~~~~~~~~~~~~

In the :ref:`shipping rule <sys--shipping-rules>` details, in the *Condition* section, you may define the condition that limits the quotes and orders this shipping rule applies to.

The condition extends the `Symfony Expression Language <https://symfony.com/doc/current/components/expression_language/introduction.html>`_ syntax and may contain the following elements:
* Entity properties:


* **Operators:** +, -,  *,  / , %, **,, !=, <, >, <=, >=, matches (regexp), and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.


Payment Rules
~~~~~~~~~~~~~

In the :ref:`payment rule <sys--payment-rules>` details, in the *Expression* section, you may define the condition that limits the quotes and orders this payment rule applies to.

The condition follows the `Symfony Expression Language <https://symfony.com/doc/current/components/expression_language/introduction.html>`_ syntax and may contain the following elements:
* Entity properties:
Prices, product, unit, quantity

* **Operators:** +, -,  *,  / , %, **, ==, ===, !=, !==, <, >, <=, >=, matches (regexp), and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

.. Prices, product, unit, quantity


.. virtual fields and relations (category, inventory level)

.. https://github.com/laboro/dev/blob/52428e32187ce31dcd2c59e30a1bfe38ba8301c0/package/platform/src/Oro/Component/ExpressionLanguage/README.md#L4-L4
.. https://github.com/laboro/dev/blob/d0cd3b79e45adb52a378dc87f21ddb568d04bca5/package/commerce/src/Oro/Bundle/ShippingBundle/Context/ShippingContextInterface.php#L30-L30
.. https://github.com/laboro/dev/blob/8695f4ebf7407cc65f3c270cc880f7d6f55ffc16/package/commerce/src/Oro/Bundle/PaymentBundle/Context/PaymentContextInterface.php#L15-L15




