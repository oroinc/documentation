Permissions for an Entity Field (Field Level ACLs) 
==================================================

.. contents:: :local:
    :depth: 3



Overview
---------

All important information that comprises an entity is contained in the entity fields. For example, if you open any record of the **Business Unit** entity, you will see such fields as **Name**, **Organization**, **Description**, **Website**, etc. 

When you include the permission to view entity records in a role, users with such role are automatically able to see all fields of the entity. 

However, there are situations when it is desirable to hide certain fields from one group of users while still having them available for others. For example, both the sales team and support team require to see **Opportunity** entity records. But as the financial information is often considered sensitive, you may want to hide the **Budget Amount** field from the support team members.  


Is is possible to do this using Field Level ACL functionality. When you enable it for an entity, you can assign permissions that allow actions on a particular entity field to a role. 

.. important::
	Currently, Field Level ACL functionality is available out of the box for **Account,** **Opportunity,** and custom entities. 


The list of available actions for entity fields is smaller than for an entity:

+--------+-------------------------------------------------------------------------------+
| Action | Description                                                                   |
+========+===============================================================================+
| View   | A user can see entity record fields in the grid and on the record view pages. |
+--------+-------------------------------------------------------------------------------+
| Create | A user can see and modify entity record fields on the 'new entity' form.      |
+--------+-------------------------------------------------------------------------------+
| Edit   | A user can see and modify entity record fields on the 'edit entity' form.     |
+--------+-------------------------------------------------------------------------------+

For each of these actions you can set an access level, thus defining the range of entity records which fields a user can perform an action on: will the be only the records owned by a user themselves, records of the user's division, all records in the system, etc.?  

.. Important::
	Note that for entity fields, the set of available access levels depends on:

	- Entity's ownership type. For example, you won't be able to set the **User** access level for a field if the entity's ownership type is **Organization**. 
	
	- Action. For the **Create** action only the **None** (access is denied) and *Global* (access all entity records within the system) access levels are available independently of the entity's ownership type.
	  
	  
For more information about how access levels are configured for entities, please see the `Action on Entity Permissions <./access-management-roles#actions-on-entity-permissions>`__ section of the `Roles Management <./access_management_roles>`__ guide.

For more information about ownership types, see the `Ownership Type <./access-management-ownership-type>`__ guide and particularly, the `Ownership Type and Access Levels <./access-management-ownership-type#ownership-types-and-access-levels>`__ section.

|

.. image:: ../img/access_roles_management/roles_permissions_fields_general_ex.png 

|


.. caution:: 
	Ability to assign permissions for entity fields is a powerful tool that gives you an opportunity to tune up user roles in OroCRM to a great extent. However, you need to use it carefully and thoughtfully to gain a great result. Make sure that your configuration makes sense. 

	For example, you can set the **None** access level for the **View** action of all fields, but leave a user an ability to view entity records. Then the user will see only blank lines in the grid and upon opening a record. That is why, if you want to restrict a user from viewing entity records, set the **None** access level for the **View** action on the entity itself.  

	Also, if you restrict a user from viewing a particular field, consider restricting them from editing this field as well to avoid a situation when the user enters the record editing mode and can see the restricted field on the 'edit' form.


Visibility of Restricted Fields
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Sometimes you want to enable users to modify only certain entity fields and restrict them from modifying others. For example, the workflow accepted in your company states that only a sales manager can change the status of the opportunity. However, sales representatives still need be able to review the **Status** field when they work with opportunities. 

It is possible to configure this with OroCRM for both the **Create** and **Edit** actions. Fields disabled for modifying will appear dimmed on the interface. For how to do this, please see the `Enable a User to See Restricted Fields <./access-roles-field-level-acl#enable-a-user-to-see-restricted-fields>`__  section.

|

.. image:: ../img/access_roles_management/opportunity_greyed-status.png 

|

Actions with Entity Fields
---------------------------

Enable Assigning Permissions for an Entity Field
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the entity view page:

    a. In the main menu, navigate **System>Entities>Entities Management**.
    
    b. In the grid on the **All Entities** page, click the required entity (it must be either  **Account**, **Opportunity** or any custom entity you have previously created). 

2. On the entity view, click the :guilabel:`Edit` button in the upper-right corner.

3. Click **Others**.

4. Select the **Field Level ACL** check box.


.. image:: ../img/access_roles_management/access_field_level_acl_enable.png

5. Click the :guilabel:`Save` button in the upper-right corner.


Enable a User to See Restricted Fields 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the entity view page:

    a. In the main menu, navigate **System>Entities>Entities Management**.
    
    b. In the grid on the **All Entities** page, click the required entity (it must be either **Account**, **Opportunity**, or any custom entity you have previously created). 

2. On the entity view, click the :guilabel:`Edit` button in the upper-right corner.

3. Click **Others**.

4. Select the **Show Restricted** check box.

|

.. image:: ../img/access_roles_management/access_field_level_acl_showrestricted.png

|

5. Click the :guilabel:`Save` button in the upper-right corner.

Links
------

For general overview of roles, see the `Roles Management <./access-management-roles>`__ guide.

For how a role is represented on the interface, see the `Roles on the Interface <./access-management-roles-inteface>`__ guide.

For what actions you can perform with roles, see the `Actions with Roles <./access-management-roles-actions>`__ guide.
