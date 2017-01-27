.. _user-guide-google-single-sign-on:

Google Single Sign-On Capabilities for OroCRM
==============================================


.. contents:: :local:
    :depth: 4
    
OroCRM supports Google Single Sign-On capabilities. This means that for
a user that has the same primary email in the OroCRM and Google
accounts, it is enough to log-in only once during a session.

Google Side
-----------

Create Project
~~~~~~~~~~~~~~

To configure such capability on the Google side:

-  Open `Google API
   Console <https://console.developers.google.com/start>`__

-  Navigate to **My Project** selector in the top left corner and click
   :guilabel:`Create Project`.

|

.. image:: ../img/google_integration/create_project.jpg

|


-  Define the **Project Name** and click :guilabel:`Create`.

|

.. image:: ../img/google_integration/new_project.jpg

|





Create Credentials
~~~~~~~~~~~~~~~~~~

-  Click :guilabel:`Credentials` in the menu on the left and open
   **Credentials** tab.

|

.. image:: ../img/google_integration/create_credentials.jpg

|


-  Click :guilabel:`Create Credentials` and select **0Auth client ID.**

|

.. image:: ../img/google_integration/create_credentials_2.jpg

|



-  To create an OAuth client ID, you should first set a product name on
   the consent screen.

Configure Consent Form
~~~~~~~~~~~~~~~~~~~~~~

-  Click :guilabel:`Configure Consent Form`.
   
|

.. image:: ../img/google_integration/consent_form.jpg

|



- Complete the form by entering:

  -  Your email address

  -  Project name

  -  Homepage URL

  -  Product logo

  -  Private Policy URL

  -  Terms of Service URL

|

.. image:: ../img/google_integration/complete_form.jpg

|


-  Clicking :guilabel:`Save` will launch a **Create Client ID** page.

-  Set **Application Type** to **Web Application**.

-  In **Authorized JavaScript Origins** enter the URL of the OroCRM
   instance for which single sign-on is being enabled.

-  **Authorized Redirect URIs** are the unified resource names used for
   interaction between Google and the OroCRM instance. It is recommended
   to add the following two values:

   -  [OroCRM instance URL]/login/check-google

   -  [OroCRM instance URL]/app.php/login/check-google

-  Click :guilabel:`Create Client ID`.

|

.. image:: ../img/google_integration/create_id.jpg

|


-  Your client ID should have now been generated.

|

.. image:: ../img/google_integration/id_secret.jpg

|

|

.. image:: ../img/google_integration/id_secret_2.jpg

|





OroCRM Side
-----------

Configure Google Integration
----------------------------

-  Navigate to **System** in the main menu and click **Configuration.**

-  In the left menu, click :guilabel:`Integrations>Google Settings`.

-  Define the following fields for **Google Integration Settings**:

+---------------------+---------------------------------------------------+
| **Field**           | **Description**                                   |
+=====================+===================================================+
| **Client ID**       | The Client ID generated in the API console.       |
+---------------------+---------------------------------------------------+
| **Client Secret**   | The Client Secret generated in the API console.   |
+---------------------+---------------------------------------------------+

-  Define the following fields for **Google Sign-on:**

+--------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**                      | Description                                                                                                                                                                                                                           |
+================================+=======================================================================================================================================================================================================================================+
| **Enable**                     | Check **Enable.**                                                                                                                                                                                                                     |
+--------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**                    | Domains is a comma separated list of allowed domains. It limit the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation.   |
+--------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **OAuth 2.0 for email sync**   | Check **Enable.**                                                                                                                                                                                                                     |
+--------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

|

.. image:: ../img/google_integration/oro_google_integration.jpg

|


Using Google Sign-on
--------------------

When a user gets to the login page of an instance for which single
sign-on capability has been enabled, a **Login Using Google** link will
appear.

|

.. image:: ../img/google_integration/login_using_google.jpg

|
 
  

-  If the user is not logged into any Google accounts after the link
   has been clicked, a usual Google log-in page will appear.

-  As soon as the user has logged into their Google account, a request
   to use the account in order to log-in to OroCRM will appear (details
   defined for the consent screen will be used).

|

.. image:: ../img/google_integration/google_connection.jpg

|


For now on, for a user logged-in into a Google account, it is enough to
click the :guilabel:`Login using Google` link to get into OroCRM.

Note that the email used for the Google account and the primary email of
the user in OroCRM must be the same.
