.. _bundle-docs-platform-tag-bundle:

OroTagBundle
============

OroTagBundle implements tags for application entities and enables users to manage tags on entity view pages, observe them in DataGrids, and use them as filtering fields in report query builders.
With this bundle, admin users can enable or disable the tag feature for particular entities in the entity management UI.

Developers can also configure tags for every entity in the entity configuration metadata.

Entity Configuration
--------------------

Tags can only be enabled for Configurable entities. To enable tags for an entity, use the `@Config` annotation, e.g.:

.. code-block:: php

    /**
    ...
     * @Config(
     *      defaultValues={
     *          ...
     *          "tag"={
     *              "enabled"=true
     *          }
     *          ...
     *      }
     * )
    ...
     */

Tags can also be enabled/disabled for an entity in the UI **System > Entities > Entity Management** (attribute `Tagging`).

**Please note**, |Taggable interface| is still supported, but deprecated. If entity implements Taggable interface, you cannot disable tagging for it in the UI.

Tags in Grids
-------------

In case if tags are enabled for an entity, tags filter and tags column will be automatically added to the grid of its
records.
You can use migration to hide tags column or tags filter from the grid by default.
The following example shows it:

.. code-block:: php

    namespace Acme\Bundle\TestBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AcmeTestBundle implements Migration
    {
        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $options = new OroOptions();

            // Hide tags column from grid by default.
            $options->set('tag', 'enableGridColumn', false);

            // Hide tags filter from grid by default.
            $options->set('tag', 'enableGridFilter', false);

            $table->addOption(OroOptions::KEY, $options);
        }
    }

Only tags that have been assigned to records of this entity will be available. The list of tags in the filter is also limited by the access level.

Tags in Report Builder
----------------------

Tags can be used in reports. If tags are enabled for the entity, virtual field `tags` and virtual relation `tags` will be available in the "Designer" section (Columns, Grouping Columns and Filters).

Tags in Views
-------------

By default Tags field is automatically added as the last element in the last sub-block of the first block in entity views.

To disable this behavior set `enableDefaultRendering` option to _false_ in the entity `@Config` annotation

.. code-block:: php

    /**
    ...
     * @Config(
     *      defaultValues={
     *          ...
     *          "tag"={
     *              "enabled"=true,
     *              "enableDefaultRendering"=false
     *          }
     *          ...
     *      }
     * )
    ...
     */


Then you are able to manually render tags somewhere else in the entity view template.

.. code-block:: none

    {% import 'OroUIBundle::macros.html.twig' as ui %}
    {% import 'OroTagBundle::macros.html.twig' as Tag %}
    ...
    {{ ui.renderHtmlProperty('oro.tag.entity_plural_label'|trans, Tag.renderView(entity)) }}
    ...

.. toctree::
   :maxdepth: 1

   TagsEditorView <tags-editor-view>
   TagsView <tags-view>

.. include:: /include/include-links-dev.rst
   :start-after: begin