.. _bundle-docs-commerce-product-bundle-formatting:

Product Unit Formatting
=======================

Format Source
-------------

Product Unit formats may be found in ``messages.<locale>.yml``.

Here is an example of format configuration for en_US:

.. code-block:: yaml
   :linenos:

    product_unit.kg:
        label:
            full: kilogramm
            short: kg
        value:
            full: '{0} none|{1} one kilogram|]1,Inf] %count% kilograms'
            short: '{0} none|{1} one kg|]1,Inf] %count% kg'

Possible format placeholders:

* *count* - product unit value

PHP Product Unit Value Formatter
--------------------------------

**Class:** Oro\\Bundle\\ProductBundle\\Formatter\\UnitValueFormatter

**Service id:** oro_product.formatter.unit_value

Formats product unit value based on the given product unit.

Methods and Examples of Usage
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

format
~~~~~~

string *public* *format*(float|integer *value*, ProductUnit *unit*)

This method can be used to format the value that is of float or integer type.

To format value, *unit* parameter must be passed and it must be instance of ProductUnit class.

Format:

.. code-block:: yaml
   :linenos:

    product_unit.kg:
        label:
            full: kilogramm
            short: kg
        value:
            full: '{0} none|{1} one kilogram|]1,Inf] %count% kilograms'
            short: '{0} none|{1} one kg|]1,Inf] %count% kg'

Code:

.. code-block:: php
   :linenos:

    // $unit implements ProductUnit
    $unit->setCode('kg');

    $formatter = $this->container->get('oro_product.formatter.unit_value');
    echo $formatter->format(5, $unit);

Outputs:

.. code-block:: none

   5 kilograms

formatShort
~~~~~~~~~~~

string *public* *formatShort*(float|integer *value*, ProductUnit *unit*)

This method can be used to format a value that is of float or integer type.

To format value, *unit* parameters must be passed and it must be instance of ProductUnit class.

Format:

.. code-block:: yaml
   :linenos:

    product_unit.kg:
        label:
            full: kilogram
            short: kg
        value:
            full: '{0} none|{1} one kilogram|]1,Inf] %count% kilograms'
            short: '{0} none|{1} one kg|]1,Inf] %count% kg'

Code:

.. code-block:: php
   :linenos:

    // $unit implements ProductUnit
    $unit->setCode('kg');

    $formatter = $this->container->get('oro_product.formatter.unit_value');
    echo $formatter->formatShort(5, $unit);


Outputs:

.. code-block:: none

   5 kg


formatCode
~~~~~~~~~~

string *public* *formatCode*(float|integer *value*, string *unitCode*, bool *isShort* = false)

This method can be used to format a value that is of float or integer type, in full or short form, based on specified
the product unit code.

Format:

.. code-block:: yaml
   :linenos:

    product_unit.kg:
        label:
            full: kilogram
            short: kg
        value:
            full: '{0} none|{1} one kilogram|]1,Inf] %count% kilograms'
            short: '{0} none|{1} one kg|]1,Inf] %count% kg'

Code:

.. code-block:: php
   :linenos:

    $formatter = $this->container->get('oro_product.formatter.unit_value');
    echo $formatter->formatCode(5, 'kg');

Outputs:

.. code-block:: none

   5 kilograms

Twig
----

Filters
^^^^^^^

* **oro_format_product_unit_value**

  This filter uses the *format* method from the product unit value formatter, and has the same logic.

  .. code-block:: none

     {{ value|oro_format_product_unit_value(unit) }}

* **oro_format_short_product_unit_value**

  This filter uses the *formatShort* method from the product unit value formatter, and has the same logic.

  .. code-block:: none

      {{ value|oro_format_short_product_unit_value(unit) }}

* **oro_format_product_unit_code**

  This filter uses the *formatCode* method from the product unit value formatter, and has the same logic.

  .. code-block:: none

      {{ value|oro_format_product_unit_code(unitCode, isShort) }}

* **oro_format_product_unit_label**

  This filter uses the *format* method from the product unit label formatter, and has the same logic.

  .. code-block:: none

      {{ value|oro_format_product_unit_label(code) }}

* **oro_format_short_product_unit_label**

  This filter is an alias of *oro_format_product_unit_label* with pre-specified argument *isShort* set to `true`.

  .. code-block:: none

      {{ value|oro_format_short_product_unit_label(code) }}

PHP Product Unit Label Formatter
--------------------------------

**Class:** Oro\\Bundle\\ProductBundle\\Formatter\\UnitLabelFormatter

**Service id:** oro_product.formatter.unit_label

Formats product unit label.

Methods and Examples of Usage
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

format
~~~~~~

string *public* *format*(string *code*, bool *isShort* = false, bool *isPlural* = false)

This method can be used to format product unit label in either full or short form, and in single or plural form.

Code:

.. code-block:: php
   :linenos:

    $formatter = $this->container->get('oro_product.formatter.unit_label');
    echo $formatter->format('item', false, true);

Outputs:

.. code-block:: none

   items

formatChoices
~~~~~~~~~~~~~

string *public* *formatChoices*(array *units*, bool *isShort* = false, bool *isPlural* = false)

This method can be used to get the choices array of product units codes and corresponding labels out of ProductUnit
objects. You can can choose either full or short form, and single or plural form.

Code:

.. code-block:: php
   :linenos:

    // $unitKg implements ProductUnit
    $unitKg->setCode('kg');

    // $unitItem implements ProductUnit
    $unitItem->setCode('item');

    $formatter = $this->container->get('oro_product.formatter.unit_label');
    var_dump($formatter->formatChoices([$unitKg, $unitItem], false, true));

Outputs:

.. code-block:: none

   array(2) {
     'kg' => string(9) "kilograms",
     'item' => string(5) "items",
   }




