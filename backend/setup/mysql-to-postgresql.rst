Migrating the Database from MySQL to PostgreSQL for OroCommerce, OroCRM or OroPlatform
======================================================================================

Make a MySQL Database Backup
----------------------------

Before starting the migration process, it is crucial to create a backup
of the existing MySQL database. This backup will ensure that you have a
fallback option in case anything goes wrong during the migration
process.

Create an Empty PostgreSQL Database
-----------------------------------

Next, you need to create an empty PostgreSQL database. If you are
running PostgreSQL in a Docker container, make sure it has enough shared
memory. You can do this by setting the ``shm_size: 1g`` option for the
pgsql service.

Create a Migration Config
-------------------------

Once the empty PostgreSQL database is set up, create a migration
configuration file that specifies the migration process. The following
is a sample migration config that can be used for this process:

.. code-block:: none

   LOAD DATABASE
       FROM      mysql://dbuser:dbpass@localhost:3306/old_db_name
       INTO postgresql://dbuser:dbpass@localhost:5432/new_db_name
   alter schema 'old_db_name' rename to 'public'
   CAST type datetime to timestamp /*(DC2Type:datetime)*/ drop default drop not null using zero-dates-to-null,
   type int with extra auto_increment when (< precision 12) to serial drop typemod,
   type int with extra auto_increment when (>= 12 precision) to bigserial drop typemod,
   type int when (< precision 12) to int drop typemod,
   type int when (>= 12 precision) to bigint drop typemod,
   type longtext to text using remove-null-characters,
   TYPE smallint when unsigned TO smallint drop typemod,
   TYPE bigint when unsigned TO bigint drop typemod,
   TYPE bigint TO bigint drop typemod,
   TYPE json TO jsonb drop typemod,
   TYPE int when (unsigned && >= 10 precision) TO bigint drop typemod
   ;

In this configuration file, replace the database credentials with your
own. Also, in **alter schema ``old_db_name`` rename to ``public``**, replace
``old_db_name`` with the MySQL table name.

Migrate the Database to PostgreSQL Using Pgloader
-------------------------------------------------

Use |pgloader| to migrate the database to PostgreSQL with the above config
by running the following command:

.. code-block:: bash

   pgloader oro-mysql-pgsql.conf

Switch the Application to the PostgreSQL Database
-------------------------------------------------

Once the migration configuration file is set up, switch the
OroCommerce application to use the new PostgreSQL database. To do this,
edit the config/parameters.yml file and change the database settings to
point to the new PostgreSQL database.

Clear the Application Cache
---------------------------

After making changes to the OroCommerce configuration, it is essential to
remove the application cache to ensure that the changes take effect. You
can do this by running the following command:

.. code-block:: bash

   php bin/console cache:clear --env=prod

Test the Application
--------------------

With the application cache cleared, test the application
and ensure that everything has been migrated successfully. Perform a few
basic tests to make sure that everything is working as expected.

Follow the Standard Upgrade Process
-----------------------------------

Finally, to migrate an application to version 5.1.\* where PostgreSQL is
the default and only supported version for all community and
enterprise edition applications, follow the :ref:`standard upgrade process <upgrade>`
provided by OroCommerce. This process may vary depending on the version
of OroCommerce you are currently running.

In conclusion, switching the database from MySQL to PostgreSQL for
OroCommerce requires careful planning and execution. By following the
steps outlined above, you can ensure a smooth and successful migration.

.. include:: /include/include-links-dev.rst
   :start-after: begin
