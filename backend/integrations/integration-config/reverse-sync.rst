.. _dev-integrations-integrations-reverse-sync:

Reverse Synchronization
=======================

Some integrations require synchronization in both directions. To support this, you can declare an export process at the connector level.
Your connector must implement ``Oro\Bundle\IntegrationBundle\Provider\TwoWaySyncConnectorInterface`` to expose the name of the job
that performs the export.

Export Job Definition
---------------------

The export job is defined much like an import job. It is an additional job for ``Oro\Bundle\BatchBundle`` that you add to ``batch_job.yml``.

A job can declare multiple steps, but as a good practice, use one connector per entity.

To read an entity from the database, use the reader ``oro_integration.reader.entity.by_id`` provided by OroIntegrationBundle.
It reads the matching entity using the ``EntityReaderById::ID_FILTER`` option from the context object (``ContextInterface``).

.. note:: For now only non-composite identifiers are supported.

**Example:**

.. code-block:: yaml
    :caption: batch_job.yml

    example_export:
        title: Job title here
        type:  export
        steps:
            export_entity_1:
                title:      Step title here
                class:      Oro\Bundle\BatchBundle\Step\ItemStep
                services:
                    reader:    oro_integration.reader.entity.by_id  # read entity from database by identifier
                    processor: YOUR_PROCESSOR                       # service which process each record. Could prepare changeset for writer.
                    writer:    YOUR_REVERSE_WRITER                  # service that are responsible for pushing data to remote instance
                parameters: ~
            # .... another steps

You can initialize the processor and writer in your bundle in **service.yaml**.

**Example:**

.. code-block:: yaml


    YOUR_PROCESSOR:
        class: Acme\Bundle\DemoBundle\Processor\YourProcessor
    YOUR_REVERSE_WRITER:
        class:Acme\Bundle\DemoBundle\Writer\YourReverseWriter

Where ``YOUR_PROCESSOR.class`` --- should implement Oro\\Bundle\\ImportExportBundle\\Processor\\ProcessorInterface
and ``YOUR_REVERSE_WRITER.class`` --- should implement Oro\\Bundle\\ImportExportBundle\\Processor\\WriterInterface

Implementation of those classes is platform-specific, so there is no abstraction layer.
