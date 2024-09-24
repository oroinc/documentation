<?php

namespace Acme\Bundle\DemoBundle\AccessRule;

use Oro\Bundle\SecurityBundle\AccessRule\AccessRuleInterface;
use Oro\Bundle\SecurityBundle\AccessRule\Criteria;
use Oro\Bundle\SecurityBundle\AccessRule\Expr\Comparison;
use Oro\Bundle\SecurityBundle\AccessRule\Expr\Path;

/**
 * Favorite access rule.
 */
class FavoriteAccessRule implements AccessRuleInterface
{
    #[\Override]
    public function isApplicable(Criteria $criteria): bool
    {
        return true;
    }

    #[\Override]
    public function process(Criteria $criteria): void
    {
        $criteria->andExpression(new Comparison(new Path('viewCount'), Comparison::GTE, 6));
    }
}
