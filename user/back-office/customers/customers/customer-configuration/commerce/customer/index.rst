.. _user-guide--customers--customer-users--settings:

Configure Customer User Settings per Customer
=============================================

You can configure JIT provisioning of customer users per customer or customer user invitations :ref:`globally <sys-config--configuration--commerce--customers--customer-users>` and per :ref:`organization <system--user-mngm--organization--configuration--commerce--customers--customer-users>`, :ref:`website <system--website--configuration--commerce--customers--customer-users>`, :ref:`customer group <user-guide--customer-groups--customer-users--settings>`, and customer. The customer-level setting overrides the settings configured at the higher levels.

To configure customer user settings per customer:

1. Navigate to **Customers > Customers** in the main menu.
2. For the necessary customer, hover over the |IcMore| **More Options** menu to the right of the necessary customer and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Customer > Customer Users** in the menu to the left.

.. image:: /user/img/customers/customers/configuration/customer-users-configuration.png
   :alt: Customer user settings configuration

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **Customer Users Registration** section, configure the following options:

   .. note:: JIT provisioning of customer users is available as of OroCommerce version 6.1.9.

   * **Enable Just-In-Time (JIT) provisioning** --- Enable the feature for the customer. The feature automatically approves registration and single sign-on (SSO) requests from users whose email domains match the approved domains. The system assigns the default roles to these users and does not require a manual invitation. When you enable the feature, the **Approved Domains** and **Default Roles** options become available. The setting is available only when JIT provisioning is enabled in the :ref:`system configuration <sys-config--configuration--commerce--customers--customer-users>`.

   * **Approved Domains** --- Specify the email domains whose customer users the system registers automatically. Registration and single sign-on (SSO) requests from these domains are approved without manual review. Requests from all other domains are blocked.

   * **Default Roles** --- Select the customer user roles that the system assigns to every newly provisioned customer user.

5. In the **Customer User Invitations** section, clear the **Use Customer Group** checkbox and configure the following option:

   * **Enable Customer User Invitations** --- Enables/disables :ref:`customer user invitations <user-guide--customers--customer-user-invitations>` for the customer in the back-office and the storefront. When invitations are disabled, the invitation pages and actions are hidden. Enabled by default.

6. Click **Save Settings**.

**Related Topics**

* :ref:`Manage Customer User Invitations in the Back-Office <user-guide--customers--customer-user-invitations>`
* :ref:`Enable JIT provisioning globally in the Back-Office <sys-config--configuration--commerce--customers--customer-users>`
* :ref:`Invite a User in the Storefront <frontstore-guide--users-roles--invite-user>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin