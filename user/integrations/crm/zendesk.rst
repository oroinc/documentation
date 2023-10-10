.. _integrations-crm-zendesk:

Integration with Zendesk
========================

Zendesk is a globally recognized, cloud-based customer service and engagement platform designed to streamline interactions between businesses and their customers. It offers a comprehensive suite of tools that enable organizations to provide personalized customer service across various communication channels, and address the issues that customers face in an efficient and timely manner.

The integration of Zendesk with OroCommerce offers a multitude of benefits for businesses operating in the e-commerce sector.

Key Zendesk Features
--------------------

Here is an overview of the key Zendesk features that OroCommerce supports:

* Quick setup and data sync from Zendesk to Oro
* Two-way sync of Zendesk's tickets as Oro cases to enable seamless customer management
* Fast and proper case solution management

Exchanged Fields
----------------

The fields passed from OroCommerce to Zendesk, and vice versa provide essential information on various customer-related information. They typically include:

**From OroCommerce to Zendesk:**

.. csv-table::

   "Case Info","The title and description of the ticket/case used to locate it in the grid."
   "Case Assignee","The email address of the person who the ticket/case is assigned to. If there is a matching email, the ticket is assigned to the related user. If there is no matching email, the ticket is assigned to the user with the default Zendesk user email."
   "Case Priority","The importance grade in which the cases are to be solved (*low, normal, high*)."
   "Case Status","Status of the ticket resolution to ensure that customers are aware when their issues are resolved (*open, in progress, resolved, closed*)"


**From Zendesk to OroCommerce:**

.. csv-table::

   "Ticket Info","Zendesk ticket number. Used to determine if an existing case/ticket must be updated or if a new one must be created."
   "Recipients Email","The email address of the person who the ticket/case is assigned to."
   "Case Priority","The importance grade in which the cases are to be solved (*low, normal, high*)."
   "Case Status","Status of the ticket resolution to ensure that customers are aware when their issues are resolved (*open, in progress, resolved, closed*)"


Security Measures
-----------------

OroCommerce and Zendesk prioritize the security and protection of sensitive data during the integration process. Both platforms comply with industry-standard security protocols, including:

- **Data Encryption:** All data exchanged between OroCommerce and Zendesk is encrypted using secure communication protocols (e.g., HTTPS) to prevent unauthorized access and data interception.

- **Authentication and Authorization:** Authentication and authorization mechanisms protect integration functionalities, ensuring only authorized users and systems can access them.

- **Data Privacy Compliance:** OroCommerce and Zendesk adhere to relevant data privacy regulations, such as GDPR (General Data Protection Regulation), to safeguard customer data and ensure data privacy rights are respected.

- **Regular Security Audits:** Both OroCommerce and Zendesk conduct regular security audits and vulnerability assessments to identify and address potential security risks.

**Related Articles**

* :ref:`Configure Zendesk Integration in the Back-Office <user-guide-zendesk-integration>`
