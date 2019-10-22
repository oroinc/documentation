:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-my-profile-oauth:

Add OAuth Applications
----------------------

.. this topic is included into customer_uses/index

.. begin_1

Oro applications support oAuth 2.0 credentials authorization grant type to enable connection of third-party applications to the web API. To connect a third-party application, you need to add it and configure its pre-generated credentials in the back-office of your Oro application. These credentials are managed on user level which enables generation of different credentials for various applications across multiple organizations.

Starting Conditions
^^^^^^^^^^^^^^^^^^^

To be able to add an OAuth application, make sure that you |generate| private and public encryption keys and add them to the /var directory of the installed Oro application. Although the path to the keys is predefined, you can change it by providing your custom location in the *config.yml* file.

.. note:: If no keys are found, the following warning message will be displayed in the back-office:

          *OAuth authorization is not available as encryption keys configuration was not complete. Please contact your administrator.*

.. Install OAuth extension from Oro Marketplace <link> (3.1).

.. finish_1

Oro Side: Add an Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a new OAuth application in the back-office:

1. Click on your user name on the top right of the screen.
2. Click **My User**.

   .. image:: /user/img/getting_started/user_menu/oauth/my_user.png
      :alt: Profile menu

3. In the **OAuth Applications** section, click **Add Application** on the top right and provide the following details in the pop-up dialog:

   .. image:: /user/img/getting_started/user_menu/oauth/oauth_tab.png
      :alt: Add an oauth application

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to. This field is displayed to users with access to multiple organizations.
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** check box to activate the new application.

4. Click **Create**.

A corresponding notification is sent to the primary email address of the user, the owner of oauth application. You can change the default recipient, localization, or an email content if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out-of-the-box in the system configuration.

.. begin_2

Once the application is created, you are provided with a Client ID and a Client Secret. Click on the |IcCopy| icon to copy the credentials to the clipboard.

.. image:: /user/img/getting_started/user_menu/oauth/oauth_credentials.png
   :alt: OAuth credentials

.. important:: For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe so you can access it later.

You can add as many applications as you need for any of your existing organizations. All added applications are displayed in the grid, and you can filter them by name, organization, and status.

.. hint:: Use the |IcMore| **More Options** menu to edit, deactivate or delete an application.

          .. image:: /user/img/getting_started/user_menu/oauth/manage_oauth_application.png
             :alt: Manage auth applications

Use the generated Client ID and Client Secret to retrieve an access token to connect to your Oro application.

Third Party Side: Generate Token
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure machine-to-machine authentication and retrieve the access token:

1. Provide your **Request URL**.

   The Request URL consists of your application URL and the /oauth2-token slug, e.g., ``https://yourapplication/oauth2-token``.

2. Send a POST request with the following body parameters to the authorization server:

   * `grant_type` with the value `client_credentials`
   * `client_id` with the client’s ID
   * `client_secret` with the client’s secret
   * `scopes` with a space-delimited list of requested scopes permissions

   .. note:: *client_credentials* is currently the only supported grant type.

3. Receive response from the authorization server with a JSON object containing the following properties:

   * `token_type` with the value `Bearer`
   * `expires_in` = 3600 seconds. Once the token is generated, it is valid for an hour and can be used multiple times within this time limit to request the necessary data.
   * `access_token` a JSON web token signed with the authorization server’s private key

4. Use the generated access token to make requests to the API.

   .. note:: Access tokens for backend and frontend API are not interchangeable. If you attempt to request data for the frontend API with a token generated for the backend application (i.e., a back-office user), access will be denied.

.. include:: /include/include-links.rst
   :start-after: begin

.. finish_2

**Related Articles**

* :ref:`Add OAuth Applications to OroCommerce Storefront <user-guide--customers--customer-users--oauth>`


.. include:: /include/include-images.rst
   :start-after: begin

