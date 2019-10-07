.. _dev-cookbook-system-mq-access-security-context:

Security Context
================

Passing Security Context from Producer to Consumer
--------------------------------------------------

By default, if the code that sent a message to the message queue works in some security context, or in other words,
a |security token|
exists in the |token storage|, the security token is serialized and added to the message. When the consumer processes this message, the security token
is extracted from the message and is added to the token storage on the consumer side.

Sometimes, however, this behaviour need to be changed for certain types of messages.

The following sections describe how this can be achieved.

Adding Custom Security Token to Message
---------------------------------------

If you need to process a message in the security context that is different to the producer's security context,
you can add a security token to the message manually. The added token can be an instance of a class that implements the
|TokenInterface|. A string represents the already serialized token or *null* if the message is processed without a security context. To add the security token, the `oro.security.token` property should be used.

For instance:

.. code-block:: php
    :linenos:

    use Oro\Bundle\MessageQueueBundle\Security\SecurityAwareDriver;

    $message->setProperty(SecurityAwareDriver::PARAMETER_SECURITY_TOKEN, $token);

Security Agnostic Topics
------------------------

If some types of messages should always be processed without the security context, they should be added to the list of
security agnostic topics. This list can be configured by *Resources/config/oro/app.yml* or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        security_agnostic_topics:
            - 'oro.message_queue.job.calculate_root_job_status'

Please note that for such messages the security token is never added to the message. Moreover, even if the security
token was added to the message manually, it will be removed before the message is sent to the message queue.

Security Agnostic Processors
----------------------------

Mostly for performance reasons, it is sometimes required to execute a message queue processor without security
context even if the processed message contains a security token.

The typical use case is routing processors. These processors simply forward a message to the destination processor and it would be unreasonable to waste the processor time to deserialize the security token as it is never used in such types of processors.

Here is an example how to add a processor to the list of security agnostic processors using *Resources/config/oro/app.yml* or the application configuration file:

.. code-block:: yaml

    oro_message_queue:
        security_agnostic_processors:
            - 'oro_message_queue.client.route_message_processor'


.. include:: /include/include-links.rst
   :start-after: begin