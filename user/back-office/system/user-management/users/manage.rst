:oro_documentation_types: OroCRM, OroCommerce

Manage Users
============

.. _doc-user-management-users-actions-enable:
.. _doc-user-management-users-actions-disable:

Enable/Disable a User
---------------------

To enable or disable a user in the Oro application:

1. Navigate to **System > User Management > Users**.
2. In record table, click once on the name of the selected user to open their page.

3. On page of the selected user, click |IcActivate| **Enable User**/ |IcBan| **Disable User** on the top right.

   .. image:: /user/img/system/user_management/user_enable.png

   .. image:: /user/img/system/user_management/user_disable.png

   .. note:: Alternatively, you can |IcActivate| enable and |IcBan| disable users from the record table. Hover over the ellipsis menu at the end of the row of the selected user and click on the corresponding icon.

     .. image:: /user/img/system/user_management/all_users_grid.png

    Keep in mind that besides the page with all users, you can get to the pages of only active or disabled users, or those who cannot log in.

     .. image:: /user/img/system/user_management/users_saved_views.png

Enable/Disable Multiple Users
-----------------------------

To enable/disable several users at the same time, use mass actions:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, select the check boxes in front of the names of those users whose passwords you want to reset.
3. Click the ellipsis menu at the right end of the table header row and then click |IcActivate| **Enable** or |IcBan| **Disable**.

   .. image:: /user/img/system/user_management/users_enable_disable_mass_action.png

.. _doc-user-management-users-actions-activate:

Activate a User
---------------

When user exceed allowed number of failed login attempts, the system automatically locks them out. User authentication status changes to **Locked** and the **Activate** button appears on the user page.

To activate a user:

1. Navigate to **System > User Management > Users** in the main menu.
2. Click on the selected user once to open their page.
3. On the user page, click the **Activate** on the top right.

   .. image:: /user/img/system/user_management/user_activate.png

   The user authentication status changes from **Locked** to **Active**.

.. _doc-user-management-users-actions-delete:

Delete a User
-------------

To delete a user from the system:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, hover over the ellipsis menu at the end of the row of the selected user, and click |IcDelete| **Delete**.

   .. important:: Keep in mind that you can delete only those users who have no records assigned to them.

   .. image:: /user/img/system/user_management/users_delete.png

3. In the **Deletion Confirmation** dialog box, click **Yes, Delete**.

   .. note:: Alternatively, you can delete a user from their user page by clicking the **Delete** on the top right.

   .. image:: /user/img/system/user_management/user_page_delete.png

.. _doc-user-management-users-actions-export:

Export Multiple Users
---------------------

You can export all user records into a .csv file. The exported file will contain all user record fields marked to be exported in the **User** entity settings. For more information about how to configure which fields will be exported, see the :ref:`Entity Fields <admin-guide-create-entity-fields>` topic.

.. note:: All existing user records are exported at once. Passwords are stored and exported in the hashed form.

To export user records:

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click **Export** on the top right.
3. When the export job finishes, you will receive a notification to your primary email address.

   .. image:: /user/img/system/user_management/users_grid_export.png

   .. image:: /user/img/system/user_management/users_export_csv.png

.. _doc-user-management-users-actions-api:

Generate an API Key for a User
------------------------------

When the integration with a third-party software or other work requirements demand a user to have the API access to the Oro application key for the user. This key is used to grant the user access to the required API while protecting their password from being disclosed to the third party.

1. Navigate to **System > User Management > Users** in the main menu.
2. On the page of all users, click once on the selected user to open their page.
3. In the **General Information**, click **Generate Key** next to the **API Key** field.

   .. image:: /user/img/system/user_management/users_generate_api_key.png

Once the API key is generated, the user can execute API requests via the sandbox, Curl command, any other REST client, or use the API via the custom application.

.. important:: Only one key can be generated for one user within one organization.


.. _doc-user-management-users-actions-change-password:
.. _doc-user-management-users-actions-reset-password:

Change/Reset User Passwords
---------------------------

You can change and reset the password for a specific user on their profile page in the **More Actions** menu:

 .. image:: /user/img/system/user_management/user_page_change_reset_password.png

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click once on the selected user to open their page.
3. On the user page, click **More Actions** on the top right.

   * Click |IcChangePassword| **Change Password** to open a new dialog and provide a new password. Alternatively, you can click the **Suggest Password** link to generate a secure random password. To see / hide  the entered password, click the |IcShow| **Show**/|IcHide| **Hide** icon next to the **New password** field. Once a new password is provided, a reset password email is sent to this user.

     .. image:: /user/img/system/user_management/user_change_password.png

   * Click |IcPassReset| **Reset Password** to send an email to the user with a new password.

     .. image:: /user/img/system/user_management/user_reset_password.png

     The user will not be able to log into the application until their password is changed. In this case, the user authentication status changes to **Password reset**. It will return to **Active** when the user changes the password.

     .. image:: /user/img/system/user_management/user_password_reset.png

.. note:: Alternatively, you can reset password for a specific user from the table of all users. For this, hover over the ellipsis menu at the end of the row of the selected user, and click **Reset Password**.

     .. image:: /user/img/system/user_management/user_reset_password_from_grid.png

.. _doc-user-management-users-actions-reset-password-multiple:

Reset Multiple Passwords
------------------------

When you suspect a security breach, you can reset passwords for multiple users at the same time:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, select the check boxes in front of the names of those users whose passwords you want to reset.
3. Click the ellipsis menu at the right end of the table header row and then click |IcPassReset| **Reset Password**.
4. In the **Reset Password** dialog box, click **Reset**. The password reset links are sent to the primary email addresses of the selected users.

.. important::  The users will not be able to log into the application until their passwords are changed. Note that user authentication statuses change to **Password reset**. They will return to **Active** when the users complete password change procedure.

     .. image:: /user/img/system/user_management/users_mass_reset_passwords.png

.. include:: /include/include-images.rst
   :start-after: begin