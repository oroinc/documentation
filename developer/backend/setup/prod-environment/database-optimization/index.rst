Database Optimization
=====================

Overview
--------

This article contains descriptions of some known issues and recipes that might help to get the best
application performance.

MySQL
-----

Block Nested Loop (BNL) in MySQL 5.6 and 5.7
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

MySQL 5.6 has a lot of improvements in the query optimizer, but unfortunately, some queries work significantly
slower than in MySQL 5.5. In case of large amounts of data in the database, it is possible to encounter performance issues
related to the new query optimizer. One of the possible solutions might be disabling ``block_nested_loop`` option.
This can be achieved in two ways:

    - If a modification of MySQL configuration file is granted, add the following under the ``mysqld`` section

      .. code-block:: cfg
          :linenos:

          [mysqld]
          optimizer_switch=block_nested_loop=off

    - Another way is to add the following configuration to the ``config/config.yml`` file

      .. code-block:: yaml

          doctrine:
              dbal:
                  connections:
                      default:
                          options:
                              # PDO::MYSQL_ATTR_INIT_COMMAND
                              1002: 'SET @@SESSION.optimizer_switch="block_nested_loop=off";'


.. toctree::
   :hidden:

   mysql-optimization