<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_10;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareTrait;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AcmeDemoBundle implements Migration, ActivityExtensionAwareInterface
{
    use ActivityExtensionAwareTrait;

    /**
     * {@inheritDoc}
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        $this->activityExtension->addActivityAssociation($schema, 'oro_email', 'acme_demo_document', true);
        $this->activityExtension->addActivityAssociation($schema, 'acme_demo_sms', 'acme_demo_document', true);
        $this->activityExtension->addActivityAssociation($schema, 'orocrm_call', 'acme_demo_priority');
    }
}
