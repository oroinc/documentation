.. _advanced-search-api:

API Advanced Search
===================

REST and SOAP APIs allow to create advanced search queries.

Parameters for APIs requests:

-  **query** - search string

REST API url: http://domail.com/api/rest/latest/search/advanced

SOAP function name: advancedSearch

REST API work with get request only.

Result
======

Request returns an array with data:

-  **records\_count** - the total number of results (without ``offset``
   and ``max_results``) parameters
-  **count** - count of records in the current request
-  **data** - array with data. Data consists of the following values:

   -  **entity\_name** - class name of entity
   -  **record\_id** - id of record from this entity
   -  **record\_string** - the title of this record
   -  **record\_url** - the given URL for this record
   -  **selected\_data** - data from fields that have been explicitly
      selected in the select clause (optional)

Query Language
==============

Keywords
--------

select
~~~~~~

Includes field values, taken from the search index, as an additional
"selected\_data" section in the search result items. You can select one
or more fields to be attached to search results. The name of the field
should consist the type prefix, otherwise the default ``text`` type will
be used.

.. code-block:: none

    select text.field_name
    select (text.first_field_name, text.second_field_name)

You can use fieldname aliasing, as known in SQL, for example:

.. code-block:: none

    select text.field_1 as name, text.field_2 as author

You can use fieldname aliasing, as known in SQL, for example:

.. code-block:: none

    select (text.field_1 as name, text.field_2 as author)

Note that parentheses are mandatory.

from
~~~~

A list of entity aliases to search from. It can be one alias or group.
Examples:

.. code-block:: none

    from one_alias
    from (first_alias, second_alias)

where
~~~~~

The ``where`` clause defines the search parameters.

and, or
~~~~~~~

``And`` and ``or`` operators are used to combine multiple clauses, allowing you to refine your search.

Syntax:

.. code-block:: none

    and field_type field_name operator value
    or field_type field_name operator value

If the field type is not set, then text field type will be used.

offset
~~~~~~

The offset clause allows to set the offset of the first result.

max\_results
~~~~~~~~~~~~

The set results count for the query.

order\_by
~~~~~~~~~

The ``order_by`` clause allows to sort results in ascending or descending order.

Syntax:

.. code-block:: none

    order_by field_type field_name direction

If the field type is set, the text field will be assigned. Direction -
``ASC``, ``DESC``. If the direction is not assigned, the
``ASC`` direction will be used.

Field Types
-----------

User should specify field type in query string. By default, if type is
not set, it will be used text type. Supported field types: \* **text**
\* **integer** \* **decimal** \* **datetime**

Operators
---------

Different field types support different operators in the ``where`` block.

For String Fields
~~~~~~~~~~~~~~~~~

-  **~ (CONTAINS)** - operator ``~`` is used for set text field value.
   If search value is string, it must be quoted. Examples:

   .. code-block:: none

       name ~ value
       name ~ "string value"

-  **!~ (NOT CONTAINS)** - operator ``!~`` is used for search strings
   without value. If the search value is a string, it must be quoted.
   Examples:

   .. code-block:: none

       name !~ value
       name !~ "string value"

-  **like** - operator ``like`` is used to finding records with a
   specified substring in any position (``LIKE %value%`` statement
   behaviour). If the search value is a multi-word string that contains
   whitespaces, it should be enclosed in quotes. Examples:

   .. code-block:: none

       name like value
       name like "string value"

-  **notlike** - operator ``notlike`` is used to find records
   without a specified substring in any position (``NOT LIKE %value%``
   statement behaviour). If the search value is a multi-word string that
   contains whitespaces, it should be enclosed in quotes. Examples:

   .. code-block:: none

       name notlike value
       name notlike "string value"

For Numeric Fields
~~~~~~~~~~~~~~~~~~

-  **= (EQUALS)** - operator ``=`` is used to search for records where the
   field value matches the specified value. Examples:

   .. code-block:: none

       integer count = 100
       decimal price = 12.5
       datetime create_date = "2013-01-01 00:00:00"

-  **!= (NOT EQUALS)** - operator ``!=`` is used to search for records
   where the field value does not match the specified value. Examples:

   .. code-block:: none

       integer count != 5
       decimal price != 45
       datetime create_date != "2012-01-01 00:00:00"

-  **>, <, <=, >=** - Operators are used to search for the records where the field value is ``greater``, ``less``,
   ``less than or equals`` or ``greater than or equals`` of the
   specified value. Examples:

   .. code-block:: none

       integer count >= 5
       decimal price < 45
       datetime create_date > "2012-01-01 00:00:00"

-  **in** - operator ``in`` is used to search for the records where the value is in
   the specified set of data. Examples:

   .. code-block:: none

       integer count in (5, 10, 15, 20)
       decimal price in (12.2, 55.25)

-  **!in** - operator ``!in`` is used to search for records where the field value is not
   in the specified set of data. Examples:

   .. code-block:: none

       integer count !in (1, 3, 5)
       decimal price !in (2.1, 55, 45.4)

Query Brackets
~~~~~~~~~~~~~~

User can combined operators in the search query with brackets.

Examples:

.. code-block:: none

    from oro_test where (owner ~ john and (integer count > 10 or float price = 10)) or (owner ~ mary and (integer count > 5 or float price = 150))

Query Examples
--------------

-  Search by demo products where the name contains the ``opportunity`` string
   and where the price is greater than ``100``.

   .. code-block:: none

       from demo_product where name ~ opportunity and double price > 100

-  Search and return entity data plus the name and the description of demo
   products.

   .. code-block:: none

       select (name, description) from demo_product

-  Search by all entities where the integer field count is not equal ``10``.

   .. code-block:: none

       integer count != 10

-  Search by all entities where text field ``all_text`` does not contain the
   ``opportunity`` string.

   .. code-block:: none

       all_text !~ "opportunity"

-  Select ``10`` results from the ``demo_products`` and ``demo_categories``
   entities where the text field description contains ``test``, order
   ``ASC`` by text field name and offset first result to ``5``.

   .. code-block:: none

       from (demo_products, demo_categories) where description ~ test order_by name offset 5 max_results 10