:title: Create a New Headless Application Type for an External Storefront

.. meta::
   :description: Add a headless application type for an external storefront, such as a mobile app, and reuse the
                 website, URL, and logo blocks and the transfer to the checkout of OroHeadlessStorefrontBundle

.. _bundle-docs-commerce-headless-storefront-bundle--application-type:

Create a New Headless Application Type
======================================

This guide adds the ``mobile_storefront`` type for a mobile app storefront in the
``Acme\Bundle\MobileStorefrontBundle`` bundle. The type reuses the form fields, the page blocks, and the checkout of
the ``general_storefront`` type.

Register the bundle with a priority higher than the priority of OroHeadlessStorefrontBundle. Otherwise, the parameter
that the last step redefines has no effect. For the priority, see
:ref:`Change the Bundle Parameters <bundle-docs-commerce-headless-storefront-bundle--extend--parameters>`.

Implement and Register the Type
-------------------------------

Create the type class:

.. code-block:: php

   <?php

   declare(strict_types=1);

   namespace Acme\Bundle\MobileStorefrontBundle\HeadlessApplication\Type;

   use Oro\Bundle\HeadlessApplicationBundle\HeadlessApplication\Type\HeadlessApplicationTypeInterface;

   class MobileStorefrontHeadlessApplicationType implements HeadlessApplicationTypeInterface
   {
       public const string NAME = 'mobile_storefront';

       #[\Override]
       public static function getName(): string
       {
           return self::NAME;
       }

       #[\Override]
       public static function isStorefront(): bool
       {
           return true;
       }
   }

The other services in this guide use the type name parameter. To register the type and define this parameter, add
the following configuration to the ``Resources/config/services.yml`` file:

.. code-block:: yaml

   parameters:
       acme_mobile_storefront.application_type: !php/const Acme\Bundle\MobileStorefrontBundle\HeadlessApplication\Type\MobileStorefrontHeadlessApplicationType::NAME

   services:
       acme_mobile_storefront.headless_application.type.mobile_storefront:
           class: Acme\Bundle\MobileStorefrontBundle\HeadlessApplication\Type\MobileStorefrontHeadlessApplicationType
           tags:
               - { name: oro_headless_application.headless_application_type }

Add the Type Label
------------------

Add the ``oro.headlessapplication.type.mobile_storefront`` translation key to the ``messages`` domain of your bundle.

.. _bundle-docs-commerce-headless-storefront-bundle--application-type--blocks:

Add the Form Fields and Page Blocks
-----------------------------------

Each form field or page block consists of a form extension and of view and edit page listeners. Declare new services
of these classes with the name of your type as the last argument. The following services add the ``application_urls``
block:

.. code-block:: yaml

   services:
       acme_mobile_storefront.form.extension.application_urls_aware_headless_application_type:
           class: Oro\Bundle\HeadlessStorefrontBundle\Form\Extension\ApplicationUrls\ApplicationUrlsAwareHeadlessApplicationTypeExtension
           arguments:
               - '%acme_mobile_storefront.application_type%'
           tags:
               - { name: form.type_extension }

       acme_mobile_storefront.event_listener.application_urls_aware_headless_application_view_page:
           class: Oro\Bundle\HeadlessStorefrontBundle\EventListener\ApplicationUrls\ApplicationUrlsAwareHeadlessApplicationViewPageListener
           arguments:
               - '@translator'
               - '%acme_mobile_storefront.application_type%'
           tags:
               - name: kernel.event_listener
                 event: oro_ui.scroll_data.before.headless-application-view
                 method: onHeadlessApplicationView

       acme_mobile_storefront.event_listener.application_urls_aware_headless_application_edit_page:
           class: Oro\Bundle\HeadlessStorefrontBundle\EventListener\ApplicationUrls\ApplicationUrlsAwareHeadlessApplicationEditPageListener
           arguments:
               - '@translator'
               - '%acme_mobile_storefront.application_type%'
           tags:
               - name: kernel.event_listener
                 event: oro_ui.scroll_data.before.headless-application-edit
                 method: onHeadlessApplicationEdit

Declare the services of the other blocks in the same way. The classes are in the
``Oro\Bundle\HeadlessStorefrontBundle`` namespace:

* ``website`` field of the ``general`` block ---
  ``Form\Extension\Website\WebsiteAwareHeadlessApplicationTypeExtension``,
  ``EventListener\Website\WebsiteAwareHeadlessApplicationViewPageListener``, and
  ``EventListener\Website\WebsiteAwareHeadlessApplicationEditPageListener``. The page listeners take only the type
  name.
* ``application_logo`` block ---
  ``Form\Extension\ApplicationLogo\ApplicationLogoAwareHeadlessApplicationTypeExtension``,
  ``EventListener\ApplicationLogo\ApplicationLogoAwareHeadlessApplicationViewPageListener``, and
  ``EventListener\ApplicationLogo\ApplicationLogoAwareHeadlessApplicationEditPageListener``.

The priority of the page listener tags sets the order of the blocks. The ``general_storefront`` type uses ``0`` for
``application_urls``, ``-3`` for ``application_logo``, ``-5`` for ``system_configuration``, and ``-10`` for
``contact_request_form``.

The fields of these blocks already exist on the entity. For this reason, no migration is needed. An application of
your type with a website is restricted to this website. For more information, see
:ref:`Website Restriction <bundle-docs-commerce-headless-storefront-bundle--website-restriction>`.

Add System Configuration Settings
---------------------------------

This step is optional. The example in
:ref:`Add System Configuration Settings to a Type <bundle-docs-platform-headless-application-bundle--extend--system-config>`
already uses the ``mobile_storefront`` type. Copy it without the ``acme_mobile_storefront.application_type`` parameter,
because the first step of this guide defines this parameter. Then change the following values:

* ``acme_mobile_storefront.config_keys`` --- The keys of your settings.
* ``$systemConfigScope`` --- ``website``. For the requirements of this scope, see
  :ref:`Use the Website Start Scope <bundle-docs-commerce-headless-storefront-bundle--extend--website-scope>`.
* The priority of the view and edit page listener tags --- ``-5``.

.. _bundle-docs-commerce-headless-storefront-bundle--application-type--contact-request:

Add the Contact Request Form Block
----------------------------------

This step is optional. For the requirements of the ``contact_request_form`` block, see
:ref:`Reuse the Form Fields and Page Blocks <bundle-docs-commerce-headless-storefront-bundle--extend--blocks>`.

Declare the services of the following classes as described in
:ref:`Add the Form Fields and Page Blocks <bundle-docs-commerce-headless-storefront-bundle--application-type--blocks>`,
with the ``-10`` priority of the page listener tags:

* ``Oro\Bundle\HeadlessStorefrontBundle\Form\Extension\ContactRequest\ContactRequestAwareHeadlessApplicationTypeExtension``
* ``Oro\Bundle\HeadlessStorefrontBundle\EventListener\ContactRequest\ContactRequestAwareHeadlessApplicationViewPageListener``
* ``Oro\Bundle\HeadlessStorefrontBundle\EventListener\ContactRequest\ContactRequestAwareHeadlessApplicationEditPageListener``

Declare these services in a separate ``Resources/config/services_contact_us.yml`` file. In the ``load()`` method of the
DI extension of your bundle, load this file only when the ``kernel.bundles`` parameter contains
``OroContactUsBundle``. The ``OroHeadlessStorefrontExtension`` class of OroHeadlessStorefrontBundle uses the same
approach.

Show the Application URLs and Logo at Checkout
----------------------------------------------

This step is optional. To make the checkout in Session Transfer mode use the URLs and the logo of your applications,
add your type to the ``oro_headless_storefront.session_transfer_checkout.application_types`` parameter. For how to
redefine the parameter, see
:ref:`Change the Bundle Parameters <bundle-docs-commerce-headless-storefront-bundle--extend--parameters>`.

The following parameter value keeps the ``general_storefront`` type in the list and adds your type:

.. code-block:: yaml

   parameters:
       oro_headless_storefront.session_transfer_checkout.application_types:
           - '%oro_headless_storefront.general_storefront.application_type%'
           - '%acme_mobile_storefront.application_type%'

The OAuth2 client of each application must allow Session Transfer. The ``sessionTransferAllowed`` field of the
application form enables it. For more information, see
:ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
