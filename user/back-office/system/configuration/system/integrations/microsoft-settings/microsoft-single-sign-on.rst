:oro_documentation_types: OroCRM, OroCommerce, Extension

.. _user-guide-integrations-microsoft-single-sign-on:

Configure Microsoft 365 Single Sign-On in the Back-Office
=========================================================

.. hint::
    Microsoft 365 Single Sign-On is available since OroCRM Enterprise v4.2.7 as part of the |Oro-Microsoft 365 Integration| extension. To check which application version you are running, see the :ref:`system information <system-information>`.

Oro application supports Microsoft 365 Single Sign-On. This means that for a user that has the same primary email
in the Oro application and Microsoft accounts, it is possible to use only their Microsoft set of credentials to
securely authenticate themselves in the ORO application without using the usual back-office login form.

To configure the Single Sign-On with Microsoft 365 in your OroCRM or OroCommerce application:

1. Navigate to **System > Configuration > Integrations > Microsoft Settings** in the main menu.

   .. image:: /user/img/system/config_system/microsoft-single-sign-on.png
      :alt: Microsoft 365 Single Sign-On Settings

2. Make sure that the :ref:`Azure Active Directory Application Settings <user-guide-integrations-azure-oauth>` are filled.

3. Define the following fields for **Microsoft 365 Single Sign-on**:

   * **Enable** --- Select the check box to enable the Single Sign-On setting.
   * **Domains** --- A comma-separated list of allowed domains. It limits the list of application domains for which single sign-on can be used. Leave the field empty to set *No* for such limitation.
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
