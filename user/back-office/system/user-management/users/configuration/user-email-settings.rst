:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _admin-configuration-email-configuration-user:
.. _my_email_configuration:
.. _doc-my-user-configuration-email:
.. _user-guide-using-emails-vie:

Configure Email Settings per User
=================================

.. hint:: This topic is part of the :ref:`Email Configuration in the Back-Office <admin-guide-email-configuration>` topic.

.. note:: You can configure email settings :ref:`globally <admin-configuration-email-configuration-global>`, :ref:`per organization <admin-configuration-email-configuration-organization>`, :ref:`per website <admin-configuration-system-mailboxes-website>`, per user.

To configure email settings per user:

1. Navigate to **System > User Management > Users**  in the main menu.
2. For the necessary user, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > General Setup > Email Configuration** in the panel to the left.

.. _my-email-configuration:

   .. important:: To change *your own* email configuration settings:

                  1. Click on your username on the top right.
                  2. Click **My Configuration**.
                  3. Follow the steps described below.

Settings
--------

On the **Email Configuration** page, define options applied to all the emails in the application.

.. note:: To change any of the system-wide options, clear the **Use Organization** check box first.

1. **Signature** --- Add a signature to the emails.

   * *Signature Content* --- Specify the text and formatting of your signature. Bby default, the email signature body is empty.
   * *Append Signature to Email Body* --- Define whether a signature must be added automatically or manually.

2. **Email Synchronization Settings** --- provide details to configure your personal mailbox. Select one of the options below:

   .. hint:: Microsoft Office365 oAuth is available since OroCommerce v4.1.9. To check which application version you are running, see the :ref:`system information <system-information>`.

   .. note:: Please be aware that if the Account Type value has changed, a new mailbox will be registered and all data from the currently configured mailbox will be lost.

   * **Account Type: Gmail** is available when the application is integrated with Google and :ref:`OAuth 2.0 for email sync <admin-configuration-integrations-google-gmail-oauth>`  is enabled.

     * *Connected Account* --- The account connected to Gmail. Click **Retrieve Folders** to load folders from the connected account.


   * **Account Type: Office 365** is available when the application is integrated with :ref:`Microsoft Office365 OAuth <user-guide-integrations-azure-oauth>`.

     * *Connected Account* --- The account connected to Office 365. Click **Retrieve Folders** to load folders from the connected account.

   .. image:: /user/img/system/integrations/microsoft/office-365-email-sync.png
      :alt: Email synchronization settings for Office 365

   * **Account Type: Other**:

     * *Enable IMAP* --- Select the check box to enable retrieving email messages
     * *IMAP Host* --- Provide the IMAP Host, e.g. imap.gmail.com
     * *IMAP Port* --- Provide the IMAP Port, e.g. 993
     * *Encryption* --- Select the encryption type, SSL or TSL.
     * *Enable SMTP* --- Select the check box to enable sending messages
     * *SMTP Host* --- Provide the SMTP host, e.g. smtp.gmail.com
     * *SMTP Port* --- Provide the SMTP port, e.g. 587
     * *Encryption* --- Select the encryption type, SSL or TSL.
     * *User* --- Provide your email address
     * *Password* --- Provide your password

     Click **Check Connection/Retrieve Folders**. After successful connection, a list of folders will be loaded. Check the folders that you wish to be synchronized (e.g., Inbox).

     As an example, we have synchronized a Gmail mailbox with OroCRM, having previously turned on **access for less secure apps**. More details on how to synchronize your Gmail and turn on access for less secured apps can be found in the |Use IMAP to check Gmail| and |Less secure apps & your Google Account| topics.

  |

   .. image:: /user/img/system/user_management/personabox_imap_smtp.jpg
      :alt: Email synchronization settings configuration on the user level

  |

3. **Email Threads** --- **Display Email Conversations As** and **Display Emails In Activity Lists As** define how emails and replies are displayed to the users, as threads or separately. Two options are available: threaded and non-threaded.
 
4. **Reply** --- Define which button will be displayed as the default one: **Reply** is available by default with the **Forward** and **Reply all** options in the dropdown. The settings can be changed to have **Reply all** displayed at the top.

5. Click **Save Settings**.

**Related Topics** 

* :ref:`Configure Email Settings Globally <admin-configuration-email-configuration-global>`
* :ref:`Configure Email Settings per Organization <admin-configuration-email-configuration-organization>`
* :ref:`Configure Email Settings per Website <admin-configuration-system-mailboxes-website>`
* :ref:`Configure Microsoft Office365 OAuth <user-guide-integrations-azure-oauth>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin