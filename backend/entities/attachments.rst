.. _backend--entity-attachments:

Entity Attachments
==================

Configurable entities can use attachments for adding additional files to their records.

To enable attachments for an entity, an administrator should enable them in the current entity configuration.

Additionally, admin can set array with allowed mine types and maximum sizes of the attached files.

If no mime types were set, the mime types from ``Upload settings`` (system configuration) are used for validation.

Once the schema is updated, the **Add attachment** button becomes available for the current entity.

For the detailed information on the attachments that configurable entities can use, refer to the :ref:`OroAttachmentBundle <bundle-docs-platform-attachment-bundle>` topic.


.. include:: /include/include-links-dev.rst
   :start-after: begin