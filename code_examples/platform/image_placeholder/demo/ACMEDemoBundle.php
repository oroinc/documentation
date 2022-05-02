<?php

// ACMEDemoBundle.php
namespace ACME\Bundle\DemoBundle;

use ACME\Bundle\DemoBundle\DependencyInjection\Compiler\ImagePlaceholderProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ACMEDemoBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new ImagePlaceholderProviderPass());
    }
}
