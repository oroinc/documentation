<?php

namespace Acme\Bundle\DemoBundle\ImportExport\Configuration;

use Acme\Bundle\DemoBundle\Entity\DoctrineTypeField;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;

/**
 * Import-Export configuration provider for DoctrineTypeField.
 */
class DoctrineTypeFieldImportExportConfigurationProvider implements ImportExportConfigurationProviderInterface
{
    public function get(): ImportExportConfigurationInterface
    {
        return new ImportExportConfiguration([
            ImportExportConfiguration::FIELD_ENTITY_CLASS => DoctrineTypeField::class,
            ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS => 'acme_demo_doctrine_type_field',
            ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'acme_demo_doctrine_type_field',
        ]);
    }
}
