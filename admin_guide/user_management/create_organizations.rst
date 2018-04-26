.. _user-management-organizations:

Create and Manage Organizations
===============================

An organization represents a real enterprise, business, firm, company or another organization, to which users belong. In |oro_application| Community Edition, only one organization is available in the system, and you cannot create more. In |oro_application| Enterprise edition, you can create as many organizations as necessary.

.. _user-management-organization-create:

.. note:: See a short demo on `how to create organizations and business units <https://www.orocrm.com/media-library/create-organizations-and-business-units>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/_PpE536CQ9c" frameborder="0" allowfullscreen></iframe>

To create a new organization in |oro_application| Enterprise edition:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. Click **Create Organization** on the top right.

   The following page opens:

   .. image:: /admin_guide/img/user_management/create_organization_page.png

3. In the **General** section, provide the following details:

   * **Status** --- The current status of the organization (active or inactive).
   * **Name** --- The name used to refer to the organization on the interface. 
   * **Description** --- Short description of the organization record.
  
4. In the **Users** section, select the **Has Group** check box next to the required users to add them to the organization you are creating. 
5. In the **Additional** section, specify whether the organization has global access level. Only one organization with global access can exist in the system. When the organization with global access already exists in the system, the **Global Access** field is disabled. More information on managing multiple organizations is available in the :ref:`Multiple Organization Support <user-ee-multi-org>` topic. 
6. Click **Save and Close**.

Once saved, the organization is available on the list of all organizations under **System > User Management > Organizations**, where you can filter them by name, edit organizations, and access configuration settings.

.. image:: /admin_guide/img/user_management/organizations_grid.png

.. _user-management-organization-manage:

Manage Organizations
--------------------

From the page of the selected organization, you can edit its menu(s), access organization configuration settings, update the details for the selected organization, as well as manage its users. In OroCommerce, you can also edit the frontend menu for required organizations.

To open the page of a specific organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. Click the organization to open its details.

   .. image:: /admin_guide/img/user_management/organization_page_details.png

   * To open :ref:`organization configuration settings <doc-organization-configuration>`, click |IcConfig| **Configuration** on the top right.
   * To edit the :ref:`management console menu <doc-config-menus>` for this organization, click |IcConfig| **Edit Menu** on the top right. 
   * To edit the `storefront menu <https://oroinc.com/orocommerce/doc/current/configuration-guide/menu#orocommerce-storefront-menus>`__ for this organization in OroCommerce, click |IcConfig|  **Edit Frontend Menu**.
   * To update organization details, such as it name or access level, click |IcEdit| **Edit**.
   * To view who updated organization details, click the **Change History** link.
   * To disable users within the organization, click |IcBan| in the table at the end of the row of the selected user.
   * To reset the existing password for a particular user on the list, click |IcResetPassword| in the table at the end of the row.

**Related Articles**

* :ref:`Work with Multiple Organizations <user-ee-multi-org>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Create and Manage Users <doc-user-management-users-actions>`
* :ref:`Create and Manage User Groups <user-management-groups>`
* :ref:`Create Business Units <user-management-bu>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin


.. |oro_application| replace:: OroCRM