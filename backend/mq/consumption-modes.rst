.. _dev-guide-mq-consumption-modes:

Consumption Modes
=================

Consumption modes determine the order in which multiple queues are visited by the message consumer during a consumption cycle. When a consumer is bound to more than one queue, the consumption mode controls which queue is polled next. Different modes offer different trade-offs between fairness, priority handling, throughput, and starvation avoidance.

The consumption mode is selected via the ``--mode`` CLI option or the ``ORO_MQ_CONSUMPTION_MODE`` environment variable. The default mode is ``default``.

Built-in Consumption Modes
--------------------------

default
^^^^^^^

Class: ``Oro\Component\MessageQueue\Consumption\QueueIterator\DefaultQueueIterator``

Iterates over bound queues in a fixed round-robin order. Each queue gets exactly one poll before advancing to the next. After the last queue, the cycle restarts.

Consumption schema:

.. code-block:: none

   1 queue:  Q1(1)
   2 queues: Q1(1), Q2(1)
   3 queues: Q1(1), Q2(1), Q3(1)

Each ``(1)`` means exactly one poll of that queue before moving on.

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.default --queue=oro.system --mode=default

sequential-exhaustive
^^^^^^^^^^^^^^^^^^^^^

Class: ``Oro\Component\MessageQueue\Consumption\QueueIterator\SequentialExhaustiveQueueIterator``

The first queue is fully drained (polled until idle) before the iterator advances to the next. After the last queue is exhausted, the cycle ends. This mode implements ``NotifiableQueueIteratorInterface`` and relies on the feedback loop (message-received / idle notifications) to detect when a queue is exhausted.

Consumption schema:

.. code-block:: none

   1 queue:  Q1(*)
   2 queues: Q1(*), Q2(*)
   3 queues: Q1(*), Q2(*), Q3(*)

The asterisk ``(*)`` means the iterator stays on the current queue until it becomes idle.

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.default --queue=oro.system --mode=sequential-exhaustive

strict-priority-interleaving
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Class: ``Oro\Component\MessageQueue\Consumption\QueueIterator\StrictPriorityInterleavingQueueIterator``

The first queue (Q1) is treated as the highest-priority queue. It is drained until idle, then exactly one message is consumed from the next lower-priority queue, then back to Q1, and so on. This ensures that the high-priority queue is always serviced first while lower-priority queues are not completely starved. Implements ``NotifiableQueueIteratorInterface``.

Consumption schema:

.. code-block:: none

   1 queue:  Q1(*)
   2 queues: Q1(*), Q2(1)
   3 queues: Q1(*), Q2(1), Q1(*), Q3(1)
   4 queues: Q1(*), Q2(1), Q1(*), Q3(1), Q1(*), Q4(1)

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.high --queue=oro.default --queue=oro.low --mode=strict-priority-interleaving

hierarchical-strict-priority-interleaving
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Class: ``Oro\Component\MessageQueue\Consumption\QueueIterator\HierarchicalStrictPriorityInterleavingQueueIterator``

A fully recursive version of ``strict-priority-interleaving``. The sub-pattern of higher-priority queues is repeated until idle before a single poll of the next lower-priority queue. Implements ``NotifiableQueueIteratorInterface``.

Consumption schema:

.. code-block:: none

   1 queue:  Q1(*)
   2 queues: Q1(*), Q2(1)
   3 queues: ( Q1(*), Q2(1) )(*), Q3(1)
   4 queues: ( ( Q1(*), Q2(1) )(*), Q3(1) )(*), Q4(1)

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.critical --queue=oro.high --queue=oro.default --queue=oro.low --mode=hierarchical-strict-priority-interleaving

weighted-round-robin
^^^^^^^^^^^^^^^^^^^^

Class: ``Oro\Component\MessageQueue\Consumption\QueueIterator\WeightedRoundRobinQueueIterator``

Each queue is consumed for up to ``weight`` messages before advancing to the next. When a queue becomes idle before its weight is exhausted, the iterator advances immediately. Queues without an explicit ``weight`` setting default to ``1``. Implements ``NotifiableQueueIteratorInterface``.

Consumption schema (where ``w1``, ``w2``, ``w3`` are configured weights):

.. code-block:: none

   1 queue:  Q1(w1)
   2 queues: Q1(w1), Q2(w2)
   3 queues: Q1(w1), Q2(w2), Q3(w3)

The weight is set via the ``weight`` queue setting in the ``--queue`` long notation:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue="name=oro.default,weight=5" --queue="name=oro.system,weight=2" --mode=weighted-round-robin


Creating Custom Consumption Modes
---------------------------------

You can create a custom consumption mode by implementing a queue iterator and a corresponding factory, then registering them as tagged services.

Step 1: Create the Queue Iterator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a class implementing ``Oro\Component\MessageQueue\Consumption\QueueIterator\QueueIteratorInterface`` (which extends ``\Iterator<string, array>``). The iterator ``key()`` returns the queue name and ``current()`` returns the queue settings array. Define a ``NAME`` constant for the mode name.

If the iterator needs feedback about whether messages were received or the queue was idle, implement ``Oro\Component\MessageQueue\Consumption\QueueIterator\NotifiableQueueIteratorInterface`` instead.

.. code-block:: php

   namespace Acme\Bundle\DemoBundle\Consumption\QueueIterator;

   use Oro\Component\MessageQueue\Consumption\QueueIterator\QueueIteratorInterface;

   class MyCustomQueueIterator implements QueueIteratorInterface
   {
       public const string NAME = 'my-custom-mode';

       private array $keys;
       private array $values;
       private int $position = 0;

       public function __construct(array $boundQueues)
       {
           $this->keys = array_keys($boundQueues);
           $this->values = array_values($boundQueues);
       }

       public function current(): array
       {
           return $this->values[$this->position];
       }

       public function key(): string
       {
           return $this->keys[$this->position];
       }

       public function next(): void
       {
           ++$this->position;
       }

       public function rewind(): void
       {
           $this->position = 0;
       }

       public function valid(): bool
       {
           return isset($this->keys[$this->position]);
       }
   }

Step 2: Create the Factory
^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a class implementing ``Oro\Component\MessageQueue\Consumption\QueueIterator\QueueIteratorFactoryInterface``. The factory ``createQueueIterator(array $boundQueues, string $consumptionMode)`` method creates the iterator.

For notifiable iterators, inject a ``NotifiableQueueIteratorRegistryInterface`` and register the iterator via ``addQueueIterator()``.

.. code-block:: php

   namespace Acme\Bundle\DemoBundle\Consumption\QueueIterator;

   use Oro\Component\MessageQueue\Consumption\QueueIterator\NotifiableQueueIteratorRegistryInterface;
   use Oro\Component\MessageQueue\Consumption\QueueIterator\QueueIteratorFactoryInterface;

   class MyCustomQueueIteratorFactory implements QueueIteratorFactoryInterface
   {
       private ?NotifiableQueueIteratorRegistryInterface $registry;

       public function __construct(?NotifiableQueueIteratorRegistryInterface $registry = null)
       {
           $this->registry = $registry;
       }

       public function createQueueIterator(array $boundQueues, string $consumptionMode): \Iterator
       {
           $iterator = new MyCustomQueueIterator($boundQueues);

           $this->registry?->addQueueIterator($iterator);

           return $iterator;
       }
   }

Step 3: Register the Services
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Tag the factory with ``oro_message_queue.consumption.queue_iterator_factory`` and set the ``consumption_mode`` attribute to your mode name.

.. code-block:: yaml

   services:
       acme_demo.consumption.queue_iterator.my_custom_factory:
           class: Acme\Bundle\DemoBundle\Consumption\QueueIterator\MyCustomQueueIteratorFactory
           tags:
               - { name: oro_message_queue.consumption.queue_iterator_factory, consumption_mode: my-custom-mode }

For notifiable iterators, also register a ``NotifiableQueueIteratorRegistry`` and a ``NotifiableConsumptionExtension``:

.. code-block:: yaml

   services:
       acme_demo.consumption.queue_iterator.my_custom_registry:
           class: Oro\Component\MessageQueue\Consumption\QueueIterator\NotifiableQueueIteratorRegistry

       acme_demo.consumption.queue_iterator.my_custom_factory:
           class: Acme\Bundle\DemoBundle\Consumption\QueueIterator\MyCustomQueueIteratorFactory
           arguments:
               - '@acme_demo.consumption.queue_iterator.my_custom_registry'
           tags:
               - { name: oro_message_queue.consumption.queue_iterator_factory, consumption_mode: my-custom-mode }

       acme_demo.consumption.queue_iterator.my_custom_extension:
           class: Oro\Component\MessageQueue\Consumption\QueueIterator\NotifiableConsumptionExtension
           arguments:
               - '@acme_demo.consumption.queue_iterator.my_custom_registry'
           tags:
               - { name: oro_message_queue.consumption.extension, persistent: true }

Step 4: Use the Custom Mode
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once registered, the custom mode is available via the ``--mode`` option:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.default --mode=my-custom-mode

.. include:: /include/include-links-dev.rst
   :start-after: begin
