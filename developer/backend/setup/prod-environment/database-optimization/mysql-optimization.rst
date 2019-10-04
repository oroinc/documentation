.. _mysql-optimization:

MySQL Optimization
------------------

.. _mysql-hdd-sdd:

How To Avoid Performance Issues When MySQL Data is Stored on HDD
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

It is recommended to use SSD to store the data in the MySQL 5.X database. However, if you do need to use the HDD, follow
the steps described in the |optimizing InnoDB Disk I/O| article to avoid
performance issues and set the following configuration parameters in the **/etc/my.cnf** file:

.. code:: bash

   [mysqld]
   innodb_file_per_table = 0
   wait_timeout = 28800

.. _mysql-optimizer:

How To Avoid Performance Issues with MySQL optimizer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To minimize the risk of long compilations of SQL queries (which sometimes may take hours or even days;
for details, see `MySQL documentation <https://dev.mysql.com/doc/refman/5.6/en/controlling-query-plan-evaluation.html>`_),
set `optimizer_search_depth` to `0`:

.. code:: bash

   [mysqld]
   optimizer_search_depth = 0

.. _utf8mb4-mysql:

Usage of The utf8mb4 Character Set (The Full 4-Byte UTF-8 Unicode Encoding) in MySQL
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To store supplementary characters (such as 4-byte emojis), configure the options file to use the `utf8mb4`
character set. Put the following configuration settings in your options file **/etc/my.cnf**:

.. code:: bash

   [client]
   default-character-set = utf8mb4

   [mysql]
   default-character-set = utf8mb4

   [mysqld]
   character-set-server = utf8mb4
   collation-server = utf8mb4_unicode_ci

MySQL also can load default options from another file (not */etc/my.cnf*). In such cases, you have to put the
configuration settings in this file. To find out which configuration files your MySQL server uses, run the
following command:

.. code:: bash

    $ mysqld --help --verbose 2> /dev/null | grep -A1 'Default options'

You will get the output with MySQL config files names similar to this:

.. code:: bash

    Default options are read from the following files in the given order:
    /etc/my.cnf /etc/mysql/my.cnf /usr/local/etc/my.cnf ~/.my.cnf

.. note:: You also can set up the character set and the collation on |the other levels| as well.

If you use the version of MySQL that is **older than 5.7**, the following configuration parameters should be set in
the **/etc/my.cnf** file:

.. code:: bash

   [mysqld]
   innodb_file_format = Barracuda
   innodb_large_prefix = 1

Since MySQL 5.7, these parameters are set by default.

You can find more information on MySQL configuration in the |Unicode Support| and |InnoDB File-Format Management| articles.

You can also change the defaults for Doctrine so that the generated SQL uses the correct character set. To achieve this,
put the following configuration into the **config/config.yml** file:

.. code::

    doctrine:
        dbal:
            charset: utf8mb4
            default_table_options:
                charset: utf8mb4
                collate: utf8mb4_unicode_ci

.. note:: If you use the version of MySQL that is older than 5.7, also add the `row_format: DYNAMIC` option to the
    `default_table_options` section.

For more details, please see the |Setting up the Database to be UTF8| article.

.. include:: /include/include-links.rst
   :start-after: begin
