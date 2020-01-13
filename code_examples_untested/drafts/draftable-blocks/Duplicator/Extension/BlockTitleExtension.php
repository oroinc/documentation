<?php

namespace ACME\Bundle\CMSBundle\Duplicator\Extension;

use ACME\Bundle\CMSBundle\Duplicator\Filter\UniqueTitleFilter;
use ACME\Bundle\CMSBundle\Duplicator\Matcher\BlockTitleMatcher;
use ACME\Bundle\CMSBundle\Entity\Block;
use DeepCopy\Filter\Filter;
use DeepCopy\Matcher\Matcher;
use Oro\Bundle\DraftBundle\Duplicator\Extension\AbstractDuplicatorExtension;
use Oro\Bundle\DraftBundle\Entity\DraftableInterface;
use Oro\Bundle\DraftBundle\Manager\DraftManager;

/**
 * Responsible for copying behavior of Block type parameter.
 */
class BlockTitleExtension extends AbstractDuplicatorExtension
{
    /**
     * @return Filter
     */
    public function getFilter(): Filter
    {
        return new UniqueTitleFilter();
    }

    /**
     * @return Matcher
     */
    public function getMatcher(): Matcher
    {
        return new BlockTitleMatcher();
    }

    /**
     * @param DraftableInterface $source
     *
     * @return bool
     */
    public function isSupport(DraftableInterface $source): bool
    {
        return
            $this->getContext()->offsetGet('action') === DraftManager::ACTION_CREATE_DRAFT &&
            $source instanceof Block;
    }
}
