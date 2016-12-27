.. index::
    single: Requirements

System Requirements
===================

OroCRM is a web application and runs on a server. Users interact with it via web browser on any computer or mobile
device that have access to the internet or network where server is hosted.


Server-side Requirements
------------------------

Resources
~~~~~~~~~

Resources configuration depends on the data size and number of active users and integrations. Typical setup could be
done on a single server with minimum 2 CPU cores, 2GB RAM and fast hard drive (SSD is recommended). Application could
scale to multiple servers and separate database server based on expected load.


Operating Systems
~~~~~~~~~~~~~~~~~

Linux distributions (RedHat, Ubuntu, Debian, CentOS) are recommended for production setup. Windows 7 and above as well
as Mac OS X could be used,


Software
~~~~~~~~

Oro applications are compatible with most of the web servers with PHP support, but we recommend following configuration:

+-------------------+---------------------------------------------------+
| *Web Server*      | * Apache 2.2.x or 2.4.x                           |
|                   | * Nginx (latest mainline or stable version)       |
+-------------------+---------------------------------------------------+
| *PHP*             | * PHP 5.6 and above                               |
|                   | * PHP CLI, same version as for web server         |
+-------------------+---------------------------------------------------+
| *PHP Settings*    | Few updates to default PHP configuration settings |
|                   | should be done in php.ini for web server and      |
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
| *PHP Extensions*  | * Ctype                                           |
|                   | * cURL                                            |
|                   | * Fileinfo                                        |
|                   | * GD 2.0 and above                                |
|                   | * intl                                            |
|                   | * JSON                                            |
|                   | * mbstring                                        |
|                   | * Mcrypt                                          |
|                   | * PCRE 8.0 and above                              |
|                   | * SimpleXML                                       |
|                   | * Tokenizer                                       |
+-------------------+---------------------------------------------------+
| *Database*        | * MySQL 5.1 and above.                            |
+-------------------+---------------------------------------------------+


Enterprise Edition Software
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Enterprise edition built to support a better scale and performance. It is compatible with additional software
configuration that allows to achive this goals.

+-------------------+---------------------------------------------------+
| *Database*        | * PostgreSQL/EnterpriseDB 9.1 and above           |
+-------------------+---------------------------------------------------+
| *Search Index*    | * Elasticsearch 2.x                               |
+-------------------+---------------------------------------------------+
| *Job Queue*       | * RabbitMQ 3.5.x and above                        |
+-------------------+---------------------------------------------------+


Optional recommendations
~~~~~~~~~~~~~~~~~~~~~~~~

* Git is recommended version control system and could be used for application source code management
* Node.js could be used for more efficient JS assets minification
* Xdebug could be used as debugger tool, recommended inly in development environment
    * xdebug.max_nesting_level above 100 should be used
* Tidy PHP extension should be installed to make sure that any HTML is correctly converted into a text representation


Client-side Requirements
------------------------

On the client side Oro applications could be used with most of the graphical browsers on any operating system.
Recommended and supported browsers:

 * Mozilla Firefox (latest)
 * Google Chrome (latest)
 * Microsoft Internet Explorer 10 and above
 * Microsoft Edge
 * Safari (latest)

.. note::

    Any browser you use needs to have cookies and JavaScript turned on.

