.. _concept-guide--identity-management:

Identity Management Concept Guide
=================================

.. note:: The integration with identity management systems is only available in the Enterprise edition.

Enterprise organizations usually operate multiple internal and external systems. Imagine a company with over 100 employees working daily with emails, CRM, ERP, internal tools, and various third-party platforms. If each system requires its own credentials, managing access can get overwhelming. People forget passwords, access isn’t removed promptly, and manual processes increase security risk.

**Identity and Access Management (IAM)** systems are designed to remove this complexity. They centralize how users are authenticated, how access is granted, and how it is removed. Instead of managing users separately in every application, companies manage identities once and securely connect all platforms to that central system.

The OroCommerce platform integrates with identity and access management systems such as **Microsoft Entra ID**, **Okta**, and **Google Cloud Identity** to become part of this centralized identity ecosystem. This helps organizations make access management easier, follow security policies, and provide a smooth login experience for both customer and back-office users.


Identity and Access Management Systems and Their Benefits
---------------------------------------------------------

Identity and Access Management Systems, such as Microsoft Entra ID, Okta, and Google Cloud Identity, act as centralized hubs for identity and access management. Their primary purpose is to ensure that the right people have the right level of access to the right systems at the right time.

Without an identity management system, companies often face security chaos:

* Employees manage multiple passwords
* Access remains active after people leave
* IT teams spend significant time handling access requests and password resets.

With an identity system in place, a single login provides access to corporate email, CRM, ERP, and various B2B platforms such as OroCommerce. Passwords are not duplicated across systems, and support requests like "I forgot my password" are significantly reduced.

For OroCommerce, the integration with identity and access management systems brings clear advantages:

* It enables personalization based on user roles and attributes
* Reduces responsibility for password storage
* Simplifies enterprise onboarding
* Supports security policies, compliance, and trust requirements

.. image:: /user/img/concept-guides/identity-management/identity-management-diagram.png
   :alt: Illustrative diagram showing the benefits of the integration with identity management systems

Integration Models Supported by OroCommerce
-------------------------------------------

The Oro application supports IAM integrations through two standard mechanisms: **User Provisioning and Deprovisioning** and **Single Sign-On (SSO)**. These mechanisms are independent and can be combined or used separately, depending on how an organization manages its users.

User Provisioning and Deprovisioning
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroCommerce supports two protocols for user provisioning and deprovisioning: **SCIM** and **LDAP**.

This functionality is available only for back-office users and is not supported for customer users.

SCIM Protocol
~~~~~~~~~~~~~

:ref:`SCIM (System for Cross-domain Identity Management) <admin-configuration-user-settings-scim>` enables automatic import and synchronization of users from an identity management system to the Oro application. In this model, the identity provider controls what happens to users in the system. If a user is created, updated, or removed in the identity provider, the same will automatically happen in the Oro application. The identity provider always decides who can access the application and what their status is.

A typical enterprise scenario looks like this: An admin adds a new employee in Microsoft Entra, Okta, etc., and access to the Oro application appears automatically. When the admin removes the employee, access is revoked everywhere, including the Oro application. This automation eliminates manual user management and ensures that access is always up to date.

SCIM provisioning is especially helpful when the Oro application does not have any users from the identity system yet. It lets organizations add users to the platform quickly and ensures that user accounts always match what is in their identity provider. This means IT keeps full control using their existing systems. In large organizations, automated provisioning is essential for security, not just convenience.

SCIM integration does not restrict manual user management in OroCommerce. Administrators can still create user records directly in the Oro application. However, these manually created users are not synchronized back to the identity management systems.

.. note:: For more details on how to configure the SCIM user provisioning in OroCommerce, read the :ref:`related SCIM user provisioning <admin-configuration-user-settings-scim>` documentation.

          .. image:: /user/img/concept-guides/identity-management/scim-configuration.png
             :alt: Global SCIM user provisioning configuration

LDAP Protocol
~~~~~~~~~~~~~

:ref:`LDAP (Lightweight Directory Access Protocol) <user-guide-ldap-integration>` enables automatic import and synchronization of user information, including role identifiers, from the LDAP directory into the Oro application. This approach is mostly used by organizations that rely on existing directory infrastructure.

Once the LDAP integration is configured, users can log in using their existing LDAP credentials.

The LDAP integration does not restrict manual user management in OroCommerce. Administrators can still create user records directly in the Oro application. However, these manually created users are not synchronized back to the LDAP server. Users imported via LDAP can be identified in the Oro application. Their profiles include an LDAP Distinguished Name, which indicates that the user was created through the LDAP integration.

.. note:: For more details on how to configure the LDAP integration in OroCommerce, read the :ref:`related LDAP <user-guide-ldap-integration>` documentation.

          .. image:: /user/img/system/integrations/ldap/ldap_general.png
             :alt: LDAP integration configuration

Single Sign-On (SSO) Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Oro application supports integration with |OpenID Connect| (OIDC) to enable **Single Sign-On (SSO)** through third-party identity providers such as Okta, Microsoft Entra ID, Google Cloud Identity, and other IAM systems that *support the OpenID Connect standard*.

.. note:: Only the IAM systems that return the **email** field in the ID token are supported. This field is required to map an Oro **User** or **Customer User** to the corresponding external account.

Single Sign-On enables users to access the Oro application with their corporate identity credentials, simplifying the login process across multiple systems, like email, CRM, ERP, and Oro itself. SSO does not automatically create users during login. Instead, it provides a secure way for the users who already exist in the Oro application to sign into the system. This way, authentication is delegated to the identity provider, and the Oro application receives a verified identity instead of handling passwords directly.

Administrators can decide whether to offer SSO alongside traditional login and password authentication or to hide the login form entirely and allow access only through SSO, depending on corporate security requirements.

.. note:: More details on how to configure the user login form are described in the :ref:`Configure Global User Login Settings <admin-configuration-user-login-form>` documentation. Before disabling this option, Oro administrators must make sure that at least one external authentication method is properly set up. Otherwise, they may lose access to the system.

.. image:: /user/img/concept-guides/identity-management/login-form-backoffice.png
   :alt: Back-office login form with the enabled and disabled user login form

OroCommerce supports SSO for both back-office and customer users. It is helpful when the customer organization already relies on a corporate identity provider to authenticate employees across internal systems and requires its employees to access OroCommerce using the same corporate credentials.

.. image:: /user/img/concept-guides/identity-management/login-form-storefront.png
   :alt: Storefront login form with the three identity providers

.. note:: For more details on how to configure the OpenID Connect Integrations in OroCommerce, read the :ref:`related OpenID Connect <user-guide--integrations--openid-connect>` documentation.


Using SSO Without User Provisioning (and Vice Versa)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

SSO and user provisioning (SCIM or LDAP) are not mutually dependent. If users are already configured in the Oro application, importing them again via SCIM or LDAP is unnecessary. In such cases, administrators can configure only SSO, allowing existing users to authenticate through the identity provider without changing how users are managed internally.

Less commonly, user provisioning can be used without SSO. This approach allows users to be synchronized from the identity system while continuing to authenticate using Oro-managed credentials. Although this model is supported, most enterprise customers prefer to combine provisioning with SSO for stronger security and simpler operations.

Combined Integration
^^^^^^^^^^^^^^^^^^^^

The best way to connect systems is to combine user provisioning with SSO authentication. In this setup, the identity management system controls both who exists in the platform and how users sign in.

This combined approach minimizes manual effort, reduces security risks, and ensures that access to the platform is always aligned with the organization’s internal policies.

**Related Articles**

* :ref:`SCIM User Provisioning <admin-configuration-user-settings-scim>`
* :ref:`Configure Okta Provisioning Service <okta-provisioning-service>`
* :ref:`Configure Microsoft Entra Provisioning Service <microsoft-entra-provisioning-service>`
* :ref:`LDAP Integration <user-guide-ldap-integration>`
* :ref:`Configure OpenID Connect Integrations in the Back-Office <user-guide--integrations--openid-connect>`
* :ref:`Configure Global User Login Settings <admin-configuration-user-login-form>`



.. include:: /include/include-links-user.rst
   :start-after: begin
