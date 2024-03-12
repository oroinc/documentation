.. _integrations-e-procurement-systems-greenwing-punchout:

E-Procurement Integration with Greenwing Punchout
=================================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Integration Overview
--------------------

Oro offers a punchout integration with e-procurement systems using a middleware solution provided by Greenwing Technology, enabling users to log in, create and update shopping lists, and submit punchout orders.

Data Flow
---------

Oro API is used to authenticate users from e-procurement systems (autologin functionality) and submit punchout orders.
Oro uses Greenwing Middleware to transfer shopping lists to an e-procurement system.

Below is an illustration of the data flow between Oro, Greenwing middleware, and e-procurement systems:

.. image:: /user/img/integrations/greenwing-data-flow.png
   :alt: Data flow between Oro, Greenwing middleware and e-procurement systems

Supported Features
------------------

The integration offers a range of features to enhance the procurement process and improve user experience:

.. csv-table::

   "Autologin Functionality","Users can log in from e-procurement systems without manual credential entry, enhancing the login experience."
   "Shopping List Management","Oro allows for the creation and efficient management of shopping lists, ensuring up-to-date procurement lists. In the punchout mode, a single shopping list is created automatically when a new session is started by autologin."
   "Order Submission","The integration facilitates punchout order submission from e-procurement systems to Oro, supporting custom fields for order information."
   "Punchout Mode Emulation","Users can enable emulation of the punchout mode for Customer Users, facilitating controlled testing without relying on external systems."
   "iframe Compatibility","The integration works seamlessly with e-procurement systems that display the Oro website within an iframe."
   "Custom Logger Channel","A custom logger channel *greenwing_punchout* is available for monitoring and auditing integration-related activities."
   "Secure Authentication","Strong security measures protect user authentication and sensitive data throughout the integration process."

Security Measures
-----------------

Several security measures and processes are in place to ensure a secure exchange of data and user authentication:

* **Token-Based Authentication:**

  A token-based authentication system is used to verify the identity of users during the autologin process. This ensures that only authorized users can access the system, eliminating the need for manual entry of login credentials and reducing the risk of unauthorized access.

* **Secure Data Transfer:**

  Data is transmitted over secure and encrypted channels. This prevents interception and eavesdropping of sensitive information, such as shopping lists, order details, and user authentication tokens.

* **Access Control and Permissions:**

  Native role-based access control and permissions are enforced to restrict access to specific features and data within Oro. This ensures that only authorized users can perform actions such as creating or modifying shopping lists, submitting orders, and accessing certain UI/UX features. As part of this integration, native Oro ACL capabilities are extended to ensure that users can view and edit shopping lists related to their punchout sessions only when the punchout mode is active.

* **SameSite and Cross-Origin Cookie Handling:**

  To allow for seamless interactions within an iframe, the integration handles SameSite attributes and cross-origin cookies. This helps prevent cross-site request forgery (CSRF) and ensures that cookies are securely transmitted in responses to cross-origin requests. It also enables the display of the Oro website within e-procurement system iframes without compromising security.

These security measures collectively safeguard user authentication, data integrity, and access control. They provide a secure environment for users and administrators to engage in procurement activities while mitigating potential security risks and vulnerabilities that could compromise the integrity of the integration.

.. include:: /include/include-links-user.rst
   :start-after: begin