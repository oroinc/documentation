.. _bundle-docs-platform-note-bundle:

OroNoteBundle
=============

OroNoteBundle provides the ability for the application users to add notes on an entity record page and enable or disable this feature for every entity type in the entity management UI.

Enable Notes Using Migrations
-----------------------------

Notes could be enabled for the entity in the same way as for any other Activity entity. See following example:

.. code-block:: php

    namespace Oro\Bundle\AccountBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtension;
    use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroAccountBundle implements Migration, ActivityExtensionAwareInterface
    {
        /**
         * @var ActivityExtension
         */
        protected $activityExtension;

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->addNoteAssociations($schema);
        }

        /**
         * Enable notes for Account entity
         */
        protected function addNoteAssociations(Schema $schema)
        {
            $this->activityExtension->addActivityAssociation($schema, 'oro_note', 'orocrm_account');
        }

        /**
         * {@inheritdoc}
         */
        public function setActivityExtension(ActivityExtension $activityExtension)
        {
            $this->activityExtension = $activityExtension;
        }
    }

Creating a Note in Workflows and Actions (Operations)
-----------------------------------------------------

**Class:** ``Oro\Bundle\NoteBundle\Action\CreateNoteAction``

**Alias:** create_note

**Description:** Creates an activity note with for the target entity

**Parameters:**

- message - property path to message body
- target_entity - property path where to instance of entity for adding note
- attribute - (optional) target path where created Note entity will be saved

**Configuration Example**

.. code-block:: yaml

    - '@create_note':
        message: $.comment
        target_entity: $.entity
        attribute: $.result.note

.. include:: /include/include-links-dev.rst
   :start-after: begin