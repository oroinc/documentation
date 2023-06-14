<?php

namespace Acme\Bundle\DemoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeExtendValidationPass implements CompilerPassInterface
{
    private const INTEGER_CONSTRAINT = [
        'Regex' => [
            'pattern' => '/^(-?[1-9]\d*|0)$/',
            'message' => 'This value should contain only numbers!'
        ]
    ];

    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('oro_entity_extend.validation_loader')) {
            return;
        }

        $definition = $container->findDefinition('oro_entity_extend.validation_loader');
        $definition->addMethodCall(
            'addConstraints',
            ['integer', [self::INTEGER_CONSTRAINT]]
        );
    }
}
