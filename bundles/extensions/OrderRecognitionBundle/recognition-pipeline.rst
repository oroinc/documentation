.. _bundle-docs-extensions-order-recognition-pipeline:

Recognition Pipeline
====================

The recognition is a chain of processors built on the |ChainProcessor| component, the same component that runs the :ref:`API processors <web-api--processors>`. This page describes the pipeline service, the context the processors share, their execution order, and the extension points a custom bundle can use: a custom processor, a replacement of a built-in processor, a file mapper, and a source provider. Reacting to the draft order after it is created is described in :ref:`OrderDraftCreated Event <bundle-docs-extensions-order-recognition-order-draft-created>`.

Pipeline Service
----------------

* **Service** --- ``oro_entity_recognition.processor``, an instance of ``Oro\Bundle\EntityRecognitionBundle\Processor\EntityRecognitionPipeline``. It extends ``Oro\Component\ChainProcessor\ActionProcessor`` and throws ``\RuntimeException`` with the message ``Failed to recognize the entity.`` when no processor sets a result.
* **Action** --- ``get_entity_recognition``, the only action of the pipeline.
* **Group** --- ``processing``, the only group of the action (``OroEntityRecognitionBundle/Resources/config/services.yml``).
* **Tag** --- ``oro_entity_recognition.processor``. A processor is a service that implements |ProcessorInterface| and has this tag with the ``action``, ``group``, and ``priority`` attributes. Higher priorities run first.
* **Entry point** --- ``Oro\Bundle\OrderRecognitionBundle\Manager\OrderRecognizer::recognizeUsing(mixed $input): mixed``. The ``$input`` value is an array that accepts the ``file`` key (``ContextKeysAwareInterface::FILE``) and the optional ``orderOwner`` and ``orderCustomerUser`` keys (``OrderRecognizer::ORDER_OWNER`` and ``OrderRecognizer::ORDER_CUSTOMER_USER``). The method returns the pipeline result, the created ``Order``.

The bundle registers its processors in ``OroOrderRecognitionBundle/Resources/config/chain_processors.yml`` with the class name as the service ID:

.. code-block:: yaml

   services:
       Oro\Bundle\OrderRecognitionBundle\Processor\CustomerProcessor:
           arguments:
               - '@Oro\Bundle\OrderRecognitionBundle\Finder\CustomerFinder'
           calls:
               - [ setLogger, ['@oro_order_recognition.logger'] ]
           tags:
               - { name: oro_entity_recognition.processor, action: get_entity_recognition, group: processing, priority: 150 }

Context Keys
------------

The context is the generic ``Oro\Component\ChainProcessor\Context``. The keys are constants of ``Oro\Bundle\EntityRecognitionBundle\Context\ContextKeysAwareInterface``, which every bundle processor implements. The interface also requires a ``dataFrom(ContextInterface $context): array`` method that returns the values the processor reads, in the order the processor destructures them.

``INPUT`` (``input``)
    The value sent to the microservice. ``FileProcessor`` sets it to a Symfony ``UploadedFile``; the source providers turn it into the base64 string.

``OUTPUT`` (``output``)
    The ``recognized_data`` object of the microservice response, as an array. Every order-building processor reads it.

``ENTITY`` (``entity``)
    The ``Order`` being built. ``OrderProcessor`` creates it; every later processor reads it and sets it back.

``RECOGNITION_ENTITY`` (``recognition``)
    The ``OrderRecognition`` entity created by ``OrderRecognitionProcessor``.

``FILE`` (``file``)
    The raw input passed to ``OrderRecognizer``: a Symfony file, an ``Oro\Bundle\EmailBundle\Entity\EmailAttachment``, or an ``Oro\Bundle\AttachmentBundle\Entity\File`` entity.

``FILE_ID`` (``file_id``)
    The ID of the ``File`` entity when ``FILE`` is one. ``AttachmentProcessor`` reuses the existing entity instead of creating a new one.

``ATTACHMENT`` (``attachment``)
    The ``Oro\Bundle\AttachmentBundle\Entity\Attachment`` that links the source document to the order.

``SYMFONY_FILE`` (``symfonyFile``)
    The temporary ``UploadedFile`` created by ``FileProcessor``. Used by the attachment processors.

``PREVIEW_FILE_BLOB`` (``previewFileBlob``)
    The base64 image returned by the microservice as ``data.image_base64_blob_file``, or ``null``.

``PREVIEW_ATTACHMENT`` (``previewAttachment``)
    The ``Attachment`` created from the preview image, when one was returned.

``LINE_ITEM_CONTEXT`` (``lineItemContext``)
    An array with one element per line item, in payload order, holding the ``skuCandidates`` and ``positionOnPage`` values. ``FinalProcessor`` re-keys it by line item ID before storing it on ``OrderRecognition``.

Execution Order
---------------

.. csv-table::
   :header: "**Priority**","**Processor**","**Reads**","**Writes**"

   "``250``","``Oro\Bundle\OrderRecognitionBundle\Processor\FileProcessor``","``file``","``input``, ``symfonyFile``. Returns without writing when the file cannot be mapped."
   "``210``","``Oro\Bundle\EntityRecognitionBundle\Processor\EntityRecognitionProcessor``","``input``","``output``, ``previewFileBlob``. Returns without writing when no source provider supports ``input``; throws ``\RuntimeException`` when the API key is empty."
   "``190``","``Oro\Bundle\OrderRecognitionBundle\Processor\OrderProcessor``","``output``, ``orderOwner``","``entity`` --- a new ``Order`` with the PO number, currency, customer notes, the ``pending`` internal status, ship-until date, default website, owner, and organization."
   "``180``","``Oro\Bundle\OrderRecognitionBundle\Processor\OrderRecognitionProcessor``","``entity``","``recognition`` --- a new ``OrderRecognition`` linked to the order."
   "``170``","``Oro\Bundle\OrderRecognitionBundle\Processor\AttachmentProcessor``","``symfonyFile``, ``entity``, ``file_id``","``attachment``, ``entity``."
   "``160``","``Oro\Bundle\OrderRecognitionBundle\Processor\PreviewFileProcessor``","``symfonyFile``, ``previewFileBlob``, ``entity``","``previewAttachment``, ``entity``. Skipped when there is no preview blob."
   "``150``","``Oro\Bundle\OrderRecognitionBundle\Processor\CustomerProcessor``","``output``, ``entity``","``entity`` --- the customer."
   "``130``","``Oro\Bundle\OrderRecognitionBundle\Processor\CustomerUserProcessor``","``output``, ``entity``, ``orderCustomerUser``","``entity`` --- the customer user. The ``orderCustomerUser`` input, when given, is used without a lookup."
   "``110``","``Oro\Bundle\OrderRecognitionBundle\Processor\PaymentTermProcessor``","``output``, ``entity``","``entity`` --- the payment term."
   "``90``","``Oro\Bundle\OrderRecognitionBundle\Processor\LineItemsProcessor``","``output``, ``entity``","``entity`` --- the line items, in payload order; ``lineItemContext``. Throws ``IncompleteOrderException`` when ``lineItems`` is empty."
   "``70``","``Oro\Bundle\OrderRecognitionBundle\Processor\OrderAddressesProcessor``","``output``, ``entity``","``entity`` --- the shipping and billing addresses."
   "``50``","``Oro\Bundle\OrderRecognitionBundle\Processor\ShippingMethodProcessor``","``output``, ``entity``","``entity`` --- the shipping method and type."
   "``30``","``Oro\Bundle\OrderRecognitionBundle\Processor\RecognitionDataProcessor``","``output``, ``recognition``","``recognition`` --- ``rawData`` set to the payload and ``mappingData`` set to the state mapper content."
   "``-255``","``Oro\Bundle\OrderRecognitionBundle\Processor\FinalProcessor``","``entity``, ``recognition``, ``attachment``, ``previewAttachment``, ``lineItemContext``","Marks the state invalid when there is no customer, fills the totals, persists and flushes the order, sets the source entity and the preview attachment ID, stores the line item context keyed by line item ID, flushes again, dispatches ``OrderDraftCreated``, and sets the result."

.. note:: Processors with equal priorities have no guaranteed order. Pick a unique value inside the intended window.

Insertion Windows
^^^^^^^^^^^^^^^^^

The windows describe the state of the context at each stage and are derived from the priorities in ``chain_processors.yml``; a processor may use any free priority.

* **Between 250 and 210** --- ``input`` is set, the request is not sent yet.
* **Between 210 and 190** --- ``output`` is set, no entity exists yet.
* **Between 90 and 70** --- The order and its line items exist; the addresses (``70``) and the shipping method (``50``) are not set yet.
* **Between 50 and 30** --- Every built-in mapping is done, nothing is flushed, and the state is not copied yet. This is the default window for mapping additional fields that need the whole order.
* **Below -255** --- Not recommended. The order is flushed, the event is dispatched, and the result is set. Use the ``OrderDraftCreated`` event instead.

.. _bundle-docs-extensions-order-recognition-pipeline-custom-processor:

Add a Custom Processor
----------------------

Create a class that implements |ProcessorInterface| and ``ContextKeysAwareInterface``, and tag it with ``oro_entity_recognition.processor``. The following processor runs after ``OrderProcessor`` and copies an additional ``order.externalOrderNumber`` key from the payload into an ``externalOrderNumber`` extended field that the Acme bundle adds to the ``Order`` entity. ``dataFrom()`` returns the ``output`` and ``entity`` context values, ``process()`` destructures them, changes the order, and sets the order back into the context:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Processor;

   use Oro\Bundle\EntityRecognitionBundle\Context\ContextKeysAwareInterface;
   use Oro\Component\ChainProcessor\ContextInterface;
   use Oro\Component\ChainProcessor\ProcessorInterface;

   class ExternalOrderNumberProcessor implements ProcessorInterface, ContextKeysAwareInterface
   {
       #[\Override]
       public function process(ContextInterface $context): void
       {
           [$data, $order] = $this->dataFrom($context);
           // ...
           $context->set(static::ENTITY, $order);
       }

       #[\Override]
       public function dataFrom(ContextInterface $context): array
       {
           return [$context->get(static::OUTPUT), $context->get(static::ENTITY)];
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Processor\ExternalOrderNumberProcessor:
           tags:
               - { name: oro_entity_recognition.processor, action: get_entity_recognition, group: processing, priority: 185 }

Priority ``185`` places the processor after ``OrderProcessor`` (``190``) and before ``OrderRecognitionProcessor`` (``180``), so the order exists and nothing depends on the new field yet. The body of ``process()`` reads ``$data['order']['externalOrderNumber']``, validates it, and calls the setter of the extended field.

.. _bundle-docs-extensions-order-recognition-pipeline-replace-processor:

Replace or Disable a Built-In Processor
---------------------------------------

The built-in processors are services whose ID is the class name and whose ``oro_entity_recognition.processor`` tag lives on the service definition. A definition with the same ID in a bundle loaded after OroOrderRecognitionBundle replaces the built-in definition as a whole, so it must restate the arguments and the ``calls`` (for example ``setLogger``, and ``setToken`` and ``setSmartOrderCurrencyProvider`` of ``OrderProcessor``) and repeat the tag with the same ``action``, ``group``, and ``priority`` attributes; otherwise, the step disappears from the pipeline.

To change one step of a built-in processor, extend its class and point ``class:`` of the redefinition at the subclass. The collaborators injected through the constructor are private in the built-in processors, so a subclass that needs one of them must accept it in its own constructor and pass it on to ``parent::__construct()``. The collaborators that ``OrderProcessor`` receives through ``setToken`` and ``setSmartOrderCurrencyProvider`` are private as well, so a subclass that needs one of them overrides the setter, keeps its own reference, and calls the parent setter. Only the logger set by ``setLogger`` is available to subclasses, as the protected ``$logger`` property of ``Psr\Log\LoggerAwareTrait``. The following redefinition replaces ``LineItemsProcessor`` with a subclass and keeps its arguments, logger call, and priority from ``chain_processors.yml``:

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Oro\Bundle\OrderRecognitionBundle\Processor\LineItemsProcessor:
           class: Acme\Bundle\SmartOrderBundle\Processor\LineItemsProcessor
           arguments:
               - '@Oro\Bundle\OrderRecognitionBundle\State\LineItemPriceState'
               - '@Oro\Bundle\OrderRecognitionBundle\Finder\ProductFinder'
               - '@Oro\Bundle\OrderRecognitionBundle\Finder\ProductUnitFinder'
               - '@oro_locale.formatter.number'
               - '@oro_pricing.provider.product_line_item_price'
           calls:
               - [ setLogger, ['@oro_order_recognition.logger'] ]
           tags:
               - { name: oro_entity_recognition.processor, action: get_entity_recognition, group: processing, priority: 90 }

Decoration with ``decorates:`` also works and does not depend on the bundle load order. The pipeline compiler pass (``Oro\Component\ChainProcessor\DependencyInjection\ProcessorsLoader``) registers the outermost decorator in place of the decorated service. As a result, the decorator takes the place of the built-in processor in the pipeline with the same priority, and the decorated processor is no longer registered on its own. The decorator must implement |ProcessorInterface| and receive the decorated processor through ``@.inner``.

To disable a step, redefine the service with a subclass whose ``process()`` returns early. Do not remove ``LineItemsProcessor`` or ``FinalProcessor`` this way: without ``LineItemsProcessor`` the order has no line items, and without ``FinalProcessor`` the order is not flushed and no result is set, so the pipeline throws ``\RuntimeException``.

.. _bundle-docs-extensions-order-recognition-pipeline-map-fields:

Map Additional Payload Fields
-----------------------------

When Oro adds a field to the contract for a specific document layout, the bundle stores it in ``OrderRecognition::rawData`` but does not map it. A processor in the ``90`` to ``30`` window maps it while the raw payload and the line items are both available and nothing is flushed.

The following processor copies a ``lineItems[].notes`` key into the ``comment`` field of each line item, shown as **Notes** on the order line item. The line items were added by ``LineItemsProcessor`` in payload order, so the index of a line item in ``$order->getLineItems()`` is the index of its element in ``$data['lineItems']``. ``FinalProcessor::prepareLineItemContext()`` relies on the same correlation.

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Processor;

   use Oro\Bundle\EntityRecognitionBundle\Context\ContextKeysAwareInterface;
   use Oro\Bundle\OrderBundle\Entity\Order;
   use Oro\Component\ChainProcessor\ContextInterface;
   use Oro\Component\ChainProcessor\ProcessorInterface;

   class LineItemNotesProcessor implements ProcessorInterface, ContextKeysAwareInterface
   {
       #[\Override]
       public function process(ContextInterface $context): void
       {
           /** @var array $data */
           /** @var Order $order */
           [$data, $order] = $this->dataFrom($context);

           foreach ($order->getLineItems() as $index => $lineItem) {
               $notes = $data['lineItems'][$index]['notes'] ?? null;
               if (\is_string($notes) && '' !== $notes) {
                   $lineItem->setComment($notes);
               }
           }

           $context->set(static::ENTITY, $order);
       }

       #[\Override]
       public function dataFrom(ContextInterface $context): array
       {
           return [$context->get(static::OUTPUT), $context->get(static::ENTITY)];
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Processor\LineItemNotesProcessor:
           tags:
               - { name: oro_entity_recognition.processor, action: get_entity_recognition, group: processing, priority: 80 }

Priority ``80`` runs right after ``LineItemsProcessor`` (``90``): the processor needs only the line items, so it does not wait for the addresses and the shipping method. A processor that needs the whole order uses the ``50`` to ``30`` window instead. Because ``RecognitionDataProcessor`` copies the state mapper content into ``OrderRecognition::mappingData`` at priority ``30``, a processor that runs before it can also record a state for the new field through a custom ``StateInterface`` implementation, which makes the field part of the progress calculation. See :ref:`Recognition State and Progress <bundle-docs-extensions-order-recognition-state>`.

.. important:: The line item and payload correlation is by index. A custom processor that removes line items from the order must also remove the matching elements of the ``lineItemContext`` context key, otherwise ``FinalProcessor`` stores the context of the wrong line item.

.. note:: An alternative is a listener of the ``OrderDraftCreated`` event that reads ``$order->getRecognition()->getRawData()`` after the flush. The processor is preferred for mapping fields; see :ref:`OrderDraftCreated Event <bundle-docs-extensions-order-recognition-order-draft-created>` for when the event is the better choice.

.. _bundle-docs-extensions-order-recognition-pipeline-file-mapper:

Add a File Mapper
-----------------

``FileProcessor`` converts the ``file`` input into a temporary ``UploadedFile`` through ``Oro\Bundle\OrderRecognitionBundle\File\FileMapperRegistry``. The registry asks every service tagged with ``oro_order_recognition.file_mapper`` whether it supports the value and uses the first one that does. The bundle includes three mappers: ``SymfonyFileMapper`` for ``Symfony\Component\HttpFoundation\File\File``, ``EmailAttachmentMapper`` for ``Oro\Bundle\EmailBundle\Entity\EmailAttachment``, and ``FileEntityMapper`` for ``Oro\Bundle\AttachmentBundle\Entity\File``.

A mapper implements ``Oro\Bundle\OrderRecognitionBundle\File\FileMapperInterface`` and returns an ``Oro\Bundle\OrderRecognitionBundle\File\FileInfo`` built from the content, the file name, and the optional MIME type. The following mapper accepts a path of a readable local file, which lets a custom entry point pass a path instead of a file object. ``map()`` reads the file content, derives the file name and the MIME type from the path, and returns the ``FileInfo``:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\File;

   use Oro\Bundle\OrderRecognitionBundle\File\FileInfo;
   use Oro\Bundle\OrderRecognitionBundle\File\FileMapperInterface;

   class StringFileMapper implements FileMapperInterface
   {
       #[\Override]
       public function map(mixed $file): ?FileInfo
       {
           // ...
           return new FileInfo($content, $fileName, $mimeType);
       }

       #[\Override]
       public function supports(mixed $file): bool
       {
           return \is_string($file) && \is_file($file) && \is_readable($file);
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\File\StringFileMapper:
           tags:
               - { name: oro_order_recognition.file_mapper }

When no mapper supports the input, or a mapper throws, ``FileProcessor`` logs an error and returns without setting ``input``. ``EntityRecognitionProcessor`` then finds no source provider for the empty input and returns as well, and the recognition fails in the order-building processors because ``output`` is empty. A custom mapper therefore must return a ``FileInfo`` for every value it supports and must throw a ``\RuntimeException`` when the content cannot be read.

.. _bundle-docs-extensions-order-recognition-pipeline-source-provider:

Add a Source Provider
---------------------

``EntityRecognitionProcessor`` turns the ``input`` context key into the ``base64_blob_file`` request value through ``Oro\Bundle\EntityRecognitionBundle\Source\SourceProviderRegistry``. The registry iterates the services tagged with ``oro_entity_recognition.source_provider`` and uses the first one whose ``supports()`` returns ``true``. The default ``SymfonyFileSourceProvider`` supports ``Symfony\Component\HttpFoundation\File\File`` and returns the base64-encoded file content.

A source provider is needed when a custom processor in the ``250`` to ``210`` window sets ``input`` to a value that is not a Symfony file. The following provider accepts a non-empty string that is already base64-encoded and passes it through:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Source;

   use Oro\Bundle\EntityRecognitionBundle\Source\SourceProviderInterface;

   class Base64StringSourceProvider implements SourceProviderInterface
   {
       #[\Override]
       public function getInputString(mixed $data): ?string
       {
           return $data;
       }

       #[\Override]
       public function supports(mixed $data): bool
       {
           return \is_string($data) && '' !== $data && false !== \base64_decode($data, true);
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Source\Base64StringSourceProvider:
           tags:
               - { name: oro_entity_recognition.source_provider, priority: 10 }

The registry receives the providers as a tagged iterator, so the ``priority`` tag attribute orders them; a higher priority is checked first. When no provider supports the input, ``EntityRecognitionProcessor`` returns without sending a request and without setting ``output``.

.. _bundle-docs-extensions-order-recognition-pipeline-error-handling:

Error Handling
--------------

``Oro\Component\ChainProcessor\ChainProcessor::executeProcessors()`` catches every exception thrown by a processor and rethrows it as ``Oro\Component\ChainProcessor\Exception\ExecutionFailedException`` with the message ``Processor failed: "<service id>". Reason: <original message>`` and the original exception as ``getPrevious()``. Code that handles a recognition failure must therefore inspect the previous exception.

The bundle throws the following exceptions from inside the pipeline:

``Oro\Bundle\OrderRecognitionBundle\Exception\IncompleteOrderException``
    Thrown by ``LineItemsProcessor`` when ``lineItems`` is empty, with the code ``IncompleteOrderException::NO_LINE_ITEMS_CODE`` (``2001``). The ``ERROR_TO_MESSAGES_MAP`` constant maps the code to the ``oro_order_recognition.email.error_cause.no_line_item`` translation key that the failure email uses as the error cause. The message queue processor reads the map from ``IncompleteOrderException`` by class name, so a subclass that adds codes to its own copy of the constant does not add causes to the email; a custom message processor that overrides ``collectErrors()`` is needed for that.

``Oro\Bundle\OrderRecognitionBundle\Exception\InvalidResponseException``
    Thrown by ``OrderRecognitionConnector`` when the microservice returns a non-``200`` status, with the message selected by ``ErrorMessageHandler``. See :ref:`Error Codes <bundle-docs-extensions-order-recognition-http-contract-error-codes>`.

``\RuntimeException``
    Thrown by ``EntityRecognitionProcessor`` when the API key is empty, by ``OrderRecognitionApiClient`` when the URL is empty, and by ``EntityRecognitionPipeline`` when no processor sets a result.

The entry points handle the wrapped exception as follows:

* ``DashboardController`` shows the message of the previous exception in the widget only when its class is exactly ``InvalidResponseException`` or ``IncompleteOrderException``; every other failure shows the generic ``oro_order_recognition.error.generic`` message. A custom processor that wants its message shown in the widget throws one of these two classes.
* ``AbstractOrderRecognitionProcessor`` walks the ``getPrevious()`` chain, uses the message of an ``InvalidResponseException`` or the mapped cause of an ``IncompleteOrderException`` as the error cause of the failure email, and rejects the message. A message that the broker redelivers because a previous consumer did not finish it (for example, a consumer that died during the HTTP call) is processed again until its ``oro-redeliver-count`` property reaches ``MAX_REDELIVER_ATTEMPTS`` (``5``); after that the processor sends the failure notification and rejects it without running the recognition. See :ref:`Asynchronous Processing <bundle-docs-extensions-order-recognition-async>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
