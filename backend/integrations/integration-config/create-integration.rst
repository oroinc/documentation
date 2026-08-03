.. _dev-integrations-integrations-config:

Basic Implementation
====================

Integrating other applications requires you to implement several services that form the integration
skeleton:

* :ref:`Create a New Channel <cookbook-integration-channel>`
* :ref:`Read Data Using a Transport <cookbook-integration-transport>`
* :ref:`Connect Data to Your Entities <cookbook-integration-connector>`

.. _cookbook-integration-channel:

Create a New Channel
--------------------

The first step is to define a new channel. A channel makes your integration visible in
the integration section of the back-office. It is a class that implements the
``Oro\Bundle\IntegrationBundle\Provider\ChannelInterface``:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Integration/TaskChannel.php

    namespace Acme\Bundle\DemoBundle\Integration;

    use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;

    class TaskChannel implements ChannelInterface
    {
        /**
         * @inheritDoc
         */
        public function getLabel(): string
        {
            return 'acme.task_channel.label';
        }
    }

The ``ChannelInterface`` requires you to implement the ``getLabel()`` method, which returns a translation key
that is translated and shown to the user in the UI.

To display an icon, also implement the ``Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface``
and its ``getIcon()`` method, which returns a path to the icon relative to the project's web directory:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Integration/TaskChannel.php

    namespace Acme\Bundle\DemoBundle\Integration;

    use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
    use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

    class TaskChannel implements ChannelInterface, IconAwareIntegrationInterface
    {
        /**
         * @inheritDoc
         */
        public function getLabel(): string
        {
            return 'acme.task_channel.label';
        }

        /**
         * @inheritDoc
         */
        public function getIcon(): string
        {
            return 'icons/task.png';
        }
    }

To make the class available in the user interface, register it as a service tagged with
``oro_integration.channel``. Configure the ``type`` attribute with a unique value that the
OroIntegrationBundle uses internally to refer to the channel:

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/integration.yml

    services:
        acme_demo.integration.task:
            class: Acme\Bundle\DemoBundle\Integration\TaskChannel
            tags:
                - { name: oro_integration.channel, type: acme_task_channel }

.. _cookbook-integration-transport:

Read Data Using a Transport
---------------------------

For every channel, you can define several ways to read data from your external application (for
example, via SOAP or an HTTP REST API). This concept is called a transport. A class providing
such a transport must implement the ``Oro\Bundle\IntegrationBundle\Provider\TransportInterface``,
which requires four methods:

``init(Transport $transport)``
    Initializes the transport. The passed object contains the settings for this transport that was
    configured using the form type identified by the name returned by ``getSettingsFormType()``. It
    is an instance of the class configured by the ``getSettingsEntityFQCN()`` method.

``getLabel()``
    The translation key used to display the transport label in the UI.

``getSettingsFormType()``
    The FQCN of the form type that is used to let the user configure transport specific settings
    (for example, access credentials for API endpoints).

``getSettingsEntityFQCN()``
    The fully-qualified class name of the entity that stores the settings configured through the
    aforementioned form type (this should be a subclass of ``Oro\Bundle\IntegrationBundle\Entity\Transport``).

Then register your transport as a service tagged with ``oro_integration.transport``.
Use the ``channel_type`` attribute to define the channel the transport is connected with. Give the
transport an identifier in the ``type`` attribute, which must be unique across the channel:

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/integration.yml

    services:
        acme_demo.integration.transport.rest:
            class: Acme\Bundle\DemoBundle\Integration\RestTransport
            tags:
                - { name: oro_integration.transport, channel_type: acme_task_channel, type: rest }

.. _cookbook-integration-connector:

Connect Data to Your Entities
-----------------------------

.. note::
   This step is necessary when you need to import-export data between your database and the third-party system (for example, to synchronize tasks created in your Oro instance and another application, or to import/export cart items). Omit it if your integration only requests and receives credentials/tokens and a short list of available options.

Your final step is to implement the ``Oro\Bundle\IntegrationBundle\Provider\ConnectorInterface``:

``getLabel()``
    The translation key used to display the connector label in the UI.

``getImportExportEntityFQCN()``
    The fully-qualified class name of the entities being imported.

``getImportJobName()``
    The job name that handles the import.

``getType()``
    A string that identifies the connector. This must be unique throughout the channel.

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Integration/TaskConnector.php

    namespace Acme\Bundle\DemoBundle\Integration;

    use Oro\Bundle\IntegrationBundle\Provider\ConnectorInterface;

    class TaskConnector implements ConnectorInterface
    {
        /**
         * @inheritDoc
         */
        public function getLabel(): string
        {
            return 'acme.connector.task.label';
        }

        /**
         * @inheritDoc
         */
        public function getImportEntityFQCN(): string
        {
            return 'Acme\Bundle\DemoBundle\Entity\Task';
        }

        /**
         * @inheritDoc
         */
        public function getImportJobName()
        {
            return 'acme_task_import';
        }

        /**
         * @inheritDoc
         */
        public function getType(): string
        {
            return 'task';
        }
    }

Then register the class implementing the ``ConnectorInterface`` as a service tagged with
``oro_integration.connector``. Use the ``channel_type`` attribute to define the channel the
connector is associated with. The ``type`` attribute must have the same value returned by
the connector's ``getType()`` method:

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/integration.yml

    services:
        acme_demo.connector.task
            class: Acme\Bundle\DemoBundle\Integration\TaskConnector
            tags:
                - { name: oro_integration.connector, channel_type: acme_task_channel, type: task }


.. include:: /include/include-links-dev.rst
    :start-after: begin
