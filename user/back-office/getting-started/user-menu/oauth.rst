:oro_documentation_types: crm, commerce

.. _user-guide-my-profile-oauth:

Add OAuth Applications
----------------------

.. begin_user_oauth

.. include:: /user/back-office/system/user-management/oauth-app.rst
   :start-after: begin_oauth1
   :end-before: finish_oauth1

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

.. include:: /user/back-office/system/user-management/oauth-app.rst
   :start-after: begin_oauth2
   :end-before: finish_oauth2

.. note:: For the aggregated information on all OAuth applications created by users in the back-office, refer to the general :ref:`OAuth Applications <oauth-applications>` topic.

.. finish_user_oauth

.. include:: /include/include-links.rst
   :start-after: begin


.. include:: /include/include-images.rst
   :start-after: begin

