:oro_show_local_toc: false

.. _bundle-docs-platform-comment-bundle:

OroCommentBundle
================

OroCommentBundle adds the Comments functionality which can be used with the application entities.


Enable Comments for an Entity
-----------------------------

Usually, you do not need to provide a predefined set of associations between the comment entity and activity entities; rather, it is the administrator who chooses to do this. But it is possible to create this type of association using migrations if you need. The following example shows how you can do it:

.. code-block:: php

    ...
    class AcmeBundle implements Migration, CommentExtensionAwareInterface
    {
        protected CommentExtension $comment;

        public function setCommentExtension(CommentExtension $commentExtension)
        {
            $this->comment = $commentExtension;
        }

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            self::addComment($schema, $this->comment);
        }

        public static function addComment(Schema $schema, CommentExtension $commentExtension)
        {
            $commentExtension->addCommentAssociation($schema, 'acme_entity');
        }
    }

CommentExtension performs the association of the activity entity with comment. To get CommentExtension in migration, implement CommentExtensionAwareInterface.

Show Entity Comments in Activity List Widget
--------------------------------------------

If you created the new activity entity and want to comment on it in the activity list widget, implement CommentProviderInterface. For example:

.. code-block:: php

    class AcmeActivityListProvider implements ActivityListProviderInterface, CommentProviderInterface
    {
    ...
    /**
     * {@inheritdoc}
     */
    public function isCommentsEnabled($entityClass)
    {
        return
            $this->configManager->hasConfig($entityClass)
            && $this->configManager->getEntityConfig('comment', $entityClass)->is('enabled');
    }
    ...

The comment widget will be rendered into ```div.message .comment``` node of the js/activityItemTemplate.html.twig template.

Attachment Configuration
------------------------

MIME types of comment attachments can be configured at **System > Configuration > System Configuration > General Setup > Upload settings > File Mime Types**.

Maximum file size will be taken from **System > Entity Management > Comment > Attachment Field > File Size**.


.. include:: /include/include-links-dev.rst
   :start-after: begin
