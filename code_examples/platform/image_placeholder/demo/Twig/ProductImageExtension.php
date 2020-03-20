<?php

// Twig/ProductImageExtension.php
namespace ACME\Bundle\DemoBundle\Twig;

use Oro\Bundle\AttachmentBundle\Entity\File;
use Oro\Bundle\AttachmentBundle\Manager\AttachmentManager;
use Oro\Bundle\LayoutBundle\Provider\Image\ImagePlaceholderProviderInterface;
use Oro\Bundle\ProductBundle\Helper\ProductImageHelper;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Provides Twig functions to get image placeholder and type images for a product entity:
 *   - product_filtered_image
 *   - product_image_placeholder
 */
class ProductImageExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    const NAME = 'acme_product_image';

    /** @var ContainerInterface */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('product_filtered_image', [$this, 'getProductFilteredImage']),
            new TwigFunction('product_image_placeholder', [$this, 'getProductImagePlaceholder'])
        ];
    }

    /**
     * @param File|null $file
     * @param string $filter
     * @return string
     */
    public function getProductFilteredImage(?File $file, string $filter): string
    {
        if ($file) {
            $attachmentManager = $this->container->get('oro_attachment.manager');

            return $attachmentManager->getFilteredImageUrl($file, $filter);
        }

        return $this->getProductImagePlaceholder($filter);
    }

    /**
     * @param string $filter
     * @return string
     */
    public function getProductImagePlaceholder(string $filter): string
    {
        $imagePlaceholderProvider = $this->container->get('oro_product.provider.product_image_placeholder');

        return $imagePlaceholderProvider->getPath($filter);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices()
    {
        return [
            'oro_attachment.manager' => AttachmentManager::class,
            'oro_product.provider.product_image_placeholder' => ImagePlaceholderProviderInterface::class,
            'oro_product.helper.product_image_helper' => ProductImageHelper::class,
        ];
    }
}
