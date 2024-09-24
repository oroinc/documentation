<?php

namespace Acme\Bundle\CMSBundle\Duplicator\Extension;

use Acme\Bundle\CMSBundle\Duplicator\Filter\UniqueTitleFilter;
use Acme\Bundle\CMSBundle\Duplicator\Matcher\BlockTitleMatcher;
use Acme\Bundle\CMSBundle\Entity\Block;
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
    #[\Override]
    public function getFilter(): Filter
    {
        return new UniqueTitleFilter();
    }

    #[\Override]
    public function getMatcher(): Matcher
    {
        return new BlockTitleMatcher();
    }

    #[\Override]
    public function isSupport(DraftableInterface $source): bool
    {
        return
            $this->getContext()->offsetGet('action') === DraftManager::ACTION_CREATE_DRAFT &&
            $source instanceof Block;
    }
}
