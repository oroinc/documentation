:orphan:

.. begin_body

Installation Notes
------------------

Installed PHP Accelerators must be compatible with Symfony and Doctrine (support DOCBLOCKs).

Note that the port used by the WebSocket server must be open in firewall for outgoing/incoming connections.

MySQL Configuration
~~~~~~~~~~~~~~~~~~~

Using MySQL 5.6 on HDD is potentially risky as it can result in performance issues.

Recommended configuration for this case:

.. code:: ini

    innodb_file_per_table = 0

Ensure that the timeout has a default value.

.. code:: ini

    wait_timeout = 28800

See `Optimizing InnoDB Disk I/O <http://dev.mysql.com/doc/refman/5.6/en/optimizing-innodb-diskio.html>`__ for more information.

The default MySQL character set utf8 uses a maximum of three bytes per character and contains only BMP characters. The `utf8mb4 <https://dev.mysql.com/doc/refman/5.6/en/charset-unicode-utf8mb4.html>`__ character set uses a maximum of four bytes per character and supports supplemental characters (e.g. emojis). It is `recommended <http://symfony.com/doc/current/doctrine.html#configuring-the-database>`__ to use utf8mb4 character set in your app/config.yml:

.. code:: yaml

    doctrine:
        dbal:
            connections:
                default:
                    driver:       "%database_driver%"
                    host:         "%database_host%"
                    port:         "%database_port%"
                    dbname:       "%database_name%"
                    user:         "%database_user%"
                    password:     "%database_password%"
                    charset:      utf8mb4
                    default_table_options:
                        charset: utf8mb4
                        collate: utf8mb4_unicode_ci
                        row_format: dynamic

Using utf8mb4 might have side effects. MySQL indexes have a default limit of 767 bytes, so any indexed fields with varchar(255) will fail when inserted, because utf8mb4 can have 4 bytes per character (255 \* 4 = 1020 bytes), thus the longest data can be 191 (191 \* 4 = 764 < 767). To be able to use any 4 byte charset all indexed varchars should be at most varchar(191).

To overcome the index size issue the server can be configured to have large index size by enabling `sysvar\_innodb\_large\_prefix <http://dev.mysql.com/doc/refman/5.6/en/innodb-parameters.html#sysvar_innodb_large_prefix>`__.

However, innodb\_large\_prefix requires some additional settings to work:

-  ``innodb_default_row_format=DYNAMIC`` (you may also enable it per connection as in the config above)
-  ``innodb_file_format=Barracuda``
-  ``innodb_file_per_table=1`` (see above performance issues with this setting)

More details about this issue can be found `here <https://mathiasbynens.be/notes/mysql-utf8mb4#utf8-to-utf8mb4>`__.

Web Server Configuration
~~~~~~~~~~~~~~~~~~~~~~~~

|main_app| is based on the Symfony standard application, so the web server configuration recommendations are the `same <http://symfony.com/doc/2.8/setup/web_server_configuration.html>`__.

Opcache
~~~~~~~

Recommended configuration:

.. code:: ini

    ;512Mb for php5
    opcache.memory_consumption=512

    ;256Mb for php7
    opcache.memory_consumption=256
    opcache.max_accelerated_files=32531
    opcache.interned_strings_buffer=32

See `Symfony Performance <http://symfony.com/doc/current/performance.html>`__.

Using Redis for application caching
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To use Redis for application caching, follow the corresponding
`configuration instructions <https://github.com/orocrm/redis-config#configuration>`__.

.. finish_body

.. |main_app| replace:: OroCommerce and OroCRM Community Edition
