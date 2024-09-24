<?php

namespace Acme\Bundle\DemoBundle\EntityConfig;

use Oro\Bundle\EntityConfigBundle\EntityConfig\EntityConfigInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Provides validations entity config for acme_demo scope.
 */
class AcmeDemoEntityConfiguration implements EntityConfigInterface
{
    #[\Override]
    public function getSectionName(): string
    {
        return 'acme_demo';
    }

    #[\Override]
    public function configure(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->scalarNode('comment')
            ->info('`string` comment description.')
            ->defaultFalse()
            ->end()
        ;
    }
}
