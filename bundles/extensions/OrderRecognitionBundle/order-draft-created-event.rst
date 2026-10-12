.. _bundle-docs-extensions-order-recognition-order-draft-created:

OrderDraftCreated Event
=======================

``Oro\Bundle\OrderRecognitionBundle\Processor\FinalProcessor`` dispatches ``Oro\Bundle\OrderRecognitionBundle\Event\OrderDraftCreated`` once per recognition, after the order and the ``OrderRecognition`` entity are persisted and flushed and before the result of the :ref:`recognition pipeline <bundle-docs-extensions-order-recognition-pipeline>` is set. The event fires for the synchronous dashboard upload and for both message queue processors. It is the primary hook for enriching a draft order after it is created.

Event Contract
--------------

* **Name** --- ``OrderDraftCreated::EVENT_NAME``, the string ``oro_order_recognition.notification.event.order_draft_created``. The event is dispatched with this string name, not with the class name, so a listener must subscribe to the string.
* **Payload** --- ``getOrder()`` returns the flushed ``Order``; ``setOrder()`` replaces it. ``$order->getRecognition()`` returns the ``OrderRecognition`` entity with ``getRawData()``, ``getMappingData()``, ``getLineItemcontext()``, ``getEntityProgress()``, ``getInitialProgress()``, and ``getPreviewAttachmentid()``. The lower-case ``context`` in ``getLineItemcontext()`` and the lower-case ``id`` in ``getPreviewAttachmentid()`` are the real method names.
* **Persistence** --- A listener that changes the order or the recognition must flush the entity manager itself. The bundle includes no listener of this event.

When to Use the Event Instead of a Processor
--------------------------------------------

A custom processor in the pipeline works on the unsaved order, so the flush of ``FinalProcessor`` saves the mapped values together with everything else, and the processor can still record a state for the progress calculation. A listener of this event runs after the flush and must flush again, and it cannot record a state, because ``RecognitionDataProcessor`` has already copied the state into ``OrderRecognition::mappingData``.

Use the event when the customization needs the persisted order, for example, its ID, or when it does not map recognized fields, such as logging the raw payload. Use a processor to map additional payload fields; see :ref:`Map Additional Payload Fields <bundle-docs-extensions-order-recognition-pipeline-map-fields>`.

Add a Listener
--------------

The following listener reads the raw payload of the recognition, changes the order, and flushes it. The body of ``onOrderDraftCreated()`` reads ``$order->getRecognition()->getRawData()``, updates the order, and flushes through the entity manager of the ``Order`` class:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\EventListener;

   use Doctrine\Persistence\ManagerRegistry;
   use Oro\Bundle\OrderBundle\Entity\Order;
   use Oro\Bundle\OrderRecognitionBundle\Event\OrderDraftCreated;

   class OrderDraftCreatedListener
   {
       public function __construct(
           private readonly ManagerRegistry $doctrine,
       ) {
       }

       public function onOrderDraftCreated(OrderDraftCreated $event): void
       {
           $order = $event->getOrder();
           // ...
           $this->doctrine->getManagerForClass(Order::class)->flush();
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\EventListener\OrderDraftCreatedListener:
           arguments:
               - '@doctrine'
           tags:
               - { name: kernel.event_listener, event: oro_order_recognition.notification.event.order_draft_created, method: onOrderDraftCreated }

The ``event`` tag attribute is the string name of the event. A listener that only reads the order does not need the ``ManagerRegistry`` argument and the flush call.

.. include:: /include/include-links-dev.rst
   :start-after: begin
