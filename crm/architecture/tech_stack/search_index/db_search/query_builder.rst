Query Builder
=============

To build search queries, you need to use ``Oro\Bundle\SearchBundle\Query\Query``
and ``Oro\Bundle\SearchBundle\Query\Criteria\Criteria`` classes.

Example:

.. code-block:: none
    :linenos:

    $query = new Query();
    $query
        ->select('sku')
        ->from('oro_search_product');
    $query->getCriteria()
        ->andWhere(Criteria::expr()->eq('text.all_data', 'Functions'))
        ->orWhere(Criteria::expr()->gt('decimal.price', 85));

Syntax of Query builder is close to Doctrine 2.

-  **select()** - accepts a string or array of strings that represent
   field names in the search index. The values of those fields will be
   returned in the *selected\_data* key of the response items. The
   select() parser will also accept SQL fieldname aliasing syntax, for
   example:

.. code-block:: none
    :linenos:

    $query = new Query();
    $query->select('fieldvalue as name');

**NOTE**: If you do not want to overwrite the existing fields, use the
*addSelect()* method.

-  **from()** - takes array or string of entity
   aliases to search from. If the argument was ``*``, then the search will be
   performed for all entities.

As the result of the query, ``Oro\Bundle\SearchBundle\Query\Result`` will be
returned with the information about the search query and result items.
