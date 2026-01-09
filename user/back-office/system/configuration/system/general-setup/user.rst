.. _admin-configuration-user-settings:

Configure Global User Settings
==============================

.. note:: You can configure user settings globally or :ref:`per specific organization <admin-configuration-user-settings-org>`.

To apply user-related settings, such as enabling sharing records or user provisioning, in your Oro application instance:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > General Setup > User Settings**.

   .. image:: /user/img/system/config_system/user.png
      :alt: User settings on global level

Email Settings
--------------

Under **Email Settings**, configure the following:

* **Case-Insensitive Email Addresses** --- If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled. Please note that the setting only applies to back-office users. The identical option for customer users is managed :ref:`here <sys-config--configuration--commerce--customers--customer-users>`.

.. _admin-configuration-user-settings-share:

Sharing Records
---------------

.. note:: Sharing Records is only available in the Enterprise edition.

Under **Sharing Records**, activate or deactivate the ability to share entity records:

* **Allow Sharing** --- If this option is enabled, users are allowed to share entities in the Oro application back-office.

.. _admin-configuration-user-settings-scim:

User Provisioning
-----------------

.. note:: The SCIM synchronization is available as of OroCommerce Enterprise version 6.0.8.

Under **User Provisioning**, configure the SCIM (System for Cross-domain Identity Management) protocol in the Oro application. This setup allows you to import and synchronize users from external identity systems, such as Microsoft Entra ID or Okta, into Oro. Once imported, these users can log in to Oro via Microsoft 365 Single Sign-On or Okta Single Sign-On.

Enable SCIM Synchronization
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable and control SCIM synchronization, set the following options:

* **Enable SCIM** --- Enable or disable the SCIM integration on the global level.
* **Default Access to Organization Business Units** --- Select the organizations and business units that will be automatically assigned to newly synchronized users.
* **Default Roles** --- Select the user roles that new users will receive upon synchronization.
* **Extra Fields Handling** --- Choose how the system should handle cases when the identity provider sends extra fields. The available options are:

    * **Return error** (default) --- If selected, and the identity provider sends extra fields to Oro, the system will return an error.
    * **Ignore extra fields** --- If selected, and the identity provider sends extra fields to Oro, the system will ignore these fields.
* **Empty Name Values Handling** --- Choose how the system should handle cases when the identity provider does not send first or last name values. The available options are:

    * **Leave as is and expect validation errors** --- If selected, and the identity provider sends no first or last name to Oro, the system will return an error without generating any replacement values.
    * **Generate based on user name** (default) --- If selected, the first and last name values will be copied from the username field.
    * **Use random string** --- If selected, the first and last name values will be automatically generated as random strings.

.. _okta-provisioning-service:

Configure Okta Provisioning Service
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**OroCommerce side**

To configure the user provisioning via |Okta provisioning service|, make sure you have:

1. Configured the SCIM synchronization globally or :ref:`per required organization <admin-configuration-user-settings-org>`.

    .. important:: At least one organization business unit and user role should be configured in order to allow login of imported users.

2. Created Authorization Code OAuth application as described in the :ref:`Create an OAuth Application <oauth-applications>` topic.

    .. note:: The redirect URL you can see in |Okta SCIM API - authentication| in the Okta SCIM API documentation. Add a fake URL if you have not yet created an Okta application. The correct URL can be set later.

3. Copied Client ID and Client secret. For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you leave a page with the created application information, so make sure you save it somewhere safe so you can access it later.

4. Created the Okta OpenID Connect integration under System > Manage Integrations as described in the :ref:`Configure OpenID Connect Integrations in the Back-Office <user-guide--integrations--openid-connect>` topic.

**Okta side**

1. Log in to your Okta Admin Console.

2. Navigate to **Applications > Applications**.

3. Click **Create App Integration**.

4. Choose **SAML 2.0** sign-in method and click **Next**.

5. Provide a name and a logo for the new application and click **Next**.

6. Fill in the form with the following data and click **Next**:

    * **Single sign-on URL**: ``https://yourapplication``
    * **Audience URI (SP Entity ID)**: ``https://yourapplication``

7. Specify options that will help Okta Support understand how you configured this application and click **Finish**.

    .. note:: As the Okta application has been successfully created, you can now add the redirect URL to the OroCommerce OAuth application.

8. On the application management page, navigate to the **General** tab and click **Edit** in **App Settings**.

9. Choose **SCIM** provisioning method and click **Save**.

10. Navigate to the **Provisioning** tab and click **Edit** in **SCIM Connection**.

11. Fill in the form with the following data and click **Save**:

    * **SCIM connector base URL**: ``https://yourapplication/{backend_prefix}/scim``
    * **Unique identifier field for users**: ``userName``
    * **Supported provisioning actions**: ``Push New Users`` and ``Push Profile Updates``
    * **Authentication Mode**: ``OAuth 2``
    * **Access token endpoint URI**: ``https://yourapplication/oauth2-token``
    * **Authorization endpoint URI**: ``https://yourapplication/{backend_prefix}/oauth2-token/authorize``
    * **Client ID**: The Client ID value of the OAuth 2 application
    * **Client Secret**: The client secret of the OAuth 2 application

12. Click **Authorize with {your application}** and grant access to your application to Okta.

13. Navigate to the **Provisioning** tab, click **To App** in the left menu and click **Edit** in **Provisioning to App**.

14. Fill in the form with the following data and click **Save**:

    * **Create Users**: Enable
    * **Update User Attributes**: Enable
    * **Deactivate Users**: Enable

15. Navigate to the **Provisioning** tab and click **To App** in the left menu and configure user mapping with the following attributes:

    +------------------+----------------+----------------------------------------------------------------------+
    | Attribute        | Attribute Type | Value                                                                |
    +==================+================+======================================================================+
    | userName         | Personal       |                                                                      |
    +------------------+----------------+----------------------------------------------------------------------+
    | givenName        | Personal       | user.firstName                                                       |
    +------------------+----------------+----------------------------------------------------------------------+
    | familyName       | Personal       | user.lastName                                                        |
    +------------------+----------------+----------------------------------------------------------------------+
    | middleName       | Personal       | user.middleName                                                      |
    +------------------+----------------+----------------------------------------------------------------------+
    | honorificPrefix  | Personal       | user.honorificPrefix                                                 |
    +------------------+----------------+----------------------------------------------------------------------+
    | honorificSuffix  | Personal       | user.firstName                                                       |
    +------------------+----------------+----------------------------------------------------------------------+
    | email            | Personal       | user.email                                                           |
    +------------------+----------------+----------------------------------------------------------------------+
    | emailType        | Personal       | (user.email != null && user.email != '') ? 'work' : ''               |
    +------------------+----------------+----------------------------------------------------------------------+
    | title            | Personal       | user.title                                                           |
    +------------------+----------------+----------------------------------------------------------------------+
    | primaryPhone     | Personal       | user.primaryPhone                                                    |
    +------------------+----------------+----------------------------------------------------------------------+
    | primaryPhoneType | Personal       | (user.primaryPhone != null && user.primaryPhone != '') ? 'work' : '' |
    +------------------+----------------+----------------------------------------------------------------------+

16. Navigate to the **Assignments** tab and configure the user to be provisioned.

.. important:: The next step is to configure the :ref:`Okta OpenID Connect <user-guide--integrations--openid-connect>` integration under **System > Manage Integrations** menu in the back-office to enable synced users to log in via OIDC SSO.

.. _microsoft-entra-provisioning-service:

Configure Microsoft Entra Provisioning Service
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**OroCommerce side**

To configure the user provisioning via |Microsoft Entra provisioning service|, make sure you have:

1. Configured the SCIM synchronization globally or :ref:`per required organization <admin-configuration-user-settings-org>`.

    .. important:: At least one organization business unit and user role should be configured in order to allow login of imported users.

2. Created Client Credentials OAuth application as described in the :ref:`Create an OAuth Application <oauth-applications>` topic.

3. Copied Client ID and Client secret. For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you leave a page with the created application information, so make sure you save it somewhere safe so you can access it later.

    .. image:: /user/img/system/user_management/oauth/client_creds_app.png

4. Created the Microsoft OpenID Connect integration under System > Manage Integrations as described in the :ref:`Configure OpenID Connect Integrations in the Back-Office <user-guide--integrations--openid-connect>` topic.

**Microsoft Entra side**

1. Log in to the |Microsoft Entra admin center| with an account that has at least |Application Administrator| permissions.

2. Navigate to **Entra ID > Enterprise apps**.

3. Click **+New application > +Create your own application**.

4. Provide a name for the new app, select the **Integrate any other application you don’t find in the gallery** option, and then click **Add** to create an application object. The newly created app will appear in the list of enterprise applications and will open its management page.

.. image:: /user/img/system/config_system/ms_app_create.png

5. On the application management page, navigate to **Provisioning** in the menu to the left.

6. Click **+New configuration**.

7. Fill in the form with the following data:

    * **Select authentication method**: OAuth2 client credentials grant
    * **Tenant URL**: the SCIM endpoint URL of your application, for example: ``https://yourapplication/scim/``, or ``https://yourapplication/{backend_prefix}/scim/`` if Commerce application is installed.
    * **Token endpoint**: ``https://yourapplication/oauth2-token``
    * **Client identifier**: The Client ID value of the OAuth 2 application
    * **Client Secret**: The client secret of the OAuth 2 application

    .. image:: /user/img/system/config_system/ms_provisioning_config.png

8. Click **Test Connection** to verify that Microsoft Entra ID can successfully connect to the SCIM endpoint. If the connection fails, an error message with details will appear.

9. If the connection is successful, click **Create** to set up the provisioning job.

10. To synchronize only specific users or groups (recommended), open the **Users and groups** tab and assign the users or groups you want to include in the synchronization.

11. In the left menu, go to **Attribute mapping**. You will see two mapping configurations — one for users and one for groups.

    * Disable group synchronization by turning off the **Provision Microsoft Entra ID Groups** mapping
    * Configure **Provision Microsoft Entra ID Users** with the following mapping settings:

    +------------------------------------+-------------------------------------------------------------+---------------------+
    | customappsso Attribute             | Microsoft Entra ID Attribute                                | Matching precedence |
    +====================================+=============================================================+=====================+
    | userName                           | userPrincipalName                                           | 1                   |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | active                             | Switch([IsSoftDeleted], , "False", "True", "True", "False") |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | title                              | jobTitle                                                    |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | emails[type eq "work"].value       | mail                                                        |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | name.givenName                     | givenName                                                   |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | name.familyName                    | surname                                                     |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+
    | phoneNumbers[type eq "work"].value | telephoneNumber                                             |                     |
    +------------------------------------+-------------------------------------------------------------+---------------------+

    .. image:: /user/img/system/config_system/ms_mapping.png

    * Click Save to apply any changes.

12. Then, navigate to **Provision on-demand** in the left menu. Search for a user within the provisioning scope and trigger manual provisioning. Repeat this process with other users to test synchronization.

13. Once the setup is finished, open **Overview** in the left menu.

14. Select **Properties**, then click the pencil icon to edit them. Enable notification emails, enter the address to receive quarantine alerts, and turn on accidental deletion prevention. Click **Apply** to save your updates.

15. Select **Start provisioning** to launch the Microsoft Entra provisioning service.

After the initial provisioning cycle begins, go to **Provisioning logs** in the left menu to track its progress. This section displays all the actions performed by the provisioning service for your application.

.. important:: The next step is to configure the :ref:`Microsoft OpenID Connect <user-guide--integrations--openid-connect>` integration under **System > Manage Integrations** menu in the back-office to enable synced users to log in via OIDC SSO.



.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
