<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtensionAwareInterface;
use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtensionAwareTrait;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddNewAuditFieldType implements Migration, AuditFieldExtensionAwareInterface
{
    use AuditFieldExtensionAwareTrait;

    #[\Override]
    public function up(Schema $schema, QueryBag $queries): void
    {
        $this->auditFieldExtension->addType($schema, 'datetimetz', 'datetimenew');
    }
}
