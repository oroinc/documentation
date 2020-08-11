.. _op-structure--mq--rabbit-exchanges:

RabbitMQ Exchanges
==================

When a producer creates a new *message* that is not directly sent to a **queue**, it is published to **exchanges**.
**Exchange** accepts *messages* from the producer application and routes them to message **queues** with the help of header attributes, **bindings**, and **routing keys**.

A **binding** is a rule that distributes *message* copies to **queues**.

The **routing key** is a *message* attribute.
The **exchange** looks at this key when deciding how to route the *message* to **queues** (depending on the exchange type).

See |RabbitMQ AMQP Concepts| to learn more.

Fanout
------

A **fanout exchange** routes *messages* to all of the **queues** that are bound to it and the **routing key** is ignored.

.. note:: This type of exchange is used by the default configuration. If **no queues** and **no exchanges** were configured for RabbitMQ when the first message was sent by producer, a new queue with the name ``oro.default`` and a new exchange with the name ``oro.default`` and type **fanout** is created.

*Example:*

.. code-block:: none

    # declare `oro.default` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" type="fanout" durable=true

    # declare `oro.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.default` exchange to `oro.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default" destination="oro.default" destination_type="queue"

Direct
------

A **direct exchange** delivers *messages* to **queues** based on the message **routing key**.

.. note:: Configure alternate exchange to be able to route messages to the ``oro.default`` queue that does not fall under the binding rule.

*Example:*

.. code-block:: none

    # declare `oro.alternate` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.alternate" type="fanout" durable=true

    # decalre `oro.default` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" type="direct" durable=true arguments='{"alternate-exchange": "oro.alternate"}'

    # declare `oro.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.alternate` exchange to `oro.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.alternate" destination="oro.default" destination_type="queue"

    # declare `oro.email` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.email" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.default` exchange to `oro.email` queue by routing key `oro.email.send_auto_response`
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default" destination="oro.email" destination_type="queue" \
    routing_key="oro.email.send_auto_response"

Topic
-----

A **topic exchange** routes *messages* to one or many **queues** based on the matching between the **routing key** message and the pattern that was used to bind the **queue** to the **exchange**.

.. note:: Configure alternate exchange to be able to route messages to ``oro.default`` queue that does not fall under the binding rule.

*Example:*

.. code-block:: none

    # declare `oro.alternate` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.alternate" type="fanout" durable=true

    # decalre `oro.default` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" type="topic" durable=true arguments='{"alternate-exchange": "oro.alternate"}'

    # declare `oro.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.alternate` exchange to `oro.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.alternate" destination="oro.default" destination_type="queue"

    # declare `oro.email` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.email" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.default` exchange to `oro.email` queue by mask `oro.email.#`
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default" destination="oro.email" destination_type="queue" \
    routing_key="oro.email.#"

Headers
-------

A **headers exchange** is designed for routing on multiple attributes that are more easily expressed as **message headers** than a **routing key**. **Headers exchanges** ignore the **routing key** attribute. Instead, the attributes used for routing are taken from the headers attribute.

*Example:*

.. code-block:: none

    # declare `oro.alternate` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.alternate" type="fanout" durable=true

    # decalre `oro.default` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" type="headers" durable=true \
    arguments='{"alternate-exchange": "oro.alternate"}'

    # declare `oro.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.alternate` exchange to `oro.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.alternate" destination="oro.default" destination_type="queue"

    # declare `oro.search` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.search" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.default` exchange to `oro.search` queue with arguments
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default" destination="oro.search" destination_type="queue" \
    arguments='{"oro.message_queue.client.topic_name": "oro.website.search.indexer.reindex"}'

Delayed Message
---------------

A **delayed message exchange** route *messages* to the **queue** or to another **exchange** with **delay** described in the ``x-delay`` argument.

**Exchange** has type ``x-delayed-message`` and contains a special argument ``x-delayed-type`` which indicates how the exchange should behave.

Delayed Message Exchange is a RabbitMQ community plugin.

*Example:*

.. code-block:: none

    # declare `oro.default.delayed` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default.delayed" type="x-delayed-message" durable=true \
    arguments='{"x-delayed-type": "fanout"}'

    # declare `oro.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.default.delayed` exachange with `oro.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.default.delayed" destination="oro.default" destination_type=queue

.. code-block:: none

    $message = new Message();
    $message->setDelay(30);

    $this->messageProducer->send(Topics::TOPIC_NAME, $message);

Dead Letter
-----------

If an error has occurred during message processing or no matching queue can be found for the message, it can be republished to the Dead Letter Exchange instead of getting silently dropped.

It can be used as an alternative to Delayed Message Exchange which comes out-of-the-box.

*Example:*

.. code-block:: none

    # declare `oro.dlx.default` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.dlx.default" type="fanout" durable=true

    # declare `oro.dlx.default` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.dlx.default" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.dlx.default` exachange with type `fanout` to `oro.dlx.default` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.dlx.default" destination="oro.dlx.default" destination_type=queue
    
    # declare `oro.dlx.delayed` exchange
    rabbitmqadmin declare exchange --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.dlx.delayed" type="fanout" durable=true \
    arguments='{"x-delayed-type": "fanout"}'

    # declare `oro.dlx.delayed` queue
    rabbitmqadmin declare queue --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    name="oro.dlx.delayed" durable=true arguments='{"x-max-priority": 4}'

    # bind `oro.dlx.delayed` exachange with type `fanout` to `oro.dlx.delayed` queue
    rabbitmqadmin declare binding --host=$HOST --user=$USER --password=$PASSWORD --vhost=$VHOST \
    source="oro.dlx.delayed" destination="oro.dlx.delayed" destination_type=queue
    
    # set policy for `oro.dlx.default` queue
    rabbitmqctl set_policy -p $VHOST DLX "oro.dlx.default" '{"dead-letter-exchange": "oro.dlx.delayed"}' \
    --apply-to queues

For more information, see the following external resources:

* |RabbitMQ AMQP Model Explained|

.. include:: /include/include-links-dev.rst
   :start-after: begin
