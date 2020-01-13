<?php

namespace ACME\Bundle\CMSBundle\Duplicator\Matcher;

use ACME\Bundle\CMSBundle\Entity\Block;
use DeepCopy\Matcher\Matcher;

/**
 * Determines that a filter can be applied to the title property only
 */
class BlockTitleMatcher implements Matcher
{
    /**
     * @param Block $object
     * @param string $property
     *
     * @return bool
     */
    public function matches($object, $property): bool
    {
        return 'title' === $property;
    }
}
