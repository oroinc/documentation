:oro_documentation_types: OroCRM, OroCommerce

.. _doc-my-user-view-page:

My User
=======

.. important::
   The provided description covers fields and features that are default or commonly used. The actual set of available elements may vary depending on your role and other system settings.

When you log into the Oro application, you can always find a link to your user page under the menu below your username. This is a fast way to access your user profile, calendar, mailbox, and task list.


Explore Your User Page
----------------------

Several practical tools and actions are available on your user profile page, from configuring your profile to generating an API key for third-party applications. In particular, from the page of your user profile, you can:

1. **View your full name, avatar, and system information such as status, login count, date, and time of the last login.**

   * The first status shows that you are granted rights to use the system. The second status is called an authentication status and shares the state of your password. As you can see your user page only when you are logged into the system, you will always see **Enabled** as the first status and **Active** as the second one. When an administrator views your page, they can see the values of your status.

     .. image:: /user/img/getting_started/user_menu/my_user_review_pagetop_new.png
        :alt: View the statuses of the user profile

   * You can also check which business unit owns your user record. Click on the owner name (e.g., Acme, General ) to open the page of the corresponding business unit. If you are logged into the organization with global access (i.e., a technical organization that aggregates data from all organizations created in the system), then in brackets, you will see the name of the organization that owns the user.

     .. image:: /user/img/getting_started/user_menu/my_user_review_owner.png
        :alt: View the business unit of the user record

   * You can also see who, how, and when modified your profile by clicking **Change History** link.

2. **Access user-level configuration options.**

   In particular, you can set up localization, language, display settings, update email configuration details, and configure customer-visible contact information in the storefront. Read more about the available settings in the relevant :ref:`User-Level Configuration section <doc-my-user-configuration>` of the documentation library.

3. **Edit your user profile.**

   To update your profile details, click **Edit** on the top right of the page. You can update your credentials, change the password, upload a new avatar, and update email details on the edit page.

4. **Perform actions available under the More Actions menu**:

   * :ref:`Send an email <user-guide-using-emails-view>`
   * :ref:`Log a call <doc-activities-calls>`
   * :ref:`Assign an event <doc-activities-events>`
   * :ref:`Edit back-office menus <doc--menu-config-levels>`
   * :ref:`Assign tasks <doc-activities-tasks>`
   * :ref:`Change your profile password <user-guide-getting-started-profile-password>`
   * :ref:`Reset your profile password <user-guide-getting-started-profile-password>`

   .. image:: /user/img/getting_started/user_menu/My_User_More_Actions.png
      :alt: The More Actions menu with available options

   .. note:: Non-default buttons can be added to **More Actions** menu. If you see non-default buttons such as Add Task, Add Event, or Add Attachment, please refer to the :ref:`Activities <user-guide-activities>` guide for more information.

5. **View your profile details aggregated under 3 sections: general information, activity, and additional information.**

   * In the **General Information** section, you can view the details of your profile, :ref:`create an API key <doc-my-user-actions-api>`.

   * In the **Activity** section, you can see the emails you sent and the calls you logged. If a user mentions you as a context for their activity, this activity also appears on the list. See the :ref:`Activities <user-guide-activities>` topic for more information on activities available in the Oro application.

   * In the **Additional Information** section, you can view and manage tasks and cases related to you. See the :ref:`Activities <user-guide-activities>` topic for more information on activities available in the Oro application.


.. _doc-my-user-actions-api:

Generate an API Key
-------------------

When a third-party software requires an API key to integrate with your Oro application, you can generate it on your profile page.

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. In the **General Information section**, click **Generate Key** next to the API Key label.

   .. image:: /user/img/getting_started/user_menu/My_User_Create_Api.png
      :alt: The Generate key button

4. Copy the generated key and use it where required.

.. caution:: One user can have only one API key at a time. When you generate a new key, the old key becomes invalid.

.. _user-guide-getting-started-profile-password:
.. _doc-my-user-actions-change-password:

Change Your Password
--------------------

You can change your password to the Oro application in 3 ways:

* When editing your user profile.
* Using the **More Actions** menu on your user profile page.
* By resetting it using the **More Actions** menu on your user profile page.

.. note:: We recommend changing your password after the first login unless you use a Google account or corporate-wide credentials.

**To change your password when editing your user profile:**

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On the page of your profile, click **Edit**.
4. In the **Password** section, provide the following information:

   * **Password** --- Provide your current password.
   * **New Password** -- Provide a new password. It must be at least eight characters long and include a lower case letter, an upper case letter, and a number
   * **Repeat New Password** -- Confirm the new passport by typing it in again.

5. Click **Save**. The new password will be sent to your primary email address.

**To change your password via the More Actions menu:**

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On your profile page, click **More Actions > Change Password**.

   .. image:: /user/img/getting_started/user_menu/My_User_Change_Password.png
      :alt: The change password popup dialog

4. Provide a new passport in the corresponding field. Alternatively, click **Suggest Password** to generate a secure random password. To see/hide  the entered password, click the |IcShow| **Show** / |IcHide| **Hide** icon next to the **New password** field.

5. Click **Save**. The new password will be sent to your primary email address.

**To reset your password via the More Actions menu**:

Only administrators can reset passwords.

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On your profile page, click **More Actions > Reset Password**.
4. In the dialog box, click **Reset**. The password reset link will be sent to your (admin) primary email address.

Add OAuth Applications
----------------------

.. include:: /user/back-office/getting-started/user-menu/oauth.rst
   :start-after: begin_user_oauth
   :end-before: finish_user_oauth

Configure User-Level Settings
-----------------------------

Read the :ref:`My Configuration <doc-my-user-configuration-profile>` topic for the details on configuring available system settings for a particular user.

**Related Topics**

* :ref:`User Menu <user-guide-intro-log-in-edit-profile>`
* :ref:`My Configuration <doc-my-user-configuration-profile>`
* :ref:`My Emails <doc-my-oro-emails>`
* :ref:`My Tasks <doc-activities-tasks>`
* :ref:`My Calendar <user-guide-calendars-manage>`
* :ref:`Log Out <doc-log-out>`


.. toctree::
   :hidden:

   Add OAuth Applications <oauth>


.. include:: /include/include-images.rst
   :start-after: begin