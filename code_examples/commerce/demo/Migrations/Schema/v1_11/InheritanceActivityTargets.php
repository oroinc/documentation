<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_11;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\ActivityListBundle\Migration\Extension\ActivityListExtension;
use Oro\Bundle\ActivityListBundle\Migration\Extension\ActivityListExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class InheritanceActivityTargets implements Migration, ActivityListExtensionAwareInterface
{
    /** @var ActivityListExtension */
    protected $activityListExtension;

    /**
     * {@inheritdoc}
     */
    public function setActivityListExtension(ActivityListExtension $activityListExtension)
    {
        $this->activityListExtension = $activityListExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        self::addInheritanceTargets($schema, $this->activityListExtension);
    }

    public static function addInheritanceTargets(Schema $schema, ActivityListExtension $activityListExtension)
    {
        $activityListExtension->addInheritanceTargets(
            $schema,
            'acme_demo_priority',
            'acme_demo_document',
            ['priority']
        );
    }
}
