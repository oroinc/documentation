:orphan:

:title: OroCloud 4.1 Architecture Documentation

.. meta::
   :description: Fundamentals of the OroCloud architecture, environment infrastructure configuration and maintenance

.. _cloud_architecture:

Architecture
------------

Google Cloud Platform
^^^^^^^^^^^^^^^^^^^^^

Google Cloud Platform (GCP) is an Infrastructure as a Service (IaaS) provider with many data centers located all around the globe. To organize GCP resources for a particular OroCloud environment, the resources are grouped into a |GCP project|. Within a single project, resources are optimized for data transmission and communication within the same |region| and provide redundancy for high availability with redundant resources distributed among multiple zones.

GCP Data Centers
~~~~~~~~~~~~~~~~

Google's data centers are located in the US, South America, Europe, and Asia. Click |Data center locations| for more information. Google organizes its GCP resources into zones and regions to ensure:

* Fault tolerance, as every zone is isolated from other zones. It is highly unlikely for two zones to fail from the same cause.
* Fast network connectivity between zones in the same region, resulting in latency of under 5ms.
* On-demand resource distribution to multiple regions and protection from global disasters that may affect an entire region.

.. note:: Google is the first North American company to obtain multi-site |ISO 50001| Energy Management System certification for their data centers across the US, Europe, and Asia.

In OroCloud, you can pick the GCP region(s) where your Oro application environment will be allocated to. Taking fault-tolerance into account, all resources typically share the same geographic region for response-time optimization but are distributed across multiple zones within the selected region.

OroCloud Environment Infrastructure Diagram
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The diagram below reflects a standard Oro application deployment in GCP via OroCloud.

.. image:: /cloud/img/standard_average_environment_schema.png
   :alt: Architecture of a standard Oro application deployment in GCP via OroCloud

Redundancy
^^^^^^^^^^

Redundancy is a system design that ensures all system components are duplicated. In the event one of the hosts fails, the system can run using the redundant host.

The OroCloud infrastructure uses fully redundant components and services for Oro application operations. Check out the following sections for details on how redundancy is achieved.

Web Node
~~~~~~~~

Google Load Balancer distributes the incoming traffic to a set of the web nodes that enable on-demand scaling, fault tolerance, DDoS protection, etc. At least two web nodes are allocated in different zones for fault-tolerance.
For more information, see the |Google Cloud Load Balancing| documentation.

Search Index
~~~~~~~~~~~~

To speed up the search, Oro application data is indexed according to the application configurations and stored in the search index. As a search index provider, OroCloud instances use ElasticSearch which provides cluster architecture out-of-the-box as well as the ability to add more nodes to clusters to spread the load and enhance reliability. For more information, see the |Life Inside the Cluster| documentation.

Database
~~~~~~~~

Oro application data is stored in the PostgreSQL relational database. Each environment has at least two PostgreSQL instances, one in the main zone and another in the secondary zone. If the instance in the main zone becomes unresponsive, the environment automatically switches to the secondary zone enabling the database failover.

Job / Message Queue
~~~~~~~~~~~~~~~~~~~

Oro application uses RabbitMQ as a message queue broker to enable asynchronous processing for heavy jobs. RabbitMQ is highly scalable and supports cluster architecture out-of-the-box. RabbitMQ brokers tolerate the failure of individual nodes. Nodes can be initiated and stopped at will, as long as they can contact a cluster member node known at the time of shutdown. See |RabbitMQ Clustering| for more information.

To process queued messages, Oro application uses a proprietary consumer service. It runs as a daemon and handles all the jobs (messages) registered within a message queue.

The consumer service is scalable and can run as parallel processes on multiple hosts to handle a large volume of messages. To guarantee an acceptable response time and address spikes to the server-side workload, message processing can be scaled by adding more consumer services.

SMTP Relay
~~~~~~~~~~

To send emails from an OroCloud environment, the Oro application uses the dedicated SMTP Relay service, which provides high availability using a set of mail relays with different priorities. The setup is similar to a master-master database replication, where there is more than one active service to handle the requests.

See :ref:`Set Up SMTP for Applications on OroCloud <orocloud-smtp>` for more information.

Cache
~~~~~

Oro application uses Redis cluster to store cache which optimizes processing of complex operations. Redis Sentinel provides high availability for Redis cluster via the automatic failover and failure detection.

See |Redis Sentinel Documentation| for more information.

File Storage
~~~~~~~~~~~~

OroCloud environments are configured with a |BeeGFS| clustered file system to store application files related to the user data (attachments, images, documents).

Backups and Restore
^^^^^^^^^^^^^^^^^^^

Backups of OroCloud environment include the database dump, media files, and either the application source code or the repository commit hash that may be used to retrieve the code.

Schedule and Backup Retention Policy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Oro maintains a regular backup process which covers both database and media content. There are 3 types of backups depending on the target recovery point objective (RPO):

* Hourly backups. RPO - 1 hour. Oro stores hourly backups for last 7 days.
* Weekly backups. RPO - Sunday Oro stores weekly backups for the last 4 weeks.
* Monthly backups. RPO - last Sunday of the month. Oro stores monthly backups for last 12 month.

You can get the list of available backups and restore to the specific recovery point using :ref:`maintenance tool commands <orocloud-maintenance-use>`.

Encryption
~~~~~~~~~~

The backed up data is encrypted using AES-256 keys. The Retention policy for daily backups are retained for one week. Backups created on Sunday are retained for one year and they serve as weekly backups.

RTO
~~~

Restore time objective may vary from 30 minutes up to a couple of hours depending on the amount of data to be restored.

Maintenance
^^^^^^^^^^^

To maintain optimal performance, reliability, and security, the OroCloud team performs regular environment maintenance where the team may roll out environment updates during the predefined maintenance window.

During the events when a critical infrastructure security patch is released or some maintenance activity is urgently required for security or performance reasons, the OroCloud Services team reserves the right for unplanned maintenance windows. The Oro team will inform the environment owner about such maintenance activity.

Disaster Recovery
^^^^^^^^^^^^^^^^^

**Disaster Recovery** (DR) is a process that allows the IT support team to recover OroCloud service operations during a total failure or major malfunction of main hosting resources.

While every tier of GCP resources are redundant, there is still a chance a catastrophe can shut down the entire Google Cloud region. For service disruption, GCP Region failure should suffice but may not be required. Internet connectivity issues outside of Google and Oro's control may be caused by adversary actions or misconfiguration and may as well take down the Oro Cloud environments in a particular region.

Disaster Recovery Objectives and Criteria
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The following criteria define an event is classified under Disaster Recovery on OroCloud:

* The |GCP Region| hosting a particular OroCloud environment is not available and is not anticipated to be recovered by Google in the next hour.
* The OroCloud environment is not accessible because of network issues related to the GCP geographical location.

In the event of a disaster, the OroCloud team takes the following disaster recovery objectives:

* **Recovery Point Objective** - The instance is restored from the last daily backup.
* **Minimal Recovery Time** - It takes at least 60 minutes to restore service availability after the disaster recovery has been approved.
* **Maximum Recovery Time** - The recovery time depends on the backup volume and the complexity of the integration.

Disaster Recovery Principles
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Oro uses a cold disaster recovery location. No resources are allocated or billed until the disaster recovery is initiated. In case a disastrous event takes place at the primary location, the OroCloud environment is re-created at a different GCP Region unaffected by the disaster. Each GCP Region that is used for production hosting has a designated Disaster Recovery location.

Oro provides both primary and Disaster Recovery IP addresses to the customer as a part of onboarding information. These IP addresses must be added to the whitelists if any whitelisting is used.

Disaster Recovery Flow
~~~~~~~~~~~~~~~~~~~~~~

Customer Support will request DR approval by contacting environment owner technical contact person.

Once the DR is approved, OroCloud SWAT team uses the following action plan:

* Provision the DR infrastructure and restore latest backups at the new infrastructure
* Update the DNS record to point to the new location (if possible)
* Perform health checks for the restored instance

Once the health check for the restored instance is complete and the instance is up and running, Customer Support will notify the technical contact that the service has been successfully restored.

.. note:: If the Oro application is configured with the custom domain, the DNS record update should be handled by the domain owner.

System Configuration
^^^^^^^^^^^^^^^^^^^^

System configuration is managed as a code via the configuration management tool (Puppet).

Installed Software
~~~~~~~~~~~~~~~~~~

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

.. include:: /include/include-links-cloud.rst
   :start-after: begin
