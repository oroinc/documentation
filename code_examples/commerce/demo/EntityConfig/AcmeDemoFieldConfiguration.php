<?php

namespace Acme\Bundle\DemoBundle\EntityConfig;

use Oro\Bundle\EntityConfigBundle\EntityConfig\FieldConfigInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Provides validations field config for acme_demo scope.
 */
class AcmeDemoFieldConfiguration implements FieldConfigInterface
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
            ->node('auditable', 'normalized_boolean')
            ->info('`boolean` enables the “auditable” functionality.')
            ->defaultFalse()
            ->end()
        ;
    }
}
