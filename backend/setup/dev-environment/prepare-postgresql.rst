:orphan:

Prepare PostgreSQL Database
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Initialize a PostgreSQL Database Cluster
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: bash

   postgresql-setup --initdb

Enable Password Protected PostgreSQL Authentication
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

By default, PostgreSQL uses `ident` authentication.

To use password-based authentication instead, replace `ident` with `md5` in the `pg_hba.conf` file.

Open the file */var/lib/pgsql/data/pg_hba.conf* and change the following strings:

.. code-block:: none

   host    all             all             127.0.0.1/32            ident
   host    all             all             ::1/128                 ident

to match these ones:

.. code-block:: none

   host    all             all             127.0.0.1/32            md5
   host    all             all             ::1/128                 md5

Change the Password for the *postgres* User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To set a new secure password for the *postgres* user, run the following commands:

.. code-block:: bash

   systemctl start postgresql
   su postgres
   psql
   \password

.. note:: You will be prompted to enter the new password.

Create a Database for the Oro Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To create the `oro` database for the Oro application, run the following commands:

.. code-block:: bash

   CREATE DATABASE oro;
   \c oro
   CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
   \q
