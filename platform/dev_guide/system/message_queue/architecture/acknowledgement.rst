.. _dev-guide-system-message-queue-architecture-acknowledgement:

Message Acknowledgement
=======================

When a Message Queue broker delivers a message to the consumer, it needs to know when to consider the message as successfully sent and what to do with the message next. For this purpose, almost every messaging standard contains a mechanism related to Message Acknowledgement.

In Oro applications Message Acknowledgement is an information message returned by the Message Processor to the consumer. It enables the consumer to decide whether the message should be deleted from the message queue or re-queued for the reprocessing.

Processing Statuses
-------------------

Message Acknowledgement can have one of the following three statuses:

* **Acknowledged** (*MessageProcessorInterface::ACK*)
* **Rejected** (*MessageProcessorInterface::REJECT*)
* **Need to requeue** (*MessageProcessorInterface::REQUEUE*)

The :ref:`Message Processor <dev-guide-system-message-queue-architecture-processor>` *process()* method either returns one of these three processing statuses or throws an exception in case of an unexpected error.

The Message Processor returns **self::ACK** in the following cases:

* If a message is processed successfully.
* If the created job returns *true*.

It means that the message was processed successfully and is removed from the queue.

The Message Processor returns **self::REJECT** in the following cases:

* If a message is broken.
* If the created job returns *false*.

It means that the message was not processed and is removed from the queue because it is unprocessable and will never become processable (e.g., a required parameter is missing or a permanent error occurs).

This can happen for two reasons: 

* The message became unprocessable as the result of normal work. For example, when the message was sent to an entity that existed at the moment of sending but was deleted. The entity will not appear again and we can reject the message. It is a normal workflow and user intervention is not required.

* The message became unprocessable due a failure. For example, when an entity ID is invalid or missing. This is abnormal behavior, the message should also be rejected but the processor requires user attention (e.g., log a critical error or throw an exception).

If a message cannot be processed temporarily (e.g., there was a connection timeout due server overload), the process method returns **self::REQUEUE**. The message is returned to the queue and processed later. This also happens if an exception is thrown when processing or running a job.

The workflow of re-queuing messages (processor returns **self::REQUEUE**) is the following:

1. The consumer processes a message (runs the process method of the message processor).
#. The process method returns *self::REQUEUE*.
#. The consumer sends the message (i.e. a copy of the message) to the end of the queue setting the redelivery flag to *true*.
#. The consumer continues message processing (the re-queued message is at the end of the queue).
#. When the turn of the re-queued message comes, the DelayRedeliveredMessageExtension sets a delay for the re-queued message.
#. The time set in the delay passes and the message is processed again.

The workflow of re-queuing messages when an exception is thrown inside a message processor is slightly different:

1. A consumer processes a message (runs the process method of the message processor).
2. An exception is thrown inside the process method.
3. The consumer logs the exception and sends the message (i.e. a copy of the message) to the end of the queue setting the redelivery flag to *true*. Then the consumer fails with an exception.
4. The consumer should be re-run at this stage. It can be done manually or automatically with a system such as `supervisord <http://supervisord.org/>`_. 

   * Manual re-run is preferred for developing as developers should review the exceptions thrown on the message processing.    
   * Automatic re-run is preferred for regression testing or prod.

5. The consumer continues message processing (the failing message is at the end of the queue).
6. When the turn of the failing message comes, the DelayRedeliveredMessageExtension sets a delay for the failing message.
7. After the delay time passes, the message is processed again and the consumer can fail again.

**Example**

In the following example, the processor receives a message with the entity ID. It finds the entity and changes its status without creating any job.

.. code-block:: php
    :linenos:

    /**
     * {@inheritdoc}
     */
    public function process(MessageInterface $message, SessionInterface $session)
    {
        $body = JSON::decode($message->getBody());

        if (! isset($body['id'])) {
            $this->logger->critical(
                sprintf('Got invalid message, id is empty: "%s"', $message->getBody()),
                ['message' => $message]
            );

            return self::REJECT;
        }

        $em = $this->getEntityManager();
        $repository = $em->getRepository(SomeEntity::class);

        $entity = $repository->find($body['id']);

        if(! $entity) {
            $this->logger->error(
                sprintf('Cannot find an entity with id: "%s"', $body['id']),
                ['message' => $message]
            );

            return self::REJECT;
        }

        $entity->setStatus('success');
        $em->persist($entity);
        $em->flush();

        return self::ACK;
      }

Overall, there can be three cases:

.. comment: what do you mean by "there can be"? What are you trying to convey here by providing this example?

* The processor received a message with an entity ID. The entity was found. The process method of the processor changed the entity status and returned *self::ACK*.
* The processor received a message with an entity ID. The entity was not found. This is possible if the entity was deleted when the message was in the queue (i.e. after it was sent but before it was processed). This is expected behavior but the processor rejects the message because the entity does not exist and will not appear later. Please note that we use error logging level.
* The processor received a message with an empty entity id. This is unexpected behavior. There are definitely bugs in the code that sent the message. We also reject the message but using critical logging level to inform that user intervention is required.
