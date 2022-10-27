:oro_documentation_types: OroCRM, OroCommerce

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

.. note:: Please pay attention to the **Authorized Redirect URIs**, the value from the **System > Configuration > Integrations > Google Settings > Google Integration Settings > Redirect URI** must be added in Authorized Redirect URIs configuration.

8. Your client ID is generated.

   .. image:: /user/img/google/id_secret.jpg
      :alt: OAuth client ID and secret

   .. image:: /user/img/google/id_secret_2.jpg
      :alt: A new client ID is added to the list of all IDs


Oro Application Side
--------------------

Configure Google Single Sign-On
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the integration with Google Single Sign-On in your OroCRM or OroCommerce application:

1. Navigate to **System > Configuration > Integrations > Google Settings** in the main menu.
2. Make sure that the information in the **Google Integration Settings** and **OAuth 2.0 for Gmail emails sync** is filled as described in the :ref:`Configure Google Integration Settings <system-configuration-integrations-google>` topic.
3. Define the following fields for **Google Sign-on:**

   * **Enable** --- Check **Enable** to activate Google Single Sign-on.
   * **Domains** --- Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation


.. image:: /user/img/system/config_system/google_integration_new.png
   :alt: Global Google integration settings

Log in with Google
^^^^^^^^^^^^^^^^^^

When a user opens the login page of the instance with the enabled single sign-on capability, the **Login Using Google** link is displayed.

.. image:: /user/img/google/login_using_google.jpg
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
* :ref:`Set Up Voice and Video Calls via Hangouts <user-guide-hangouts>`
* :ref:`Configure Google Tag Manager Integration <gtm-ga-4-integration>`


.. include:: /include/include-links-user.rst
   :start-after: begin
