.. _user-management-organization-create:

Create an Organization in the Back-Office
=========================================

.. important:: Multi-organization management is only available in the Enterprise edition.

You can create a new organization from within a global organization of the Enterprise edition the Oro application:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. Click **Create Organization** on the top right.

   .. image:: /user/img/system/user_management/create_organization_page.png
      :alt: Create organization page

3. In the **General** section, provide the following details:

   * **Status** --- The current status of the organization (active or inactive).
   * **Organization Type** --- An :ref:`organization type <user-management-organization-types>` is a set of predefined :ref:`restrictions and limitations provided by a developer <dev-organization-types>`.

     By default, all organizations are assigned to the **General** organization type, which means that an organization is allowed access to all functionality without any restrictions or limitations. This field is only available in the Enterprise edition and when there is at least one organization type in the application.

     In :ref:`OroMarketplace <concept-guide-oro-marketplace>`, you can create an organization of type **Marketplace Seller**, which set restrictions as to what functionality marketplace vendors can have access to.

   * **Name** --- The name used to refer to the organization on the interface.
   * **Description** --- Short description of the organization record.

4. In the **Users** section, select the **Has Group** checkbox next to the required users to add them to the organization you are creating.
5. In the **Additional** section, specify whether the organization has global access level. Only one organization with global access can exist in the system. When the organization with global access already exists in the system, the **Global Access** field is disabled.
6. Click **Save and Close**.

Once saved, the organization is available on the list of all organizations under **System > User Management > Organizations**, where you can filter them by name, edit organizations, and access configuration settings.

.. image:: /user/img/system/user_management/organizations_grid.png
   :alt: Organizations grid

