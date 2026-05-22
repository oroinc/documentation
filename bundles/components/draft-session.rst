:title: OroPlatform, DraftSession Component

.. meta::
   :description: The DraftSession component provides the foundation for session-based entity draft editing in OroCommerce back-office workflows.

.. _bundle-docs-platform-draft-session:

DraftSession Component
======================

The ``Oro\Component\DraftSession`` component provides the infrastructure for **session-based entity draft editing**. It is designed for workflows where a back-office user needs to make several incremental changes to a persistent entity and apply all of them at once — without affecting the stored data until an explicit save.

Key concepts:

* A **draft session** is identified by a UUID that is present in the current request route and in the router ``RequestContext``.
* A **draft entity** is a temporary copy of a persistent entity. It shares the same table as the original and is distinguished by a non-null ``draftSessionUuid`` column.
* The **DraftSession ORM filter** automatically excludes draft entities from all regular Doctrine queries while the filter is enabled.
* When the user saves, the draft state is **synchronized** back to the original entity and then the draft is deleted.

.. _bundle-docs-platform-draft-session-architecture:

Architecture Overview
---------------------

The component is organized into seven layers. The diagram below shows the main nodes and their relations.

.. code-block:: none

   Request Layer
     BeginDraftSessionOnRequestListener      generates a UUID and redirects if absent from the route
     SetDraftSessionUuidToRequestContextListener   stores UUID in the router RequestContext
     KeepDraftSessionUuidOnRouteGenerateListener   propagates UUID into every generated URL

   Entity Layer
     DraftSessionAwareInterface              lightweight contract: draftSessionUuid only
       ↑ all entities related to a draft-aware entity must implement this at minimum
     EntityDraftAwareInterface               extends above: adds draftSource and drafts collection
     EntityDraftSoftDeleteAwareInterface     extends EntityDraftAwareInterface with a draftDelete flag

   ORM Layer
     DraftSessionOrmFilter                   appends draftSessionUuid IS NULL to all draft-aware queries
     DraftSessionOrmFilterManager            controlled enable / disable / check of the filter

   Provider Layer
     DraftSessionUuidProvider                reads the draft session UUID from the router RequestContext
     EntityDraftRepositoryChain              routes draft lookups to the first matching repository
       └─► EntityDraftRepositoryInterface    one implementation per entity class
             ├─ GenericEntityDraftRepository   finds draft by entity ID + session UUID
             └─ ExclusiveEntityDraftRepository finds draft by session UUID only (no source entity)

   Operations Facade
     EntityDraftManager                      main entry point for application code
       │
       ├─► EntityDraftLoader                 apply draft state to an entity (read-only)
       │     ├─ uses EntityDraftRepositoryInterface
       │     └─ uses EntityDraftSynchronizerInterface
       │
       ├─► EntityDraftPersister              persist entity state to a draft
       │     ├─ uses EntityDraftRepositoryInterface
       │     ├─ uses EntityDraftFactoryInterface   (create path: no draft exists yet)
       │     ├─ uses EntityDraftSynchronizerInterface  (update path: draft already exists)
       │     ├─ uses DoctrineListenersIsolator
       │     └─ uses DraftEntitiesEntityManagerIsolator
       │
       └─► EntityDraftRemover               delete a draft
             ├─ uses EntityDraftRepositoryInterface
             ├─ uses DoctrineListenersIsolator
             └─ uses DraftEntitiesEntityManagerIsolator

   Synchronization / Creation Layer
     EntityDraftSynchronizerChain            runs all matching EntityDraftSynchronizerInterface implementations
       └─► EntityDraftSynchronizerInterface  one implementation per entity class or field concern
             └─ ExtendedFieldsAwareEntityDraftSynchronizer  reusable implementation for extended fields

     EntityDraftFactoryChain                 delegates to first matching EntityDraftFactoryInterface implementation
       └─► EntityDraftFactoryInterface       one implementation per entity class

     EntityDraftSyncReferenceResolver        resolves managed entity references inside synchronizers

   Isolator Layer
     DoctrineListenersIsolator               disables all Doctrine event listeners except a whitelist
     DraftEntitiesEntityManagerIsolator      flushes only draft entities by isolating non-draft UoW entries
     NonDraftEntitiesEntityManagerIsolator   flushes only non-draft entities by isolating draft UoW entries
       └─► DraftEntitiesUnitOfWorkIsolator   extracts/restores draft scheduling entries in the UoW
       └─► NonDraftEntitiesUnitOfWorkIsolator  extracts/restores non-draft scheduling entries in the UoW
             └─ UnitOfWorkSnapshot           immutable snapshot of extracted UoW state

   Cleanup Layer
     EntityDraftsCleanupProcessor (MQ)       receives lifetime config, delegates to strategy
       └─► EntityDraftsCleanupStrategyInterface
             ├─ GenericEntityDraftsCleanupStrategy    single entity class
             └─ CompositeEntityDraftsCleanupStrategy  multiple entity classes

Relations summary:

* ``EntityDraftManager`` is the single facade that application and bundle code should call. It resolves the draft session UUID via ``DraftSessionUuidProvider`` (which reads from the router ``RequestContext``) and delegates the actual work to ``EntityDraftLoader``, ``EntityDraftPersister``, and ``EntityDraftRemover``.
* All three collaborators receive an ``EntityDraftRepositoryInterface`` for draft lookups. In the typical wire-up, a ``EntityDraftRepositoryChain`` is injected, routing each lookup to the first matching per-entity implementation.
* ``EntityDraftPersister`` isolates Doctrine event listeners via ``DoctrineListenersIsolator`` and uses ``DraftEntitiesEntityManagerIsolator`` to flush only draft-related changes. Non-draft changes that are pending in the unit of work are temporarily extracted, the draft-only flush runs, and the non-draft entries are restored — no entity manager clear takes place. The persister uses ``EntityDraftFactoryInterface`` to create a new draft row when none exists, or ``EntityDraftSynchronizerInterface`` to refresh an existing one.
* ``EntityDraftLoader`` uses ``EntityDraftSynchronizerInterface`` to copy draft fields back onto the original entity in memory. Nothing is persisted.
* ``EntityDraftRemover`` isolates Doctrine event listeners the same way as the persister, uses ``DraftEntitiesEntityManagerIsolator`` for the flush, and dispatches ``EntityDraftDeleteBeforeEvent`` before flushing the removal.
* Both ``EntityDraftFactoryChain`` and ``EntityDraftSynchronizerChain`` dispatch events before and after completing their work, making them the primary extension points alongside tagged service registration.
* The ``DraftSessionOrmFilter`` is the transparency guarantee: all draft rows are invisible to the rest of the application unless the filter is explicitly disabled for a specific route via ``EnableEntityDraftsOnRequestListener`` or programmatically via ``DraftSessionOrmFilterManager``.
* When a synchronizer copies a relation field from the source entity to the draft, the referenced entity may not be tracked by the entity manager in the current context. Synchronizer implementations must use ``EntityDraftSyncReferenceResolver`` to obtain a fresh managed reference.

Events dispatched (``Oro\Component\DraftSession\Event`` namespace):

* ``EntityDraftCreatedEvent`` — after a factory creates a draft.
* ``EntityFromDraftSyncBeforeEvent`` — before synchronizers apply draft state to the original entity.
* ``EntityFromDraftSyncEvent`` — after synchronizers finish applying draft state to the original entity.
* ``EntityToDraftSyncBeforeEvent`` — before synchronizers copy entity state to the draft.
* ``EntityToDraftSyncEvent`` — after synchronizers finish copying entity state to the draft.
* ``EntityDraftPersistBeforeEvent`` / ``EntityDraftPersistAfterEvent`` — before and after the draft is flushed.
* ``EntityDraftDeleteBeforeEvent`` — after the draft is scheduled for removal, before the flush.

.. _bundle-docs-platform-draft-session-interfaces:

Entity Interfaces
-----------------

The Component defines three interfaces that determine at what level an entity participates in a draft session.

**The related-entity requirement.** Every entity that is created, updated, or deleted as part of an ``EntityDraftAwareInterface`` entity's draft session must implement ``DraftSessionAwareInterface`` at minimum. Two component mechanisms depend on this contract:

* ``DraftSessionOrmFilter`` determines whether to append the ``draftSessionUuid IS NULL`` constraint by checking whether the entity's ``ClassMetadata`` declares a mapped ``draftSessionUuid`` field. An entity without this mapped field is invisible to the filter, so its draft rows will appear in normal application queries and break the transparency guarantee.
* The UoW isolators (``DraftEntitiesUnitOfWorkIsolator`` and ``NonDraftEntitiesUnitOfWorkIsolator``) classify every UoW scheduling entry as a draft or a non-draft row by testing ``$entity instanceof DraftSessionAwareInterface && $entity->getDraftSessionUuid() !== null``. A related entity that does not implement the interface cannot be identified as a draft row and will not be correctly isolated during the partial-flush strategy — it may be flushed at the wrong time or suppressed unintentionally.

To satisfy both mechanisms an entity must implement ``DraftSessionAwareInterface`` and use ``DraftSessionAwareTrait`` (or provide an equivalent ORM mapping) so that the ``draft_session_uuid`` column exists in the entity's table.

Choose the interface based on the entity's role in the draft session:

* **Root draft entity** — the entity the user edits through the draft form — must implement ``EntityDraftAwareInterface``. It requires a self-referencing ``draftSource`` association and a ``drafts`` one-to-many collection declared with concrete Doctrine ORM annotations directly in the entity class.
* **Collection member with deferred deletion** — a child entity that can be removed in the draft state and must only be physically deleted when the user saves — must implement ``EntityDraftSoftDeleteAwareInterface``.
* **Simple related entity** — any other entity that participates in the draft session by carrying the same UUID as its parent, without needing its own source reference or drafts collection — need only implement ``DraftSessionAwareInterface``.

``\Oro\Component\DraftSession\Entity\DraftSessionAwareInterface``
    A lightweight contract for entities that only need to carry a draft session UUID. Requires a single Doctrine-mapped field (``draftSessionUuid``) and is the minimum interface that both the ORM filter and the isolator-layer UoW inspection code use to identify draft rows. Entities that only participate in a session by UUID — without needing a source reference or a draft copies collection — should implement this interface rather than the heavier ``EntityDraftAwareInterface``. This interface is intentionally separate from the platform's ``\Oro\Bundle\DraftBundle\Entity\DraftableInterface``, which serves a different purpose (project-based publish workflow versus session-based edit drafts).

``\Oro\Component\DraftSession\Entity\EntityDraftAwareInterface``
    Extends ``DraftSessionAwareInterface`` with the full draft lifecycle contract. Must be implemented by the root draft entity and by any collection member that also needs its own source reference. Adds a self-referencing association to the original entity the draft was created from and a collection of all draft copies that exist for the entity. The ``$draftSource`` (``ManyToOne`` self-reference) and ``$drafts`` (``OneToMany`` collection, ``mappedBy: 'draftSource'``) properties cannot be mapped generically in a trait — each entity class must declare them with concrete Doctrine ORM annotations and initialize ``$drafts`` to a ``new ArrayCollection()`` in the constructor.

``\Oro\Component\DraftSession\Entity\EntityDraftSoftDeleteAwareInterface``
    Extends ``EntityDraftAwareInterface`` with a boolean deletion flag (``isDraftDelete()`` / ``setDraftDelete()``). When the flag is set on a collection member, the corresponding original entity is removed when the draft session is saved rather than immediately. Use this interface for child collection members where deletion must be deferred until the parent form is committed.

.. _bundle-docs-platform-draft-session-traits:

Reusable Traits
^^^^^^^^^^^^^^^

The Component ships three traits that provide complete, Doctrine-mapped implementations of the corresponding interfaces.

``\Oro\Component\DraftSession\Entity\DraftSessionAwareTrait``
    Maps the ``draft_session_uuid`` ORM column (nullable ``GUID``) and implements ``getDraftSessionUuid()`` and ``setDraftSessionUuid()``. Use this trait for entities that implement ``DraftSessionAwareInterface`` only (simple related entities).

``\Oro\Component\DraftSession\Entity\EntityDraftAwareTrait``
    Extends ``DraftSessionAwareTrait`` and implements ``getDraftSource()``, ``setDraftSource()``, ``getDrafts()``, ``addDraft()``, and ``removeDraft()``. The trait does not declare or map the ``$draftSource`` and ``$drafts`` properties — each entity class using the trait must add these two properties with ``#[ORM\ManyToOne]`` and ``#[ORM\OneToMany]`` annotations respectively, and the constructor must initialize ``$drafts`` to a ``new ArrayCollection()``.

``\Oro\Component\DraftSession\Entity\EntityDraftSoftDeleteAwareTrait``
    Maps the ``draft_delete`` boolean ORM column and implements ``isDraftDelete()`` and ``setDraftDelete()``. Combine with ``EntityDraftAwareTrait`` for entities that implement ``EntityDraftSoftDeleteAwareInterface``.

The following example shows the three-level pattern as used in the Order bundle:

.. code-block:: php

   // Root draft entity — full lifecycle: source reference and drafts collection.
   class Order implements EntityDraftAwareInterface
   {
       use EntityDraftAwareTrait; // provides draftSessionUuid field + source/drafts helpers

       // $draftSource and $drafts must be declared with concrete ORM annotations.
       #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'drafts')]
       #[ORM\JoinColumn(name: 'draft_source_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
       protected ?self $draftSource = null;

       #[ORM\OneToMany(mappedBy: 'draftSource', targetEntity: Order::class, fetch: 'EXTRA_LAZY')]
       protected ?Collection $drafts = null;

       public function __construct()
       {
           $this->drafts = new ArrayCollection();
       }
   }

   // Collection member with deferred deletion — supports the soft-delete flag.
   class OrderLineItem implements EntityDraftSoftDeleteAwareInterface
   {
       use EntityDraftAwareTrait;           // draftSessionUuid + source/drafts helpers
       use EntityDraftSoftDeleteAwareTrait; // draft_delete column

       // $draftSource and $drafts must also be declared with ORM annotations here.
       #[ORM\ManyToOne(targetEntity: OrderLineItem::class, inversedBy: 'drafts')]
       #[ORM\JoinColumn(name: 'draft_source_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
       protected ?self $draftSource = null;

       #[ORM\OneToMany(mappedBy: 'draftSource', targetEntity: OrderLineItem::class, fetch: 'EXTRA_LAZY')]
       protected ?Collection $drafts = null;
   }

   // Simple related entity — carries the UUID so the ORM filter and UoW isolators work.
   class OrderDiscount implements DraftSessionAwareInterface
   {
       use DraftSessionAwareTrait; // draft_session_uuid column only
   }

.. _bundle-docs-platform-draft-session-entity-draft-manager:

EntityDraftManager
------------------

``\Oro\Component\DraftSession\Manager\EntityDraftManager`` is the **main component-level facade** for draft-session operations. Bundle-level services (such as ``OrderDraftManager`` in the Order bundle) delegate to this service rather than calling the lower-level collaborators directly.

The manager provides five operations: checking whether a draft exists for an entity, finding a draft entity, loading entity state from a draft (delegates to ``EntityDraftLoader``), saving entity state to a draft (delegates to ``EntityDraftPersister``), and deleting a draft (delegates to ``EntityDraftRemover``). All operations accept an optional explicit draft session UUID; when omitted, the UUID is resolved from the router ``RequestContext`` via ``DraftSessionUuidProvider``.

.. _bundle-docs-platform-draft-session-repository:

Draft Repository
----------------

The repository layer is responsible for **looking up whether a draft exists** and for **fetching the draft entity** for a given source entity and draft session UUID. All three internal collaborators (``EntityDraftLoader``, ``EntityDraftPersister``, ``EntityDraftRemover``) use the repository to locate drafts rather than querying entities directly.

``\Oro\Component\DraftSession\Provider\EntityDraftRepositoryInterface``
    The contract all repository implementations must satisfy. One implementation is required per entity class. The repository must be able to both check for the existence of a draft and return it. This is the main extension point for customizing how drafts are composed when fetched — for example, loading specific relations eagerly alongside the draft in a single query.

``\Oro\Component\DraftSession\Provider\EntityDraftRepositoryChain``
    Aggregates all tagged ``EntityDraftRepositoryInterface`` implementations and routes each lookup to the first one that declares support for the given entity class.

``\Oro\Component\DraftSession\Provider\GenericEntityDraftRepository``
    A reusable implementation that looks up a draft by matching either the entity ID or the draft ID against ``draftSource`` and the provided draft session UUID. Suitable for most entity classes where the draft always has a source entity.

``\Oro\Component\DraftSession\Provider\ExclusiveEntityDraftRepository``
    A simpler implementation that looks up a draft by draft session UUID alone, without involving the source entity identity. Use this for entity classes where there is always at most one draft per session and no source entity association is needed (for example, a root-level entity where a single draft per session is guaranteed).

To register a custom repository, implement ``EntityDraftRepositoryInterface``, tag the service with the repository tag defined by the consuming bundle, and ensure the ``supports()`` method returns ``true`` only for the intended entity class.

.. _bundle-docs-platform-draft-session-request-listeners:

Request Lifecycle Listeners
---------------------------

The following listeners wire the draft session UUID into the Symfony request lifecycle:

``BeginDraftSessionOnRequestListener``
    On safe (read-only) HTTP requests to a configured list of routes, checks whether a draft session UUID is already present in the route. If it is absent, the listener generates a new UUID and redirects the browser to the same URL with the UUID appended. This guarantees every draft-aware page load has a session UUID before any form or controller logic runs.

``SetDraftSessionUuidToRequestContextListener``
    On every request, reads the current draft session UUID (if any) from the request and stores it in the router ``RequestContext``. This makes the UUID accessible to URL generators without passing it explicitly.

``KeepDraftSessionUuidOnRouteGenerateListener``
    When a configured route is being generated, copies the UUID from the ``RequestContext`` into the generated URL parameters. This ensures that links generated inside a draft session page automatically carry the same UUID.

.. _bundle-docs-platform-draft-session-orm-filter:

ORM Filter
----------

``\Oro\Component\DraftSession\Doctrine\DraftSessionOrmFilter``
    A Doctrine SQL filter that appends a ``draftSessionUuid IS NULL`` condition to every query involving a draft-aware entity. When enabled (the default), all draft rows are invisible to regular application queries, so no existing code needs to be aware of the draft table rows.

``\Oro\Component\DraftSession\Manager\DraftSessionOrmFilterManager``
    Provides controlled enable/disable/check access to the ORM filter. Use it whenever draft rows must be temporarily visible — for example, inside cleanup strategies or dedicated draft controllers that need to read or write draft rows directly.

``\Oro\Component\DraftSession\EventListener\EnableEntityDraftsOnRequestListener``
    Disables the ORM filter for a configurable list of routes on ``kernel.request`` and re-enables it on ``kernel.terminate``. Register this listener for any route that legitimately needs direct access to draft rows.

.. _bundle-docs-platform-draft-session-internal-collaborators:

Internal Collaborators
----------------------

The collaborator services described here are not intended to be called directly by most application code — use ``EntityDraftManager`` instead. They are documented to clarify the principles that govern each operation and what to keep in mind when reacting to the events they dispatch.

EntityDraftLoader
^^^^^^^^^^^^^^^^^

**Purpose:** Bring a regular entity's in-memory state in line with the draft that exists for the current draft session, without touching the database.

**Principles:**

* The loader is flexible about its input: it accepts both a regular entity and a draft entity, resolving the appropriate source and target internally.
* When given a draft with a persisted source, it synchronizes fields from the draft into the original entity and returns it.
* When given a draft that has no source (an entity being created for the first time), it instantiates a new entity and synchronizes the draft into it.
* When given a regular entity, it looks up its draft and synchronizes if found; if no draft exists, the entity is returned unchanged.
* The operation is **purely in-memory and read-only** from a persistence perspective — nothing is flushed.

**Things to consider:**

* Synchronization triggers ``EntityFromDraftSyncBeforeEvent`` and ``EntityFromDraftSyncEvent``, so all listeners registered for those events will run during a load operation.
* If a synchronizer reads associations on the draft entity and those associations are not yet initialized, they must be eagerly loaded before synchronization begins. The best place to do this is in a listener on ``EntityFromDraftSyncBeforeEvent``.

EntityDraftPersister
^^^^^^^^^^^^^^^^^^^^

**Purpose:** Persist an entity's current state to its draft within the draft session, creating a new draft when none exists or updating the existing one.

**Principles:**

* The persister captures whether the entity is scheduled for deletion in the unit of work before doing anything else — this information is needed to propagate the soft-delete flag to the draft.
* All Doctrine event listeners are **disabled** during the persist/flush cycle via ``DoctrineListenersIsolator``, preventing application-level side effects (re-indexing, audit logging, total recalculation) from running against drafts. An explicit whitelist allows specific listeners to remain active when required.
* Listeners are always re-enabled in a ``finally`` block, even if an exception occurs.
* The persister uses ``DraftEntitiesEntityManagerIsolator`` to flush only draft-related rows. Non-draft entity changes that are pending in the unit of work are temporarily extracted from the UoW scheduling queues, the draft-only flush runs, and the non-draft entries are restored.
* The persister dispatches ``EntityDraftPersistBeforeEvent`` just before flushing and ``EntityDraftPersistAfterEvent`` immediately after.

**Things to consider:**

* Non-draft entity changes pending in the unit of work are temporarily suppressed during the draft flush and restored afterwards — they are not lost, but they are also not persisted as a side effect of the draft save.
* If your bundle's infrastructure listeners must run during draft persistence (for example, a custom audit listener), add them to the ``DoctrineListenersIsolator`` whitelist in the service configuration.
* **Ensure relation fields are managed inside synchronizers.** When a synchronizer copies a relation field from the source entity to the draft, the referenced entity must be tracked by the entity manager. If it was fetched in a different context or is in a detached state, use ``EntityDraftSyncReferenceResolver::getReference()`` to obtain a fresh managed proxy reference. For enum fields use ``getEnumReference()``. Failing to do this will cause a Doctrine "detached entity" error on flush.

EntityDraftRemover
^^^^^^^^^^^^^^^^^^

**Purpose:** Remove the persisted draft entity for a given entity within a draft session.

**Principles:**

* If no draft exists for the entity, the operation is a no-op.
* Doctrine event listeners are disabled during removal for the same reason as in the persister — to avoid triggering side effects on draft rows.
* ``EntityDraftDeleteBeforeEvent`` is dispatched after the draft is scheduled for removal but before the flush, allowing listeners to react while the draft is still in the unit of work.
* Listeners are always re-enabled in a ``finally`` block.

DoctrineListenersIsolator
^^^^^^^^^^^^^^^^^^^^^^^^^

``\Oro\Component\DraftSession\Isolator\DoctrineListenersIsolator`` is the shared mechanism used by both ``EntityDraftPersister`` and ``EntityDraftRemover`` to isolate draft persistence from the application's Doctrine listener infrastructure. It disables all ORM event listeners on the relevant entity manager except those in an explicit whitelist, and restores them afterwards. The whitelist is configured per-bundle in the service definition and allows critical infrastructure listeners to remain active during draft operations.

Unit of Work Isolators
^^^^^^^^^^^^^^^^^^^^^^

The following isolator classes implement the partial-flush strategy used by ``EntityDraftPersister`` and ``EntityDraftRemover``. They ensure that a draft-only flush never accidentally persists non-draft entity changes that are pending in the same unit of work, and vice versa.

``\Oro\Component\DraftSession\Isolator\DraftEntitiesEntityManagerIsolator``
    The high-level entry point used by the persister and remover. Its ``flushDraftEntities()`` method collects all draft entities that are scheduled for insertion or update, temporarily extracts all non-draft scheduling entries from the unit of work via ``NonDraftEntitiesUnitOfWorkIsolator``, calls ``EntityManager::flush()``, and then merges the non-draft entries back.

``\Oro\Component\DraftSession\Isolator\NonDraftEntitiesEntityManagerIsolator``
    The inverse operation. Its ``flushNonDraftEntities()`` method temporarily extracts all draft scheduling entries from the unit of work via ``DraftEntitiesUnitOfWorkIsolator``, calls ``EntityManager::flush()``, and then merges the draft entries back. Use this when you need to flush the regular entity changes while a draft is also pending in the unit of work.

``\Oro\Component\DraftSession\Isolator\DraftEntitiesUnitOfWorkIsolator``
    Low-level helper that extracts draft entity scheduling entries (insertions, updates, deletions, collection changes) from the Doctrine unit of work and marks draft entities as read-only so that Doctrine skips changeset computation for them during a non-draft flush. Returns a ``UnitOfWorkSnapshot`` that can be used to restore the extracted state.

``\Oro\Component\DraftSession\Isolator\NonDraftEntitiesUnitOfWorkIsolator``
    Low-level helper that extracts non-draft entity scheduling entries from the unit of work, leaving only draft-related changes pending. Returns a ``UnitOfWorkSnapshot`` for later restoration. Used internally by ``DraftEntitiesEntityManagerIsolator``.

``\Oro\Component\DraftSession\Isolator\UnitOfWorkSnapshot``
    An immutable value object that holds the extracted UoW state (scheduling queues and read-only flags) captured by one of the UoW isolators. Passed back to the corresponding restore method to replay the extracted state after the isolated flush completes.

.. _bundle-docs-platform-draft-session-factory:

Draft Factory
-------------

A draft factory is responsible for **instantiating** a new draft entity and populating its initial state from the source. One factory implementation is needed per entity class that participates in a draft session.

``\Oro\Component\DraftSession\Factory\EntityDraftFactoryInterface``
    Implement this interface for each entity class. The factory receives the source entity and the draft session UUID, creates a fresh draft instance, and returns it. The factory is the right place for entity-specific initialization logic that cannot be expressed as a generic synchronizer.

``\Oro\Component\DraftSession\Factory\EntityDraftFactoryChain``
    Aggregates all tagged factory implementations and delegates to the first one that declares support for the given entity class. After the factory returns the draft, the chain dispatches ``EntityDraftCreatedEvent``, giving listeners a chance to perform post-creation work without modifying the factory itself.

To register a custom factory, tag the service with the factory tag defined by the consuming bundle (for example, ``oro_order.draft_session.factory`` for the Order bundle).

.. _bundle-docs-platform-draft-session-synchronizer:

Draft Synchronizer
------------------

A draft synchronizer is responsible for **copying fields** between an entity and its draft in both directions. Multiple synchronizers can be registered for the same entity class; the chain calls all matching ones, which allows different concerns (addresses, discounts, extended fields) to be separated into focused implementations.

``\Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerInterface``
    Implement this interface for each entity class or for a specific subset of its fields. Two directions must be supported: copying from the original entity into the draft (used when creating or refreshing a draft), and copying from the draft back to the original entity (used when loading or saving).

``\Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerChain``
    Aggregates all tagged synchronizer implementations and runs every one that supports the given entity class. When synchronizing *from* a draft, the chain dispatches ``EntityFromDraftSyncBeforeEvent`` before any synchronizers run and ``EntityFromDraftSyncEvent`` after all have finished. When synchronizing *to* a draft, it dispatches ``EntityToDraftSyncBeforeEvent`` before any synchronizers run and ``EntityToDraftSyncEvent`` after all have finished.

``\Oro\Component\DraftSession\Synchronizer\ExtendedFieldsAwareEntityDraftSynchronizer``
    A reusable synchronizer that automatically copies all form-enabled custom extended fields between an entity and its draft. It covers scalar values, single relations, and collection-type relations. Register one instance per entity class that has extended fields. Fields that are handled by a dedicated synchronizer should be excluded from automatic sync — see :ref:`Excluding Extended Fields <bundle-docs-platform-draft-session-excluding-fields>`.

``\Oro\Component\DraftSession\Doctrine\EntityDraftSyncReferenceResolver``
    A utility service for use **inside synchronizer implementations**. When a synchronizer copies a relation field from the source entity onto the draft, the referenced entity must be tracked by the entity manager. If the entity is not currently tracked (for example, it was fetched in a different context or scope), a Doctrine "detached entity" error will occur on flush. ``EntityDraftSyncReferenceResolver`` resolves this: ``getReference()`` returns the entity as-is if the entity manager already tracks it, or obtains a lightweight Doctrine proxy reference by ID otherwise. For enum fields, ``getEnumReference()`` performs the same resolution accepting either an ``EnumOptionInterface`` object or a plain string identifier. Inject this service into any synchronizer that copies relation fields.

.. _bundle-docs-platform-draft-session-events:

Events
------

All events are located in the ``Oro\Component\DraftSession\Event`` namespace. They are the primary extension point for reacting to draft lifecycle moments without modifying the core infrastructure.

``EntityDraftCreatedEvent``
    Dispatched by ``EntityDraftFactoryChain`` immediately after a new draft is created. Use this event to perform additional initialization on the draft that is too specific for a general synchronizer — for example, setting computed defaults or copying non-mapped state.

``EntityFromDraftSyncBeforeEvent``
    Dispatched by ``EntityDraftSynchronizerChain`` before any synchronizers run when applying draft changes to the original entity. Use this event when you need to capture or modify entity state before the bulk field copy begins, or to eagerly initialize associations on the draft entity that the synchronizer will read.

``EntityFromDraftSyncEvent``
    Dispatched by ``EntityDraftSynchronizerChain`` after all synchronizers finish applying draft changes to the original entity. Use this event to react to the final synchronized state of the entity.

``EntityToDraftSyncBeforeEvent``
    Dispatched by ``EntityDraftSynchronizerChain`` before any synchronizers run when copying entity state to the draft. Use this event to capture or prepare entity state before the bulk field copy begins.

``EntityToDraftSyncEvent``
    Dispatched by ``EntityDraftSynchronizerChain`` after all synchronizers finish copying entity state to the draft. Use this event to react to the final synchronized state of the draft.

``EntityDraftPersistBeforeEvent``
    Dispatched by ``EntityDraftPersister`` immediately before the draft is flushed to the database. Carries references to the draft and, optionally, the original entity.

``EntityDraftPersistAfterEvent``
    Dispatched by ``EntityDraftPersister`` immediately after the draft is flushed. Same payload as ``EntityDraftPersistBeforeEvent``.

``EntityDraftDeleteBeforeEvent``
    Dispatched by ``EntityDraftRemover`` after the draft is scheduled for removal but before the flush. Use this event to react to or prevent the imminent deletion while the draft is still in the unit of work.

Example — react to a draft being saved back to the original entity:

.. code-block:: php

    namespace Acme\Bundle\OrderBundle\EventListener\DraftSession;

    use Oro\Bundle\OrderBundle\Entity\Order;
    use Oro\Component\DraftSession\Event\EntityFromDraftSyncEvent;

    class OnOrderDraftSavedListener
    {
        public function onEntityFromDraftSync(EntityFromDraftSyncEvent $event): void
        {
            if ($event->getEntityClass() !== Order::class) {
                return;
            }

            /** @var Order $order */
            $order = $event->getTarget();
            // React to changes applied from the draft.
        }
    }

.. code-block:: yaml
   :caption: config/services.yaml

    acme_order.event_listener.on_order_draft_saved:
        class: Acme\Bundle\OrderBundle\EventListener\DraftSession\OnOrderDraftSavedListener
        tags:
            - { name: kernel.event_listener, event: Oro\Component\DraftSession\Event\EntityFromDraftSyncEvent, method: onEntityFromDraftSync }

.. _bundle-docs-platform-draft-session-cleanup:

Draft Cleanup
-------------

Abandoned draft entities (those whose session was never saved) are removed by the cleanup infrastructure.

``\Oro\Component\DraftSession\Cleanup\EntityDraftsCleanupStrategyInterface``
    Defines the contract for cleaning up stale draft entities. An implementation receives a threshold date and a batch size, removes all draft rows last updated before the threshold in batches, and returns the total number of removed rows.

``\Oro\Component\DraftSession\Cleanup\GenericEntityDraftsCleanupStrategy``
    A concrete, reusable implementation for any entity class. It temporarily disables the ORM filter before querying for stale drafts so that draft rows are visible, then re-enables it afterwards. Configure one instance per entity class that may accumulate abandoned drafts.

``\Oro\Component\DraftSession\Cleanup\CompositeEntityDraftsCleanupStrategy``
    Aggregates multiple cleanup strategy instances and sums their return values. Use this when a single draft session spans more than one entity class (for example, ``Order`` and ``OrderLineItem``), so that all related draft rows are cleaned up in one operation.

``\Oro\Component\DraftSession\Async\EntityDraftsCleanupProcessor``
    A message queue processor that receives a draft lifetime in days, calculates the corresponding threshold date, and delegates to the configured cleanup strategy. Triggered by a bundle-level cron command or on-demand message.

.. _bundle-docs-platform-draft-session-extending:

Extending the Component
-----------------------

.. _bundle-docs-platform-draft-session-custom-factory:

Adding a Draft Factory for a New Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Implement ``EntityDraftFactoryInterface`` and tag the service. The following example shows a factory for a hypothetical ``Acme\Bundle\FooBundle\Entity\FooEntity``:

.. code-block:: php

    namespace Acme\Bundle\FooBundle\DraftSession\Factory;

    use Acme\Bundle\FooBundle\Entity\FooEntity;
    use Oro\Component\DraftSession\Entity\EntityDraftAwareInterface;
    use Oro\Component\DraftSession\Factory\EntityDraftFactoryInterface;
    use Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerInterface;

    class FooEntityDraftFactory implements EntityDraftFactoryInterface
    {
        public function __construct(
            private readonly EntityDraftSynchronizerInterface $entityDraftSynchronizer,
        ) {
        }

        public function supports(string $entityClass): bool
        {
            return $entityClass === FooEntity::class;
        }

        public function createDraft(EntityDraftAwareInterface $entity, string $draftSessionUuid): FooEntity
        {
            assert($entity instanceof FooEntity);

            $draft = new FooEntity();
            $draft->setDraftSessionUuid($draftSessionUuid);
            $draft->setDraftSource($entity->getId() ? $entity : null);

            $this->entityDraftSynchronizer->synchronizeToDraft($entity, $draft);

            return $draft;
        }
    }

.. code-block:: yaml
    :caption: config/services.yaml

    acme_foo.draft_session.foo_entity_draft_factory:
        class: Acme\Bundle\FooBundle\DraftSession\Factory\FooEntityDraftFactory
        arguments:
            - '@acme_foo.draft_session.foo_entity_draft_synchronizer'
        tags:
            - { name: acme_foo.draft_session.factory }

Adding a Draft Synchronizer for a New Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Implement ``EntityDraftSynchronizerInterface`` and tag the service:

.. code-block:: php

    namespace Acme\Bundle\FooBundle\DraftSession;

    use Acme\Bundle\FooBundle\Entity\FooEntity;
    use Oro\Component\DraftSession\Entity\EntityDraftAwareInterface;
    use Oro\Component\DraftSession\Synchronizer\EntityDraftSynchronizerInterface;

    class FooEntityDraftSynchronizer implements EntityDraftSynchronizerInterface
    {
        public function supports(string $entityClass): bool
        {
            return $entityClass === FooEntity::class;
        }

        public function synchronizeFromDraft(
            EntityDraftAwareInterface $draft,
            EntityDraftAwareInterface $entity
        ): void {
            assert($draft instanceof FooEntity);
            assert($entity instanceof FooEntity);

            $entity->setTitle($draft->getTitle());
            $entity->setDescription($draft->getDescription());
        }

        public function synchronizeToDraft(
            EntityDraftAwareInterface $entity,
            EntityDraftAwareInterface $draft
        ): void {
            assert($entity instanceof FooEntity);
            assert($draft instanceof FooEntity);

            $draft->setTitle($entity->getTitle());
            $draft->setDescription($entity->getDescription());
        }
    }

.. code-block:: yaml
    :caption: config/services.yaml

    acme_foo.draft_session.foo_entity_draft_synchronizer:
        class: Acme\Bundle\FooBundle\DraftSession\FooEntityDraftSynchronizer
        tags:
            - { name: acme_foo.draft_session.synchronizer }

.. _bundle-docs-platform-draft-session-excluding-fields:

Excluding Extended Fields from Automatic Synchronization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``ExtendedFieldsAwareEntityDraftSynchronizer`` automatically syncs all form-enabled custom extended fields. If a specific field requires special handling in a dedicated synchronizer, exclude it from the automatic sync by calling ``addExcludedField()`` on the ``EntityDraftExtendedFieldsProvider`` service for the given entity class at container build time.

The Order bundle provides ``\Oro\Bundle\OrderBundle\DependencyInjection\Compiler\ExcludeExtendedFieldFromDraftSyncPass`` as a convenience compiler pass for this purpose. See :ref:`Order Edit Draft Session — Excluding Extended Fields <bundle-docs-commerce-order-bundle-draft-session>` for a usage example.

.. include:: /include/include-links-dev.rst
   :start-after: begin
