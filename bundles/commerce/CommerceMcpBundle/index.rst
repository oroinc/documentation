.. _bundle-docs-commerce-commerce-mcp-bundle:

OroCommerceMcpBundle
====================

.. note:: OroCommerceMcpBundle is available in the Enterprise edition only.

Use ``OroCommerceMcpBundle`` to connect AI applications, such as |Visual Studio Code| or |ChatGPT|, to the OroCommerce back-office.

``OroCommerceMcpBundle`` adds a |Model Context Protocol| (MCP) server to the OroCommerce back-office by using the official MCP software development kit (SDK) |mcp/sdk|. The bundle makes OroCommerce data and actions available to AI applications as MCP tools through an HTTP endpoint. An AI application can connect to the server, view the available tools, select the tool that matches the user’s request, and use it to read or update OroCommerce data.

.. note:: OroCommerceMcpBundle provides access to the back-office API. To connect an AI application to storefront operations, use :ref:`OroFrontendCommerceMcpBundle <bundle-docs-frontend-commerce-commerce-mcp-bundle>`.


Key Concepts
------------

MCP is an open standard protocol that enables AI applications to connect to external data, tools, and workflows without custom integration code for each application.

In an OroCommerce integration, the main components are:

* **MCP host** --- An AI application, such as **Visual Studio Code** or **ChatGPT**, that a user interacts with directly. The host creates one MCP client for each MCP server it connects to, and its language model decides which tool, prompt, or resource to use for a given request.
* **MCP client** --- The component that the MCP host creates to maintain a dedicated connection to one MCP server. In an OroCommerce integration, the host creates an MCP client to connect to the OroCommerce MCP server.
* **MCP server** --- The part of ``OroCommerceMcpBundle`` that receives requests from an MCP client and returns the requested information or operation result through an HTTP connection.
* **Tools** --- Actions that the AI application can ask OroCommerce to perform through its MCP client, such as getting a list of orders, creating a customer, or updating an order. Most tools provided by the bundle map directly to an OroCommerce API resource and action.
* **Prompts** --- Reusable instructions or message templates that help the AI application complete a specific task. A prompt can define what information the client should use, what result it should produce, or how it should format the response.
* **Resources** --- Information that the MCP server makes available for the AI application to read, such as a document or a generated report. The AI application can use this information when preparing its response to the user.
* **Resource templates** --- Reusable resource definitions that accept values in their URI. They enable an AI application to request a specific resource by providing the required value, such as an identifier. Support depends on the MCP SDK version included in the OroCommerce release.

The bundle supports two ways to create MCP tools:

* **API-based tools** --- Define a tool in a YAML configuration file. The bundle creates the tool from an existing OroCommerce API resource and action. Use this option for standard create, read, update, and delete  (CRUD) operations. See `Create Custom API-Based Tools`_.
* **Custom capabilities** --- Create a PHP class and add an MCP attribute. Use this option when you need custom logic or when a tool, prompt, or resource cannot use a single OroCommerce API action. See `Create Custom Capabilities With PHP Attributes`_.

The bundle also supports two response formats for API-based tools.

* **JSON:API format** --- The default format. Responses follow the JSON:API specification, with fields nested under ``attributes`` and related entities nested under ``relationships``.
* **Plain format** --- A flattened response format designed for AI applications. It places fields and related data at the same level and adds the entity name to each field name. See `Use the Plain Response Format`_.

.. note:: Both formats provide access to the same API resources. Choose the format that works best with your AI application.

Connect an AI Application
-------------------------

The OroCommerce MCP server uses OAuth 2.0 Authorization Code authentication.

To connect an AI application to OroCommerce:

1. Create a separate OAuth application for each AI application in the back-office.
2. Configure the AI application with the MCP server URL. AI applications that support OAuth server metadata, such as Visual Studio Code, discover the authentication settings automatically. For AI applications that do not support this metadata, provide the OAuth Client ID and Client Secret manually.

The OAuth application setup is the same for every AI application. Only the redirect URL and a few application-specific fields differ.

Create the OAuth Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a new :ref:`OAuth application <oauth-applications>` in Oro:

1. Navigate to **System > User Management > OAuth Applications** in the back-office.
2. Click **Create OAuth Application**.
3. Enter a descriptive name, for example, ``Commerce MCP Server``.
4. Select **Active**.
5. Clear **Support all APIs**.
6. In **Supported APIs**, select **Commerce MCP Server**.
7. Set **Grant Type** to **Authorization Code**.
8. Add the redirect URL required by your AI application.

.. csv-table::
   :header: "**AI Application**","**Redirect URL**"

   "Visual Studio Code","``http://127.0.0.1:33418/`` and ``https://vscode.dev/redirect``"
   "ChatGPT","``https://chatgpt.com/connector_platform_oauth_redirect``"

9. Clear **Confidential Client** (e.g., for VS code) unless your AI application requires a confidential OAuth application.
10. Toggle **Skip User Consent** to enable or skip user login consent screen.
11. Click **Save and Close**. Create a new OAuth application with the following settings:

Once saved, the system will generate the **Client ID** and **Client Secret** for the OAuth application. Copy both values, because you need them when you configure the AI application.

Connect Visual Studio Code
^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In your VS Code project, create or open the ``.vscode/mcp.json`` file.
2. Add an entry for the OroCommerce MCP server:

.. code-block:: json

    {
      "servers": {
        "oro-commerce-mcp": {
          "type": "http",
          "url": "https://yourapplication/{backend_prefix}/commerce-mcp"
        }
      }
    }

3. Replace ``{backend_prefix}`` with your back-office URL prefix. By default, it is ``admin``.
4. Save the file and reload the MCP server list in Visual Studio Code.

Connect ChatGPT
^^^^^^^^^^^^^^^

.. important:: Connecting a custom MCP application in ChatGPT requires a ChatGPT plan that supports developer mode connectors. Verify your plan before you continue.

1. In ChatGPT, open developer mode and create a new MCP application.
2. Enter a **Name**, for example, ``OroCommerce``.
3. Set **MCP Server URL** to ```https://yourapplication/{backend_prefix}/commerce-mcp``, where ``{backend_prefix}`` is the prefix of your back-office (by default, it is ``admin``).
4. Set **Authentication** to **OAuth**.
5. Enter the **OAuth Client ID** and **OAuth Client Secret** from the OAuth application that you created.
6. Save the MCP application.

Connect Claude
^^^^^^^^^^^^^^

.. important:: Connecting a custom MCP server in Claude requires the Claude CLI (Claude Code). Verify that Claude CLI is installed before you continue.

Create an OAuth application for Claude with the following settings:

.. csv-table::
   :header: "**Field**","**Value**"

   "Application Name","A descriptive name, for example ``Commerce MCP Server``"
   "Active","On"
   "Support all APIs","Off"
   "Supported APIs","``Commerce MCP Server``"
   "Grant Type","``Authorization Code``"
   "Redirect URLs","``http://localhost:8090/callback``"
   "Confidential Client","Off"
   "Skip User Consent","On or off, depending on whether you want the login consent screen"

Once the OAuth application is saved, copy the generated **Client ID**.

To add the OroCommerce MCP server to Claude, run the following command in the Claude CLI:

.. code-block:: bash

    claude mcp add --transport http --scope user --callback-port 8090 --client-id Your_CLIENT_ID oro-commerce-mcp https://yourapplication/{backend_prefix}/commerce-mcp

Replace ``Your_CLIENT_ID`` with the Client ID from your OAuth application, and ``{backend_prefix}`` with your back-office URL prefix. By default, it is ``admin``.

.. note:: The callback port in the command (``8090``) must match the port used in the OAuth application's redirect URL.

Configure API-Based Tools
-------------------------

OroCommerceMcpBundle provides a starting set of API-based tools out of the box. Use **API-based tools** when the required operation already exists in the Oro API. Use a **custom PHP capability** described under `Create Custom Capabilities With PHP Attributes`_ when the operation requires custom application logic that cannot be represented by an existing API action.

The following tables list the tools grouped by entity with the related description. An administrator can add, remove, or restrict tools by editing the ``Resources/config/oro/commerce_mcp_api_based_tools.yml`` file in the bundle or ``config/commerce_mcp_api_based_tools.yml`` of your application . See `Create Custom API-Based Tools`_.

.. csv-table::
   :header: "**Entity**","**Action**","**Tool Name**","**Description**"

   "Customer","``get_list``","``get_customers``","Gets the list of customers"
   "Customer","``get_count``","``get_customer_count``","Gets the number of customers"
   "Customer","``get``","``get_customer``","Gets a customer by ID"
   "Customer","``create``","``create_customer``","Creates a new customer. The created customer is returned in the response"
   "Customer","``update``","``update_customer``","Updates a customer. The updated customer is returned in the response"
   "Customer","``delete``","``delete_customer``","Deletes a customer"
   "CustomerUser","``get_list``","``get_customer_users``","Gets the list of customer users"
   "CustomerUser","``get_count``","``get_customer_user_count``","Gets the number of customer users"
   "CustomerUser","``get``","``get_customer_user``","Gets a customer user by ID"
   "CustomerUser","``create``","``create_customer_user``","Creates a new customer user. The created customer user is returned in the response"
   "CustomerUser","``update``","``update_customer_user``","Updates a customer user. The updated customer user is returned in the response"
   "CustomerUser","``delete``","``delete_customer_user``","Deletes a customer user"
   "CustomerPrice","``get_list``","``get_customer_product_prices``","Gets a customer's product prices. This tool requires the ``['customer', 'product']`` filters"
   "Order","``get_list``","``get_orders``","Gets the list of orders"
   "Order","``get_count``","``get_order_count``","Gets the number of orders"
   "Order","``get``","``get_order``","Gets an order by ID"
   "Order","``create``","``create_order``","Creates a new order. The created order is returned in the response"
   "Order","``update``","``update_order``","Updates an order. The updated order is returned in the response"
   "OrderLineItem","``create``","``add_order_line_item``","Adds a line item to an existing order. The added line item is returned in the response"
   "OrderLineItem","``delete``","``remove_order_line_item``","Removes a line item from an existing order"


Create Custom API-Based Tools
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

An API-based tool exposes one action, such as ``get_list`` or ``create``, on one OroCommerce API resource. Define API-based tools in  ``Resources/config/oro/commerce_mcp_api_based_tools.yml`` in any bundle or ``config/commerce_mcp_api_based_tools.yml`` of your application.

Example Configuration
~~~~~~~~~~~~~~~~~~~~~

The following example defines the tools for the ``Order`` entity:

.. code-block:: yaml

    api_based_mcp_tools:
        Oro\Bundle\OrderBundle\Entity\Order:
            get_list:
                name: 'get_orders'
                title: 'Get Orders'
                description: 'Gets the list of orders.'

Configuration Reference
~~~~~~~~~~~~~~~~~~~~~~~

The complete configuration options available in this configuration file are:

.. code-block:: yaml

    api_based_mcp_tools:

        # Prototype
        # The fully qualified class name of the OroCommerce entity that the tool exposes, for example, ``Oro\Bundle\OrderBundle\Entity\Order``
        entity_class:

            # Prototype
            # Supported API actions: get_list, get_count, get, create, update, delete. Each action that you configure becomes a separate MCP tool.
            api_action:

                # The name of the MCP tool, for example, ``get_orders``.
                name:                 ~ # Required

                # A human-readable title for the MCP tool, for example, ``Get Orders``.
                title:                ~

                # The description of the MCP tool. AI applications use this description to decide when to call the tool, so write a specific, unambiguous description.
                description:          ~ # Required

                # The list of required filters for the MCP tool. Use this option to prevent an AI application from running an unfiltered requests for a large or sensitive resource.
                required_filters:     []

.. note:: API-based tools follow the permissions and validation rules of the related OroCommerce API resource. An AI application cannot use a tool to access or change data that the authenticated user is not allowed to access.

Restrict the Fields a Tool Returns
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, an API-based tool can return all fields available for the related API resource. Use ``commerce_mcp_default_fields.yml`` to restrict the returned fields. This keeps responses smaller and prevents the AI application from receiving unnecessary data, such as an internal identifier or an unrelated relationship.

The following example restricts the ``Order`` entity to four fields:

.. code-block:: yaml

    default_fields:
        Oro\Bundle\OrderBundle\Entity\Order:
            - poNumber
            - currency
            - totalValue
            - lineItems


:ref:`The API request type aspect <api-request-type>` for the API-based MCP tools is ``commerce_mcp``.


Use the Plain Response Format
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, MCP tools use the |JSON:API specification| for request and response data. You can also configure the MCP server to use the simpler **plain format**.

To switch to the plain format, use the ``https://yourapplication/{backend_prefix}/commerce-mcp-plain`` MCP server URL instead of the ``https://yourapplication/{backend_prefix}/commerce-mcp``.

The **JSON format** groups entity fields under ``attributes`` and related entities under ``relationships``.

The **plain format** uses a flatter structure that some AI applications can process more reliably. It places fields and related data at the same level and prefixes each field name with the entity name.

For example, JSON places an ``order currency`` under ``attributes``. The plain format returns the same value as ``order_currency``. It returns a related customer as an inline object named ``order_customer``.

Here are the request data in both formats:

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



Configuration Reference
~~~~~~~~~~~~~~~~~~~~~~~

Configure the plain format in ``commerce_mcp_plain_json_api.yml``:

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

                    # API actions to which the field configuration is applied.
                    actions:              ~

                    exclusion_policy:     ~
                    field_name_prefix:    ~
                    fields:
                        # Prototype
                        field_name:
                            exclude:              ~
                            expand:               ~
                            actions:              ~
                            exclusion_policy:     ~
                            field_name_prefix:    ~
                            fields:
                                # Prototype
                                field_name:
                                    exclude:              ~
                                    expand:               ~
                                    actions:              ~


:ref:`The API request type aspect <api-request-type>` for the API-based MCP tools in the plain format is ``commerce_mcp_plain``.

Create Custom Capabilities With PHP Attributes
----------------------------------------------

Use PHP attributes to create a custom MCP capability, such as ``McpTool``, ``McpPrompt``, ``McpResource`` or ``McpResourceTemplate`` when:

* the capability does not match any of the an existing OroCommerce API resource and action;
* you need custom logic that API-based tool configuration does not support.

The bundle discovers an MCP capability automatically when your class or method uses one of the following supported MCP attribute and the class is located in a configured directory under ``Resources/config/oro/app.yml`` in any bundle or ``config/config.yml`` of your application.

.. code-block:: yaml

    oro_commerce_mcp:
        discovery:
            - { base_path: 'Acme\Bundle\CommerceMcpBundle\AcmeCommerceMcpBundle', scan_dirs: ['Mcp'] }


McpTool
^^^^^^^

Use the ``McpTool`` attribute to use a PHP method as an MCP tool.

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

Set ``readOnlyHint`` to ``true`` when the tool does not modify data. An AI application can use this hint to decide whether it is safe to call the tool without additional confirmation.

McpPrompt
^^^^^^^^^

Use the ``McpPrompt`` attribute to provide a reusable prompt template that guides how an AI application responds in a specific context.

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


McpResource
^^^^^^^^^^^

Use the ``McpResource`` attribute to expose a single static resource, such as a generated document, at a fixed URI. A method marked with ``McpResource`` returns an array containing the resource ``uri``, ``mimeType``, and ``text``.


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


McpResourceTemplate
^^^^^^^^^^^^^^^^^^^

Use the ``McpResourceTemplate`` attribute to create resources whose URI includes a variable value, for example ``report://sales/{year}``. When an AI application requests a URI such as ``report://sales/2026``, the bundle extracts 2026 from the URI and passes it to the method as the ``year`` value.


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


Service-Based Capability
^^^^^^^^^^^^^^^^^^^^^^^^

When your PHP class that provides an MCP capability depends on other services, register it as a service in the ``Resources/config/services.yml`` file and add the ``oro_commerce_mcp.service`` tag. In this case, the bundle does not need to discover the class automatically from the configured directories.

    .. code-block:: yaml

        oro_acme.mcp.current_time_tool:
            class: Acme\Bundle\AcmeCommerceMcpBundle\Mcp\CurrentTimeTool
            arguments:
                - '@some_service'
            tags:
                - { name: oro_commerce_mcp.service }

Default Configuration of OroCommerceMcpBundle
---------------------------------------------

The default configuration of OroCommerceMcpBundle:

.. code-block:: yaml

    oro_commerce_mcp:
        # The application name to be exposed to AI applications.
        app: 'OroCommerce MCP Server'
        # The application version to be exposed to AI applications.
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

Most API-based tools do not require custom dependency injection (DI) tags. Use these tags only when you need to extend the MCP server.

.. csv-table::
   :header: "**Tag**","**Purpose**"

   "``oro_commerce_mcp.service``","Registers a service that provides MCP capabilities, such as tools, prompts, resources, or resource templates."
   "``oro_commerce_mcp.loader``","Adds a custom loader for MCP capability definitions. The service must implement ``Mcp\Capability\Registry\Loader\LoaderInterface``. Use the ``requestType`` tag attribute to limit the loader to a specific request type, for example, ``json_api&acme``."
   "``oro_commerce_mcp.instructions_provider``","Adds a custom provider for MCP server instructions. The service must implement ``Oro\Component\Mcp\Server\Provider\InstructionsProviderInterface``. Use the ``requestType`` tag attribute to limit the provider to a specific request type, for example, ``json_api&acme``."
   "``oro_commerce_mcp.api_tool_schema_processor``","Adds a processor for input and output schemas of API-based MCP tools. The service must implement ``Oro\Component\Mcp\Api\ApiBasedToolSchemaProcessorInterface``. Use the ``requestType`` tag attribute to limit the processor to a specific request type, for example, ``json_api&acme``."
   "``oro_commerce_mcp.api_tool_data_processor``","Adds a processor for request and response data of API-based MCP tools. The service must implement ``Oro\Component\Mcp\Api\ApiBasedToolDataProcessorInterface``. Use the ``requestType`` tag attribute to limit the processor to a specific request type, for example, ``json_api&acme``."
   "``oro_commerce_mcp.build_server_middleware``","Adds middleware that runs before the MCP server is built. The service must implement ``Oro\Component\Mcp\Server\Builder\MiddlewareInterface``."
   "``oro_commerce_mcp.http_request_middleware``","Adds middleware that runs before an MCP HTTP request is processed. The service must implement ``Psr\Http\Server\MiddlewareInterface``."
   "``oro_commerce_mcp.api_request_type_modifier``","Adds a modifier for the request type used by API-based MCP tools. The service must implement ``Oro\Component\Mcp\Api\RequestTypeModifier\ApiRequestTypeModifierInterface``."


Related Documentation
---------------------

* :ref:`Create an OAuth application in the Back-Office <oauth-applications>`
* :ref:`OroFrontendCommerceMcpBundle <bundle-docs-frontend-commerce-commerce-mcp-bundle>`
* :ref:`The API request types <api-request-type>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
