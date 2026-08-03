.. _architecture-overview--tech-stack:

Technology Stack
================

.. begin_client_side

Like any **web application**, the Oro application follows a |client - server architecture|: the server-side stack prepares the web content and delivers the response to the client. Oro applications rely on a number of embedded, integrated, and distributed technologies, explained below.

Client Side
-----------

A **client**, whether a web browser or a third-party application connected via :ref:`the API <web-services-api>`, requests the Oro application server-side to get the application content or JSON response. Information received in response from the server-side may be used:

* By the web browser -- to render or update the web page shown to the end user.
* By the third party application -- trigger actions in the Oro applications or other integrated systems to launch data synchronization.

Web Browser
^^^^^^^^^^^

Oro applications support the following web browsers:

* |Mozilla Firefox| (latest version)
* |Google Chrome| (latest version)
* |Microsoft Edge| (latest version)
* |Safari| (latest version)

Out of the box, Oro Applications are mobile-friendly due to the responsive and adaptive UI.

In addition to HTTP connections, Oro applications establish WebSocket connections between web browsers and the server side for real-time communication (for example, status notifications and alerts).

API Client
^^^^^^^^^^

The architecture of the third-party application that connects to the Oro application via :ref:`the API <web-services-api>` is not limited by the Oro application architecture. You can implement the API client as a separate custom web application, custom mobile application, ERP system, ETL service, etc.

.. stop_client_side

.. begin_server_side

Server Side
-----------

On the **server-side**, the Oro application comprises multiple systems and elements that interact to deliver a reliable, scalable, and responsive Oro solution. They are detailed in the following sections.

Oro PHP Application
^^^^^^^^^^^^^^^^^^^

The core component, **Oro PHP Application**, is a modular **PHP** web application that leverages the **Symfony** framework and **Doctrine ORM** strengths. It interacts with the following system components:

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

**Oro application** uses the **database** to store application data and uses the Doctrine database abstraction layer (DBAL) and object-relational mapper (ORM) to interact with the database. That enables out-of-the-box support of various databases enabled by Doctrine. On top of that, in the Oro application, Doctrine capabilities are extended with additional database functions in the |Oro Doctrine Extensions| library. Currently, the extended functions are supported for PostgreSQL database only.

Supported RDBMs:

* PostgreSQL in CE and EE

.. note:: For implementation details, see :ref:`Database System Component <op-structure--database>` topic for more information about the database component.

File Storage
^^^^^^^^^^^^

Oro application uses **File Storage** to access data files.

You can configure the file storage to use different filesystems to store the data, like a local filesystem, GridFS storage, etc.

There are two types of storage:

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

The Oro application uses the **Message Queue** to process heavy jobs asynchronously, since running them immediately may degrade performance. Reindexing large volumes of data, creating large bulks of items, and similar jobs are usually handled by MQ consumers.

To process queued messages, the Oro application uses a proprietary consumer service. It runs as a daemon and handles all asynchronous jobs (messages) registered in a Message Queue.

The consumer service is scalable: it can run as parallel processes and/or on multiple servers to handle a large volume of asynchronous processes. The number of processes required depends on server capacity. To keep response times acceptable and absorb spikes in the server-side workload, you can scale message processing by adding more consumer services on demand.

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

.. note:: For implementation details, see :ref:`Search Index Concept <search_index_overview>` topic for more information about the search index component.

Cache Storage
^^^^^^^^^^^^^

The purpose of caching is to minimize the number of computing operations, including fetching data from other sources, by reusing results stored in the cache storage.

In production environments, we employ the following types of cache:
- Data Cache
- System Cache
- Content Cache

**Data cache**

Data cache is used for storing data that can be generated and changed in runtime.
It depends on database data, therefore must be shared in :ref:`multi-node setups <cloud_architecture>`.
It is implemented using |Redis Cache Adapter| and :ref:`OroRedisConfigBundle <bundle-docs-platform-redis-bundle>` with Redis Sentinel or Redis Cluster.

Examples of such cache are below:

* :ref:`Caching complex ACL structures <coobook-entities-acl-enable>`
* :ref:`Catalog Menu Caching <bundle-docs-commerce-catalog-bundle>`
* |Doctrine ORM caching|

.. note:: See the :ref:`Data Cache Service <bundle-docs-platform-cache-bundle--data-cache-service>` documentation for more information.

**System cache**

System cache should be generated during deployment operations and must be read-only in runtime.
It mainly relies on code sources such as DI container, annotations, TWIG, YAML and in some cases, database data like :ref:`Extend Entities <book-entities-extended-entities>`. As a result, it should not be shared in :ref:`multi-node setups <cloud_architecture>`.
It is implemented using |Filesystem Cache Adapter| and |PHP Files Cache Adapter|, and it becomes the most efficient cache when combined with OPcache.

Examples of such cache are below:

* |Symfony container|
* |Twig caching|

.. note:: See the :ref:`Caching Static Configuration <bundle-docs-platform-cache-bundle--caching-static-configs>` documentation for more information.

**Content cache**

Content cache is used for storing html content to avoid its generation whenever the page is accessed.
It depends on the database data, but must not be shared in :ref:`multi-node setups <cloud_architecture>`.
It is implemented using |Redis Cache Adapter| and :ref:`OroRedisConfigBundle <bundle-docs-platform-redis-bundle>` using standalone Redis running alongside PHP-FPM and Nginx.

.. note:: For more information, see :ref:`OroCommerce Render Caching <dev-doc-render-cache>`.

Notes on Deployment Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^

For a compact, resource-efficient deployment, all systems and elements of the Oro application can be hosted on a single physical or virtual server instance.

For scalable, high-load deployments:

* Multiple instances of the Oro application can run on their own dedicated web servers, with a load balancer directing client requests to the appropriate server.
* Each system and element of the Oro application can be hosted on its own dedicated server and scaled separately.

**Next step**: :ref:`Oro PHP Application Structure <architecture-oro-php-application-structure>`

**Related Topics**

* :ref:`Database <op-structure--database>`
* :ref:`File Storage <backend-file-storage>`
* :ref:`Session Storage <backend-session-storage>`
* :ref:`Message Queue <op-structure--mq--index>`
* :ref:`Search Index Concept <search_index_overview>`

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
   search/index