.. _user-guide-integrations-microsoft-single-sign-on:

Configure Microsoft 365 Single Sign-On in the Back-Office
=========================================================

.. note:: The feature is available for the Enterprise edition only.

Oro application supports Microsoft 365 Single Sign-On. This means that for a user that has the same primary email
in the Oro application and Microsoft accounts, it is possible to use only their Microsoft set of credentials to
securely authenticate themselves in the ORO application without using the usual back-office login form.

To configure the Single Sign-On with Microsoft 365 in your Oro application:

1. Navigate to **System > Configuration > Integrations > Microsoft Settings** in the main menu.

   .. image:: /user/img/system/config_system/microsoft-single-sign-on.png
      :alt: Microsoft 365 Single Sign-On Settings

2. Make sure that the :ref:`Azure Active Directory Application Settings <user-guide-integrations-azure-oauth>` are filled.

3. Define the following fields for **Microsoft 365 Single Sign-on**:

   * **Enable** --- Select the checkbox to enable the Single Sign-On setting.
   * **Domains** --- Enter a comma-separated list of email domains allowed to use Microsoft 365 SSO (e.g., domains associated with your company). It limits Microsoft 365 SSO access to users with email addresses matching these domains. Leave the field empty to allow any domain.
   * **Disable Non-SSO Login for Listed Domains** (available as of OroCommerce version 6.1.2) --- When enabled, users with email addresses matching the domains specified in the *Domains* field will be required to sign in using **Microsoft 365 SSO only**. Username and password login will be restricted for these users.
   * **Redirect URI** --- **READ-ONLY** field, the value is auto-generated and should be added in Azure Application Redirect URIs configuration.


Log in with Microsoft 365
^^^^^^^^^^^^^^^^^^^^^^^^^

When a user opens the login page of the instance with the enabled single sign-on capability, they can see an additional **Log in with Microsoft 365** button.

.. image:: /user/img/microsoft/log_in_with_microsoft_365.jpg
   :alt: The login page with the button to log in with Microsoft 365

If the user is not logged into their Microsoft account, then clicking the button triggers opening a usual Microsoft login page.

.. image:: /user/img/microsoft/usual_microsoft_365_login_page.jpg
   :alt: The usual Microsoft 365 log-in page

As soon as the user logs into their Microsoft account, they need to accept the policy of using the application.

.. image:: /user/img/microsoft/microsoft_connection.jpg
   :alt: Microsoft account page

Now, a Microsoft-registered user can click the **Log in with Microsoft 365** button to enter the Oro application.

.. note:: Note that the email used for the Microsoft account and the primary email of the user in the Oro application must be the same.


**Related Topics**

* :ref:`Configure Global Microsoft Settings <configuration-integrations-microsoft>`
* :ref:`Microsoft 365 OAuth (Azure Active Directory Application) <user-guide-integrations-azure-oauth>`
* :ref:`Microsoft 365 Integrations <user-guide-integrations-microsoft>`

.. include:: /include/include-links-user.rst
   :start-after: begin
