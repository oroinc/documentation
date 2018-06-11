:orphan:

.. _cloud_architecture:

Architecture
------------

.. contents::
   :local:
   :depth: 1

Google Cloud Platform
~~~~~~~~~~~~~~~~~~~~~

Google Cloud Platform (GCP) is Infrastructure as a Service (IaaS) provider with many data centers located all around the globe. To organize the GCP resources that are allocated for a particular OroCloud environment, they are grouped into a `GCP project <https://cloud.google.com/storage/docs/projects>`_. Within a single project, the resources are optimized for data transmission and communication in the same `region <https://cloud.google.com/compute/docs/regions-zones>`_ and are redundant to provide high availability with the replicas of the resources distributed among multiple zones.

GCP Data Centers
^^^^^^^^^^^^^^^^

Google's data centers are located in the US, South America, Europe, and Asia. See `Data center locations <https://www.google.com/about/datacenters/inside/locations/index.html>`_ for more information. Google organizes its GCP resources into zones and regions to ensure:

* Fault tolerance, as every zone is isolated from other zones and it is unlikely that two zones will fail for the same cause.
* Fast network connectivity between the zones in the same region, gaining latency of under 5ms.
* On-demand resource distribution to multiple regions, to get closer to the end customer, and protect from the global disaster that affects the entire region.

.. note:: Google is the first company in North America to obtain multi-site `ISO 50001 <http://www.iso.org/iso/home/standards/management-standards/iso50001.htm>`_ Energy Management System certification for their data centers across the US, Europe, and Asia.

In OroCloud, you can pick the GCP region(s) where your Oro application environment resources are allocated. Taking fault-tolerance into account, all the resources usually share the same geographic region for the response-time optimization but are distributed across multiple zones within the selected region.

OroCoud Environment Infrastructure Diagram
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The diagram below reflects a standard Oro application deployment in GCP via OroCloud.

.. image:: /cloud/img/architecture.png
   :alt: Architecture of a standard Oro application deployment in GCP via OroCloud

Redundancy
~~~~~~~~~~

Redundancy is a system design that ensures that all the system components are duplicated so that if one of the hosts fails, the system can run using the redundant host.

The OroCloud infrastructure uses the fully redundant components and services for Oro application operation. Check out the following sections for details on how redundancy is achieved.

Web Node
^^^^^^^^

Google Load Balancer distributes the incoming traffic to a set of the web nodes to enable service on-demand scaling, fault tolerance, DDoS protection, etc. At least two web nodes are allocated in different zones for fault-tolerance.
For more information, see the `Google Cloud Load Balancing <https://cloud.google.com/load-balancing/>`_ documentation.

Search Index
^^^^^^^^^^^^

To speed up the search, Oro application data is indexed according to the application configuration and stored in the search index. As a search index provider, the OroCloud instances use ElasticSearch that out of the box provides cluster architecture and the ability to add more nodes to the cluster to spread the load between them and enhance reliability. For more information, see the `Life Inside the Cluster <https://www.elastic.co/guide/en/elasticsearch/guide/current/distributed-cluster.html>`_ getting started documentation.

Database
^^^^^^^^

Oro application data is stored in the PostgreSQL relational database. Each environment has at least two PostgreSQL instances, one in the main zone and another in the secondary zone. If the instance in the main zone becomes unresponsive, the environment automatically switches to the secondary zone enabling the database failover.

Job / Message Queue
^^^^^^^^^^^^^^^^^^^

Oro application uses RabbitMQ as a message queue broker to enable asynchronous processing for the heavy jobs. RabbitMQ is highly scalable and it supports cluster architecture out of the box. RabbitMQ brokers tolerate the failure of individual nodes. Nodes can be started and stopped at will, as long as they can contact a cluster member node known at the time of shutdown. See `RabbitMQ Clustering <https://www.rabbitmq.com/clustering.html>`_ for more information.

To process queued messages, Oro application uses a proprietary consumer service. It runs as a daemon and handles all the jobs (messages) registered within a message queue.

Consumer service is scalable and can run as parallel processes and on multiple hosts to handle a large volume of messages. To guarantee the acceptable response time and address spikes in the server-side workload, the message processing is scaled by adding more consumer services.

SMTP Relay
^^^^^^^^^^

To send emails from the OroCloud environment, Oro application uses the dedicated configured SMTP Relay service, whose high availability is provided using a set of mail relays with different priorities. The setup is similar to master-master database replication, where there is more than one active service to handle the requests.

Cache
^^^^^

Oro application uses Redis cluster to store cache that helps it to optimize processing of complex operations. Redis Sentinel provides high availability for Redis cluster via the automatic failover and failure detection.
See `Redis Sentinel Documentation <https://redis.io/topics/sentinel>`_ for more information.

File Storage
^^^^^^^^^^^^

OroCloud environments are configured with `BeeGFS <https://www.beegfs.io/content/documentation/>`_  clustered file system to store application files related to the user data (attachments, images, documents).

Backups and Restore
~~~~~~~~~~~~~~~~~~~

Backups of OroCloud environment include the database dump, media files, and the application source code or the repository commit hash that may be used to retrieve the code.

Schedule
^^^^^^^^

A full backup is created daily at 2 am UTC by default.

.. note:: To change the backup schedule, please create a request via the Oro Inc. Help Desk.

On-demand backup may be launched via the ssh session using the automated OroCloud maintenance tool.

Encryption
^^^^^^^^^^

A backed up data is encrypted using AES-256 keys.
Retention policy
Daily backups are retained for one week.
Backups created on Sunday are retained for one year and they serve as weekly backups.

RTO
^^^

Restore time objective may vary from 30 minutes up to a couple of hours depending on the amount of data to be restored.

Maintenance
~~~~~~~~~~~

To maintain optimal performance, reliability, and security, OroCloud team performs regular environment maintenance and may roll out environment updates during the predefined maintenance window.

For the events when a critical infrastructure security patch is being released or some maintenance activity is urgently required for security or performance reasons, the OroCloud service team reserves an unplanned maintenance window informing the environment owner about such maintenance.

Disaster Recovery
~~~~~~~~~~~~~~~~~

**Disaster Recovery** (DR) is a process, supported by procedures, tools and infrastructure which allows the IT support team to recover OroCloud service operations when the total failure or major malfunction of the main hosting resources happens.

While every tier of GCP resources is trebly redundant, there is still a chance of a catastrophe putting down the entire Google Cloud region to sink the entire infrastructure. Moreover, for the service disruption, GCP Region failure should suffice but may not be required. The internet connectivity issue outside of Google and Oro control may be caused by adversary actions or misconfiguration and may as well take down the Oro Cloud environments in a particular region.

Disaster Recovery Objectives and Criteria
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following events are treated as a disaster and are used as DR criteria for OroCloud:

* `GCP Region <https://cloud.google.com/compute/docs/regions-zones/>`_ that is hosting a particular OroCloud environment is not available and is not anticipated to be recovered by Google in the nearest hour.
* OroCloud environment is not accessible because of the network issues that are related to the GCP geographical location.

In the event of the disaster, OroCloud team targets the following disaster recovery objectives:

* **Recovery Point Objective** - The instance is restored from the last daily backup.
* **Minimal Recovery Time** - It takes at least 60 minutes to restore service availability after the disaster recovery has been approved.
* **Maximum Recovery Time** - The recovery time depends on the backup volume and the complexity of the integration.

Disaster Recovery Principles
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Oro uses the cold disaster recovery location. No resource is allocated and billed for until the disaster recovery launches. In case a disastrous event takes place in the primary location, the OroCloud environment is re-created in a different GCP Region unaffected by the disaster and where the Oro application instance may continue its operation. Each GCP Region that is used for a production hosting has an assigned DR location.

Oro provides both primary and DR IP addresses for outgoing connections to the customer as a part of onboarding information. These IP addresses must be added to the whitelists if any whitelisting used.

Disaster Recovery Flow
^^^^^^^^^^^^^^^^^^^^^^

Customer Support requests DR approval by contacting environment owner technical contact person.

Once the DR is approved, OroCloud SWAT team puts the following plan into action:

* Provision the DR infrastructure and restore latest backups there
* Update the DNS record to point to the new location (if possible)
* Perform health check of the restored instance

Once the restored instance health check is complete and the instance is confirmed to be up and running, Customer Support notifies the technical contact person specified by the environment owner that the service has been successfully restored.

.. note:: If the Oro application is configured with the custom domain, the DNS record update should be handled by the domain owner.

System Configuration
~~~~~~~~~~~~~~~~~~~~

System configuration is managed as a code via the configuration management tool (Puppet).

Installed Software
^^^^^^^^^^^^^^^^^^

Centos OS
Nginx
PHP
PostgreSQL
Redis
Elasticsearch


**What’s Next**

* OroCloud :ref:`security <cloud_security>`
* The typical process of OroCloud :ref:`onboarding <cloud_onboarding>`, including the secure certificate exchange and guided access to the necessary tools
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* :ref:`Monitoring <cloud_monitoring>` principles and tools
* Information on how OroCloud team :ref:`handles incidents <cloud_monitoring>`
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).