.. _user-guide-google-single-sign-on:

Configure Google Single Sign-On in the Back-Office
==================================================

Oro application supports Google Single Sign-On. This means that for a user that has the same primary email in the Oro application and Google accounts, it is enough to log in only once during a session.

Google Side
-----------

Create Project
^^^^^^^^^^^^^^

To configure single sign-on on the Google side:

1. Open |Google API Console|.
2. Click **My Project** selector in the top left corner to open a popup form.
3. Click **New Project** at the top right.

   .. image:: /user/img/google/create_project.png
      :alt: Create a project in the Google API console

4. Define the **Project Name** and select the **Location**.
5. Click **Create**.

   .. image:: /user/img/google/new_project.png
      :alt: A new project page

Create Credentials
^^^^^^^^^^^^^^^^^^

1. Navigate to **API & Services > Credentials** in the menu on the left.

2. Click **+ Create Credentials** and then click **0Auth client ID.**

   .. image:: /user/img/google/create_credentials.png
      :alt: The Credentials menu details

3. To create an OAuth client ID, set the **Application Type** to **Web Application** to load more settings depending on the selected type.

4. Enter the **Name** of your OAuth client.  This name is only used to identify the client in the console and will not be shown to end users.

5. For **Authorized JavaScript Origins**, enter the URL of the Oro application instance for which single sign-on is being enabled.

6. **Authorized Redirect URIs** are unified resource names used for the interaction between Google and the Oro application instance. It is recommended to add the following two values:

   * [Oro application instance URL]/admin/login/check-google
   * [Oro application instance URL]/index.php/admin/login/check-google

.. image:: /user/img/google/create_credentials_form.png
   :alt: The details you need to provide to configure to create OAuth client ID

.. note:: Please pay attention to the **Authorized Redirect URIs**, the value from the **System > Configuration > Integrations > Google Settings > Google Integration Settings > Redirect URI** must be added in Authorized Redirect URIs configuration.

7. Click **Create**.

8. Your **Client ID** and **Client Secret** are generated. For security reasons, the Client Secret is displayed only once -- immediately after you have created a new OAuth client. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe to access it later.

.. image:: /user/img/google/id_secret.png
   :alt: OAuth client ID and secret

The client ID can always be accessed from the **Google Auth Platform > Clients** main menu.

.. image:: /user/img/google/clients_id_secret.png
   :alt: OAuth client ID under Google Auth Platform > Clients menu


Oro Application Side
--------------------

Configure Google Single Sign-On
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the integration with Google Single Sign-On in your Oro application:

1. Navigate to **System > Configuration > Integrations > Google Settings** in the main menu.
2. Make sure that the information in the **Google Integration Settings** and **OAuth 2.0 for Gmail emails sync** is filled as described in the :ref:`Configure Google Integration Settings <system-configuration-integrations-google>` topic.
3. Define the following fields for **Google Sign-On:**

   * **Enable** --- Check **Enable** to activate Google Single Sign-on.
   * **Domains** --- Enter a comma-separated list of email domains allowed to use Google SSO (e.g., domains associated with your company). It limits Google SSO access to users with email addresses matching these domains. Leave the field empty to allow any domain.
   * **Disable Non-SSO Login for Listed Domains** (available as of OroCommerce version 6.1.2) --- When enabled, users with email addresses matching the domains specified in the *Domains* field will be required to sign in using **Google SSO only**. Username and password login will be restricted for these users.


.. image:: /user/img/system/config_system/google_integration_new.png
   :alt: Global Google integration settings

Log in with Google
^^^^^^^^^^^^^^^^^^

When a user opens the login page of the instance with the enabled single sign-on capability, the **Login Using Google** link is displayed.

.. image:: /user/img/google/login_using_google.png
   :alt: The login page with the link to log in via google

If the user is not logged into their Google account, then clicking the button triggers opening a usual Google login page.

As soon as the user logs into their Google account, they need to accept the policy of using the application.

As soon as the user has logged into their Google account, a request to use the account in order to login to the Oro application is displayed (details defined for the consent screen is used).

.. image:: /user/img/google/google_connection.jpg
   :alt: Google account page

Now, a Google-registered user can click the **Login using Google** button to enter the Oro application.

.. note:: Note that the email used for the Google account and the primary email of the user in the Oro application must be the same.


**Related Topics**

* :ref:`Configure Global Google Settings <admin-configuration-integrations-google>`
* :ref:`Configure Google Integration Settings <system-configuration-integrations-google>`
* :ref:`Configure Google Tag Manager Integration <gtm-ga-4-integration>`


.. include:: /include/include-links-user.rst
   :start-after: begin
