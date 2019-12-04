.. _op-structure--mq--redeliver-with-limited-attempts:

Re-deliver Message with Limited Attempts
========================================

Procedure
---------

1. `Create oro.unprocessed queue`_
2. `Re-declare oro.default.delayed exchange`_
3. `Declare oro.redelivery.control exchange`_
4. `Configure count of re-delivery attempts`_

Example
-------

The example below illustrates how to configure message re-delivery with limited attempts. You can use this flow both with the out-of-the-box configuration, and with :ref:`Multiple Queue Dividing <op-structure--mq--rabbitmq--configure>`.
Use the commands provided by the :ref:`RabbitMQ management plugin <op-structure--mq--rabbit-command-lines>`.

Create oro.unprocessed Queue
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create an ``oro.unprocessed`` queue that should act as a storage with messages that failed more than the maximum available attempts.

.. code::

    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.unprocessed" durable=true arguments='{"x-max-priority": 4}'

Re-Declare oro.default.delayed Exchange
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Re-declare the ``oro.default.delayed`` exchange to make sure that it is declared and does not have any additional bindings.

.. code::

    rabbitmqadmin delete exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default.delayed"

    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default.delayed" type="x-delayed-message" \
    durable=true arguments='{"x-delayed-type": "fanout"}'

Declare oro.redelivery.control Exchange
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

After a delay timeout, when re-delivered messages pass to ``oro.default.delayed`` exchange, the exchange is routed to the ``oro.redelivery.control`` that checks the number of redelivered attempts.

.. code::

    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.redelivery.control" type="headers" durable=true \
    arguments='{"alternate-exchange": "oro.default"}'

    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default.delayed" destination="oro.redelivery.control" destination_type="exchange"

Configure Count of Re-Delivery Attempts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Set the maximum number of message re-delivery attempts. There are 5 in the example below. 

.. code::

    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.redelivery.control" destination="oro.unprocessed" destination_type="queue" \
    arguments='{"oro-redeliver-count": 5}'

What Next?
----------

From time to time, collect metrics on how many messages there are in the ``oro.unprocessed`` queue.
If the number of messages grows, check the application logs and fix the problem manually.
When a problem is fixed, route the  messages using the |RabbitMQ Shovel Plugin| back to the ``oro.default`` exchange.

Possible Problems
-----------------

If the current configuration was applied to an application that had been in production for some time,
some of messages can contain headers with ``oro-redeliver-count`` more that **5**.
In this case, manually check the message redelivery count:

.. code::

    rabbitmqadmin get queue="oro.default" --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST

In addition, declare an additional binding for the ``oro.redelivery.control`` exchange. For example, if ``oro-redeliver-count`` equals **153**, then:

.. code::

    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.redelivery.control" destination="oro.unprocessed" destination_type=queue \
    arguments='{"oro-redeliver-count": 154}' routing_key="additional_binding"

Once the failed message is caught, remove additional binding:

.. code::

    # get properties key for additional binding
    rabbitmqadmin list bindings --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source destination routing_key properties_key | grep "properties_key\|additional_binding"

    rabbitmqadmin delete binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.redelivery.control" destination="oro.unprocessed" destination_type=queue \
    properties_key='additional_binding~UFQ6EQ'

For more information, see the following external resources:

* |RabbitMQ Shovel Plugin|
* |RabbitMQ Configuring Dynamic Shovels|

.. include:: /include/include-links-dev.rst
   :start-after: begin
