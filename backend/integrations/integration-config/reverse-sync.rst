.. _dev-integrations-integrations-reverse-sync:

Reverse Synchronization
=======================

For integration that requires synchronization in both sides, there is a possibility to declare export process on connector level.
Your connector should implement `Oro\\Bundle\\IntegrationBundle\\Provider\\TwoWaySyncConnectorInterface` to expose the job name
that will make export.

Export Job Definition
---------------------

The definition of the export job is similar to import. It is an additional job for `Akeneo\\Bundle\\BatchBundle`
that should be added to `batch_job.yml`. A job might be declared with multiple steps, but a good practice is to use one connector for one entity.
In order to read a entity from the database, there is additional reader placed in OroIntegrationBundle `oro_integration.reader.entity.by_id`,
it takes the `EntityReaderById::ID_FILTER` option from the context object(`ContextInterface`) for the matching entity to read.

.. note:: For now only non-composite identifiers are supported.

**Example:**

.. code-block:: yaml
   :linenos:

    #batch_job.yml
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

Processor and writer could be initialized in your bundle in **service.yaml**.

**Example:**

.. code-block:: yaml
   :linenos:

    YOUR_PROCESSOR:
        class: Acme\Bundle\AcmeBundle\Processor\YourProcessor
    YOUR_REVERSE_WRITER:
        class:Acme\Bundle\AcmeBundle\Writer\YourReverseWriter

Where `YOUR_PROCESSOR.class` - should implement Oro\\Bundle\\ImportExportBundle\\Processor\\ProcessorInterface
and `YOUR_REVERSE_WRITER.class` - should implement Oro\\Bundle\\ImportExportBundle\\Processor\\WriterInterface

Implementation of those classes is platform-specific, so there is no abstraction layer.
