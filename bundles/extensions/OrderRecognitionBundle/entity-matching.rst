.. _bundle-docs-extensions-order-recognition-entity-matching:

Customize Entity Matching
=========================

The :ref:`recognition pipeline <bundle-docs-extensions-order-recognition-pipeline>` turns the values that the microservice recognized in a document into OroCommerce entities: a customer, a customer user, products and product units, addresses, and a payment term. Two groups of services take part in this step:

* Finders --- Look up an entity for one recognized value and record whether the lookup succeeded.
* Search adapters --- Give finders a relevancy search fallback when an exact database lookup returns nothing.

The outcome of every lookup is recorded in a shared recognition state that becomes the mapping data of the draft order and drives its progress indicator; see :ref:`Recognition State and Progress <bundle-docs-extensions-order-recognition-state>`.

This page describes each group and shows how to replace or extend it. All examples use the ``Acme\Bundle\SmartOrderBundle`` namespace. For the bundle overview and the configuration reference, see :ref:`OroOrderRecognitionBundle <bundle-docs-extensions-order-recognition>`.

Finders
-------

Every finder implements ``Oro\Bundle\OrderRecognitionBundle\Finder\FinderInterface`` with a single method:

.. code-block:: php

   public function entityFor(object $parentEntity, array $data): ?object;

``$parentEntity`` is the entity being built (the ``Order`` or one ``OrderLineItem``), and ``$data`` is the recognized payload the calling processor hands over. The return value is not uniform: some finders return the entity they found, others mutate and return the parent entity. The following table lists the finders included in the bundle.

.. csv-table::
   :header: "Finder", "Parent entity", "Payload keys read", "Returns", "State recorded"
   :widths: 20, 12, 28, 20, 20

   "``CustomerFinder``", "``Order``", "``customer.name``, ``customer.subsidiary``", "``?Customer``", "``CustomerState``: ``valid`` or ``invalid``"
   "``CustomerUserFinder``", "``Order``", "``customerUser.email``, ``customerUser.firstName``, ``customerUser.lastName``", "``?CustomerUserInterface``", "``CustomerUserState``: ``valid`` or ``invalid``; also sets ``CustomerState`` to ``valid`` when the order has a customer"
   "``ProductFinder``", "``OrderLineItem``", "``manufacturerCode``, ``productSku``, ``skuCandidates``, ``productName``, ``state_index``", "the line item, mutated", "``ProductState``: ``valid`` or ``invalid`` for the line item index"
   "``ProductUnitFinder``", "``OrderLineItem``", "``productUnitCode``, ``state_index``", "the line item, mutated", "``ProductUnitState``: ``valid`` or ``invalid`` for the line item index"
   "``RegionFinder``", "``Order``", "``shippingAddress.countryCode``, ``shippingAddress.regionCode``, ``shippingAddress.regionName``", "``?Region``", "``RegionState``: ``invalid`` when not found"
   "``CountryFinder``", "``Order``", "``shippingAddress.countryCode``, ``shippingAddress.countryName``", "``?Country``", "``CountryState``: ``invalid`` when not found"
   "``CustomerAddressFinder``", "``Order``", "``country`` and ``region`` entities, ``shippingAddress.city``, ``shippingAddress.street``, plus the search handler fields", "``?CustomerAddress``", "none"
   "``PaymentTermFinder``", "``Order``", "``order.paymentTerm``", "``?PaymentTerm``", "none; ``PaymentTermProcessor`` records ``PaymentTermState``"

All classes live in the ``Oro\Bundle\OrderRecognitionBundle\Finder`` namespace. The lookup strategy of each finder is:

``CustomerFinder``
    Looks for a customer whose name equals ``customer.subsidiary`` (when present), then ``customer.name``, case-insensitively. When neither matches, it runs the customer search adapter with the combined name and subsidiary, then with the name alone. When a customer is found and a subsidiary name is present, it returns the child customer whose name contains the subsidiary name, or the customer itself.

``CustomerUserFinder``
    Looks up a customer user by email (``emailLowercase``), then by first and last name, restricted to the order customer when one is set. When the database lookup fails, it runs the customer user search adapter with the email, then with the names and the customer name. A customer user that belongs to a different customer than the order is discarded. When the order has no customer, a found customer user is still returned but recorded as ``invalid``.

``ProductFinder``
    Compares ``manufacturerCode``, ``productSku``, and each ``skuCandidates`` entry with the uppercase SKU, then compares ``productName`` with the default product name, then runs the product search adapter with the manufacturer code, the SKU, and the product name in that order. Only a simple product is assigned to the line item. Otherwise, the finder writes the manufacturer code or SKU into ``productSku`` and the product name into ``freeFormProduct`` of the line item, so the back-office user sees the recognized text.

``ProductUnitFinder``
    Marks the unit invalid first and returns the line item unchanged when ``productUnitCode`` is empty. Otherwise, when the line item has a product with exactly one unit precision, that unit is assigned regardless of the recognized code; when the product has several unit precisions, the recognized code is compared case-insensitively with them. A free-form product (no product resolved) keeps the recognized code and is marked valid.

``RegionFinder`` and ``CountryFinder``
    Match the region by ``combinedCode`` (``<countryCode>-<regionCode>``) or by name, and the country by ``iso2Code`` or by name. ``OrderAddressesProcessor`` calls both finders for the shipping address and then, when the payload contains a billing address, for the billing address, passing the billing address under the ``shippingAddress`` key, so both finders always read that key.

``CustomerAddressFinder``
    Runs only when the order has a customer. It matches a customer address by country, region, city, and street among the addresses of the order customer. When nothing matches, it runs the customer address search adapter with the values of the search handler fields and accepts the result only when the address belongs to the order customer.

``PaymentTermFinder``
    Matches the payment term whose label equals ``order.paymentTerm`` case-insensitively.

Finders are plain services defined in ``Resources/config/finders.yml`` of the bundle and are injected explicitly into the processors that use them: ``CustomerProcessor``, ``CustomerUserProcessor``, ``PaymentTermProcessor``, ``LineItemsProcessor``, and ``OrderAddressesProcessor``.

.. important:: Finders are not collected by a tag. A new class that implements ``FinderInterface`` does nothing on its own. To change a lookup, decorate the existing finder service or inject the new finder into a custom processor.

Replace or Extend a Finder
^^^^^^^^^^^^^^^^^^^^^^^^^^

Because the pipeline resolves finders by their service ids, service decoration is the way to change how an entity is matched. The bundle itself decorates ``ProductFinder`` once: ``Oro\Bundle\OrderRecognitionBundle\Finder\CpnProductFinderDecorator`` (``finders.yml``) uses the default ``decoration_priority`` of ``0``. It calls the finder it wraps first and, when no product was found, the ``use_cpn_in_smart_order`` option is enabled, and the customer part number extension is available, looks up the product by its customer part numbers.

Symfony applies decorators with a higher ``decoration_priority`` first. As a result, they end up closer to the original service, and decorators with a lower priority wrap the result. The priority of a custom decorator therefore decides where it runs:

* **Negative priority** (for example, ``-300``) --- The decorator becomes the outermost layer. Its ``@.inner`` is ``CpnProductFinderDecorator``. For this reason, it runs after both the regular lookup and the customer part number lookup and can act as a fallback. Prefer this position.
* **Positive priority** --- The decorator wraps ``ProductFinder`` directly and runs before the customer part number lookup.

The following decorator resolves a product by a custom ``gtin`` product field after the existing chain failed to find one. It expects a ``gtin`` key in each line item of the recognized payload, for example added by a processor that maps additional payload fields (see :ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`). The lookup itself, a repository query by the ``gtin`` field, is left out; like ``ProductFinder``, the decorator must assign only a simple product (``Product::TYPE_SIMPLE``) and return the line item unchanged otherwise:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Finder;

   use Doctrine\Persistence\ManagerRegistry;
   use Oro\Bundle\EntityRecognitionBundle\State\StateEnum;
   use Oro\Bundle\OrderBundle\Entity\OrderLineItem;
   use Oro\Bundle\OrderRecognitionBundle\Finder\FinderInterface;
   use Oro\Bundle\OrderRecognitionBundle\State\StateInterface;

   class GtinProductFinderDecorator implements FinderInterface
   {
       public function __construct(
           private readonly FinderInterface $innerFinder,
           private readonly StateInterface $productState,
           private readonly ManagerRegistry $doctrine,
       ) {
       }

       #[\Override]
       public function entityFor(object $parentEntity, array $data): ?object
       {
           $lineItem = $this->innerFinder->entityFor($parentEntity, $data);
           if (!$lineItem instanceof OrderLineItem || $lineItem->getProduct()) {
               return $lineItem;
           }

           // look up $product by $data['gtin']; return $lineItem when nothing is found

           $lineItem->setProduct($product);
           $lineItem->setFreeFormProduct(null);
           $this->productState->update(StateEnum::VALID, [$data['state_index']]);

           return $lineItem;
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       acme_smart_order.finder.gtin_product:
           class: Acme\Bundle\SmartOrderBundle\Finder\GtinProductFinderDecorator
           decorates: Oro\Bundle\OrderRecognitionBundle\Finder\ProductFinder
           decoration_priority: -300
           arguments:
               - '@.inner'
               - '@Oro\Bundle\OrderRecognitionBundle\State\ProductState'
               - '@doctrine'

The decorator keeps the contract of ``ProductFinder``: it returns the line item, assigns only simple products, and records the result through ``ProductState`` with the ``state_index`` that ``LineItemsProcessor`` adds to every line item payload. The same pattern applies to any other finder; use ``decorates`` with the finder class name as the service id.

.. note:: ``LineItemsProcessor`` adds the line item to the order only after the product and product unit finders have run, so a custom product or product unit finder receives a line item whose ``getOrder()`` returns ``null``. Read the order data from the context in a custom processor instead.

Search Adapters
---------------

``Oro\Bundle\OrderRecognitionBundle\Adapter\RelevancySearchAdapterInterface`` declares ``search(array $input)``. The default implementation, ``RelevancySearchAdapter``, wraps an autocomplete ``Oro\Bundle\FormBundle\Autocomplete\SearchHandlerInterface``, runs ``search($input['query'], 1, 1)`` and returns the ``id`` of the first hit or ``null``. The bundle defines one adapter instance per entity in ``Resources/config/services.yml``, each with its own search handler from ``Resources/config/search_handlers.yml``:

.. csv-table::
   :header: "Adapter service", "Search handler service", "Entity"
   :widths: 35, 40, 25

   "``oro_order_recognition.search_adapter.customer``", "``oro_order_recognition.customer.search_handler``", "``Customer``"
   "``oro_order_recognition.search_adapter.customer_user``", "``oro_order_recognition.customer_user.search_handler``", "``CustomerUser``"
   "``oro_order_recognition.search_adapter.product``", "``oro_order_recognition.product.search_handler``", "``Product``"
   "``oro_order_recognition.search_adapter.customer_address``", "``oro_order_recognition.customer_address.search_handler``", "``CustomerAddress``"

The customer and product handlers use ``Oro\Bundle\OrderRecognitionBundle\Autocomplete\FieldSpecificSearchHandler``, which searches only in the fields configured for the handler in ``Resources/config/search_handlers.yml`` instead of the ``all_text`` index field. The customer user and customer address handlers are standard ``Oro\Bundle\FormBundle\Autocomplete\SearchHandler`` services.

To change how a fallback search works, implement ``RelevancySearchAdapterInterface`` and register it under the adapter service id that the finder receives. The class implements ``search(array $input)``, reads the query from ``$input['query']``, runs the search handler with the variants of the query it wants to try, and returns the ID of the first hit or ``null``. The following redefinition replaces the product adapter with such a class:

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       oro_order_recognition.search_adapter.product:
           class: Acme\Bundle\SmartOrderBundle\Adapter\FuzzyProductSearchAdapter
           arguments:
               - '@oro_order_recognition.product.search_handler'

Redefining a service id replaces the definition only when the custom bundle is loaded after OroOrderRecognitionBundle; see the customization prerequisites on the :ref:`bundle page <bundle-docs-extensions-order-recognition>`. Alternatively, decorate the adapter service with ``decorates: oro_order_recognition.search_adapter.product`` and fall back to ``@.inner``. To search other fields with the default adapter, redefine the search handler service instead and pass a different field list.

.. include:: /include/include-links-dev.rst
   :start-after: begin
