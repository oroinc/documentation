.. _bundle-docs-platform-generating-image-file-urls:

Generating Image and File URLs
==============================

File URL Providers
------------------

To generate a URL for an image or a file, use  the ``oro_attachment.provider.file_url`` service backed by
a chain of classes that implement ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface`` with the following methods:

- *getFileUrl* - to get a URL for downloading the specified file.
- *getFilteredImageUrl* - to get a URL for displaying an image represented by the specified file and with an applied LiipImagine filter.
- *getResizedImageUrl* - to get a URL for displaying an image represented by the specified file and resized to the specified width and height.

.. note:: The same methods for generating URLs are provided by the ``oro_attachment.manager`` service, which is the facade with common methods required when working with files.

.. code-block:: twig


        // Generates a URL for resized image of $image with $filterName LiipImagine filter.
        $imageUrl = $this->fileUrlProvider->getFilteredImageUrl($image, $filterName);
        // Generates a URL for resized image of $image with $filterName LiipImagine filter and converted to 'webp' format.
        // Extension 'webp' will be appended to the filename.
        $webpImageUrl = $this->fileUrlProvider->getFilteredImageUrl($image, $filterName, 'webp');

.. _attachment-bundle-image-file-twig:

Image and File URLs in TWIG
---------------------------

OroAttachmentBundle provides the following TWIG functions for images and files:

- *file_url* - to get a URL for downloading the specified file. Uses ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface::getFileUrl()`` under-the-hood.
- *file_size* - to get a formatted size for the specified file.
- *resized_image_url* - to get a URL for displaying a image represented by the specified file and resized to the specified width and height. Uses ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface::getFileUrl()`` under the hood.
- *filtered_image_url* - to get a URL for displaying a image represented by the specified file and with applied LiipImagine filter. Uses ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface::getFileUrl()`` under the hood.
- *oro_attachment_icon* - to get a CSS class adding an icon for the specified file depending on its mime type.
- *oro_type_is_image* - to check if the specified file represents an image.
- *oro_file_icons_config* - to get a full list of icons CSS classes by mime types.
- *oro_file_view* - to get a rendered view of a file. Uses ``@OroAttachment/Twig/file.html.twig`` under-the-hood.
- *oro_image_view* - to get a rendered view of an image. Uses ``@OroAttachment/Twig/image.html.twig`` under-the-hood.
- *oro_resized_picture_sources* - to get a collection of sources (URLs) to the resized image represented by the specified file. Should be used in a <picture> tag.
- *oro_filtered_picture_sources* - to get a collection of sources (URLs) to the resized image represented by the specified file, with the LiipImagine filter applied. Should be used in a <picture> tag.
- *oro_file_title* - to get a title (e.g. original filename) for the specified file. Uses ``Oro\Bundle\AttachmentBundle\Provider\FileTitleProviderInterface`` under-the-hood.

See ``Oro\Bundle\AttachmentBundle\Twig\FileExtension`` for more information on functions arguments.

.. include:: /include/include-links-dev.rst
   :start-after: begin

