.. index::
    single: Requirements

.. _system-requirements:

System Requirements
===================

OroCommerce is a web application which runs on a server. Users interact with the application via a web browser on any computer or mobile device that have access to the internet or the network where the server is hosted.


Server-side Requirements
------------------------

Resources
~~~~~~~~~

Resources configuration depends on the data size and number of active users and integrations. Typical setup could be done on a single server with a minimum of 2 CPU cores, 2GB RAM, and a fast hard drive (SSD is recommended). The application could scale to multiple servers and a separate database server based on the expected load.

Operating Systems
~~~~~~~~~~~~~~~~~

Linux distributions (RedHat, Ubuntu, Debian, CentOS) are recommended for the production setup.
Windows 7 and above and Mac OS X can be used for the development environment.

Software
~~~~~~~~

Oro applications are compatible with most web servers with PHP support, but the following configuration is recommended:

+-------------------+---------------------------------------------------+
| *Web Server*      | * |Apache| 2.2.x or 2.4.x                         |
|                   | * |Nginx| latest mainline or stable version       |
|                   |                                                   |
|                   | Web server configuration recommendations are well |
|                   | described in |Symfony web server documentation|   |
+-------------------+---------------------------------------------------+
| *PHP*             | * |PHP| >=7.3.13                                  |
|                   | * PHP CLI, the same version as for the web server |
+-------------------+---------------------------------------------------+
| *PHP Settings*    | Few updates to default PHP configuration settings |
|                   | should be done in php.ini for the web server and  |
|                   | CLI:                                              |
|                   |                                                   |
|                   | * date.timezone must be set                       |
|                   | * detect_unicode must be disabled                 |
|                   | * memory_limit should be 1Gb or above             |
|                   |                                                   |
|                   | Depending on the debugging tools and extensions   |
|                   | used during development, the memory_limit may be  |
|                   | even higher in the development environment        |
|                   |                                                   |
|                   | If the xdebug is installed (which is not          |
|                   | recommended in the production setup):             |
|                   |                                                   |
|                   | * xdebug.scream must be disabled                  |
|                   | * xdebug.show_exception_trace must be disabled    |
|                   | * xdebug.max_nesting_level above 100              |
|                   |                                                   |
|                   | By default, max_execution_time value equals 30    |
|                   | seconds. In case of using the **Schema update**   |
|                   | option, it is recommended to increase this value. |
|                   |                                                   |
+-------------------+---------------------------------------------------+
| *PHP Extensions*  | * ctype                                           |
|                   | * curl                                            |
|                   | * fileinfo                                        |
|                   | * gd                                              |
|                   | * intl (ICU library 4.4 and above)                |
|                   | * json                                            |
|                   | * mbstring                                        |
|                   | * openssl                                         |
|                   | * mysql                                           |
|                   | * pcre                                            |
|                   | * simplexml                                       |
|                   | * tokenizer                                       |
|                   | * xml                                             |
|                   | * zip                                             |
|                   | * imap                                            |
+-------------------+---------------------------------------------------+
| *Database*        | * |MySQL| 5.7                                     |
|                   |                                                   |
|                   | .. note:: The latest version of `mariaDB` may be  |
|                   |    used at one's own risk. Oro applications are   |
|                   |    not tested with `mariaDB`, and thus the correct|
|                   |    operation cannot be guaranteed.                |
+-------------------+---------------------------------------------------+
| *Process Control* | * |Supervisor|  or alternative                    |
+-------------------+---------------------------------------------------+
| *Assets*          | * |Node.js| v.12 used for JS assets minification  |
|                   |   and SCSS assets build.                          |
+-------------------+---------------------------------------------------+

.. note::

    It is recommended to disable `phar` PHP extension to reduce the risk of |PHP unserialization vulnerability|.

Enterprise Edition Software
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Enterprise edition is built to support better scale and performance. It is compatible with additional software configuration that enables to achieve these goals.

+------------------+-----------------------------------------------------+
| *PHP Extensions* | * pgsql                                             |
+------------------+-----------------------------------------------------+
| *Database*       | * |PostgreSQL| / |EnterpriseDB| 9.6                 |
+------------------+-----------------------------------------------------+
| *Search Index*   | * |Elasticsearch| 7.*                               |
+------------------+-----------------------------------------------------+
| *Job Queue*      | * |RabbitMQ| 3.5.8 and above with Erlang/OTP        |
|                  |   version 18.0 and higher.                          |
|                  |   RabbitMQ 3.6.x is recommended                     |
+------------------+-----------------------------------------------------+

.. _sys-requirements-postgre-config:

**PostgreSQL Configuration**

PostgreSQL `uuid-ossp` extension should be loaded for proper doctrine's `guid` type handling. In order to enable it, one can connect to the database server and run the following sql query:

.. code-block:: sql
    :linenos:

    CREATE EXTENSION "uuid-ossp";


Optional recommendations
~~~~~~~~~~~~~~~~~~~~~~~~

* |Tidy PHP extension| should be installed to make sure that HTML is correctly converted into a text representation
* |Redis| - could be used for more efficient application caching. Supported versions of Redis from 2.0 to 3.2
* The performance of :ref:`MySQL can be optimized <mysql-optimization>` by adjusting the configuration


Client-side Requirements
------------------------

On the client side, Oro applications could be used with most of the graphical browsers on any operating system.
Recommended and supported browsers are:

 * |Mozilla Firefox| (latest)
 * |Google Chrome| (latest)
 * |Microsoft Internet Explorer| 11 and above
 * |Microsoft Edge| (latest)
 * |Safari| (latest)

.. note::

    Any browser needs to have cookies and JavaScript turned on.

.. include:: /include/include-links-dev.rst
   :start-after: begin


**See Also**

.. toctree::
   :titlesonly:
   :maxdepth: 1

   performance-optimization
   database-optimization
