:orphan:

Overview
--------

.. begin_overview

Adoption of cloud platforms has skyrocketed due to their elasticity, security, ability to quickly and easily deploy, and, most importantly, their minimized total cost of ownership.

With full control over the resources and infrastructure configuration that cloud platforms offer today, one can hardly find any downsides of moving their business solutions from the private in-house infrastructure to the highly distributed and fault-tolerant global resources provided by the cloud niche leaders.

Oro's cloud offering is based on Google Cloud Platform (GCP) which is used as Infrastructure-as-a-Service (IaaS) layer for OroCloud. GCP works well for OroCloud because it provides a flexible infrastructure that scales on-demand, end-to-end security, and a very competitive price. Google constantly expands their infrastructure by `opening new regions and enhancing the network <https://www.blog.google/topics/google-cloud/expanding-our-global-infrastructure-new-regions-and-subsea-cables/>`_.

.. note:: See Google’s take on `Why Google Cloud <https://cloud.google.com/why-google-cloud/>`_.

Although with GCP you can build and maintain the infrastructure that exactly fits any custom software and business domain, we have taken some steps to give you a hand in your Oro application roll-out. To enable flawless and seamless experience of launching and running Oro applications in the GCP infrastructure, we have designed an optimized deployment architecture, a set of facilitating tools, services, and procedures and grouped them under the OroCloud offering.

With OroCloud, you get the following package of services:

* Pre-configured Infrastructure that is optimized for running Oro applications
* Pre-installed vanilla or custom Oro application of your choice and configuration
* Controlled quick start with a guided tour of the Oro application
* Continuous access to your infrastructure and monitoring tools (on-demand)
* Access to the proprietary deployment tools that handle installation, upgrade, and backups of your cloud-based Oro application (on-demand)
* 24x7 support for P1 issues

The following benefits come along:

* Ease of use -- With OroCloud, you can focus on your business and save time and money on the in-house infrastructure technical support. OroCloud manages the application environment as part of the service, but we also offer a customized application maintenance service.
* Security -- OroCloud has been `PCI-DSS certified <https://cloud.google.com/security/compliance/pci-dss/>`_ since December 2017 and is scheduled for yearly reassessment and renewal. This means that every resource that the OroCloud environment uses -- the servers, network, software, and configuration -- comply with the `PCI DSS Shared Responsibility GCP v31 <https://cloud.google.com/files/PCI_DSS_Shared_Responsibility_GCP_v31.pdf>`_. See `How GCP smoothed our path to PCI-DSS compliance <https://cloudplatform.googleblog.com/2018/04/Oro-How-GCP-smoothed-our-path-to-PCI-DSS-compliance.html>`_ for more details.
* Reliability -- OroCloud is based on the highly reliable cloud platform and supports high-availability and fault-tolerant deployments out-of-the-box and comes with 24x7 technical support for P1 issues.

.. note:: Download the `OroCloud Commitments to GDPR <https://oroinc.com/b2b-ecommerce/wp-content/uploads/sites/3/2018/06/OroCloud-commitments-to-the-GDPR.pdf>`_ document to find out about the standards and best practices adopted by Oro Inc to support :ref:`GDPR requirements <user-guide--consents>`. 

**What’s Next**

This guide describes the following concepts and processes in detail:

* OroCloud :ref:`architecture <cloud_architecture>` and :ref:`security <cloud_security>`
* The typical process of OroCloud :ref:`onboarding <cloud_onboarding>`, including the secure certificate exchange and guided access to the necessary tools and :ref:`VPN connection <cloud_connect_vpn>`.
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* :ref:`Monitoring <cloud_monitoring>` principles and tools
* Information on how OroCloud team :ref:`handles incidents <cloud_monitoring>`
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).