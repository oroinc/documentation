<?php

namespace ACME\Bundle\WysiwygBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddExtraContentField implements Migration
{
    public function up(Schema $schema, QueryBag $queries): void
    {
        if (!$schema->hasTable('acme_blog_post')) {
            return;
        }

        $table = $schema->getTable('acme_blog_post');
        if ($table->hasColumn('extra_content')) {
            return;
        }

        $table->addColumn('extra_content', 'wysiwyg', ['notnull' => false, 'comment' => '(DC2Type:wysiwyg)']);
        $table->addColumn('extra_content_style', 'wysiwyg_style', ['notnull' => false]);
        $table->addColumn('extra_content_properties', 'wysiwyg_properties', ['notnull' => false]);
    }
}
