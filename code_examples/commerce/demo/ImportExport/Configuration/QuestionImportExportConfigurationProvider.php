<?php

namespace Acme\Bundle\DemoBundle\ImportExport\Configuration;

use Acme\Bundle\DemoBundle\Entity\Question;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;

/**
 * Import-Export configuration provider for Question.
 */
class QuestionImportExportConfigurationProvider implements ImportExportConfigurationProviderInterface
{
    public function get(): ImportExportConfigurationInterface
    {
        return new ImportExportConfiguration([
            ImportExportConfiguration::FIELD_ENTITY_CLASS => Question::class,
            ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS => 'acme_demo_question',
            ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'acme_demo_question',
        ]);
    }
}
