<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_10;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtension;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;

class AcmeDemoBundle implements Migration, ActivityExtensionAwareInterface
{
    protected ActivityExtension $activityExtension;

    /**
     * {@inheritdoc}
     */
    public function setActivityExtension(ActivityExtension $activityExtension)
    {
        $this->activityExtension = $activityExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        self::addActivityAssociations($schema, $this->activityExtension);
    }

    /**
     * Enables Email activity for Document entity
     */
    public static function addActivityAssociations(Schema $schema, ActivityExtension $activityExtension)
    {
        $activityExtension->addActivityAssociation($schema, 'oro_email', 'acme_demo_document', true);
        $activityExtension->addActivityAssociation($schema, 'acme_demo_sms', 'acme_demo_document', true);
        $activityExtension->addActivityAssociation($schema, 'orocrm_call', 'acme_demo_priority');
    }
}
