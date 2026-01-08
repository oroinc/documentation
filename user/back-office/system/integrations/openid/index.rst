.. _user-guide--integrations--openid-connect:

Configure OpenID Connect Integrations in the Back-Office
========================================================

.. note:: This feature is available as of OroCommerce Enterprise version 6.1.7.

The Oro application supports integration with |OpenID Connect| (OIDC) to enable **Single Sign-On (SSO)** through third-party identity providers such as **Okta, Microsoft Entra ID, Google**, and other systems that support the OpenID Connect standard.

Using OpenID Connect allows users to authenticate once with a trusted identity provider and then securely access Oro without entering a separate username and password.

.. note:: Only the systems that return the **email** field in the ID token are supported. This field is required to map an Oro **User** or **Customer User** to the corresponding external account.

OpenID Integration Types
------------------------

Oro provides 4 types of OpenID Connect integration to simplify configuration for common identity providers.

The following integration types are available:

.. image:: /user/img/system/integrations/openid/oidc-integration-types.png
   :alt: The 4 OIDC integration types available in the Oro application

1. **OpenID Connect** - A generic configuration for any third-party system that supports OpenID Connect SSO and returns the email field in the ID token.
2. **Google OpenID Connect** - A simplified configuration for Google identity providers.
3. **Microsoft OpenID Connect** - A simplified configuration for Microsoft Entra ID. For this integration to work properly for the **back-office users**, enable :ref:`SCIM Synchronization <admin-configuration-user-settings-scim>` under **System > Configuration > General Setup > User Settings** and configure :ref:`Microsoft Entra Provisioning Service <microsoft-entra-provisioning-service>`.
4. **Okta OpenID Connect** - A simplified configuration for Okta. For this integration to work properly, enable :ref:`SCIM Synchronization <admin-configuration-user-settings-scim>` under **System > Configuration > General Setup > User Settings** and configure :ref:`Okta Provisioning Service <okta-provisioning-service>`.


Create OpenID Integration
-------------------------

To create an integration with **OpenID Connect**, **Google OpenID Connect**, **Microsoft OpenID Connect**, or **Okta OpenID Connect**:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** on the top right and provide the required information.

The configuration options described below represent the full set of settings available for the generic OpenID Connect integration type.

If you select one of the provider-specific integrations (**OpenID Connect**, **Google OpenID Connect**, **Microsoft OpenID Connect**, or **Okta OpenID Connect**), the configuration may differ. Some fields are preconfigured or hidden, as they are automatically derived from the selected provider’s requirements. This simplifies setup and reduces the number of parameters that must be entered manually.

.. image:: /user/img/system/integrations/openid/oidc-integration-fields.png
   :alt: The full set of settings available for the generic OpenID Connect integration type

* **Name** - The integration name displayed in the Integrations grid.
* **Apply to** - Available only when the *Customer bundle* is installed. The field allows to select the user type this integration will be used for:
    * **User** — The login button is displayed on the back-office login page.
    * **Customer User** — The login button is displayed on the storefront login page.

* **Label** - The label displayed on the SSO login button.
* **Button Background Color** - The background color of the SSO login button. If no color is specified, the default system background color is used.
* **Button Icon** - The icon displayed on the login button in the back-office. The icon is shown only when *User* is selected in the *Apply to* field.
* **Client ID** - The Client ID of the OAuth 2.0 application configured in the third-party identity provider.
* **Client Secret** - The Client Secret of the OAuth 2.0 application configured in the third-party identity provider.
* **Authorization URL** - The URL used to request an authorization code. The field is displayed only for the generic **OpenID Connect** type.
* **Access Token URL** - The URL used to get an access token and an ID token. The field is displayed only for the generic **OpenID Connect** type.
* **Use PKCE** - When enabled, the queries to 3rd party system will be protected with the PKCE (Proof Key for Code Exchange) data. The field is displayed only for the generic **OpenID Connect** type.
* **Domains** - A comma-separated list of email domains allowed to use **OIDC SSO** (e.g., domains associated with your company). It limits SSO access to users with email addresses matching these domains. Leave the field empty to allow any domain.
* **Disable Non-SSO Login for Listed Domains** - When enabled, users with email addresses matching the domains specified in the *Domains* field will be required to sign in using **OIDC SSO only**. Username and password login will be restricted for these users.
* **Redirect URL** - **READ-ONLY** field, the value is auto-generated and should be added to the 3rd party OAuth 2 application configuration.
* **Status** - The status of the OIDC SSO integration. If set to *Inactive*, users will not be able to log in using this OIDC SSO integration.

Additional fields are available for provider-specific integrations:

* **Directory (tenant) ID** - The tenant ID value from the 3rd party OAuth 2 application configuration. Available only for the **Microsoft OpenID Connect** integration type.
* **Okta instance domain** - The domain name of the Okta instance. Available only for the **Okta OpenID Connect** integration type.

**Related Articles**

* :ref:`Configure User Provisioning and SCIM Synchronization <admin-configuration-user-settings-scim>`
* :ref:`Configure Okta Provisioning Service <okta-provisioning-service>`
* :ref:`Configure Microsoft Entra Provisioning Service <microsoft-entra-provisioning-service>`
* :ref:`OroOidcBundle Developer Documentation <bundle-docs-platform-oidcbundle>`


.. include:: /include/include-links-user.rst
   :start-after: begin
