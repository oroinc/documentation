:title: OroHeadlessApplicationBundle for External Applications That Use the Oro API

.. meta::
   :description: Developer documentation for OroHeadlessApplicationBundle that registers external applications, such as
                 headless storefronts, and manages an OAuth2 client for each of them

.. _bundle-docs-platform-headless-application-bundle:

OroHeadlessApplicationBundle
============================

.. important:: OroHeadlessApplicationBundle is available in the Enterprise edition only.

OroHeadlessApplicationBundle is a bundle that registers external applications that work with the API of an Oro
application. A headless storefront is an example of such an application. Each registered application is a headless
application. Each headless application has its own OAuth2 client, and the bundle creates and manages this client.

The bundle is part of the ``oro/headless`` package. It uses
:ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>` for the OAuth2 clients.

The bundle adds a back-office page to manage headless applications. The bundle does not include an application type
of its own. Other bundles register the types and add fields, page blocks, and system configuration settings for them.
For example, :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>` adds the
``general_storefront`` type for an external storefront. It also restricts the storefront requests of an application
to its website and adapts the OroCommerce checkout for Session Transfer. For a step-by-step example of a new storefront
type, see
:ref:`Create a New Headless Application Type <bundle-docs-commerce-headless-storefront-bundle--application-type>`.

:ref:`OroStorefrontEmbeddedBundle <bundle-docs-commerce-storefront-embedded-bundle>` does not depend on headless
applications. It shows OroCommerce storefront pages in an external application, for example, in a browser session that
a headless application opens through
:ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`.

Data Model
----------

The ``Oro\Bundle\HeadlessApplicationBundle\Entity\HeadlessApplication`` entity stores a headless application in the
``oro_headless_application`` table. The entity is extendable and is owned by an organization. It has the following
fields:

* ``name`` --- The name of the application. It is unique within the organization.
* ``type`` --- The name of the application type.
* ``oAuth2Client`` --- A one-to-one relation to an ``Oro\Bundle\OAuth2ServerBundle\Entity\Client`` entity.

Deleting the application deletes its OAuth2 client, and deleting the client deletes the application.

.. _bundle-docs-platform-headless-application-bundle--oauth2-client:

OAuth2 Client
-------------

On the first save of an application, the bundle sets up its OAuth2 client:

* The client gets the name and the organization of the application.
* The client uses only the Authorization Code grant.
* The client is a storefront or a back-office client, as the application type selects. For details, see
  :ref:`Register an Application Type <bundle-docs-platform-headless-application-bundle--extend--application-type>`.
* OroOAuth2ServerBundle generates the client ID and the client secret.

On later saves, the bundle copies only the new application name to the client.

The OAuth2 client of a headless application is managed only through the application. For this reason, the bundle
denies the ``EDIT`` and ``DELETE`` permissions for this client. On the ``oro_oauth2_view`` and
``oro_oauth2_frontend_view`` routes of such a client, the bundle adds a warning flash message.

Feature Toggle
--------------

The ``headless_applications`` feature covers the following resources of the bundle:

* Routes --- ``oro_headless_application_index``, ``oro_headless_application_view``,
  ``oro_headless_application_create``, and ``oro_headless_application_update``
* Datagrid --- ``oro-headless-application-grid``
* Entity --- ``Oro\Bundle\HeadlessApplicationBundle\Entity\HeadlessApplication``
* Navigation item --- ``application_menu.system_tab.integrations_submenu.oro_headless_applications``

The ``oro_headless_application.feature.voter.headless_application_types`` feature voter disables the feature while no
application type is registered. As a result, these resources are not available until another bundle registers a type.
For more information, see :ref:`OroFeatureToggleBundle <bundle-docs-platform-feature-toggle-bundle>`.

Related Documentation
---------------------

* :ref:`Add and Customize Headless Application Types <bundle-docs-platform-headless-application-bundle--extend>`
* :ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>`
* :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`
* :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>`

.. toctree::
   :hidden:

   extend

.. include:: /include/include-links-dev.rst
   :start-after: begin
