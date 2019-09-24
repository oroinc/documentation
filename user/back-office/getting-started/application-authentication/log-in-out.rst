:oro_documentation_types: crm, commerce

.. _user-guide-getting-started-log-in:

Log in/out
==========

Oro application is a web application, and to access it, you need to enter its address in a web browser.

If you are not currently logged into the Oro application, the **Login** page opens.

1. On the **Login** page, enter your Oro credentials: username and password.

   .. important:: Typically, you receive your credentials directly from an administrator, or they are automatically sent to the email address specified in your Oro application profile upon the profile creation. Oro application can be set up to accept your existing corporate username and password. This is possible if your organization utilizes LDAP to share them across multiple applications. Please check with your system administrator to see if this is the case.

2. If you want to be automatically registered the next time you open the Oro application from this device, select the **Remember me on this computer** check box.
3. Click **Log In**.

.. caution::  It is highly recommended to change your password immediately after the first login. See :ref:`Change Your Password <doc-my-user-actions-change-password>` for more information.

Log in with an Authentication Code
----------------------------------

As an additional security measure, an administrator may enable double-factor authentication for users. In this case, in addition to your username and password, you must also enter a special authentication code that you will receive to the email address specified in your Oro application user profile.

1. On the **Login** page, enter your username and password and click **Log In**.
2. On the **Authentication code** page that opens, enter the code that you have received to your email address.
3. Click **Log In**.

Log in with a Google Account
----------------------------

If Google Single Sign-On is enabled for your organization, you can log in using your Gmail account. Usually, this capability is enabled for corporate email addresses only, so you cannot use your personal mailbox credentials.

.. important:: The email used for the Google account and the primary email specified in your Oro application profile must be the same.

1. On the **Login** page, click the **Login Using Google** link.
2. If you are not logged into any Google accounts, the usual Google log-in appears after clicking the link.

   * Log into your Google account.
   * As soon as you have logged into your Google account, a request to use the account appears. Click **Allow**.

     .. image:: /user/img/getting_started/app_authentication/google_connection.jpg
        :alt: Click Allow on the request form

 .. _doc-log-out:

Log out
-------

To log out of the Oro application, click **Logout** in the user menu on the top right of the page.

.. image:: /user/img/getting_started/app_authentication/logout.png
   :alt: The logout button in the user menu