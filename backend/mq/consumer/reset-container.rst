.. _dev-cookbook-system-mq-reset-contaiter:

Resetting Container
===================

Container Reset
---------------

As each consumer processes all messages in one thread but there are cases when some services have an internal state. This state can be changed when processing a message which can have an affect on processing the next message.

To prevent this problem, after processing a message all services are removed from the dependency injection
container by |ContainerResetExtension| extension. As a result, each message is processed by a *fresh* state of services. See `Persistent Processors`_ and `Persistent Services`_ sections, if you want to change this behavior.

If it is required to perform additional actions before the container reset, you can create a class implements
|ClearerInterface| and register it in the container with the **oro_message_queue.consumption.clearer** tag. The **priority** attribute can be used to change the execution order of your clearer. The higher the priority, the earlier the clearer is executed.

Persistent Processors
---------------------

Removing services from the container can affect the consumer performance dramatically because initialization
of services can be an expensive operation. This is the reason why the container is not cleared after execution of
some processors that can work correctly with the *dirty* state of services. The list of such processors can
be configured by *Resources/config/oro/app.yml* or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        persistent_processors:
            - 'oro_message_queue.client.route_message_processor'

This config file informs the |ContainerResetExtension| that the container should not be cleared after executing the
**oro_message_queue.client.route_message_processor** processor.

Persistent Services
-------------------

As mentioned above, initialization of some services can take a lot of time. Also, some services should not be removed
from the container because it can lead to a crash of the system, the **kernel** is an example of such service.
The list of services that should not be removed from the container can be configured by *Resources/config/oro/app.yml*
or the application configuration file.

For example:

.. code-block:: yaml

    oro_message_queue:
        persistent_services:
            - 'kernel'

Please note that all persistent services must be declared **public**; otherwise, they will be ignored.

Persistent Consumption Extensions
---------------------------------

By default all consumption extensions are recreated every time the container is reset. This can be
changed for performance reasons or because some extensions may have an internal state that should be
kept unchanged even if the container is reset. To prevent recreation of an extension, mark it with the
**persistent** attribute in the tag **oro_message_queue.consumption.extension**.

For example:

.. code-block:: yaml

    acme.consumption.my_extension:
        class: Acme\Bundle\AppBundle\Async\Consumption\Extension\MyExtension
        public: false
        tags:
            - { name: oro_message_queue.consumption.extension, persistent: true }

Also, if an extension is marked as persistent but it is required to reset an internal state when resetting
the container, the extension can implement |ResettableExtensionInterface|.

Cache State
-----------

Loading certain types of cache may be quite expensive. For this reason, some cache providers
were added to the **persistent_services** list to prevent removing them from the container after processing of a message.

To synchronize such caches between different processes, the |CacheState| service is used.
The **renewChangeDate** method should be called after a cache is changed. The **getChangeDate** method
returns the last cache modification time.

The |InterruptConsumptionExtension| uses the **CacheState** service to check whether a cache is changed.
If it is, the consumer is interrupted after processing the current message, so the new instance of the consumer will work with the correct cache.



.. include:: /include/include-links-dev.rst
   :start-after: begin