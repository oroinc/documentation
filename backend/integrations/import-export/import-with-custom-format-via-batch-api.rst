.. _dev-integrations-import-export-import-with-custom-format-via-batch-api:

Import Custom Format File Via Batch API
=======================================

In some cases, importing data in CSV format may not be suitable for your integration needs. To address this, developers can implement custom import workflows using their own data formats.

In such scenarios, your custom data is transformed into JSON:API format and processed using the Batch API.

This approach is already implemented for importing external orders in JSON format, but you can also configure your own custom format.

To do this:

Add a Configuration File
------------------------

Create a configuration for your main entity and for the entities that will be used in relations.

The file format is as follows:

.. code-block:: yaml

    entity_name: # the name of entity in current file
        target_type: productunits # API resource name of given entity
        collection: true|false # specifies if the data of given data is array
        entity: Acme\Demo\Entity\MyEntity # class name of the entity if should be found existing one but not create one
        lookup_field: field_name # fields name for case when the entity should be found. Specifies the name of the field used to search for an existing entity. By default – ID.
        ignore_not_found: true|false # specifies if the validation exception should be added if existing entity was not found
        fields: # the list of fields used to create new entity
            field_name: # the field name in input file
                target_path: attributes.identifier # the path of JSON:API structure where the data should be mapped
                value: some_value # the value should be set by default
                source: anotherField # the path from which the value for the field will be taken from the input file.
                ref: ref_entity_name # specifies the entity should be mapped for given field
                entity_data_type: date # the data type to which the input data should be converted
                entity_path: businessUnitOwner.name # specifies a custom path from which to retrieve data from the entity when generating the import template.

As example of existing configuration, see the configuration of the |External Orders Import|.

Configure the Mapping
---------------------

Add service configuration for the mapping you created.

.. code-block:: yaml

    acme_demo.importexport.converter.my_import_mapping_provider.from_config_files:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\Mapping\ComplexDataStaticMappingProvider
        parent: oro.static_config_provider.abstract
        arguments:
            - 'external_order_import_mapping'
            - 'Resources/config/oro/my_import_mapping_provider.yml' # the name of mapping file
            - '%kernel.cache_dir%/oro/my_import_mapping_provider.php' # the name of temp file where configuration will be stored
            - '%kernel.debug%'
        tags:
            - { name: oro_order.importexport.my_import_mapping_provider, priority: 10 }

    acme_demo.importexport.converter.my_import_mapping_provider:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\Mapping\ComplexDataMappingProvider
        arguments:
            - !tagged_iterator oro_order.importexport.external_order_import_provider

In some cases, you may need to add or modify the mapping dynamically. For this, you can register additional mapping providers using the same service tag that was used to add the main configuration.

The class of such a provider must implement the |ComplexDataMappingProviderInterface| interface. An example of such a provider is |OrderStatusMappingProvider|.

Configure the Converter
-----------------------

The converter converts your custom input data into JSON:API format.

You can use the existing default converter that converts data from plain JSON format.

To use it in your import, add the following configuration:

.. code-block:: yaml

    acme_demo.importexport.converter.data_accessor:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\DataAccessor\ComplexDataConvertationDataAccessor
        arguments:
            - '@oro_entity.doctrine_helper'
            - '@property_accessor'
            - '@oro_importexport.complex_data_entity_loader'
            - '@oro_entity_extend.enum_options_provider'

    acme_demo.importexport.converter.my_import_converter:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\JsonApiImportConverter
        arguments:
            - '@acme_demo.importexport.converter.my_import_mapping_provider'
            - '@property_accessor'
            - '@acme_demo.importexport.converter.data_accessor'
            - 'my_entity_name' # the entity name of the main import entity


There are cases when the standard converter is not sufficient. In such case, you can add additional converters to the main converter.

To do this:

* Create your own converter that implements the ``ComplexDataConverterInterface`` interface and register it with your additional converters tag:

.. code-block:: yaml

        acme_demo.importexport.converter.additional_converter.my_converter:
            class: Acme\Demo\ImportExport\Converter\MyrConverter
            tags:
                - { name: acme.my_import.additional_converter, entity: my_entity }


* Add it to the converter registry:

.. code-block:: yaml

    acme_demo.importexport.converter.additional_converter_registry:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\ComplexDataConverterRegistry
        arguments:
            - !abstract '$converters defined in Acme\Demo\DemoBundle'
            - !abstract '$container defined in Acme\Demo\DemoBundle'

* Add the tagged services to the registry service with a compiler pass:

.. code-block:: php

    namespace Acme\Demo\DemoBundle;

    use Oro\Component\DependencyInjection\Compiler\PriorityNamedTaggedServiceWithHandlerCompilerPass;
    use Oro\Component\DependencyInjection\Compiler\TaggedServiceTrait;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeDemoBundle extends Bundle
    {
        use TaggedServiceTrait;

        #[\Override]
        public function build(ContainerBuilder $container): void
        {
            parent::build($container);

            $container->addCompilerPass(new PriorityNamedTaggedServiceWithHandlerCompilerPass(
                'acme_demo.importexport.converter.additional_converter_registry',
                'acme.my_import.additional_converter',
                function (array $attributes, string $serviceId, string $tagName): array {
                    return [
                        $serviceId,
                        $this->getRequiredAttribute($attributes, 'entity', $serviceId, $tagName)
                    ];
                }
            ));
        }
    }

* Connect the registry to the main converter using the ``setConverterRegistry`` method.

.. code-block:: yaml

    acme_demo.importexport.converter.my_import_converter:
        class: Oro\Bundle\ImportExportBundle\Converter\ComplexData\JsonApiImportConverter
        arguments:
            - '@acme_demo.importexport.converter.my_import_mapping_provider'
            - '@property_accessor'
            - '@acme_demo.importexport.converter.data_accessor'
            - 'my_entity_name' # the entity name of the main import entity
        calls:
            - [setConverterRegistry, ['@acme_demo.importexport.converter.additional_converter_registry']]

* Finally, register ``ComplexDataToJsonApiImportProcessor``:

.. code-block:: yaml

    acme_demo.importexport.processor.my_import_import:
        class: Oro\Bundle\ImportExportBundle\Processor\ComplexData\ComplexDataToJsonApiImportProcessor
        arguments:
            - '@acme_demo.importexport.converter.my_import_converter'
        tags:
            - { name: oro_importexport.processor, type: import, entity: Acme\Demo\Entity\MyEntity, alias: my_import.add }
            - { name: oro_importexport.processor, type: import_validation, entity: OAcme\Demo\Entity\MyEntity, alias: my_import.add }

Configure Import Batch Jobs
---------------------------

The next step is to configure writers for both import processing and data validation:

.. code-block:: yaml

    acme_demo.importexport.writer.my_import:
        parent: oro_importexport.writer.json_api_batch_api_import_writer
        arguments:
            - 'Acme\Demo\Entity\MyEntity'
            - 'my_import'

    acme_demo.importexport.writer.my_import.validation:
        parent: oro_importexport.writer.json_api_batch_api_import_writer
        arguments:
            - 'Acme\Demo\Entity\MyEntity'
            - 'my_import_validation'

And configure batch jobs in the **batch_jobs.yml** file:

.. code-block:: yaml

    connector:
        name: oro_importexport
        jobs:
            my_import_from_json:
                title: "Myr Import from JSON"
                type: import
                steps:
                    import:
                        title: import
                        class: Oro\Bundle\BatchBundle\Step\ItemStep
                        services:
                            reader: oro_importexport.reader.json
                            processor: oro_importexport.processor.import_delegate
                            writer: acme_demo.importexport.writer.my_import
                        parameters: ~
            my_import_validation_from_json:
                title: "My Import Validation from JSON"
                type: import_validation
                steps:
                    import_validation:
                        title: import_validation
                        class: Oro\Bundle\BatchBundle\Step\ItemStep
                        services:
                            reader: oro_importexport.reader.json
                            processor: oro_importexport.processor.import_delegate
                            writer: acme_demo.importexport.writer.my_import.validation
                        parameters: ~

Configure Import Configuration Provider
---------------------------------------

As the final step, add a configuration provider for your new import type:

.. code-block:: php

    <?php

    namespace Acme\Demo\DemoBundle\ImportExport\Configuration;

    use Acme\Demo\Entity\MyEntity;
    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;
    use Symfony\Contracts\Translation\TranslatorInterface;

    /**
     * Provides the configuration for the my import.
     */
    class MyImportConfigurationProvider implements ImportExportConfigurationProviderInterface
    {
        public function __construct(
            private TranslatorInterface $translator
        ) {
        }

        #[\Override]
        public function get(): ImportExportConfigurationInterface
        {
            return new ImportExportConfiguration([
                ImportExportConfiguration::FIELD_ENTITY_CLASS => MyEntity::class,
                ImportExportConfiguration::FIELD_IMPORT_JOB_NAME => 'my_import_from_json',
                ImportExportConfiguration::FIELD_IMPORT_VALIDATION_JOB_NAME => 'my_import_validation_from_json',
                ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'my_import.add',
                ImportExportConfiguration::FIELD_IMPORT_FORM_FILE_ACCEPT_ATTRIBUTE => '.json,application/json',
                ImportExportConfiguration::FIELD_IMPORT_FORM_FILE_MIME_TYPES => ['application/json'],
                ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_JOB_NAME => 'entity_export_template_to_json',
                ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_PROCESSOR_ALIAS => 'my_import'
            ]);
        }
    }

.. include:: /include/include-links-dev.rst
    :start-after: begin


**Related Topics**

* :ref:`Configure Global External Order Import Settings in the Back-office <system-configuration-orders-external-order-import>`
* :ref:`Import External Orders in JSON Format in the Back-Office <user-guide--sales--orders--external-orders-import>`