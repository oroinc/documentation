.. _bundle-docs-extensions-order-recognition-http-contract:

Microservice HTTP Contract
==========================

The bundle communicates with the AI Smart Order microservice over HTTP with JSON bodies. The microservice is operated by Oro and is not part of the ``oro/ai-smart-order`` package. This page describes the two requests the bundle sends, the response it consumes, and the ways to adjust the request or the response on the bundle side.

Recognition Request
-------------------

``Oro\Bundle\EntityRecognitionBundle\Processor\EntityRecognitionProcessor`` builds an ``Oro\Bundle\OrderRecognitionBundle\Request\Model\DTO\RecognizeOrderRequestDTO`` from the input string returned by the source providers and the decrypted API key, and passes it to ``Oro\Bundle\OrderRecognitionBundle\Connector\OrderRecognitionConnector``. The connector wraps the DTO into ``Oro\Bundle\OrderRecognitionBundle\Request\RecognizeOrderRequest`` and sends it through ``Oro\Bundle\OrderRecognitionBundle\Client\OrderRecognitionApiClient``.

* **Method and path** --- ``POST {order_recognition_url}/recognize``. The base URL is the ``oro_order_recognition.order_recognition_url`` system configuration option; a trailing slash is removed before the path is appended.
* **Headers** --- ``Content-Type: application/json`` and ``Accept: application/json``. The recognition request sends no authentication header; the API key is part of the body.
* **Body** --- A JSON object with two keys:

  .. code-block:: json

     {
       "base64_blob_file": "JVBERi0xLjQK...",
       "api_key": "<api key>"
     }

  ``base64_blob_file`` is the base64-encoded content of the document. The default ``Oro\Bundle\EntityRecognitionBundle\Source\SymfonyFileSourceProvider`` produces it from the temporary file created by ``FileProcessor``.

* **Timeouts** --- The client uses the ``oro_order_recognition.http_client`` service, a Symfony HTTP client created with ``timeout: 600`` and ``max_duration: 600``, so a large document can take up to ten minutes. A missing base URL raises a ``\RuntimeException`` in the client; a missing API key raises a ``\RuntimeException`` in ``EntityRecognitionProcessor``.

Health Check
------------

``Oro\Bundle\OrderRecognitionBundle\Checker\SmartOrderConnectionChecker`` verifies the connection through ``Oro\Bundle\OrderRecognitionBundle\Connector\CheckServiceHealthConnector``:

* **Method and path** --- ``GET {order_recognition_url}/health``. The URL can be overridden per request through ``Oro\Bundle\OrderRecognitionBundle\Request\Model\DTO\HealthCheckRequestDTO``, which the system configuration page uses to test unsaved values.
* **Headers** --- ``X-Api-Key: <api key>`` (omitted when no key is configured) in addition to the JSON content headers.
* **Response** --- A ``200`` status with a JSON object. ``SmartOrderConnectionChecker`` returns the decoded JSON body, or an empty array when the request fails or returns a non-``200`` status. Its callers expect the ``status`` key with the ``ok`` value (``Oro\Bundle\OrderRecognitionBundle\Checker\ConnectionCheckerInterface::STATUS_OK``). The **Check Connection** button on the system configuration page reports a failure for any other result and includes the optional ``message`` key only when ``status`` is ``warning`` (``STATUS_WARNING``).

The health check uses the ``oro_order_recognition.client.api_client.standard_timeout`` client service with the default Symfony HTTP client timeouts, not the long-timeout client of the recognition request.

Response Envelope
-----------------

A successful recognition returns the ``200`` status and a JSON object. ``EntityRecognitionProcessor`` reads two keys:

* ``data.recognized_data`` --- The recognized order data described below. It is stored in the ``output`` context key.
* ``data.image_base64_blob_file`` --- Optional. A base64-encoded image of the first page of the document. ``PreviewFileProcessor`` stores it as a second attachment that the draft order edit page shows as the preview.

.. code-block:: json

   {
     "data": {
       "recognized_data": {
         "order": {},
         "customer": {},
         "customerUser": {},
         "lineItems": [],
         "shippingAddress": {},
         "billingAddress": {},
         "other": {}
       },
       "image_base64_blob_file": "iVBORw0KGgo..."
     }
   }

Any other status is an error. The connector decodes the body, logs it to the ``ai_smart_order`` channel, maps the ``error.code`` key to a user-facing message, and throws ``Oro\Bundle\OrderRecognitionBundle\Exception\InvalidResponseException`` with that message. See `Error Codes`_.

Recognized Data Reference
-------------------------

The following sample shows every key that the bundle reads. All keys except ``lineItems`` are optional: a missing optional key leaves the corresponding order field empty and, where a state is recorded, marks the field as invalid. A missing or empty ``lineItems`` array rejects the recognition. A line item without a numeric ``quantity`` keeps an empty quantity, and a line item without a ``productUnitCode`` keeps an empty unit marked as invalid.

.. important:: The JSON contract can be adjusted for a specific document layout through a support request, for example, to capture line item notes or custom line item and order attributes from purchase orders. The bundle ignores a key it does not know. For this reason, a new key still needs a processor that maps it. See :ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`.

.. code-block:: json

   {
     "order": {
       "poNumber": "PO-2026-0001",
       "currency": "USD",
       "shipUntil": "2026-10-15",
       "paymentTerm": "Net 30",
       "shippingMethod": "Flat Rate"
     },
     "customer": {
       "name": "Sample Customer",
       "subsidiary": "Sample Customer North"
     },
     "customerUser": {
       "firstName": "Alex",
       "lastName": "Sample",
       "email": "alex.sample@example.com"
     },
     "lineItems": [
       {
         "lineNumber": 1,
         "pageNumber": 1,
         "manufacturerCode": "MFR-100",
         "productSku": "SKU-100",
         "skuCandidates": ["SKU100", "SKU-100-A"],
         "productName": "Sample Product",
         "quantity": 10,
         "productUnitCode": "item",
         "value": "12.50",
         "currency": "USD"
       }
     ],
     "shippingAddress": {
       "firstName": "Alex",
       "middleName": "",
       "lastName": "Sample",
       "street": "1 Sample Street",
       "street2": "Suite 100",
       "city": "Sample City",
       "regionCode": "CA",
       "regionName": "California",
       "postalCode": "90000",
       "countryCode": "US",
       "countryName": "United States",
       "phone": "+1 555 0100"
     },
     "billingAddress": {},
     "other": {
       "deliveryInstructions": "Call before delivery"
     }
   }

.. csv-table::
   :header: "**Key**","**Consumer**","**Behavior**"

   "``order.poNumber``","``OrderProcessor``","Copied to ``Order::poNumber``."
   "``order.currency``","``OrderProcessor``","Upper-cased and validated as an ISO currency code. An invalid or missing code falls back to the ``default_currency`` option and, when that option is empty, to the default currency of the organization."
   "``order.shipUntil``","``OrderProcessor``","Parsed with ``\DateTime``. A value that cannot be parsed is appended to the customer notes as ``Ship Until: <value>``."
   "``order.paymentTerm``","``PaymentTermFinder`` via ``PaymentTermProcessor``","Matched case-insensitively against the payment term label. A miss marks the payment term state as invalid."
   "``order.shippingMethod``","``ShippingMethodProcessor``","Matched case-insensitively against the names of the configured shipping methods; the first type of the matched method is used. A miss is logged only."
   "``customer.name``, ``customer.subsidiary``","``CustomerFinder`` via ``CustomerProcessor``","Looked up by exact name (subsidiary first), then through the customer search adapter. A subsidiary name is also matched against the child customers of the found customer."
   "``customerUser.email``, ``customerUser.firstName``, ``customerUser.lastName``","``CustomerUserFinder`` via ``CustomerUserProcessor``","Looked up by email, then by both names, then through the search adapter. The found customer user must belong to the recognized customer. Skipped when the ``orderCustomerUser`` input is provided."
   "``lineItems[]``","``LineItemsProcessor``","One ``OrderLineItem`` per element, in payload order. An empty or missing array rejects the recognition with ``IncompleteOrderException`` (code ``2001``)."
   "``lineItems[].manufacturerCode``, ``lineItems[].productSku``, ``lineItems[].skuCandidates``, ``lineItems[].productName``","``ProductFinder``","Looked up by SKU (manufacturer code, then product SKU, then each candidate), then by the default product name, then through the product search adapter. A miss, or a match that is not a simple product, stores the code as a free-form product SKU and name and marks the product state as invalid. The non-empty codes are also stored as ``skuCandidates`` in the line item context."
   "``lineItems[].productUnitCode``","``ProductUnitFinder``","Matched against the unit precisions of the found product. A product with a single unit precision uses that unit regardless of the recognized code."
   "``lineItems[].quantity``","``LineItemsProcessor``","Cast to float."
   "``lineItems[].value``","``LineItemsProcessor``","Parsed as a localized decimal into the line item price. The price state is valid only when the value equals the product price found by the pricing provider."
   "``lineItems[].currency``","``LineItemsProcessor``","Upper-cased and validated as an ISO currency code. An empty or invalid code falls back to the order currency."
   "``lineItems[].lineNumber``, ``lineItems[].pageNumber``","``LineItemsProcessor``","Stored as ``positionOnPage`` in the line item context when both are present."
   "``shippingAddress.countryCode``, ``shippingAddress.countryName``","``CountryFinder`` via ``OrderAddressesProcessor``","Looked up by ISO2 code, then by name."
   "``shippingAddress.regionCode``, ``shippingAddress.regionName``","``RegionFinder`` via ``OrderAddressesProcessor``","Looked up by the combined ``<countryCode>-<regionCode>`` code, then by name."
   "``shippingAddress.city``, ``shippingAddress.street``, and the other address keys","``CustomerAddressFinder`` and ``OrderAddressesProcessor``","When the country and region are found, an existing customer address with the same country, region, city, and street is looked up, then the customer address search adapter is tried. A hit copies the customer address into the order address; a miss creates a new order address from the recognized keys and marks the addresses state as invalid."
   "``billingAddress``","``OrderAddressesProcessor``","Same keys and lookup as ``shippingAddress``. Processed only when the object is not empty."
   "``other``","``OrderProcessor``","A free-form object. See `The Other Object`_."

The Other Object
^^^^^^^^^^^^^^^^

``other`` contains any value the microservice recognizes that has no dedicated key. ``OrderProcessor`` renders it into the order customer notes as one ``- <key>: <value>`` line per entry; a nested object or array produces a ``- <key>:`` line followed by its entries indented by four spaces. The sample above produces the customer notes ``- deliveryInstructions: Call before delivery``.

Unknown Fields
^^^^^^^^^^^^^^

A key that is not listed above is ignored by the processors, but the whole ``recognized_data`` object is stored verbatim in ``OrderRecognition::rawData`` by ``RecognitionDataProcessor``. Custom code can therefore read an additional field either from the ``output`` context key during the recognition or from ``$order->getRecognition()->getRawData()`` afterwards. Both options are described in :ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`.

.. _bundle-docs-extensions-order-recognition-http-contract-error-codes:

Error Codes
-----------

When the microservice returns a non-``200`` status, ``Oro\Bundle\OrderRecognitionBundle\Connector\ErrorMessageHandler`` reads ``error.code`` from the decoded body and selects the translated message of ``InvalidResponseException``:

.. csv-table::
   :header: "**Code**","**Constant**","**Message Key**","**Meaning**"

   "``1010``","``ErrorMessageHandler::INPUT_REFUSED``","``oro_order_recognition.error.input_refused``","The microservice refused the input. The user is asked to check the file and try again."
   "``1100``","``ErrorMessageHandler::DOC_TO_IMG_UNAVAILABLE``","``oro_order_recognition.error.unable_to_process_pdf``","The microservice is temporarily unable to process a PDF file. The user is asked to try a JPG or PNG file."
   "any other or missing","``ErrorMessageHandler::GENERAL_ERROR``","``oro_order_recognition.error.generic``","A generic failure. The user is asked to reload the page and try again."

The message is shown in the dashboard widget for a synchronous upload and is listed as the error cause in the failure email for an asynchronous one. See :ref:`Error Handling <bundle-docs-extensions-order-recognition-pipeline-error-handling>` for how the exception travels through the pipeline.

Changing the Request or Normalizing the Response
------------------------------------------------

The bundle has no dedicated hook for the payload. Use one of the following extension points, ordered from the closest to the HTTP layer to the closest to the order:

* **Decorate the connector** --- Implement ``Oro\Bundle\EntityRecognitionBundle\Connector\ConnectorInterface`` and decorate ``Oro\Bundle\OrderRecognitionBundle\Connector\OrderRecognitionConnector`` to rewrite the decoded response before ``EntityRecognitionProcessor`` reads it. This is the place to rename a vendor-specific key into a key the processors understand. See the example below.
* **Decorate the API client** --- Implement ``Oro\Bundle\OrderRecognitionBundle\Client\OrderRecognitionApiClientInterface`` and decorate ``Oro\Bundle\OrderRecognitionBundle\Client\OrderRecognitionApiClient`` to change the PSR-7 request, for example, to add a header. The health check uses the separate ``oro_order_recognition.client.api_client.standard_timeout`` service, so the decoration affects only the recognition request.
* **Add a source provider** --- Implement ``Oro\Bundle\EntityRecognitionBundle\Source\SourceProviderInterface`` to change how the ``base64_blob_file`` value is produced from the input. See :ref:`Add a Source Provider <bundle-docs-extensions-order-recognition-pipeline-source-provider>`.
* **Add a processor** --- Register a processor with a priority between ``250`` and ``210`` to rewrite the ``input`` context key before the request, or between ``210`` and ``190`` to rewrite the ``output`` context key before any entity is built. See :ref:`Add a Custom Processor <bundle-docs-extensions-order-recognition-pipeline-custom-processor>`.

The following decorator skeleton rewrites the decoded response, for example, to rename a vendor-specific ``purchase_order_number`` key into ``order.poNumber``. The ``execute()`` method receives the request DTO, passes it to the decorated connector, and returns the array that ``EntityRecognitionProcessor`` reads:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Connector;

   use Oro\Bundle\EntityRecognitionBundle\Connector\ConnectorInterface;
   use Oro\Bundle\OrderRecognitionBundle\Request\Model\RequestDataInterface;

   class NormalizingConnectorDecorator implements ConnectorInterface
   {
       public function __construct(
           private readonly ConnectorInterface $inner,
       ) {
       }

       #[\Override]
       public function execute(RequestDataInterface $requestBodyDTO): array
       {
           $response = $this->inner->execute($requestBodyDTO);
           // normalize $response['data']['recognized_data']

           return $response;
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Connector\NormalizingConnectorDecorator:
           decorates: Oro\Bundle\OrderRecognitionBundle\Connector\OrderRecognitionConnector
           arguments:
               - '@.inner'

.. note:: ``EntityRecognitionProcessor`` reads ``data.recognized_data`` from the returned array without a fallback. A decorator must keep the envelope and return an array that still contains this key.

.. include:: /include/include-links-dev.rst
   :start-after: begin
