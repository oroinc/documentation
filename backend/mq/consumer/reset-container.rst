.. _dev-cookbook-system-mq-reset-contaiter:

Resetting Container
===================

Container Reset
---------------

Each consumer processes all messages in a single thread. Some services hold an internal state, and processing one message can change that state and affect how the next message is processed.

To prevent this, the |ContainerResetExtension| extension removes all services from the dependency injection
container after processing a message. As a result, each message is processed with a *fresh* state of services. See the `Persistent Processors`_ and `Persistent Services`_ sections if you want to change this behavior.

To perform additional actions before the container reset, create a class that implements
|ClearerInterface| and register it in the container with the **oro_message_queue.consumption.clearer** tag. Use the **priority** attribute to change the execution order of your clearer --- the higher the priority, the earlier the clearer runs.

Persistent Processors
---------------------

Removing services from the container can dramatically affect consumer performance, because initializing
services can be expensive. For this reason, the container is not cleared after processors that
work correctly with the *dirty* state of services. Configure the list of such processors in
`Resources/config/oro/app.yml` or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        persistent_processors:
            - 'oro_message_queue.client.noop_message_processor'

This config file informs the |ContainerResetExtension| that the container should not be cleared after executing the
**oro_message_queue.client.noop_message_processor** processor.

Persistent Services
-------------------

As mentioned above, initializing some services can take a lot of time. Other services must not be removed
from the container at all, because doing so can crash the system --- the **kernel** is one such service.
Configure the list of services that must not be removed in `Resources/config/oro/app.yml`
or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        persistent_services:
            - 'kernel'

Please note that all persistent services must be declared **public**; otherwise, they will be ignored.

Persistent Consumption Extensions
---------------------------------

By default, all consumption extensions are recreated every time the container is reset. You can change
this for performance reasons, or because an extension holds an internal state that should be
kept unchanged even when the container is reset. To prevent recreation of an extension, mark it with the
**persistent** attribute in the **oro_message_queue.consumption.extension** tag.

For example:

.. code-block:: yaml

    acme.consumption.my_extension:
        class: Acme\Bundle\DemoBundle\Async\Consumption\Extension\MyExtension
        public: false
        tags:
            - { name: oro_message_queue.consumption.extension, persistent: true }

If a persistent extension still needs to reset its internal state when the container is reset, it can
implement |ResettableExtensionInterface|.

Cache State
-----------

Loading certain types of cache may be quite expensive. For this reason, some cache providers
were added to the **persistent_services** list, so they are not removed from the container after a message is processed.

To synchronize such caches between different processes, the |CacheState| service is used.
The **renewChangeDate** method should be called after a cache is changed. The **getChangeDate** method
returns the last cache modification time.

The |InterruptConsumptionExtension| uses the **CacheState** service to check whether a cache is changed.
If it is, the consumer is interrupted after processing the current message, so the new instance of the consumer will work with the correct cache.



.. include:: /include/include-links-dev.rst
   :start-after: begin
