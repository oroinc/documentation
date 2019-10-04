:oro_documentation_types: crm, commerce

.. _user-guide-user-management-permissions-roles--field-level-acl:

Field Level Permissions 
=======================

Overview
--------

Entity fields are used to store details of entity records in |oro_application|. When you need to hide certain fields from one group of users and still have them available for others, you can apply field-level permissions to entities when creating or editing roles in |oro_application|. 

For example, both the sales team and the support team require to see **Opportunity** entity records, but because financial information is considered sensitive, you can hide the **Budget Amount** field from the support team members. 

.. important:: Out of the box, field-level permissions can be applied only to the account, opportunity and custom entities.

The following table illustrates the actions that can be performed to entity fields: 

+--------+-------------------------------------------------------------------------------+
| Action | Description                                                                   |
+========+===============================================================================+
| View   | A user can see entity record fields and values.                               |
+--------+-------------------------------------------------------------------------------+
| Create | A user can see and modify entity record fields on the 'new entity' form.      |
+--------+-------------------------------------------------------------------------------+
| Edit   | A user can see and modify entity record fields on the 'edit entity' form.     |
+--------+-------------------------------------------------------------------------------+

.. image:: /user/img/system/user_management/roles_permissions_fields_general_ex.png

For each of these actions you can set the required access level. However, the set of available access levels for entity fields depends on:

* The ownership type of an entity. For example, you cannot set the **User** access level for a field if the ownership type of the entity is **Organization**. 

* The action. For the **Create** action, only the **None** (access is denied) and **Global** (access all entity records within the system) access levels are available independently of the entity's ownership type.

The ability to assign permissions for entity fields enables you to configure user roles in |oro_application| according to the needs of your company. However, the configuration you apply needs to make sense. For example, if you set the **None** access level to the **View** action of all fields but leave the user an ability to view entity records, they will see only blank lines in the record table and on the record page itself. That is why, if you want to restrict a user from viewing entity records, make sure to set the **None** access level to the **View** action for the entity itself.  

.. note:: When restricting users from viewing particular fields, make sure to restrict them from editing these fields, too.

.. _user-guide-user-management-permissions-roles--apply--field-level-acl:

Apply Permissions to Entity Fields
----------------------------------

To be able to apply permissions for the entity fields when creating or editing a role, you need to make sure that field level access is enabled for the selected entity.

To enable field-level access:

1. Navigate to **System > Entities > Entities Management** in the main menu.
2. On the page of all entities, click the required entity.

   .. important:: Keep in mind that in |oro_application| field-level permissions can be applied only to the account, opportunity and custom entities. 

3. On the page of the selected entity, click **Edit** on the top right.
4. In the **Other** section, enable the **Field Level ACL** check box.

   .. image:: /user/img/system/user_management/access_field_level_acl_enable.png

5. Click **Save**.

When field-level permissions are enabled, the **+** icon appears next to the entities when creating or editing a role.

.. image:: /user/img/system/user_management/enable_field_acl.gif

.. _user-guide-user-management-permissions-roles--field-level-acl--enable-user:

Enable Users to See Restricted Fields 
-------------------------------------

You can enable users to modify only certain entity fields and restrict them from modifying others. For example, you can enable sales managers to modify opportunity statuses, but restrict sales representatives to only viewing them with no permissions to update statuses in any way. Fields disabled for editing will appear dimmed on the interface. 

.. image:: /user/img/system/user_management/opportunity_greyed-status.png

To enable field-level access:

1. Navigate to **System > Entities > Entities Management** in the main menu.
2. On the page of all entities, click on the required entity.
 
   .. important:: Keep in mind that in |oro_application| field-level permissions can be applied only to the account, opportunity and custom entities. 

3. On the page of the selected entity, click **Edit** on the top right.
4. In the **Other** section, enable the **Show Restricted** check box. 

   .. important:: To be able to apply permissions entity fields when creating or editing a role, make sure that the **Field Level ACL** check box is enabled for the selected entity.

   .. image:: /user/img/system/user_management/access_field_level_acl_showrestricted.png

5. Click **Save**.

**Related Articles**

* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Create and Manage Roles <user-guide-user-management-permissions-roles--actions>` 
* :ref:`Blueprints of User Access Configuration <doc-user-management-users-access-examples>`
* :ref:`End-to-end Access Configuration in Context <user-guide-user-management-permissions-roles--examples>`
* :ref:`Entity and System Capabilities <admin-capabilities>`

.. |oro_application| replace:: OroCommerce