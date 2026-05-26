.. _bundle-docs-commerce-order-bundle-draft-session:

Order Edit Draft Session
========================

When a back-office user opens the order edit page, the bundle keeps the original order untouched
until the user explicitly saves. Every change — adding, modifying, or removing line items, editing
header fields — is accumulated in a **draft copy** of the order rather than applied to the original
row. When the user saves, the draft is applied to the original order and then removed. If the user
navigates away without saving, the draft is cleaned up on the next scheduled run.

This design allows safe, incremental editing of large orders without introducing partial or
inconsistent states. The feature is built on the
:ref:`DraftSession component <bundle-docs-platform-draft-session>`.

.. _bundle-docs-commerce-order-bundle-draft-session-feature-toggle:

Feature Toggle
--------------

The Order Draft Edit Mode feature is **disabled by default**. It is controlled by the
``order_draft_edit_mode`` feature toggle, backed by the system configuration key
``oro_order.enable_order_draft_edit_mode``.

When the feature is disabled:

* All draft-session routes (line item create, update, delete, mass update, taxes/discounts
  calculation) return a 404 response.
* The ``oro:cron:draft-session:cleanup:order`` console command is not registered.
* The ``oro.order.draft_session.cleanup.order_draft`` MQ topic is not processed.

.. _bundle-docs-commerce-order-bundle-draft-session-architecture:

Architecture Overview
---------------------

The following diagram shows the main nodes and their relations.

.. code-block:: none

   Route Layer
      Page routes — optional {orderDraftSessionUuid?} path segment:
        oro_order_create                                   create new order
        oro_order_create_for_customer                      create for a specific customer
        oro_order_create_for_customer_user                 create for a specific customer user
        oro_order_update                                   edit existing order
        oro_order_suborder_update                          edit sub-order
        oro_order_reorder                                  create order as copy of existing
        BeginDraftSessionOnRequestListener (component)     generates UUID, redirects if absent on GET

      AJAX entry points — UUID required:
        oro_order_entry_point                              partial-submit handler for OrderType
        oro_suborder_entry_point                           partial-submit handler for SubOrderType

      Line item AJAX routes — UUID required:
        oro_order_line_item_draft_create
        oro_order_line_item_draft_update
        oro_order_line_item_draft_delete
        oro_order_line_item_draft_mass_update
        oro_order_line_item_draft_calculate_taxes_and_discounts

      All routes above share:
        SetDraftSessionUuidToRequestContextListener        stores UUID in RequestContext
        EnableEntityDraftsOnRequestListener (component)    disables ORM draft filter
        KeepDraftSessionUuidOnRouteGenerateListener        auto-appends UUID to generated URLs

   Controller Layer
      OrderController                                    creates the form with draft_session_sync=true
                                                         dispatches OrderEvent on every render
      DraftSessionControllerTrait                        asserts draft exists and access is granted

   Form Layer
      OrderDraftSyncExtension                            form extension (OrderType + SubOrderType)
        PRE_SET_DATA  → loads order from draft (if exists)
        POST_SET_DATA → creates initial draft (if none exists yet)
      SyncOrderToOrderDraftOnOrderEventListener          saves order state to draft on OrderEvent

   Line Item Controllers
      OrderLineItemDraftCreateController                 create a new line item draft
      OrderLineItemDraftUpdateController                 update an existing line item draft
      OrderLineItemDraftDeleteController                 soft-delete a line item draft
      OrderLineItemDraftMassUpdateController             load update forms for multiple items
      OrderLineItemDraftCalculateTaxesAndDiscountsController   taxes/discounts preview

   Save Layer
      UpdateHandlerFacade / OrderFormHandler             persists the original order
      DeleteOrderDraftOnAfterEntityFlushListener         removes the draft after flush

   Business Logic
      OrderDraftManager                                  facade wrapping EntityDraftManager

      Synchronizers (tagged oro_order.draft_session.synchronizer):
        OrderDraftSynchronizer                           order header + line item application
        OrderLineItemDraftSynchronizer                   line item scalar fields
        OrderAddressAwareOrderDraftSynchronizer          billing and shipping addresses
        OrderDiscountAwareOrderDraftSynchronizer         order discounts
        PaymentTermAwareOrderDraftSynchronizer           payment term
        ExtendedFieldsAwareEntityDraftSynchronizer       extended fields (Order + OrderLineItem)
        RecalculateTotalsOrderDraftSynchronizer          recalculate totals (lowest priority)

      Factories (tagged oro_order.draft_session.factory):
        OrderDraftFactory                                instantiates Order drafts
        OrderLineItemDraftFactory                        instantiates OrderLineItem drafts

      Event Listeners:
        ClearDraftSourceOnOrderDraftPersistEventListener clears draft source refs for new entities
                                                         before flush; restores after flush
        OrderDraftAwareTotalCalculateListener            applies draft state before total calculation

Relations summary:

* The draft session UUID travels through every request as a route parameter and is stored in the
  router ``RequestContext`` by the component's ``SetDraftSessionUuidToRequestContextListener``. All
  bundle code that needs the UUID reads it from the context via ``OrderDraftManager``.
* ``OrderController`` creates the order form with ``draft_session_sync=true``, which activates
  ``OrderDraftSyncExtension``. The extension silently replaces the order's field values with draft
  state on every page load and creates the draft when none exists.
* ``SyncOrderToOrderDraftOnOrderEventListener`` makes every ``OrderEvent`` dispatch (which happens on
  each partial submit — address lookup, price recalculation, etc.) persist the current order state
  back to the draft.
* Line item changes do not go through the order form at all. Dedicated AJAX controllers handle
  create, update, and delete of individual ``OrderLineItem`` draft rows without touching the order.
* On final save, ``UpdateHandlerFacade`` flushes the original order (which already contains the
  draft state applied by ``OrderDraftSyncExtension`` on ``PRE_SET_DATA``), and then
  ``DeleteOrderDraftOnAfterEntityFlushListener`` removes the draft.
* ``ClearDraftSourceOnOrderDraftPersistEventListener`` listens on ``EntityDraftPersistBeforeEvent``
  and ``EntityDraftPersistAfterEvent``. When a new (unsaved) order is being drafted, the draft
  source reference must be cleared before the draft flush to avoid a Doctrine "non-persisted
  association" error; the listener restores it afterwards.
* ``OrderDraftAwareTotalCalculateListener`` listens on ``TotalCalculateBeforeEvent`` and calls
  ``loadFromEntityDraft`` before totals are computed, ensuring the calculation uses draft state
  rather than the persisted order state.

Entities
--------

``\Oro\Bundle\OrderBundle\Entity\Order``
    Implements ``EntityDraftAwareInterface``. Carries the three draft fields required by the
    component: ``draftSessionUuid`` (ties this copy to a session), ``draftSource`` (points to the
    original order), and ``drafts`` (the collection of draft copies for the original).

``\Oro\Bundle\OrderBundle\Entity\OrderLineItem``
    Implements ``EntityDraftSoftDeleteAwareInterface``. Carries the same three draft fields plus a
    boolean ``draftDelete`` flag. When the flag is set, the synchronizer removes the corresponding
    original line item when the draft session is saved, without deleting it from the database
    until that point.

.. _bundle-docs-commerce-order-bundle-draft-session-flow:

Request Lifecycle
-----------------

Route and UUID Injection
^^^^^^^^^^^^^^^^^^^^^^^^

Six page routes accept an optional ``{orderDraftSessionUuid?}`` path segment:
``oro_order_create``, ``oro_order_create_for_customer``, ``oro_order_create_for_customer_user``,
``oro_order_update``, ``oro_order_suborder_update``, and ``oro_order_reorder``. The component's
``BeginDraftSessionOnRequestListener`` detects when this segment is absent on a safe (GET) request
and redirects the browser to the same URL with a freshly generated UUID appended.

The two AJAX entry point routes — ``oro_order_entry_point`` and ``oro_suborder_entry_point`` — and
the five line item draft routes always require the UUID; they do not generate it.

``SetDraftSessionUuidToRequestContextListener`` stores the UUID in the router ``RequestContext``
for all routes, so it is available to all services without needing to pass it through arguments.
``EnableEntityDraftsOnRequestListener`` disables the ORM draft filter for all applicable routes
so that draft rows are visible alongside original rows. ``KeepDraftSessionUuidOnRouteGenerateListener``
automatically injects the UUID into any URL generated for the same set of routes so that internal
links and redirects carry the session forward without manual intervention.

``OrderController`` and ``DraftSessionControllerTrait``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``\Oro\Bundle\OrderBundle\Controller\OrderController``

**Purpose:** Entry point for the order edit page. Responsible for building the order form and
dispatching ``OrderEvent`` on each render.

**Principles:**

* The form is always created with the ``draft_session_sync`` option set to ``true``. This is what
  activates ``OrderDraftSyncExtension`` for this particular form instance.
* After building the form, the controller dispatches ``\Oro\Bundle\OrderBundle\Event\OrderEvent``
  via ``EventDispatcher``. Listeners on this event — including
  ``SyncOrderToOrderDraftOnOrderEventListener`` — perform draft-related work in response.
* The controller delegates the actual form handling and persistence to ``UpdateHandlerFacade`` and
  ``OrderFormHandler``. It does not interact with the draft infrastructure directly.

``\Oro\Bundle\OrderBundle\Controller\DraftSession\DraftSessionControllerTrait``

**Purpose:** Shared security guard for all line item draft controllers.

**Principles:**

* Before any line item operation, every draft controller asserts that a draft exists for the order
  and that the current user holds the ``oro_order_update`` ACL permission on the draft entity. This
  is a deliberate extra check: the draft entity is a separate database row from the original, so
  the standard ACL vote on the original order is not sufficient.
* If the draft is not found, or if the user lacks permission, the controller throws a 404 or 403
  response before any form or data logic runs.

Form Initialization (OrderDraftSyncExtension)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``\Oro\Bundle\OrderBundle\Form\Extension\OrderDraftSyncExtension``

**Purpose:** Silently replace the order's field values with draft state before the form is rendered,
and ensure a draft always exists for the session before line item AJAX calls begin.

**Principles:**

* The extension is only active when ``draft_session_sync=true`` is set on the form options and a
  draft session UUID is present in the ``RequestContext``. When either condition is not met, the
  extension does nothing. This makes it safe to attach to ``OrderType`` and ``SubOrderType``
  unconditionally.
* On ``FormEvents::PRE_SET_DATA`` (priority 100), the extension calls
  ``OrderDraftManager::loadFromEntityDraft($order)``. If a draft exists for the current session,
  the order entity's fields are overwritten in memory with the draft's state before the form binds
  its data. The user therefore always sees the most recent draft state, never the last database
  state.
* On ``FormEvents::POST_SET_DATA`` (priority -100), the extension checks whether a draft already
  exists. If not — which is the case on the very first GET request for this order and session — it
  saves the current order state to a new draft immediately. This guarantees a draft row is present
  before any line item AJAX request arrives.

**Things to consider:**

* The PRE_SET_DATA load triggers the synchronizer chain, which dispatches
  ``EntityFromDraftSyncBeforeEvent`` and ``EntityFromDraftSyncEvent``. Custom listeners on those
  events run as part of the page load, not just during save operations.
* The POST_SET_DATA save goes through ``EntityDraftPersister``, which temporarily isolates
  non-draft unit-of-work entries during the flush (see
  :ref:`DraftSession component — Unit of Work Isolators <bundle-docs-platform-draft-session-internal-collaborators>`).
  Non-draft changes pending in the entity manager are suppressed during this flush and restored
  immediately afterwards — they are not lost.

Syncing Order Changes to the Draft (SyncOrderToOrderDraftOnOrderEventListener)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``\Oro\Bundle\OrderBundle\EventListener\DraftSession\SyncOrderToOrderDraftOnOrderEventListener``

**Purpose:** Persist the current order state to the draft whenever a partial submit changes
order-header fields (customer, payment term, addresses, currency, pricing).

**Principles:**

* The listener handles ``\Oro\Bundle\OrderBundle\Event\OrderEvent``, which is dispatched by
  ``OrderController`` on every response — both GET (initial load) and POST (partial or full submit).
* It only acts when three conditions are all true: the form was submitted, ``draft_session_sync``
  is enabled on the form, and a draft already exists for the order.
* When conditions are met, it calls ``OrderDraftManager::saveToEntityDraft($order)`` to persist
  the current in-memory order state into the draft row.

**Things to consider:**

* ``EntityDraftPersister`` temporarily suppresses non-draft unit-of-work entries during the draft
  flush and restores them immediately afterwards. The listener itself is stateless across requests,
  so this isolation has no observable side effects on it.
* This listener only handles the order entity. Line item changes are not routed through
  ``OrderEvent`` — they go through dedicated AJAX controllers.

Line Item Management (Draft Controllers)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Individual line item operations are handled by five dedicated AJAX controllers. All share the
following characteristics:

* Every route requires the ``{orderDraftSessionUuid}`` parameter.
* Every controller uses ``DraftSessionControllerTrait`` to assert the draft exists and is accessible.
* Every controller calls ``OrderDraftManager::loadFromEntityDraft($order)`` first to read the
  current draft state of the order before acting on any of its line items.

``OrderLineItemDraftCreateController`` (``oro_order_line_item_draft_create``)
    Renders and processes the form for creating a new line item draft. On valid submission, saves
    the new line item to the draft and triggers a datagrid refresh.

``OrderLineItemDraftUpdateController`` (``oro_order_line_item_draft_update``)
    Renders and processes the form for modifying an existing line item draft. On valid submission,
    saves the updated state to the draft and triggers a datagrid refresh. On initial load, also
    fetches and passes taxes and discounts for display.

``OrderLineItemDraftDeleteController`` (``oro_order_line_item_draft_delete``)
    Schedules the line item for deletion via ``EntityManager::remove()``, then saves it to the draft.
    This sets the ``draftDelete`` flag on the draft row; the original line item is not deleted until
    the order is finally saved. The approach defers the deletion so that saving the order is still
    reversible by discarding the session.

``OrderLineItemDraftMassUpdateController`` (``oro_order_line_item_draft_mass_update``)
    Returns rendered update forms for a comma-separated list of line item IDs in a single response.
    Used to populate the editing UI for multiple rows without one round-trip per line item.

``OrderLineItemDraftCalculateTaxesAndDiscountsController`` (``oro_order_line_item_draft_calculate_taxes_and_discounts``)
    Accepts a submitted line item form, applies promotions to a transient order snapshot, and returns
    the taxes and discounts breakdown as rendered HTML. Nothing is persisted.

Final Save (DeleteOrderDraftOnAfterEntityFlushListener)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``\Oro\Bundle\OrderBundle\EventListener\DraftSession\DeleteOrderDraftOnAfterEntityFlushListener``

**Purpose:** Remove the draft entity after the original order has been flushed to the database.

**Principles:**

* The listener reacts to ``AfterFormProcessEvent``, which ``UpdateHandlerFacade`` dispatches after
  a successful flush.
* At the point this listener runs, the form's ``PRE_SET_DATA`` pass has already applied the draft
  state to the original order entity (via ``OrderDraftSyncExtension``), so flushing the original
  order effectively persists all draft changes. The draft entity is now redundant and is removed by
  calling ``OrderDraftManager::deleteEntityDraft($order)``.

Key Components
--------------

OrderDraftManager
^^^^^^^^^^^^^^^^^

``\Oro\Bundle\OrderBundle\DraftSession\Manager\OrderDraftManager``

**Purpose:** Unified entry point for all draft-session operations within the Order bundle. Wraps
the component-level ``EntityDraftManager`` and reads the current draft session UUID from the
``RequestContext`` automatically when none is supplied.

**Principles:**

* Provides five operations: check whether a draft exists, find a draft, load entity state from a
  draft, save entity state to a draft, and delete a draft.
* The load operation is in-memory and read-only. The save and delete operations flush to the
  database using the unit-of-work isolation and listener isolation strategy described in the
  :ref:`DraftSession component <bundle-docs-platform-draft-session-internal-collaborators>`.

**Things to consider:**

* ``saveToEntityDraft`` temporarily suppresses non-draft unit-of-work entries during the draft
  flush. Pending non-draft changes are not lost — they are restored immediately after the flush.
* Synchronizers for ``Order`` and ``OrderLineItem`` use ``EntityDraftSyncReferenceResolver`` to
  ensure related entities (customer, currency, product, etc.) are managed by the entity manager
  before being assigned to the draft. Custom synchronizers for order-related entities should do
  the same for any relation fields they copy.

Synchronizers
^^^^^^^^^^^^^

Seven synchronizers, each tagged with ``oro_order.draft_session.synchronizer``, collectively handle
all fields. The chain pattern means each synchronizer owns a single concern and any number of
synchronizers can be added without modifying existing ones.

``OrderDraftSynchronizer``
    Copies order header fields. When applying draft changes to the original order (sync-from-draft),
    it also processes line item changes: creates new original line items for each new draft line item,
    applies soft-deletes (`draftDelete` flag), and updates existing ones. This is the synchronizer
    that physically moves line item draft state into the real order on save.

``OrderLineItemDraftSynchronizer``
    Copies all scalar fields of a single ``OrderLineItem``, including kit item line items and kit
    item extended fields.

``OrderAddressAwareOrderDraftSynchronizer``
    Copies billing and shipping address associations.

``OrderDiscountAwareOrderDraftSynchronizer``
    Copies the order's discount collection.

``PaymentTermAwareOrderDraftSynchronizer``
    Copies the payment term association.

``ExtendedFieldsAwareEntityDraftSynchronizer``
    Registered once for ``Order`` and once for ``OrderLineItem``. Automatically copies all
    form-enabled custom extended fields. See :ref:`Excluding Extended Fields <bundle-docs-platform-draft-session-excluding-fields>` for how to opt out specific fields.

``RecalculateTotalsOrderDraftSynchronizer``
    Recalculates order totals after all other synchronizers have finished. Tagged with the lowest
    priority to guarantee it runs last.

Twig Integration
^^^^^^^^^^^^^^^^

The bundle registers three Twig functions via ``OrderDraftExtension``.

``oro_order_draft_session_uuid()``
    Returns the current draft session UUID string, or ``null`` when the request is not inside a
    draft session. Use it to detect whether the draft editing mode is active and to conditionally
    render draft-specific controls or construct draft-aware URLs.

    .. code-block:: twig

       {% set draftSessionUuid = oro_order_draft_session_uuid() %}
       {% if draftSessionUuid %}
          {# render draft-aware datagrid or action buttons #}
       {% endif %}

``oro_order_get_order_or_draft_id(order)``
    Returns the ID of the draft entity when inside a draft session, or the ID of the original
    order when outside one. Use it wherever a template needs a single stable ID that represents
    the entity currently being edited, regardless of whether a draft is active.

    .. code-block:: twig

       <form action="{{ path('oro_order_update', {id: oro_order_get_order_or_draft_id(order)}) }}">

``oro_order_get_order_draft_id(order)``
    Returns the ID of the draft entity for the given order if a draft currently exists for the
    active session, or ``null`` otherwise. Differs from ``oro_order_get_order_or_draft_id`` in
    that it always returns ``null`` outside a draft session rather than falling back to the
    original order ID.

    .. code-block:: twig

       {% set draftId = oro_order_get_order_draft_id(order) %}
       {% if draftId %}
          {# act on the draft row directly #}
       {% endif %}

Draft Cleanup
-------------

Abandoned drafts — sessions left without saving — are cleaned up automatically by the
``oro:cron:draft-session:cleanup:order`` cron command (scheduled at midnight daily). The command
sends a message to the message queue; the ``EntityDraftsCleanupProcessor`` then batch-deletes all
draft ``Order`` and ``OrderLineItem`` rows whose ``updatedAt`` timestamp is older than the
configured threshold (default: 7 days).

To trigger cleanup manually or override the lifetime:

.. code-block:: bash

   # Use the default lifetime of 7 days
   php bin/console oro:cron:draft-session:cleanup:order

   # Specify a custom lifetime
   php bin/console oro:cron:draft-session:cleanup:order --draft-lifetime=30

Customization
-------------

Adding a Custom Field Synchronizer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To synchronize an additional field (for example, a field introduced by a third-party bundle),
implement ``\Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerInterface`` and tag
the service with ``oro_order.draft_session.synchronizer``.

If the field is a relation, inject ``\Oro\Component\DraftSession\Doctrine\EntityDraftSyncReferenceResolver``
and use it to ensure the related entity is managed by the entity manager before assigning it to
the draft:

.. code-block:: php

   namespace Acme\Bundle\OrderBundle\DraftSession;

   use Oro\Bundle\OrderBundle\Entity\Order;
   use Oro\Component\DraftSession\Doctrine\EntityDraftSyncReferenceResolver;
   use Oro\Component\DraftSession\Entity\EntityDraftAwareInterface;
   use Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerInterface;

   class WarehouseOrderDraftSynchronizer implements EntityDraftSynchronizerInterface
   {
       public function __construct(
           private readonly EntityDraftSyncReferenceResolver $referenceResolver,
       ) {
       }

       public function supports(string $entityClass): bool
       {
           return $entityClass === Order::class;
       }

       public function synchronizeFromDraft(
           EntityDraftAwareInterface $draft,
           EntityDraftAwareInterface $entity
       ): void {
           assert($draft instanceof Order);
           assert($entity instanceof Order);

           $entity->setWarehouse($this->referenceResolver->getReference($draft->getWarehouse()));
       }

       public function synchronizeToDraft(
           EntityDraftAwareInterface $entity,
           EntityDraftAwareInterface $draft
       ): void {
           assert($entity instanceof Order);
           assert($draft instanceof Order);

           $draft->setWarehouse($this->referenceResolver->getReference($entity->getWarehouse()));
       }
   }

.. code-block:: yaml
   :caption: config/services.yaml

   acme_order.draft_session.warehouse_order_draft_synchronizer:
       class: Acme\Bundle\OrderBundle\DraftSession\WarehouseOrderDraftSynchronizer
       arguments:
           - '@Oro\Component\DraftSession\Doctrine\EntityDraftSyncReferenceResolver'
       tags:
           - { name: oro_order.draft_session.synchronizer }

Listening to Draft Lifecycle Events
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The component dispatches lifecycle events at every key point of the draft workflow. For the full
reference see :ref:`DraftSession Component — Events <bundle-docs-platform-draft-session-events>`.
The most useful ones for order customization are:

``EntityDraftCreatedEvent``
    Fired after a factory instantiates a new draft. Use it to set computed defaults or copy
    non-mapped state without modifying the factory itself.

``EntityFromDraftSyncBeforeEvent``
    Fired before synchronizers apply draft state to the original entity. Use it when the
    synchronizer needs associations on the draft to be initialized before the bulk field copy
    begins — register a listener here to eagerly load the required relations.

``EntityFromDraftSyncEvent``
    Fired after synchronizers finish applying draft state. Use it to react to the final synchronized
    state of the entity — for example, to trigger downstream recalculations.

``EntityToDraftSyncBeforeEvent``
    Fired before synchronizers copy entity state to the draft. Use it to capture or prepare entity
    state before the bulk field copy begins.

``EntityToDraftSyncEvent``
    Fired after synchronizers finish copying entity state to the draft. Use it to react to the
    final synchronized state of the draft.

``EntityDraftPersistBeforeEvent`` / ``EntityDraftPersistAfterEvent``
    Fired immediately before and after the draft is flushed. The Order bundle uses these events in
    ``ClearDraftSourceOnOrderDraftPersistEventListener`` to temporarily clear draft source
    references on new (unsaved) entities before the flush — to avoid a Doctrine "non-persisted
    association" error — and to restore them immediately afterwards.

Example — performing additional initialization on a newly created order draft:

.. code-block:: php

   namespace Acme\Bundle\OrderBundle\EventListener\DraftSession;

   use Oro\Bundle\OrderBundle\Entity\Order;
   use Oro\Component\DraftSession\Event\EntityDraftCreatedEvent;

   class SetDefaultsOnOrderDraftCreatedListener
   {
       public function onEntityDraftCreated(EntityDraftCreatedEvent $event): void
       {
           $draft = $event->getDraft();
           if (!$draft instanceof Order) {
               return;
           }

           // Perform any post-creation initialization on the draft.
           $draft->setCustomerNotes('Draft in progress');
       }
   }

.. code-block:: yaml
   :caption: config/services.yaml

   acme_order.event_listener.set_defaults_on_order_draft_created:
       class: Acme\Bundle\OrderBundle\EventListener\DraftSession\SetDefaultsOnOrderDraftCreatedListener
       tags:
           - { name: kernel.event_listener, event: Oro\Component\DraftSession\Event\EntityDraftCreatedEvent, method: onEntityDraftCreated }

Excluding Extended Fields from Automatic Synchronization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``ExtendedFieldsAwareEntityDraftSynchronizer`` automatically copies all form-enabled custom extended
fields. If a dedicated synchronizer already handles a specific field, exclude it from the automatic
sync to prevent duplicate or conflicting writes.

Use ``\Oro\Bundle\OrderBundle\DependencyInjection\Compiler\ExcludeExtendedFieldFromDraftSyncPass``
in the bundle's ``build()`` method:

.. code-block:: php

   namespace Acme\Bundle\OrderBundle;

   use Oro\Bundle\OrderBundle\DependencyInjection\Compiler\ExcludeExtendedFieldFromDraftSyncPass;
   use Oro\Bundle\OrderBundle\Entity\Order;
   use Oro\Bundle\OrderBundle\Entity\OrderLineItem;
   use Symfony\Component\DependencyInjection\ContainerBuilder;
   use Symfony\Component\HttpKernel\Bundle\Bundle;

   class AcmeOrderBundle extends Bundle
   {
       public function build(ContainerBuilder $container): void
       {
           parent::build($container);

           $container->addCompilerPass(
               new ExcludeExtendedFieldFromDraftSyncPass([
                   [Order::class, 'warehouse'],
                   [OrderLineItem::class, 'warehouse'],
               ])
           );
       }
   }

.. include:: /include/include-links-dev.rst
   :start-after: begin
