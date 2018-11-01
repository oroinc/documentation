.. _dev-guide-system-message-queue-architecture-topic:

Message Topic
=============

Message Topic is used to differentiate the groups of messages.  Message Topics is a mandatory part of
**Pub/Sub messaging** pattern that used in Oro applications. Thereby every message In Oro applications must have a
Message Topic information in order to be sent to message queue.

If your bundle declares one or more Message Topics, it’s recommended to create dedicated dictionary class for
Message Topic names in bundles *Async* folder. For example:

.. code-block:: php
    :linenos:

    <?php

    namespace App\Acme\Bundle\CustomBundle\Async;

    class Topics
    {
        const REPORT_GENERATION = ‘acme.custom.report_generation’;
        const CALCULATE_TAXES = ‘acme.custom.calculate_taxes’;
    }

To list all declared topics with their destriptions that have at least one subscribed Message Processor, use the command

.. code-block:: bash

    ./bin/console oro:message-queue:topics
