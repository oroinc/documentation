.. _user-ee-multi-org:
.. _user-ee-multi-org-system:

Multiple Organizations Support
==============================

In |oro_application| Enterprise edition, you can :ref:`create <user-management-organization-create>` as many organizations as needed with any number of child business units within the application instance. A single user can belong to several different organization. 

For example, one company can run three different stores under a franchise license. In |oro_application|, each store can be an organization to isolate data managed by the unrelated business partners. Users within the organization would only see records that are relevant to their organization. However, the franchise owner could have access to all organizations to gather aggregated customer or order information. To enable that, the global organization should be created in the |oro_application|.

.. note:: In |oro_application|, you can have only one global organization. Users in the global organization, given they have the **Global** access levels in their role, can access and control all system data in all organizations within one instance of the application.

Switch between Organizations
----------------------------

If you have access to more than one organization, you can switch between them using the selector on the top left.

.. image:: /admin_guide/img/user_management/organization_selector.png

.. note:: The global organization is shifted to the left. The organization you are currently logged into is in bold. 
  
When creating a new record in the global organization, you first need to select the organization this record should belong to. Once the organization is selected, you can proceed to the usual record creation flow.

.. |multi_org_choice| image:: /admin_guide/img/multi_org/multi_org_choice.png

**Related Articles**

* :ref:`Create and Manage Organizations <user-management-organizations>`
* :ref:`Create and Manage Users <doc-user-management-users-actions>`
* :ref:`Create and Manage User Groups <user-management-groups>`
* :ref:`Create Business Units <user-management-bu>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`



.. |oro_application| replace:: OroCommerce