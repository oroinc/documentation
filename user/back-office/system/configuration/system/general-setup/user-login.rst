.. _admin-configuration-user-login-form:

Configure Global User Login Settings
====================================

To apply user login-related options in your Oro application instance:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > General Setup > User Login**.

   .. image:: /user/img/system/config_system/user_login.png
      :alt: User login settings on global level

Configure User Login Form
-------------------------

In the User Login Form section, configure the ability for a user to sign in to the back-office with a username and password.

* **Enable Username/Password Login** - When this option is enabled, users can sign in to the back-office with a username and password, and all features related to passwords will be available. If you disable this option, password login will be turned off for all users, including you and administrators. Consequently, all password-related features will also become unavailable.

.. important:: Before disabling this option, make sure that at least one external authentication method (such as Single Sign-On) is properly set up. Otherwise, you may lose access to the system.

**Comparison of pages with username/password login enabled and disabled**

**1. Login page**

.. image:: /user/img/system/config_system/enable-username-password-login.png
   :alt: Comparison of two user login forms: one with username/password login enabled and one with it disabled.

**2. User details page**

.. image:: /user/img/system/config_system/enable-username-password-login-user-details.png
   :alt: Comparison of two user login forms: one with username/password login enabled and one with it disabled.

**3. System configuration page**

.. image:: /user/img/system/config_system/enable-username-password-login-system-config.png
   :alt: Comparison of two user login forms: one with username/password login enabled and one with it disabled.


Configure Password Restrictions
-------------------------------

.. note:: The options configured in the Password Restrictions section are applied to both storefront and back-office users.

* **Minimal Password Length** --- Enter the number of characters to define the length of the password. By default, 8 is specified.
* **Require a Number** --- Specify whether the password should contain a number. By default, the option is enabled.
* **Require A Lower Case Letter** --- Specify whether the password should contain a lower case letter. By default, the option is enabled.
* **Require An Upper Case Letter** --- Specify whether the password should contain an upper case letter. By default, the option is enabled.
* **Require A Special Character** --- Specify whether the password should contain special characters: !""#$%&'()*+-,./:;<=>?@[\]^_`{|}~ and space. By default, the option is disabled.

Configure Login Attempts
------------------------

.. note:: This feature is only available in the Enterprise edition and is only applied to back-office users.

In the Login Attempts section, configure the following options:

* **Enable Failed Logins Limit** --- Specify whether you wish to enable failed logins limit. By default, the option is enabled.
* **Max Login Attempts** --- Specify the maximum number of failed login attempts. By default, the number is set to 10.

.. _doc-user-management-users-actions-password-change-policy:

Configure Password Change Policy
--------------------------------

.. note:: This feature is available in the Platform Enterprise edition and is only applied to back-office users.

You can enforce a password change policy to increase your application's security and request that your users change their passwords after a certain period.

To enable the feature:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > User Login** in the menu to the left.
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
2. Select **System Configuration > General Setup > User Login** in the menu to the left.
3. Select the **Enable Password History Policy** checkbox to enable the feature.
4. By default, the system collects the last 12 previously used passwords, but you can change this number by toggling the option **Enforce Password History Policy**.

.. image:: /user/img/system/user_management/password_history_policy.png

Once the feature is enabled, customer users will no longer be able to reuse their older passwords. If they try to, they will get the following message:

.. image:: /user/img/system/user_management/password_history_used_password.png

Configure Two-Factor Authentication
-----------------------------------

.. note:: This feature is only available in the Enterprise edition and is only applied to back-office users.

In the Two-Factor Authentication section, configure the following options:

* **Security Level** --- Determines how often to require authentication via email: never, upon first login from a new computer, or at every login. The option is disabled by default.

.. image:: /user/img/system/config_system/authentication.png
   :alt: Two-factor authentication field in system configuration settings

* **Code Validity Period** --- This option determines how long the authentication code will be valid. If not used within the validity period, the code expires and the user must log in again. By default, the option is set to 1 hour.
* **Code Length** --- This option determines the number of characters in authentication code. By default, the option is set to 6.