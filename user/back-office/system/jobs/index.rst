:oro_documentation_types: crm, commerce

.. _book-job-execution:

Jobs
====

A job is additional information about the message processing task added to the Oro application DB. It allows to view the information about the task (job) in the admin UI and to manage the job (view the status and cancel it) in the UI.

You can view the statuses and statistics for the jobs by navigating to **System > Jobs** in the main menu in the back-office of all Oro applications.

.. image:: /user/img/system/jobs/jobs.png
   :alt: Scheduled Jobs in admin UI

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

        $ bin/console oro:message-queue:consume --env prod

A message processor can create a job in the database during processing. Jobs allow to monitor processing status, progress,
a user can interrupt a job. Also, a job can create a set of sub-jobs to split a big task to a set of sub-tasks to run
them in parallel.

Documentation on Message Queue implementation, including information on messages, jobs, consumers, etc., can be found
in |OroMessageQueueComponent| and |OroMessageQueueBundle|.

.. include:: /include/include-links.rst
   :start-after: begin