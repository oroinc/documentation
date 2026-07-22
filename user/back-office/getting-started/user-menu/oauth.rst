.. _user-guide-my-profile-oauth:

Add OAuth Applications under My User Menu
-----------------------------------------

.. begin_user_oauth

.. include:: /user/back-office/system/user-management/oauth-app.rst
   :start-after: begin_oauth1
   :end-before: finish_oauth1

Add an Application
^^^^^^^^^^^^^^^^^^

To add a new OAuth application in the back-office:

1. Click on your user name at the top right of the screen.
2. Click **My User**.

   .. image:: /user/img/getting_started/user_menu/oauth/my_user.png
      :alt: Profile menu

3. In the **OAuth Applications** section, click **Add Application** at the top right and provide the following details in the pop-up dialog:

   .. image:: /user/img/getting_started/user_menu/oauth/oauth_tab.png
      :alt: Add an oauth application

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to. This field is displayed to users with access to multiple organizations (available for the Enterprise edition only).
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** checkbox to activate the new application.
   * **Support all APIs** --- Select whether the client should support all available API types. If disabled, the *Supported APIs* filed appears with a list of API types for the user to select the required one.
   * **Supported APIs** --- The field appears when the *Support all APIs* field is disabled. Select the API type that the client should support, for example JSON:API, Email Addon, SCIM, etc.

4. Click **Create**.

A corresponding notification is sent to the user's primary email address, the owner of the oauth application. You can change the default recipient, localization, or an email content if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out of the box in the system configuration.

Once the application is created, you are provided with a Client ID and a Client Secret. Click on the |IcCopy| icon to copy the credentials to the clipboard.

.. image:: /user/img/getting_started/user_menu/oauth/oauth_credentials.png
   :alt: OAuth credentials

.. important:: For security reasons, the Client Secret is displayed only once, immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe to access it later.

You can add as many applications as you need for any of your existing organizations. All added applications are displayed in the grid; you can filter them by name, organization, and status.

.. hint:: Use the |IcMore| **More Options** menu to edit, deactivate or delete an application.

          .. image:: /user/img/getting_started/user_menu/oauth/manage_oauth_application.png
             :alt: Manage auth applications

Use the generated Client ID and Client Secret to retrieve an access token to connect to your Oro application.

.. note::

    * To create an OAuth application under **Customers > Customer Users** in the back-office, see :ref:`Add a Customer User oAuth application <user-guide-add-oauth-to-user>`.
    * To add an OAuth application to a *customer user* directly from their page in the back-office, see :ref:`Add OAuth Applications from Customer User's Page <user-guide--customers--customer-users--oauth>`.
    * To add an OAuth application to a back-office user under **System > User Management > Users**, see :ref:`Add OAuth Applications to a Back-Office User <user-guide-add-oauth-to-user>`.
    * To add an oAuth application under **System > User Management > OAuth Applications**, see :ref:`Configure OAuth Applications for Users in the Back-Office <oauth-applications>`.


.. finish_user_oauth

.. include:: /include/include-links-user.rst
   :start-after: begin


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

