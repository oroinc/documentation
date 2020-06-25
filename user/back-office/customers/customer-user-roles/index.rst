:oro_documentation_types: OroCommerce

.. _user-guide--customers--customer-user-roles:

Manage Customer User Roles in the Back-Office
=============================================

.. begin

.. hint:: This section is a part of the :ref:`Customer Permissions <concept-guide-customers-permissions>` concept guide topic that provides the general understanding of permissions and access levels available to customers and customer users in Oro applications.

.. note::
    See a short demo on |how to create customer roles in Oro applications|, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/xBbzgDYTVUQ" frameborder="0" allowfullscreen></iframe>

In Oro applications, you can view, edit, and create new customer roles to define the level of permissions and access to the actions and data in the storefront for the users of this role.

The following roles are preconfigured and available for every customer by default:

* **Administrator**
* **Buyer**
* **Non-authenticated Visitors**

Each newly created role can be either of a *predefined* or *customizable* type. When a role is assigned a certain customer in the role details, it becomes *customizable* and is available only for this specific customer. If no customer is assigned, the role type becomes *predefined* enabling any customer to use it.

With the customer user role, you can manage the following :ref:`access- and permissions-related settings <admin-capabilities>`:

* Profile management permission: A user may be able to view and edit their user profile when the **Self-Managed** option is enabled for their role.
* Permissions to view workflows and/or perform transitions through the workflow steps.
* Data access/management permissions and capabilities.

.. _user-guide--customers--customer-user-roles--create:

Create a Customer User Role
---------------------------

To create a new customer user role:

1. Navigate to **Customers > Customer User Roles** in the main menu.
2. Click **Create Customer User Role**.

3. In the **General** section, provide the following details:

   * **Name** --- A human-readable label that identifies a customer user role.
   * **Customer** --- A customer that has exclusive permission to use this role for their customer users. If the value is not provided, the role is available for all customers.
   * **Self-Managed** --- The flag that indicates whether the customer user can manage their own roles configuration.

4. In the **Entity** section, select the permissions that you want to grant to users who will be assigned the role you are creating.

   On the customer user role details page, you can view customer users with this role assigned. If the role is *global*, this list contains users from all customer accounts.

   .. note:: Please note that there are two ways to control the capability of a customer user to update their profile details in the storefront. One is defined by the **Edit** permission for customer users. When set to **Same Level/All Levels**, editing will become possible under **Account > All Users** in the storefront. The second one is defined by the **Update User Profile** capability which, when enabled, gives the customer user permissions to update details under **Account > My Profile** in the storefront.

5. In the **Workflows** section, specify access levels for workflows and workflow transitions. There are two permissions for workflows, **view** and **perform transitions**. By default, all workflow access levels are set to **None**. Choose the workflow or the transition to which you want to assign different permissions, click on the action name and select the required access level from the list.

6. In the **Customer Users** section, select check boxes in front of the customer users to whom you want to assign this role.

7. Click **Save**

View and Filter Customer User Roles
-----------------------------------

To view all customer user roles:

Navigate to **Customers > Customer User Roles** in the main menu.

You can view, edit and :ref:`filter <doc-grids-actions-filters-apply>` every item in the Customer User Roles record table:

* To view, click on the item once (or |IcView| at the end of the row) to open its details page.
* To edit, click |IcEdit| at the end of the row.
* To filter, click |IcFilter| above the table on your right, and specify the query.

.. note:: Keep in mind that only those customer user roles that have been created in the current organization will be displayed in the Customer User Roles record table of the current organization.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin


.. Related Articles**

.. `Understanding Roles and Permissions <user-guide-user-management-permissions>`
.. `Create and Manage Roles <user-guide-user-management-permissions-roles--actions>`
.. `Admin and System Capabilities <admin-capabilities>`

.. finish
