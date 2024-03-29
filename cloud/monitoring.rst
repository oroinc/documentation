:orphan:

:title: OroCloud Monitoring Tools and Guidelines

.. meta::
   :description: The Oro applications monitoring principles and guidelines for the OroCloud administrators

.. _cloud_monitoring:

Monitoring
==========

Maintaining the service availability and monitoring the resource metrics are vital for any service operations. With monitoring processes, OroCloud ensures service continuity, efficient troubleshooting, and proactive resource management.

Monitoring Tools
----------------

Oro Monitoring
^^^^^^^^^^^^^^

Oro uses different tools for monitoring of OroCloud, both the industry-standard and in-home developed. All these tools are maintained by Oro for OroCloud environments which allows to build and use a comprehensive monitoring system that controls all vital aspects of infrastructure and application. The Oro support team uses an efficient alert management system, a well-defined escalation procedure, as well as an effective incident response plan to manage incidents detected by the monitoring system.

We do not provide access to its internal monitoring system, nor do we subscribe anyone to the internal alerts from it.

Google Cloud’s Operations Suite
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Oro customers and partners can configure their own additional monitoring metrics using Google Cloud’s operations suite's GCP monitoring. Oro customers can use it for:

* Monitoring the application uptime using different network locations.
* Monitoring the generic OS metrics, such as CPU load, disk and network IO, etc.

Uptime Monitoring
~~~~~~~~~~~~~~~~~

Google Cloud’s operations suite allows monitoring application availability using uptime checks. An uptime check tries to open the application URL and then calculates the response time. An uptime check can connect to the application from multiple locations in the North and South America, Europe, and the Asia-Pacific region. Customers can check if the main page of the application opens as well as any other page, including those that need authentication (you need to use a dedicated application user for this case).

.. note:: Please be careful and keep the number of uptime checks reasonable to avoid additional workload from monitoring.

Results of uptime checks are available via GCP web GUI. More information about configuring and managing uptime checks and alerts is available in the corresponding |GCP documentation|.

OS Metrics Monitoring
~~~~~~~~~~~~~~~~~~~~~

Google Cloud’s Operations Suite provides the ability to monitor generic OS metrics, such as CPU load, disk load, load balancer, etc. Its Metrics explorer allows collecting, visualization, and alerting on such metrics.

Please keep in mind that the Oro support team is monitoring all key OS metrics and responses on the alerts generated by threshold violations.
More information about OS metrics monitoring is available in the corresponding GCP documentation on |Metrics Explorer|.

NewRelic and Blackfire (Supported)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Customers can enable NewRelic and Blackfire monitoring solutions for the OroCloud environment. Please note that you need to obtain your own license for the tool you are going to use.
Other tools, including proprietary suites and systems, need additional examination before committing to the implementation and support.

Metrics Monitored by OroCloud Support Team
------------------------------------------

This section provides an overview of the metrics monitored for every OroCloud environment to help you understand how OroCloud instance is monitored by Oro, and set relevant expectations. You can use this section as a reference for creating your own monitoring system for the Oro product.

Please note that there is no way to get any access to or visibility of the metrics mentioned here. The exact set of metrics, alerting and escalation rules depends on the type of the environment (e.g., Staging or Production) and is changing as the OroCloud team improves monitoring.

There are 3 main categories of monitored metrics: OS metrics, component servers metrics, and application metrics.

OS Metrics
^^^^^^^^^^

OroCloud monitoring system collects and analyzes a big set of metrics that provide visibility into the performance and capacity of the virtual hosts, used in the OroCloud environment. Here are the most important metrics:

* CPU usage and load average.
* Disk space utilization.
* Disk IO metrics.
* RAM utilization.
* SWAP usage.
* Network bandwidth utilization and statistics.
* Process count.
* Zombie process count.
* Logged users count.

Component Servers Metrics
^^^^^^^^^^^^^^^^^^^^^^^^^

The OroCommerce application consists of different servers as its components, and OroCloud monitoring system also watches how they collect statistics and alerting on violated metric thresholds. Each of these servers has a specific set of metrics that must be monitored:

* Nginx web server – internal server statistics including connection count, requests rate, PHP-fpm process count, requests rate, etc.
* PostgreSQL – connections count, indices usage, internal memory allocation, requests rate, slow request, replication, backup status, locks.
* Redis – collections size, allocated memory, requests rate, cluster status.
* RabbitMQ – queues count and sizes, memory consumption, connections count, cluster state.
* Elasticsearch – internal server statistics including Java VM metrics, cluster state, requests rate, backup status.

Application Metrics
^^^^^^^^^^^^^^^^^^^

OroCloud monitoring system uses many application metrics that provide information about application performance, availability, health and security. The set of this metrics is constantly evolving. The key metrics are listed below.

* Web check – monitoring system opens the main page of the application every couple of minutes. This is the main availability indicator for the application.
* SSL checks – verifies if the SSL certificate is OK and when it has to be renewed.
* DNS check – verifies if DNS record correct.
* HTTP's status statistic – checks how many HTTP requests have got “not OK” status: 4xx and 5xx.
* Application error statistics – checks application errors to detect abnormalities and faults.
* RabbitMQ application specific queues – checks if all application-specific message queues are present and processing.
* Oro consumers – checks how consumers process messages from the RabbitMQ.
* Application orders, users and SKU statistics.

OroCloud Support Team Incident Response Overview
------------------------------------------------

This section is an overview of the incident response guidelines and plans used by the OroCloud support team to help customers understand Oro's internal procedures and set incident recovery expectations.

Alerting Approach
^^^^^^^^^^^^^^^^^

Depending on the nature of the metric mentioned in the previous section, it can produce an alert for the OroCloud support team if the metric value reaches a certain threshold. The Oro monitoring system defines 2 levels of these thresholds: **warning and critical**. Please note that none of these alerts are visible to the customers. The information is provided for the reference only.

Warning
~~~~~~~

Warning threshold violation for a particular metric indicates that the application may experience issues if this metric does not recover to the operational value. These thresholds allow to prevent potential issues before they turn into an incident. A good example of such warning is the disk usage warning.

Warnings do not initiate incident response and are processed routinely during business hours.

Critical
~~~~~~~~

Critical threshold violation indicates that an application incident is imminent or already in progress. Once triggered, these alerts initiate an incident response.

Incident Management
^^^^^^^^^^^^^^^^^^^

This section is an overview of the incident response guidelines and plans used by the OroCloud support team to help you understand Oro's internal procedures and set incident recovery expectations.

To handle unexpected service-related issues, the OroCloud team uses an Incident Response Plan. It covers the following information:

* SWAT team members and roles – Information about the incident resolution team, including their contact details, office and emergency numbers.
* Incident triggers – The conditions that trigger the service recovery actions.
* Notification flow – Who and when should be informed of and involved in the incident response progress.
* Escalation process – How and why the incident may be escalated judging by the complexity; may involve additional resources, if necessary.
* Incident closing steps – The steps and actions that should happen after the incident is resolved.
* Post-mortem analysis – An analysis that identifies the root causes and measures to prevent similar incidents from happening in the future. Measures may be (but are not limited to) the following: fixes in the product, infrastructure changes, improvement of the monitoring process, any other changes in processes and procedures, personnel training, etc.

When an incident happens, affected OroCloud customers get an email notification informing them of the incident. The support team may request cooperative actions from the customer’s IT team. Customers are also informed about the service recovery.

Planned Maintenance Windows
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Maintenance windows for the production OroCloud environment are planned and scheduled ahead of time. If the maintenance is initiated by the OroCloud service team and involves only infrastructure changes, the alerts are muted.


.. admonition:: Business Tip

   What is the future of |business to business eCommerce|? Learn about the latest trends and commerce technologies in our complete guide.


**What’s Next**

* The typical process of OroCloud :ref:`onboarding <cloud_onboarding>`, including the secure certificate exchange and guided access to the necessary tools
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).

.. include:: /include/include-links-cloud.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin