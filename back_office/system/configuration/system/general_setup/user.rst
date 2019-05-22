.. _admin-configuration-user-settings:

User Settings
=============

.. contents:: :local:

To apply user-related options in your Oro application instance:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > General Setup > User Settings**.
3. The following page opens:

   .. image:: /img/system/config_system/user.png
      :alt: User settings on global level

Configure Email Settings and Password Restrictions
--------------------------------------------------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30 

  "**Case-Insensitive Email Addresses**","If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled."
  "**Minimal Password Length**","Enter the number of characters to define the length of the password. By default, 8 is specified"
  "**Require a Number**","Specify whether the password should contain a number. By default, the option is enabled."
  "**Require A Lower Case Letter**","Specify whether the password should contain a lower case letter. By default, the option is enabled"
  "**Require An Upper Case Letter**","Specify whether the password should contain an upper case letter. By default, the option is enabled"
  "**Require A Special Character**","Specify whether the password should contain special characters: !""#$%&'()*+-,./:;<=>?@[\]^_`{|}~ and space. By default, the option is disabled"

Configure Login Attempts
------------------------

.. note:: This feature is only available in the Enterprise edition.

.. csv-table::
  :header: "Option", "Description" 
  :widths: 10, 30 

  "**Enable Failed Logins Limit**","Specify whether you wish to enable failed logins limit. By default, the option is enabled."
  "**Max Login Attempts**","Specify the maximum number of failed login attempts. By default, the number is set to 10."

Configure Password Change Policy
--------------------------------

.. note:: This feature is only available in the Enterprise edition.

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30 

  "**Enable Password Change Policy**","Enable this option to mandate your users to change their passwords after a certain period. The option is disabled by default."
  "**Maximum Password Age (Days)**","Specify the period of maximum password validity in days. By default, the number is set to 30."
  "**Enable Password History Policy**","This setting determines the number of unique new passwords that must be associated with a user account before an old password can be reused. The option is disabled by default."
  "**Enforce Password History**","The number of previous user passwords which the new password cannot match. The number is set to 12 by default."

Configure Two-factor Authentication
-----------------------------------

.. note:: This feature is only available in the Enterprise edition.

.. csv-table::
  :header: "Option", "Description" 
  :widths: 10, 30 

  "**Security Level**","Determines how often to require authentication via email: never, upon first login from a new computer, or at every login.

  .. image:: /img/system/config_system/authentication.png
     :alt: Two-factor authentication field in system configuration settings

  The option is disabled by default."
  "**Code Validity Period**","This option determines how long the authentication code will be valid. If not used within the validity period, the code expires and the user must log in again. By default, the option is set to 1 hour."
  "**Code Length**","This option determines the number of characters in authentication code. By default, the option is set to 6."


