.. _dev-guide-system-database:

Database and RDBMS
==================

.. source: https://magecore.atlassian.net/wiki/spaces/BAP/pages/173502254/DataBase+System+Component

Oro application uses `RDBMS <https://ru.bmstu.wiki/RDBMS_(Relational_Database_Management_System)>`_ to store application data and uses `Doctrine <https://www.doctrine-project.org/>`_ to interact with the database.
The Doctrine capabilities are extended with additional `DBAL <https://www.doctrine-project.org/projects/dbal.html>`_ functions and types in the `Oro Doctrine Extensions <https://github.com/oroinc/doctrine-extensions>`_ library.

Oro **Community Edition (CE)** applications officially support only **MySQL (5.7 or higher)**.

With Oro **Enterprise Edition (EE)** applications, you can use either **MySQL (5.7 or higher)** or **PostgreSQL (9.6 and higher)**.

.. note:: PostgreSQL v.10 is not currently supported in Oro EE applications because of a `Doctrine Bug <https://github.com/doctrine/dbal/issues/2868>`_. This may change once the bugfix is out.

.. contents:: :local:
    :depth: 2

Setup and Configuration
-----------------------

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

The configuration may be changed in config.yml. Every registered Oro bundle has a `Resources/config/oro/app.yml` file which is merged with the global *config.yml*. This means that system configuration may be extended from a particular bundle for all applications without the need to change the global *config.yml* file.

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

More details on DoctrineBundle configuration are available `in the Doctrine Configuration article on Symfony website <https://symfony.com/doc/current/reference/configuration/doctrine.html>`_.

Scalability and Performance Recommendations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: It is recommended to use a **separate hard drive (preferably a SSD)** for the database server.

By default, databases are installed with a configuration applicable to slow hardware with a limited amount of memory and some options **should be changed** after installation for optimal performance.

MySQL
~~~~~

* MySQL **configuration** can be optimized using `Percona Configuration Wizard <https://tools.percona.com/wizard>`_.

  `Apply Percona's best practices to achieve better MySQL database performance and avoid the complexity and risks of customizing my.cnf configuration on your own. For this, copy and paste the results of the Percona Configuration Wizard for MySQL into your *my.cnf* file.`

* MySQL/MariaDB database table can sometimes crash because of an unexpected server shutdown, a sudden file system corruption, or during the copy operation when the database is still in use. However, you can use a free open source tool called **mysqlcheck** which can automatically check, repair and optimize databases of all tables in Linux.

  .. code:: text

     mysqlcheck -u root -p --auto-repair --check --optimize databasename

* Use **mysqltuner** tool to review MySQL installation quickly and make adjustments to increase performance and stability.

  To download and run it, use the following set of commands:

  .. code:: text

     wget http://mysqltuner.pl mysqltuner.pl
     ./mysqltuner.pl

PostgreSQL
~~~~~~~~~~

* To choose optimal PostgreSQL **configuration parameters**, you can use `PGTune <http://pgtune.leopard.in.ua/>`_ configuration calculator. 

  `PGTune calculates the configuration for PostgreSQL following the maximum performance for a given hardware configuration.`

  `Many settings depend not only on the hardware configuration, but also on the size of the database, the number of clients and the complexity of queries. To achieve optimal configuration the PostgreSQL database, take into account all of these parameters.`

* A **postgresqltuner.pl** is a simple script that helps you analyse a PostgreSQL database. It is similar to by `mysqltuner.pl` discussed above and has the same propose.

  .. code:: text

     wget https://postgresqltuner.pl postgresqltuner.pl
     ./postgresqltuner.pl

* PostgreSQL has a highly recommended feature called **autovacuum** aimed at automating the execution of VACUUM and ANALYZE commands.

  When enabled, autovacuum checks for tables that have had a large number of inserted, updated or deleted tuples.

  These checks use the statistics collection facility; therefore, autovacuum cannot be used unless **track_counts** is set to *true*. In the default configuration, autovacuuming is enabled and related configuration parameters are appropriately set.

Developers Recommendations
--------------------------

Data Retrieving
^^^^^^^^^^^^^^^

Do not select `All (SELECT *)` columns when only certain fields are required. Broadly speaking, the fewer columns you ask for, the less data must be loaded from disk when processing your query and less data to send over network.

If only columns stored in the index are requested, data will be loaded only from the index without reading data from the table.

This recommendation should be followed while working with complex queries that return a known set of fields: the repository methods that are not designed to return entity, datagrid queries, etc.

Using Indexes
^^^^^^^^^^^^^

Add indexes only under the following circumstances:

* When you know how table will be queried.
* When you know that the index field will be a part of the *where* clause.
* When a field is highly selectable.

When all the conditions apply, the field makes a good candidate for pre-emptive tuning. Otherwise, do not add indexes to all fields because this will slow down insert/update operations and will require more disk space.

Metadata Caching
^^^^^^^^^^^^^^^^

When metadata caching is turned on, then no changes to an entity will be seen by the doctrine until cache is refreshed. Remember to clear metadata cache every time time metadata is changed.

.. code:: text

   bin/console doctrine:cache:clear-metadata

Hydrations
^^^^^^^^^^

Like most ORMs, Doctrine ORM performs **Hydration** when converting database results into objects.

This process usually involves reading a record from a database result and then converting the column values into the object properties.

It may lead to performance degradation when several collections are hydrated in one query. The process of hydration becomes extremely costly when more than 2 LEFT JOIN operations clauses are part of queries.

More details on hydration are available in the `Doctrine ORM Hydration Performance Optimization <https://ocramius.github.io/blog/doctrine-orm-optimization-hydration/>`_ article.

Before any query optimization, first EXPLAIN it on both supported Database platform and see how query is processed by RDBMS. See `Using Explain <https://www.postgresql.org/docs/current/static/using-explain.html>`_ and `Explain Output <https://dev.mysql.com/doc/refman/5.7/en/explain-output.html>`_ for more information.

Security and ACL
^^^^^^^^^^^^^^^^

To protect your query by ACL, call `AclHelper:apply` to apply ACL restrictions to a given query. 

Exception and Unavailability Handling
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the database in not available, applications in the production mode should show a service unavailability or maintenance page with contact details of a responsible person to report an incident.

In order to handle errors related to the deadlocks or lock wait timeouts, you can use Doctrine built-in transaction exceptions.

All transaction exceptions where retrying makes sense have a marker interface: Doctrine\\DBAL\\Exception\\RetryableException.

Logging
^^^^^^^

* All logs must follow the :ref:`Logging Conventions <community--contribute--logging-conventions>`.
* Logs **must not contain sensitive data** like credit card numbers, passwords, etc.
* Enable MySQL Slow query Logs for logging slow queries. This can help determine issues with the database and debug them.

References
----------

* `MySQL Documentation <https://dev.mysql.com/doc/>`_
* `PostgreSQL Documentation <https://www.postgresql.org/docs/>`_
* `Doctrine Extensions <https://github.com/oroinc/doctrine-extensions>`_
* `Oro application system requirements <https://www.oroinc.com/orocommerce/doc/current/system-requirements>`_
* `PGTune - Configuration calculator for PostgreSQL <http://pgtune.leopard.in.ua/>`_
* `Percona Configuration Wizard for MySQL <https://tools.percona.com/wizard/>`_ (you might need to sign it to use the wizard)
* `PostgreSQL Performance Optimization <https://wiki.postgresql.org/wiki/Performance_Optimization>`_
* `PostgreSQL Tuner <https://github.com/jfcoz/postgresqltuner>`_
* `Symfony: DoctrineBundle Configuration <https://symfony.com/doc/current/reference/configuration/doctrine.html>`_
* `Doctrine ORM Hydration Performance Optimization <https://ocramius.github.io/blog/doctrine-orm-optimization-hydration/>`_
* :ref:`Logging Conventions <community--contribute--logging-conventions>`
* `Using Explain <https://www.postgresql.org/docs/current/static/using-explain.html>`_
* `Explain Output <https://dev.mysql.com/doc/refman/5.7/en/explain-output.html>`_
