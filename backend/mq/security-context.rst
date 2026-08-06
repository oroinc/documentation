.. _dev-cookbook-system-mq-access-security-context:

Security Context
================

Passing Security Context from Producer to Consumer
--------------------------------------------------

By default, if the code that sent a message to the message queue works in a security context (that is, a security token exists in the token storage), the token is serialized and added to the message.

When the consumer processes the message, it extracts the token and adds it to the token storage on the consumer side.

Sometimes you need to change this behavior for certain types of messages. The following sections describe how.

Adding Custom Security Token to Message
---------------------------------------

To process a message in a security context different from the producer's, add a security token to the message manually. The token can be:

- an instance of a class that implements the TokenInterface,
- a string that represents an already serialized token,
- or *null* if the message is processed without a security context.

Use the `oro.security.token` property to add the security token.

For instance:

.. code-block:: php


    use Oro\Bundle\MessageQueueBundle\Security\SecurityAwareDriver;

    $message->setProperty(SecurityAwareDriver::PARAMETER_SECURITY_TOKEN, $token);

Security Agnostic Topics
------------------------

If some types of messages should always be processed without the security context, add them to the list of
security agnostic topics. Configure this list in `Resources/config/oro/app.yml` or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        security_agnostic_topics:
            - 'oro.message_queue.job.root_job_stopped'

For such messages, the security token is never added to the message. Even if you added a token manually, it is removed before the message is sent to the message queue.

Security Agnostic Processors
----------------------------

For performance reasons, you sometimes need to run a message queue processor without a security context, even if the processed message contains a security token.

The typical use case is routing processors. These processors forward a message to the destination processor and never use the security token, so deserializing it would only waste time.

Here is an example how to add a processor to the list of security agnostic processors using `Resources/config/oro/app.yml` or the application configuration file:

.. code-block:: yaml

    oro_message_queue:
        security_agnostic_processors:
            - 'oro_message_queue.client.noop_message_processor'


.. include:: /include/include-links-dev.rst
   :start-after: begin
