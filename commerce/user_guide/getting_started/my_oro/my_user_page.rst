.. _doc-my-user-view-page:

My User
=======

.. important::
   The provided description covers fields and features that are default or commonly used. The actual set of available elements may vary depending on your role and other system settings.

On the upper-left of the page, you can see your avatar, full name and statuses.

The first status shows that your are granted rights to use the system. The second status is called ``authentication status`` and shares the state of your password. As you can see your user page only being logged into the system, you will always see **Enabled** for the first status and **Active** for the other. When an administrator views your page, they will able to see values of your statuses.


.. image:: /user_guide/img/getting_started/my_oro/my_user_review_pagetop.png

In the upper-right part of the page there is the following set of action buttons:

:guilabel:`Configuration`—Click this button to configure how the interface will look for your, your email settings, and integrations. See the :ref:`Configure Your Interface, Email Settings and Integrations <doc-my-user-actions-configure>` action description.

:guilabel:`Edit`—Click this button to edit your profile. See the :ref:`Edit Your Profile <doc-my-user-actions-edit>` action description.


**More Actions** list:

  :guilabel:`Send Email`—Click this action button to import fields into the entity. See the :ref:`Send an Email <doc-my-user-actions-email>` action description.

  :guilabel:`Log Call`—Click this action button to log or make a call. See the :ref:`Log or Make a Call <doc-my-user-actions-call>` action description.

  :guilabel:`Assign Event`—Click this action button to assign an event. See the :ref:`Assign an Event <doc-my-user-actions-event>` action description.

  :guilabel:`Edit Menus`—Click this action button to configure the main menu. See the :ref:`Assign an Event <doc-my-user-actions-configure-menus>` action description.

  :guilabel:`Assign Task`—Click this action button to assign a task. See the :ref:`Assign a Task <doc-my-user-actions-task>` action description.

  :guilabel:`Change Password`—Click this action button to change a password. See the :ref:`Change a Password <doc-my-user-actions-change-password>` action description.

  :guilabel:`Reset Password`—Click this action button to reset a password. See the :ref:`Reset a Password <doc-my-user-actions-reset-password>` action description.

.. note::
    An administrator may add non-default buttons to this list. If you see such non-default buttons as **Add Task**, **Add Event**, **Add Attachment** in the **More Actions** drop-down, see the :ref:`Activities <user-guide-activities>` guide for more information about actions that you can perform via them.


In the next row you, you can check which business unit owns your user record. Click the owner name to open the corresponding business unit view page. If you are logged into the organization with global access (i.e. technical organization that aggregates data from all organizations created in the system), then in brackets you will see the name of organization that owns the user.

.. image:: /user_guide/img/getting_started/my_oro/my_user_review_owner.png

Click the **Change History** link to see who, how and when modified your profile.

Other information is divided into three sections.

.. contents:: :local:
   :depth: 3

.. _doc-my-user-view-page-general:

General Information Section
---------------------------

This section contains information about the user filled in when creating the user.


.. image:: /user_guide/img/getting_started/my_oro/my_user_review_general.png


+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Field                   | Description                                                                                                                                                                                                              |
+=========================+==========================================================================================================================================================================================================================+
| Username                | A name that you use to log into the system.                                                                                                                                                                              |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Birthday                | A date of your birth and your calculated age.                                                                                                                                                                            |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Emails                  | A list of your email addresses. The first one (in bold) is the your primary email. You receive system notifications to this address, and it's a default address that appears in the **From** field in your emails.       |
|                         |                                                                                                                                                                                                                          |
|                         | Point to the email address and click the **Email** icon next to it to immediately compose an email. Click the **Hangouts** icon to start making a call.                                                                  |
|                         |                                                                                                                                                                                                                          |
|                         | .. image:: /user_guide/img/admin/user_management/user_email_write.png                                                                                                                                                    |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Phone                   |Your phone number. Point to the phone number and click the **Phone** or **Hangouts** icon that appear next to it to immediately start logging or making a call.                                                           |
|                         |                                                                                                                                                                                                                          |
|                         | .. image:: /user_guide/img/admin/user_management/user_hangouts_call.png                                                                                                                                                  |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Roles                   | A list of roles assigned to you.                                                                                                                                                                                         |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Groups                  | A list of groups to which you belong.                                                                                                                                                                                    |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Business Units          | A list of business units that you have access to.                                                                                                                                                                        |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Failed Login Count      | If the corresponding security policy is enabled for the organization, this field contains a number of failed login attempts that you performed up to date. If such policy is disabled, **N/A** is displayed.             |
|                         |                                                                                                                                                                                                                          |
|                         | As you can see your user page only being logged into the system and the counter cleans when you log in, you will always see 0. When an administrator views your page, they will able to see other values.                |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Password Expires At     | If the corresponding security policy is enabled for the organization, this field contains a date and time when your password expires. If such policy is disabled, **N/A** is displayed.                                  |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| LDAP Distinguished Name | A value of the **dn** LDAP field. This field is not empty only of your record has been imported from the LDAP server.                                                                                                    |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Tags                    | A list of tags added to your profile. Point to the the tag name (or **N/A** if no tags are defined) and click the **Edit** icon next to them to add a new tag.                                                           |
|                         | See more about how to add a tag in the :ref:`Add a Tag from the View Page <user-guide-tags-add>` action description.                                                                                                     |
|                         |                                                                                                                                                                                                                          |
|                         | .. image:: /user_guide/img/admin/user_management/user_tags_add.png                                                                                                                                                       |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| API key                 | An API key generated for you. Click the :guilabel:`Generate Key` button to generate a new key.                                                                                                                           |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| MS Outlook Add-In       | (For Enterprise Edition only) A link to the latest version of OroCRM add-in for Outlook. With this add-in you can synchronize contacts, tasks, and calendar events between OroCRM and your Outlook.                      |
|                         |                                                                                                                                                                                                                          |
|                         | Click the link to start the download.                                                                                                                                                                                    |
+-------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. For how to configure the add-in, see :ref:`Settings on the Outlook Side <doc-ms-outlook-add-in-set-up-outlook-side>`.

This section may also contain custom fields (e.g. **Title** on the screenshot above).



Activity Section
----------------

This section contains information about your activities: emails sent and received, calls, etc. If a user mentions you as a context for their activity, this activity will also appear in the list.



.. image:: /user_guide/img/getting_started/my_oro/my_user_review_activity.png


You can filter activities by type and by date range when they took or will take place and browse them from the newest to the oldest and vice verse.

You can see who started the activity, its type, name and description, when it was created and number of comments added under it.

Click the activity to see detailed information about it.

You can add a comment under a particular activity. To do this, click the activity to expand it and click the :guilabel:`Add Comment` button. In the **Add Comment** dialog box, type your message. Use the built-in text editor to format your comment. You can also attach a file to your comment. For this, click the **Upload** link in the dialog box and locate the required file. When the comment is ready, click :guilabel:`Add`.



.. image:: /user_guide/img/admin/user_management/user_review_activity_comment.png


To edit or delete a comment, click the ellipsis menu next to it and click the |IcEdit| **Edit** or |IcDelete| **Delete** icon correspondingly.



.. image:: /user_guide/img/admin/user_management/user_review_activity_comment2.png




You can add and delete an activity context. To delete a context for an activity, click the **x** icon next to the required context.


To add a context to the activity, click the **Context** icon in the ellipsis menu at the right end of the activity row. In the **Add Context Entity** dialog box, choose the desired context and click it to select.


.. image:: /user_guide/img/admin/user_management/user_review_activity_context_delete.png




.. image:: /user_guide/img/admin/user_management/user_review_activity_context_add.png


You can open an activity view page. To do this, click the |IcView| **View** icon in the ellipsis menu at the right end of the activity row.


.. image:: /user_guide/img/admin/user_management/user_review_activity_context_add.png



For an email activity, you can reply / reply all / forward the corresponding email. To do this, click the corresponding icon in the ellipsis menu at the right end of the activity row.


.. image:: /user_guide/img/admin/user_management/user_review_activity_reply.png


Alternatively, you can select the required action from the list in the activity expanded area.



.. image:: /user_guide/img/admin/user_management/user_review_activity_reply2.png



You can delete a phone activity. To do this, click the |IcDelete| **Delete** icon in the ellipsis menu at the right end of the activity row.


.. image:: /user_guide/img/admin/user_management/user_review_activity_delete.png



For a phone activity, you can immediately start a call via Google Hangouts if such functionality is enabled. To do this, point to the specified phone number and click the **Hangouts** icon next to it.

.. For how to enable Google Hangouts functionality, see the `Voice and Video Calls via Hangouts <../integrations/hangouts>`__ guide.



.. image:: /user_guide/img/admin/user_management/user_review_activity_phone_hangouts.png



For more information about activities, see the `Activities <../activities/activities-overview>`__ guide.


Additional Information Section
------------------------------

This section contains information about your tasks and opened cases.



.. image:: /user_guide/img/getting_started/my_oro/my_user_review_additional.png



Tasks Subsection
~~~~~~~~~~~~~~~~
This grid contains information about tasks assigned to you.

Tasks are activities that need to be accomplished. Keeping track on tasks helps organize the work process and ensure that all the important work is done.

You can filter tasks by a variety of parameters. To open the task view page, click this task in the grid.

For more information about tasks management, see the :ref:`Tasks <doc-activities-tasks>` guide.


Cases Subsection
~~~~~~~~~~~~~~~~
This grid contains information about cases assigned to you.

Cases are issues, problems or failures reported by customers or found internally. It is important to record, monitor and solve cases in time to ensure that small and big issues do not harm your the company business.

You can filter cases by a variety of parameters. To open the case view page, click this case in the grid.

For more information about cases management, see the :ref:`Cases <user-guide-activities-cases>` guide.

**Related Topics**

.. toctree::
   :maxdepth: 1

   my_user_actions
   my_user_system_config
   my_user_menus_config

.. include:: /user_guide/include_images.rst
   :start-after: begin