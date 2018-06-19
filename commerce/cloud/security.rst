:orphan:

.. _cloud_security:

Security
--------

.. contents::
   :local:
   :depth: 1

Network Segmentation
~~~~~~~~~~~~~~~~~~~~

Resources of the OroCloud environment are isolated in the dedicated Google Cloud Platform project. The network for the production deployment is divided into the following two subnets:

* `Application subnet`_
* `Maintenance DMZ subnet`_

The following diagram illustrates the network segmentation of a typical Oro application deployment in OroCloud environment:

.. image:: /cloud/img/orocloud_network.png
   :alt: The network segmentation of an average Oro application deployment in OroCloud environment

Application Subnet
^^^^^^^^^^^^^^^^^^

All nodes that run Oro application components and store production data reside in the **application subnet**.

The following rules apply to the traffic in the application subnet:

* No public IP addresses are directly connected to the application subnet. The only publicly accessible IP address points to the Google load balancer.
* The Oro application web server accepts connections only from this load balancer via port 80 over HTTP and port 8080 over the WebSocket connection.
* The load balancer terminates any HTTPS traffic.
* Nodes that reside in the application subnet accept connection to the service-specific ports that originated exclusively from the application subnet.
* The outgoing public traffic is remapped by the NAT node with a public IP address. This public IP address may be added to any external whitelists and may be used to control the outgoing traffic from the application subnet.
* The NAT node does not accept any incoming connections to the interface with the public IP address.
* Only the bridge host is allowed to connect to nodes that reside in the application subnet. The bridge host has two network interfaces; one is connected to the application subnet, the other one is linked to the maintenance DMZ subnet.
* To access the application subnet and perform application maintenance, the OroCloud support team uses the connection via the Secure Shell (SSH) protocol.

Maintenance DMZ Subnet
^^^^^^^^^^^^^^^^^^^^^^

The **maintenance DMZ subnet** is reserved exclusively for the VPN gateway node, which is used for the maintenance purposes. This subnet also shields the **application subnet** from potential external attacks while migrating risks from web-facing application node being breached.

The OroCloud support team or your authorized IT support may access the VPN Gateway via a secure OpenVPN connection. OpenVPN uses multi-factor authentication to enforce the traffic protection for the information transferred between the client workstation and OroCloud resources.

Traffic and Firewall Rules
~~~~~~~~~~~~~~~~~~~~~~~~~~

In the **application subnet**, the incoming traffic is allowed via the following channels:

* From the **Load Balancer**: via 80, 443 and 8080 ports; the latest is reserved for web sockets
* From the **OpenVPN** bridge: via ICMP and 22 port

The traffic that does not leave the network and the outgoing traffic is not restricted. For network information protection, the outgoing traffic is remapped via the NAT node.

In the **maintenance DMZ subnet**, the incoming traffic is allowed from the **OpenVPN** bridge only via UDP on the 31194 port. The traffic that does not leave the network and the outgoing traffic is not restricted.

Connecting to the Production OroCloud Environment Using VPN
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The OroCloud support team can provide individual maintenance access (using SSH2 protocol) to the production instance hosts for your company’s authorized IT support.

.. warning:: Please avoid sharing access credentials, as this violates the information security best practices and standards, including PCI-DSS.

To gain access, a customer needs to send the request to Oro's customer support portal (Oro Inc. Support Desk).

.. may be more info

DDoS Protection
~~~~~~~~~~~~~~~

Google Cloud Platform provides a number of tools to prevent and defend against DDoS attacks.
See `GCP DDoS protection <https://cloud.google.com/files/GCPDDoSprotection-04122016.pdf>`_ for more details.

**What’s Next**

* The typical process of OroCloud :ref:`onboarding <cloud_onboarding>`, including the secure certificate exchange and guided access to the necessary tools
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* :ref:`Monitoring <cloud_monitoring>` principles and tools
* Information on how OroCloud team :ref:`handles incidents <cloud_monitoring>`
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).
