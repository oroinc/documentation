.. _bundle-docs-extensions-order-recognition-state:

Recognition State and Progress
==============================

While the :ref:`recognition pipeline <bundle-docs-extensions-order-recognition-pipeline>` runs, the finders and the processors record the outcome of every lookup in a shared recognition state. The state becomes the mapping data of the draft order, drives its progress indicator, and tells the draft order edit page which fields to highlight. This page describes the state mapper, the state writers, the field weights, and the progress calculation, and shows how to record the outcome of a custom mapping step and how to change the weights. All examples use the ``Acme\Bundle\SmartOrderBundle`` namespace.

State Mapper and State Writers
------------------------------

Every lookup records its outcome in a shared state array managed by ``Oro\Bundle\EntityRecognitionBundle\State\StateMapperInterface``:

* ``set(\BackedEnum $state, string|array $path, array $indexes = [])`` --- Writes ``$state->value`` at one or several property paths.
* ``get(string $path)`` --- Reads a value.
* ``unset(string|array $path)`` --- Sets one or several paths to ``null``.
* ``getState()`` and ``setState(array $data)`` --- Read or replace the whole array.

The implementation, ``StateMapper``, uses the Symfony property accessor on a plain array. Each ``$index`` placeholder in a path is replaced by the next value from ``$indexes``, so ``'[lineItems][$index][productSku]'`` with ``[2]`` becomes ``[lineItems][2][productSku]``. The values come from ``Oro\Bundle\EntityRecognitionBundle\State\StateEnum``: ``valid``, ``invalid``, ``missing``, and ``ambiguous``. The pipeline itself writes only ``valid`` and ``invalid``.

The mapper is registered once, under the service id ``Oro\Bundle\EntityRecognitionBundle\State\StateMapperInterface``, and stores the state for the whole recognition run. ``RecognitionDataProcessor`` (priority ``30``) copies ``getState()`` into ``OrderRecognition::mappingData`` and the raw payload into ``OrderRecognition::rawData``.

.. important:: ``StateMapperInterface`` is a single stateful service shared by all finders and processors of one run. Record custom outcomes through a dedicated ``StateInterface`` implementation and never call ``setState()`` or ``unset()`` from a custom processor; doing so discards the results the built-in finders already recorded.

Individual outcomes are written through ``Oro\Bundle\OrderRecognitionBundle\State\StateInterface``, which declares ``update(\BackedEnum $state, array $indexes = []): void``. Each implementation knows its own paths and is registered in ``Resources/config/states.yml`` with the state mapper as its only argument:

.. csv-table::
   :header: "State writer", "Paths written", "Written by"
   :widths: 22, 43, 35

   "``CustomerState``", "``[customer]``", "``CustomerFinder``, ``CustomerUserFinder``"
   "``CustomerUserState``", "``[customerUser]``", "``CustomerUserFinder``"
   "``ProductState``", "``[lineItems][$index][productSku]``, ``[lineItems][$index][productName]``", "``ProductFinder`` and its decorators"
   "``ProductUnitState``", "``[lineItems][$index][productUnitCode]``", "``ProductUnitFinder``"
   "``LineItemPriceState``", "``[lineItems][$index][value]``", "``LineItemsProcessor`` after comparing the recognized value with the price list price"
   "``CountryState``", "``[shippingAddress][countryCode]``, ``[billingAddress][countryCode]``", "``CountryFinder``"
   "``RegionState``", "``[shippingAddress][regionCode]``, ``[billingAddress][regionCode]``", "``RegionFinder``"
   "``OrderAddressesState``", "``[shippingAddress]``, ``[billingAddress]``", "``OrderAddressesProcessor`` when an address could not be matched to a customer address"
   "``PaymentTermState``", "``[payment_term_7c4f1e8e]``", "``PaymentTermProcessor``"
   "``FinalState``", "every top-level key of the mapping data", "``FinalProcessor`` when the order has no customer; the call happens after ``RecognitionDataProcessor`` has copied the state, so it does not reach the persisted mapping data"

Because the address state writers ignore ``$indexes`` and always write both address keys, a failed country or region lookup for either address marks both addresses.

Add a State Writer
^^^^^^^^^^^^^^^^^^

To record the outcome of a custom mapping step, add a state writer with its own path. The following writer covers a ``notes`` value per line item, which a custom processor can then mark ``valid`` or ``invalid`` for each line item index:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\State;

   use Oro\Bundle\EntityRecognitionBundle\State\StateMapperInterface;
   use Oro\Bundle\OrderRecognitionBundle\State\StateInterface;

   class LineItemNotesState implements StateInterface
   {
       public function __construct(private readonly StateMapperInterface $stateMapper)
       {
       }

       #[\Override]
       public function update(\BackedEnum $state, array $indexes = []): void
       {
           $this->stateMapper->set($state, '[lineItems][$index][notes]', $indexes);
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\State\LineItemNotesState:
           arguments:
               - '@Oro\Bundle\EntityRecognitionBundle\State\StateMapperInterface'

Inject the writer into the processor that maps the field and call ``$this->notesState->update(StateEnum::VALID, [$index])`` for each line item. The processor must run before ``RecognitionDataProcessor`` (priority ``30``), otherwise the entry never reaches the mapping data. For the processor side of this example, see :ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`.

.. note:: Every path under ``[lineItems]`` takes part in the progress calculation described below. An entry set to ``invalid`` for any line item marks the whole ``lineItems`` field invalid, so record ``invalid`` only when the back-office user must review the value.

Field Weights and Progress
--------------------------

The mapping data determines the progress value shown for a draft order. Two providers, both registered in ``Resources/config/progress.yml``, compute it:

``Oro\Bundle\OrderRecognitionBundle\Provider\FieldWeightProviderInterface``
    ``getWeight(string $fieldName): int`` returns the weight of a top-level mapping data key. The default ``FieldWeightProvider`` keeps the weights in a protected ``$weights`` array and returns ``0`` for unknown keys.

``Oro\Bundle\OrderRecognitionBundle\Provider\ProgressCalculationProviderInterface``
    ``calculate(object $entity): float`` returns the progress of an ``OrderRecognition`` entity in percent, and ``getInvalidFields(object $entity): array`` returns the top-level keys that are not valid.

The default weights are:

.. csv-table::
   :header: "Mapping data key", "Weight"
   :widths: 40, 10

   "``customer``", "70"
   "``lineItems``", "10"
   "``customerUser``", "5"
   "``billingAddress``", "5"
   "``shippingAddress``", "5"
   "``payment_term_7c4f1e8e``", "5"

``ProgressCalculationProvider::calculate()`` works as follows:

1. Returns ``100`` when the entity has no mapping data.
2. For every top-level key of the mapping data, adds its weight to the total and, when the field is valid, to the valid sum. A scalar field is valid when it equals ``valid``; an array field such as ``lineItems`` is valid only when every value of every item equals ``valid``.
3. Returns ``100`` when the total weight is ``0``; otherwise returns the rounded percentage of the valid sum, limited to the range from ``0`` to ``100``.

Only keys that exist in the mapping data count, so an unknown key with weight ``0`` neither raises nor lowers the result, and a custom key without a configured weight is ignored.

``Oro\Bundle\OrderRecognitionBundle\EventListener\ProgressListener`` is a Doctrine entity listener on ``OrderRecognition``. On ``prePersist`` it stores the calculated value in ``initialProgress``; on ``preFlush`` it recalculates the value and schedules an update of ``entityProgress`` when it changed. ``Oro\Bundle\OrderRecognitionBundle\Manager\ProgressManagerInterface::markAsComplete(object $entity, string $property)`` marks every state under one top-level key of the mapping data of an order ``valid``.

Change the Weights or the Calculation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Both interfaces are aliases of the concrete classes in ``progress.yml``, so a custom implementation replaces the default by re-pointing the alias. The following provider shifts the weight from the customer to the line items:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Provider;

   use Oro\Bundle\OrderRecognitionBundle\Provider\FieldWeightProvider as BaseFieldWeightProvider;

   class FieldWeightProvider extends BaseFieldWeightProvider
   {
       protected array $weights = [
           'customer' => 50,
           'lineItems' => 30,
           'customerUser' => 5,
           'billingAddress' => 5,
           'shippingAddress' => 5,
           'payment_term_7c4f1e8e' => 5,
       ];
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Provider\FieldWeightProvider: ~

       Oro\Bundle\OrderRecognitionBundle\Provider\FieldWeightProviderInterface:
           alias: Acme\Bundle\SmartOrderBundle\Provider\FieldWeightProvider

As with any redefinition, the custom bundle must be loaded after OroOrderRecognitionBundle for its alias to take precedence. Add a key to ``$weights`` when a custom state writer introduces a new top-level mapping data key; otherwise the key has weight ``0`` and does not affect the progress. To change the calculation itself, implement ``ProgressCalculationProviderInterface`` and re-point the ``ProgressCalculationProviderInterface`` alias the same way.

.. include:: /include/include-links-dev.rst
   :start-after: begin
