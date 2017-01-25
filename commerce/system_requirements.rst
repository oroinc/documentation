.. index::
    single: Requirements

System Requirements
===================

Software Requirements
---------------------

Supported Operating Systems
~~~~~~~~~~~~~~~~~~~~~~~~~~~

    * Linux x86, x86-64
    * Windows 7 and 8
    * Mac OS X 10.9 and above

Supported Browsers
~~~~~~~~~~~~~~~~~~

    * Mozilla Firefox 6 and above
    * Google Chrome 31 and above
    * Microsoft Internet Explorer 10 and above
    * Safari
    * Opera 12.16 and above

Supported Web Servers
~~~~~~~~~~~~~~~~~~~~~

    * Apache 2.2.x
    * Nginx
    * Lighttpd

Supported Database Management Systems
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    * MySQL 5.1 and above
    * PostgreSQL/EnterpriseDB 9.1 and above

Installation Dependencies
~~~~~~~~~~~~~~~~~~~~~~~~~

* PHP 5.5.9 and above
* PHP Command Line Interface
* PHP extensions
    * ctype
    * fileinfo
    * GD 2.0 and above
    * intl
    * JSON
    * Mcrypt
    * PCRE 8.0 and above
    * SimpleXML
    * Tokenizer
* PHP settings
    * date.timezone must be set
    * detect_unicode must be disabled in php.ini
    * memory_limit should be at least 512M
    * xdebug.scream must be disabled in php.ini
    * xdebug.show_exception_trace must be disabled in php.ini
* Other requirements
    * ICU library 4.4 and above
    * mcrypt_encrypt() should be available
    * web/bundles/ directory must be writable
    * web/uploads/ directory must be writable

Optional Recommendations
~~~~~~~~~~~~~~~~~~~~~~~~

* Node.js (for JS minification)
* PHP-XML module installed
* xdebug.max_nesting_level above 100 in php.ini
* iconv() available ◦mb_strlen() available
* posix_isatty() available
* utf8_decode() available
* Tidy PHP extension should be installed to make sure that any HTML is correctly converted into a text representation
  

Hardware Requirements
---------------------

Hardware requirements for OroCommerce depend on the amount of data stored in the application and on the number of users working with the application concurrently.

The following information describes the minimum and the recommended hardware requirements for a generic types of deployment.  Actual requirements may vary depending on your system configuration, data, and service level requirements.

.. comment
    #Sizing guide
    #^^^^^^^^^^^^
    #
    #Matrix given below helps you identify the size of deployment and recommended hardware resources and configuration:
    #
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| Indicator                                                         | Size of the deployment                                                         |                                                                                 |                                                    |                       |
    #+===================================================================+================================================================================+=================================================================================+====================================================+=======================+
    #|                                                                   | Individual                                                                     | Small                                                                           | Middle                                             | Large                 |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Number of concurrent users**                                    | 1                                                                              | Between 2 and 10                                                                | Between 10 and 1000                                | More than 1000        |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Database size**                                                 | Less than 10Mb                                                                 | Less than 1Gb                                                                   | Between 1 Gb and 8 Gb                              | More than 8Gb         |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Number of records**                                             | Less than 50`000                                                               | Between 50`000 and 300`000                                                      | Between 300`000 and 1`000`000                      | More than 1`000`000   |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| Recommended hardware configuration (recommended / minimum)        |                                                                                |                                                                                 |                                                    |                       |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Application server (Apache/nginx) with cache provider (Redis)** | CPU: 4 cores                                                                   | (min 2 cores)                                                                   | CPU: ?                                             | CPU: ?                |
    #|                                                                   | (min 2 cores)                                                                  | RAM: 4 Gb                                                                       | RAM: ?                                             | RAM: ?                |
    #|                                                                   | RAM: 4 Gb                                                                      | (min 2Gb)                                                                       | HDD space: ?                                       | HDD space: ?          |
    #|                                                                   | (min 2Gb)                                                                      | ~300 Mb per user.                                                               |                                                    |                       |
    #|                                                                   | HDD space: 10Gb                                                                | HDD space: 10Gb                                                                 |                                                    |                       |
    #|                                                                   | (min 4Gb)                                                                      | (min 4Gb)                                                                       |                                                    |                       |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Database server**                                               | MySQL server may share virtual or physical server with the OroCRM application. | MySQL server  may share virtual or physical server with the OroCRM application. | CPU: ?                                             | CPU: ?                |
    #|                                                                   | PostgreSQL is not recommended for small deployments.                           | PostgreSQL is not recommended for small deployments.                            | RAM: ?  ~ 7 to 9 concurrent users per one CPU core | RAM: ?                |
    #|                                                                   |                                                                                |                                                                                 | HDD space: ?                                       | HDD space: ?          |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **JMS Daemon server**                                             | May share virtual or physical server with the OroCRM application.              | CPU: ?                                                                          | CPU: ?                                             | CPU: ?                |
    #|                                                                   |                                                                                | RAM: ?                                                                          | RAM: ?                                             | RAM: ?                |
    #|                                                                   |                                                                                | HDD space: ?                                                                    | HDD space: ?                                       | HDD space: ?          |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #| **Search configuration**                                          | MySQL Full Search* (Elastic Search* is not supported).                         | MySQL Full Search* or Elastic Search*.                                          | Elastic search* only.                              | Elastic search* only. |
    #+-------------------------------------------------------------------+--------------------------------------------------------------------------------+---------------------------------------------------------------------------------+----------------------------------------------------+-----------------------+
    #
    #MySQL Full Search - ...
    #
    #Elastic Search - ...

Community vs Enterprise Edition
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

OroCRM Community Edition supports deployments for individual use only and is not recommended for production systems with more than one user due to the potential data collisions and significant performance degradation when using search. 

General Database Requirements
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

For both MySQL and PostgreSQL, there is limit of concurrent users and the database size. 
MySQL utilizes less CPU time and it can be installed on the same server with Web Server. 
MySQL is faster for databases less than approximated 300 thousands of records.

PostgreSQL can utilize full CPU, therefore the recommendation is to have a dedicated server with PostgreSQL.
PostgreSQL is recommended for databases with more than a million or several million records.

**Database server memory size**

For both MySQL and PostgreSQL, the memory size should be equal to the database physical size (or more). 
The default MySQL configuration exceeds the default PostgreSQL configuration, however, they both require optimization. Optimization will depend on the available memory and the estimated number of concurrent users.

**CPU**

For CPU, the recommendation is to have 7 to 9 concurrent users per one CPU core if database server is hosted in a separate environment.

Web Server Memory Size
~~~~~~~~~~~~~~~~~~~~~~

The approximate web server memory size is 300 Mb per user.

Cache Provider
~~~~~~~~~~~~~~

Redis is recommended as a cache both for Community and Enterprise Edition versions. Redis decreases I/O disc operations and increases application performance in a number of times. Redis server should be shared on the same Web Server.

Search Engine
~~~~~~~~~~~~~

ElasticSearch search engine is recommended for Enterprise version only. It increases search performance in several times. Note, however, that ElasticSearch requires additional maintenance and environment resources.

Daemon
~~~~~~

JMS Daemon and its jobs should be hosted on a separate server. To share cache, it should connect to Redis hosted on a Web Server machine. Such configuration does not affect performance of web users.