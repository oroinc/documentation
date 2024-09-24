<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_8;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityConfigBundle\Migration\UpdateEntityConfigEntityValueQuery;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Turn field acl supported for Favorites.
 */
class TurnFieldAclSupportForFavorites implements Migration
{
    #[\Override]
    public function up(Schema $schema, QueryBag $queries): void
    {
        $queries->addQuery(
            new UpdateEntityConfigEntityValueQuery(
                'Acme\Bundle\DemoBundle\Entity\Favorite',
                'security',
                'field_acl_supported',
                true
            )
        );
    }
}
