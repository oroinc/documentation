.. _op-structure--database:

Database
========

A Database System component is responsible for interaction with RDBMS. It enables the following capabilities:

* Store data in a persistent storage
* Provide query language to retrieve required data based on the given conditions
* Define database structure and provide a set of tools for migrations

Terminology
-----------

* RDBMS (Relational Database Management System) - is a database management system (DBMS) that is based on the relational model
* ORM (object-relational mapper) - is a technique that lets you query and manipulate data from a database using an object-oriented paradigm
* Doctrine ORM - PHP implementation of ORM
* Doctrine DBAL - database abstraction layer used for database schema introspection, schema management, and PDO abstraction
* DQL - proprietary object-oriented SQL dialect called Doctrine Query Language implemented in Doctrine ORM

Supported Databases
-------------------

OroPlatform Community Edition (CE) is an open-source application designed for small organizations. OroPlatform Enterprise Edition (EE) is designed with scalability and performance in mind.

With OroPlatform CE or EE, you can use PostgreSQL 15.1.

Configuration
-------------

Connection
^^^^^^^^^^

Database connection is configured using the following environment variable:

.. code-block:: text

   ORO_DB_DSN=postgresql://postgres@127.0.0.1/commerce_crm_ee?serverVersion=13

This parameter maps to the **url** parameter of the Doctrine configuration.
For more information on this parameter, see the |Doctrine Configuration Reference| documentation.
For the format, see the |PostgreSQL Connection URI Reference| documentation.

DBAL and ORM
^^^^^^^^^^^^

You can change the configuration in config.yml. Every registered Oro bundle has a `Resources/config/oro/app.yml` file that is merged with the global *config.yml*. So you can extend the system configuration from a particular bundle for all applications without changing the global *config.yml* file.

Doctrine provides a limited set of DQL functions that a developer may use. To extend this list, Oro has its own |extensions library|. Add new DQL functions to the Doctrine configuration through the *app.yml* or *config.yml* file placed in the EntityBundle of the Platform project. You can implement new functions in any bundle and add them to its app.yml in the following format:

.. code-block:: text

   doctrine:
       orm:
           dql:
               string_functions:
                   group_concat:   Oro\ORM\Query\AST\Functions\String\GroupConcat

You can use the same file to add new data types, for example:

.. code-block:: text

   doctrine:
       dbal:
           types:
               duration: Oro\Bundle\EntityBundle\DoctrineExtensions\DBAL\Types\DurationType

We strongly recommend enabling the metadata cache in the development and production environments to improve performance. OroPlatform handles metadata caching with the `doctrine.metadata.cache` service.

.. code-block:: text

   doctrine:
       orm:
           entity_managers:
               default:
                   metadata_cache_driver:
                       type: service
                       id:   doctrine.metadata.cache

For more information, see |DoctrineBundle Configuration|.

Scalability and Performance Recommendations
-------------------------------------------

Use a database server configuration optimized for the hardware. By default, databases are installed with a configuration suited to slow hardware with limited memory, so change some options after installation to get optimal performance.

To choose optimal PostgreSQL configuration parameters, use the |PGTune| configuration calculator.

PGTune calculates a PostgreSQL configuration based on the maximum performance for a given hardware configuration. However, it is not a silver bullet for PostgreSQL optimization. Many settings depend not only on the hardware configuration but also on the size of the database, the number of clients, and the complexity of queries. Consider all of these parameters to configure the database optimally.

OS reads and writes can slow down the database server, especially when located on the same hard drive. We recommend using a separate hard drive (preferably an SSD) for the database service.



PostgreSQL
^^^^^^^^^^

You can use the `postgresqltuner.pl` script to help you analyze a PostgreSQL database.

.. code-block:: text

   # wget https://postgresqltuner.pl postgresqltuner.pl
   # ./postgresqltuner.pl

Enable autovacuum
~~~~~~~~~~~~~~~~~

PostgreSQL has an optional but highly recommended feature called `autovacuum` that automates the execution of the VACUUM and ANALYZE commands. When enabled, autovacuum checks for tables that have had a large number of inserted, updated, or deleted tuples.

These checks use the statistics collection facility, so autovacuum requires track_counts to be set to ``true``. The default configuration enables autovacuuming and sets the related parameters appropriately.

Regular vacuuming does not take much time or resources. If it does, investigate, as this should not be the case.

Developers Recommendations
""""""""""""""""""""""""""

Do not select `All (SELECT *)` columns when only specific fields are required. The fewer columns you ask for, the less data must be loaded from the disk when processing your query and the less data to send over the network. If you request only columns stored in the index, data loads from the index without reading the table. Follow this recommendation when working with complex queries that return a known set of fields, such as repository methods not designed to return an entity, datagrid queries, and similar.

Add indexes only under the following circumstances:

* When you know how the table will be queried
* When you know that the index field will be part of the where clause
* When a field is highly selectable.

When all the conditions apply, the field makes a good candidate for pre-emptive tuning. Otherwise, do not add indexes for all fields because this will slow down insert/update operations and will require more disk space.

When metadata caching is turned on, Doctrine does not see changes to the entity until the cache refreshes. Clear the metadata cache whenever metadata changes.

.. code-block:: bash

   php bin/console doctrine:cache:clear-metadata

Hydration
~~~~~~~~~

Doctrine ORM, like most ORMs, performs a process called Hydration when converting database results into objects. This process usually reads a record from a database result and then converts the column values into an object's properties. It may degrade performance when several collections are hydrated in one query, and it becomes extremely expensive when queries contain more than 2 LEFT JOIN clauses. For more details, see the |Doctrine ORM Hydration Performance Optimization| article.

Before any query optimization, first EXPLAIN the query on both supported Database platforms to see how the RDBMS processes it. For more information, see |Using Explain| and |Explain Output|.

To protect your query by ACL, call `AclHelper:apply` to apply ACL restrictions to a given query.

Exception and Unavailability Handling
-------------------------------------
When the database is unavailable, the application in production mode should show service unavailability or a maintenance page with steps to report an incident.

To handle errors related to deadlocks or lock wait timeouts, use Doctrine built-in transaction exceptions. All transaction exceptions where retrying makes sense have a marker interface: Doctrine\DBAL\Exception\RetryableException

Logging aspects
---------------

All logs must follow :ref:`Logging Conventions <community--contribute--logging-conventions>`. Logs should not contain sensitive data such as credit card numbers, passwords, and so on.

Enable PostgreSQL Slow query Logs to log slow queries. This can help you identify and debug database issues.

References
----------

* |PostgreSQL Documentation|
* |Doctrine Extensions|
* :ref:`Oro application system requirements <system-requirements>`
* |PGTune - Configuration calculator for PostgreSQL|
* |Percona Distribution for PostgreSQL|
* |PostgreSQL Performance Optimization|
* |PostgreSQL Tuner|
* |Symfony: DoctrineBundle Configuration|
* :ref:`Logging Conventions <community--contribute--logging-conventions>`


.. include:: /include/include-links-dev.rst
   :start-after: begin
