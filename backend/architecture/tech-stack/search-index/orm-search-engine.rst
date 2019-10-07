.. _orm_search_engine:

ORM Search Engine
=================

OroSearchBundle provides ORM search engine out of the box. It stores
index data in DB tables and uses fulltext index to perform search.
Bundle supports search index for both **MySQL** and **PostgreSQL** DBMS.
ORM engine is used by default.

Configuration
-------------

ORM engine configuration is stored in
``Oro/Bundle/SearchBundle/Resources/config/oro/search_engine/orm.yml``
and does not require any additional engine parameters.

ORM search engine has a straightforward implementation - it simply
stores index data in appropriate tables: separate tables for ``text``,
``datetime``, ``decimal`` and ``integer`` value, and another table
to store general information. The table that stores text data has
``fulltext`` index.

.. code-block:: none
    :linenos:

    parameters:
        oro_search.engine.class: Oro\Bundle\SearchBundle\Engine\Orm

    services:
        oro_search.search.engine:
            class: %oro_search.engine.class%
            arguments:
                - @doctrine
                - @oro_entity.doctrine_helper
                - @oro_search.mapper
            calls:
                - [setLogQueries, [%oro_search.log_queries%]]

Each supported DBMS has its own driver that knows about specific search
implementation and generates valid SQL.

.. code-block:: none
    :linenos:

    parameters:
        oro_search.drivers:
            pdo_mysql: Oro\Bundle\SearchBundle\Engine\Orm\PdoMysql
            pdo_pgsql: Oro\Bundle\SearchBundle\Engine\Orm\PdoPgsql

Features
--------

Currently, special characters are not supported in the ORM search
engines. Every character that is not a unicode letter or a number is
replaced with a whitespace before the query.

Another feature of ORM engine is fulltext index processing.
Configuration defines fulltext manager
*Oro\\Bundle\\SearchBundle\\Engine\\FulltextIndexManager*
that is used during installation and inside a special listener - it allows the
system to create fulltext indexes bypassing Doctrine processing.

**Note for MySQL driver:** MySQL has a lower limit to the string length
for fulltext index called |ft_min_word_len|, i.e. if a string is
shorter than this limit, the fulltext index will not be used. It is
recommended to |change this value to 3|.


.. include:: /include/include-links.rst
   :start-after: begin
