:title: OroHeadlessStorefrontBundle for External Storefronts That Use the OroCommerce API

.. meta::
   :description: Developer documentation for OroHeadlessStorefrontBundle that connects an external storefront to an
                 OroCommerce website and opens the OroCommerce checkout for its customer users

.. _bundle-docs-commerce-headless-storefront-bundle:

OroHeadlessStorefrontBundle
===========================

.. important:: OroHeadlessStorefrontBundle is available in the Enterprise edition only.

OroHeadlessStorefrontBundle is a bundle that adds the ``general_storefront`` headless application type to OroCommerce.

A headless application is a record that represents a headless storefront. A headless storefront is a storefront application that runs separately from OroCommerce and communicates with OroCommerce through the storefront API.

The headless storefront can also open OroCommerce pages, such as the checkout, in a browser session that it creates through :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`. The bundle is part of the ``oro/headless-storefront`` package and extends :ref:`OroHeadlessApplicationBundle <bundle-docs-platform-headless-application-bundle>`.

:ref:`OroStorefrontEmbeddedBundle <bundle-docs-commerce-storefront-embedded-bundle>` belongs to the same package. It shows OroCommerce account pages in an external application and does not depend on OroHeadlessStorefrontBundle.

For a ``general_storefront`` application, the bundle does the following:

* Adds the website, URL, logo, and contact request form fields to the form and to the view and edit pages.
* Stores system configuration settings for the website of the application.
* Shows the URLs and the logo of the application on the OroCommerce checkout opened through
  :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`.

Other application types can reuse these parts. For more information, see
:ref:`Reuse and Customize the General Storefront Features <bundle-docs-commerce-headless-storefront-bundle--extend>`.

The following parts apply to applications of all types:

* The website restriction of storefront requests.
* The processing of the contact request form when an application is saved.
* The checkout layout in Session Transfer mode. It also applies to Session Transfer sessions without a headless application.

General Storefront Type
-----------------------

The ``Oro\Bundle\HeadlessStorefrontBundle\HeadlessApplication\Type\GeneralStorefrontHeadlessApplicationType`` class
defines the ``general_storefront`` type. This type is a storefront type. As a result, each application of this type gets a storefront OAuth2 client. The ``oro_headless_storefront.general_storefront.application_type`` parameter contains the type name.

On installation, or on the first application update after the bundle is added, the ``EnableStorefrontApi`` data
fixture enables the storefront API. The fixture sets the ``oro_frontend.web_api`` system configuration setting to
``true`` at the global level. An organization-level or website-level value takes precedence. For more information, see
:ref:`Enabling an API Feature <web-services-api--enabling-api-feature>`.

Data Model
----------

The bundle adds extend fields to the ``HeadlessApplication`` entity. The fields exist for applications of all types.
The bundle adds the following fields:

* ``website`` --- An optional relation to a website. It is set to ``null`` when the website is deleted.
* ``applicationUrl``, ``checkoutReturnUrl``, ``orderViewUrl`` --- Strings of up to 2,048 characters.
* ``logo``, ``smallLogo`` --- GIF, JPEG, PNG, WebP, or SVG images of up to 1 MB.
* ``contactRequestForm`` --- A relation to an embedded form. The form is deleted together with the application.

The form and the view and edit pages show these fields only for the ``general_storefront`` type. The ``website``
field is added to the ``general`` block. The other fields are added to the ``application_urls``,
``application_logo``, and ``contact_request_form`` blocks. The ``applicationUrl`` field is required in the form.

System Configuration Settings
-----------------------------

A ``general_storefront`` application shows and saves the following system configuration settings:

* ``oro_customer.non_authenticated_visitors_api``
* ``oro_shopping_list.availability_for_guests``
* ``oro_checkout.guest_checkout``

The application shows and saves these settings with the ``website`` start scope. OroCommerce stores the values for the
website of the application. If the application has no website, OroCommerce stores the values for the organization of
the application.

For how the values are resolved and shared, see :ref:`Scope Resolution <bundle-docs-platform-headless-application-bundle--extend--scope-resolution>` and :ref:`Shared Values <bundle-docs-platform-headless-application-bundle--extend--shared-values>`. To change the list of settings, see :ref:`Change the Bundle Parameters <bundle-docs-commerce-headless-storefront-bundle--extend--parameters>`.

.. _bundle-docs-commerce-headless-storefront-bundle--contact-request-form:

Contact Request Form
--------------------

The contact request form is an embedded form of
:ref:`OroEmbeddedFormBundle <bundle-docs-platform-embedded-form-bundle>`. The external storefront shows it with the
embed code of this embedded form. The contact request form is not related to OroStorefrontEmbeddedBundle.

The contact request form requires OroContactUsBundle. Without OroContactUsBundle, the bundle does not register the
contact request form services. The form extension of the ``contact_request_form`` block adds the unmapped
``enableContactRequestForm`` checkbox field to the application form.

Before an application is saved, the
``oro_headless_storefront.event_listener.contact_request_aware_headless_application_form_handler`` listener processes
every application form that has the ``enableContactRequestForm`` field, regardless of the application type:

* If the field is ``true``, the listener creates the embedded form when the application has none. The created form
  uses the ``GeneralStorefrontContactRequestType`` form type for applications of all types. On every save, the
  listener sets the title of the embedded form to the application name. It also sets the allowed domains to the host
  of ``applicationUrl``, with the port only when it is not the default port of the scheme.
* If the field is ``false``, the listener deletes the embedded form.

The application manages its embedded form. For this reason, the bundle protects the form in the following ways:

* It denies the ``DELETE`` permission on the form.
* It hides the ``delete`` action of the form in the ``embedded-forms-grid`` datagrid.
* It disables the ``title``, ``formType``, and ``allowedDomains`` fields of the embedded form.
* It adds a warning flash message on the ``oro_embedded_form_view`` route of the form.

.. _bundle-docs-commerce-headless-storefront-bundle--website-restriction:

Website Restriction
-------------------

The ``oro_headless_storefront.event_listener.headless_application_website_access_request`` listener checks the
storefront page and storefront API requests that the OAuth2 client of a headless application authenticates. For how
the current application is detected, see
:ref:`Get the Current Headless Application <bundle-docs-platform-headless-application-bundle--extend--current-application>`.

If the application has a website and the current website is another website, the listener denies the request with the
``403 Forbidden`` status code. An application without a website has access to all websites. The check applies to
applications of all types. Back-office requests are not checked.

.. _bundle-docs-commerce-headless-storefront-bundle--checkout:

Checkout in Session Transfer Mode
---------------------------------

To open the checkout, the external storefront creates a checkout through the storefront API, for example, with the
``checkout`` subresource of a shopping list. For details, see
:ref:`Storefront Checkout API Guide <bundle-docs-commerce-checkout-bundle--checkout-api>`. Then the external storefront
opens a browser session through Session Transfer with the ``oro_checkout_frontend_checkout`` target route and the
checkout ID as the ``id`` route parameter.

The ``Resources/views/layouts/default/oro_checkout_frontend_checkout/page/session_transfer_checkout.yml`` layout update
applies when the ``is_in_session_transfer_mode`` layout context option is ``true``. OroOAuth2ServerBundle sets this
option for every browser session opened through Session Transfer. As a result, the layout update also applies to the
sessions of OAuth2 clients that do not belong to a headless application.

The layout update does the following:

* Removes the storefront navigation and menu blocks.
* Adds the ``session_transfer_checkout_actions`` container with the ``session_transfer_checkout_back_link`` link to
  the return URL.
* Passes the return URL to the ``logo`` and ``success_order`` blocks.
* Passes the order view URL to the ``success_order`` block.
* Sets the images of the ``logo`` block to the logos of the application, or to the default logos of the bundle.

The ``session_transfer_checkout_url`` and ``session_transfer_checkout_logo`` layout data providers return these
values:

* ``getReturnUrl()`` --- Returns ``checkoutReturnUrl``. If it is empty, the method returns ``applicationUrl``. If both
  are empty, the method returns the URL of the storefront home page.
* ``getOrderViewUrl()`` --- Returns ``orderViewUrl`` with the database ID of the order in place of the ``{id}``
  placeholder. If the field is empty, the method returns ``null``, and the success page has no order link.
* ``getLogoUrl()`` and ``getSmallLogoUrl()`` --- Return the URL of the ``logo`` or ``smallLogo`` image, or ``null``
  when the application has no such image.

The data providers use only an application of a supported type. By default, only the ``general_storefront`` type is
supported. To add a type, see
:ref:`Change the Bundle Parameters <bundle-docs-commerce-headless-storefront-bundle--extend--parameters>`. For other
sessions, the return URL is the storefront home page, the order view URL is the ``oro_order_frontend_view`` route, and
the logo is the default logo.

Related Documentation
---------------------

* :ref:`Create a New Headless Application Type <bundle-docs-commerce-headless-storefront-bundle--application-type>`
* :ref:`Reuse and Customize the General Storefront Features <bundle-docs-commerce-headless-storefront-bundle--extend>`
* :ref:`OroHeadlessApplicationBundle <bundle-docs-platform-headless-application-bundle>`
* :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`
* :ref:`OroStorefrontEmbeddedBundle <bundle-docs-commerce-storefront-embedded-bundle>`

.. toctree::
   :hidden:

   application-type
   extend

.. include:: /include/include-links-dev.rst
   :start-after: begin
