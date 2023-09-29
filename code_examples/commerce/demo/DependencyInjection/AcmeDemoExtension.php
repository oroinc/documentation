<?php

// DependencyInjection/AcmeDemoExtension.php
namespace Acme\Bundle\DemoBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AcmeDemoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        // register services configuration
        $loader->load('services.yml');
        // register other configurations in the same way
        $loader->load('repositories.yml');
        $loader->load('form_types.yml');
        $loader->load('controllers.yml');
        $loader->load('import_export.yml');
        $loader->load('old_rest_api.yml');
        $loader->load('controllers_api.yml');
    }
}
