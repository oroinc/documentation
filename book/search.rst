.. index::
    single: Search

Dealing with the Search Index
=============================

As a part of OroPlatform, the `SearchBundle`_ allows you to create an advanced
search index for mapped objects and to perform advanced queries on the indexed
data.

Configuration
-------------

Database Setup
~~~~~~~~~~~~~~

Common database management systems like MySQL or Postgres offer additional
indexes for fulltext searches. To initialize the advanced database index,
run the ``oro:search:create-index`` command:

.. code-block:: bash

    $ php ./app/console oro:search:create-index

.. tip::

    By default, MySQL limits the fulltext index to words with a minimal length
    of four characters. It is recommended to allow words with a length of
    three characters to be included in the index. Decrease the value of the
    `ft_min_word_len`_ option to ``3``. You can find more details in the
    `MySQL fulltext search documentation`_.

.. _item-container-template-config-option:

Configuration Options
~~~~~~~~~~~~~~~~~~~~~

The configuration of the SearchBundle is driven by three configuration options:

``engine``
    The indexing engine to be used. Currently, only the ``orm`` engine is
    supported by the SearchBundle.

``entities_config``
    Configuration of entity properties to be indexed (read
    :ref:`the following section <indexing-entities>` for a detailed description
    of the config format).

``item_container_template``
    The default template used to display an item in the search results list
    (``OroSearchBundle:Datagrid:itemContainer.html.twig`` by default).

.. _indexing-entities:

Indexing Entities
-----------------

Each time an entity is updated, the changed data needs to be persisted into
the search index. The mapping of your entity fields to the search index can
be configured either globally (under the ``oro_search`` key) or in a config
file named ``search.yml`` which must be located in the bundle's ``Resources/config/oro``
directory. Such a file would then look something like this:

.. code-block:: yaml
    :linenos:
    search:
        Acme\DemoBundle\Entity\Product:
            alias: demo_product
            label: Demo products
            route:
                name: acme_demo_search_product
                parameters:
                    id: id
            title_fields: [name]
            fields:
                -
                    name: name
                    target_type: text
                -
                    name: description
                    target_type: text
                    target_fields: [description, another_index_name]
                -
                    name: manufacturer
                    relation_type: many-to-one
                    relation_fields:
                        -
                            name: name
                            target_type: text
                            target_fields: [manufacturer, all_data]
                        -
                            name: id
                            target_type: integer
                            target_fields: [manufacturer]
                -
                    name: categories
                    relation_type: many-to-many
                    relation_fields:
                        -
                            name: name
                            target_type: text
                            target_fields: [all_data]

You can use the following options to configure the entity's search index
mapping:

``search_template``
    The template to use for the current entity when the search result page is
    rendered. This is only necessary if the global template should not be used.
    (see the :ref:`available configuration options <item-container-template-config-option>`).

``label``
    A label that is displayed with each search result for the current entity
    type

``route``
    The route used to display the detailed search result:

    ``name``
        The route's name

    ``parameters``
        Optional route parameters

``alias``
    Alias which can be used to reference the current entity in an
    :ref:`advanced search <advanced-search-api>`

``fields``
    Fields to include in the search index:

    ``name``
        The field's (property's) name

    ``target_type``
        The virtual form type (supported values are ``text``, ``integer``,
            ``double`` and ``datetime``)

    ``target_fields``
       A list of virtual fields

    ``relation_type``
        Indicates a relation to another entity (one of ``one-to-one``, ``many-to-many``,
            ``one-to-many``, ``many-to-one``)

    ``relation_fields``
        List of fields of the related entity that should be included in the
            search index.

Searching
---------

You can search in the index in two different ways:

1. Run queries locally using the Query Builder;

2. Send simple or advanced REST or SOAP requests to the search API.

The Query Builder
~~~~~~~~~~~~~~~~~

The syntax of the search query builder is very similar to the Doctrine query
builder:

.. code-block:: php
    :linenos:

    $container = ...; // the Symfony service container
    $indexer = $container->get('oro_search.index');
    $query = $indexer
        ->select(['text.name', 'text.description', 'integer.sku'])
        ->from('oro_search_product')
        ->andWhere('all_data', '=', 'Functions', 'text')
        ->orWhere('price', '>', 85, 'decimal');

The query builder offers several methods to modify the generated search:

``select``
    Specify the values to retrieve from search indexes. Expects for a string
    or array of field names, with type prefix. If the type prefix is not provided,
    default type of ``text`` will be used.

``from``
    One entity or an array of entity aliases to search in (the special ``*`` can
    be used to search in all entities).

``andWhere``, ``orWhere``
    Add ``and`` or ``or`` where clauses to the search query. Expects four
    arguments:

    * The field to check

    * The comparison operator (``<``, ``>``, ``=``, ``!=``, etc.)

    * The value to search for

    * The field type

``addSelect``
    Add another field name to gather the data for from the search indexes.
    If no type prefix is specified, the default ``text`` type will be used.

``setOrderBy``
    Field and direction to order the search result by. By default, search
    results are sorted by relevance.

``setFirstResult``
    Changes the search result offset (useful for pagination).

``setMaxResults``
    The maximum number of search results returned.

The result of such a query is a `Result object`_. It contains the original
search request, the search results and the number of records returned.

The Search API
~~~~~~~~~~~~~~

You can query the search index remotely in two different ways: send simple
queries which query all fields of all entities, or use a powerful query language
to describe more precise search queries.

Both APIs return a data object with three attributes:

``records_count``
    The total number of results (``max_results`` and ``offset`` are not being
    taken into account)

``count``
    Number of returned search results (less than or equal to ``max_results``)

``data``
    An array of search results. Each result is an object containing the following
    data:

    ``entity_name``
        The result's entity class name

    ``record_id``
        The record's id

    ``record_string``
        The record's title

The simple Search API
.....................

The simple search API can be used to remotely search in all text fields of
all entities. It's driven by three parameters describing a query:

``search``
    The string to search for

``offset``
    The result offset

``max_results``
    The maximum number of search results being returned

The endpoint of the simple REST search API is described by the ``oro_api_get_search``
route. Its path defaults to ``/api/rest/{version}/search.{_format}``. Valid
formats are ``json``and ``html`` with ``json`` being the default format and ``latest``
being the default version. The SOAP function name is ``search``.

.. _advanced-search-api:

The advanced Search API
.......................

Instead of searching in all fields of all entities, you can use the advanced
search API to create your own remote search queries. Each query is passed
as the ``query`` parameter. It takes the following form:
``[from <entity>] [conditions] [order_by field_type field_name direction] [offset <offset> max_results <max_results>]``:

* You can query one ore more entities at the same time:

    .. code-block:: text

        from one_alias
        from (first_alias, second_alias)

  If you omit this part, all entities will be searched.

* A condition is of the form ``field_type field_name operator value``.
  Several conditions can be separated using the ``and`` or the ``or`` keyword.

  The field type has to be one of ``text``, ``integer``, ``decimal``, ``datetime``.

  Valid operators are:

  * ``~``: contains (this operator can only be used on string types)

  * ``!~``: does not contain (this operator can only be used on string types)

  * ``=``: equals (this operator cannot be used on string types)

  * ``!=``: not equals (this operator cannot be used on string types)

  * ``>``: greater than (this operator cannot be used on string types)

  * ``<``: less than (this operator cannot be used on string types)

  * ``<=``: less than or equals (this operator cannot be used on string types)

  * ``>=``: greater than or equals (this operator cannot be used on string
    types)

  * ``in``: to filter for records where a field is in a given set of data
    (this operator cannot be used on string types):

    .. code-block:: text

        integer count in (5, 10, 15, 20)
        decimal price in (12.2, 55.25)

  * ``!in``: to filter for records where a field is not in a given set of
    data (this operator cannot be used on string types):

    .. code-block:: text

        integer count !in (1, 3, 5)
        decimal price !in (2.1, 55, 45.4)

**Examples**

* Search for products where the name contains the string *samsung* and where
  the price is greater than 100:

  .. code-block:: text

      from demo_product where name ~ samsung and double price > 100

* Search for products where the current count is not equal to 10:

  .. code-block:: text

      from demo_product where integer count != 10

* Search all entities where the name doesn't contain the string *test string*:

  .. code-block:: text

      where name !~ "test string"

* Select 10 records from products and categories where the description contains
  the string *test* starting with record 5 and order it by their name attribute:

  .. code-block:: text

      from (demo_products, demo_categories) where description ~ test order_by name offset 5 max_results 10

The endpoint of the advanced REST search API is described by the ``oro_api_get_search_advanced``
route. Its path defaults to ``/api/rest/{version}/search/advanced.{_format}``. Valid
formats are ``json``and ``html`` with ``json`` being the default format and ``latest``
being the default version. The SOAP function name is ``advancedSearch``.

.. _`SearchBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/SearchBundle
.. _`ft_min_word_len`: http://dev.mysql.com/doc/refman/5.6/en/server-system-variables.html#sysvar_ft_min_word_len
.. _`MySQL fulltext search documentation`: http://dev.mysql.com/doc/refman/5.6/en/fulltext-fine-tuning.html
.. _`Result object`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/SearchBundle/Query/Result.php
