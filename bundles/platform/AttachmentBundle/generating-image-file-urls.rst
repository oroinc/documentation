.. _bundle-docs-platform-generating-image-file-urls:

Generating Image and File URLs
==============================

File URL Providers
------------------

To generate a URL for an image or a file, use the ``oro_attachment.provider.file_url`` service backed by
a chain of classes that implement ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface`` with the following methods:

- *getFileUrl* - to get a URL for downloading the specified file.
- *getFilteredImageUrl* - to get a URL for displaying an image represented by the specified file and with an applied LiipImagine filter.
- *getResizedImageUrl* - to get a URL for displaying an image represented by the specified file and resized to the specified width and height.

.. note:: The same methods for generating URLs are provided by the ``oro_attachment.manager`` service, which is the facade with common methods required when working with files.

.. code-block:: php

        // Generates a URL for resized image of $image with $filterName LiipImagine filter.
        $imageUrl = $this->fileUrlProvider->getFilteredImageUrl($image, $filterName);
        // Generates a URL for resized image of $image with $filterName LiipImagine filter and converted to 'webp' format.
        // Extension 'webp' will be appended to the filename.
        $webpImageUrl = $this->fileUrlProvider->getFilteredImageUrl($image, $filterName, 'webp');

.. _attachment-bundle-custom-url-provider:

Custom URL Provider
-------------------

In order to hook into the logic of generating a URL for a file or image, |decorate service| ``oro_attachment.provider.file_url`` with a class that implements the ``Oro\Bundle\AttachmentBundle\Provider\FileUrlProviderInterface`` interface. For example:

.. code-block:: php
   :caption: src/Acme/Bundle/AppBundle/CustomUrlProvider.php

        class CustomUrlProvider implements FileUrlProviderInterface
        {
            private FileUrlProviderInterface $innerFileUrlProvider;

            public function __construct(FileUrlProviderInterface $innerFileUrlProvider)
            {
                $this->innerFileUrlProvider = $innerFileUrlProvider;
            }

            public function getFileUrl(File $file, string $action = self::FILE_ACTION_GET, int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
            {
                return 'custom url here';
            }

            public function getResizedImageUrl(File $file, int $width, int $height, string $format = '', int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
            {
                return 'custom url here';
            }

            public function getFilteredImageUrl(File $file, string $filterName, string $format = '', int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
            {
                if (/* custom condition here */) {
                    /* custom logic here */
                    return 'http://example.org/my-custom-url.png';
                }

                // Pass the control to the decorated class if the custom condition is not satisfied.
                return $this->innerFileUrlProvider->getFilteredImageUrl($file, $filterName, $format, $referenceType);
            }
        }

.. code-block:: yaml
   :caption: src/Acme/Bundle/AppBundle/Resources/config/services.yml

        services:
            acme.custom_file_url_provider:
                class: Acme\Bundle\AppBundle\CustomFileUrlProvider
                decorates: oro_attachment.provider.file_url
                arguments:
                    - '@.inner'

.. _attachment-bundle-custom-filename-provider:

Custom Filename Provider
------------------------

To hook into the logic of generating a filename for a file or image, |decorate service| ``oro_attachment.provider.file_name``
with a class that implements the ``Oro\Bundle\AttachmentBundle\Provider\FileNameProviderInterface`` interface. For example:

.. code-block:: php
   :caption: src/Acme/Bundle/AppBundle/CustomUrlProvider.php

        use Oro\Bundle\AttachmentBundle\Entity\File;
        use Oro\Bundle\AttachmentBundle\Provider\FileNameProviderInterface;
        use Oro\Bundle\AttachmentBundle\Tools\FilenameExtensionHelper;
        use Oro\Bundle\AttachmentBundle\Tools\FilenameSanitizer;
        use Oro\Bundle\CatalogBundle\Entity\Category;
        use Oro\Bundle\CatalogBundle\Entity\Repository\CategoryRepository;
        use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
        use Oro\Bundle\ProductBundle\Entity\Brand;
        use Oro\Bundle\ProductBundle\Entity\Product;
        use Oro\Bundle\ProductBundle\Entity\ProductImage;

        /**
         * Uses a sanitized filename including the product name, brand name and category name for Product Images.
         */
        class CustomFileNameProvider implements FileNameProviderInterface
        {
            private const SEPARATOR = '-';

            private FileNameProviderInterface $innerProvider;

            private DoctrineHelper $doctrineHelper;

            public function __construct(
                FileNameProviderInterface $innerProvider,
                DoctrineHelper $doctrineHelper
            ) {
                $this->innerProvider = $innerProvider;
                $this->doctrineHelper = $doctrineHelper;
            }

            public function getFileName(File $file): string
            {
                if (!$this->isApplicable($file)) {
                    return $this->innerProvider->getFileName($file);
                }

                return $this->getNameWithFormat($file);
            }

            public function getFilteredImageName(File $file, string $filterName, string $format = ''): string
            {
                if (!$this->isApplicable($file)) {
                    return $this->innerProvider->getFilteredImageName($file, $filterName, $format);
                }

                return $this->getNameWithFormat($file, $format);
            }

            public function getResizedImageName(File $file, int $width, int $height, string $format = ''): string
            {
                if (!$this->isApplicable($file)) {
                    return $this->innerProvider->getResizedImageName($file, $width, $height, $format);
                }

                return $this->getNameWithFormat($file, $format);
            }

            private function getNameWithFormat(File $file, string $format = ''): string
            {
                $extension = $file->getExtension() ?? pathinfo($file->getFilename(), PATHINFO_EXTENSION);
                $filename = str_replace(
                    '.' . $extension,
                    '',
                    $file->getFilename()
                );

                $parentEntity = $this->getParentEntity($file);
                if ($parentEntity instanceof ProductImage) {
                    $product = $parentEntity->getProduct();

                    $brandName = $this->getBrandName($product);
                    if ($brandName) {
                        $filename .= self::SEPARATOR . $brandName;
                    }

                    $categoryTitle = $this->getCategoryTitle($product);
                    if ($categoryTitle) {
                        $filename .= self::SEPARATOR . $categoryTitle;
                    }

                    $filename .= self::SEPARATOR . $product->getDefaultName();
                }

                $filename .= '.' . $extension;
                $filename = FilenameExtensionHelper::addExtension($filename, $format);

                return FilenameSanitizer::sanitizeFilename($filename);
            }

            /**
             * Provider is applicable for files uploaded as Product Images.
             */
            private function isApplicable(File $file): bool
            {
                return $file->getParentEntityClass() === ProductImage::class
                    && $file->getOriginalFilename();
            }

            private function getParentEntity(File $file): ?ProductImage
            {
                $parentEntityClass = $file->getParentEntityClass();
                if (!$parentEntityClass) {
                    return null;
                }

                $parentEntityId = $file->getParentEntityId();
                if (!$parentEntityId) {
                    return null;
                }

                return $this->doctrineHelper->getEntity($parentEntityClass, $parentEntityId);
            }

            private function getCategoryTitle(Product $product): ?string
            {
                /** @var CategoryRepository $repository */
                $repository = $this->doctrineHelper->getEntityRepository('OroCatalogBundle:Category');
                $category = $repository->findOneByProduct($product);

                if ($category instanceof Category) {
                    return $category->getDenormalizedDefaultTitle();
                }

                return null;
            }

            private function getBrandName(Product $product): ?string
            {
                $brand = $product->getBrand();
                if ($brand instanceof Brand) {
                    return $brand->getDefaultName();
                }

                return null;
            }
        }

.. code-block:: yaml
   :caption: src/Acme/Bundle/AppBundle/Resources/config/services.yml

        services:
            acme.provider.custom_filename_provider:
                class: Acme\Bundle\AppBundle\Provider\CustomFileNameProvider
                decorates: oro_attachment.provider.file_name
                decoration_priority: -200
                arguments:
                    - '@.inner'
                    - '@oro_entity.doctrine_helper'

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

