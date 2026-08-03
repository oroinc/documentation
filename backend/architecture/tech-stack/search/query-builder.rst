.. _search-bundle-query-builder:

Query Builder
=============

To perform search queries, use the query builder ``\Oro\Bundle\SearchBundle\Query\Query``.

Example:

.. code-block:: none

    $query = (new Query())
            ->select('subject')
            ->from('acme_demo_question')
            ->andWhere('priority_id', '=', 1', 'integer')
            ->orWhere('priority_id', '>', 100, 'integer');

The syntax of Query builder is close to Doctrine 2.

-  **select()** --- accepts a string or array of strings representing field names in the search index. The values of those fields will be returned in the *selected\_data* key of the response items. The select() parser will also accept SQL field name aliasing syntax, for example:

.. code-block:: none

    $query = (new Query())
            ->select('fieldvalue as name')

**NOTE**: If you do not want to overwrite the existing fields, use the *addSelect()* method.

-  **from()** --- takes an array or string of entity aliases to search from. If the argument is ``*``, the search will be performed for all entities.

-  **andWhere()**, **orWhere()** --- set the AND WHERE and OR WHERE conditions in the search request.

   -  First argument --- field name to search from. It can be set to ``*`` for searching by all fields.
   -  Second argument --- operators ``<``, ``>``, ``=``, ``!=``, etc. This parameter will be ignored if the first argument is for the text field.
   -  Third argument --- value to search
   -  Fourth argument --- field type.

-  **setFirstResult()** --- set the first result offset

-  **setMaxResults()** --- set max results of records in result.

The query returns ``Oro\Bundle\SearchBundle\Query\Result``, which contains information about the search query and result items.
