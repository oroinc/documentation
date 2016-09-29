.. _user-guide-intro-log-in-edit-profile:

Log in, View Your User Page, and Set up Your Profile
====================================================

To get to your OroCRM account, enter the OroCRM instance url.

.. image:: ./img/intro/login.png

.. hint::

    The *"login using google"* option may not be available for your organization, check with your OroCRM Administrator.
    
    
.. _user-guide-getting-started-log-in:

Log in
------

Your administrator will determine this but typically upon your user account creation you will receive an email with your 
login credentials. In order to log in to the system for the first time, type in the username and password specified in 
the email. In order to save your credentials on a device, check the *"Remember me on this computer"* box before you log 
in.

.. caution::

    It is strictly recommended to change your password immediately after the first login. You can learn how to do it in 
    the :ref:`Changing Your Password sectio n<user-guide-getting-started-profile-password>` below.

If you have forgotten the credentials, click the *"Forgot your password?"* link and follow the wizard to restore them.


Log in Using Your Google Credentials
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If the Google Single Sign-On capability has been enabled for your organization, you will see the *"login using google"* 
link at the login screen. This means you can log in using your corporate Gmail account credentials. Usually this 
capability is enabled for corporate email addresses only, so your personal mailbox credentials won’t do.


Log in Using Other Corporate Credentials 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroCRM can be set up to accept your existing corporate login and password. This is possible if your organization 
utilizes a common server to share them across multiple applications. This is referred to as LDAP integration. Please 
check with your system administrator to see if this is the case.


.. _user-guide-getting-started-my-user:

Access Your User Page
---------------------

You can always find a link to your user page in the drop-down menu that resides below your username in the top right 
corner. This is a fast way to access your user profile, calendar, mailbox, and task list. 

.. image:: ./img/intro/user_menu.png

The following subsection is devoted to the user page that is available with *"My User"* menu. You can find more 
information about other menu items in the :ref:`User Menu <user-guide-getting-started-user-menu>` document.

.. _user-guide-getting-started-my-user-overview:

My User Page Overview
^^^^^^^^^^^^^^^^^^^^^

This page provides you the full details of your user profile.

Its *"General"* section contains the basic profile details.

|

.. image:: ./img/intro/user_view_general.png

|

The set of information available in the section depends on the 
:ref:`permissions <user-guide-user-management-permissions-basic>` defined for your user. The information may include:

* Your name and system information such as status (Active), login count, date and time of the last login - in the header

* Your username 

* Your birthday

* Information about your role and place in the company structure, such as your roles in the system and business units 
  you have access to, your API key (if any)
  
* Any additional details of a user defined for your organization (in the example above this is the *"Title"* field).

* A link to Outlook Add-in download (for enterprise users only)

* Tags assigned to your user

If there is an email saved or/and a call logged in OroCRM related to you, they will be displayed in the 
*"Activities"* section. 

.. image:: ./img/intro/user_view_activities.png

If there is a :ref:`task <user-guide-activities-tasks>` or a :ref:`case <user-guide-activities-cases>` assigned to you, 
they will be displayed in corresponding grids of the "*Additional"* section.

|

.. image:: ./img/intro/user_view_additional.png 

|

Actions Available From the "My User" Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Use Action Buttons
""""""""""""""""""

Action buttons are available in the top left corner of *"My User"* page. The set of buttons depends on your organization 
settings and user permissions. These are the same actions that you can perform in the system with regard to other users.
Most of the actions is described in the :ref:`Productivity Tools section <user-guide-productivity-tools>`.

|

.. image:: ./img/intro/user_view_actions.png 

|

.. _user-guide-getting-started-my-user-tags:

Add and Edit Tags
"""""""""""""""""

If you a permitted, you can add and edit tags for your user. The tags can be used for the search, reporting, 
segmentation and filtering.

- Hover the mouse over the *"Tags"* field in the *"General"* section of the *"My User"* page as shown below.

  |

  |IntroTags|

  |
  
- Click the |IcEdit| icon, and the tag field will appear.

  |
  
  |IntroTags1|

  |
  
- Start entering a tag and if an existing tag is found, it will be displayed for selection. If not, a new tag will be 
  created.  

- If you have entered a new tag, it will appear in the selector with a *"(New tag)"* label. Select this to add to your 
  user as well as the list of available tags for future use. This way you can add one or more tags that contain one or 
  several words.
  
  |
  
  |IntroTags2|

  |
  
Generate an API Key
"""""""""""""""""""

Should an integration with a third-party software require an 
`API Key <https://en.wikipedia.org/wiki/Application_programming_interface_key>`_, it can be generated  on the "My User" 
page:

|

.. image:: ./img/intro/user_view_apik.png

|

- Click the :guilabel:`Generate Key` button next to the API Key label.

- Copy and use the key generated.

.. caution::

    Only one API key may exist for the user at the same time. If you choose to generate another API key over the 
    existing one, the old key is discarded and cannot be used to access OroCRM.
    

.. _user-guide-getting-started-my-user-outlook:
    
Download the Outlook Add-in
"""""""""""""""""""""""""""

OroCRM Enterprise Edition users will also find a link to the latest version of OroCRM add-in for Outlook. 
With this add-in you can synchronize contacts, tasks, and calendar events between OroCRM and your Outlook.  
You can associate emails to accounts, contacts, opportunities, and cases and create leads, opportunities and cases 
in OroCRM based on emails from the Outlook side bar.

|

.. image:: ./img/intro/user_outlook.png

|

Click the link to start the download. The file will be saved subject to your browser settings. 

To learn more about the add-in, please refer to the :ref:`Integration with Outlook guide <user-guide-synch-outlook>`.


Get to the Edit Page of Your User Profile
"""""""""""""""""""""""""""""""""""""""""    
Click the :guilabel:`Edit` button in the top left corner of the page to change and add the profile details, as described 
in the section below.

|

.. image:: ./img/intro/user_edit.png
    
|
    
.. _user-guide-getting-started-profile:
    
Edit Your User Profile
----------------------

Once you have clicked the Edit, the Edit form of your user profile will be displayed. Here you can update your 
credentials, change your password, and synchronize OroCRM with an existing IMAP mailbox.

Manage Your User Details
^^^^^^^^^^^^^^^^^^^^^^^^

|

.. image:: ./img/intro/user_edit_general.png

|

At the top of the *"General"* section, you can view, define and change the basic details such as:

- **Username**: An alias used for login and identification. It should be at least three characters long and cannot 
  start with a space.

- **Names**: Your personal name. It can be comprised of the first, middle, and last name, a prefix and a suffix. The 
  first and the last name are mandatory. You can use any number of characters of any alphabet in the name.

- **Birthday**: Select the date in the calendar. 

- **Avatar**: A picture associated with you in the system. To set an avatar, click the :guilabel:`Choose file` button 
  and select your avatar file from your computer. Avoid using large files; 100×100 pixels is recommended. After you have 
  saved the user settings the file will be checked for consistency with your organization’s rules.  Please contact your 
  OroCRM administrator for details. The image will be displayed along with your name in the selectors and will help 
  other users to recognize you quickly.

  |
  
  |EditAvatar|

  |
  
Any custom details permitted for editing will be available in the *"Additional"* section. In the example above, this is 
the *"Title"* field.

.. note::

    Although the *"Status"* fields is displayed on the Edit user page, you cannot change it, as it is impossible to 
    deactivate a profile that you are using.

    
Manage Your Contact Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
 
You can define and update the contact information in  the *"General"* section. 

|

.. image:: ./img/intro/user_edit_contacts.png 

|
  
- **Your email addresses**: You are required to provide a primary email address. This email address must be unique for 
  each user in the system. You can also add additional email addresses via :guilabel:`Add Another Email` button. 
  
  These addresses are used when an email is created within OroCRM: 

 - The primary email address is used as a default value and additional addresses are available in the selector for the 
   *"from"* field.

   |
   
   |EmailFrom|

   |

.. note::

     If synchronization with an external SMTP server has been enabled for an external mailbox (as described in the 
     :ref:`Synchronize Your Mailbox with OroCRM section <user-guide-intro-log-in-edit-profile-synchronize>` below, 
     your addressee will always see the address of the synchronized mailbox as the *"from"* field value.

 - You will see the letters sent by other OroCRM users to your primary and additional email addresses in the 
   "Activities" section on your User page.
   
   |
   
   |EmailTo|   
   
   |
   
- **Phone number**: is displayed to other users among your contact details and will be used as a default value to log a 
  call related to you or call you via integrated phone applications, such as 
  :ref:`Google Hangouts <user-guide-hangouts>`.

  |
  
  |Phone|
  
  |
  
- **Email signature**: The signature may be added to any email you write in OroCRM. Your organization settings define 
  whether the signature will be added automatically or manually. 


.. _user-guide-getting-started-profile-password:

Change Your Password
^^^^^^^^^^^^^^^^^^^^

To change your password, go to the *"Password"* section of the Edit page. 

|

.. image:: ./img/intro/user_edit_password.png

|

You have to:

- Type in your current password

- Type in the new password

- Confirm the new password


.. note::

    If you are not using your Google account, nor your corporate-wide credentials, it is strongly recommended to change 
    your password after the first log-in.


.. _user-guide-intro-log-in-edit-profile-synchronize:

Synchronize Your Mailbox with OroCRM
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Emails can be sent from user to user within OroCRM and outside OroCRM using internal OroCRM SMTPserver. However, most 
OroCRM users already have some external mailbox used for work-related purposes. You can synchronize this mailbox with 
your mailbox in OroCRM in the *"Email synchronization settings"* section.

|

.. image:: ./img/intro/email_sync_1.png

|

To synchronize your existing mailbox with your mailbox in OroCRM, go the the *"Email synchronization settings"* section.

OroCRM can be synchronized with any IMAP/SMTP servers. A dedicated *"Gmail"* synchronization is available to simplify 
synchronization with Gmail-based accounts. 

If synchronization with an IMAP server has been defined, all the emails from synchronized folders of the external 
mailbox will be available to you in *"My Emails"* in OroCRM. If If synchronization with an SMTP server has been defined, 
all the emails sent from OroCRM will be available in the external mailbox.

Please note, that if SMTP synchronization has been enabled, your addressee will always see the mailbox address as the 
*"from"* field value.

.. note::

    If no synchronization has been enabled, emails received from other OroCRM users will appear in the *"Activity"* 
    section of the *"My User"* page but not in *"My Emails"*. Emails from a synchronized mailbox can be reached from the 
    both.

Synchronize with any IMAP/SMTP Server
"""""""""""""""""""""""""""""""""""""    

The functionality can be used to synchronize any IMAP/SMTP server with your mailbox in OroCRM. 

- Select the Account Type - *"Other"* (if available). If this is an only option enabled for the system, the selector 
  won’t be displayed - skip the step.
  
  |
  
  |EmailSync2|

  |
  
* In order to **receive emails** from the external mailbox in OroCRM:

  - Check the *"Enable IMAP"* box.

  - Provide your IMAP credentials: host, port, and encryption type (contact your administrator for assistance).

- In order to **synchronize emails sent** from OroCRM in to the external mailbox:

  - Check the *"Enable SMTP"* box.

  - Provide your SMTP credentials: host, port, and encryption type (contact your administrator for assistance).

.. hint::

    If you choose not to enable SMTP synchronization, you will still be able to send emails from OroCRM, but they won’t 
    be synced with the email server and you will not see them in other email clients (such as Outlook or Gmail web 
    interface). We strongly recommend to enable SMTP at all times.

* In order to **finish the synchronization**:

  - Provide your access credentials: your login/username (usually the email address itself) and password used to access 
    the mailbox.
   
  - Click the :guilabel:`Check Connection/Retrieve Folders` button. 

  - Once connection has been established , you will see the list of folders. Check the folders you want to synchronize 
    with OroCRM.

  - Save the user profile.
  
|
  
|EmailSyncYahoo|
  
|  

Syncing with Gmail
""""""""""""""""""

You may use the generic IMAP/SMTP synchronization described above for your Gmail account, however,you must allow access 
for *"less secure apps"* in your Gmail settings first. (Please see detailed instructions 
`here <https://support.google.com/mail/troubleshooter/1668960?hl=en&rd=1#ts=1665018%2C1665144>`_.) 

To avoid this step and improve security we strongly recommend to use the dedicated functionality described below.
This section applies to both @gmail.com customers and Google Apps customers.(Check with your email administrator if you 
doubt).

- Select the Account Type - *"Gmail"* and click the :guilabel:`Connect` button that appears below.

  |
  
  |EmailSync3|
  
  |
  
.. note::

    This option is only available if your OroCRM instance is connected with a Google Apps account. Please check with 
    your system administrator if you want to enable Gmail synchronization for your account.

 - If you haven’t used a Google account in your browser (or if its cache has been cleared), the Sign-in form will appear. 
   Use it to log in to your account.

   |
  
   |EmailSyncGM1|

   |

 - If you are using several Gmail accounts in your browser, you will see a list of them. Select the account for which 
   you want to enable synchronization with OroCRM, then log in (if necessary).
   
   |
   
   |EmailSyncGM2|
   
   |
   
 - As soon as you are logged into a single Gmail account, you need to let OroCRM view and manage your mail, and give it 
   offline access to your mailbox.
   
   |
   
   |EmailSyncGM3|
   
   |EmailSyncGM4|

   |
   
.. hint::

    Make sure that pop-up windows from your OroCRM instance are not blocked.


- After the connection has been established, you will see the connected account name (your email address) and the list of 
  folders that can be refreshed with the :guilabel:`Retrieve Folders` button.

  |
  
  |EmailSyncGM5|
  
  |
  
Select the folders you want to synchronize and save your user profile. The synchronization will start immediately, but 
the full sync can take a while depending on the size of your mailbox.

Change the Synchronized Mailbox
"""""""""""""""""""""""""""""""

If you want to change the mailbox you sync with OroCRM, simply change the IMAP/SMTP credentials for generic IMAP sync, 
or remove the connected Gmail account, change your primary email address, and sync with Gmail again.

.. caution::

    If you change the synced mailbox, all emails from the previous mailbox will be deleted from OroCRM.   
    
Configuring Mailboxes in the Multi-Organization Environment
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

If you want to work with email in :ref:`multiple organizations <user-guide-getting-started-change-organization>`, you 
have to configure a mailbox for every organization. You can synchronize different external mailboxes or the 
same external mailbox for your user in different organizations.


Save the Changes
----------------
Click the :guilabel:`Save and Close` button in the top right corner to save the changes to your profile and return to 
the *"My User"* page.

Logout
------

Go to the User Menu in the top right corner of the page, and select the *"Logout"* item.

|

.. image:: ./img/intro/user_logout.png





.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle
 
.. |IntroTags| image:: ./img/intro/user_view_tags.png    

.. |IntroTags1| image:: ./img/intro/user_view_tags_1.png    

.. |IntroTags2| image:: ./img/intro/user_view_tags_2.png    

.. |EditAvatar| image:: ./img/intro/user_edit_avatar.png   

.. |EmailFrom| image:: ./img/intro/user_edit_email_from.png   

.. |EmailTo| image:: ./img/intro/user_edit_email_to.png   

.. |Phone| image:: ./img/intro/user_edit_phone.png   

.. |EmailSync2| image:: ./img/intro/email_sync_2.png   

.. |EmailSyncYahoo| image:: ./img/intro/email_sync_yahoo.png 

.. |EmailSync3| image:: ./img/intro/email_sync_3.png  

.. |EmailSyncGM1| image:: ./img/intro/email_sync_gm_1.png  

.. |EmailSyncGM2| image:: ./img/intro/email_sync_gm_2.png  

.. |EmailSyncGM3| image:: ./img/intro/email_sync_gm_3.png  

.. |EmailSyncGM4| image:: ./img/intro/email_sync_gm_4.png  

.. |EmailSyncGM5| image:: ./img/intro/email_sync_gm_5.png  




