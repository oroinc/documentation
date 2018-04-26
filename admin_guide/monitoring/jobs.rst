.. _book-job-execution:

Job Execution
=============

Asynchronous jobs processing
----------------------------

Some tasks need to be executed in the background and/or paralleled, and Oro Message Queue is used for this. 

Message queues provide an asynchronous communications protocol, meaning that the sender and the receiver
of the message do not need to interact with the message queue at the same time. Messages placed onto the
queue are stored until the recipient retrieves them. A message does not have information about the previous and
the next messages.

Messages are processed by one or more consumers that work in the background. Consumer(s) are run by the following command:

.. code-block:: bash
    :linenos:

        $ app/console oro:message-queue:consume --env prod

A message processor can create a job in the database during processing. Jobs allow to monitor processing status, progress,
a user can interrupt a job. Also, a job can create a set of sub-jobs to split a big task to a set of sub-tasks to run
them in parallel.

Documentation on Message Queue implementation, including information on messages, jobs, consumers, etc., can be found
in `OroMessageQueueComponent`_ and `OroMessageQueueBundle`_.

.. _`OroMessageQueueComponent`: https://github.com/orocrm/platform/tree/master/src/Oro/Component/MessageQueue
.. _`OroMessageQueueBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/MessageQueueBundle
