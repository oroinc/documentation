.. _dev-integrations-import-export-overview:

Overview
========

Import-Export is built on top of OroBatchBundle Jobs. Every job consists of steps, and each step aggregates three critical components:

1. **Reader**

2. **Processor** itself can aggregate three data processing components: `Data Converter`, `Serializer`, `Strategy`

3. **Writer**

.. image:: /img/backend/integrations/import-export/import-step-diagram.svg
   :align: center
   :alt: Import Job

Each component is independent, with its own area of responsibility.

First, a step uses the reader to read the data from the source and passes it to the processor.

Then data is routed to the Processor. The processor can consist of three data manipulation layers: Data Converter, Serializer, and Strategy. In the processor, the data received from the reader is passed to the data converter, where it is transformed into a format that can be used by the serializer. The serializer converts the data into a format suitable for the writer. In addition, data processed by the serializer can be prepared for the writer by the strategy, for example, the strategy can be used to resolve entity relationships or to handle data conflicts.

.. image:: /img/backend/integrations/import-export/import-processor-diagram.svg
   :align: center
   :alt: Import Processor

In the final third stage, the Step passes the processed and write-ready data to the Writer.

Key Components
--------------

Import Export Components
^^^^^^^^^^^^^^^^^^^^^^^^

Reader
~~~~~~

The reader reads the data from a source. In terms of import, it can be a CSV file with imported data. In terms of export, the source is a Doctrine entity, its repository, or another query builder.

Processor
~~~~~~~~~

The processor is at the forefront of the job execution. The main logic of the specific job is concentrated here. The import processor converts array data to the entity object. The export processor does the opposite, it converts the entity object into an array representation.

Writer
~~~~~~

The writer is responsible for saving the results at a specific destination. In terms of import, it is a storage encapsulated with Doctrine. In terms of export, it is a plain CSV file.

Data Converter
~~~~~~~~~~~~~~

The data converter converts the data from data structure returned by the reader to a format applicable for the serializer.

Serializer
~~~~~~~~~~

The serializer namespace contains a dummy encoder (encoding/decoding is not needed for csv import), normalizers (collection, datetime, and entity), and required interfaces. It also contains the Serializer class extended from ``Symfony\Component\Serializer\Serializer`` to use both the extended ``supportsDenormalization`` and ``supportsNormalization`` methods.

Strategy
~~~~~~~~

The strategy namespace contains a strategy helper with generic import entities and ConfigurableAddOrReplaceStrategy that manages the entity import. StrategyInterface defines an interface for custom strategies.

TemplateFixture
~~~~~~~~~~~~~~~

When implementing import/export, it is very important that the data follows the expected format to give the user an example of how the data should look. For this purpose, the TemplateFixture has been introduced. This fixture is used to represent an exportable record that is used to create a downloadable data template.
The TemplateFixture namespace contains a fixture functionality template. TemplateFixtureInterface is an interface used to create fixtures. TemplateManager is a storage for the template fixtures import.

Batch Bundle Job Components
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Job
~~~

OroImportExportBundle uses OroBatchBundle to organize the execution of the import/export operations.
OroBatchBundle implements a job which is configured with execution context and is run by a client.
The job is abstract by itself, it does not know specific details of what happens during its execution.

Step
~~~~

Stores step elements (reader, processor and writer), responsible for Step Executor initialization and execution.

Step Executor
~~~~~~~~~~~~~

Step executor is responsible for data flow. In the step executor, the data returned from the reader is passed to the processor. Then the processed data can be accumulated and finally passed to the writer.

OroBatchBundle Configuration
----------------------------

This configuration is used by OroBatchBundle and encapsulates three jobs for importing the entity from a CSV file, validating the imported data and exporting the entity to a CSV file.

.. code-block:: yaml


    connector:
        name: oro_importexport
        jobs:
            entity_export_to_csv:
                title: "Entity Export to CSV"
                type: export
                steps:
                    export:
                        title:     export
                        reader:    oro_importexport.reader.entity
                        processor: oro_importexport.processor.export_delegate
                        writer:    oro_importexport.writer.csv
            entity_import_validation_from_csv:
                title: "Entity Import Validation from CSV"
                type: import_validation
                steps:
                    import_validation:
                        title:     import_validation
                        reader:    oro_importexport.reader.csv
                        processor: oro_importexport.processor.import_validation_delegate
                        writer:    oro_importexport.writer.doctrine_clear

            entity_import_from_csv:
                title: "Entity Import from CSV"
                type: import
                steps:
                    import:
                        title:     import
                        reader:    oro_importexport.reader.csv
                        processor: oro_importexport.processor.import_delegate
                        writer:    oro_importexport.writer.entity

Supported Formats
-----------------

Out-of-the-box Import/Export is bundled with Readers that support CSV and XLSx file formats, and can also read data from Doctrine entities.
There are writer implementations that support CSV and XLSx file formats, Doctrine entities, and direct writing to DB with InsertFromSelectWriter.

Dependencies
------------

As was mentioned previously, OroBatchBundle is a major dependency of this bundle. OroBatchBundle is used to execute the import/export batch operations. But when a client bundle uses OroImportExportBundle, it does not depend directly on any classes, interfaces, or configuration files of OroBatchBundle. OroImportExportBundle provides its own interfaces and domain models for the client bundle to interact with. From the client bundle's perspective, it is not necessary to create any job configurations to support the import/export of an entity.
