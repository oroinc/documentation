:oro_show_local_toc: false

.. _bundle-docs-platform-comment-bundle:

OroCommentBundle
================

|OroCommentBundle| adds the Comments functionality which can be used with the application entities.


Enable Comments for an Entity
-----------------------------

Usually, you do not need to provide a predefined set of associations between the comment entity and activity entities; rather, it is the administrator who chooses to do this. But it is possible to create this type of association using migrations if you need. The following example shows how you can do it:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_5;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\CommentBundle\Migration\Extension\CommentExtensionAwareInterface;
    use Oro\Bundle\CommentBundle\Migration\Extension\CommentExtensionAwareTrait;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddCommentAssociation implements Migration, CommentExtensionAwareInterface
    {
        use CommentExtensionAwareTrait;

        /**
         * {@inheritDoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->commentExtension->addCommentAssociation($schema, 'acme_demo_entity');
        }
    }

CommentExtension performs the association of the activity entity with comment. To get CommentExtension in migration, implement CommentExtensionAwareInterface.

Show Entity Comments in Activity List Widget
--------------------------------------------

If you created the new activity entity and want to comment on it in the activity list widget, implement CommentProviderInterface. For example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Provider;

    // ...
    use Oro\Bundle\ActivityListBundle\Model\ActivityListProviderInterface;
    use Oro\Bundle\CommentBundle\Model\CommentProviderInterface;

    class SomeActivityListProvider implements ActivityListProviderInterface, CommentProviderInterface
    {
        // ...

        /**
         * @inheritDoc
         */
        public function isCommentsEnabled($entityClass)
        {
            return $this->configManager->hasConfig($entityClass)
                && $this->configManager->getEntityConfig('comment', $entityClass)->is('enabled');
        }
    }

The comment widget will be rendered into ```div.message .comment``` node of the js/activityItemTemplate.html.twig template.

Attachment Configuration
------------------------

MIME types of comment attachments can be configured at **System > Configuration > System Configuration > General Setup > Upload settings > File Mime Types**.

Maximum file size will be taken from **System > Entity Management > Comment > Attachment Field > File Size**.


.. include:: /include/include-links-dev.rst
    :start-after: begin
