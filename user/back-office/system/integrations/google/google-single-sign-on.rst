:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-google-single-sign-on:

Configure Google Single Sign-On in the Back-Office
==================================================

Oro application supports Google Single Sign-On. This means that for
a user that has the same primary email in the Oro application and Google
accounts, it is enough to log-in only once during a session.

Google Side
-----------

Create Project
^^^^^^^^^^^^^^

To configure single sign-on on the Google side:

1. Open |Google API Console|
2. Navigate to **My Project** selector in the top left corner and click **Create Project**.

   .. image:: /user/img/google/create_project.png
      :alt: Create a project in the Google API console

3. Define the **Project Name** and click **Create**.

   .. image:: /user/img/google/new_project.jpg
      :alt: A new project page

Create Credentials
^^^^^^^^^^^^^^^^^^

1. Click **Credentials** in the menu on the left and open the **Credentials** tab.

   .. image:: /user/img/google/create_credentials.jpg
      :alt: The Credentials tab details

2. Click **Create Credentials** and select **0Auth client ID.**

   .. image:: /user/img/google/create_credentials_2.jpg
      :alt: A list of available credential options

3. To create an OAuth client ID, first set a product name on the consent screen.

Configure Consent Form
^^^^^^^^^^^^^^^^^^^^^^

1. Click **Configure Consent Screen**.

   .. image:: /user/img/google/consent_form.jpg
      :alt: Settings under the Credentials menu

2. Complete the form by providing the following details:

  -  Your email address
  -  Project name
  -  Homepage URL
  -  Product logo
  -  Private Policy URL
  -  Terms of Service URL

  .. image:: /user/img/google/complete_form.jpg
     :alt: The details you need to provide to configure the consent form

3. Click **Save** to launch the **Create Client ID** page.
4. Set the **Application Type** to **Web Application**.
5. For **Authorized JavaScript Origins**, enter the URL of the Oro application instance for which single sign-on is being enabled.
6. **Authorized Redirect URIs** are unified resource names used for the interaction between Google and the Oro application instance. It is recommended to add the following two values:

   * [Oro application instance URL]/admin/login/check-google
   * [Oro application instance URL]/index.php/admin/login/check-google

7. Click **Create Client ID**.

   .. image:: /user/img/google/create_id.jpg
      :alt: The Create Client ID page

8. Your client ID is generated.

   .. image:: /user/img/google/id_secret.jpg
      :alt: OAuth client ID and secret

   .. image:: /user/img/google/id_secret_2.jpg
      :alt: A new client ID is added to the list of all IDs


Oro Application Side
--------------------

Configure Google Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the integration with Google in your OroCRM or OroCommerce application:

1. Navigate to **System > Configuration** in the main menu.
2. In the left panel, click **Integrations > Google Settings**.
3. Define the following fields for **Google Integration Settings**:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30
     
   "**Client ID** ","The Client ID generated in the API console."
   "**Client Secret**","The Client Secret generated in the API console."
   "**Google API Key** ","The API Key generated in the API console. Provide a valid |Google API key| to activate maps for addresses in the system."

4. Define the following fields for **Google Sign-on:**

+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**                    | Description                                                                                                                                                                                                                          |
+==============================+======================================================================================================================================================================================================================================+
| **Enable**                   | Check **Enable.**                                                                                                                                                                                                                    |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**                  | Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation. |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **OAuth 2.0 for email sync** | Check **Enable.**                                                                                                                                                                                                                    |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user/img/google/oro_google_integration_new.png
   :alt: Global Google integration settings

Log in with Google
^^^^^^^^^^^^^^^^^^

When a user gets to the login page of an instance for which single sign-on capability has been enabled, the **Login Using Google** link  is displayed.

.. image:: /user/img/google/login_using_google.jpg
   :alt: The login page with the link to log in via google

If the user is not logged into any Google accounts after the link has been clicked, a usual Google log-in page will appear.

As soon as the user has logged into their Google account, a request to use the account in order to log-in to Oro application is displayed  (details defined for the consent screen is used).

.. image:: /user/img/google/google_connection.jpg
   :alt: Google account page

For now on, for a user logged-in into a Google account, it is enough to
click the **Login using Google** link to get into Oro application.

.. note:: Note that the email used for the Google account and the primary email of the user in Oro application must be the same.


.. include:: /include/include-links-user.rst
   :start-after: begin