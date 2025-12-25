<?php

// Twig/ProductImageExtension.php

namespace Acme\Bundle\DemoBundle\Twig;

use Oro\Bundle\AttachmentBundle\Entity\File;
use Oro\Bundle\AttachmentBundle\Manager\AttachmentManager;
use Oro\Bundle\LayoutBundle\Provider\Image\ImagePlaceholderProviderInterface;
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
    private ContainerInterface $container;

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

    public function getProductFilteredImage(?File $file, string $filter): string
    {
        if ($file) {
            return $this->getAttachmentManager()->getFilteredImageUrl($file, $filter);
        }

        return $this->getProductImagePlaceholder($filter);
    }

    public function getProductImagePlaceholder(string $filter): string
    {
        return $this->getImagePlaceholderProvider()->getPath($filter);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices(): array
    {
        return [
            AttachmentManager::class,
            'oro_product.provider.product_image_placeholder' => ImagePlaceholderProviderInterface::class,
        ];
    }

    private function getAttachmentManager(): AttachmentManager
    {
        return $this->container->get(AttachmentManager::class);
    }

    private function getImagePlaceholderProvider(): ImagePlaceholderProviderInterface
    {
        return $this->container->get('oro_product.provider.product_image_placeholder');
    }
}
