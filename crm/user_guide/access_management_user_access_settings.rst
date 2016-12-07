User Access Settings
=====================

.. contents:: :local:
    :depth: 3


Overview
--------

*Which organization and / or business unit a user has access to?*

User's access settings is one of the most important points in determining which data the user will be able to access. The organizations you are selecting in this section are organizations a user can log into. Both organizations and business units selected are records which data owned by a user will belong to. 

.. Caution:: 
  Pay attention that if a user looses access to certain organization, the data the user owns that was created for this organization, stays in organization. If a user looses access to a business unit, the data the user owns becomes unavailable in this business unit. For details, see the `Examples <./user-management-users#examples`> section.

Actions
-------

Configure Access Settings While Creating a New User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Start creating a new user. To do this, follow the instructions provided in the
   `Create a User Record <./user-management-users#create-a-user-record>`__ section of the `User Records Management <./user-management-users>`__ guide. Specify all information as required for the **General**, **Additional**, **Groups and Roles**, and **Password** sections.

2. Click **Access Settings**.

3. (Only for EE) In the **Organizations** section, select the check boxes in front of organization(s) you want the user to have access to. 
   
   .. caution::
   	    Note that the user will not be able to log in to the system if no organization is selected for them. 


4. Click the **Organization Business Units** field.

5. Type the business unit name or select it from a drop-down list. 
   
|

.. image:: ./img/access_roles_management/user_access-settings.png 
   
|

6. Click the :guilabel:`Save` button in the upper-right corner.


Assign Roles While Creating a New User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Start creating a new user. To do this, follow the instructions provided in the
   `Create a User Record <./user-management-users#create-a-user-record>`__ section of the `User Records Management <./user-management-users>`__ guide. Specify everything as required for the **General,** **Additional,** **Access Settings,** and **Password** sections.

2. Click **Groups and Roles**.

3. In the **Roles** section, select the check boxes in front of the desired roles. 
   
   .. important::
   		At least one role must be selected. 

   .. caution::
   		If the role is not 'System-Wide' and a particular organization is specified for it, check that the same organization is selected for a user in the **Access Settings** sections. Otherwise the role does not appear in the **Roles** section. 

.. image:: ./img/access_roles_management/user_roles.png 
   
|


4. Click the :guilabel:`Save` button in the upper-right corner.


Change the Range of Assigned User Roles
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the user view page:

    a. In the main menu, navigate **System>User Management>Users**.
    
    b. In the grid on the **All Users** page, click the required user. 

2. On the user view page, click the :guilabel:`Edit` button in the upper-right corner.

3. Click **Groups and Roles**.

4. If required, add a new user role as described in the step 3 of the `Configure User Roles While Creating a New User <./access-management-user-access-settings#configure-user-role-while-creating-a-new-user>`__ section.

|
.. image:: ./img/access_roles_management/user_roles_edit.png

|

5. Click the :guilabel:`Save` button in the upper-right corner.


Edit User's Access Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the user view page:

    a. In the main menu, navigate **System>User Management>Users**.
    
    b. In the grid on the **All Users** view, click the required user. 

2. On the user view page, click the :guilabel:`Edit` button in the upper-right corner.

3. Click **Access Settings**.

4. If required, add a new organization as described in step 3 of the `Configure Access Settings While Creating a New User <./access-management-user-access-settings#configure-access-settings-while-creating-a-new-user>`__ section.

5. If required, add a new business unit as described in steps 4–5 of the `Configure Access Settings While Creating a New User <./access-management-user-access-settings#configure-access-settings-while-creating-a-new-user>`__ section.

|

.. image:: ./img/access_roles_management/user_access-settings_edit.png

|

6. If required, remove an organization. To do this, in the **Organizations** section, clear the check box against organization which you want to forbid the user to have access to.

7. If required, remove a business unit. To do this, click the |IcRemove| **Remove** icon next to the corresponding business unit. 

|

.. image:: ./img/access_roles_management/user_access-settings_delbu.png

|

8. Click the :guilabel:`Save` button in the upper-right corner.



Review Assigned Roles and Access Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the user view page:

    a. In the main menu, navigate**System>User Management>Users**.
    
    b. In the grid on the **All Users** page, click the required user. 

2. On the user view page, click **General Information**.

3. Review the **Roles** and **Business Units** fields. The first one lists user roles, the second—business units the user has access to. 

.. image:: ./img/access_roles_management/user_review.png

4. In the upper-right corner of the page, review the **Owner** field. It represents the business unit that owns the user. If you review the user view page being logged in the organization with a global access, you will also see a name of the organization that owns the user in the braces. 

|

.. image:: ./img/access_roles_management/user_review_owner.png

|

Links
-----
For more information about the access settings configuration, see the `Access Management <./access-management>`__ guide.

For general overview of roles, see the `Roles Management <./access-management-roles>`__ guide.

For more information about the user configuration, see the `User Management <./user-management-users>`__ guide.