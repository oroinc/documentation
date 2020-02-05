:orphan:

:title: OroCloud Monitoring Tools and Guidelines

.. meta::
   :description: The Oro applications monitoring principles and guidelines for the OroCloud administrators

.. _cloud_monitoring:

Monitoring
----------

Maintaining the service availability and monitoring the resource metrics is vital for any service operations. With monitoring processes, OroCloud ensures service continuity, efficient troubleshooting, and proactive resource management.

Monitoring Tools
~~~~~~~~~~~~~~~~

Stackdriver
^^^^^^^^^^^

In OroCloud, the main monitoring tool is Stackdriver -- the cloud service for monitoring applications hosted on Google Cloud Platform (GCP). Stackdriver is tightly integrated with GCP, requires minimal efforts for implementation and support, and generates no overhead for monitoring services and resources.

NewRelic, Blackfire and Quanta (Supported)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

While Stackdriver is proven to be powerful and flexible monitoring tool, OroCloud team can provide NewRelic, Blackfire or Quanta monitoring solutions for customer convenience.

Other tools, including proprietary suites and systems, need additional discovery before committing to implementation and support.

Monitoring Guidelines
~~~~~~~~~~~~~~~~~~~~~

Metrics Statistics
^^^^^^^^^^^^^^^^^^

There is a predefined set of metrics defined for every node with the specific function described in the sections below.

Generic GCE Linux Node
""""""""""""""""""""""

Stackdriver collects the following list of metrics for any node that is running on the Linux OS:
CPU utilization, %
Load average
Memory usage, %
Disk usage, %
Swap usage, %
Disk I/O, bytes per second
Network traffic, bytes per second
Open TCP connections
Processes count

DB Node
"""""""

For the database, the following metrics are collected (note that the metrics may vary depending on the version of the database system):

MySQL
'''''

Connections (count)
Select Queries (count)
Insert Queries (count)
Update Queries (count)

PostgreSQL
''''''''''

Connections (count)
Disk Usage (byte)
Commits (count/s)
Rollbacks (count/s)
Heap Blocks Read Rate (count/s)
Heap Cache Hit Rate (count/s)
Index Blocks Read Rate (count/s)
Index Cache Hit Rate (count/s)
Toast Blocks Read Rate (count/s)
Toast Cache Hit Rate (count/s)
Toast Index Blocks Read Rate (count/s)
Toast Index Cache Hit Rate (count/s)
Operations [delete, insert, update, heap only update] (count/s)
Dead Tuples (count)
Live Tuples (count)

Nginx, Elasticsearch, Redis, and RabbitMQ
"""""""""""""""""""""""""""""""""""""""""

Other metrics that are collected depend on the system’s monitoring plugins:
Nginx monitoring plugin
Elasticsearch monitoring plugin
Redis monitoring plugin
RabbitMQ monitoring plugin

Alerting
^^^^^^^^

Depending on the Recovery Time Objective, OroCloud classifies alerts by severity as warnings and critical alerts. These types of alerts use separate notification channels and trigger unique recovery flows that are described in the following sections.

Warning Alerts
""""""""""""""

SLA for Warnings
''''''''''''''''

For warning alerts, the reported issues are resolved in a 12-hour time frame. If it proves to be impossible, a critical incident is created since the issue may affect the production environment availability.

Warnings are sent to the dedicated email distribution list.

Recovery Flow for Warnings
''''''''''''''''''''''''''

Once the new warning is acknowledged, it is processed immediately, and the reporter is notified of the related root-cause. The progress of the issue and timeframe to resolution are also reported and logged in the comments section of the ticket. Once the issue is resolved, additional details on the resolution steps are provided as well.

Standard Alerting Policies for Warnings
'''''''''''''''''''''''''''''''''''''''
An alert is triggered once the monitoring system predicts that the actual metric value will exceed the threshold in the next 12 hours. The following alerting policies apply to every OroCloud environment:

* Disk usage -- Disk usage is above 80% and has been increasing with the rate of 1% per hour in the last hour
* Swap -- The swap usage registered in the last hour is above 10%
* HTTP 400 statuses -- More than 10% of 400 statuses are observed in the HTTP responses in the last hour
* HTTP 500 status -- More than 1% of 500 status is observed in the HTTP responses in the last hour
* Process count -- Changed by more than 10% in the last 30 minutes.

Escalation for Warnings
'''''''''''''''''''''''

The warning is escalated to a critical incident if it is expected to be fixed in more than 12 hrs or if the warning alert repeats in less than 12 hours.

Critical Alerts
"""""""""""""""

SLAs for Critical Alerts
''''''''''''''''''''''''

The critical alert means that service is not available or there is a clear sign that service will be down in roughly 10 minutes. Critical alert needs an immediate reaction from the system engineer, and it automatically triggers an incident creation. Recovery Time Objective for critical incidents is 30 minutes.

Notification Channels for Critical Alerts
'''''''''''''''''''''''''''''''''''''''''

Critical alerts are sent to the dedicated email distribution list.

Recovery Flow for Critical Alerts
'''''''''''''''''''''''''''''''''

Each critical alert triggers the execution of the Incident Response Plan which aims to solve critical issues as soon as possible.

.. more info will follow

Standard Alerting Policies for Critical Alerts
''''''''''''''''''''''''''''''''''''''''''''''

The alert is triggered once the monitoring system identifies that the service hosted in the OroCloud environment is unavailable or severely degraded. The following alerting policies apply to every OroCloud-based instance:

* Production health check -- The HTTPS URL is not responding with a timeout of 1s when accessed from all locations provided by Stackdriver
* HTTP 500 status code -- More than 5% of 500 status codes are observed in the HTTP responses in the last 5 minutes
* Disk usage -- The disk usage is above 95% in the last 30 minutes
* Swap -- The swap usage registered in the last 30 minutes is above 50%
* Message queue -- Zero consumers are connected to the RabbitMQ in the last 5 minutes

Escalation for Critical Alerts
''''''''''''''''''''''''''''''

Escalation is performed according to the Incident Response Plan.

Planned Maintenance Windows
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Maintenance windows for the production OroCloud environment are planned and scheduled ahead of time. If the maintenance is initiated by the OroCloud service team and involves only infrastructure changes, the alerts are muted.

Incident Management
~~~~~~~~~~~~~~~~~~~

To handle unexpected service-related issues, OroCloud team has an Incident Response Plan in place. It covers the following information:

* SWAT team members and roles -- Information about the incident resolution team, including their contact details, and office and emergency numbers
* Incident triggers -- The conditions that trigger the service recovery actions
* Notification flow -- Who and when should be informed of and involved in the incident response progress
* Escalation process -- How and why the incident may be escalated according to the complexity and involve additional resources if necessary
* Incident closing steps -- What are the steps and actions that should happen after the incident is resolved
* Post-mortem analysis -- An analysis that identifies root causes and measures to prevent the incident with the same root causes from happening in the future. Measures may be (but are not limited to) the following: the fixes in the product, infrastructure changes, improvement of the monitoring process, any other processes and procedure changes, personnel training, etc.

When an incident happens, affected OroCloud customers get an email notification informing them of the incident. The support team may request cooperative actions from the customer's IT team. Customers are also informed about the service recovery.

**What’s Next**

* The typical process of OroCloud :ref:`onboarding <cloud_onboarding>`, including the secure certificate exchange and guided access to the necessary tools
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).
