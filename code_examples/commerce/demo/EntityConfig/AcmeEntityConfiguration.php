<?php

namespace Acme\Bundle\DemoBundle\EntityConfig;

use Oro\Bundle\EntityConfigBundle\EntityConfig\EntityConfigInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Provides validations entity config for acme scope.
 */
class AcmeEntityConfiguration implements EntityConfigInterface
{
    public function getSectionName(): string
    {
        return 'acme';
    }

    public function configure(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->scalarNode('demo_attr')
            ->info('`string` demo attribute description.')
            ->defaultFalse()
            ->end()
        ;
    }
}
