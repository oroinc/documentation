.. _bundle-docs-commerce-commerce-mcp-bundle:

OroCommerceMcpBundle
====================

.. note:: This bundle is available as of OroCommerce Enterprise version 6.1.8.

OroCommerceMcpBundle implements of |Model Context Protocol| using the official MCP SDK |mcp/sdk| for OroCommerce back-office.

Supports MCP capabilities (tools, prompts, resources) as server via HTTP transport. Resource templates implementation ready but awaiting MCP SDK support.

Install in VS Code
------------------

First, create an :ref:`OAuth Application <oauth-applications>` with the following properties:

* Application Name: the name of your application, for example `Commerce MCP Server`
* Active: `on`
* Support all APIs: `off`
* Supported APIs: `Commerce MCP Server`
* Grant Type: `Authorization Code`
* Redirect URLs: `http://127.0.0.1:33418/` and `https://vscode.dev/redirect`
* Confidential Client: `off`
* Skip User Consent: `off` or `on`

Next, open VS Code and add the following to your host configuration (`.vscode/mcp.json` file):

.. code-block:: json

    {
      "servers": {
        "oro-commerce-mcp": {
          "type": "http",
          "url": "https://yourapplication/{backend_prefix}/commerce-mcp"
        }
      }
    }

The `{backend_prefix}` is the prefix of your back-office (by default, it is `admin`).

Install in ChatGPT
------------------

First, create an :ref:`OAuth application <oauth-applications>` with the following properties:

* Application Name: the name of your application, for example `Commerce MCP Server`
* Active: `on`
* Support all APIs: `off`
* Supported APIs: `Commerce MCP Server`
* Grant Type: `Authorization Code`
* Redirect URLs: `https://chatgpt.com/connector_platform_oauth_redirect`
* Confidential Client: `off` or `on`
* Skip User Consent: `off` or `on`

Next, open ChatGPT website, enable developer mode, and create MCP application with the following properties:

* Name: the name of your application, for example `OroCommerce`
* MCP Server URL: `https://yourapplication/{backend_prefix}/commerce-mcp`, where `{backend_prefix}` is the prefix of your back-office (by default, it is `admin`).
* Authentication: `OAuth`
* OAuth Client ID: the Client ID of the OAuth application created on the first step
* OAuth Client Secret: the Client Secret of the OAuth application created on the first step

.. note::
    Connecting custom MCP applications are supported starting with Plus plan.

Creating API Based MCP Tools
----------------------------

To expose API resources as MCP tools, provide information about these tools in `Resources/config/oro/commerce_mcp_api_based_tools.yml` in any bundle or `config/commerce_mcp_api_based_tools.yml` of your application, e.g.:

.. code-block:: yaml

    api_based_mcp_tools:
        Oro\Bundle\OrderBundle\Entity\Order:
            get_list:
                name: 'get_orders'
                title: 'Get Orders'
                description: 'Gets the list of orders.'

The complete configuration options available in this configuration file are:

.. code-block:: yaml

    api_based_mcp_tools:

        # Prototype
        entity_class:

            # Prototype
            # Supported API actions: get_list, get_count, get, create, update, delete
            api_action:

                # The name of the MCP tool.
                name:                 ~ # Required

                # A human-readable title for the MCP tool.
                title:                ~

                # The description of the MCP tool.
                description:          ~ # Required

                # The list of required filters for the MCP tool.
                required_filters:     []

To restrict the list of fields returned by API-based MCP tools, use `Resources/config/oro/commerce_mcp_default_fields.yml` in any bundle or `config/commerce_mcp_default_fields.yml` of your application, e.g.:

.. code-block:: yaml

    default_fields:
        Oro\Bundle\OrderBundle\Entity\Order:
            - poNumber
            - currency
            - totalValue
            - lineItems

To configure API resources, use `Resources/config/oro/api_commerce_mcp.yml` in any bundle or `config/api_commerce_mcp.yml` of your application.

:ref:`The API request type aspect <api-request-type>` for the API-based MCP tools is ``commerce_mcp``.

Plain Format for API Based MCP Tools
------------------------------------

By default, request and response data for MCP tools conform to the |JSON:API specification|, but it is possible to switch the MCP server to work with a simpler format, which could be named "plain". For example, here are the request data in both formats:

.. code-block:: json
   :caption: JSON:API format

    {
      "data": {
        "type": "orders"
        "attributes": {
          "currency": "USD"
        },
        "relationships": {
          "customer": {
            "data": {"type": "customers", "id": "5"}
          },
          "lineItems": {
            "data": [
              {"type": "orderlineitems", "id": "line1"}
            ]
          }
        }
      },
      "included": [
        {
          "type": "orderlineitems",
          "id": "line1",
          "attributes": {
            "productSku": "0RT28",
            "quantity": 11,
            "price": "75.99"
          },
          "relationships": {
            "productUnit": {
              "data": {"type": "productunits", "id": "item"}
            }
          }
        }
      ]
    }

.. code-block:: json
   :caption: Plain format

    {
      "type": "orders"
      "order_currency": "USD",
      "order_customer": {"type": "customers", "customer_id": "5"},
      "order_lineItems": [
        {
          "type": "orderlineitems"
          "orderlineitem_productSku": "0RT28",
          "orderlineitem_quantity": 11,
          "orderlineitem_price": "75.99",
          "orderlineitem_productUnitCode": "item"
        }
      ]
    }

To switch to the plain format, use the ``https://yourapplication/{backend_prefix}/commerce-mcp-plain`` MCP server URL instead of the ``https://yourapplication/{backend_prefix}/commerce-mcp``.

To configure the plain format, use `Resources/config/oro/commerce_mcp_plain_json_api.yml` in any bundle or `config/commerce_mcp_plain_json_api.yml` of your application, e.g.:

.. code-block:: yaml

    plain_json_api:
        Oro\Bundle\OrderBundle\Entity\Order:
            fields:
                lineItems:
                    expand: true

The complete configuration options available in this configuration file are:

.. code-block:: yaml

    plain_json_api:

        # Prototype
        entity_class:

            # The exclusion strategy to be used for the entity.
            exclusion_policy:     ~ # One of "all"; "none"

            # The prefix for field names when a field value is an object or an array of objects.
            field_name_prefix:    ~

            fields:

                # Prototype
                field_name:

                    # Indicates whether a field should be excluded from MCP.
                    exclude:              ~

                    # Indicates whether a relationship to another entity should be expanded in MCP.
                    expand:               ~

                    exclusion_policy:     ~
                    field_name_prefix:    ~
                    fields:
                        # Prototype
                        field_name:
                            exclude:              ~
                            expand:               ~
                            exclusion_policy:     ~
                            field_name_prefix:    ~
                            fields:
                                # Prototype
                                field_name:
                                    exclude:              ~
                                    expand:               ~

To configure API resources that should be applicable only to the plain format, use `Resources/config/oro/api_commerce_mcp_plain.yml` in any bundle or `config/api_commerce_mcp_plain.yml` of your application.

:ref:`The API request type aspect <api-request-type>` for the API-based MCP tools in the plain format is ``commerce_mcp_plain``.

Creating MCP Capabilities
-------------------------

MCP capabilities are automatically discovered using PHP attributes, such as `McpTool`, `McpPrompt`, `McpResource` and `McpResourceTemplate`.
The only thing you need to do is configure the directories where PHP classes with these attributes will be located.
It can be done via `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, e.g.:

.. code-block:: yaml

    oro_commerce_mcp:
        discovery:
            - { base_path: 'Acme\Bundle\CommerceMcpBundle\AcmeCommerceMcpBundle', scan_dirs: ['Mcp'] }

Examples of PHP classes that implement MCP capabilities:

.. code-block:: php

    use Mcp\Capability\Attribute\McpTool;
    use Mcp\Schema\ToolAnnotations;

    class CurrentTimeTool
    {
        #[McpTool(
            name: 'current_time',
            title: 'Current Time',
            description: 'Gets current time.',
            annotations: new ToolAnnotations(readOnlyHint: true)
        )]
        public function getCurrentTime(string $format = 'Y-m-d H:i:s'): string
        {
            return (new \DateTime('now', new \DateTimeZone('UTC')))->format($format);
        }
    }

.. code-block:: php

    use Mcp\Capability\Attribute\McpPrompt;

    class TimePrompts
    {
        #[McpPrompt(name: 'time_analysis')]
        public function getTimeAnalysisPrompt(): array
        {
            return [
                ['role' => 'user', 'content' => 'You are a time management expert.']
            ];
        }
    }

.. code-block:: php

    use Mcp\Capability\Attribute\McpResource;

    class TimeResource
    {
        #[McpResource(uri: 'time://current', name: 'current_time')]
        public function getCurrentTimeResource(): array
        {
            return [
                'uri' => 'time://current',
                'mimeType' => 'text/plain',
                'text' => (new \DateTime('now'))->format('Y-m-d H:i:s')
            ];
        }
    }

.. code-block:: php

    use Mcp\Capability\Attribute\McpResourceTemplate;

    class TimeResourceTemplate
    {
        #[McpResourceTemplate(uriTemplate: 'time://{timezone}', name: 'time_by_timezone')]
        public function getTimeByTimezone(string $timezone): array
        {
            $time = (new \DateTime('now', new \DateTimeZone($timezone)))->format('Y-m-d H:i:s T');
            return [
                'uri' => "time://$timezone",
                'mimeType' => 'text/plain',
                'text' => $time
            ];
        }
    }

.. note::
    If your PHP class that implements MCP capabilities depends on other services in the dependency injection container,
    register it as a service in the `Resources/config/services.yml` file and tag it with ``oro_commerce_mcp.service``, e.g.:

    .. code-block:: yaml

        oro_acme.mcp.current_time_tool:
            class: Acme\Bundle\AcmeCommerceMcpBundle\Mcp\CurrentTimeTool
            arguments:
                - '@some_service'
            tags:
                - { name: oro_commerce_mcp.service }

Configuration
-------------

The default configuration of OroCommerceMcpBundle:

.. code-block:: yaml

    oro_commerce_mcp:
        # The application name to be exposed to MCP clients.
        app: 'OroCommerce MCP Server'
        # The application version to be exposed to MCP clients.
        version: '0.1'
        # Instructions in Markdown format describing the MCP server's purpose and usage context (for LLMs).
        # The instructions should start with a top-level section name, for example:
        # # Critical Rules
        #
        # If several bundles provide instructions with the same top-level sections, their contents will be merged.
        instructions: null
        # Markdown files containing additional MCP server instructions associated with specific API request type expressions.
        # Example: { '@AcmeMcpBundle/Resources/doc/mcp/instructions.md': [ 'json_api&acme' ] }
        additional_instructions:
            '@OroCommerceMcpBundle/Resources/doc/mcp/commerce_mcp_plain_instructions.md': [ 'commerce_mcp_plain' ]
        # The maximum number of items returned per MCP list request.
        pagination_limit: 50
        # MCP HTTP transport configuration.
        http:
            # MCP HTTP endpoint path.
            path: '/commerce-mcp'
            # The authorization server scopes required for accessing MCP server.
            scopes: [ 'mcp:commerce' ]
            # MCP session store configuration.
            session:
                # The session store type. Can be one of "file", "cache" or "memory"
                store: 'file'
                # The prefix for cache store.
                cache_prefix: 'commerce_mcp_'
                # The directory for file store.
                directory: '%kernel.cache_dir%/commerce_mcp_sessions'
                # The session TTL in seconds.
                ttl: 3600
            # The configuration of CORS requests for MCP server.
            cors:
                # The list of origins that are allowed to send CORS requests.
                # Example: [ 'https://foo.com', 'https://bar.com' ]
                allow_origins: [ '*' ]
                # The list of headers that are allowed to send by CORS requests.
                # Example: [ 'X-Foo', 'X-Bar' ]
                allow_headers: []
            # Additional HTTP endpoints that can be used to tune MCP server behaviour.
            # Example:
            #    'acme': { path: '/commerce-mcp-acme', request_type: [ 'acme' ] }
            # The "path" is an endpoint path.
            # The "request_type" contains additional API request type aspects that are applied when a request is sent to this endpoint.
            additional_endpoints:
                plain:
                    path: /commerce-mcp-plain
                    request_type: [ 'commerce_mcp_plain' ]
            # Additional HTTP request headers that can be used to tune MCP server behaviour.
            # Example:
            #    'X-Integration-Name': { value: 'acme', request_type: [ 'acme' ] }
            # The "value" is a header value.
            # The "request_type" contains additional API request type aspects that are applied when this header is present in a request.
            additional_headers: {}
        # MCP services discovery configuration.
        # Example:
        #    - { base_path: 'Acme\Bundle\McpBundle\AcmeMcpBundle', scan_dirs: ['Mcp'], exclude_dirs: ['Excluded'] }
        #    - { base_path: 'Acme\Bundle\McpBundle\AcmeMcpBundle', scan_dirs: ['AnotherMcp'], request_type: 'json_api&another' }
        # The "base_path" can be a path for scanning directories or a PHP class located in a root directory to be scanned.
        # The "scan_dirs" is the list of directories (relative to the base path) to scan.
        # The "exclude_dirs" is optional and it is the list of directories (relative to the base path) to exclude from the scan.
        # The "request_type" is optional and it is the API request type expression to which the discovery path applies.
        discovery:
            - { base_path: 'Oro\Component\Mcp\Api\JsonApi\JsonApiBasedTools', scan_dirs: [ 'CommonTools' ], request_type: 'json_api&default' }
            - { base_path: 'Oro\Component\Mcp\Api\JsonApi\JsonApiBasedTools', scan_dirs: [ 'CommonTools/Search' ], request_type: 'commerce_mcp_plain' }
        # API related configuration.
        api:
            # The API type that is used to group and protect MCP capabilities.
            type: 'commerce_mcp'
            # The human-readable API name.
            name: 'Commerce MCP Server'
            # Indicates whether API is storefront or back-office.
            frontend: false
            # The request type for API that is used by API-based MCP tools.
            request_type: [ 'rest', 'json_api', 'commerce_mcp' ]
            # All supported API configuration files for API-based MCP tools.
            config_files: [ 'api_commerce_mcp.yml', 'api.yml' ]
            # A map between API and MCP data types.
            # Example: { 'text': 'string' }
            data_types: []

Dependency Injection Tags
-------------------------

* **oro_commerce_mcp.service** - Registers a service that implements MCP server capabilities, such as tools, prompts, resources, and resource templates.
* **oro_commerce_mcp.loader** - Allows adding a new loader for providing definitions of MCP server capabilities, such as tools, prompts, resources, and resource templates. Must implement ``Mcp\Capability\Registry\Loader\LoaderInterface``. The ``requestType`` DIC tag attribute can be used to specify the expression that determines when the loader is applicable, for example ``json_api&acme``.
* **oro_commerce_mcp.instructions_provider** - Allows adding a new provider for MCP server instructions. Must implement ``Oro\Component\Mcp\Server\Provider\InstructionsProviderInterface``. The ``requestType`` DIC tag attribute can be used to specify the expression that determines when the provider is applicable, for example ``json_api&acme``.
* **oro_commerce_mcp.api_tool_schema_processor** - Allows adding a new processor for processing input and output schemas for API-based MCP tools. Must implement ``Oro\Component\Mcp\Api\ApiBasedToolSchemaProcessorInterface``. The ``requestType`` DIC tag attribute can be used to specify the expression that determines when the processor is applicable, for example ``json_api&acme``.
* **oro_commerce_mcp.api_tool_data_processor** - Allows adding a new processor for processing request and response data for API-based MCP tools. Must implement ``Oro\Component\Mcp\Api\ApiBasedToolDataProcessorInterface``. The ``requestType`` DIC tag attribute can be used to specify the expression that determines when the processor is applicable, for example ``json_api&acme``.
* **oro_commerce_mcp.build_server_middleware** - Allows adding a new middleware to be run before MCP server is built. Must implement ``Oro\Component\Mcp\Server\Builder\MiddlewareInterface``.
* **oro_commerce_mcp.http_request_middleware** - Allows adding a new middleware to be run before MCP HTTP requests are processed. Must implement ``Psr\Http\Server\MiddlewareInterface``.
* **oro_commerce_mcp.api_request_type_modifier** - Allows adding a new modifier for the request type used by API-based MCP tools. Must implement ``Oro\Component\Mcp\Api\RequestTypeModifier\ApiRequestTypeModifierInterface``.


.. include:: /include/include-links-dev.rst
   :start-after: begin
