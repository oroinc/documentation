<?php

namespace Acme\Bundle\CMSBundle\Duplicator\Filter;

use Acme\Bundle\CMSBundle\Entity\Block;
use Oro\Component\Duplicator\Filter\Filter;

/**
 * Modifies the value of the title field
 */
class UniqueTitleFilter implements Filter
{
    /**
     * @param Block $object
     * @param string $property
     * @param callable $objectCopier
     */
    public function apply($object, $property, $objectCopier): void
    {
        $resolvedField = sprintf('%s_%s', $object->getTitle(), uniqid());
        $object->setTitle($resolvedField);
    }
}
