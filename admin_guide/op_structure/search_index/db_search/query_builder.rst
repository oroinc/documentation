Query Builder
=============

To perform search queries, you need to use the query builder =>
\Oro\Bundle\SearchBundle\Query\Query.

Example:

.. code-block:: none

    $query = (new Query())
            ->select('sku')
            ->from('oro_search_product')
            ->andWhere('all_data', '=', 'Functions', 'text')
            ->orWhere('price', '>', 85, 'decimal');

Syntax of Query builder is close to Doctrine 2.

-  **select()** - accepts a string or array of strings that represent
   field names in the search index. The values of those fields will be
   returned in the *selected\_data* key of the response items. The
   select() parser will also accept SQL fieldname aliasing syntax, for
   example:

.. code-block:: none

    $query = (new Query())
            ->select('fieldvalue as name')

**NOTE**: If you do not want to overwrite the existing fields, use the
*addSelect()* method. \* **from()** - takes array or string of entity
aliases to search from. If the argument was ``*``, then the search will be
performed for all entities.

-  **andWhere()**, **orWhere()** - functions set AND WHERE and OR WHERE
   functions in search request.

   -  First argument - field name to search from. It can be set to ``*``
      for searching by all fields.
   -  Second argument - operators ``<``, ``>``, ``=``, ``!=``, etc. If
      first argument is for text field, this parameter will be ignored.
   -  Third argument - value to search
   -  Fourth argument - field type.

-  **setFirstResult()** - set the first result offset

-  **setMaxResults()** - set max results of records in result.

As the result of the query, ``Oro\Bundle\SearchBundle\Query\Result`` will be
returned with the information about the search query and result items.
