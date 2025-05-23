.. _yaml-bundles-configuration:

Bundles' Configuration
======================

To display the default configuration value, run the following command with the extension alias (root node) at the end:

.. code-block:: bash

   php bin/console config:dump-reference -eprod [alias]

To display the actual configuration values used in your application, run the following command with the extension alias at the end:

.. code-block:: bash

   php bin/console debug:config -eprod [alias]

oro_api
_______

The default configuration for extension with alias "oro_api":

.. code-block:: text

    oro_api:
        # The prefix of REST API URLs.
        rest_api_prefix:      /api/

        # The regular expression pattern to which REST API URLs are matched.
        rest_api_pattern:     '^/api/(?!(rest|doc)($|/.*))'

        # The maximum number of nesting target entities that can be specified in "Resources/config/oro/api.yml".
        config_max_nesting_level: 3

        # The default page size. It is used when the page size is not specified in a request explicitly.
        default_page_size:    10

        # The maximum number of primary entities that can be retrieved by a request.
        max_entities:         -1

        # The maximum number of related entities that can be retrieved by a request.
        max_related_entities: 100

        # The maximum number of entities that can be deleted by one request.
        max_delete_entities:  100

        # All supported API configuration files.
        config_files:

            # Prototype
            name:

                # The name of a file that contain API resources configuration. Can contain several files, in this case all of them are merged.
                file_name:            ~

                # The request type to which this file is applicable.
                request_type:         []

        # The configuration extensions for "Resources/config/oro/api.yml".
        config_extensions:

            # Examples:
            - oro_api.config_extension.filters
            - oro_api.config_extension.sorters

        # The configuration of API documentation cache.
        api_doc_cache:

            # The list of features that do not affect API documentation cache.
            excluded_features:

                # Default:
                - web_api

                # Example:
                - web_api

            # The list of services that should be reset to its initial state after API documentation cache for a specific view is warmed up.
            resettable_services:

                # Example:
                - acme.api.some_provider

        # All supported API views.
        api_doc_views:

            # Prototype
            name:

                # The view label.
                label:                ~

                # Whether this view is default one.
                default:              false

                # The name of the underlying view.
                underlying_view:      ~

                # The request type supported by this view.
                request_type:         []

                # The URL to the API documentation for this view.
                documentation_path:   ~

                # The HTML formatter that should be used by this view.
                html_formatter:       oro_api.api_doc.formatter.html_formatter

                # Whether the sandbox should have a link to this view.
                sandbox:              true

                # Headers that should be sent with requests from the sandbox.
                headers:

                    # Examples:
                    Accept:              application/vnd.api+json
                    Content-Type:        [{ value: application/vnd.api+json, actions: [create, update] }]
                    X-Include:           [{ value: totalCount, actions: [get_list, delete_list] }, { value: deletedCount, actions: [delete_list] }]

                    # Prototype
                    name:                 []

                # The map between data-type names and their representation in API documentation.
                data_types:

                    # Examples:
                    guid:                string
                    currency:            string

                    # Prototype
                    name:                 ~

        # The URL to the API documentation that should be used for API views that does not have own documentation.
        documentation_path:   null

        # The map between data-type names and their representation in API documentation. The data-types declared in this map can be overridden in "data_types" section of a particular API view.
        api_doc_data_types:

            # Examples:
            guid:                string
            currency:            string

            # Prototype
            name:                 ~

        # The configuration of OpenAPI specification generation.
        open_api:
            version:              ~

            # The map between data-types and their representation in OpenAPI specification.
            data_types:

                # Examples:
                float:               [number]
                text:                [string, { format: text }]

                # Prototype
                name:                 ~

            # The list of data-type aliases. It is used to prevent several definition of identical data-types.
            data_type_aliases:

                # Examples:
                json:                object
                blob:                binary

                # Prototype
                name:                 ~

            # The map between plural and singular data-type names. It is used to resolve data-type by expressions like "array of integers".
            data_type_plural_map:

                # Examples:
                strings:             string
                integers:            integer

                # Prototype
                name:                 ~

            # The map between a regex and corresponding data-type. It is used to resolve data-type by its regex representation.
            data_type_pattern_map:

                # Examples:
                -?\d+:               integer
                \d+:                 unsignedInteger

                # Prototype
                name:                 ~

            # The map between a data-type and its regex. It is used to build regex for range data-type.
            data_type_range_value_patterns:

                # Examples:
                integer:             '-?\d+'
                unsignedInteger:     \d+

                # Prototype
                name:                 ~

        # The definition of API actions.
        actions:

            # Example:
            get:                 { processor_service_id: oro_api.get.processor, processing_groups: { load_data: { priority: -10 }, normalize_data: { priority: -20 } } }

            # Prototype
            name:

                # The service id of the action processor. Set for public actions only.
                processor_service_id: ~

                # A list of groups by which child processors can be split.
                processing_groups:

                    # Prototype
                    name:

                        # The priority of the group.
                        priority:             ~

        # The definition of filters.
        filters:

            # Examples:
            integer:             { supported_operators: ['=', '!=', '<', '<=', '>', '>=', '*', '!*'] }
            primaryField:        { class: Oro\Bundle\ApiBundle\Filter\PrimaryFieldFilter }
            association:         { factory: ['@oro_api.filter_factory.association', createFilter] }

            # Prototype
            name:
                class:                ~
                factory:              []
                supported_operators:

                    # Defaults:
                    - =
                    - !=
                    - *
                    - !*

        # A definition of operators for filters. The key is the name of an operator. The value is optional and it is a short name of an operator.
        filter_operators:

            # Examples:
            eq:                  '='
            regexp:              null

            # Prototype
            name:                 ~

        # The form types that can be reused in API.
        form_types:

            # Examples:
            - Symfony\Component\Form\Extension\Core\Type\FormType
            - oro_api.form.type.entity

        # The form type extensions that can be reused in API.
        form_type_extensions:

            # Example:
            - form.type_extension.form.http_foundation

        # The form type guessers that can be reused in API.
        form_type_guessers:

            # Example:
            - form.type_guesser.validator

        # The definition of data type to form type guesses.
        form_type_guesses:

            # Examples:
            integer:             { form_type: Symfony\Component\Form\Extension\Core\Type\IntegerType }
            datetime:            { form_type: Symfony\Component\Form\Extension\Core\Type\DateTimeType, options: { model_timezone: UTC, view_timezone: UTC } }

            # Prototype
            name:
                form_type:            ~
                options:

                    # Prototype
                    name:                 ~

        # The map between error titles and their substitutions.
        error_title_overrides:

            # Example:
            percent range constraint: 'range constraint'

            # Prototype
            name:                 ~

        # The configuration of CORS requests.
        cors:

            # The amount of seconds the user agent is allowed to cache CORS preflight requests.
            preflight_max_age:    600

            # The list of origins that are allowed to send CORS requests.
            allow_origins:

                # Examples:
                - 'https://foo.com'
                - 'https://bar.com'

            # Indicates whether CORS request can include user credentials.
            allow_credentials:    false

            # The list of headers that are allowed to send by CORS requests.
            allow_headers:

                # Examples:
                - X-Foo
                - X-Bar

            # The list of headers that can be exposed by CORS responses.
            expose_headers:

                # Examples:
                - X-Foo
                - X-Bar

        # The configuration of feature depended API firewalls.
        api_firewalls:

            # Prototype
            name:

                # The name of the feature.
                feature_name:         ~

                # The list of security firewall listeners that should be removed if the feature is disabled.
                feature_firewall_listeners: []

        # The Batch API configuration.
        batch_api:
            async_operation:

                # The number of days asynchronous operations are stored in the system.
                lifetime:             30

                # The maximum number of seconds that the asynchronous operations cleanup process can spend in one run.
                cleanup_process_timeout: 3600

            # The default maximum number of entities that can be saved in a chunk.
            chunk_size:           100

            # The default maximum number of included entities that can be saved in a chunk.
            included_data_chunk_size: 50

            # The maximum number of entities of a specific type that can be saved in a chunk.
            # The null value can be used to revert already configured chunk size for a specific entity type and use the default chunk size for it.
            chunk_size_per_entity:

                # Example:
                Oro\Bundle\UserBundle\Entity\User: 10

                # Prototype
                name:                 ~

            # The maximum number of included entities that can be saved in a chunk for a specific primary entity type.
            # The null value can be used to revert already configured chunk size for a specific entity type and use the default chunk size for it.
            included_data_chunk_size_per_entity:

                # Example:
                Oro\Bundle\UserBundle\Entity\User: 20

                # Prototype
                name:                 ~

oro_asset
_________

The default configuration for extension with alias "oro_asset":

.. code-block:: yaml

    oro_asset:

        # Permanently enable Babel, by default it is disabled
        with_babel:           false

        # Path to NodeJs executable
        nodejs_path:          ~

        # Path to NPM executable
        npm_path:             ~

        # Assets build timeout in seconds, null to disable timeout
        build_timeout:        null

        # Npm installation timeout in seconds, null to disable timeout
        npm_install_timeout:  null

        # Webpack Dev Server configuration
        webpack_dev_server:

            # Enable Webpack Hot Module Replacement. To activate HMR run `oro:assets:build --hot`
            enable_hmr:           '%kernel.debug%'

            # By Default `localhost` is used
            host:                 localhost
            port:                 8081

            # By default dev-server will be served over HTTP. It can optionally be served over HTTP/2 with HTTPS
            https:                false

oro_attachment
______________

The default configuration for extension with alias "oro_attachment":

.. code-block:: yaml

    oro_attachment:
        debug_images:         true
        maxsize:              10
        upload_file_mime_types: []
        upload_image_mime_types: []
        processors_allowed:   true
        png_quality:          100
        jpeg_quality:         85

        # Strategy for converting uploaded images to WebP format.
        webp_strategy:        if_supported # One of "for_all"; "if_supported"; "disabled"

        # The configuration of the attachment cleanup command.
        cleanup:

            # The number of attachment files that can be loaded from the filesystem at once.
            collect_attachment_files_batch_size: 20000

            # The number of attachment entities that can be loaded from the database at once to check whether an attachment file is linked to an attachment entity.
            load_existing_attachments_batch_size: 500

            # The number of attachment entities that can be loaded from the database at once.
            load_attachments_batch_size: 10000

oro_batch
_________

The default configuration for extension with alias "oro_batch":

.. code-block:: yaml

    oro_batch:

        # Enables/Disables writing of batch log files for each batch job in var/logs/batch directory
        log_batch:            false

        # Sets the time interval to keep the batch job records in the database
        cleanup_interval:     '1 week' # Example: '1 month'

oro_cms
_______

The default configuration for extension with alias "oro_cms":

.. code-block:: yaml

    oro_cms:
        direct_editing:
            login_page_css_field: false

        # Describes the rules how WYSIWYG fields should works with HTMLPurifier
        content_restrictions:

            # Configuration setting that defines the overall level of content restrictions:
            # "secure" - on the secure level there is no way to insert any potentially unsecure content via UI by any users
            # "selective" - on the less secure level potentially unsecure content can be inserted via UI by some roles into specific fields of specific entities
            # "unsecure" - on this level any content can be inserted via UI by any user with edit permission on that WYSIWYG field
            mode:                 secure # One of "secure"; "selective"; "unsecure"

            # List of user roles that has edit permission on entity field with selected secure level
            lax_restrictions:

                # Prototype: List of roles that has edit permission with selected secure level
                ROLE:

                    # Prototype: List of entity fields to which selected secure level current apply
                    \Entity:              []

oro_calendar
____________

The default configuration for extension with alias "oro_calendar":

.. code-block:: yaml

    oro_calendar:

        # Indicates whether Organization and/or System Calendars are enabled or not.
        # Possible values:
        #     true         - both organization and system calendars are enabled
        #     false        - both organization and system calendars are disabled
        #     organization - only organization calendar is enabled
        #     system       - only system calendar is enabled
        #
        enabled_system_calendar: system

oro_contact
___________

The default configuration for extension with alias "oro_contact":

.. code-block:: yaml

    oro_contact:
        social_url_format:
            twitter:              'https://twitter.com/%%username%%'
            facebook:             'https://www.facebook.com/%%username%%'
            google_plus:          'https://profiles.google.com/%%username%%'
            linked_in:            'http://www.linkedin.com/in/%%username%%'

oro_customer
____________

The default configuration for extension with alias "oro_customer":

.. code-block:: yaml

    oro_customer:
        reset:
            ttl:                  86400
        visitor_session:
            cookie_secure:        auto # One of true; false; "auto"
            cookie_httponly:      true
            cookie_samesite:      lax # One of null; "lax"; "strict"; "none"
        login_sources:

            # Prototype
            name:
                label:                ~
                code:                 ~

        # The configuration of API for the storefront.
        frontend_api:

            # The list of entities that should be available for non-authenticated visitors.
            non_authenticated_visitors_api_resources:

                # Example:
                - Acme\AppBundle\Entity\Product


oro_email
_________

The default configuration for extension with alias "oro_email":

.. code-block:: yaml

    oro_email:

        # Determines which email address owners should be excluded during synchronization.
        email_sync_exclusions:

            # Example:
            - Oro\Bundle\UserBundle\Entity\User
        flash_notification:
            max_emails_display:   4

oro_embedded_form
_________________

The default configuration for extension with alias "oro_embedded_form":

.. code-block:: yaml

    oro_embedded_form:

        # The name of the hidden field that should be used to pass the session id to third party site. This allows to use the embedded form even if a web browser blocks third-party cookies.
        session_id_field_name: _embedded_form_sid

        # The number of seconds the CSRF token should live for.
        csrf_token_lifetime:  3600

        # The service id that is used to cache CSRF tokens.
        csrf_token_cache_service_id: ~

oro_entity
__________

The default configuration for extension with alias "oro_entity":

.. code-block:: yaml

    oro_entity:

        # The configuration of an entity's text representation.
        entity_name_representation:

            # Examples:
            Acme\AppBundle\Entity\User: { full: [namePrefix, firstName, middleName, lastName, nameSuffix], short: [firstName, lastName] }
            Acme\AppBundle\Entity\Organization: { full: [name] }

            # Prototype
            class:                []

        # Default doctrine`s query cache lifetime
        default_query_cache_lifetime: null

oro_entity_extend
_________________

The default configuration for extension with alias "oro_entity_extend":

.. code-block:: yaml

    oro_entity_extend:
        backup:               '%kernel.project_dir%/var/backup'

oro_featuretoggle
_________________

The default configuration for extension with alias "oro_featuretoggle":

.. code-block:: yaml

    oro_featuretoggle:
        strategy:             unanimous # One of "affirmative"; "consensus"; "unanimous"
        allow_if_all_abstain: false
        allow_if_equal_granted_denied: true

oro_form
________

The default configuration for extension with alias "oro_form":

.. code-block:: yaml

    oro_form:
        # Describes scopes and scope rules for HTMLPurifier
        html_purifier_modes:

            # Prototype: Collection of scopes that defines the rules for HTMLPurifier
            default:

                # Extends configuration from selected scope
                extends:              null # Example: default

                # List of allowed forward document relationships in the rel attribute for HTMLPurifier.
                allowed_rel:

                    # Examples:
                    - nofollow
                    - alternate

                # Only these domains will be allowed in iframes (in case iframes are enabled in allowed elements)
                allowed_iframe_domains:

                    # Examples:
                    - youtube.com/embed/
                    - player.vimeo.com/video/

                # Allowed URI schemes for HTMLPurifier
                allowed_uri_schemes:

                    # Examples:
                    - http
                    - https
                    - mailto
                    - ftp
                    - data
                    - tel

                # Allowed elements and attributes for HTMLPurifier
                allowed_html_elements:

                    # Prototype: Collection of allowed HTML elements for HTMLPurifier
                    -

                        # Collection of allowed attributes for described HTML tag
                        attributes:

                            # Examples:
                            - cellspacing
                            - cellpadding
                            - border
                            - align
                            - width

                        # Is HTML tag has closing end tag or not
                        hasClosingTag:        true

oro_frontend
____________

The default configuration for extension with alias "oro_frontend":

.. code-block:: yaml

    oro_frontend:
        debug_routes:         true
        routes_to_expose:     []

        # The configuration of storefront session.
        session:
            name:                 ~ # Required
            cookie_lifetime:      ~
            cookie_path:          ~
            cookie_secure:        ~ # One of true; false; "auto"
            cookie_httponly:      ~
            cookie_samesite:      lax # One of null; "lax"; "strict"; "none"
            gc_maxlifetime:       ~
            gc_probability:       ~
            gc_divisor:           ~

        # The configuration of API for the storefront.
        frontend_api:

            # The API views that are available for the storefront.
            api_doc_views:        []

            # The configuration of CORS requests for the storefront.
            cors:

                # The amount of seconds the user agent is allowed to cache CORS preflight requests.
                preflight_max_age:    600

                # The list of origins that are allowed to send CORS requests.
                allow_origins:

                    # Examples:
                    - 'https://foo.com'
                    - 'https://bar.com'

                # Indicates whether CORS request can include user credentials.
                allow_credentials:    false

                # The list of headers that are allowed to send by CORS requests.
                allow_headers:

                    # Examples:
                    - X-Foo
                    - X-Bar

                # The list of headers that can be exposed by CORS responses.
                expose_headers:

                    # Examples:
                    - X-Foo
                    - X-Bar

oro_gaufrette
_____________

The default configuration for extension with alias "oro_gaufrette":

.. code-block:: yaml

    oro_gaufrette:
        stream_wrapper:

            # The name of read-only Gaufrette protocol. By default it is "{gaufrette protocol name}-readonly".
            readonly_protocol:    null

oro_google_tag_manager
______________________

The default configuration for extension with alias "oro_google_tag_manager":

.. code-block:: yaml

    oro_google_tag_manager:
        config:

            # Number of product items in each batch for sending to GTM
            batch_size:           30

oro_hangouts_call
_________________

The default configuration for extension with alias "oro_hangouts_call":

.. code-block:: yaml

    oro_hangouts_call:
        initial_apps:

            # Prototype
            -
                app_id:               ~ # Required
                app_type:             ROOM_APP
                app_name:             ~
                base_path:            ~

oro_health_check
________________

The default configuration for extension with alias "oro_health_check":

.. code-block:: yaml

    oro_health_check:
        maintenance_driver:
            options:
                ttl:                  600
                file_path:            ~
        last_cron_execution_cache:
            ttl:                      900

oro_help
________

The default configuration for extension with alias "oro_help":

.. code-block:: yaml

    oro_help:
        defaults:             # Required
            server:               ~ # Required
            prefix:               ~
            uri:                  ~
            link:                 ~

oro_layout
__________

The default configuration for extension with alias "oro_layout":

.. code-block:: text

    oro_layout:
        view:

            # Defines whether @Layout annotation can be used in controllers
            annotations:          true

        # List of enabled themes
        enabled_themes:       []
        templating:
            default:              twig
            twig:
                resources:

                    # Default:
                    - @OroLayout/Layout/div_layout.html.twig

                    # Example:
                    - '@My/Layout/blocks.html.twig'

        # Enable layout debug mode. Allows to switch theme using request parameter _theme.
        debug:                '%kernel.debug%'

        # The identifier of the theme that should be used by default
        active_theme:         ~

oro_locale
__________

The default configuration for extension with alias "oro_locale":

.. code-block:: yaml

    oro_locale:
        formatting_code:      en
        language:             en

oro_maintenance
_______________

The default configuration for extension with alias "oro_maintenance":

.. code-block:: yaml

    oro_maintenance:
        authorized:
            path:                 null
            host:                 null
            ips:                  []
            query:                []
            cookie:               []
            route:                null
            attributes:           []
        driver:
            ttl:                  600
            options:              []
        response:
            code:                 503
            status:               'Service Temporarily Unavailable'
            exception_message:    'Service Temporarily Unavailable'

oro_message_queue
_________________

The default configuration for extension with alias "oro_message_queue":

.. code-block:: yaml

    oro_message_queue:

        # List of available transports with their configurations.
        transport:

            # DBAL transport configuration.
            dbal:
                connection:           message_queue
                table:                oro_message_queue
                pid_file_dir:         /tmp/oro-message-queue
                consumer_process_pattern: ':consume'
                polling_interval:     1000

            # AMQP transport configuration.
            amqp:
                host:                 localhost
                port:                 5672
                user:                 guest
                password:             guest
                vhost:                /

        # Consumption client configuration.
        client:
            traceable_producer:   false
            prefix:               oro
            router_processor:     oro_message_queue.client.route_message_processor
            router_destination:   default
            default_destination:  default
            default_topic:        default

            # Redelivery message extension configuration.
            redelivery:

                # If redelivery enabled than new copied message will be published
                # to message broker and old one will be REJECTED when error
                # was occurred during message processing.
                enabled:              true

                # Time through which message will be re-published to the broker,
                # old one will be REJECTED immediately.
                delay_time:           10

        # A list of services that must not be removed from the container once the message is processed.
        persistent_services:  []

        # A list of processors that must not be removed from the container once the message is processed.
        persistent_processors: []

        # A list of topics that should always be processed without a security context.
        security_agnostic_topics: []

        # A list of processors that should always be processed without a security context.
        security_agnostic_processors: []
        consumer:

            # Consumer heartbeat update period in minutes. To disable the checks, set this option to 0
            heartbeat_update_period: 15

        # The maximum time for a unique job execution.
        # If a job is still running longer than that,
        # it is possible to create a new copy of a unique job (with the same name).
        # The old job is marked as "stale" in this case.
        time_before_stale:

            # Examples:
            # default:           X
            # jobs:              { '# some_job_type_name': 'Y' }

            # The number of seconds of inactivity to qualify a job as stale.
            # If this attribute is not set or set to -1, jobs will never be qualified as stale.
            # It means that if a unique job is not properly removed after it is finished,
            # it will be blocking other jobs of that type until it is manually interrupted.
            default:              ~

            # The number of seconds of inactivity to qualify jobs of this type as stale.
            # To disable staling jobs for the given job type, set this option to -1.
            # The key can be a whole job name or a part of it from the beginning of string to any "."
            jobs:

                # Examples:
                # bundle_name.processor_name.entity_name.user: X
                # bundle_ name.processor_name.entity_name: 'Y'
                # bundle_name.processor_name: Z

                # Prototype
                job_name:             ~

oro_microsoft_sync
__________________

The default configuration for extension with alias "oro_microsoft_sync":

.. code-block:: yaml

    oro_microsoft_sync:

        # The period in days data should be synchronized with Microsoft 365.
        sync_period:          730

        # The configuration of the storage for synchronization related data.
        storage:

            # The service ID of the driver that should be used to store deleted entities.
            deleted_entities_driver: oro_microsoft_sync.storage_driver.dbal

oro_multi_host
______________

The default configuration for extension with alias "oro_multi_host":

.. code-block:: yaml

    oro_multi_host:

        # Determines whether multi-host operations are enabled.
        enabled:              false

        # The configuration of the driver to execute multi-host operations.
        driver:

            # The service ID of the driver.
            service:              ~

            # The driver options.
            options:

                # Prototype
                name:                 ~

        # The configuration of multi-host operations.
        operations:

            # Prototype
            name:

                # The maximum number of seconds that the driver can wait till an operation status is changed by a server that processes the operation.
                timeout:              60

        # The number of days multi-host operations are stored in the system.
        operation_lifetime:   180

oro_navigation
______________

The default configuration for extension with alias "oro_navigation":

.. code-block:: yaml

    oro_navigation:

        # The prefix in the name of the file with a list of js routes.
        js_routing_filename_prefix: ''

oro_notification
________________

The default configuration for extension with alias "oro_notification":

.. code-block:: yaml

    oro_notification:

        # List of notification events.
        events:               []

oro_oauth2_server
_________________

The default configuration for extension with alias "oro_oauth2_server":

.. code-block:: yaml

    oro_oauth2_server:
        authorization_server:

            # The lifetime in seconds of the access token.
            access_token_lifetime: 3600

            # The lifetime in seconds of the refresh token.
            refresh_token_lifetime: 18144000

            # The lifetime in seconds of the authorization code.
            auth_code_lifetime:   600

            # Determines if the refresh token grant is enabled.
            enable_refresh_token: true

            # Determines if the authorization code grant is enabled.
            enable_auth_code:     true

            # The full path to the private key file that is used to sign JWT tokens. How to generate a private key: https://oauth2.thephpleague.com/installation/#generating-public-and-private-keys.
            private_key:          '%kernel.project_dir%/var/oauth_private.key' # Example: /var/oauth/private.key

            # The string that is used to encrypt refresh token and authorization token payload. How to generate an encryption key: https://oauth2.thephpleague.com/installation/#string-password.
            encryption_key:       '%kernel.secret%'

            # The configuration of CORS requests.
            cors:

                # The amount of seconds the user agent is allowed to cache CORS preflight requests.
                preflight_max_age:    600

                # The list of origins that are allowed to send CORS requests.
                allow_origins:

                    # Examples:
                    - 'https://foo.com'
                    - 'https://bar.com'
        resource_server:

            # The full path to the public key file that is used to verify JWT tokens. How to generate a public key: https://oauth2.thephpleague.com/installation/#generating-public-and-private-keys.
            public_key:           '%kernel.project_dir%/var/oauth_public.key' # Example: /var/oauth/public.key

            # The list of security firewalls for which OAuth 2.0 authorization should be enabled.
            oauth_firewalls:      []

oro_organization_pro
____________________

The default configuration for extension with alias "oro_organization_pro":

.. code-block:: yaml

    oro_organization_pro:

        # The list of security token classes that should ignore a preferred organization for a user.
        ignore_preferred_organization_tokens: []

        # The configuration of the organization types feature.
        organization_types:

            # Whether the organization types feature is enabled or not.
            enabled:              true

            # A list of organization types that should be disabled.
            disabled_organization_types: []

oro_paypal
__________

The default configuration for extension with alias "oro_paypal":

.. code-block:: yaml

    oro_paypal:
        allowed_ips:          []

oro_report
__________

The default configuration for extension with alias "oro_report":

.. code-block:: yaml

    oro_report:
        dbal:

            # The name of DBAL connection that should be used to execute report queries.
            connection:           ~

            # The list of name prefixes for datagrids that are reports and should use the DBAL connection configured in the "connection" option.
            datagrid_prefixes:

                # Example:
                - acme_report_

oro_search
__________

The default configuration for extension with alias "oro_search":

.. code-block:: yaml

    oro_search:
        engine:               orm
        required_plugins:     []
        engine_parameters:    []
        log_queries:          false
        item_container_template: '@OroSearch/Datagrid/itemContainer.html.twig'

oro_security
____________

The default configuration for extension with alias "oro_security":

.. code-block:: yaml

    oro_security:
        csrf_cookie:
            cookie_secure:        auto # One of true; false; "auto"
            cookie_httponly:      false
            cookie_samesite:      lax # One of null; "lax"; "strict"; "none"
        login_target_path_excludes: []

oro_task
________

The default configuration for extension with alias "oro_task":

.. code-block:: yaml

    oro_task:

        # Indicates whether My Tasks should be visible in My Calendar or not
        my_tasks_in_calendar: true

oro_theme
_________

The default configuration for extension with alias "oro_theme":

.. code-block:: yaml

    oro_theme:
        themes:

            # Prototype
            name:
                label:                ~
                logo:                 ~
                icon:                 ~
                screenshot:           ~

                # Defines whether Theme supports RTL and additional *.rtl.css have to be build
                rtl_support:          ~
        active_theme:         ~

oro_translation
_______________

The default configuration for extension with alias "oro_translation":

.. code-block:: yaml

    oro_translation:
        js_translation:
            domains:

                # Defaults:
                - jsmessages
                - validators
            debug:                true
        translation_service:
            apikey:               ''
        package_names:        []
        debug_translator:     false
        locales:              []
        default_required:     true
        templating:           '@OroTranslation/default.html.twig'
        # The configuration of Gedmo translatable entities that should be synchronized with the translator component. All translation messages for these entities should be in the "entities" domain.
        translatable_dictionaries:

            # Example:
            Acme\Bundle\DemoBundle\Entity\Country: { name: { translation_key_prefix: acme_country., key_field_name: iso2Code } }

            # Prototype
            entity class:

                # Prototype
                translatable field name:

                    # The prefix for the translation message key.
                    translation_key_prefix: ~

                    # The field name where the key is stored.
                    key_field_name:       ~

.. _yaml-bundles-configuration-reset-password:

oro_user
________

The default configuration for extension with alias "oro_user":

.. code-block:: yaml

    oro_user:
        reset:
            // Determine the reset password token ttl, sec
            ttl:                  86400
        privileges:

            # Prototype
            name:
                label:                ~
                view_type:            ~
                types:                []
                field_type:           ~
                fix_values:           ~
                default_value:        ~
                show_default:         ~

oro_user_pro
____________

The default configuration for extension with alias "oro_user_pro":

.. code-block:: yaml

    oro_user_pro:

        # Duration (in minutes) of the period when the email notifications about user deactivation will not be sent if user continues trying to log in with invalid credentials.
        auto_deactivate_emails_delay: 1440

oro_website_search
__________________

The default configuration for extension with alias "oro_website_search":

.. code-block:: yaml

    oro_website_search:
        engine:               orm
        engine_parameters:    []
