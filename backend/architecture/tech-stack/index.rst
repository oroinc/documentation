.. _architecture-overview--tech-stack:

Technology Stack
================

.. begin_client_side

As any **web application**, Oro application generally follows a |client - server architecture| to deliver the web content prepared by the server-side stack to the client-side and deliver response. Oro applications rely on the number of embedded, integrated, and distributed technologies explained below.

Client Side
-----------

A **client**, whether it is a web-browser or a third-party application connected via :ref:`the API <web-services-api>`, makes requests to the Oro application server-side to get the application content or JSON response. Information received in response from the server-side may be used:

* By the web browser -- to render or update the web page shown to the end user.
* By the third party application -- to launch data synchronization, trigger actions in the Oro applications or other integrated systems.

Web Browser
^^^^^^^^^^^

Oro applications support the following web browsers:

* |Mozilla Firefox| (latest version)
* |Google Chrome| (latest version)
* |Microsoft Internet Explorer| (v.11 and above)
* |Microsoft Edge| (latest version)
* |Safari| (latest version)

Out of the box, Oro Applications are mobile friendly due to the responsive and adaptive UI.

In addition to the HTTP connections, Oro applications establish websocket connections between web browsers and server side for the real-time communication (e.g. status notifications, alerts, etc.)

API Client
^^^^^^^^^^

The architecture of the third-party application that connects to the Oro application via :ref:`the API <web-services-api>` is not limited by the Oro application architecture. The API client may be implemented as a separate custom web application, custom mobile application, ERP system, ETL service, etc.

.. stop_client_side

.. begin_server_side

Server Side
-----------

On the **server-side**, the Oro application is composed of the multiple systems and elements that interact to deliver a reliable, scalable, and responsive Oro solution. They are detailed in the following sections.

Oro PHP Application
^^^^^^^^^^^^^^^^^^^

The core component, let us call it **Oro PHP Application**, is a modular **PHP** web application that leverage the **Symfony** framework and **Doctrine ORM** strengths. It interacts with the following system components:

* Web Server and PHP
* Database and RDBMS
* File Storage
* Session Storage
* Message Queue
* Search Engine

Web Server and PHP
^^^^^^^^^^^^^^^^^^

A **web server** is an HTTP server that manages client requests and proxies them to the **Oro PHP Application**.
**Web server** may rely on the **PHP-FPM** to process requests to **Oro PHP Application** and prepare the response.

Supported web servers: |Apache| and |Nginx|

Database and RDBMS
^^^^^^^^^^^^^^^^^^

**Oro application** uses the **database** to store application data and uses Doctrine database abstraction layer (DBAL) and object-relational mapper (ORM) to interact with the database. That enables out of the box support of various databases enabled by Doctrine. On top of that, in the Oro application, Doctrine capabilities are extended with additional database functions in the |Oro Doctrine Extensions| library. Currently the extended functions are supported for MySQL and PostgreSQL databases only.

Supported RDBMs:

* MySQL in CE and EE
* PostgreSQL in EE only (for scalability)

.. note:: For implementation details, see :ref:`Database System Component <op-structure--database>` topic for more information about the database component.

File Storage
^^^^^^^^^^^^

Oro application uses **File Storage** to access data files.

The file storage can be configured to use different filesystems to store the data, like a local filesystem,
a GridFS storage, etc.

There are two types of storages:

* **private** is intended to store data that should not be available via a direct link, for example,
  attachments' data, import and export files, protected media cache files, etc.
* **public** is intended to store data that can be available via a direct link without access checks, for example,
  resized product images, sitemap files, etc.

.. note:: For implementation details, see :ref:`File Storage <backend-file-storage>` topic for more information about
   the file storage component.

Session Storage
^^^^^^^^^^^^^^^

Oro application uses |sessions| to preserve user data between web requests. This information is placed in a persistent
store that can be accessed from subsequent requests. For implementation details, see
:ref:`Session Storage <backend-session-storage>` topic.

Message Queue
^^^^^^^^^^^^^

Oro application uses **Message Queue** to enable asynchronous processing for the heavy jobs that, when executed immediately, may cause performance degradation. For example, reindexation of a large volume of data, creation of large bulks of items, etc. is usually handled via MQ consumers. To process the queued messages, Oro application uses a proprietary consumer service. It is running as a daemon and handles all the asynchronous jobs (messages) registered within a Message Queue. Consumer service is scalable and can run as a parallel processes and/or on multiple servers to handle a large volume of asynchronous processes. Number of processes required depends on the server capacity. To guarantee the acceptable response time and address spikes in the server-side workload, you can scale the message processing by adding more consumer services on demand.

Supported MQ solutions:

* Proprietary DB-based MQ in CE and EE
* RabbitMQ in EE only (for scalability)

.. note:: For implementation details, see :ref:`Message Queue <op-structure--mq--index>` topic for more information about the message queue component.

Search Engine
^^^^^^^^^^^^^

Oro application uses **Search Index** to enable full-text search and speed up the run-time access to the large amounts of application data.

Supported search index providers:

* :ref:`DB full-text search <search_index_db_from_md>` in CE and EE
* :ref:`Elastic Search <elastic-search>` in EE only

.. note:: For implementation details, see :ref:`Search Index <search_index_overview>` topic for more information about the search index component.

Notes on Deployment Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^

For a compact and resource-efficient deployment, all systems and elements of the Oro application may be hosted on a single physical or virtual server instance.
For scalable high-load deployments:
Multiple instances of Oro application may be hosted on their dedicated web servers, where the load balancer directs client requests to the necessary web server.
All systems and elements of the Oro application may be hosted on their own dedicated server and could be scaled separately.

**Next step**: :ref:`Oro PHP Application Structure <architecture-oro-php-application-structure>`

**Related Topics**

* :ref:`Database <op-structure--database>`
* :ref:`File Storage <backend-file-storage>`
* :ref:`Session Storage <backend-session-storage>`
* :ref:`Message Queue <op-structure--mq--index>`
* :ref:`Search Index <search_index_overview>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 1
   :titlesonly:

   database
   file-storage
   session-storage
   message-queue
   search-index
