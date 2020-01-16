.. _oauth-applications:

OAuth Applications
------------------

 The section contains the list of all OAuth applications created for users in the back-office. You can view and manage the existing OAuth applications, create new applications selecting the necessary grant type depending on your business needs, either client credentials or a password.

   .. image:: /user/img/system/user_management/oauth/oauth_app_list.png
      :alt: A list of all existing oauth applications

Overview
^^^^^^^^

.. begin_oauth1

Oro applications support oAuth 2.0 credentials authorization grant type to enable connection of third-party applications to the web API. To connect a third-party application, you need to add it and configure its pre-generated credentials in the back-office of your Oro application. These credentials are managed on user level which enables generation of different credentials for various applications across multiple organizations.

Starting Conditions
^^^^^^^^^^^^^^^^^^^

To be able to create an OAuth application, make sure that you generate private and public encryption keys and add them to the /var directory of the installed Oro application. Although the path to the keys is predefined, you can change it by providing your custom location in the *config.yml* file.

.. note:: If no keys are found, the following warning message will be displayed in the back-office:

          *OAuth authorization is not available as encryption keys configuration was not complete. Please contact your administrator.*

.. Install OAuth extension from Oro Marketplace <link> (3.1).

.. finish_oauth1

Create an Application
^^^^^^^^^^^^^^^^^^^^^

To create a new OAuth application in the back-office:

1. Navigate to |path| in the main menu.
2. Click **Create OAuth Application** on the top right of the screen.
3. Provide the following details on the page that opens:

    |image_app_create|

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to. This field is displayed to users with access to multiple organizations.
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** check box to activate the new application.
   * **Grants** --- Select the grant type to apply to the new application. Currently, the available grant types are *Client Credentials* and *Password*. The |OAuth Client Credentials Grant| type is used for machine-to-machine authentication (e.g., in a cron job that performs maintenance tasks over an API) and |OAuth Password Grant| is used by trusted first-party clients to exchange the credentials (username and password) for an access token.
   * **Users** --- The field appears when selecting *Client Credentials* as a grant type in the previous field. Select a customer user who you want to assign the new application to.

4. Click **Create**.

A corresponding notification is sent to the primary email address of the user, the owner of oauth application. You can change the default recipient, localization, or an email content if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out-of-the-box in the system configuration.

Once the application is created, you are provided with a Client ID and a Client Secret. Click on the |IcCopy| icon to copy the credentials to the clipboard.

 |image_credentials|

.. important:: For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe so you can access it later.

You can create as many applications as you need for any of your existing organizations. All added applications are displayed in the grid, and you can filter them by name, organization, and status.

.. hint:: Use the |IcMore| **More Options** menu to view, edit, delete, activate or deactivate the existing OAuth applications.

          |image_app_actions|

Use the generated Client ID and Client Secret to retrieve an access token to connect to your Oro application.

.. finish_oauth2

.. note:: For the details on how to add an OAuth application to a selected customer user in the back-office, refer to the :ref:`Add OAuth applications to your profile <user-guide-my-profile-oauth>` and :ref:`Add OAuth applications to a selected user <user-guide-add-oauth-to-user>` topics.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. |path| replace:: **System > User Management > OAuth Applications**

.. |image_app_create| image:: /user/img/system/user_management/oauth/oauth_app_create.png

.. |image_credentials| image:: /user/img/getting_started/user_menu/oauth/oauth_credentials1.png

.. |image_app_actions| image:: /user/img/system/user_management/oauth/oauth_app_actions.png
