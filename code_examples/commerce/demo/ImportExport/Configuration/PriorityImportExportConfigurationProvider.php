<?php

namespace Acme\Bundle\DemoBundle\ImportExport\Configuration;

use Acme\Bundle\DemoBundle\Entity\Priority;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;

/**
 * Import-Export configuration provider for Priority.
 */
class PriorityImportExportConfigurationProvider implements ImportExportConfigurationProviderInterface
{
    #[\Override]
    public function get(): ImportExportConfigurationInterface
    {
        return new ImportExportConfiguration([
            ImportExportConfiguration::FIELD_ENTITY_CLASS => Priority::class,
            ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS => 'acme_demo_priority',
            ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'acme_demo_priority',
        ]);
    }
}
