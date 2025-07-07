.. _bundle-docs-platform-platform-bundle-number-sequence-management:

Number Sequence Management
==========================

OroPlatform provides a thread-safe system for generating unique sequential numbers for entities such as invoices, orders, or other business documents.

NumberSequence Entity
---------------------

The ``Oro\Bundle\PlatformBundle\Entity\NumberSequence`` stores sequence states in the database with the following fields:

* ``sequenceType`` – Defines the sequence purpose (e.g., ``invoice``, ``order``).
* ``discriminatorType`` – Specifies the isolation level (e.g., ``organization_periodic``).
* ``discriminatorValue`` – Provides the context (e.g., ``42:2025-03`` for organization 42 in March 2025).
* ``number`` – The current numeric value of the sequence.

NumberSequenceManager
---------------------

The ``Oro\Bundle\PlatformBundle\NumberSequence\Manager\GenericNumberSequenceManager`` class is used to manage numeric sequences for business entities. 
It implements the ``Oro\Bundle\PlatformBundle\NumberSequence\Manager\NumberSequenceManagerInterface`` interface and provides the following methods:

* ``nextNumber(): int``  
  Returns the next available number in the sequence and increments it atomically.

* ``resetSequence(int $number = 0): void``  
  Resets the sequence to the specified number (default: 0).

* ``reserveSequence(int $size): array<int>``  
  Reserves a batch of sequential numbers for use in bulk operations.

**Thread Safety**  
All operations are wrapped in transactions and use row-level database locking for concurrency control.

**Example**:

.. code-block:: php

    $manager = new GenericNumberSequenceManager($doctrine, 'invoice', 'organization_periodic', '42:2025-03');
    $nextNumber = $manager->nextNumber(); // Returns 124

Reusing for Other Entities
--------------------------

To use number sequences for custom entities like orders:

* **Define Parameters**:
   * ``sequenceType``: e.g., ``order``
   * ``discriminatorType``: e.g., ``organization_global``
   * ``discriminatorValue``: e.g., ``42``

* **Implement a Generator**: Use ``NumberSequenceManager`` to generate numbers.

* **Register a Listener**: Trigger generation during entity persistence.

* **Configure Services**: Register your components as services in your bundle.

**Example: Order Number Generator** (e.g., ``ORD-00123``):

.. oro_integrity_check:: 8129f26098a961aaf5bdd57abd61261cdb0f970e

    .. literalinclude:: /code_examples/commerce/demo/Generator/CustomOrderNumberGenerator.php
        :caption: src/Acme/Bundle/DemoBundle/Generator/CustomOrderNumberGenerator.php
        :language: php
        :lines: 4-

.. oro_integrity_check:: 8b9394899b597aba243dcb751a4717098cf6932a

    .. literalinclude:: /code_examples/commerce/demo/EventListener/CustomOrderNumberListener.php
        :caption: src/Acme/Bundle/DemoBundle/EventListener/CustomOrderNumberListener.php
        :language: php
        :lines: 4-

.. oro_integrity_check:: 6743780df06144170e8e6b78e19dac82e5baf872

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 140-150

Automatic Sequence Cleanup
--------------------------

OroPlatform provides a built-in mechanism to clean up old number sequences via a daily cron command.

1. **Cron command** ``oro:cron:platform:delete-old-number-sequences`` runs daily and schedules cleanup tasks.
2. **Message Queue** sends a message to the topic ``Oro\Bundle\PlatformBundle\Async\Topic\DeleteOldNumberSequenceTopic``.
3. **Asynchronous handler** ``Oro\Bundle\PlatformBundle\Async\DeleteOldNumberSequenceProcessor`` dispatches a ``Oro\Bundle\PlatformBundle\Event\DeleteOldNumberSequenceEvent``.
4. **Event listener** ``Oro\Bundle\PlatformBundle\EventListener\DeleteOldNumberSequenceEventListener`` receives the event and removes old sequences, keeping the latest one.

To enable automatic cleanup for your sequence type, you can:

* **Use built-in listener with service definition**

Use the provided ``Oro\Bundle\PlatformBundle\EventListener\DeleteOldNumberSequenceEventListener`` and supply the desired arguments via service definition:

.. oro_integrity_check:: ca9d6f66fcf5b2c0b9077db9fee858b81487c30e

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 152-162

* **Implement a custom listener** 

If your application requires more advanced logic (e.g., keeping sequences for the last 3 months, or based on organization), you can create a custom listener for the ``Oro\Bundle\PlatformBundle\Event\DeleteOldNumberSequenceEvent``:
Register the custom listener in your bundle's service configuration, just like the default one, and subscribe it to the ``Oro\Bundle\PlatformBundle\Event\DeleteOldNumberSequenceEvent``.

.. oro_integrity_check:: f751ad2cf11316bbb72c7e22de9422c44a55c798

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 164-169

.. oro_integrity_check:: 584c0cbec759dab6d2d19a462e0c3cd443eedbb2

    .. literalinclude:: /code_examples/commerce/demo/EventListener/CustomOrderSequenceCleanupListener.php
        :caption: src/Acme/Bundle/DemoBundle/EventListener/CustomOrderSequenceCleanupListener.php
        :language: php
        :lines: 4-
