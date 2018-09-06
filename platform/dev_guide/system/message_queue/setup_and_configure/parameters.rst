.. _dev-guide-system-message-queue-setup-configure-parameters:

Configure Message Queue Parameters
==================================

Full Set of Message Queue Settings
----------------------------------

The full set of Message Queue related application configuration parameters is the following:

.. code-block:: yaml
    :linenos:

    oro_message_queue:
        transport: # Message Queue Broker configuration

            default: 'dbal' # DBAL broker configuration example
            dbal:
                connection: default # doctrine dbal connection name
                table: oro_message_queue # table name where messages will be stored
                pid_file_dir: /tmp/oro-message-queue # RedeliverOrphanMessagesExtension stores consumer pid files here
                consumer_process_pattern: ':consume' # used by RedeliverOrphanMessagesExtension to check the working or non-working consumers
                                                     # (see limitations section for more details)
                polling_interval: 1000 # consumer polling interval in milliseconds
                                       # (see limitations section for more details)

            # default: 'amqp' # RabbitMQ broker configuration example
            # amqp:
            # 	host: 'localhost' # RabbitMQ server host
            # 	port: '5672' # RabbitMQ server port
            # 	user: 'guest' # RabbitMQ user name
            # 	password: 'guest' # RabbitMQ user password
            # 	vhost: '/' # RabbitMQ virtual host

        client:
            traceable_producer: false # Whether turned on Tracereable Message Producer
            prefix: 'oro' # Prefix of the queue name
            router_processor: 'oro_message_queue.client.route_message_processor' # The router processor service
            router_destination: 'default' # Router default message queue
            default_destination: 'default' # Default message queue
            default_topic: 'default' # Default topic name
            redelivered_delay_time: 10 # Delay for the requeuing of the unsuccessfull processed messages

        persistent_services: # Lists of services that should not be removed during the container reset
            - 'kernel'

        persistent_processors: # lists of MQ processors that should not be removed during the container reset
            - 'oro_message_queue.client.route_message_processor'

        security_agnostic_topics: # Messages of these topics should be always processed without the security context
            - 'oro.message_queue.job.calculate_root_job_status'

        security_agnostic_processors: # The Message Processors that should be processed without the security context
            - 'oro_message_queue.client.route_message_processor'

        consumer:
            heartbeat_update_period: 15 # Consumer heartbeat update period in minutes. To disable the checks, set this option to 0

        time_before_stale:
            default: ~ # Number of seconds of inactivity to qualify job as stale. If this attribute is not set or it
                       # is set to -1 jobs will never be qualified as stale. It means that if a unique Job is not properly
                       # removed after finish it will be blocking other Jobs of that type, until it will be manually interrupted

            jobs: # Number of seconds of inactivity to qualify jobs of this type as stale. To disable staling jobs
                  # for given job type set this option to -1. Key can be whole job name or a part of it from the
                  # beginning of string to any "."

                bundle_name.processor_name.entity_name.user: 20
                bundle_name.processor_name.entity_name: -1

Application configuration parameters should be put into the **config/config.yml** file of the application or into the **Resources/config/oro/app.yml** file of your custom bundle.

Instead of specifying the Message Queue broker settings in the application configuration files, you can put it to the
**parameters.yml** configuration file:

.. code-block:: yaml
    :linenos:

    # config/config.yml

    oro_message_queue:
        transport:
            default: '%message_queue_transport%'
            '%message_queue_transport%': '%message_queue_transport_config%'
        client: ~

.. code-block:: yaml
    :linenos:

    # config/parameters.yml

    message_queue_transport: 'amqp'
    message_queue_transport_config: { host: 'localhost', port: '5672', user: 'guest', password: 'guest', vhost: '/' }

Name Prefix for the Message Queue
---------------------------------

To use several independent Message Queues on a single **RabbitMQ** instance, configure a name prefix for the Message Queue. For example:

.. code-block:: yaml
    :linenos:

    # config/config.yml

    oro_message_queue:
        ...
        client:
            prefix: mq_oro_platform_test
            router_destination: queue_name
            default_destination: queue_name

In **router_destsination** and **default_destionation**, put the names of the queue specific to your environment. In the
prefix option, provide a string that should be prepended to the queue name.
