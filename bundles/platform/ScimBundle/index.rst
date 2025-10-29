.. _bundle-docs-platform-scimbundle:

OroScimBundle
=============

.. note:: This bundle is only available in the Enterprise edition.

OroScimBundle adds support for the **System for Cross-domain Identity Management (SCIM)** protocol in the Oro application. It enables automatic user management between Oro and external identity systems, such as |Microsoft Entra ID| (formerly Azure Active Directory), via SCIM API by SCIM extension. This integration allows imported users to sign in to Oro via :ref:`Microsoft 365 Single Sign-On <user-guide-integrations-microsoft-single-sign-on>`.

SCIM 2.0 (|RFC 7642|, |RFC 7643|, |RFC 7644|) is a standard protocol designed to simplify account management - creating, updating, and deleting user accounts across multiple applications from one centralized identity management system. This means that users can be automatically *provisioned* (created), updated, or *deprovisioned* (deleted) in Oro whenever changes are made in your connected identity provider.

**Supported Operations**

* **User synchronization** – Oro currently supports syncing user information between systems.
* **Group synchronization** – Not supported at this time.

**API Endpoints:**

* For standard installations, you can access the SCIM API at the ``https://yourapplication/scim/Users`` URL.

* For OroCommerce installations, the API is available at the ``https://yourapplication/{backend_prefix}/scim/Users`` URL, where {backend_prefix} is your current back-office prefix (by default, it is ``admin``).

**API Sandbox:**

* For standard installations, you can access the SCIM API sandbox at the ``https://yourapplication/api/doc/scim_rest`` URL.

* For OroCommerce installations, the API sandbox is available at the ``https://yourapplication/{backend_prefix}/api/doc/scim_rest`` URL, where {backend_prefix} is your current back-office prefix (by default, it is ``admin``).


**SCIM Synchronization Configuration**

For more details on how to configure the SCIM synchronization in the back-office, follow the steps described in the :ref:`related documentation <admin-configuration-user-settings-scim>`.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
