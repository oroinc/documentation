.. _bundle-docs-commerce-commerce-mcp-bundle:

OroCommerceMcpBundle
====================

.. note:: This bundle is only available in the Enterprise edition.

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

To expose API resources as MCP tools, provide information about these tools in `Resources/config/oro/api_based_mcp_tools_commerce.yml` in any bundle or `config/api_based_mcp_tools_commerce.yml` of your application, e.g.:

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

Creating MCP Capabilities
-------------------------

MCP capabilities are automatically discovered using PHP attributes, such as `McpTool`, `McpPrompt`, `McpResource` and `McpResourceTemplate`.
The only one thing you need to do is configure directories where PHP classes with these attributes will be located.
It can be done via `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, e.g.:

.. code-block:: yaml

    oro_mcp:
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
            description: 'Gets current time.',
            annotations: new ToolAnnotations(title: 'Current Time', readOnlyHint: true)
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
        # Instructions in Markdown format describing MCP server purpose and usage context (for LLMs).
        # The instructions should start with a top-level section name, for example:
        # # Critical Rules
        #
        # If several bundles provide instructions with the same top-level sections, their contents will be merged.
        instructions: null
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
        # MCP services discovery configuration.
        # Example:
        #     discovery:
        #         - { base_path: 'Acme\Bundle\McpBundle\AcmeMcpBundle', scan_dirs: ['Mcp'], exclude_dirs: ['Excluded'] }
        # The "base_path" can be a path for scanning directories or a PHP class located in a root directory to be scanned.
        # The "scan_dirs" is the list of directories (relative to the base path) to scan.
        # The "exclude_dirs" is optional and it is the list of directories (relative to the base path) to exclude from the scan.
        discovery:
            - { base_path: 'Oro\Component\Mcp\Api\JsonApi\JsonApiBasedTools', scan_dirs: [ 'CommonTools' ] }
        # API related configuration.
        api:
            # The API type that is used to group and protect MCP capabilities.
            type: 'commerce_mcp'
            # The human-readable API name.
            name: 'Commerce MCP Server'
            # Indicates whether API is storefront or back-office.
            frontend: false
            # The request type for API that is used by MCP tools based on API.
            request_type: [ 'rest', 'json_api', 'commerce_mcp' ]
            # All supported API configuration files for MCP tools based on API.
            config_files: [ 'api_commerce_mcp.yml', 'api.yml' ]
            # A map between API and MCP data types.
            data_types: []


.. include:: /include/include-links-dev.rst
   :start-after: begin
