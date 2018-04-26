:orphan:

.. _configure-the-database:
.. _platform--installation--create-database:


Create the Database
~~~~~~~~~~~~~~~~~~~

.. begin_create_database


#. Install one of the supported Database Management System Servers or allocate the existing one for Oro application data storage.

#. Create a dedicated database admin user that will be later on used in the installation configuration.

#. Create an empty database for Oro application. You will need the database name, server host and port information, and user information when you get to the :ref:`Installation Parameters Configuration <book-installation-github-clone-configuration-params>` step of the :ref:`installation <doc_installation_section_installation_process>` below.

#. If you use Oro application with MySQL 5.X and store data on the HDD, you may face performance issues. If you choose to keep using this configuration, please follow the recommendations provided in the `optimizing InnoDB Disk I/O <http://dev.mysql.com/doc/refman/5.6/en/optimizing-innodb-diskio.html>`_ article, and hence use the following configuration:

   .. code-block:: ini
      :linenos:

      innodb_file_per_table = 0
      wait_timeout = 28800

#. If you use an Oro application with the PostgreSQL database, load the `uuid-ossp` extension. Log into the database management system and run the following SQL query:

   .. code-block:: sql

      CREATE EXTENSION "uuid-ossp";

   This step ensures that PostgreSQL properly handles the doctrine `guid` type.

.. finish_create_database