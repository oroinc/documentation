.. _op-structure--mq--divide-single-to-separate:

Divide Queue to Separate Queues
===============================

There are a couple of cases when you need to move messages from one queue to another using **routing key**, for example:

* When configuring **multiple queue**. If all your messages are stored in a single queue (like ``oro.default``), you may want to configure more than one queue and split all your messages.
* When setting up **backup restore**. You may need to exclude messages after the backup (like email notifications, 3rd party application updates, etc.)

Use the |Shovel plugin| to divide your single queue into separate queues.

Procedure
---------

1. |Install Shovel Plugin|
2. |Install Shovel Management Plugin|
3. `Configure Temporary Queue`_
4. `Relocate Messages to Temporary Queue`_
5. `Configure Alternate Exchange`_
6. `Configure Dividing Exchange`_
7. `Create Additional Queues`_
8. `Configure Bindings`_
9. `Relocate Messages to Separate Queues`_
10. `Clear Temporary Exchanges and Queues`_

Example
-------

The example below illustrates how to consume messages from the `oro.default` queue on the local broker and push them to separate queues, `oro.email` and `oro.notification`. All other messages are returned to the `oro.default` queue.

Use the commands provided by the :ref:`RabbitMQ management plugin <op-structure--mq--rabbit-command-lines>`:

* `declare queue`
* `declare exchange`
* `declare binding`

Configure Temporary Queue
^^^^^^^^^^^^^^^^^^^^^^^^^

Create the `oro.temporary` queue on your host with `durable=true` and `x-max-priority=4`.

.. code-block:: bash

   rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary" durable=true arguments='{"x-max-priority": 4}'

Relocate Messages to Temporary Queue
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Declare the `oro.temporary` exchange with the `fanout` type to be able to move messages to `oro.temporary` with the original **routing_key**.

.. code-block:: bash

   rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary" type="fanout" durable=true

Bind the `oro.temporary` exchange with the `oro.temporary` queue. All message from this exchange will be transferred to the `oro.default` queue.

.. code-block:: bash

   rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   source="oro.temporary" destination="oro.temporary" destination_type=queue

Create Dynamic Shovel to relocate all message from the `oro.default` to the `oro.temporary` queue.

.. code-block:: bash

   rabbitmqctl set_parameter shovel temporary-queue \
   '{"src-protocol": "amqp091", "src-uri": "amqp://localhost:5672", "src-queue": "oro.default", '\
   '"dest-protocol": "amqp091", "dest-uri": "amqp://localhost:5672", "dest-exchange": "oro.temporary", '\
   '"src-delete-after": "queue-length"}'

Check if all messages are relocated.

.. code-block:: bash

   rabbitmqctl shovel_status | grep "temporary-queue"

Shovel will be removed automatically if you specify the `src-delete-after=queue-length` option.

Remove the `oro.temporary` exchange.

.. code-block:: bash

   rabbitmqadmin delete exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary"

Configure Alternate Exchange
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Declare the `oro.temporary.alternate` exchange with the `fanout` type to be able to move messages to the `oro.default` queue that does not contain the **routing_key** described in the binding mask.

.. code-block:: bash

   rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary.alternate" type="fanout" durable=true

Configure Dividing Exchange
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Declare the `oro.temporary.divide` exchange with the `topic` type to be able to move messages to separate queues by **routing_key**. Specify the `alternate-exchange=oro.temporary.alternate` option that marks the `oro.temporary.alternate` exchange as a **alternate exchange** for the `oro.temporary.divide` exchange.

.. code-block:: bash

   rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary.divide" type="topic" durable=true \
   arguments='{"alternate-exchange": "oro.temporary.alternate"}'

Create Additional Queues
^^^^^^^^^^^^^^^^^^^^^^^^

Declare the `oro.email` queue with `durable=true` and `x-max-priority=4`.

.. code-block:: bash

   rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name=oro.email durable=true arguments='{"x-max-priority": 4}'

Declare the `oro.notification` queue with `durable=true` and `x-max-priority=4`.

.. code-block:: bash

   rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name=oro.notification durable=true arguments='{"x-max-priority": 4}'

Configure Bindings
^^^^^^^^^^^^^^^^^^

Bind the `oro.temporary.alternate` exchange with the `oro.default` queue. All messages from this exchange will be transferred to the `oro.default` queue.

.. code-block:: bash

   rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   source="oro.temporary.alternate" destination="oro.default" destination_type=queue

Bind the `oro.temporary.divide` exchange with the `oro.email` queue by `routing_key=oro.email.#`

.. code-block:: bash

   rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   source="oro.temporary.divide" destination="oro.email" destination_type=queue \
   routing_key="oro.email.#"

Bind the `oro.temporary.divide` exchange with the `oro.notification` queue by `routing_key=oro.notification.#`

.. code-block:: bash

   rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   source="oro.temporary.divide" destination="oro.notification" destination_type=queue \
   routing_key="oro.notification.#"

Relocate Messages to Separate Queues
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: bash

   rabbitmqctl set_parameter shovel divide-queue \
   '{"src-protocol": "amqp091", "src-uri": "amqp://localhost:5672", "src-queue": "oro.temporary", '\
   '"dest-protocol": "amqp091", "dest-uri": "amqp://localhost:5672", "dest-exchange": "oro.temporary.divide", '\
   '"ack-mode": "on-publish", "src-delete-after": "queue-length"}'

Check if all messages are relocated.

.. code-block:: bash

   rabbitmqctl shovel_status | grep "divide-queue"

Clear Temporary Exchanges and Queues
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Remove the `oro.temporary.alternate` exchange.

.. code-block:: bash

   rabbitmqadmin delete exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary.alternate"

Remove the `oro.temporary.divide` exchange.

.. code-block:: bash

   rabbitmqadmin delete exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary.divide"

Remove the `oro.temporary` queue.

.. code-block:: bash

   rabbitmqadmin delete queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
   name="oro.temporary"

For more information, see the following external resources:

* |RabbitMQ Shovel Plugin|
* |RabbitMQ Configuring Dynamic Shovels|

.. include:: /include/include-links.rst
   :start-after: begin
