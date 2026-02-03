.. _bundle-docs-commerce-frontend-mcp-bundle:

OroFrontendMcpBundle
====================

.. note:: This bundle is available as of OroPlatform Enterprise version 6.1.7.

OroFrontendMcpBundle implements of |Model Context Protocol| using the official MCP SDK |mcp/sdk| for OroCommerce storefront.

Supports MCP capabilities (tools, prompts, resources) as server via HTTP transport. Resource templates implementation ready but awaiting MCP SDK support.

Creating MCP Capabilities
-------------------------

MCP capabilities are automatically discovered using PHP attributes, such as `McpTool`, `McpPrompt`, `McpResource` and `McpResourceTemplate`.
The only one thing you need to do is configure directories where PHP classes with these attributes will be located.
It can be done via `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, e.g.:

.. code-block:: yaml

    oro_mcp:
        discovery:
            - { base_path: 'Acme\Bundle\FrontendMcpBundle\AcmeFrontendMcpBundle', scan_dirs: ['McpFrontend'] }

Examples of PHP classes that implement MCP capabilities:

.. code-block:: php

    use Mcp\Capability\Attribute\McpTool;

    class CurrentTimeTool
    {
        #[McpTool(name: 'current-time')]
        public function getCurrentTime(string $format = 'Y-m-d H:i:s'): string
        {
            return (new \DateTime('now', new \DateTimeZone('UTC')))->format($format);
        }
    }

.. code-block:: php

    use Mcp\Capability\Attribute\McpPrompt;

    class TimePrompts
    {
        #[McpPrompt(name: 'time-analysis')]
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
        #[McpResource(uri: 'time://current', name: 'current-time')]
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
        #[McpResourceTemplate(uriTemplate: 'time://{timezone}', name: 'time-by-timezone')]
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
    just register it as a service in the `Resources/config/services.yml` file, e.g.:

    .. code-block:: yaml

        oro_acme.mcp_frontend.current_time_tool:
            class: Acme\Bundle\AcmeFrontendMcpBundle\McpFrontend\CurrentTimeTool
            arguments:
                - '@some_service'

Configuration
-------------

The default configuration of OroFrontendMcpBundle:

.. code-block:: yaml

    oro_frontend_mcp:
        # The application name to be exposed to storefront MCP clients.
        app: app
        # The application version to be exposed to storefront MCP clients.
        version: 0.0.1
        # Instructions describing storefront MCP server purpose and usage context (for LLMs).
        instructions: null
        # The maximum number of items returned per storefront MCP list request.
        pagination_limit: 50
        # Storefront MCP HTTP transport configuration.
        http:
            # Storefront MCP HTTP endpoint path.
            path: /_mcp
            # Storefront MCP session store configuration.
            session:
                # The session store type. Can be one of "file", "cache" or "memory"
                store: file
                # The prefix for cache store.
                cache_prefix: mcp_
                # The directory for file store.
                directory: '%kernel.cache_dir%/mcp-frontend-sessions'
                # The session TTL in seconds.
                ttl: 3600
        # Storefront MCP services discovery configuration.
        # Example:
        #     discovery:
        #         - { base_path: 'Acme\Bundle\FrontendMcpBundle\AcmeFrontendMcpBundle', scan_dirs: ['McpFrontend'], exclude_dirs: ['Excluded'] }
        # The "base_path" can be a path for scanning directories or a PHP class located in a root directory to be scanned.
        # The "scan_dirs" is the list of directories (relative to the base path) to scan.
        # The "exclude_dirs" is optional and it is the list of directories (relative to the base path) to exclude from the scan.
        discovery: { }


.. include:: /include/include-links-dev.rst
   :start-after: begin
