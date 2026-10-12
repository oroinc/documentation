:oro_show_local_toc: false

.. _bundle-docs-extensions-order-recognition:

OroOrderRecognitionBundle
=========================

.. important:: OroOrderRecognitionBundle is only available in the Enterprise edition.

|OroOrderRecognitionBundle| adds the AI Smart Order feature to the OroCommerce back-office: it turns a purchase order document (a PDF or an image uploaded through the dashboard widget or received as an email attachment) into a draft order with the ``pending`` internal status.

The ``oro/ai-smart-order`` package includes two bundles:

* |OroEntityRecognitionBundle| --- The generic recognition pipeline built on the |ChainProcessor| component, the source providers that turn an input into the string sent to the microservice, and the state mapper that records which recognized fields are valid.
* ``OroOrderRecognitionBundle`` --- The order-specific processors, the entity finders, the message queue topics and processors, the email intake, the system configuration, and the back-office UI.

The document recognition itself runs in the AI Smart Order microservice operated by Oro. The microservice is not customizable by integrators and is described in this guide only as an HTTP contract. This guide covers the bundle side: how the recognized data becomes a draft order and where a custom bundle can change that behavior.

Prerequisites
-------------

* The AI Smart Order feature is enabled in the system configuration, and the microservice URL and API key are set. Both values are automatically configured by the OroCloud team. See :ref:`Configure Global AI Smart Order Settings <admin-configuration-orders-ai-smart-order-settings>`.
* The connection works. The bundle checks it with a ``GET /health`` request, described in :ref:`Microservice HTTP Contract <bundle-docs-extensions-order-recognition-http-contract>`.

.. important:: The ``oro_order_recognition`` feature is disabled by ``Oro\Bundle\OrderRecognitionBundle\Feature\Voter\FeatureVoter`` while the URL or the API key is empty, even when the feature checkbox is selected.

Architecture Overview
---------------------

Entry Points
^^^^^^^^^^^^

* **Dashboard widget** --- ``Oro\Bundle\OrderRecognitionBundle\Controller\Dashboard\DashboardController`` (route ``oro_order_recognition_dashboard``, ACL ``oro_order_create``) handles the file upload form. When ``enable_async_processing`` is off, it runs the recognition in the request and returns the URL of the draft order edit page, which the widget opens. When the option is on, ``Oro\Bundle\OrderRecognitionBundle\Handler\AsyncRecognitionHandler`` persists the uploaded file as an ``Oro\Bundle\AttachmentBundle\Entity\File`` and sends the ``oro_order_recognition.recognize_order.file`` message.
* **Message queue processors** --- ``FileOrderRecognitionProcessor`` and ``EmailAttachmentOrderRecognitionProcessor`` in ``Oro\Bundle\OrderRecognitionBundle\Async\Processor`` run the recognition in a unique job and send websocket and email notifications.
* **System mailbox** --- The ``convert_mailbox_email_to_order`` process sends the ``oro_order_recognition.recognize_order.email_attachment`` message for every non-inline attachment of an email received by a mailbox with the ``order`` process type.

The message queue entry points are described in :ref:`Asynchronous Processing <bundle-docs-extensions-order-recognition-async>`, and the mailbox process in :ref:`Email Intake <bundle-docs-extensions-order-recognition-email-intake>`.

Recognition Flow
^^^^^^^^^^^^^^^^

Every entry point calls ``Oro\Bundle\OrderRecognitionBundle\Manager\OrderRecognizer::recognizeUsing()`` with the ``file`` input and, optionally, the ``orderOwner`` and ``orderCustomerUser`` inputs. The recognizer runs the ``get_entity_recognition`` action of the pipeline:

1. ``FileProcessor`` maps the input (a Symfony file, an ``EmailAttachment``, or a ``File`` entity) to a temporary uploaded file through the file mappers.
2. ``EntityRecognitionProcessor`` sends the base64-encoded file content to the microservice and stores the ``recognized_data`` part of the response in the context.
3. ``OrderProcessor`` creates a new ``Order`` with the PO number, currency, customer notes, the ``pending`` internal status, the ship-until date, the default website, and the owner. ``OrderRecognitionProcessor`` attaches a new ``OrderRecognition`` entity to the order.
4. ``AttachmentProcessor`` and ``PreviewFileProcessor`` attach the source document and the preview image returned by the microservice to the order.
5. ``CustomerProcessor``, ``CustomerUserProcessor``, ``PaymentTermProcessor``, ``LineItemsProcessor``, ``OrderAddressesProcessor``, and ``ShippingMethodProcessor`` match the recognized values against existing records through the finders and record the validity of every field in the state mapper.
6. ``RecognitionDataProcessor`` stores the raw payload and the recorded state on the ``OrderRecognition`` entity.
7. ``FinalProcessor`` calculates the totals, persists and flushes the order, dispatches the ``OrderDraftCreated`` event, and sets the order as the pipeline result.

On every flush of an ``OrderRecognition`` entity, ``Oro\Bundle\OrderRecognitionBundle\EventListener\ProgressListener`` calculates the recognition progress from the recorded state and the field weights. The back-office orders grid shows this progress, and the draft order edit page highlights the fields that require attention.

The processors, their priorities, and the context keys are described in :ref:`Recognition Pipeline <bundle-docs-extensions-order-recognition-pipeline>`. The finders and the search adapters are described in :ref:`Customize Entity Matching <bundle-docs-extensions-order-recognition-entity-matching>`, and the state mapper and the progress calculation in :ref:`Recognition State and Progress <bundle-docs-extensions-order-recognition-state>`.

Key Classes
^^^^^^^^^^^

* ``Oro\Bundle\EntityRecognitionBundle\Processor\EntityRecognitionPipeline`` --- The chain processor registered as the ``oro_entity_recognition.processor`` service. It throws a ``\RuntimeException`` when no processor sets a result.
* ``Oro\Bundle\EntityRecognitionBundle\Context\ContextKeysAwareInterface`` --- The constants for the context keys shared by all processors.
* ``Oro\Bundle\OrderRecognitionBundle\Manager\OrderRecognizer`` --- The entry point that creates the context and runs the pipeline.
* ``Oro\Bundle\OrderRecognitionBundle\Entity\OrderRecognition`` --- The entity linked to the order through the ``recognition`` association that the bundle adds to ``Oro\Bundle\OrderBundle\Entity\Order``. It stores the raw payload (``rawData``), the recorded state (``mappingData``), the line item context (``lineItemContext``), the progress values (``initialProgress`` and ``entityProgress``), and the preview attachment ID.
* ``Oro\Bundle\OrderRecognitionBundle\Connector\OrderRecognitionConnector`` and ``Oro\Bundle\OrderRecognitionBundle\Client\OrderRecognitionApiClient`` --- The HTTP layer that sends the recognition request and decodes the response.
* ``Oro\Bundle\OrderRecognitionBundle\Finder\FinderInterface`` --- The contract of the finders that match a recognized value against a customer, customer user, product, product unit, region, country, customer address, or payment term.
* ``Oro\Bundle\EntityRecognitionBundle\State\StateMapperInterface`` and ``Oro\Bundle\OrderRecognitionBundle\State\StateInterface`` --- The shared state mapper and the per-field state writers.
* ``Oro\Bundle\OrderRecognitionBundle\Event\OrderDraftCreated`` --- The event dispatched after the draft order is flushed. See :ref:`OrderDraftCreated Event <bundle-docs-extensions-order-recognition-order-draft-created>`.

Draft Order Edit Page
^^^^^^^^^^^^^^^^^^^^^

``Oro\Bundle\OrderRecognitionBundle\Controller\OrderController`` provides the draft order edit page at the ``oro_order_draft_update`` route (ACL ancestor ``oro_order_update``, template ``@OroOrderRecognition/Order/draftUpdate.html.twig``). The route accepts only an order with the ``pending`` internal status and a non-empty ``recognition`` association; any other order is redirected to the regular ``oro_order_update`` route. The page uses ``Oro\Bundle\OrderRecognitionBundle\Form\Type\DraftOrderType``, a form type whose parent is the standard ``Oro\Bundle\OrderBundle\Form\Type\OrderType``. In ``finishView()``, the form type marks every top-level form field as valid. It then reads ``OrderRecognition::mappingData`` and overwrites the ``data-recognition`` attribute and the ``recognition <state>`` CSS class of every form field, address field, and line item field that has a recorded state. Each line item row also receives the aggregated state of its fields, which is ``invalid`` when any field is invalid. The page uses these attributes to highlight the fields whose state is ``invalid``. The ``oro_order_draft_complete`` route of the same controller calls ``Oro\Bundle\OrderRecognitionBundle\Manager\ProgressManagerInterface::markAsComplete()`` for the top-level mapping data key passed in the request and flushes the order. The Twig functions ``get_progress_percentage``, ``get_invalid_fields``, and ``is_field_valid_in_order_recognition`` of ``Oro\Bundle\OrderRecognitionBundle\Twig\OrderRecognitionExtension`` read ``OrderRecognition::entityProgress`` and ``Oro\Bundle\OrderRecognitionBundle\Provider\ProgressCalculationProviderInterface`` for the progress bar and the list of fields that require attention.

Customization Prerequisites
---------------------------

* Customizations live in a bundle of the application. All examples in this guide use the ``Acme\Bundle\SmartOrderBundle`` namespace.
* A service redefinition or a re-pointed alias takes precedence only when the custom bundle is loaded after OroOrderRecognitionBundle. Set the ``priority`` of the bundle in its ``Resources/config/oro/bundles.yml`` to a value higher than ``320``, the priority of OroOrderRecognitionBundle.
* Service decoration with ``decorates:`` does not depend on the bundle load order.
* Clear the cache after changing service definitions.
* A processor can be unit-tested with a plain ``Oro\Component\ChainProcessor\Context`` populated with the keys the processor reads.

Customization Map
-----------------

.. csv-table::
   :header: "**Goal**","**Extension Point**","**Page**"

   "Enrich the draft order after it is created","The ``OrderDraftCreated`` event",":ref:`OrderDraftCreated Event <bundle-docs-extensions-order-recognition-order-draft-created>`"
   "Map an additional payload field","A custom processor between the priorities ``50`` and ``30`` or ``90`` and ``70``",":ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`"
   "Replace or disable a built-in step","Service redefinition or decoration of a built-in processor",":ref:`Replace or Disable a Built-In Processor <bundle-docs-extensions-order-recognition-pipeline-replace-processor>`"
   "Change how a customer, product, unit, address, or payment term is matched","Finder decoration",":ref:`Customize Entity Matching <bundle-docs-extensions-order-recognition-entity-matching>`"
   "Change the fallback search","A custom search adapter",":ref:`Customize Entity Matching <bundle-docs-extensions-order-recognition-entity-matching>`"
   "Change the progress weights or the highlighting of fields","A state writer, the field weight provider, or the progress calculation provider",":ref:`Recognition State and Progress <bundle-docs-extensions-order-recognition-state>`"
   "Accept documents from another source","A custom message queue topic and processor",":ref:`Asynchronous Processing <bundle-docs-extensions-order-recognition-async>`"
   "Change the mailbox rules","An override of the ``convert_mailbox_email_to_order`` process",":ref:`Email Intake <bundle-docs-extensions-order-recognition-email-intake>`"
   "Change the request or normalize the response","Connector or API client decoration, or a source provider",":ref:`Microservice HTTP Contract <bundle-docs-extensions-order-recognition-http-contract>`"
   "Hide or show draft orders in the APIs","The ``exclude_draft_orders_*`` configuration options","`Draft Orders in the API and Storefront`_"

Configuration
-------------

The bundle configuration root node is ``oro_order_recognition`` (``Oro\Bundle\OrderRecognitionBundle\DependencyInjection\Configuration``). Every option is a system configuration setting, so its full key is ``oro_order_recognition.<option>``. The options are shown under **System > Configuration > System Configuration > Integrations > AI Smart Order**; ``enable_entity_recognition`` and ``default_currency`` can also be set per organization.

.. csv-table::
   :header: "**Option**","**Default**","**Description**"

   "``enable_entity_recognition``","``'0'``","Enables the AI Smart Order feature. Toggles the ``oro_order_recognition`` feature."
   "``order_recognition_url``","``http://127.0.0.1:8000``","The base URL of the AI Smart Order microservice."
   "``order_recognition_api_key``","``null``","The API key of the microservice. The value is stored encrypted."
   "``enable_async_processing``","``false``","Processes files uploaded through the dashboard widget in the message queue instead of the HTTP request."
   "``use_cpn_in_smart_order``","``false``","Uses customer part numbers when matching products. Works only with the ``OroLab\Bundle\CustomerPartNumberBundle`` extension: ``Oro\Bundle\OrderRecognitionBundle\Provider\CpnCheckAvailabilityProvider`` requires the ``OroLab\Bundle\CustomerPartNumberBundle\Entity\CustomerPartNumber`` class and the enabled ``oro_lab_customer_part_number.enabled`` option, and ``Oro\Bundle\OrderRecognitionBundle\EventListener\UseCpnInSmartOrderChangeListener`` resets the option to ``false`` on save and shows a warning when either requirement is not met. Toggles the ``oro_order_recognition_cpn`` feature."
   "``exclude_draft_orders_from_storefront_api``","``true``","Hides pending recognized orders from the storefront API and keeps the storefront voter active for storefront API requests."
   "``exclude_draft_orders_from_backoffice_api``","``false``","Hides pending recognized orders from the back-office API."
   "``default_currency``","``''``","The currency of the draft order when the recognized currency is empty or is not a valid ISO code. When empty, the default currency of the organization is used."

The default values of ``enable_entity_recognition``, ``order_recognition_url``, and ``order_recognition_api_key`` are taken from the ``ORO_AI_ENABLE_ENTITY_RECOGNITION``, ``ORO_AI_ORDER_RECOGNITION_URL``, and ``ORO_AI_ORDER_RECOGNITION_API_KEY`` environment variables; when a variable is not set, the container falls back to ``'0'``, ``http://127.0.0.1:8000``, and an empty string. A value saved in the system configuration takes precedence.

Feature Toggles
---------------

The bundle declares two features in ``Resources/config/oro/features.yml``:

* ``oro_order_recognition`` --- Toggled by ``oro_order_recognition.enable_entity_recognition``. It controls the ``order_recognition`` dashboard widget, the ``order_recognition`` placeholder item, the ``convert_mailbox_email_to_order`` process, and the ``oro_order_mark_as_approved`` operation. ``FeatureVoter`` additionally disables the feature while ``order_recognition_url`` or ``order_recognition_api_key`` is empty.
* ``oro_order_recognition_cpn`` --- Toggled by ``oro_order_recognition.use_cpn_in_smart_order``. It lists ``oro_order_recognition_draft_order_cpn_ajax`` under ``routes`` in ``features.yml``. This value is the key of the routing resource that loads ``AjaxOrderCpnController`` in ``Resources/config/oro/routing.yml``; the controller route itself is named ``oro_draft_order_cpn_get_form``. ``Oro\Bundle\OrderRecognitionBundle\Finder\CpnProductFinderDecorator`` is always registered and checks the configuration and the availability of the customer part number extension itself whenever the finder it wraps finds no product.

See :ref:`Feature Toggle <dev-feature-toggle>` for how to check a feature state in custom code.

Draft Orders in the API and Storefront
--------------------------------------

A recognized order is a regular ``Order`` with the ``pending`` internal status and a non-empty ``recognition`` association. The bundle hides such orders on the storefront and, optionally, in the APIs:

* ``Oro\Bundle\OrderRecognitionBundle\Acl\Voter\OrderFrontendVoter`` is registered twice in ``Resources/config/services.yml``. The ``oro_order_recognition.acl.order_voter.frontend`` instance denies the ``VIEW`` permission on a pending recognized order on every storefront request, including storefront API requests, for any user. The ``oro_order_recognition.acl.order_voter.backoffice`` instance applies to back-office requests, but its access check manager, ``oro_order_recognition.access_check_manager.smart_order_recognized_order.backoffice``, starts with the access check disabled and nothing in the bundle enables it. Both instances abstain on orders that are not pending recognized orders, including orders without an internal status.
* ``Oro\Bundle\OrderRecognitionBundle\Api\Processor\DisableSmartOrderRecognizedOrderAccessCheck`` is registered twice in ``Resources/config/services_api.yml`` as an API processor in the ``security_check`` group of the ``get``, ``get_list``, ``create``, ``update``, ``delete``, and ``delete_list`` actions and of every subresource and relationship action, without a ``class`` restriction: once for the ``frontend`` request type, driven by ``exclude_draft_orders_from_storefront_api``, and once for the ``!frontend`` request type, driven by ``exclude_draft_orders_from_backoffice_api``. When the option is disabled, the processor disables the access check of the matching voter instance for the request, so the voter abstains.
* ``Oro\Bundle\OrderRecognitionBundle\EventListener\Datagrid\OrdersGridConfigListener`` excludes pending recognized orders from the ``frontend-orders-grid`` datagrid. On the back-office ``orders-grid`` datagrid, the same listener adds the ``entity_progress`` column, sorter, and filter, and the **Edit draft** row action that opens the ``oro_order_draft_update`` route. Both listener methods run only while the ``oro_order_recognition`` feature is enabled.
* ``Oro\Bundle\OrderRecognitionBundle\Api\Processor\ExcludePendingRecognizedOrdersQuery`` is registered twice in ``Resources/config/services_api.yml`` as an API processor for the ``get`` and ``get_list`` actions of ``Oro\Bundle\OrderBundle\Entity\Order`` in the ``build_query`` group with priority ``-120``: once for the ``frontend`` request type, driven by ``exclude_draft_orders_from_storefront_api``, and once for the ``!frontend`` request type, driven by ``exclude_draft_orders_from_backoffice_api``. When the option is enabled, the processor adds a condition that excludes orders that are pending and have a recognition. In the back-office API, only ``ExcludePendingRecognizedOrdersQuery`` hides draft orders, and only for the ``get`` and ``get_list`` actions.

Logging
-------

All bundle services log to the ``ai_smart_order`` Monolog channel declared in ``Resources/config/oro/app.yml``. The channel is written to ``%kernel.logs_dir%/ai_smart_order_%kernel.environment%.log`` through a ``fingers_crossed`` handler with the ``info`` action level, so the file receives the buffered records of a recognition once an ``info`` or a higher level record is logged.

The ``oro_order_recognition.logger`` service is a public alias of ``monolog.logger.ai_smart_order``. Inject it into a custom processor or finder to keep its records in the same file:

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Processor\ExternalOrderNumberProcessor:
           calls:
               - [ setLogger, [ '@oro_order_recognition.logger' ] ]

Related Documentation
---------------------

* :ref:`Microservice HTTP Contract <bundle-docs-extensions-order-recognition-http-contract>`
* :ref:`Recognition Pipeline <bundle-docs-extensions-order-recognition-pipeline>`
* :ref:`OrderDraftCreated Event <bundle-docs-extensions-order-recognition-order-draft-created>`
* :ref:`Customize Entity Matching <bundle-docs-extensions-order-recognition-entity-matching>`
* :ref:`Recognition State and Progress <bundle-docs-extensions-order-recognition-state>`
* :ref:`Asynchronous Processing <bundle-docs-extensions-order-recognition-async>`
* :ref:`Email Intake <bundle-docs-extensions-order-recognition-email-intake>`
* :ref:`AI and Automation Concept Guide: Smart Order <concept-guide--ai--smart-order>`
* :ref:`AI Smart Order Dashboard Widget <user-guide-dashboards-widgets>`
* :ref:`Create an Order via AI Smart Order Automation <user-guide--sales--orders--create--from-ai-smart-order>`
* :ref:`Configure Global AI Smart Order Settings <admin-configuration-orders-ai-smart-order-settings>`

.. toctree::
   :hidden:
   :maxdepth: 1

   microservice-http-contract
   recognition-pipeline
   order-draft-created-event
   entity-matching
   recognition-state
   async-processing
   email-intake

.. include:: /include/include-links-dev.rst
   :start-after: begin
