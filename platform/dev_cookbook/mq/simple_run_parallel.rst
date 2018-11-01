.. _dev-cookbook-system-mq-simple-run-parallel:

Run Several Message Processors in Parallel
==========================================

Let us imagine that we want to run two processes in parallel. In this case, we can create a Processor B with the
first process and Processor C with the second process. We can then create Processor A, inject Message
Producer into it, and send messages to Processor B and Processor C. The messages are put to the queue
and when their turn comes, the consumers run processes B and C. That could be done in parallel.

.. image:: /dev_cookbook/mq/img/simple_parallel_processes_running.png

Code example:

.. code-block:: php
    :linenos:

    public function process(MessageInterface $message, SessionInterface $session)
    {
        $data = JSON::decode($message->getBody());

        if ({$message is invalid}) {
            $this->logger->critical(
                sprintf('Got invalid message: "%s"', $message->getBody()),
                ['message' => $message]
            );

            return self::REJECT;
        }

        foreach ($data['ids'] as $id) {
            $this->producer->send(Topics::DO_SOMETHING_WITH_ENTITY, [
                'id' => $id,
                'targetClass' => $data['targetClass'],
                'targetId' => $data['targetId'],
            ]);
        }

        $this->logger->info(sprintf(
            'Sent "%s" messages',
            count($data['ids'])
        ));

        return self::ACK;
    }

The processor in the example accepts an array of some entity ids and sends a message `Topics:DO_SOMETHING_WITH_ENTITY`
to each id. The messages are put to the message queue and will be processed when their turn comes. It could be done in parallel if several consumers are running.

The approach is simple and works perfectly well, although it has a few flaws.

* We do not have a way to **monitor** the **status** of processes except for reading log files. In the example above we do not know how many entities are being processed and how many are still in the queue. We also do not know how many entities were processed successfully and how many received errors during the processing.
* We cannot ensure the **unique** run.
* We cannot easily **interrupt** the running processes.
