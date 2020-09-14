.. _bundle-docs-platform-attachment-bundle-config:

OroAttachmentBundle Configuration
=================================

Configure Supported Mime Types
------------------------------

In the system configuration, under **General Setup > Upload Settings**, a user can configure supported mime types for files and image fields.

Each mime type should be set from a new line.

A user can set only available mime types from the configuration.

To add or remove available mime types, add changes to the ``upload_file_mime_types`` section and ``upload_image_mime_types`` in the config.yml file:

.. code-block:: yaml
       :linenos:

        oro_attachment:
            upload_file_mime_types:
                - application/msword
                - application/vnd.ms-excel
                - application/pdf
                - application/zip
                - image/gif
                - image/jpeg
                - image/png
            upload_image_mime_types:
                - image/gif
                - image/jpeg
                - image/png

.. _attachment-bundle-file-types:

File Types
----------

File types enable to upload files to any entity.

When creating a new file field type, a user should specify the maximum size of the file supported for this field. On the entity record's details page, this field is displayed as a link to download this file.

MultiFile Types
---------------

**MultiFile** field provides the ability to upload a collection of files to any entity. It supports the options of a maximum file size and a maximum number of files allowed to be added.

On the entity record's details page, this field is displayed as a grid with links to download files.

.. _attachment-bundle-image-types:

Image Types
-----------

Image file types enable to upload images to any entity.

When creating a new image field type, a user should specify the maximum size of the file supported for this field as well as its width and height to enable the thumbnail image preview.

On the entity record's details page, this field is displayed as a thumbnail image with a link to download the original image file.

It can be used with Digital Asset Management (DAM) functionality.

MultiImage Types
----------------

**MultiImage** field provides the ability to upload a collection of images to any entity. It supports the following options: a maximum file size, thumbnail width and height, a maximum number of files allowed to be added.

On the entity record's details page, this field is displayed as a grid with a thumbnail image and links to download the original image file.

It can be used with Digital Asset Management (DAM) functionality.

.. _attachment-bundle-storage:

Configure Storage
-----------------

OroAttachmentBundle uses |KnpGaufretteBundle| to provide a filesystem abstraction layer.

Based on the default configuration, it stores files in ``var/attachment directory`` of your project. A user can reconfigure these settings. You can find more information on the KnpGaufretteBundle configuration in the related |KnpGaufretteBundle documentation|.

Image thumbnail files are created from |LiipImagineBundle| and are stored in the ``public/media/cache/attachment`` directory.

ACL Protection
--------------

ACL protection provides access to files and images of the entity which they are assigned to. A user should have view permissions to a parent record to be authorized to download the attached files.

.. _attachment-bundle-migration-extension:

Use Migration Extension (Example)
---------------------------------

It is possible to create an image or a file field via migrations using AttachmentExtension. For example:

.. code-block:: php
   :linenos:

       namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_0;

       use Doctrine\DBAL\Schema\Schema;

       use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtension;
       use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtensionAwareInterface;
       use Oro\Bundle\MigrationBundle\Migration\Migration;
       use Oro\Bundle\MigrationBundle\Migration\QueryBag;

       class AcmeDemoBundle implements Migration, AttachmentExtensionAwareInterface
       {
           /** @var AttachmentExtension */
           protected $attachmentExtension;

           /**
            * {@inheritdoc}
            */
           public function setAttachmentExtension(AttachmentExtension $attachmentExtension)
           {
               $this->attachmentExtension = $attachmentExtension;
           }

           /**
            * {@inheritdoc}
            */
           public function up(Schema $schema, QueryBag $queries)
           {
               $this->attachmentExtension->addImageRelation(
                   $schema,
                   'entity_table_name', // entity table, e.g. oro_user, orocrm_contact etc.
                   'new_field_name', // field name
                   [], //additional options for relation
                   7, // max allowed file size in megabytes, can be omitted, by default 1 Mb
                   100, // thumbnail width in pixels, can be omitted, by default 32
                   100 // thumbnail height in pixels, can be omitted, by default 32
               );
           }
       }


Also, you can enable attachments for an entity, e.g.,:

.. code-block:: php
   :linenos:


       namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_0;

       use Doctrine\DBAL\Schema\Schema;
       use Oro\Bundle\MigrationBundle\Migration\Migration;
       use Oro\Bundle\MigrationBundle\Migration\QueryBag;
       use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtension;
       use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtensionAwareInterface;

       class AcmeDemoBundle implements Migration, AttachmentExtensionAwareInterface
       {
           /** @var AttachmentExtension */
           protected $attachmentExtension;

           /**
            * {@inheritdoc}
            */
           public function setAttachmentExtension(AttachmentExtension $attachmentExtension)
           {
               $this->attachmentExtension = $attachmentExtension;
           }

           /**
            * {@inheritdoc}
            */
           public function up(Schema $schema, QueryBag $queries)
           {
               $this->attachmentExtension->addAttachmentAssociation(
                   $schema,
                   'entity_table_name', // entity table, e.g. oro_user, orocrm_contact etc.
                   [], // optional, allowed MIME types of attached files, if empty - global configuration will be used
                   2 // optional, max allowed file size in megabytes, by default 1 Mb
               );
           }
       }

.. _attachment-bundle-image-formatters:

Image Formatters
----------------

A user can use 3 formatters for image type fields.

``image_encoded`` returns an image tag with embedded image content in the src attribute. Additional parameters:

- ``alt`` - a custom alt attribute for the image tag. By default, the original file name is used.

- ``height`` - a custom height attribute for the image tag. There is no default value for this attribute.

- ``width``- custom width attribute for the image tag. There is no default value for this attribute.

``image_link`` returns a link to the resized image (e.g. ``<a href='http://test.com/path/to/image.jpg'>image name</a>``). Additional parameters:

- ``title`` - a custom image text value. By default, the original file name is used.

- ``height`` - a custom image height. By default, it is 100 px.

- ``width``- a custom image width. By default, it is 100 px.

``image_src`` returns the url to the resized image (e.g., ``http://test.com/path/to/image.jpg``). Additional parameters:

- ``height`` - a custom image height. By default, it is 100 px.

- ``width``- a custom image width. By default, it is 100 px.

.. _attachment-bundle-debug-img:

Enable Debugging Images
-----------------------

By default, images are processed by the front controller (``index_dev.php``) in the dev environment. However, you can also enable your web server to process images instead of front controllers. It helps boost performance on all platforms and stability on Windows.
To disable debug images, set the ``debug_images`` option to ``false`` in the config.yml file:

.. code-block:: yaml
   :linenos:

       oro_attachment:
           debug_images: false

.. _attachment-image-processing:

Image Processing
----------------

Image Processing enables an administrator to control the quality of images using the UI, thereby reducing the size of images in storage.

Image processing uses additional libraries:

* |PNGQuant| - utility for lossy compression of PNG images.
* |JPEGOptim| - utility to optimize/compress JPEG files.

For proper work, you need the libraries whose versions correspond to the following:

* pngquant >= 2.5.0
* jpegoptim >= 1.4.0

To configure additional libraries you need to add the follwing parameters to the parameters.yml:

.. code-block:: yaml
   :linenos:

   liip_imagine.pngquant.binary: /usr/bin/pngquant
   liip_imagine.jpegoptim.binary: /usr/bin/jpegoptim

.. note::
         - Processors are external libraries, so they need to be installed separately.
         - If the configuration specifies incorrect paths to the libraries, their versions do not match, or libraries are not installed, the system will work without image processing, and these settings will not be available and will not be displayed in the system configuration.
         - If configuration is not specified explicitly, the system will try to find libraries automatically.

You can use 3 parameters for optimization images:

- ``Image Processing (toggle)`` - feature toggle, allows to enable or disable image post processing.

- ``JPEG Resize Quality (%)`` - values from 30 to 100, the higher the value, the better the image quality.

- ``PNG Resize Quality (%)`` - 'Preserve quality' and 'Minimize file size'. Indicates how much you want to reduce the image quality.

.. note:: Disabled image processing completely eliminates additional image processing, which means that libraries will not be used in processing, and image quality will be controlled only by extensions used in the system by default (as an example: GD).

.. note:: Modification of the default value may cause temporary storefront slow-down until all images are resized. Make sure that the hard drive has at least 50% space available as the resized images will be stored alongside the existing ones.

.. note:: This feature covers backward compatibility, so all existing images will not be deleted or replaced (even after migration), in which case only new images will be processed. To optimize old images, you need to delete them manually.


.. include:: /include/include-links-dev.rst
   :start-after: begin

