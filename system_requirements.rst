.. index::
    single: Requirements

System Requirements
===================

OroCRM is a web application which runs on a server. Users interact with the application via a web browser on any computer or mobile
device that have access to the internet or the network where the server is hosted.


Server-side Requirements
------------------------

Resources
~~~~~~~~~

Resources configuration depends on the data size and number of active users and integrations. Typical setup could be
done on a single server with minimum 2 CPU cores, 2GB RAM and a fast hard drive (SSD is recommended). The application could
scale to multiple servers and a separate database server based on the expected load.


Operating Systems
~~~~~~~~~~~~~~~~~

Linux distributions (RedHat, Ubuntu, Debian, CentOS) are recommended for the production setup. Windows 7 and above and Mac OS X can be used for the development environment.


Software
~~~~~~~~

Oro applications are compatible with most web servers with PHP support, but we recommend the following configuration:

+-------------------+---------------------------------------------------+
| *Web Server*      | * `Apache`_ 2.2.x or 2.4.x                        |
|                   | * `Nginx`_ (latest mainline or stable version)    |
|                   |                                                   |
|                   | Web server configuration recommendations are well |
|                   | described in `Symfony documentation`_             |
+-------------------+---------------------------------------------------+
| *PHP*             | * `PHP`_ 5.6 and above                            |
|                   | * PHP CLI, the same version as for the web server |
+-------------------+---------------------------------------------------+
| *PHP Settings*    | Few updates to default PHP configuration settings |
|                   | should be done in php.ini for the web server and  |
|                   | CLI:                                              |
|                   |                                                   |
|                   | * date.timezone must be set                       |
|                   | * detect_unicode must be disabled                 |
|                   | * memory_limit should be 512M or above            |
|                   |                                                   |
|                   | If you have xdebug installed:                     |
|                   |                                                   |
|                   | * xdebug.scream must be disabled                  |
|                   | * xdebug.show_exception_trace must be disabled    |
+-------------------+---------------------------------------------------+
| *PHP Extensions*  | * ctype                                           |
|                   | * curl                                            |
|                   | * fileinfo                                        |
|                   | * gd                                              |
|                   | * intl                                            |
|                   | * json                                            |
|                   | * mbstring                                        |
|                   | * mcrypt                                          |
|                   | * mysql                                           |
|                   | * tokenizer                                       |
|                   | * xml                                             |
|                   | * zip                                             |
+-------------------+---------------------------------------------------+
| *Database*        | * `MySQL`_ 5.1 and above                          |
|                   |                                                   |
|                   | .. note:: Latest version of `mariaDB` may be used |
|                   |    at one's own risk. Oro applications are not    |
|                   |    tested with `mariaDB` and thus the correct     |
|                   |    operation cannot be guaranteed.                |
+-------------------+---------------------------------------------------+
| *Process Control* | * `Supervisor`_ or alternative                    |
+-------------------+---------------------------------------------------+

**MySQL Optimization**

If you are using an HDD instead of an SSD, please pay attention to the following configuration settings:

.. code-block:: text

    innodb_file_per_table = 0
    wait_timeout = 28800

More optimization recommendations could be found in MySQL official documentation.
See [Optimizing InnoDB Disk I/O][2] for more information.

**MySQL Collate and Charset**

The default MySQL character set utf8 uses a maximum of three bytes per character and contains only BMP characters.
The `utf8mb4`_ character set uses a maximum of four bytes per character and supports supplemental characters
(e.g. emojis). It is recommended to `use utf8mb4 character set`_.

Using utf8mb4 might have side effects. MySQL indexes have the default limit of 767 bytes, so any indexed fields with
varchar(255) will fail when inserted, because utf8mb4 can have 4 bytes per character (255 * 4 = 1020 bytes), thus
the longest data can be 191 (191 * 4 = 764 < 767). To be able to use any 4 byte charset, all indexed varchars should be
at most varchar(191). To overcome index size issue, the server can be configured to have a large index size
by enabling `sysvar_innodb_large_prefix`_. However, innodb_large_prefix requires some additional settings to work:

- innodb_default_row_format=DYNAMIC (you may also enable it per connection as in the config above)
- innodb_file_format=Barracuda
- innodb_file_per_table=1 (see above performance issues with this setting)

More details about `switching to utf8mb4`_ are available online.



Enterprise Edition Software
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Enterprise edition is built to support better scale and performance. It is compatible with additional software
configuration that allows to achieve these goals.

+-------------------+----------------------------------------------------+
| *PHP Extensions*  | * pgsql                                            |
+-------------------+----------------------------------------------------+
| *Database*        | * `PostgreSQL`_ / `EnterpriseDB`_ 9.1 and above    |
+-------------------+----------------------------------------------------+
| *Search Index*    | * `Elasticsearch`_ 2.x                             |
+-------------------+----------------------------------------------------+
| *Job Queue*       | * `RabbitMQ`_ 3.5.8 and above, with Erlang/OTP     |
|                   |   version 18.0 and higher.                         |
|                   |   RabbitMQ 3.6.x is recommended                    |
+-------------------+----------------------------------------------------+

**PostgreSQL Configuration**

PostgreSQL `uuid-ossp` extension should be loaded for proper doctrine's `guid` type handling. In order to enable it,
connect to the database server and run sql query:

.. code-block:: sql

    CREATE EXTENSION "uuid-ossp";


Optional recommendations
~~~~~~~~~~~~~~~~~~~~~~~~

* `Git`_ is the recommended version control system and could be used for application source code management
* `Node.js`_ could be used for more efficient JS assets minification
* `Xdebug`_ could be used as the debugger tool but it is recommended only in the development environment
    * xdebug.max_nesting_level above 100 should be used
* Tidy PHP extension should be installed to make sure that HTML is correctly converted into a text representation
* `Redis` - could be used for more efficient application caching. Supported versions of Redis from 2.0 to 3.2


Client-side Requirements
------------------------

On the client side, Oro applications could be used with most of the graphical browsers on any operating system.
Recommended and supported browsers:

 * `Mozilla Firefox`_ (latest)
 * `Google Chrome`_ (latest)
 * Microsoft `Internet Explorer`_ 10 and above
 * Microsoft `Edge`_
 * `Safari`_ (latest)

.. note::

    Any browser you use needs to have cookies and JavaScript turned on.


.. _`Apache`: https://httpd.apache.org/
.. _`Nginx`: https://www.nginx.com/
.. _`PHP`: https://secure.php.net/
.. _`MySQL`: https://www.mysql.com/
.. _`Supervisor`: http://supervisord.org/
.. _`MySQL official documentation`: http://dev.mysql.com/doc/refman/5.7/en/optimization.html
.. _`utf8mb4`: https://dev.mysql.com/doc/refman/5.7/en/charset-unicode-utf8mb4.html
.. _`use utf8mb4 character set`: http://symfony.com/doc/current/doctrine.html#configuring-the-database
.. _`sysvar_innodb_large_prefix`: http://dev.mysql.com/doc/refman/5.6/en/innodb-parameters.html#sysvar_innodb_large_prefix
.. _`switching to utf8mb4`: https://mathiasbynens.be/notes/mysql-utf8mb4#utf8-to-utf8mb4
.. _`PostgreSQL`: https://www.postgresql.org/
.. _`EnterpriseDB`: https://www.enterprisedb.com/
.. _`Elasticsearch`: https://www.elastic.co/products/elasticsearch
.. _`RabbitMQ`: https://www.rabbitmq.com/
.. _`Git`: https://git-scm.com/
.. _`Node.js`: https://nodejs.org/en/
.. _`Xdebug`: https://xdebug.org/
.. _`Mozilla Firefox`: https://www.mozilla.org/en-US/firefox/new/
.. _`Google Chrome`: https://www.google.com/chrome/
.. _`Internet Explorer`: https://www.microsoft.com/en-us/download/internet-explorer.aspx
.. _`Edge`: https://www.microsoft.com/en-us/windows/microsoft-edge
.. _`Safari`: http://www.apple.com/safari/
.. _`Symfony documentation`: http://symfony.com/doc/2.8/setup/web_server_configuration.html
