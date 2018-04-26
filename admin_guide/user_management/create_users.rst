.. _doc-user-management-users-actions:
.. _doc-user-management-users-actions-create:
.. _user-management-users:
.. _user_management_overview:

Create and Manage Users
=======================

.. contents:: :local:
    :depth: 2

A user is the most granular element of the administrative structure in your company. Usually, they are individuals employed by your company, or granted access under other conditions. They can also be a group of people or a third party system with a specific set of credentials (login and password) that can be used to access |oro_application|. To ensure effective work of users and high protection of sensitive data in the application, correct configuration of all user records and access settings is essential.

In one |oro_application| instance, you can create any number of users.

This section describes how you can create, activate and manage user profiles in your application, as well as reset passwords and generate API keys.
      
Create New Users
----------------

Before you proceed, consider checking out user-related video tutorials in the Oro media library:

* How to set up user profiles
 
  .. raw:: html

        <iframe width="560" height="315" src="https://www.youtube.com/embed/I3v9HRF0ivE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

* How to create and manage users

  .. raw:: html

        <iframe width="560" height="315" src="https://www.youtube.com/embed/t97qnxmEa6o" frameborder="0" allowfullscreen></iframe>

To create a new user in |oro_application|:

1. Navigate to **System > User Management > Users** in the main menu.
2. On the **All Users** page, click **Create User** on the top right.

   The following page opens:
 
   .. image:: /admin_guide/img/user_management/user_create_general.png

3. In the **General** section, provide the following information: 

   .. note:: Fields with a red asterisk are mandatory.
 
   * **Owner** --- Select a business unit from the list. The owner of the user record represents a business unit whose members can manage the record subject to the :ref:`access and permission settings <user-guide-user-management-permissions>`.

   * **Enabled** --- Select a user status from the list. 

     * *Enabled* --- The user can log into the system, do their work within it, and be the owner of :ref:`entity records <entities-management>`.
     * *Disabled* --- The user cannot log into the system or be the owner of entity records.
    
   * **Username** --- The name that the user will use to log into the system.  
   * **Password** --- The password that the user will use to log into the system. Password requirements are configured in the :ref:`system settings <admin-configuration-user-settings>`. If the password you entered is not accepted, a notification is displayed in the password field.

   * **Re-enter Password** --- Provide the password again to confirm it. 
   * **Name Prefix** --- A name prefix used in front of the user's name. 
   * **First Name** --- The first name of the user displayed on the interface when the user logs in. 
   * **Middle Name** --- The middle name of the user. 
   * **Last Name** --- The last name of the user. Together with the user's first name, the last name is displayed on the interface when the user logs in. 
   * **Name Suffix** --- A name suffix of the user. A name suffix is used after the user's name and provides additional information about the user. 
   * **Birthday** --- Click this field and select the user's date of birth using a pop-up calendar. Alternatively, type the date in the format defined by your current :ref:`locale <doc-user-management-users-configuration-localization>`.
   * **Avatar** -- Click **Choose File** to upload a photo of the user you are creating.     
   * **Send An Email Invitation** --- Select this check box to send an email invitation to the user once the profile is created. The invitation is sent to the email address specified in the **Primary Email** field.    
   * **Primary Email** --- The main email address of the user.   
   * **Emails** --- Click **Add Another Email** and type an additional email address in the field that appears. You can add as many email addresses as required. To delete an email address, click **x** next to the email field that you want to delete.      
   * **Phone** --- The user's phone number.
    
4. In the **Additional** section provide more information about the user (e.g. the job title). When visible custom fields are added to the **User** entity, they appear in this section.  
5. In the **Groups and Roles** section, select the required system-wide :ref:`group <user-management-groups>` and :ref:`role <user-guide-user-management-permissions>` for the user you are creating. 

   .. important:: If you have |oro_application| Enterprise edition, and you wish to limit access of the user you are creating to a specific organization, select it in the **Access Settings** section. If the organization has organization-specific roles, these will appear on the list in the **Group and Roles** section once you select the required organization in **Access Settings**. 

   The following screenshot illustrates system-wide roles with no organization selected in **Access Settings**:

     .. image:: /admin_guide/img/user_management/groups_roles_system_wide.jpg


   The following screenshot illustrates the organization-specific role added to the list once the organization is selected in **Access Settings**:

     .. image:: /admin_guide/img/user_management/groups_roles_organization.jpg

6. In **Access Settings** select the check boxes in front of the organization(s) you want the user to have access to.  
   
   .. caution:: Note that the user will not be able to log into the system if no organization is selected for them. In addition, at least one role must be selected. Otherwise, you will not be able to save the user.

   * In the **Organization Business Units** field, provide the business unit name, or select it from the list. On the list, you can see business units of the organizations selected in the **Organizations** subsection. 
   
   * You can select one or more business unit. In this case, the data owned by the user will be considered as belonging to all these business units and users that have access to these business units and corresponding permissions will be able to access it. 
         
   * When the user's role includes division level permissions, the user will be able to access data of each business unit specified in these sections, as well as the data of the whole chain of business units subordinated to those selected in this section. 
    
7. Click **Save**.
 
   .. note:: To create another user straight away, click **Save and New**. 

.. _doc-user-management-users-actions-review:
.. _doc-user-management-users-actions-edit:

Once the user is created, it becomes available in the table of all users under **System > User Management > Users**:

1. To view details of a specific user, click once on the user name in the table to open their page.

   .. image:: /admin_guide/img/user_management/user_view_fromgrid.png

2. To edit details of a specific user, click |IcEdit| in the ellipsis menu at the end of the row of the selected user. Alternatively, open the page of the user and click **Edit** on the top right.

   .. image:: /admin_guide/img/user_management/user_edit.png

For information on the activities you can perform from the user profile page (such as send an email, or assign a calendar event), check out the :ref:`Activities <user-guide-activities>` topic. 

.. _doc-user-management-users-actions-create-ldap:

Create Users via LDAP
^^^^^^^^^^^^^^^^^^^^^

|oro_application| Enterprise edition supports integration with LDAP (Lightweight Directory Access Protocol) server which enables you to import existing user information (including role identifiers) from the LDAP server into |oro_application|.  

To enable import of LDAP records, you first need to set up integration with LDAP. Once the integration is established, user profiles are imported to |oro_application| and users can use their usual credentials to log into the application.

Using LDAP integration does not prevent you from creating user records in |oro_application| manually. Manually created user records are not imported back to your LDAP server.

System administrators can tell if a user has been added via the LDAP integration. The **LDAP Distinguished Names** field in the profile of these users contains integration-specific values.

.. image:: /admin_guide/img/user_management/user_ldap_distinguished_name.png

For more information on the integration with LDAP, please see the topic on :ref:`LDAP integration <user-guide-ldap-integration>` .

Manage Users
------------

.. contents:: :local:
   :depth: 2

.. _doc-user-management-users-actions-enable:
.. _doc-user-management-users-actions-disable:

Enable/Disable a User
^^^^^^^^^^^^^^^^^^^^^

To enable or disable a user in the |oro_application| application:

1. Navigate to **System > User Management > Users**.
2. In record table, click once on the name of the selected user to open their page. 

   .. image:: /admin_guide/img/user_management/user_enable.png

   .. image:: /admin_guide/img/user_management/user_disable.png

3. On page of the selected user, click |IcActivate| **Enable User**/ |IcBan| **Disable User** on the top right.

   .. note:: Alternatively, you can |IcActivate| enable and |IcBan| disable users from the record table. Hover over the ellipsis menu at the end of the row of the selected user and click on the corresponding icon. 

     .. image:: /admin_guide/img/user_management/all_users_grid.png

    Keep in mind that besides the page with all users, you can get to the pages of only active or disabled users, or those who cannot log in.
   
     .. image:: /admin_guide/img/user_management/users_saved_views.png

Enable/Disable Multiple Users
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable/disable several users at the same time, use mass actions:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, select the check boxes in front of the names of those users whose passwords you want to reset. 
3. Click the ellipsis menu at the right end of the table header row and then click |IcActivate| **Enable** or |IcBan| **Disable**.

   .. image:: /admin_guide/img/user_management/users_enable_disable_mass_action.png

.. _doc-user-management-users-actions-activate:

Activate a User
^^^^^^^^^^^^^^^

When user exceeds allowed number of failed login attempts, the system automatically locks them out. User authentication status changes to **Locked** and the **Activate** button appears on the user page.

To activate a user:

1. Navigate to **System > User Management > Users** in the main menu.
2. Click on the selected user once to open their page.  
3. On the user page, click the **Activate** on the top right. 

   .. image:: /admin_guide/img/user_management/user_activate.png

   The user authentication status changes from **Locked** to **Active**.

.. _doc-user-management-users-actions-delete:

Delete a User
^^^^^^^^^^^^^

To delete a user from the system:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, hover over the ellipsis menu at the end of the row of the selected user, and click |IcDelete| **Delete**.  

   .. important:: Keep in mind that you can delete only those users who have no records assigned to them. 

   .. image:: /admin_guide/img/user_management/users_delete.png

3. In the **Deletion Confirmation** dialog box, click **Yes, Delete**.

.. note:: Alternatively, you can delete a user from their user page by clicking the **Delete** on the top right.

   .. image:: /admin_guide/img/user_management/user_page_delete.png

.. _doc-user-management-users-actions-export:

Export Multiple Users
^^^^^^^^^^^^^^^^^^^^^

You can export all user records into a .csv file. The exported file will contain all user record fields marked to be exported in the **User** entity settings. For more information about how to configure which fields will be exported, see the :ref:`Entity Fields <admin-guide-create-entity-fields>` topic. 

.. note:: All existing user records are exported at once. Passwords are stored and exported in the hashed form. 

To export user records:

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click **Export** on the top right.
3. When the export job finishes, you will receive a notification to your primary email address. 

   .. image:: /admin_guide/img/user_management/users_grid_export.png

   .. image:: /admin_guide/img/user_management/users_export_csv.png

.. _doc-user-management-users-actions-api:

Generate an API Key for a User
------------------------------

When the integration with a third-party software or other work requirements demand a user to have the API access to |oro_application| key for the user. This key is used to grant the user access to the required API while protecting their password from being disclosed to the third party. 

1. Navigate to **System > User Management > Users** in the main menu.
2. On the page of all users, click once on the selected user to open their page. 
3. In the **General Information**, click **Generate Key** next to the **API Key** field.  

   .. image:: /admin_guide/img/user_management/users_generate_api_key.png

Once the API key is generated, the user can execute API requests via the sandbox, Curl command, any other REST client, or use the API via the custom application.
   
.. important:: Only one key can be generated for one user within one organization.


.. _doc-user-management-users-actions-configure:

Configure User-specific Settings
--------------------------------

In |oro_application|, you can configure settings specifically for the selected user. These settings may include localization options, display settings, for instance. The settings you configure per user are applicable only for the current organization.

To configure system settings for a particular user:

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click once on the selected user to open their page. 
3. On the user page, click **Configuration** on the top right. 

   .. image:: /admin_guide/img/user_management/user_configuration_settings.png

.. note:: In OroCommerce, you can also configure the contact information visible to customers of your storefront. This setting is available under **System > Configuration > Commerce > Sales > Contacts** in the main menu.

In addition to configuring settings for the user as the administrator, each user can configure their settings from their user profile page. You can find more information on the configuration settings available on user level in the :ref:`User-level Configuration Settings <doc-my-user-configuration>` topic.
 
.. _doc-user-management-users-actions-change-password:
.. _doc-user-management-users-actions-reset-password:

Change/Reset User Passwords
---------------------------

You can change and reset the password for a specific user on their profile page in the **More Actions** menu:

 .. image:: /admin_guide/img/user_management/user_page_change_reset_password.png

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click once on the selected user to open their page. 
3. On the user page, click **More Actions** on the top right.

   * Click |IcChangePassword| **Change Password** to open a new dialog and provide a new password. Alternatively, you can click the **Suggest Password** link to generate a secure random password. To see / hide  the entered password, click the |IcShow| **Show**/|IcHide| **Hide** icon next to the **New password** field. Once a new password is provided, a reset password email is sent to this user.

     .. image:: /admin_guide/img/user_management/user_change_password.png

   * Click |IcPassReset| **Reset Password** to send an email to the user with a new password. 
   
     .. image:: /admin_guide/img/user_management/user_reset_password.png

     The user will not be able to log into the application until their password is changed. In this case, the user authentication status changes to **Password reset**. It will return to **Active** when the user changes the password.

     .. image:: /admin_guide/img/user_management/user_password_reset.png

.. note:: Alternatively, you can reset password for a specific user from the table of all users. For this, hover over the ellipsis menu at the end of the row of the selected user, and click **Reset Password**.

     .. image:: /admin_guide/img/user_management/user_reset_password_from_grid.png

.. _doc-user-management-users-actions-reset-password-multiple:

Reset Multiple Passwords
^^^^^^^^^^^^^^^^^^^^^^^^
   
When you suspect a security breach, you can reset passwords for multiple users at the same time:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, select the check boxes in front of the names of those users whose passwords you want to reset. 
3. Click the ellipsis menu at the right end of the table header row and then click |IcPassReset| **Reset Password**.
4. In the **Reset Password** dialog box, click **Reset**. The password reset links are sent to the primary email addresses of the selected users. 

.. important::  The users will not be able to log into the application until their passwords are changed. Note that user authentication statuses change to **Password reset**. They will return to **Active** when the users complete password change procedure.

     .. image:: /admin_guide/img/user_management/users_mass_reset_passwords.png

**Related Articles** 

* :ref:`Create and Manage User Groups <user-management-groups>`
* :ref:`Create Business Units <user-management-bu>`
* :ref:`Create and Manage Organizations <user-management-organizations>`
* :ref:`Work with Multiple Organizations <user-ee-multi-org>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin


.. |oro_application| replace:: OroCRM