<?php

// DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
namespace ACME\Bundle\DemoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * The ImagePlaceholderProviderPass compiler pass class.
 */
class ImagePlaceholderProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('oro_product.provider.product_image_placeholder')) {
            return;
        }

        // ...
        $definition = $container->getDefinition('oro_product.provider.product_image_placeholder');
        $definition->setMethodCalls(array_merge(
            [['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.config')]]],
            [['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.theme')]]],
            [['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.default')]]],
            $definition->getMethodCalls()
        ));
    }
}
