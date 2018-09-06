.. _dev-guide-system-message-queue-setup-configure:

Setup and Configuration
=======================

In order to prepare the Message Queue functionality to work in Oro applications, three steps are required:

1. :ref:`Setup the message queue broker <dev-guide-system-message-queue-setup-configure-broker>`
2. :ref:`Configure the message queue-related application configuration settings <dev-guide-system-message-queue-setup-configure-parameters>`
3. :ref:`Setup and run the consumer <dev-guide-system-message-queue-setup-configure-consumer>`

Depending on the chosen Message Queue broker and the requirements for Message Queue performance, scenarios for each of the three steps  can vary.

For simple cases, when you choose the built-in DBAL broker and only one consumer process to be run (e.g., for
the development purpose), it is enough to take the following 2 steps:

1. **Configure application settings**. As the DBAL broker is built-in in the every Oro application, there is no need to
install it independently in the first step:

    .. code-block:: bash

        # config/config.yml

        oro_message_queue:
            transport:
                default: '%message_queue_transport%'
                '%message_queue_transport%': '%message_queue_transport_config%'
            client: ~

    .. code-block:: bash

        # config/parameters.yml

        message_queue_transport: DBAL
        message_queue_transport_config: ~

2. **Run the consumer** as a background process. Type the following command into the console:

    .. code-block:: bash

        ./bin/console oro:message-queue:consume

For complex cases (e.g., for the RabbitMQ broker, and/or production mode of the application), please see the detailed description of setup steps in the topics below:

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 1

    broker
    parameters
    consumer
    rabbit_mq_in_production
