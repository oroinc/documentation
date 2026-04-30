CLI Commands (MessageQueueBundle)
=================================

oro:message-queue:consume
-------------------------

The ``oro:message-queue:consume`` command processes messages from client-level queue(s) using an appropriate message processor based on message headers.

.. code-block:: none

    php bin/console oro:message-queue:consume

It connects to all registered client-level queues by default. A different queue name (or multiple names separated by commas) can be provided as the argument using short notation:

.. code-block:: none

    php bin/console oro:message-queue:consume <clientDestinationName>

The ``--queue`` option provides a long notation for specifying queues with additional settings. Each value is either a plain queue name or a key=value string (e.g., ``--queue="name=default,weight=3"``). Cannot be combined with the positional ``queue`` argument:

.. code-block:: none

    php bin/console oro:message-queue:consume --queue=default --queue=alternate

The ``--mode`` option selects the consumption mode that controls the order in which queues are polled. Default: ``default``:

.. code-block:: none

    php bin/console oro:message-queue:consume --queue="name=default,weight=3" --mode=weighted-round-robin

For details on all available consumption modes and their behavior, see :ref:`Consumption Modes <dev-guide-mq-consumption-modes>`.

CLI Examples
^^^^^^^^^^^^

.. code-block:: none

   # Consume all registered queues (default behavior)
   php bin/console oro:message-queue:consume

   # Short notation - single queue
   php bin/console oro:message-queue:consume default

   # Short notation - multiple queues
   php bin/console oro:message-queue:consume default,alternate

   # Long notation
   php bin/console oro:message-queue:consume --queue=default --queue=alternate

   # Long notation with weight and mode
   php bin/console oro:message-queue:consume --queue="name=default,weight=3" --queue="name=alternate,weight=1" --mode=weighted-round-robin

The ``--message-limit`` option can be used to limit the maximum number of messages to consume before exiting:

.. code-block:: none

    php bin/console oro:message-queue:consume --message-limit=<number> other options and arguments

The ``--time-limit`` option can be used to restrict the run time. Accepts any date/time value recognized by PHP (see |Supported Date and Time Formats|):

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

The ``oro:message-queue:transport:consume`` command consumes messages from transport-level queue(s). The message processor service can be specified as the second argument when using short notation.

.. code-block:: none

   php bin/console oro:message-queue:transport:consume <queue> [processor-service]

The ``queue`` positional argument accepts transport-level queue name(s) in short notation. Separate multiple names with commas (e.g., ``oro.default,oro.system``). Cannot be combined with ``--queue``.

The ``--queue`` option provides a long notation for specifying queues with additional settings. Each value is either a plain queue name (``--queue=oro.default``) or a key=value string (``--queue="name=oro.index,processor=acme.proc,weight=3"``). Recognized keys: ``name`` (required), ``processor`` (optional). All other keys are forwarded as extra queue settings:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue="name=oro.default,weight=5" --queue=oro.system --mode=weighted-round-robin

The ``--mode`` option selects the consumption mode. Default: ``default``:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue=oro.default --queue=oro.system --mode=strict-priority-interleaving

For details on all available consumption modes and their behavior, see :ref:`Consumption Modes <dev-guide-mq-consumption-modes>`.

CLI Examples
^^^^^^^^^^^^

.. code-block:: none

   # Short notation - single queue
   php bin/console oro:message-queue:transport:consume oro.default

   # Short notation - multiple queues
   php bin/console oro:message-queue:transport:consume oro.default,oro.system

   # Short notation with processor
   php bin/console oro:message-queue:transport:consume oro.default my_processor_service

   # Long notation - plain queue names
   php bin/console oro:message-queue:transport:consume --queue=oro.default --queue=oro.system

   # Long notation with settings (processor)
   php bin/console oro:message-queue:transport:consume --queue="name=oro.index,processor=oro_search.async.index_entity_processor"

   # Long notation with weight and mode
   php bin/console oro:message-queue:transport:consume --queue="name=oro.default,weight=5" --queue=oro.system --mode=weighted-round-robin

Environment Variables
^^^^^^^^^^^^^^^^^^^^^

The following environment variables affect the ``oro:message-queue:transport:consume`` command.

``ORO_MQ_CONSUMPTION_MODE``
   Sets the ``--mode`` option automatically if the option is not passed explicitly on the CLI.

.. code-block:: none

   export ORO_MQ_CONSUMPTION_MODE=weighted-round-robin
   php bin/console oro:message-queue:transport:consume --queue="name=oro.default,weight=5" --queue=oro.system

``ORO_MQ_CONSUMPTION_GROUPS``
   A JSON-encoded map of group names to queue definitions. When the ``queue`` positional argument matches a group name defined in this variable, the argument is expanded into ``--queue`` options.

.. code-block:: none

   export ORO_MQ_CONSUMPTION_GROUPS='{"search":{"oro.index":{"processor":"oro_search.async.index_entity_processor"},"oro.default":{}}}'

Running the following command:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume search

is equivalent to:

.. code-block:: none

   php bin/console oro:message-queue:transport:consume --queue="name=oro.index,processor=oro_search.async.index_entity_processor" --queue=oro.default

.. include:: /include/include-links-dev.rst
   :start-after: begin
