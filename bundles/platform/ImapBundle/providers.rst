OAuth Providers for Mailboxes
=============================

Out-of-the-box, `OroImapBundle` provides two OAuth-based Email origin types: Gmail and Microsoft 365.

Gmail
^^^^^

Google Gmail implementation provides OAuth authentication/authorization via a custom Google application.

- :ref:`Integration configuration <system-configuration-integrations-google>` is available via **System Configuration > Integrations > Google Settings**.
- Mandatory fields are `Client ID` and `Client Secret`. They are located in the Google application management panel.
- Option **OAuth 2.0 for Gmail emails sync** must be enabled. If the provided credentials are invalid, the integration *will not be enabled*.

Microsoft 365
^^^^^^^^^^^^^

Microsoft 365 implementation provides OAuth authentication/authorization via a custom Microsoft Azure application.

- :ref:`Integration configuration <user-guide-integrations-microsoft>` is available via **System Configuration > Integrations > Microsoft Settings**
- Mandatory fields are `Client ID`, `Client Secret`, `Tenant`. They are located in the MS Azure application management panel.
- Select **Enable Emails Sync** in *Microsoft 365 Integrations*.

Custom Provider Implementation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Implement a new OAuth provider class that inherits from ``Oro\Bundle\ImapBundle\Provider\OAuthProviderInterface``.

#. Implement a new OAuth manager class that inherits from ``Oro\Bundle\ImapBundle\Manager\OAuthManagerInterface``.

#. Tag the manager implementation with tag `oro_imap.oauth_manager` (the service will be automatically picked up and, if the provider is enabled, an additional account type will be available for **User Configuration > General Setup > Email Configuration > Email Synchronization Settings > Account Type**).

#. Implement a form type with default Email Origin values for a certain provider (see ``Oro\Bundle\ImapBundle\Form\Type\AbstractOAuthAwareConfigurationType`` and existing inheriting types).

#. Register a route for ``Oro\Bundle\ImapBundle\Controller\CheckConnectionController`` for a new OAuth vendor.

#. Implement a custom controller for handling access token (see ``Oro\Bundle\ImapBundle\Controller\AbstractAccessTokenController`` and inheriting controllers) and register a route for it.

#. Register custom form block widgets definitions:

   * `Resources/config/oro/twig.yml` - add this file to register the global set of definitions of form fields.

    .. code-block:: yaml

        bundles:
            - '@ExampleVendorImap/Form/fields.html.twig'

   * Create a fields definitions file with the custom definition of the previously defined form field.

    .. code-block:: twig

        {# '@ExampleVendorImap/Form/fields.html.twig' #}

        {% block example_imap_configuration_type_widget %}
            {% set data = form.parent.parent.vars.value %}

            {% set options = form.vars.options|default({})|merge({
                {# component options #}
            }) %}

            <div class="example-imap-gmail-container"
                 data-page-component-module="examplevendorimap/js/app/components/imap-component"
                 data-page-component-options="{{ options|json_encode }}"
            >
                <div {{ block('widget_container_attributes') }}>
                    {# Custom form layout #}
                    {{- form_rest(form) -}}
                </div>
            </div>
        {% endblock %}

#. Implement JavaScript components:

   * Create a popup for OAuth initialization (extend ``/Resources/public/js/app/components/imap-component.js``).
   * Create a view managed by the component (extend ``/Resources/public/js/app/views/imap-view.js``).
   * Depending on OAuth implementation from your provider, claim token data via a previously defined controller.


   By default, the component/view handles the population of proper DOM elements with the provided token data.


.. include:: /include/include-links-dev.rst
   :start-after: begin
