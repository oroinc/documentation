.. _doc-my-user-view-page:

My User Page
============

.. important::
   The provided description covers fields and features that are default or commonly used. The actual set of available elements may vary depending on your role and other system settings.

When you :ref:`log into <user-guide-intro-log-in-edit-profile>` OroCommerce, you can always find a link to your user page under menu below your username. This is a fast way to access your user profile, calendar, mailbox, and task list.

.. contents:: :local:

* :ref:`Configure User-Level Settings <doc-my-user-configuration>` 

Explore Your User Page
----------------------

There are a number of effective tools and actions available on the page of your user profile, from configuring your personal profile to generating an API key for third-party applications. In particular, from the page of your user profile you can: 

1. **View your full name, avatar and system information such as status, login count, date and time of the last login.**

   * The first status shows that your are granted rights to use the system. The second status is called an authentication status and shares the state of your password. As you can see your user page only when you are logged into the system, you will always see **Enabled** as the first status and **Active** as the second one. When an administrator views your page, they will able to see the values of your statuses.

     .. image:: /user_guide/img/getting_started/my_oro/my_user_review_pagetop_new.png


   * You can also check which business unit owns your user record. Click on the owner name (e.g. Main) to open the page of the corresponding business unit. If you are logged into the organization with global access (i.e. technical organization that aggregates data from all organizations created in the system), then in brackets you will see the name of organization that owns the user.

     .. image:: /user_guide/img/getting_started/my_oro/my_user_review_owner.png

   * You can also see who, how and when modified your profile by clicking **Change History** link. 

    .. image:: /user_guide/img/getting_started/my_oro/My_User_Change_History.png

#. **Access user-level configuration options.**

   In particular, you can set up localization, language, display settings, update email configuration details, provide MS Outlook integration and synchronization settings details, as well as configure customer-visible contact information in the storefront. Read more about the available settings in the relevant :ref:`User-Level Configuration section <doc-my-user-configuration>` of the documentation library.

#. **Edit your user profile.**

   To update the details of your profile, click **Edit** on the top right on the page. On the edit page, you can update your credentials, change the password, upload a new avatar, and update email details.

    .. image:: /user_guide/img/getting_started/my_oro/User_Profile_Edit_Page.png

#. **Perform actions available under the More Actions menu**: 

   * :ref:`Send an email <user-guide-using-emails-view>`    
   * :ref:`Log a call <doc-activities-calls>`   
   * :ref:`Assign an event <doc-activities-events>`
   * :ref:`Edit management console menus <doc-my-user-menus>`
   * :ref:`Assign tasks <doc-activities-tasks>`
   * :ref:`Change your profile password <user-guide-getting-started-profile-password>`
   * :ref:`Reset your profile password <user-guide-getting-started-profile-password>`

   .. image:: /user_guide/img/getting_started/my_oro/My_User_More_Actions.png

   .. note:: Non-default buttons can be added to **More Actions** menu. If you see non-default buttons such as Add Task, Add Event or Add Attachment, please refer to the :ref:`Activities <user-guide-activities>` guide for more information.

#. **View your profile details aggregated under 3 sections: general information, activity and additional information.**

   * In the **General Information** section, you can view the details of your profile and :ref:`create an API key <doc-my-user-actions-api>`.

     .. image:: /user_guide/img/getting_started/my_oro/My_User_General_Details.png

   * In the **Activity** section, you can see the emails you sent and the calls you logged. If a user mentions you as a context for their activity, this activity also appears on the list. See the :ref:`Activities <user-guide-activities>` topic for more information on activities available in OroCommerce.
  
     .. image:: /user_guide/img/getting_started/my_oro/My_User_Activity.png

   * In the **Additional Information** section, you can view and manage tasks and cases related to you. See the :ref:`Activities <user-guide-activities>` topic for more information on activities available in OroCommerce.

     .. image:: /user_guide/img/getting_started/my_oro/My_User_Additional.png

.. _doc-my-user-actions-api:

Generate an API Key
-------------------

When a third-party software requires an API key to integrate with your Oro application, you can generate it on the page of your profile.

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. In the **General Information section**, click **Generate Key** next to the API Key label.

   .. image:: /user_guide/img/getting_started/my_oro/My_User_Create_Api.png

4. Copy the generated key and use it where required.

.. caution:: One user can have only one API key at a time. When you generate a new key, the old key becomes invalid.

.. _user-guide-getting-started-profile-password:
.. _doc-my-user-actions-change-password:

Change Your Password
--------------------

You can change your password to the OroCommerce application in 3 ways:

* When editing your user profile.
* Using the **More Actions** menu on your user profile page.
* By resetting it using the **More Actions** menu on your user profile page.

.. note:: It is recommended to change your password after the first log in, unless you use a Google account or corporate-wide credentials.

**To change your password when editing your user profile:**

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On the page of your profile, click **Edit**.
4. In the **Password** section, provide the following information:

   * **Password** --- Provide your current password.
   * **New Password** -- Provide new password. It must be at least 8 characters long and include a lower case letter, an upper case letter, and a number
   * **Repeat New Password** -- Confirm the new passport by typing it in once again.

  .. image:: /user_guide/img/getting_started/my_oro/My_User_Change_Password_Edit_Page.png

5. Click **Save**. The new password will be sent to your primary email address.

**To change your password via the More Actions menu:**

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On the page of your profile, click **More Actions > Change Password**.
 
   .. image:: /user_guide/img/getting_started/my_oro/My_User_Change_Password.png

4. Provide new passport in the corresponding field. Alternatively, click **Suggest Password** to generate a secure random password. To see/hide  the entered password, click the |IcShow| **Show** / |IcHide| **Hide** icon next to the **New password** field.

5. Click **Save**. The new password will be sent to your primary email address.

**To reset your password via the More Actions menu**:
 
Only administrators can reset passwords.

1. Click on your user name on the top right of the screen.
2. Click **My User**.
3. On the page of your profile, click **More Actions > Reset Password**.
4. In the dialog box, click **Reset**. The password reset link will be sent to your (admin) primary email address.

    .. image:: /user_guide/img/getting_started/my_oro/My_User_Reset_Password.png


**Related Topics**

* :ref:`Activities <user-guide-activities>`
* :ref:`Access Oro <user-guide-log-in>`
* :ref:`My Menus Configuration <doc-my-user-menus>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin