.. _solution-architect-guide--cloud-infrastructure:

OroCloud and Infrastructure
===========================

This section explains OroCommerce's deployment architecture, infrastructure services, deployment and environment types, network segmentation, security measures including subnets, firewall rules, and maintenance zones, as well as support options

Deployment Architecture
-----------------------

Oro Inc. offers :ref:`OroCloud <orocloud>`, a cloud solution based on the Google Cloud Platform (GCP) or Oracle Cloud Infrastructure (OCI) to host OroCommerce applications. The following diagram shows the general overview of the :ref:`OroCloud infrastructure architecture <cloud_architecture>` and used virtual machines.

.. image:: /img/solution-architect/15-environment-diagram.png

Infrastructure Services
-----------------------

OroCloud infrastructure offers multiple services that ensure the consistency and performance of the OroCommerce application. The following table describes the purpose of these services.

.. csv-table::
   :header: "Service","Description"
   :widths: 15, 40

   "Application Support","Oro Inc. releases multiple application updates during its lifetime. Long-term support (LTS) versions are released every year. They provide major technical and functional updates and are supported for 36 months. Patch versions are released every several weeks for all currently maintained/supported LTS versions. They are mainly used for bug fixes, security patches, and minor improvements. Check the :ref:`release process documentation <doc--community--release>` for more details."
   "Application Operations","Oro Inc. monitors the application status and handles incidents 24/7. The support team checks overall application health, monitors hardware, and checks application logs. The support team can request confirmation from the customer and perform necessary actions to maintain the application when needed."
   "Maintenance Tools","Oro Inc. provides multiple tools to set up and maintain OroCommerce installations. These tools include CLI utilities, configuration files, patches, scheduled tasks, and setting custom environment variables. Software and cloud engineers can use these tools to update the application, run various infrastructure-related operations, and tune the environment."
   "Patch and Vulnerability Management","Oro Inc. ensures that existing installations use the latest versions of all used components with the latest functional updates and security fixes. The team upgrades infrastructure components on the fly when possible, or agrees with the customer on the preferred upgrade time when downtime is required. These services also include automatic daily backups that can be used to restore the application."
   "Disaster Recovery","The Oro Inc. team can recover the application after a total failure or major malfunction with the main hosting resources. They use the latest backup to restore the application and perform health checks for the restored instance to ensure that it is fully functional. See the disaster recovery documentation for more details."
   "Infrastructure Services","Oro Inc. manages and scales all infrastructure resources, including networks, firewalls, storage, and compute nodes, to meet customer needs."
   "Access Management","The Oro Inc. team can grant access to the application maintenance node, maintenance tools, and application logs based on customer demands. Access is granted per user. The history of all actions performed by each user is tracked in the special maintenance logs"
   "Billing Management","The basic tier for the production is included in the license cost, while any additional resources or infrastructure upgrades increase the cost and are charged separately"

Deployment Types
----------------

There are four typical deployment options for the OroCommerce application: OroCloud, public cloud, private cloud, and on-premise. The following table shows each type's pros and cons by demonstrating the level of support for each service.

.. csv-table::
   :header: "Service","OroCloud (Saas, Hosted)", "Public Cloud (Hosted)", "Private Cloud (Hosted)", "On-Premise"
   :widths: 30,15,15,15,15

   "Application Support","**Full Support**","**Full Support**","**Full Support**","**Full Support**"
   "Application Operations","**Full Support**","**Full Support**","**Full Support**","No Support"
   "Maintenance Tools","**Full Support**","**Full Support**","**Full Support**","No Support"
   "Patch and Vulnerability Management","**Full Support**","**Full Support**","**Full Support**","No Support"
   "Disaster Recovery","**Full Support**","*Supportable*","*Supportable*","No Support"
   "Infrastructure Services","**Full Support**","*Supportable*","No Support","No Support"
   "Access Management","**Full Support**","*Supportable*","No Support","No Support"
   "Billing Management","**Full Support**","No Support","No Support","No Support"

Environment Types
-----------------

Four :ref:`environment types <cloud-environments>` are typically used in the project development lifecycle: development, testing/UAT, staging, and production. The following table describes the purpose and traits of each environment type.

.. csv-table::
   :header: "Name","Primary Users", "Purpose", "Structure", "Data Restrictions"
   :widths: 5,10,30,5,20

   "Development","Software engineers","Allow developers to test custom features, verify requirements, and check all features for compatibility. Essentially, it is a sandbox for developers.","Single host","Minimum amount of data to test custom features. No real production data, but a sanitized version can be used if needed."
   "Testing/UAT","BA,Stakeholders","Allow BA to verify requirements, show features to stakeholders, and let them test the application with a limited amount of data. Essentially, it is a sandbox for stakeholders.","Single host","Minimum amount of data to demonstrate both built-in and custom features. No real production data, but a sanitized version can be used if needed."
   "Staging","BA, Stakeholders, Application administrators","Allow BA and stakeholders to test the application with the full (expected) amount of data. Let application administrators change the configuration or data, and test the application before doing it in production. Essentially, it is a replica of the production instance with sanitized data","Multi-host","A full (expected) amount of data. A sanitized version of production data is recommended."
   "Production","Application administrators, Customers","Allow application administrators to configure the application and set the data. Let customers use all the application features.","Multi-host","Full application data"

Network Segmentation
--------------------

Resources of the :ref:`OroCloud environment <cloud_security>` are isolated in the dedicated virtual private network (e.g., GCP project or OCI subtenancy). This provides complete resource segregation for each particular instance. The network for the production deployment is divided into the following two subnets:

* Application subnet
* Maintenance DMZ subnet

Application Subnet
^^^^^^^^^^^^^^^^^^

All nodes that run Oro application components and store production data reside in the application subnet.
The application subnet accepts incoming traffic exclusively from CDN services (e.g., CloudFlare, Google CDN). For exact information about CDN usage and traffic handling, please refer to the :ref:`OroCloud Security documentation <cloud_security-application-subnet>`.

The following network rules are used in the application subnet for the internal and outgoing traffic:

* Nodes in the application subnet accept a connection to the service-specific ports that originated exclusively from the application subnet.
* The NAT node remaps the outgoing public traffic with a public IP address. This public IP address may be added to external whitelists and used to control the outgoing traffic from the application subnet.
* The NAT node does not accept any incoming connections to the interface with the public IP address.
* Only the bridge host is allowed to connect to nodes in the application subnet. The bridge host has two network interfaces: one connected to the application subnet and the other linked to the maintenance DMZ subnet.
* The OroCloud support team uses the connection via the Secure Shell (SSH) protocol to access the application subnet and perform application maintenance.

Maintenance DMZ Subnet
^^^^^^^^^^^^^^^^^^^^^^

The :ref:`maintenance DMZ subnet <cloud_security>` is reserved exclusively for the VPN gateway node, which is used for maintenance purposes. This subnet also shields the application subnet from potential external attacks while migrating risks from the web-facing application node being breached.

Authorized IT support may access the VPN Gateway via a secure OpenVPN connection. OpenVPN uses multi-factor authentication to enforce traffic protection for information transferred between the client workstation and OroCloud resources.

Traffic and Firewall Rules
^^^^^^^^^^^^^^^^^^^^^^^^^^

There are only 2 possible ways to access an OroCommerce application:

* From the :ref:`Load Balancer or Cloudflare tunnel <cloud_security-application-subnet>`
* From the OpenVPN bridge

Traffic that does not leave the network and outgoing traffic are not restricted. For network information protection, the outgoing traffic is remapped via the NAT node.

In the maintenance DMZ subnet, incoming traffic from the OpenVPN bridge is allowed only via UDP on the 31194 port. Traffic that does not leave the network and outgoing traffic are not restricted.

Infrastructure Security
-----------------------

Below are the security measures OroCloud uses. For more information, please see the :ref:`OroCloud Security <cloud_security>` documentation.

.. csv-table::
   :header: "Measure","Description"
   :widths: 10, 40

   "Resources Isolation","The OroCloud environment is a single-tenant deployment and is completely isolated from other instances."
   "Network","The OroCloud environment uses network security controls to manage traffic inside the environment and allow only necessary connections between specific components."
   "Encryption","The only way to connect to the instances is through the SSH using public key authentication. The only protocol to access the application from the web is HTTPS. Data at rest is encrypted to ensure data protection."
   "Data protection","DB dumps can be created and downloaded with sanitized data only. Sanitization removes all private and secure information from DB and replaces it with random values. The infrastructure fulfills all data protection requirements for PCI DSS and SOC2 standards."
   "Stability","Web application firewall (WAF) protects the application from a large number of requests, i.e. from DoS/DDoS attacks."
   "Logging","The infrastructure provides restricted access to the application logs. Storing policies prevent the logging of secure or private information, e.g. credentials."
   "Backups","All application backups are encrypted and protected from direct access."

Support
-------

:ref:`OroCloud’s customer support <cloud_support>` is available for Oro authorized partners and Enterprise Edition customers.

For support, assistance, or security incident requests, a customer support desk is available 24x7x365 for ticket submission and further ticket-related communication.

Your request may be assigned to one of the following priorities.

.. csv-table::
   :header: "Priority","Initial Response Time", "Description"
   :widths: 10, 10, 50

   "Priority 1 (P1)","4 hours","Issues that cause the complete unavailability of the production application or the inability to use mission-critical functionality within the application are called P1 issues. For P1, there are no workarounds. Examples of P1 issues are the application being down or not available to the end users, data loss or corruption making an essential part of the application unusable, etc."
   "Priority 2 (P2)","24 hours","A serious problem within the application where a major feature/function failure has occurred. The application is functioning but at severely reduced capacity, or the problem is causing a significant impact on some of the customer’s business operations and productivity, or the application is exposed to potential loss or interruption of service."
   "Priority 3 (P3","24 hours","A medium-to-low impact problem that involves partial or non-critical loss of functionality, or that impairs some operations but allows customer operations to continue to function."
   "Priority 4 (P4)","24 hours","Reserved for general use questions, cosmetic issues, and documentation-related questions. With P4, the application works without any functional limitations."
   "Priority 4 (P4)","N/A","Recommendation for future product enhancement or modification to add official support and documentation for the unsupported or undocumented feature, or features that do not exist in the application."

Check the :ref:`support process documentation <cloud_support-process>` for further guidance.