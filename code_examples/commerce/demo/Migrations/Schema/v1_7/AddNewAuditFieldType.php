<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtension;
use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * New audit field type creation.
 */
class AddNewAuditFieldType implements Migration, AuditFieldExtensionAwareInterface
{
    private AuditFieldExtension $auditFieldExtension;

    /**
     * @inheritDoc
     */
    public function setAuditFieldExtension(AuditFieldExtension $extension)
    {
        $this->auditFieldExtension = $extension;
    }

    public function up(Schema $schema, QueryBag $queries)
    {
        $this->auditFieldExtension->addType($schema, $doctrineType = 'datetimetz', $auditType = 'datetimenew');
    }
}
