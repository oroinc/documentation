.. _bundle-docs-platform-integration-bundle-webhooks:

Webhooks
========

The OroIntegrationBundle provides webhook notification functionality for Oro applications through the ``WebhookProducerSettings`` API resource. It allows administrators to configure webhook endpoints that receive HTTP POST notifications for entity changes.

Features
--------

* **Entity Config-based**: Mark entities as webhook accessible through entity configuration
* **API**: Full REST API for managing webhook endpoints (create, read, update, delete)
* **Topic-based routing**: Each webhook subscribes to a single topic (e.g. ``order.created``) that combines the entity type and the event in one identifier
* **Extensible topics**: Register custom topics via the ``WebhookTopicCollectEvent`` event
* **Webhook Formats**: The ``format`` field selects a named request/response processing pipeline; custom formats can be registered and processed
* **Oro Back-Office**: Full CRUD interface for managing webhook endpoints
* **Secure**: Supports webhook secrets for HMAC-SHA256 payload verification

Configuration
-------------

Mark Entities as Webhook Accessible
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make an entity available for webhook notifications, configure it in the entity config with the ``webhook_accessible`` flag. There are three ways to do this:

Via PHP Attributes
~~~~~~~~~~~~~~~~~~

Configure directly in the entity class:

.. code-block:: php

    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        defaultValues: [
            'integration' => ['webhook_accessible' => true]
        ]
    )]
    class Order
    {
        // ... entity properties
    }

Via Oro Back-Office
~~~~~~~~~~~~~~~~~~~

For entities that support custom fields and entity management:

1. Navigate to **System > Entities > Entity Management**
2. Find and click on your entity (e.g., "Order")
3. Click **Edit** button
4. In the entity configuration form check the **Webhook Accessible** checkbox
5. Click **Save and Close**

Programmatically via ConfigManager
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Update existing entity configuration in code:

.. code-block:: php

    /** @var ConfigManager $configManager */
    $configManager = $container->get('oro_entity_config.config_manager');

    $integrationConfig = $configManager->getEntityConfig('integration', Order::class);
    $integrationConfig->set('webhook_accessible', true);
    $configManager->persist($integrationConfig);
    $configManager->flush();

.. important::

    1. **API Configuration**: The entity must also be properly configured for the Oro API to be serialized in webhook payloads. Ensure the entity has:

       * API resource configuration in ``Resources/config/oro/api.yml``
       * Proper field mappings and exclusions

    2. **Permissions**: Webhook notifications will respect API security and only serialize data that the webhook context has access to.

Including Relations in the Webhook Payload
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, the webhook payload contains only the direct attributes of the changed entity, serialized
as a JSON:API ``GET`` response. To embed related resources (e.g. the order's customer or line items)
in the ``included`` array of the payload, set the ``webhook_relations_includes`` entity config option
to a comma-separated list of relation names in |JSON:API include format|.

The value is passed directly as the ``?include=`` query parameter to the internal Oro API call that
serializes the entity, so any relation name accepted by the entity's API resource is valid.

Via PHP Attributes
~~~~~~~~~~~~~~~~~~

.. code-block:: php

    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        defaultValues: [
            'integration' => [
                'webhook_accessible' => true,
                'webhook_relations_includes' => 'customer,lineItems,lineItems.product',
            ]
        ]
    )]
    class Order
    {
        // ... entity properties
    }

Via Oro Back-Office
~~~~~~~~~~~~~~~~~~~

1. Navigate to **System > Entities > Entity Management**
2. Find and click on your entity
3. Click **Edit** button
4. In the **Webhook relations includes** field enter a comma-separated list of relation paths
   (e.g. ``customer,lineItems``)
5. Click **Save and Close**

Programmatically via ConfigManager
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

    $integrationConfig = $configManager->getEntityConfig('integration', Order::class);
    $integrationConfig->set('webhook_relations_includes', 'customer,lineItems');
    $configManager->persist($integrationConfig);
    $configManager->flush();

**Example payload with includes:**

When ``webhook_relations_includes`` is set to ``customer``, the notification body will contain the
customer resource in the ``included`` array:

.. code-block:: json

    {
      "topic": "order.created",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "orders",
          "id": "1",
          "attributes": { "total": "99.00" },
          "relationships": {
            "customer": { "data": { "type": "customers", "id": "5" } }
          }
        },
        "included": [
          {
            "type": "customers",
            "id": "5",
            "attributes": { "name": "Acme Corp" }
          }
        ]
      }
    }

.. note::

    Only relations that are exposed through the entity's Oro API resource can be included.
    The same API-level field exclusions and access-control rules apply to included resources
    as to the main entity — no additional data is ever leaked.

Configure Webhook Endpoints
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Webhook endpoints are managed through ``WebhookProducerSettings`` entities. Each entity defines
where notifications should be sent and which topic it subscribes to.

Using REST API
~~~~~~~~~~~~~~

The ``WebhookProducerSettings`` resource is available through the Oro REST API at
``/api/webhooks``.

**Create a webhook:**

.. code-block:: bash

    POST /api/webhooks
    Content-Type: application/vnd.api+json

    {
      "data": {
        "type": "webhooks",
        "attributes": {
          "notificationUrl": "https://example.com/webhooks/orders",
          "secret": "your-secret-key",
          "enabled": true,
          "verifySsl": true
        },
        "relationships": {
          "topic": {
            "data": {
              "type": "webhooktopics",
              "id": "order.created"
            }
          },
          "format": {
            "data": {
              "type": "webhookformats",
              "id": "default"
            }
          }
        }
      }
    }

**List all webhooks:**

.. code-block:: bash

    GET /api/webhooks

**Update a webhook:**

.. code-block:: bash

    PATCH /api/webhooks/{id}
    Content-Type: application/vnd.api+json

    {
      "data": {
        "type": "webhooks",
        "id": "{id}",
        "attributes": {
          "enabled": false
        }
      }
    }

**Delete a webhook:**

.. code-block:: bash

    DELETE /api/webhooks/{id}

**Get available webhook topics:**

The ``/api/webhooktopics`` endpoint returns all available topics. Each entry has a single ``id``
field that is the topic ID to use when creating a ``WebhookProducerSettings`` record:

.. code-block:: bash

    GET /api/webhooktopics

Response:

.. code-block:: json

    {
      "data": [
        {
          "type": "webhooktopics",
          "id": "order.created"
        },
        {
          "type": "webhooktopics",
          "id": "order.updated"
        },
        {
          "type": "webhooktopics",
          "id": "order.deleted"
        },
        {
          "type": "webhooktopics",
          "id": "product.created"
        }
      ]
    }

**Get available webhook formats:**

The ``/api/webhookformats`` endpoint returns all available formats. Each entry has a ``id``
field that is the format ID to use when creating a ``WebhookProducerSettings`` record:

.. code-block:: bash

    GET /api/webhookformats

Response:

.. code-block:: json

    {
      "data": [
        {
          "type": "webhookformats",
          "id": "default",
          "attributes": {
            "label": "Default (JSON:API)"
          }
        },
        {
          "type": "webhookformats",
          "id": "thin",
          "attributes": {
            "label": "Thin payload"
          }
        }
      ]
    }

.. note::

    Use ``/api/webhooktopics`` and ``/api/webhookformats`` endpoints to discover valid identifiers
    for the topic and the format before configuring webhooks.

Webhooks in the Back-Office
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Navigate to **System > Integrations > Webhooks** in the back-office.

Create a New Webhook
""""""""""""""""""""

1. Click **Add Webhook** button
2. Fill in the form:

   * **Notification URL** (required): Enter the webhook endpoint URL
   * **Topic** (required): Select from the dropdown of available topics
   * **Format** (required): Select the webhook format from the dropdown; the format controls how the outgoing request is built and the payload is structured (see `Webhook Formats`_)
   * **Secret** (optional): Enter a secret key for HMAC-SHA256 signature generation
   * **Enabled** (default: checked): Toggle to enable/disable the webhook
   * **Verify SSL** (default: checked): Whether to verify the TLS certificate of the notification URL
   * **Owner** (auto-filled): The user creating the webhook
   * **Organization** (auto-filled): Current organization

3. Click **Save** or **Save and Close**

**Validation:**

* URL must be a valid format
* Topic must be selected and must exist in the system
* All required fields must be filled

Users without appropriate permissions will not see the menu item or action buttons.

Programmatic Creation
~~~~~~~~~~~~~~~~~~~~~

You can also create ``WebhookProducerSettings`` entities programmatically:

.. code-block:: php

    use Oro\Bundle\IntegrationBundle\Entity\WebhookProducerSettings;

    $webhook = new WebhookProducerSettings();
    $webhook->setNotificationUrl('https://example.com/webhooks/orders');
    $webhook->setTopic('order.created');
    $webhook->setSecret('your-secret-key');
    $webhook->setEnabled(true);
    $webhook->setVerifySsl(true);
    $webhook->setFormat('default');
    $webhook->setOwner($user);
    $webhook->setOrganization($organization);

    $entityManager->persist($webhook);
    $entityManager->flush();

.. note::

    ``WebhookProducerSettings`` has an ``isSystem`` / ``setSystem()`` boolean flag (default
    ``false``). Setting it to ``true`` marks the record as a system-managed webhook, which can be
    used by ACL voters or UI code to protect it from accidental deletion or modification by
    administrators. Set this flag when creating webhooks programmatically as part of bundle
    fixtures or migrations that should not be removable through the normal Oro back-office.

.. note::

    You can create multiple ``WebhookProducerSettings`` entities for the same topic — all
    matching enabled endpoints will receive the notification.

Webhook Formats
~~~~~~~~~~~~~~~

The ``format`` field on ``WebhookProducerSettings`` is **required** and selects a named processing
pipeline that controls how the outgoing HTTP request is assembled and how the response is handled.

Available formats are registered via ``WebhookFormatProvider`` (see `Registering Custom Webhook Formats`_).
The dropdown in the back-office and the ``format`` relationship in the API both use the format key
returned by the provider.

When a webhook notification is dispatched, the sender:

1. Builds a default ``WebhookRequestContext`` containing the JSON payload, HTTP method (``POST``),
   default headers (``Content-Type``, ``Webhook-Topic``, ``Webhook-Id``), default request options
   (SSL verification, no redirects), and entity metadata (``entity_class`` / ``entity_id``).
2. Passes the context to the ``WebhookRequestProcessorInterface`` implementation registered for the
   selected format. The processor may modify the payload, headers, HTTP method, or any other part
   of the context before the request is sent.
3. Sends the HTTP request using the (potentially modified) context.
4. Passes the response through the ``WebhookResponseProcessor`` chain (success, 410 Gone,
   retryable errors, fallback) to determine the delivery outcome.

**Built-in formats**

+---------------------+-------------------------------------------------------+
| Format key          | Description                                           |
+=====================+=======================================================+
| ``default``         | Full JSON:API payload — sends ``attributes``,         |
|                     | ``relationships``, and any ``included`` resources     |
|                     | configured via ``webhook_relations_includes``.        |
+---------------------+-------------------------------------------------------+
| ``thin``            | Thin payload — strips ``attributes``,                 |
|                     | ``relationships``, and ``included`` from the payload  |
|                     | so only ``type`` and ``id`` are sent inside ``data``. |
|                     | Useful when the receiver only needs to know that a    |
|                     | change occurred and will fetch the full record itself.|
+---------------------+-------------------------------------------------------+

**Thin-payload example** (``thin`` format):

.. code-block:: json

    {
      "topic": "order.created",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "orders",
          "id": "42"
        }
      }
    }

How It Works
------------

1. **Entity Configuration**: Entities are marked as webhook accessible through entity config with the ``webhook_accessible`` flag in the ``integration`` scope
2. **Topic Discovery**: ``WebhookConfigurationProvider`` reads entity configurations and builds ``WebhookTopic`` objects for each entity/event combination (e.g. ``order.created``, ``order.updated``, ``order.deleted``). After collecting entity-based topics it dispatches the ``oro_integration.webhook_topic_collect`` (``WebhookTopicCollectEvent``) event, allowing third-party bundles to add custom topics. The final collection is exposed via ``/api/webhooktopics``
3. **Endpoint Registration**: Administrators create ``WebhookProducerSettings`` entities via API or UI to define notification endpoints, the topic each one subscribes to, and the **format** that governs request/response processing
4. **Event Detection**: When a webhook-accessible entity is created, updated, or deleted, Doctrine entity listeners are triggered
5. **Endpoint Lookup**: Active ``WebhookProducerSettings`` entities matching the topic are retrieved from the database
6. **Entity Serialization**: The entity is serialized in JSON:API format using the Oro API entity serializer via ``JsonApiFormatWebhookEventDataProvider``
7. **Message Queuing**: A webhook notification message (including topic, event data, timestamp, message ID, and entity metadata) is sent to the message queue for async processing
8. **Fan-Out**: ``WebhookNotificationProcessor`` creates a child MQ job for each matching endpoint so deliveries are independent; entity metadata (``entity_class`` / ``entity_id``) is forwarded in each child message
9. **Request Processing**: ``WebhookNotificationSender`` builds a ``WebhookRequestContext`` with the default payload, headers, and request options, then passes it to the ``WebhookRequestProcessorInterface`` registered for the webhook's format. The processor may modify any part of the context (e.g. ``ThinPayloadWebhookRequestProcessor`` strips ``attributes`` and ``relationships`` from the payload)
10. **Signature Generation**: If a secret is configured, the final serialised payload is signed with HMAC-SHA256 and the signature is appended to the request headers. This happens after the request processor runs, so the signature always covers the final (possibly modified) payload
11. **HTTP Delivery**: The (potentially modified) context is used to send a POST request to the endpoint URL
12. **Response Processing**: The response is passed through a ``WebhookResponseProcessor`` chain -- ``SuccessWebhookResponseProcessor`` (2xx), ``HttpGoneWebhookResponseProcessor`` (410 — permanently removes the endpoint), ``RetryableErrorWebhookResponseProcessor`` (429/5xx — triggers MQ redelivery), ``FallbackWebhookResponseProcessor`` (all other errors)
13. **Delivery Logging**: Successes and failures are logged to the ``webhook`` monolog channel

Sending Webhook Notifications
------------------------------

There are three ways to trigger outbound webhook notifications, each suited to a different use case.

Automatic Entity Event Notifications
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The most common approach requires no custom code. The ``WebhookEntityListener`` Doctrine listener
automatically sends notifications whenever a ``webhook_accessible`` entity is **created**,
**updated**, or **deleted**.

The listener fires at low priority (``-1024``) after all other Doctrine listeners have run, ensuring
that all relations are fully persisted before serialization begins. For ``postPersist`` events,
delivery is further deferred to the ``postFlush`` stage for the same reason.

.. note::

    The three operations hook into different Doctrine events:

    * **Create** — ``postPersist`` (deferred to ``postFlush`` so all cascade relations are saved first)
    * **Update** — ``postUpdate`` (fired immediately after flush)
    * **Delete** — ``preRemove`` (fired *before* the row is deleted, so the entity is still in the database and can be serialized)

    For ``delete`` notifications the entity is serialized while it still exists. If your receiver
    needs to confirm deletion through the API, the entity will no longer be there by the time the
    async MQ message is processed.

There is nothing to configure beyond marking the entity with ``webhook_accessible: true``
(see `Mark Entities as Webhook Accessible`_). Notifications are only dispatched when at least one
enabled ``WebhookProducerSettings`` record matching the topic exists in the database, no overhead
is incurred otherwise.

Custom Notifications via WebhookNotifier
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Inject ``WebhookNotifierInterface`` (service ``oro_integration.webhook_notifier``) to send
notifications from your own code, for example, from a command, a message queue processor, or a
business-logic service.

Two methods are available:

* ``sendEntityEventNotification(string $topic, object $entity)``: Use this when you have a Doctrine-managed entity. The notifier serializes it via the Oro API
    serializer before queuing. The ``$topic`` is the combined topic name, e.g. ``order.created``.

* ``sendNotification(string $topic, array $eventData)``: Use this when you have already prepared the payload array, or when the data does not correspond
    to a single entity (e.g. aggregated data, external data).

Both methods are no-ops when no active ``WebhookProducerSettings`` records match the given topic,
so it is safe to call them unconditionally in hot paths.

**Example — notifying from a service:**

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\Service;

    use Oro\Bundle\IntegrationBundle\Model\WebhookNotifierInterface;

    class OrderFulfillmentService
    {
        public function __construct(
            private WebhookNotifierInterface $webhookNotifier
        ) {
        }

        public function fulfillOrder(Order $order): void
        {
            // ... business logic ...

            // Notify external subscribers. The topic must match a registered WebhookTopic name.
            $this->webhookNotifier->sendEntityEventNotification(
                'order.shipped', // topic name
                $order
            );
        }

        public function importOrders(array $orderData): void
        {
            // ... import logic ...

            // Notify with a pre-built payload when no entity is available.
            $this->webhookNotifier->sendNotification(
                'order_import.completed',
                [
                    'importedCount' => count($orderData),
                    'timestamp'     => time(),
                ]
            );
        }
    }

Register the service with ``WebhookNotifierInterface`` injected:

.. code-block:: yaml

    services:
        oro_example.service.order_fulfillment:
            class: Oro\Bundle\ExampleBundle\Service\OrderFulfillmentService
            arguments:
                - '@oro_integration.webhook_notifier'

Custom Notifications via Event Dispatcher
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you cannot or prefer not to inject ``WebhookNotifierInterface`` directly (for example inside
a Symfony event listener that already receives the event dispatcher) dispatch the
``oro_integration.webhook_notify`` event (``WebhookNotifyEvent``) instead. The built-in
``WebhookNotificationEventListener`` listens to this event and forwards it to ``WebhookNotifier``
automatically.

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\EventListener;

    use Oro\Bundle\IntegrationBundle\Event\WebhookNotifyEvent;
    use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

    class SomeEventListener
    {
        public function __construct(
            private EventDispatcherInterface $eventDispatcher
        ) {
        }

        public function onSomethingHappened(): void
        {
            // ... handle the event ...

            $this->eventDispatcher->dispatch(
                new WebhookNotifyEvent(
                    'product.price_updated',              // topic name
                    ['sku' => 'SKU-001', 'price' => '19.99'] // pre-built payload
                ),
                WebhookNotifyEvent::NAME   // 'oro_integration.webhook_notify'
            );
        }
    }

``WebhookNotifyEvent`` accepts two arguments: ``$topic`` and ``$eventData``, the same as
``sendNotification()``. The listener can also be disabled programmatically (e.g., during bulk
imports) by calling ``setEnabled(false)`` on the ``Oro\Bundle\IntegrationBundle\EventListener\WebhookNotificationEventListener`` service.

.. note::

    All three mechanisms ultimately route through ``WebhookNotifier``, which checks for active
    ``WebhookProducerSettings`` records matching the topic, then pushes a
    ``SendWebhookNotificationTopic`` message to the message queue. The actual HTTP delivery is
    performed asynchronously by the queue consumer via ``WebhookNotificationSender``.

Extending Webhook Topics
------------------------

Out-of-the-box, ``WebhookConfigurationProvider`` automatically creates a ``WebhookTopic`` for every
entity/event combination where the entity has ``webhook_accessible: true`` set, covering the three
standard events ``created``, ``updated``, and ``deleted`` (e.g., ``order.created``, ``order.updated``,
``order.deleted``).

To register a **custom topic** for a non-entity event or a domain-specific action listen to
the ``oro_integration.webhook_topic_collect`` event (``WebhookTopicCollectEvent``) and add your
topic to its collection.

Adding a Custom Topic via Event Listener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a listener that calls ``$event->addTopic()`` with a new ``WebhookTopic`` instance:

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\EventListener;

    use Oro\Bundle\IntegrationBundle\Event\WebhookTopicCollectEvent;
    use Oro\Bundle\IntegrationBundle\Model\WebhookTopic;

    /**
     * Registers the custom "order.shipped" topic.
     */
    class OrderShipmentWebhookTopicListener
    {
        public function onWebhookTopicCollect(WebhookTopicCollectEvent $event): void
        {
            $event->addTopic(new WebhookTopic(
                'order.shipped',                                    // topic name used as the identifier
                ['entityClass' => \Acme\Bundle\Entity\Order::class] // optional metadata
            ));
        }
    }

Register it as a tagged service:

.. code-block:: yaml

    services:
        oro_example.event_listener.order_shipment_webhook_topic:
            class: Oro\Bundle\ExampleBundle\EventListener\OrderShipmentWebhookTopicListener
            tags:
                - { name: kernel.event_listener, event: oro_integration.webhook_topic_collect, method: onWebhookTopicCollect }

After registering the listener, the new topic will:

* Appear in the **Topic** dropdown of the **Add Webhook** back-office form.
* Be returned by the ``GET /api/webhooktopics`` endpoint.

.. note::

    ``addTopic()`` uses the topic ``name`` as the array key, so registering a topic with an
    existing name will silently **replace** it. This can be used intentionally to override a
    built-in entity topic, but take care to avoid accidental name collisions.

Registering Custom Webhook Formats
----------------------------------

Each webhook format consists of:

* A **key** (string) stored in ``WebhookProducerSettings.format`` and used to look up the
  associated ``WebhookRequestProcessorInterface`` service.
* A **label** displayed in the **Webhook Format** dropdown in the back-office.
* A **``WebhookRequestProcessorInterface`` implementation** called during delivery to modify
  the ``WebhookRequestContext`` (payload, headers, HTTP method, request options) before the
  HTTP request is sent.

Formats are registered in two steps: expose the format key/label via ``WebhookFormatProvider``
and register the corresponding request processor service.

Step 1: Register the Format Key and Label
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add a method call to the existing ``oro_integration.webhook_format_provider`` service definition
via a ``CompilerPass`` in your bundle.

Create a compiler pass:

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\DependencyInjection\Compiler;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    class AddWebhookFormatCompilerPass implements CompilerPassInterface
    {
        public function process(ContainerBuilder $container): void
        {
            $container->getDefinition('oro_integration.webhook_format_provider')
                ->addMethodCall('addFormat', [
                    'my_custom_format',
                    'acme.integration.webhook.custom_format.label'
                ]);
        }
    }

Remember to register the compiler pass in your bundle class.

The label value (``'acme.integration.webhook.custom_format.label'``) is a translation key that
will be passed through the translator when displayed in the back-office dropdown.

Step 2: Implement and Register the Request Processor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The **request processor** is the central extension point for controlling exactly how an outbound
webhook HTTP request is assembled. Before the HTTP client sends the request, the sender
constructs a ``WebhookRequestContext`` object that captures every mutable aspect of the
forthcoming request and passes it together with the ``WebhookProducerSettings`` entity and the
unique ``$messageId`` to the processor. The processor may freely read and rewrite any part of
the context. The (possibly modified) context is then used verbatim to build and send the request.

**WebhookRequestContext properties**

* ``payload`` — ``getPayload()`` / ``setPayload()``
    Full JSON body that will be serialised and sent. The top-level structure is
    ``{topic, timestamp, messageId, eventData}``. The ``eventData`` value is in
    **JSON:API format** — it contains a ``data`` object with ``type``, ``id``,
    ``attributes``, and ``relationships`` keys, plus an optional ``included`` array
    for related resources. Processors may modify individual keys, strip fields (as
    ``ThinPayloadWebhookRequestProcessor`` does), or replace the entire payload with
    a custom structure.

* ``httpMethod`` — ``getHttpMethod()`` / ``setHttpMethod()``
    ``"POST"`` by default. Override to use a different HTTP verb if the receiving
    endpoint requires it.

* ``headers`` — ``getHeaders()`` / ``setHeaders()``
    Default headers: ``Content-Type: application/json``, ``Webhook-Topic: <topic>``,
    ``Webhook-Id: <messageId>``. HMAC signature headers are appended *after* the
    processor runs, so they will always reflect the final payload.

* ``requestOptions`` — ``getRequestOptions()`` / ``setRequestOptions()``
    Symfony HttpClient options. Defaults: ``verify_peer`` and ``verify_host`` driven
    by ``WebhookProducerSettings::isVerifySsl()``, ``max_redirects: 0``.

* ``metadata`` — ``getMetadata()`` / ``setMetadata()``
    Contextual data forwarded from the MQ message. For entity-based topics this
    contains ``entity_class`` (FQCN string) and ``entity_id`` (integer); both are
    ``null`` for custom (non-entity) topics. Use this for format-specific logic that
    depends on the source entity type.

Create a class implementing ``WebhookRequestProcessorInterface`` and tag it so the
``WebhookRequestProcessor`` service locator can resolve it by the format key:

.. code-block:: php

    namespace Acme\Bundle\ExampleBundle\Model\WebhookRequestProcessor;

    use Oro\Bundle\IntegrationBundle\Entity\WebhookProducerSettings;
    use Oro\Bundle\IntegrationBundle\Model\WebhookRequestProcessor\WebhookRequestContext;
    use Oro\Bundle\IntegrationBundle\Model\WebhookRequestProcessor\WebhookRequestProcessorInterface;

    /**
     * Custom request processor for the "my_custom_format" webhook format.
     */
    class MyCustomWebhookRequestProcessor implements WebhookRequestProcessorInterface
    {
        public function process(
            WebhookRequestContext $context,
            WebhookProducerSettings $webhook,
            string $messageId,
            bool $throwExceptionOnError = false
        ): void {
            // Example: add a custom header
            $headers = $context->getHeaders();
            $headers['X-Custom-Header'] = 'custom-value';
            $context->setHeaders($headers);

            // Example: modify or wrap the payload in JSON:API format
            $payload = $context->getPayload();
            $payload['customField'] = 'customValue';
            $context->setPayload($payload);
        }
    }

Register the processor with the ``oro_integration.webhook_request_processor`` tag, using the
format key as the ``format`` attribute:

.. code-block:: yaml

    services:
        oro_example.webhook_request_processor.my_custom_format:
            class: Oro\Bundle\ExampleBundle\Model\WebhookRequestProcessor\MyCustomWebhookRequestProcessor
            tags:
                - { name: oro_integration.webhook_request_processor, format: my_custom_format }

After registration the new format will:

* Appear in the **Webhook Format** dropdown in the back-office and be accepted by the ``format``
  relationship in the REST API.
* Be used as the request-processing pipeline whenever a ``WebhookProducerSettings`` record
  with ``format: my_custom_format`` is dispatched.

Customizing Webhook Response Processing
---------------------------------------

After the HTTP request is sent, the response is passed through a **chain** of
``WebhookResponseProcessorInterface`` implementations. Each processor declares which responses it
can handle via ``supports()``, and the chain stops at the first matching processor.

WebhookResponseProcessorInterface
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: php

    interface WebhookResponseProcessorInterface
    {
        /**
         * Processes the response.
         * Returns true when the delivery is considered successful, false otherwise.
         * May throw an exception when $throwExceptionOnError is true.
         */
        public function process(
            ResponseInterface $response,
            WebhookProducerSettings $webhook,
            string $messageId,
            bool $throwExceptionOnError = false
        ): bool;

        /**
         * Returns true when this processor can handle the given response.
         */
        public function supports(ResponseInterface $response, WebhookProducerSettings $webhook): bool;
    }

Built-in Response Processors
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following processors are registered by default, evaluated in priority order:

* ``SuccessWebhookResponseProcessor``

    **Handles:** 2xx status codes.

    **Behaviour:** Logs success, returns ``true``.

* ``HttpGoneWebhookResponseProcessor``

    **Handles:** ``410 Gone``.

    **Behaviour:** Deletes the ``WebhookProducerSettings`` record and returns ``true``.

* ``RetryableErrorWebhookResponseProcessor``

    **Handles:** Status codes the configured retry strategy marks as retryable (e.g. 429, 5xx).

    **Behaviour:** Logs a warning; when ``$throwExceptionOnError`` is ``true``, throws
    ``RetryableWebhookDeliveryException`` (triggers MQ redelivery with a delay).

* ``FallbackWebhookResponseProcessor``

    **Handles:** Any response not matched above (``supports()`` always returns ``true``).

    **Behaviour:** Logs a warning; when ``$throwExceptionOnError`` is ``true``, throws
    ``WebhookDeliveryException``.

Registering a Custom Response Processor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To intercept a specific HTTP status code or add custom business logic after delivery, implement
``WebhookResponseProcessorInterface`` and tag the service with
``oro_integration.webhook_response_processor``. Use the ``priority`` tag attribute to control
position in the chain — higher priority runs first. Register it **before** the fallback processor
(which has the lowest priority and always returns ``true`` from ``supports()``).

.. code-block:: php

    namespace Acme\Bundle\ExampleBundle\Model\WebhookResponseProcessor;

    use Oro\Bundle\IntegrationBundle\Entity\WebhookProducerSettings;
    use Oro\Bundle\IntegrationBundle\Model\WebhookResponseProcessor\WebhookResponseProcessorInterface;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Contracts\HttpClient\ResponseInterface;

    /**
     * Handles 202 Accepted responses that require polling for a final result.
     */
    class AcceptedWebhookResponseProcessor implements WebhookResponseProcessorInterface
    {
        public function process(
            ResponseInterface $response,
            WebhookProducerSettings $webhook,
            string $messageId,
            bool $throwExceptionOnError = false
        ): bool {
            // Schedule a follow-up poll, fire a domain event, etc.
            return true;
        }

        public function supports(ResponseInterface $response, WebhookProducerSettings $webhook): bool
        {
            return $response->getStatusCode() === Response::HTTP_ACCEPTED;
        }
    }

.. code-block:: yaml

    services:
        acme_example.webhook_response_processor.accepted:
            class: Acme\Bundle\ExampleBundle\Model\WebhookResponseProcessor\AcceptedWebhookResponseProcessor
            tags:
                - { name: oro_integration.webhook_response_processor, priority: 10 }

.. note::

    The ``FallbackWebhookResponseProcessor`` has the lowest priority and acts as a catch-all.
    Always give your custom processor a higher priority so that it is evaluated before the
    fallback, and keep ``supports()`` as specific as possible to avoid unintended interception
    of other status codes.

Webhook Payload Format
----------------------

When an event occurs, the following JSON payload is sent to the configured URL as an HTTP POST
request.

**HTTP Headers:**

* ``Content-Type: application/json``
* ``Webhook-Topic: order.created`` (the topic name)
* ``Webhook-Id: <uuid>`` (unique message ID; use this to deduplicate replayed deliveries)
* ``Webhook-Signature: <hmac-sha256-hex>`` (only present when a secret is configured)
* ``Webhook-Signature-Algorithm: HMAC-SHA256`` (only present when a secret is configured)

**Body:**

.. code-block:: json

    {
      "topic": "order.created",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "orders",
          "id": "42",
          "attributes": { "total": "99.00" }
        }
      }
    }

The ``eventData`` structure mirrors the JSON:API ``GET`` response for the entity. The exact
content depends on the webhook ``format``: for example, the ``thin`` format sends only
``type`` and ``id`` inside ``data`` (see `Webhook Formats`_).

Verifying Webhook Signatures
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When a secret is set on a ``WebhookProducerSettings`` record, every delivery includes an
``HMAC-SHA256`` signature of the raw JSON body. To verify it on the receiving end:

.. code-block:: php

    $payload = file_get_contents('php://input');
    $receivedSignature = $_SERVER['HTTP_WEBHOOK_SIGNATURE'];
    $secret = 'your-webhook-secret'; // Same as configured in WebhookProducerSettings

    $expectedSignature = hash_hmac('sha256', $payload, $secret);

    if (hash_equals($expectedSignature, $receivedSignature)) {
        // Signature is valid
    } else {
        // Invalid signature - reject the request
    }

Automatic Endpoint Removal (410 Gone)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If the receiving server responds with HTTP ``410 Gone``, the ``WebhookProducerSettings`` record is
automatically deleted from the database. This is a standard mechanism for a receiver to permanently
unsubscribe from notifications without requiring any action from the Oro side.

**One-time webhook pattern**

You can use this behaviour to implement single-use (fire-and-forget) webhooks. Create a
``WebhookProducerSettings`` via the API, configure the endpoint to return ``410`` after it
processes the very first delivery, and it will be cleaned up automatically:

.. code-block:: bash

    # 1. Register a one-time webhook
    POST /api/webhooks
    Content-Type: application/vnd.api+json

    {
      "data": {
        "type": "webhooks",
        "attributes": {
          "notificationUrl": "https://example.com/hooks/one-time-callback",
          "enabled": true
        },
        "relationships": {
          "topic": {
            "data": {
              "type": "webhooktopics",
              "id": "order.created"
            }
          },
          "format": {
            "data": {
              "type": "webhookformats",
              "id": "default"
            }
          }
        }
      }
    }

The endpoint at ``https://example.com/hooks/one-time-callback`` should return ``HTTP 410 Gone``
after handling the first request. Oro will automatically remove the ``WebhookProducerSettings``
record on that response, so no further notifications are sent.

WebhookConsumerSettings — Integration-Specific Incoming Webhooks
----------------------------------------------------------------

``WebhookConsumerSettings`` provides a way to add incoming webhook functionality directly to
integration configurations. This approach is ideal for payment gateways, external APIs, or any
integration that needs to receive callbacks from third-party services.

When to Use WebhookConsumerSettings vs WebhookProducerSettings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* **WebhookProducerSettings**: Push notifications TO external systems when YOUR entities change
* **WebhookConsumerSettings**: Receive callbacks FROM external systems INTO your integration

How the Consume URL Works
^^^^^^^^^^^^^^^^^^^^^^^^^

When a transport settings entity holds a ``WebhookConsumerSettings`` record, the form widget
renders its UUID as a ready-to-use webhook endpoint:

.. code-block:: text

    /webhook/consume/{uuid}

The ``WebhookController`` at that route looks up the ``WebhookConsumerSettings`` by UUID, verifies
it is enabled, and delegates to the registered ``WebhookProcessorInterface`` implementation.

Implementation Pattern
^^^^^^^^^^^^^^^^^^^^^^

The implementation requires four steps: implementing the webhook processor, making the transport
entity webhook-aware, adding the webhook field to the form, and displaying the URL in the template.

Step 1: Implement Webhook Processor
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Create a service implementing ``WebhookProcessorInterface``:

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\Model;

    use Oro\Bundle\IntegrationBundle\Entity\WebhookConsumerSettings;
    use Oro\Bundle\IntegrationBundle\Processor\WebhookProcessorInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * Handles the processing of incoming Example-related webhook requests.
     */
    class WebhookProcessor implements WebhookProcessorInterface
    {
        private const string WEBHOOK_PROCESSOR_NAME = 'example_webhook_processor';

        public function __construct(
            private LoggerInterface $logger,
            private ExamplePaymentMethodsProvider $paymentMethodsProvider
        ) {
        }

        public static function getName(): string
        {
            return self::WEBHOOK_PROCESSOR_NAME;
        }

        public function process(WebhookConsumerSettings $webhook, Request $request): ?Response
        {
            try {
                // Find payment method by webhook ID
                $paymentMethod = $this->paymentMethodsProvider
                    ->getPaymentMethodByWebhookId($webhook->getId());

                if (!$paymentMethod) {
                    return new Response(null, Response::HTTP_NOT_FOUND);
                }

                // webhook processing logic here
                $result = $this->processPaymentTransaction($paymentMethod, $request);

                if ($result) {
                    return new Response('OK', Response::HTTP_OK);
                }

                return new Response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            } catch (\Exception $e) {
                return new Response(null, Response::HTTP_EXPECTATION_FAILED);
            }
        }

        private function processPaymentTransaction(PaymentMethod $paymentMethod, Request $request): bool
        {
            if ($request->get('entity_id')) {
                 $this->logger->info('Payment transaction updated');

                 return true;
            } else {
                $this->logger->error('Payment transaction not found');

                return false;
            }
        }
    }

**Register the webhook processor as a service:**

.. code-block:: yaml

    services:
        acme_example.webhook_processor:
            class: Oro\Bundle\ExampleBundle\Model\WebhookProcessor
            arguments:
                - '@logger'
                - '@acme_example.payment_methods_provider'
            tags:
                - { name: oro_integration.webhook_processor }

Step 2: Make Transport Entity Webhook-Aware
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Update your transport settings entity to implement ``WebhookAwareInterface`` and use ``WebhookAwareTrait``:

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\Entity;

    use Oro\Bundle\IntegrationBundle\Entity\Transport;
    use Oro\Bundle\IntegrationBundle\Entity\WebhookAwareInterface;
    use Oro\Bundle\IntegrationBundle\Entity\WebhookAwareTrait;
    use Oro\Bundle\IntegrationBundle\Entity\WebhookHolderTrait;

    #[ORM\Entity]
    class ExampleTransportSettings extends Transport implements WebhookAwareInterface
    {
        use WebhookAwareTrait;
        use WebhookHolderTrait;  // Adds the ORM mapping for webhook relation

        // ... other properties and methods
    }

**What the traits provide:**

* **WebhookAwareTrait**: Implements the ``getWebhook()`` and ``setWebhook()`` methods
* **WebhookHolderTrait**: Adds the ORM ``ManyToOne`` relationship mapping

.. note::

    No additional entity changes required! The interface and traits handle everything.

Step 3: Add Webhook Field to Form
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Add the webhook field to your transport settings form type using ``WebhookFieldType``:

.. code-block:: php

    namespace Oro\Bundle\ExampleBundle\Form\Type;

    use Oro\Bundle\IntegrationBundle\Form\Type\WebhookFieldType;
    use Oro\Bundle\ExampleBundle\Model\WebhookProcessor;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    class ExampleTransportSettingsType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                // ... other fields
                ->add('webhook', WebhookFieldType::class, [
                    'webhook_processor' => WebhookProcessor::getName()
                ]);
        }
    }

Step 4: Display Webhook URL in Form Template
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Add to your transport settings form template:

.. code-block:: twig

    {# ... other fields ... #}
    {{ form_row(form.webhook) }}

.. include:: /include/include-links-dev.rst
   :start-after: begin
