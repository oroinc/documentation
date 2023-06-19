<?php

namespace Acme\Bundle\DemoBundle\Provider;

use Acme\Bundle\DemoBundle\Entity\Priority;
use Oro\Bundle\EntityBundle\Provider\AbstractEntityClassNameProvider;
use Oro\Bundle\EntityBundle\Provider\EntityClassNameProviderInterface;

/**
 * The default implementation of a service to get human-readable names in English of entity classes.
 */
class AcmeClassNameProvider extends AbstractEntityClassNameProvider implements EntityClassNameProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getEntityClassName(string $entityClass): ?string
    {
        // add your implementation here
        if ($entityClass !== Priority::class) {
            return null;
        }

        return "PRIORITY";
    }

    /**
     * @inheritDoc
     */
    public function getEntityClassPluralName(string $entityClass): ?string
    {
        // add your implementation here
        return $this->getName($entityClass, true);
    }
}
