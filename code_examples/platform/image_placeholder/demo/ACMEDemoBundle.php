<?php

// ACMEDemoBundle.php
namespace ACME\Bundle\DemoBundle;

use ACME\Bundle\DemoBundle\DependencyInjection\Compiler\ImagePlaceholderProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The ACMEDemoBundle bundle class.
 */
class ACMEDemoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ImagePlaceholderProviderPass());
    }
}
