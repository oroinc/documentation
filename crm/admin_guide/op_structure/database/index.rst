.. _op-structure--database:

DataBase System Component
=========================

.. source: wiki 29 Nov 2017

.. contents:: :local:

Overview
--------

A DataBase System component is responsible for interaction with RDBMS. It enables the following capabilities:

* Store data in a persistent storage
* Provide query language to retrieve required data based on the given conditions
* Define database structure and provide a set of tools for migrations

Glossary
--------

* RDBMS (Relational Database Management System) -  is a database management system (DBMS) that is based on the relational model
* ORM (Object relational mapper) - is a technique that lets you query and manipulate data from a database using an object-oriented paradigm
* Doctrine ORM - PHP implementation of ORM
* Doctrine DBAL - database abstraction layer used for database schema introspection, schema management and PDO abstraction
* DQL - proprietary object oriented SQL dialect called Doctrine Query Language implemented in Doctrine ORM

Supported Databases
-------------------

OroPlatform Community Edition (CE) is released as an open-source application and is designed for small organizations. OroPlatform Enterprise Edition (EE) is designed with the scalability and performance in mind.

OroPlatform CE officially supports only MySQL version 5.1 or higher.

With OroPlatform EE, you can use either MySQL (5.1 or higher) or PostgreSQL (version 9.1 and higher, but PostgreSQL 10 is not currently supported because of `Doctrine Bug <https://github.com/doctrine/dbal/issues/2868>`_; this may change once the bugfix is out).

Configuration
-------------

Connection
^^^^^^^^^^

DataBase connection is configured using the following parameters placed in config/parameters.yml:

.. code:: text

   database_driver: pdo_pgsql
   database_host: 127.0.0.1
   database_port: null
   database_name: commerce_crm_ee
   database_user: postgres
   database_password: null

Supported **database_driver** values are *pdo_pgsql* for PostgreSQL and *pdo_mysql* for MySQL.

DBAL and ORM
^^^^^^^^^^^^

The configuration may be changed in config.yml. Every registered Oro bundle has a `Resources/config/oro/app.yml` file which is merged with the global *config.yml*. This means that the system configuration may be extended from a particular bundle for all applications without the need to change the global *config.yml* file.

Doctrine provides a limited set of DQL functions that may be used by a developer. To extend this list, Oro has its own `extensions library <https://github.com/oroinc/doctrine-extensions>`_. New DQL functions are added to the Doctrine configuration with either the *app.yml* or *config.yml* file placed in the EntityBundle of the Platform project. New functions may be implemented in any bundle and added into its app.yml in the following format:

.. code:: text

   doctrine:
       orm:
           dql:
               string_functions:
                   group_concat:   Oro\ORM\Query\AST\Functions\String\GroupConcat

The same file can be used to add new data types, for example:

.. code:: text

   doctrine:
       dbal:
           types:
               duration: Oro\Bundle\EntityBundle\DoctrineExtensions\DBAL\Types\DurationType

Enabling metadata cache is strongly recommended for the development and productions environments to improve performance. Metadata caching in Oro platform is done with the `doctrine.metadata.cache` service.

.. code:: text

   doctrine:
       orm:
           entity_managers:
               default:
                   metadata_cache_driver:
                       type: service
                       id:   doctrine.metadata.cache

More details on DoctrineBundle Configuration may be found `here <https://symfony.com/doc/current/reference/configuration/doctrine.html>`_.

Scalability and Performance Recommendations
-------------------------------------------

Use database server configuration optimized for the hardware. Note that by default databases are installed with a configuration applicable for slow hardware with a limited amount of memory and some options should be changed after installation to get optimal performance.
To choose optimal PostgreSQL configuration parameters, `PGTune <http://pgtune.leopard.in.ua/>`_ configuration calculator may be used. 

`PGTune calculate configuration for PostgreSQL is based on the maximum performance for a given hardware configuration. It is not a silver bullet for the optimization settings of PostgreSQL. Many settings depend not only on the hardware configuration, but also on the size of the database, the number of clients and the complexity of queries. To optimally configure the database, take into account all of these parameters.`

MySQL configuration may be optimized using `Percona Configuration Wizard <https://tools.percona.com/wizard>`_.

`Apply Percona best practices to achieve better MySQL database performance and avoid the time, complexity, and risk of customizing a my.cnf configuration on your own. Simply copy and paste the results of the Percona Configuration Wizard for MySQL into your my.cnf file.`

Sometimes OS read/writes can slow down the performance of the database server, especially if located on the same hard drive. Instead, it is recommended to use separate hard drive (preferably a SSD) for the database service.

MySQL
^^^^^

MySQL/MariaDB database table can sometimes crash because of an unexpected server shut down, a sudden file system corruption, or during the copy operation when the database is still in use. However, there is a free open source tool called ‘mysqlcheck‘, which can automatically check, repair and optimize databases of all tables in Linux.

.. code:: text

   # mysqlcheck -u root -p --auto-repair --check --optimize databasename

Use mysqltuner tool that allows you to review a MySQL installation quickly and make adjustments to increase performance and stability.

To download and run it, use the following set of commands:

.. code:: text

   # wget http://mysqltuner.pl mysqltuner.pl
   # ./mysqltuner.pl

PostgreSQL
^^^^^^^^^^

A `postgresqltuner.pl` is a simple script that helps you analyse a PostgreSQL database. It is inspired by `mysqltuner.pl` discussed above and has the same propose.

.. code:: text

   # wget https://postgresqltuner.pl postgresqltuner.pl
   # ./postgresqltuner.pl

Enable avtovacuum
~~~~~~~~~~~~~~~~~

PostgreSQL has an optional but highly recommended feature called `autovacuum`, whose purpose is to automate the execution of VACUUM and ANALYZE commands. When enabled, autovacuum checks for tables that have had a large number of inserted, updated or deleted tuples. These checks use the statistics collection facility; therefore, autovacuum cannot be used unless track_counts is set to true. In the default configuration, autovacuuming is enabled and the related configuration parameters are appropriately set. Generally, if you think you need to turn regular vacuuming off because it is taking too much time or resources, that means you are not doing it right. 

Developers Recommendations
""""""""""""""""""""""""""

Do not select `All (SELECT *)` columns when only certain fields are required. Broadly speaking, the fewer columns you ask for, the less data must be loaded from disk when processing your query and less data to send over network. If only columns stored in index are requested, data will be loaded only from the index without reading data from the table. This recommendation should be followed while working with complex queries that return a known set of fields: the repository methods that are not designed to return entity, datagrid queries, etc.

Add indexes only under the following circumstances:

* When you know how table will be queried
* When you know that the index field will be a part of the where clause
* When a field is highly selectable.

When all the conditions apply, the field makes a good candidate for pre-emptive tuning. Otherwise do not add indexes for all fields, because this will slow down insert/update operations and will require more disk space.

When metadata caching is turned on than any changes to entity will be not seen by doctrine until cache refresh. Remember to clear metadata cache any time when metadata was changed.

.. code:: text

   # bin/console doctrine:cache:clear-metadata

Hydrations
~~~~~~~~~~

Doctrine ORM, like most ORMs, is performing a process called Hydration when converting database results into objects. This process usually involves reading a record from a database result and then converting the column values into an object's properties. It may lead to performance degradation when several collections are hydrated in one query. The process of hydration becomes extremely expensive when more than 2 LEFT JOIN operations clauses are part of queries. More details on this topic may be found in the `Doctrine ORM Hydration Performance Optimization <https://ocramius.github.io/blog/doctrine-orm-optimization-hydration/>`_ article.
Before any query optimization, first EXPLAIN it on both supported Database platform and see how query is processed by RDBMS. See `Using Explain <https://www.postgresql.org/docs/current/static/using-explain.html>`_ and `Explain Output <https://dev.mysql.com/doc/refman/5.7/en/explain-output.html>`_ for more information.

To protect your query by ACL, call `AclHelper:apply` to apply ACL restrictions to a given query. 

Exception and Unavailability Handling
-------------------------------------
When database in not available, application in production mode should show service unavailability or maintenance page with contact details of a responsible person which may be used to report an incident.
In order to handle errors related to the deadlocks or lock wait timeouts, you can use Doctrine built-in transaction exceptions. All transaction exceptions where retrying makes sense have a marker interface: Doctrine\DBAL\Exception\RetryableException

Logging aspects
---------------

All logs must follow :ref:`Logging Conventions <community--contribute--logging-conventions>`. Logs should not contains sensitive data like credit card numbers, passwords, etc.
Enable MySQL Slow query Logs for logging slow queries. This can help to determine issues with database and help to debug them.

References
----------

* `MySQL Documentation <https://dev.mysql.com/doc/>`_
* `PostgreSQL Documentation <https://www.postgresql.org/docs/>`_
* `Doctrine Extensions <https://github.com/oroinc/doctrine-extensions>`_
* `Oro application system requirements <https://oroinc.com/orocommerce/doc/current/system-requirements>`_
* `PGTune - Configuration calculator for PostgreSQL <http://pgtune.leopard.in.ua/>`_
* `Percona Configuration Wizard for MySQL <https://tools.percona.com/wizard/>`_ (you might need to sign it to use the wizard)
* `PostgreSQL Performance Optimization <https://wiki.postgresql.org/wiki/Performance_Optimization>`_
* `PostgreSQL Tuner <https://github.com/jfcoz/postgresqltuner>`_
* `Symfony: DoctrineBundle Configuration <https://symfony.com/doc/current/reference/configuration/doctrine.html>`_
* `Doctrine ORM Hydration Performance Optimization <https://ocramius.github.io/blog/doctrine-orm-optimization-hydration/>`_
* :ref:`Logging Conventions <community--contribute--logging-conventions>`
* `Using Explain <https://www.postgresql.org/docs/current/static/using-explain.html>`_
* `Explain Output <https://dev.mysql.com/doc/refman/5.7/en/explain-output.html>`_
