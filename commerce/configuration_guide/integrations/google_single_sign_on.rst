.. _user-guide-google-single-sign-on:

Google Single Sign-On
=====================


.. contents:: :local:
    :depth: 4
    
Oro application supports Google Single Sign-On. This means that for
a user that has the same primary email in the Oro application and Google
accounts, it is enough to log-in only once during a session.

Google Side
-----------

Create Project
~~~~~~~~~~~~~~

To configure such capability on the Google side:

-  Open `Google API Console <https://console.developers.google.com/start>`__

-  Navigate to **My Project** selector in the top left corner and click
   **Create Project**.

   .. image:: /user_guide/system/img/google_integration/create_project.jpg

-  Define the **Project Name** and click **Create**.

   .. image:: /user_guide/system/img/google_integration/new_project.jpg

Create Credentials
~~~~~~~~~~~~~~~~~~

-  Click **Credentials** in the menu on the left and open
   **Credentials** tab.

   .. image:: /user_guide/system/img/google_integration/create_credentials.jpg

-  Click **Create Credentials** and select **0Auth client ID.**

   .. image:: /user_guide/system/img/google_integration/create_credentials_2.jpg

-  To create an OAuth client ID, you should first set a product name on
   the consent screen.

Configure Consent Form
~~~~~~~~~~~~~~~~~~~~~~

-  Click **Configure Consent Form**.

   .. image:: /user_guide/system/img/google_integration/consent_form.jpg

- Complete the form by entering:

  -  Your email address

  -  Project name

  -  Homepage URL

  -  Product logo

  -  Private Policy URL

  -  Terms of Service URL

  .. image:: /user_guide/system/img/google_integration/complete_form.jpg

-  Clicking **Save** will launch a **Create Client ID** page.

-  Set **Application Type** to **Web Application**.

-  In **Authorized JavaScript Origins** enter the URL of the Oro application
   instance for which single sign-on is being enabled.

-  **Authorized Redirect URIs** are the unified resource names used for
   interaction between Google and the Oro application instance. It is recommended
   to add the following two values:

   -  [Oro application instance URL]/login/check-google

   -  [Oro application instance URL]/app.php/login/check-google

-  Click **Create Client ID**.

   .. image:: /user_guide/system/img/google_integration/create_id.jpg

-  Your client ID should have now been generated.

   .. image:: /user_guide/system/img/google_integration/id_secret.jpg

   .. image:: /user_guide/system/img/google_integration/id_secret_2.jpg


Oro Application Side
--------------------

Configure Google Integration
----------------------------

-  Navigate to **System** in the main menu and click **Configuration.**

-  In the left menu, click **Integrations > Google Settings**.

-  Define the following fields for **Google Integration Settings**:

+---------------------+---------------------------------------------------+
| **Field**           | **Description**                                   |
+=====================+===================================================+
| **Client ID**       | The Client ID generated in the API console.       |
+---------------------+---------------------------------------------------+
| **Client Secret**   | The Client Secret generated in the API console.   |
+---------------------+---------------------------------------------------+

-  Define the following fields for **Google Sign-on:**

+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**                    | Description                                                                                                                                                                                                                          |
+==============================+======================================================================================================================================================================================================================================+
| **Enable**                   | Check **Enable.**                                                                                                                                                                                                                    |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**                  | Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation. |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **OAuth 2.0 for email sync** | Check **Enable.**                                                                                                                                                                                                                    |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user_guide/system/img/google_integration/oro_google_integration.jpg

Using Google Sign-on
--------------------

When a user gets to the login page of an instance for which single
sign-on capability has been enabled, a **Login Using Google** link will
appear.

.. image:: /user_guide/system/img/google_integration/login_using_google.jpg

-  If the user is not logged into any Google accounts after the link
   has been clicked, a usual Google log-in page will appear.

-  As soon as the user has logged into their Google account, a request
   to use the account in order to log-in to Oro application will appear (details
   defined for the consent screen will be used).

.. image:: /user_guide/system/img/google_integration/google_connection.jpg

For now on, for a user logged-in into a Google account, it is enough to
click the **Login using Google** link to get into Oro application.

Note that the email used for the Google account and the primary email of
the user in Oro application must be the same.
