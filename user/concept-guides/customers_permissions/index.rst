.. _concept-guide-customers-permissions:

Customer Permissions
====================

Customer user roles have predefined sets of permissions and access levels. Roles are designed to give their owners a particular area of responsibility which defines what users can and cannot do within the website. Usually, roles are created based on the job responsibilities of specific users: a sales manager, a marketing team member, or an administrator. It is possible to create as many roles as required and configure them according to the needs of your company.

A role has the following types of permissions:

* System capabilities
* Entity-level permissions
* Workflow permissions

   .. image:: /user/img/concept-guides/customers/permissions.png
      :alt: Customer user roles

Each permission can be assigned a certain access level (*Corporate, Department, User, None*, etc). In Oro applications, access levels for :ref:`customer user roles <frontstore-guide-roles>` are similar to the :ref:`back-office user roles <user-guide-user-management-permissions-ownership-type>`, but, conceptually, they are not the same. More details on the permissions and access granted to the back-office users are described in the :ref:`Roles and Permissions <user-guide-user-management-permissions-roles>` topic.

Access levels for storefront user roles

   .. image:: /user/img/concept-guides/customers/access_levels_storefront_users.png
      :alt: Access levels for storefront user roles


Access levels for back-office user roles

   .. image:: /user/img/concept-guides/customers/access_levels_backoffice_users.png
      :alt: Access levels for back-office user roles


To illustrate all four access levels that can be defined for any user role in the storefront, let’s use the example of a Company A that has 2 departments: West and East. The West department has an LA subdivision. A selected customer user belongs to the West department.

   .. image:: /user/img/concept-guides/customers/access_levels_main.png
      :alt: Example illustration
      :width: 60%


In this case:

* The **Corporate** access level grants full access within the customer, its child customers, and subsidiary departments.

   .. image:: /user/img/concept-guides/customers/access_levels_corporate1.png
      :alt: Illustration of customer user role's permissions with a corporate access level
      :width: 50%

* The **Department** access level enables a customer user to manage the records created by other company users who belong to the same department. In this case, the user from the mentioned example won’t see any records created by other departments’ users as they are eligible for the department access only.

   .. image:: /user/img/concept-guides/customers/access_levels_department.png
      :alt: Illustration of customer user role's permissions with a department access level
      :width: 50%

* The **User** level gives access only to a customer user’s own records.
* **None** gives no access to any records. This data is disabled for the customer user.

.. note:: Note that neither **Department** nor **Corporate** access grants access to the departments that are higher in the organization hierarchy.

   .. image:: /user/img/concept-guides/customers/access_levels_no_access.png
      :alt: An example of customer user role's permissions that do not have access to the departments that are higher in the organization hierarchy
      :width: 50%

With all these access levels and capabilities, you can easily configure any role permission that is required for your business.


**Related Topics**

* :ref:`Storefront User Roles, Permissions, and Access Levels <frontstore-guide-roles>`
* :ref:`Back-Office User Roles, Permissions, and Access Levels <user-guide-user-management-permissions-roles>`


