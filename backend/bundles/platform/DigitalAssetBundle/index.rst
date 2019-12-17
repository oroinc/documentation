:oro_show_local_toc: false

.. _bundle-docs-platform-dam:

OroDigitalAssetBundle
=====================

OroDigitalAssetBundle bundle provides the Digital Asset Management (DAM) functionality and CRUD for digital assets. It can be enabled for fields of type File and Image both in the back-office UI via the entity management, and via the field configuration.

The following example is an illustration of how to enable DAM for the Image field type:

.. code-block:: php
   :linenos:

    $this->attachmentExtension->addImageRelation(
        $schema,
        'oro_table_name',
        'image',
        [
            'attachment' => [
                 'use_dam' => true,
            ]
         ],
         10
    );

Related Articles
----------------

* :ref:`Digital Asset Management <digital-assets>`
* :ref:`Use DAM in Entity Manager for File and Image Field Types <admin-guide-create-entity-fields-type-related>`