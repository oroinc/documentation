Manage Users in the Back-Office
===============================

.. _doc-user-management-users-actions-enable:
.. _doc-user-management-users-actions-disable:

Enable/Disable a User
---------------------

To enable or disable a user in the Oro application:

1. Navigate to **System > User Management > Users**.
2. In record table, click on the name of the selected user to open their page.

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
2. In the table of all users, select the checkboxes in front of the names of those users whose passwords you want to reset.
3. Click the ellipsis menu at the right end of the table header row and then click |IcActivate| **Enable** or |IcBan| **Disable**.

   .. image:: /user/img/system/user_management/users_enable_disable_mass_action.png

.. _doc-user-management-users-actions-activate:

Activate a User
---------------

When a user exceed the allowed number of failed login attempts, the system automatically locks them out. User authentication status changes to **Locked**, and the **Activate** button appears on the user page.

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
2. In the table of all users, hover over the ellipsis menu at the end of the row of the selected user and click |IcDelete| **Delete**.

   .. important:: Keep in mind that you can delete only those users who have no records assigned to them.

   .. image:: /user/img/system/user_management/users_delete.png

3. In the **Deletion Confirmation** dialog box, click **Yes, Delete**.

   .. note:: Alternatively, you can delete a user from their user page by clicking the **Delete** on the top right.

   .. image:: /user/img/system/user_management/user_page_delete.png

.. _doc-user-management-users-actions-export:

Export Multiple Users
---------------------

You can export all user records into a .csv file. The exported file will contain all user record fields marked to be exported in the **User** entity settings. For more information about configuring which fields will be exported, see the :ref:`Entity Fields <admin-guide-create-entity-fields>` topic.

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

Integration with third-party software sometimes requires API access to the Oro application. A user can generate an API key to grant access to the required API while protecting their password from being disclosed to the third party.

1. Navigate to **System > User Management > Users** in the main menu.
2. On the page of all users, click on the selected user to open their page.
3. In the **General Information**, click **Generate Key** next to the **API Key** field.

   .. image:: /user/img/system/user_management/users_generate_api_key.png

Once the API key is generated, the user can execute API requests via the sandbox, Curl command, any other REST client, or use the API via the custom application.

.. important:: Only one key can be generated for one user within one organization.


.. _doc-user-management-users-actions-change-password:

Change User Passwords
---------------------

You can change the password for a specific user on their profile page in the **More Actions** menu:

 .. image:: /user/img/system/user_management/user_page_change_reset_password.png

1. Navigate to **System > User Management > Users**.
2. On the page of all users, click on the selected user to open their page.
3. On the user page, click **More Actions** on the top right.

   * Click |IcChangePassword| **Change Password** to open a new dialog and provide a new password. Alternatively, you can click the **Suggest Password** link to generate a secure random password. To see / hide  the entered password, click the |IcShow| **Show**/|IcHide| **Hide** icon next to the **New password** field. Once a new password is provided, a reset password email is sent to this user.

     .. image:: /user/img/system/user_management/user_change_password.png

.. _doc-user-management-users-actions-reset-password:

Reset User Passwords
--------------------

An administrator can request the customer user to change their password by clicking the **More Actions** menu on user profile page and selecting the |IcPassReset| **Reset Password** option:

.. image:: /user/img/system/user_management/user_page_change_reset_password.png

The confirmation dialogue will be shown to confirm the reset of the user password.

.. image:: /user/img/system/user_management/user_reset_password.png

By clicking on the **Reset** button, a user will receive an email with a link to update their password. Users can only log into the application once their password is changed, in which case their password status changes to **Reset** in the back-office. The status switches to **Active** as soon as the customer user changes the password.

.. image:: /user/img/system/user_management/user_password_reset.png

.. note:: Alternatively, you can reset password for a specific user from the grid of all users. For this, hover over the ellipsis menu at the end of the row of the selected user, and click **Reset Password**.

     .. image:: /user/img/system/user_management/user_reset_password_from_grid.png

You can change the email contents by updating the **force_reset_password** :ref:`email template <user-guide-using-emails-create-template>` of the User entity.

The link in the email will have a refresh token to enable password change for a user. By default, this token and the reset password link in the email are valid for 24 hours from the moment the reset request is thrown.

An administrator can change this ttl in the :ref:`configuration of the User bundle <yaml-bundles-configuration-reset-password>`.

.. _doc-user-management-users-actions-reset-password-multiple:

Reset Multiple Passwords
------------------------

When you suspect a security breach, you can reset passwords for multiple users at the same time:

1. Navigate to **System > User Management > Users**.
2. In the table of all users, select the checkboxes in front of the names of those users whose passwords you want to reset.
3. Click the ellipsis menu at the right end of the table header row and then click |IcPassReset| **Reset Password**.
4. In the **Reset Password** dialog box, click **Reset**. The password reset links are sent to the primary email addresses of the selected users.

.. important:: The users will not be able to log into the application until their passwords are changed. Note that user authentication statuses change to **Password reset**. They will return to **Active** when the users complete password change procedure.

     .. image:: /user/img/system/user_management/users_mass_reset_passwords.png

.. _user-guide-add-oauth-to-user:

Add OAuth Applications to a User
--------------------------------

.. include:: /user/back-office/system/user-management/oauth-app.rst
   :start-after: begin_oauth1
   :end-before: finish_oauth1

Add an Application
^^^^^^^^^^^^^^^^^^

To add a new OAuth application in the back-office:

1. Navigate to **System > User Management > Users** in the main menu.
2. Click on a user name that you want to add an OAuth application to.
3. In the **OAuth Applications** section, click **Add Application** on the top right and provide the following details in the pop-up dialog:

   .. image:: /user/img/getting_started/user_menu/oauth/oauth_tab.png
      :alt: Add an oauth application

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to. This field is displayed to users with access to multiple organizations. Keep in mind that the multi-org functionality is only available in the Enterprise edition.
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** checkbox to activate the new application.

4. Click **Create**.

A corresponding notification is sent to the user's primary email address, the owner of the OAuth application. You can change the default recipient, localization, or email contents if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out-of-the-box in the system configuration.

Once the application is created, you are provided with a Client ID and a Client Secret. Click on the |IcCopy| icon to copy the credentials to the clipboard.

.. image:: /user/img/getting_started/user_menu/oauth/oauth_credentials.png
   :alt: OAuth credentials

.. important:: For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe to access it later.

You can add as many applications as you need for any of your existing organizations. All added applications are displayed in the grid, and you can filter them by name, organization, and status.

.. hint:: Use the |IcMore| **More Options** menu to edit, deactivate or delete an application.

          .. image:: /user/img/getting_started/user_menu/oauth/manage_oauth_application.png
             :alt: Manage auth applications

Use the generated Client ID and Client Secret to retrieve an access token to connect to your Oro application.

.. note:: For the aggregated information on all OAuth applications created by users in the back-office, refer to the general :ref:`OAuth Applications <oauth-applications>` topic.

**Related Articles**

* :ref:`Password Change Policy <doc-user-management-users-actions-password-change-policy>`
* :ref:`Password History Policy <user-guide--customers--customer-user-password-history-policy>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
