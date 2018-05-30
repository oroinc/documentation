.. _op-structure--mq--index:

Message Queue
-------------

Concepts
~~~~~~~~

Message queues provide an asynchronous communications protocol, meaning
that the sender and the receiver of the message do not need to interact
with the message queue at the same time. Messages placed onto the queue
are stored until the recipient retrieves them. A message does not have
information about previous and next messages.

Therefore, a message queues should be used if:

-  A process can be executed asynchronously.
-  A process does not affect user experience.
-  Processes need to be executed in parallel for faster performance.
-  You need a guarantee of processing.
-  You need scalability.

For more information, see the following external resources:

-  `What is Message
   Queue <http://www.ibm.com/support/knowledgecenter/SSFKSJ_9.0.0/com.ibm.mq.pro.doc/q002620_.htm>`__
-  `Message Queue
   Benefits <https://www.iron.io/top-10-uses-for-message-queue/>`__
   (most of them are applicable to Oro Message Queue Component)
-  `Rabbit MQ
   Introduction <https://www.rabbitmq.com/tutorials/tutorial-one-php.html>`__

Using Message Queue in Oro Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. toctree::
   :maxdepth: 1

   mq_bundle
   mq_component
   dbal
   rabbit_mq_intro
   rabbit_mq
   rabbit_mq_in_production