:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-user-settings:

Configure Global User Settings
==============================

To apply user-related options in your Oro application instance:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > General Setup > User Settings**.

   .. image:: /user/img/system/config_system/user.png
      :alt: User settings on global level

Configure Email Settings
------------------------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30 

  "**Case-Insensitive Email Addresses**","If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled. Be noted that the setting is only applied to back-office users. The identical option for customer users is managed :ref:`here <sys-config--configuration--commerce--customers--customer-users>`"


Configure Password Restrictions
-------------------------------

.. note:: The options configured in the Password Restrictions section are applied to both storefront and back-office users.

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30

  "**Minimal Password Length**","Enter the number of characters to define the length of the password. By default, 8 is specified"
  "**Require a Number**","Specify whether the password should contain a number. By default, the option is enabled."
  "**Require A Lower Case Letter**","Specify whether the password should contain a lower case letter. By default, the option is enabled"
  "**Require An Upper Case Letter**","Specify whether the password should contain an upper case letter. By default, the option is enabled"
  "**Require A Special Character**","Specify whether the password should contain special characters: !""#$%&'()*+-,./:;<=>?@[\]^_`{|}~ and space. By default, the option is disabled"

Configure Login Attempts
------------------------

.. note:: This feature is only available in the Enterprise edition and is only applied to back-office users.

.. csv-table::
  :widths: 10, 30 

  "**Enable Failed Logins Limit**","Specify whether you wish to enable failed logins limit. By default, the option is enabled."
  "**Max Login Attempts**","Specify the maximum number of failed login attempts. By default, the number is set to 10."

.. _doc-user-management-users-actions-password-change-policy:

Configure Password Change Policy
--------------------------------

.. note:: This feature is available in the Platform Enterprise edition and is only applied to back-office users.

You can enforce a password change policy to increase your application's security and request that your users change their passwords after a certain period.

To enable the feature:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > User Settings** in the menu to the left.
3. Select the **Enable Password Change Policy** checkbox to enable the feature.
4. By default, the password should be changed every 30 days. You can change the default number of days by toggling the option **Maximum Password Age (Days)**.

.. image:: /user/img/system/user_management/password_change_policy.png

Once the feature is enabled, users will receive email notifications 7, 3, and 1 days before the password expires with a link to change their password.
Seven days before the password expires, the user will start getting flash notifications on each login, prompting them to change their password.

.. image:: /user/img/system/user_management/expire_notification.png

As soon as the password expires, the user will receive an email with the link to change the password. From that moment, they will only be able to log in if they have updated their password. In this case, the status of the user password in the back-office changes to **Expired**. It will return to **Active** once the user changes the password.

You can change the contents of email notifications by updating the **user_expired_password** and **mandatory_password_change** :ref:`email template <user-guide-using-emails-create-template>` of the User entity.

.. _doc-user-management-users-actions-password-history-policy:
.. _user-guide--customers--customer-user-password-history-policy:

Configure Password History Policy
---------------------------------

.. note:: This is a Platform Enterprise feature.

You can enable the password history policy to prevent users from reusing the password they have already used previously.

To enable the feature:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > User Settings** in the menu to the left.
3. Select the **Enable Password History Policy** checkbox to enable the feature.
4. By default, the system collects the last 12 previously used passwords, but you can change this number by toggling the option **Enforce Password History Policy**.

.. image:: /user/img/system/user_management/password_history_policy.png

Once the feature is enabled, customer users will no longer be able to reuse their older passwords. If they try to, they will get the following message:

.. image:: /user/img/system/user_management/password_history_used_password.png

Configure Two-Factor Authentication
-----------------------------------

.. note:: This feature is only available in the Enterprise edition and is only applied to back-office users.

.. csv-table::
  :widths: 10, 30 

  "**Security Level**","Determines how often to require authentication via email: never, upon first login from a new computer, or at every login.

  .. image:: /user/img/system/config_system/authentication.png
     :alt: Two-factor authentication field in system configuration settings

  The option is disabled by default."
  "**Code Validity Period**","This option determines how long the authentication code will be valid. If not used within the validity period, the code expires and the user must log in again. By default, the option is set to 1 hour."
  "**Code Length**","This option determines the number of characters in authentication code. By default, the option is set to 6."

