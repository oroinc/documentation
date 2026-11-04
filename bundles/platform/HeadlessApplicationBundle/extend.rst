:title: Add and Customize Headless Application Types with OroHeadlessApplicationBundle

.. meta::
   :description: The extension points of OroHeadlessApplicationBundle: application types, type-specific fields and
                 page blocks, system configuration settings, and the current headless application

.. _bundle-docs-platform-headless-application-bundle--extend:

Add and Customize Headless Application Types
============================================

OroHeadlessApplicationBundle provides extension points that let other bundles add application types and type-specific
features. For the steps to add a storefront type, see
:ref:`Create a New Headless Application Type <bundle-docs-commerce-headless-storefront-bundle--application-type>`. For
a reference type, see ``general_storefront`` in
:ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>`.

.. _bundle-docs-platform-headless-application-bundle--extend--application-type:

Register an Application Type
----------------------------

An application type is a service that implements
``Oro\Bundle\HeadlessApplicationBundle\HeadlessApplication\Type\HeadlessApplicationTypeInterface`` and has the
``oro_headless_application.headless_application_type`` tag. The static ``getName()`` method returns the type name.

The static ``isStorefront()`` method returns whether the type is a storefront type:

* Applications of a storefront type get a storefront OAuth2 client. The ``apis`` field of the form lists the
  storefront APIs that the client can support.
* Applications of other types get a back-office OAuth2 client. The ``apis`` field lists the back-office APIs.

The label of a type uses the ``oro.headlessapplication.type.<name>`` translation key in the ``messages`` domain, where
``<name>`` is the type name.

The ``Oro\Bundle\HeadlessApplicationBundle\Validator\Constraints\SupportedHeadlessApplicationType`` constraint of the
``type`` property accepts only registered types.

The type class, the tag, and the label translation are the minimum for any type. The other steps of
:ref:`Create a New Headless Application Type <bundle-docs-commerce-headless-storefront-bundle--application-type>` reuse
parts of OroHeadlessStorefrontBundle and apply only to storefront types.

Add Type-Specific Fields to the Form
------------------------------------

The ``Oro\Bundle\HeadlessApplicationBundle\Form\Type\HeadlessApplicationType`` form type edits an application and the
options of its OAuth2 client. For the client options, see :ref:`Manage OAuth Applications <oauth-applications>`. The
``skipConsents`` field maps to the ``skipAuthorizeClientAllowed`` property of the client. The form disables the
``type`` field for a saved application. As a result, the type of an application cannot change after the first save.

To add fields for one type, create a form type extension for the ``HeadlessApplicationType`` form type that receives
the type name as a constructor argument. Use the following listener pattern:

* Add the fields on ``PRE_SET_DATA`` when the application has the type of the extension.
* Remove the fields on ``PRE_SUBMIT`` with priority ``10`` when the submitted type is another type.
* Add the fields on ``PRE_SUBMIT`` with the default priority when the submitted type is the type of the extension.
  Skip a field that the form already has.

Because all extensions remove their fields before any extension adds fields, two types can use the same field name.
When the ``type`` field is disabled, read the type from the application, not from the submitted data. For a complete
implementation, see the
``Oro\Bundle\HeadlessStorefrontBundle\Form\Extension\Website\WebsiteAwareHeadlessApplicationTypeExtension``
class.

To store the values of your own fields, add extend fields to the ``HeadlessApplication`` entity with a schema
migration. These fields exist for applications of all types.

.. _bundle-docs-platform-headless-application-bundle--extend--reload:

Reload the Form When a Field Changes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A change of the ``type`` field reloads the form over AJAX without saving. As a result, the form shows the fields of the
selected type. A change of a field with the ``data-headless-application-reload-on-change`` attribute also reloads the
form. Add this attribute to a field when other fields depend on its value:

.. code-block:: php

   'attr' => ['data-headless-application-reload-on-change' => true],

Handle the Form Save
--------------------

The form handler dispatches the ``oro.form.update_handler.before_entity_flush.oro_headless_application`` and
``oro.form.update_handler.after_entity_flush.oro_headless_application`` events for applications of all types. The
event class is ``Oro\Bundle\FormBundle\Event\FormHandler\AfterFormProcessEvent``. Its ``getData()`` method returns
the application. Check the application type in your listener.

The bundle sets up the OAuth2 client of an application in the
``oro_headless_application.event_listener.oauth2_client_aware_headless_application_form_handler`` listener of the
``before_entity_flush`` event. For details, see
:ref:`OAuth2 Client <bundle-docs-platform-headless-application-bundle--oauth2-client>`.

Add Blocks to the View and Edit Pages
-------------------------------------

To add blocks or fields, listen to the ``oro_ui.scroll_data.before.headless-application-view`` and
``oro_ui.scroll_data.before.headless-application-edit`` events, and check the application type in the listener.

.. _bundle-docs-platform-headless-application-bundle--extend--system-config:

Add System Configuration Settings to a Type
-------------------------------------------

To show system configuration settings on the view and edit pages of the applications of your type and to store them in
the system configuration, declare services of the four generic classes of OroHeadlessApplicationBundle for your type.

Add the following configuration to the ``Resources/config/services.yml`` file of your bundle. It enables two settings
for the ``mobile_storefront`` type of
:ref:`Create a New Headless Application Type <bundle-docs-commerce-headless-storefront-bundle--application-type>`,
with the ``organization`` start scope:

.. code-block:: yaml

   parameters:
       acme_mobile_storefront.application_type: !php/const Acme\Bundle\MobileStorefrontBundle\HeadlessApplication\Type\MobileStorefrontHeadlessApplicationType::NAME
       acme_mobile_storefront.config_keys:
           - 'oro_entity_pagination.enabled'
           - 'oro_form.wysiwyg_enabled'

   services:
       acme_mobile_storefront.form.extension.system_config_aware_headless_application_type:
           class: Oro\Bundle\HeadlessApplicationBundle\Form\Extension\SystemConfig\SystemConfigAwareHeadlessApplicationTypeExtension
           arguments:
               $configManagerRegistry: '@oro_config.manager_registry'
               $headlessApplicationSystemConfigScopeProvider: '@oro_headless_application.provider.headless_application_system_config_scope'
               $systemConfigSettingDefinitionProvider: '@oro_config.provider.system_config_setting_definition'
               $systemConfigScope: 'organization'
               $systemConfigSettings: '%acme_mobile_storefront.config_keys%'
               $applicationType: '%acme_mobile_storefront.application_type%'
           tags:
               - { name: form.type_extension }

       acme_mobile_storefront.event_listener.system_config_aware_headless_application_form_handler:
           class: Oro\Bundle\HeadlessApplicationBundle\EventListener\SystemConfig\SystemConfigAwareHeadlessApplicationFormHandlerListener
           arguments:
               $configManagerRegistry: '@oro_config.manager_registry'
               $headlessApplicationSystemConfigScopeProvider: '@oro_headless_application.provider.headless_application_system_config_scope'
               $systemConfigScope: 'organization'
               $systemConfigSettings: '%acme_mobile_storefront.config_keys%'
               $applicationType: '%acme_mobile_storefront.application_type%'
           tags:
               - name: kernel.event_listener
                 event: oro.form.update_handler.after_entity_flush.oro_headless_application
                 method: onAfterFlush

       acme_mobile_storefront.event_listener.system_config_aware_headless_application_view_page:
           class: Oro\Bundle\HeadlessApplicationBundle\EventListener\SystemConfig\SystemConfigAwareHeadlessApplicationViewPageListener
           arguments:
               $configManagerRegistry: '@oro_config.manager_registry'
               $headlessApplicationSystemConfigScopeProvider: '@oro_headless_application.provider.headless_application_system_config_scope'
               $systemConfigSettingDefinitionProvider: '@oro_config.provider.system_config_setting_definition'
               $systemConfigValueFormatter: '@oro_config.formatter.system_config_value'
               $translator: '@translator'
               $systemConfigScope: 'organization'
               $systemConfigSettings: '%acme_mobile_storefront.config_keys%'
               $sectionName: 'system_configuration'
               $sectionLabel: 'oro.headlessapplication.block.system_configuration'
               $applicationType: '%acme_mobile_storefront.application_type%'
           tags:
               - name: kernel.event_listener
                 event: oro_ui.scroll_data.before.headless-application-view
                 method: onHeadlessApplicationView

       acme_mobile_storefront.event_listener.system_config_aware_headless_application_edit_page:
           class: Oro\Bundle\HeadlessApplicationBundle\EventListener\SystemConfig\SystemConfigAwareHeadlessApplicationEditPageListener
           arguments:
               $translator: '@translator'
               $headlessApplicationSystemConfigScopeProvider: '@oro_headless_application.provider.headless_application_system_config_scope'
               $systemConfigScopeNameProvider: '@oro_config.provider.system_config_scope_name'
               $systemConfigScope: 'organization'
               $sectionName: 'system_configuration'
               $sectionLabel: 'oro.headlessapplication.block.system_configuration'
               $configKeys: '%acme_mobile_storefront.config_keys%'
               $applicationType: '%acme_mobile_storefront.application_type%'
           tags:
               - name: kernel.event_listener
                 event: oro_ui.scroll_data.before.headless-application-edit
                 method: onHeadlessApplicationEdit

The ``$systemConfigScope`` argument sets the start scope. Use the same start scope for all four services. The start
scope must be an existing system configuration scope. Otherwise, the bundle throws a ``LogicException``.

The ``acme_mobile_storefront.config_keys`` parameter lists the settings. Each setting must be a field of a
``system_configuration.yml`` file. Otherwise, the bundle throws a ``LogicException``.

To order the ``system_configuration`` block among other blocks, add a ``priority`` to the page listener tags. For
example, ``general_storefront`` uses ``-5``.

The note at the top of the block on the edit page uses the ``oro.headlessapplication.system_configuration_note.<scope>``
translation key, where ``<scope>`` is the name of the resolved scope. The ``%name%`` placeholder of the translation
contains the name of the scope identifier, for example, the website name. If this key has no translation, or if the
scope resolution ends in the global scope, the note uses the ``oro.headlessapplication.system_configuration_note``
key. For example, OroHeadlessStorefrontBundle translates
``oro.headlessapplication.system_configuration_note.website``. Both keys are in the ``messages`` domain. The translation
of the ``oro.headlessapplication.system_configuration_note`` key names the organization. For this reason, if the
resolved scope of your type can be a scope other than ``organization`` or the global scope, translate the key of that
scope.

The bundle skips a setting when the feature of the setting is disabled or when the current user is not granted the ACL
resource of the setting. The pages do not show such a setting, and a save does not change its value.

.. _bundle-docs-platform-headless-application-bundle--extend--scope-resolution:

Scope Resolution
^^^^^^^^^^^^^^^^

The bundle does not store the values for each application. It reads and saves them in a regular system configuration
scope. The ``oro_headless_application.provider.headless_application_system_config_scope`` service resolves this scope
for an application in the following way:

#. It starts with the start scope of the type, for example, ``website``.
#. It asks the scope identifier provider of this scope for the identifier of the application, for example, the website
   of the application. A scope without a scope identifier provider is skipped.
#. If the provider returns ``null``, the service moves to the next parent scope, for example, ``organization``.
#. If no scope has an identifier for the application, the service uses the global scope.

For the scope identifier providers, see
:ref:`Provide a Scope Identifier <bundle-docs-platform-headless-application-bundle--extend--scope-identifier>`. For
information about system configuration scopes, see :ref:`System Configuration <backend-system-configuration>`.

.. _bundle-docs-platform-headless-application-bundle--extend--shared-values:

Shared Values
^^^^^^^^^^^^^

Because the values belong to a regular scope, they are shared:

* All applications that resolve to the same scope identifier share the values. For example, two ``general_storefront``
  applications of one website have the same values.
* The values apply to all code that reads the configuration in this scope. For example, a value saved for an
  application of a website also applies to the OroCommerce storefront of this website.
* A change in the system configuration of this scope also changes the values of the application.

The form shows the value of the scope, including a value that the scope inherits from a parent scope. A save of the
form stores all settings of the type as values of the scope.

.. _bundle-docs-platform-headless-application-bundle--extend--scope-identifier:

Provide a Scope Identifier
--------------------------

To provide the scope identifier of an application for a scope, implement the
``Oro\Bundle\HeadlessApplicationBundle\Provider\SystemConfigScope\HeadlessApplicationSystemConfigScopeIdentifierProviderInterface``
interface and tag the service with the ``oro_headless_application.system_config_scope_identifier_provider`` tag. The
scope name comes from the ``scope`` attribute of the tag, or from the static ``getScopeName()`` method. The
``getScopeIdentifier()`` method returns the identifier of the scope for the application, or ``null`` when the
application has none.

OroHeadlessApplicationBundle includes the provider of the ``organization`` scope. OroHeadlessStorefrontBundle adds the
provider of the ``website`` scope. For an example, see the
``Oro\Bundle\HeadlessStorefrontBundle\Provider\SystemConfigScope\WebsiteHeadlessApplicationSystemConfigScopeIdentifierProvider``
class.

.. _bundle-docs-platform-headless-application-bundle--extend--current-application:

Get the Current Headless Application
------------------------------------

The ``getHeadlessApplication()`` method of the ``oro_headless_application.provider.current_headless_application``
service returns the headless application whose OAuth2 client authenticated the current request. The client
authenticates a request with an API access token or with a browser session that it opened through
:ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`.
For other requests, the method returns ``null``. For example, OroHeadlessStorefrontBundle uses this service to
restrict the storefront requests of an application to its website.

Show the Type Label
-------------------

The ``oro_headless_application_type_label`` Twig function returns the translation key of a type label:

.. code-block:: twig

   {{ oro_headless_application_type_label(entity.type)|trans }}

.. include:: /include/include-links-dev.rst
   :start-after: begin
