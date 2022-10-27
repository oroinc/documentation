CLI Commands (MessageQueueBundle)
=================================

oro:message-queue:consume
-------------------------

The ``oro:message-queue:consume`` command processes messages from the message-queue using an appropriate message processor based on message headers.

.. code-block:: none

    php bin/console oro:message-queue:consume

It connects to the default queue, but a different name can be provided as the argument:

.. code-block:: none

    php bin/console oro:message-queue:consume <clientDestinationName>

The ``--message-limit`` option can be used to limit the maximum number of messages to consume before exiting:

.. code-block:: none

    php bin/console oro:message-queue:consume --message-limit=<number> other options and arguments

The ``--time-limit`` option can be used to restrict the run time. Accepts any date/time value recognized by PHP (see |Supported Date and Time Formats|:

.. code-block:: none

    php bin/console oro:message-queue:consume --time-limit=<date-time-string> other options and arguments

The ``--memory-limit`` option defines the maximum used memory threshold (megabytes):

.. code-block:: none

    php bin/console oro:message-queue:consume --memory-limit=<number> other options and arguments

The ``--object-limit`` option defines the maximum amount of objects in runtime:

.. code-block:: none

    php bin/console oro:message-queue:consume --object-limit=<number> other options and arguments

The ``--gc-limit`` option defines the maximum amount GC calls:

.. code-block:: none

    php bin/console oro:message-queue:consume --gc-limit=<number> other options and arguments

oro:message-queue:create-queues
-------------------------------

The ``oro:message-queue:create-queues`` command creates the required message queues.

.. code-block:: none

   php bin/console oro:message-queue:create-queues

oro:message-queue:destinations
------------------------------

The ``oro:message-queue:destinations`` command lists available message queue destinations.

.. code-block:: none

   php bin/console oro:message-queue:destinations

oro:message-queue:topics
------------------------

The ``oro:message-queue:topics`` command lists available message queue topics.

.. code-block:: none

   php bin/console oro:message-queue:topics

oro:message-queue:transport:consume
-----------------------------------

The ``oro:message-queue:transport:consume`` command consumes message from a specified message queue. The message processor service can be specified as the second argument.

.. code-block:: none

   php bin/console oro:message-queue:transport:consume <queue> [processor-service]

.. include:: /include/include-links-dev.rst
   :start-after: begin
