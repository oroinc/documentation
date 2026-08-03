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

Then the data is routed to the Processor, which can consist of three data manipulation layers: Data Converter, Serializer, and Strategy. The data converter transforms the data from the reader into a format the serializer can use. The serializer then converts it into a format suitable for the writer. Finally, the strategy can prepare the data for the writer --- for example, to resolve entity relationships or handle data conflicts.

.. image:: /img/backend/integrations/import-export/import-processor-diagram.svg
   :align: center
   :alt: Import Processor

In the final stage, the Step passes the processed, write-ready data to the Writer.

Key Components
--------------

Import Export Components
^^^^^^^^^^^^^^^^^^^^^^^^

Reader
~~~~~~

The reader reads the data from a source. In terms of import, it can be a CSV file with imported data. In terms of export, the source is a Doctrine entity, its repository, or another query builder.

Processor
~~~~~~~~~

The processor is at the forefront of job execution and holds the main logic of the specific job. The import processor converts array data to the entity object. The export processor does the opposite: it converts the entity object into an array representation.

Writer
~~~~~~

The writer is responsible for saving the results at a specific destination. In terms of import, it is a storage encapsulated with Doctrine. In terms of export, it is a plain CSV file.

Data Converter
~~~~~~~~~~~~~~

The data converter converts the data from the structure returned by the reader into a format applicable for the serializer.

Serializer
~~~~~~~~~~

The serializer namespace contains a dummy encoder (encoding/decoding is not needed for csv import), normalizers (collection, datetime, and entity), and required interfaces. It also contains the Serializer class extended from ``Symfony\Component\Serializer\Serializer`` to use both the extended ``supportsDenormalization`` and ``supportsNormalization`` methods.

Strategy
~~~~~~~~

The strategy namespace contains a strategy helper with generic import entities and ConfigurableAddOrReplaceStrategy that manages the entity import. StrategyInterface defines an interface for custom strategies.

TemplateFixture
~~~~~~~~~~~~~~~

When implementing import/export, the data must follow the expected format so users have an example of how it should look. The TemplateFixture serves this purpose: it represents an exportable record used to create a downloadable data template.

The TemplateFixture namespace contains a fixture functionality template. TemplateFixtureInterface is the interface used to create fixtures. TemplateManager stores the template fixtures for import.

Batch Bundle Job Components
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Job
~~~

OroImportExportBundle uses OroBatchBundle to organize the execution of import/export operations.
OroBatchBundle implements a job that is configured with an execution context and run by a client.
The job is abstract: it does not know the specific details of what happens during its execution.

Step
~~~~

Stores step elements (reader, processor and writer), responsible for Step Executor initialization and execution.

Step Executor
~~~~~~~~~~~~~

The step executor is responsible for data flow. It passes the data returned from the reader to the processor, then accumulates the processed data and passes it to the writer.

OroBatchBundle Configuration
----------------------------

OroBatchBundle uses this configuration. It encapsulates three jobs: importing the entity from a CSV file, validating the imported data, and exporting the entity to a CSV file.

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

Out of the box, Import/Export includes readers that support CSV and XLSx file formats and can also read data from Doctrine entities.
Writer implementations support CSV and XLSx file formats, Doctrine entities, and direct writing to the DB with InsertFromSelectWriter.

Dependencies
------------

OroBatchBundle is a major dependency of this bundle and executes the import/export batch operations. However, a client bundle that uses OroImportExportBundle does not depend directly on any of OroBatchBundle's classes, interfaces, or configuration files. Instead, OroImportExportBundle provides its own interfaces and domain models for the client bundle to interact with. From the client bundle's perspective, there is no need to create any job configurations to support the import/export of an entity.
