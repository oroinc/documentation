:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-user-management:
.. _user-guide-user-management-permissions-roles--acl:

Configure Users, User Groups, Organization, and Business Units in the Back-Office
=================================================================================

Oro uses the hierarchy of roles to determine the levels of user access to data. In Oro applications, user, role and access management capabilities can be tailored to reflect any specific administrative hierarchy, helping define access and permission settings for any business need.

This section describes in detail how to create and manage the elements of the administrative structure, such as users, user groups, organization, and business units, illustrates how to work with roles and permissions, and demonstrates how to configure access to data.

Administrative Structure
------------------------

The hierarchy within the administrative structure is broken down into the user, user group, business unit and organization elements:

* **Users** --- The lowest element of the administrative structure. This is a person, a group of people or a third party system with a specific set of credentials (login and password). Any number of users can be created within one Oro instance.

* **User Groups** --- A group of users, created in consideration of an administrative structure or regardless of it (for example, all users born in February or all the users invited to a specific meeting). A user group may be used in the system as a single aggregating :ref:`entity <entities-management>`.

* **Business Units** --- A business unit groups users with similar business or administrative tasks or roles. Any number of users can be assigned to a business unit. One user can belong to several business units. Each business unit can also have child sub-units. A business unit that has child sub-units is their *parent* business unit. One parent business unit and its sub-units are jointly addressed as a **division**.

* **Organizations** --- The highest element of the administrative structure. It represents a real enterprise, a business, a firm, a company, or another organization to which users belong.

  .. note:: :ref:`Several organizations <user-ee-multi-org>` can be created in one system in the Enterprise edition, and only one organization in the Community edition.

Check out the topics below for more information on each of the elements:

* :ref:`Create and Manage Users <doc-user-management-users-actions>`
* :ref:`Create and Manage User Groups <user-management-groups>`
* :ref:`Create Business Units <user-management-bu>`
* :ref:`Create and Manage Organizations <user-management-organizations>`

Role Structure
--------------

Roles are the predefined set of permissions used to grant controlled access to the system data. After users are assigned a specific role that is typically based on job functions, they can manage information relevant to their job role. This is necessary to protect information, so that users are only given access to information they need to see, and not flooded with information that they do not need. This way, for example, the sales department can be restricted only to working with leads, the marketing department can only see and work with marketing lists and campaigns, while administrators can access all systems globally.

The ability of particular users to access data and perform actions in the system depends on several criteria:

*  Roles assigned to the user
*  Organizations and units to which the user has access
*  The owner of particular data

The following topics describe the available access levels and explain the difference between them, illustrate how levels can be used, and explain how to configure the required ownership type. They also provide a detailed explanation of different types of permissions and the ownership types and illustrate how to create and manage new roles in the application:

* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Field Level Permissions <user-guide-user-management-permissions-roles--field-level-acl>`
* :ref:`Entity and System Capabilities <admin-capabilities>`
* :ref:`Create and Manage Roles <user-guide-user-management-permissions-roles--actions>`
* :ref:`End-to-end Access Configuration in Context <user-guide-user-management-permissions-roles--examples>`

OAuth Applications
------------------

The section aggregates information on all OAuth applications created for users in the back-office. Here, you can view and manage the existing OAuth applications, create new ones, and get access tokens through the applications with client credentials and passwords grant types. Check out the :ref:`OAuth Applications <oauth-applications>` topic for more details on how to add the application both from the Oro and third-party sides.

Login Attempts
--------------

The section aggregates the login info data in one datagrid. This simplifies investigation of any security-related incidents.
Check out the :ref:`Login Attempts <user-guide-user-management-login-attempts>` topic for more details.

.. toctree::
   :hidden:
   :maxdepth: 1

   Users <users/index>
   Roles and Permissions <roles/index>
   User Groups <groups/index>
   Business Units <business-units/index>
   Organizations <organizations/index>
   Login Attempts <login-attempts/index>
   OAuth Applications <oauth-app>

.. include:: /include/include-images.rst
   :start-after: begin



