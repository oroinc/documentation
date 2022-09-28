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

OroPlatform CE officially supports only MySQL version 5.1 or higher.

With OroPlatform EE, you can use either MySQL (5.1 or higher) or PostgreSQL (version 9.1 and higher, but PostgreSQL 10 is not currently supported because of |Doctrine Bug|; this may change once the bugfix is out).

Configuration
-------------

Connection
^^^^^^^^^^

Database connection is configured using the following parameters placed in config/parameters.yml:

.. code-block:: text

   database_driver: pdo_pgsql
   database_host: 127.0.0.1
   database_port: null
   database_name: commerce_crm_ee
   database_user: postgres
   database_password: null
   database_server_version: '9.6'

Supported **database_driver** values are *pdo_pgsql* for PostgreSQL and *pdo_mysql* for MySQL.

The **database_server_version** determines the DB engine version used in the application.
This parameter will be mapped to the **server_version** parameter of the Doctrine configuration.
See |Doctrine Configuration Reference| documentation for more information on this parameter.

DBAL and ORM
^^^^^^^^^^^^

You can change the configuration in config.yml. Every registered Oro bundle has a `Resources/config/oro/app.yml` file which is merged with the global *config.yml*. This means that you can extend the system configuration from a particular bundle for all applications without changing the global *config.yml* file.

Doctrine provides a limited set of DQL functions that a developer may use. To extend this list, Oro has its own  |extensions library|. New DQL functions are added to the Doctrine configuration with either the *app.yml* or *config.yml* file placed in the EntityBundle of the Platform project. New functions may be implemented in any bundle and added to its app.yml in the following format:

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

Enabling metadata cache is strongly recommended for the development and production environments to improve performance. Metadata caching in OroPlatform is done with the `doctrine.metadata.cache` service.

.. code-block:: text

   doctrine:
       orm:
           entity_managers:
               default:
                   metadata_cache_driver:
                       type: service
                       id:   doctrine.metadata.cache

Read more on |DoctrineBundle Configuration| for more information.

Scalability and Performance Recommendations
-------------------------------------------

Use database server configuration optimized for the hardware. Note that by default, databases are installed with a configuration applicable for slow hardware with a limited amount of memory, and some options should be changed after installation to get optimal performance.

To choose optimal PostgreSQL configuration parameters, you can use the |PGTune| configuration calculator.

The PGTune calculate configuration for PostgreSQL is based on the maximum performance for a given hardware configuration. However, it is not a silver bullet for the optimization settings of PostgreSQL. Many settings depend not only on the hardware configuration but also on the size of the database, the number of clients, and the complexity of queries. To optimally configure the database, consider all of these parameters.

MySQL configuration can be optimized using |Percona Configuration Wizard|.

Apply Percona best practices to achieve better MySQL database performance and avoid the time, complexity, and risk of customizing the my.cnf configuration on your own. Copy and paste the results of the Percona Configuration Wizard for MySQL into your my.cnf file.

Sometimes OS read/writes can slow down the database server's performance, primarily if located on the same hard drive. Instead, we recommend using a separate hard drive (preferably an SSD) for the database service.

MySQL
^^^^^

MySQL/MariaDB database table can sometimes crash because of an unexpected server shutdown, a sudden file system corruption, or during the copy operation when the database is still in use. You can use an open-source  ‘mysqlcheck‘ tool to automatically check, repair, and optimize databases of all tables in Linux.

.. code-block:: text

   # mysqlcheck -u root -p --auto-repair --check --optimize databasename

You can use the mysqltuner tool to review a MySQL installation quickly and make adjustments to increase performance and stability.

To download and run it, use the following set of commands:

.. code-block:: text

   # wget http://mysqltuner.pl mysqltuner.pl
   # ./mysqltuner.pl

PostgreSQL
^^^^^^^^^^

You can use postgresqltuner.pl`, a script,  to help you analyze a PostgreSQL database.

.. code-block:: text

   # wget https://postgresqltuner.pl postgresqltuner.pl
   # ./postgresqltuner.pl

Enable avtovacuum
~~~~~~~~~~~~~~~~~

PostgreSQL has an optional but highly recommended feature called `autovacuum`, which you can use to automate the execution of the VACUUM and ANALYZE commands. When enabled, autovacuum checks for tables that have had a large number of inserted, updated, or deleted tuples. These checks use the statistics collection facility, so autovacuum cannot be used unless track_counts is set to ``true``. In the default configuration, autovacuuming is enabled, and the related configuration parameters are appropriately set. Regular vacuuming does not take much time and resources, but if it does, please investigate, as it should not be the case.

Developers Recommendations
""""""""""""""""""""""""""

Do not select `All (SELECT *)` columns when only specific fields are required. The fewer columns you ask for, the fewer data must be loaded from the disk when processing your query and fewer data to send over the network. If only columns stored in the index are requested, data will be loaded only from the index without reading data from the table. Follow this recommendation while working with complex queries that return a known set of fields: the repository methods not designed to return entity, datagrid queries, etc.

Add indexes only under the following circumstances:

* When you know how the table will be queried
* When you know that the index field will be part of the where clause
* When a field is highly selectable.

When all the conditions apply, the field makes a good candidate for pre-emptive tuning. Otherwise, do not add indexes for all fields because this will slow down insert/update operations and will require more disk space.

When metadata caching is turned on, any changes to the entity will not be seen by doctrine until cache refresh. Remember to clear the metadata cache any time when metadata is changed.

.. code-block:: bash

   php bin/console doctrine:cache:clear-metadata

Hydration
~~~~~~~~~

Doctrine ORM, like most ORMs, performs a process called Hydration when converting database results into objects. This process usually involves reading a record from a database result and then converting the column values into an object's properties. It may lead to performance degradation when several collections are hydrated in one query. The process of hydration becomes extremely expensive when more than 2 LEFT JOIN operations clauses are part of queries. You can find more details on this topic in the |Doctrine ORM Hydration Performance Optimization| article.
Before any query optimization, first EXPLAIN it on both supported Database platforms and see how RDBMS processes the query. See |Using Explain| and |Explain Output| for more information.

To protect your query by ACL, call `AclHelper:apply` to apply ACL restrictions to a given query.

Exception and Unavailability Handling
-------------------------------------
When the database is unavailable, the application in production mode should show service unavailability or a maintenance page with steps to report an incident.
To handle errors related to the deadlocks or lock wait timeouts, use Doctrine built-in transaction exceptions. All transaction exceptions where retrying makes sense have a marker interface: Doctrine\DBAL\Exception\RetryableException

Logging aspects
---------------

All logs must follow :ref:`Logging Conventions <community--contribute--logging-conventions>`. Logs should not contain sensitive data like credit card numbers, passwords, etc. Enable MySQL Slow query Logs for logging slow queries. This can help to determine issues with the database and help to debug them.

References
----------

* |MySQL Documentation|
* |PostgreSQL Documentation|
* |Doctrine Extensions|
* :ref:`Oro application system requirements <system-requirements>`
* |PGTune - Configuration calculator for PostgreSQL|
* |Percona Configuration Wizard for MySQL| (you might need to sign it to use the wizard)
* |PostgreSQL Performance Optimization|
* |PostgreSQL Tuner|
* |Symfony: DoctrineBundle Configuration|
* :ref:`Logging Conventions <community--contribute--logging-conventions>`


.. include:: /include/include-links-dev.rst
   :start-after: begin