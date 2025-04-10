:oro_documentation_types: Extension

.. _integrations-erp-sage:

Sage X3 Integration
===================

.. important:: This is a custom extension, not a core feature of OroCommerce, and is not covered by the Oro User License Agreement. Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Sage ERP X3 is a comprehensive and fully integrated enterprise resource planning system offering many features and functionalities. This software provides robust accounting and management control capabilities that can assist businesses in streamlining their financial operations, managing their resources more efficiently, and making better-informed decisions. In addition, its advanced analytical and reporting tools enable businesses to analyze data and generate insightful reports. Sage ERP also includes financial and business management tools that offer greater control and visibility into critical business processes.

The integration with Oro aims to seamlessly exchange customer and order data, including shipment tracking information. The synchronization occurs every minute and is implemented using a staging-tables approach.

Integration Features
--------------------

* Fast and reliable data exchange helps to improve the flow of data between OroCommerce and an ERP system, enabling the sales team to process orders smoothly while maintaining consistent data.

* The scope of data can be customized with ease, allowing for the integration of additional properties to be synchronized between both systems.

* The synchronization process is also flexible and can be integrated into custom workflows. For example, specific criteria may need to be completed before an order can be sent to the ERP.

* Integration configuration is achieved via the back-office system configuration settings, where basic parameters can be set without the need for technical team support:

  * Staging Tables database connection parameters.

  * Notifications regarding synchronization issues can be sent to multiple email addresses specified by the administrator. These emails will contain a detailed description of the problem at the integration level.

  * Communication logging which can be enabled to diagnose potential problems.

.. image:: /user/img/integrations/sage-integration-settings.png
   :alt: Illustration of the Sage settings in the system configuration
   :align: center

Data Exchange
-------------

.. csv-table::

   "**Customer Data Synchronization**","
   * **From Oro to ERP**: Whenever a new order is placed, all the necessary customer data is sent to the ERP system. Moreover, there is an option to set up an action that will update the customer data only in the ERP system in case a particular attribute of the customer is changed.
   * **From ERP to Oro**: During the sales process, OroCommerce application updates existing customers with relevant data such as credit limits."
   "**Orders Data Synchronization**","
   * **From Oro to ERP**: Complete information about the order, its line items, and custom attributes are sent from OroCommerce to the ERP system.
   * **From ERP to Oro**: Information about shipping tracking numbers is sent back to OroCommerce after creating parcel labels in an external system."
   "**Custom Data**","OroCommerce's flexible architecture allows for quick and easy setup of additional data synchronization."

.. image:: /user/img/integrations/sage-diagram.png
   :alt: Sage data sync diagram

Data Security
-------------

To ensure secure integration, the following security measures are implemented:

.. csv-table::

   "**Database Authorization**","The database offers a comprehensive set of security measures to ensure the protection of sensitive data. These measures encompass a range of fundamental and advanced techniques, such as user account authorization, secure socket layer (SSL) encryption, and role-based access control (RBAC). In addition, the system provides the ability to restrict access to specific IP addresses or ranges that can connect to the integration interfaces. By leveraging these security features, businesses can enhance their data protection posture and reduce the risk of unauthorized access or data breaches."
   "**Access Limited by IP Address**","Access to the integration endpoints is restricted based on IP addresses not only at the application layer but also at the network layer, where the database limits the number of possible connections."
   "**Direct Secure Tunnel**","It is possible to increase security by creating an SSH tunnel between OroCommerce and the target destination."

.. include:: /include/include-links-user.rst
   :start-after: begin