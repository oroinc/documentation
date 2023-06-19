<?php

namespace Acme\Bundle\DemoBundle\Search;

use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
use Oro\Bundle\SearchBundle\Query\SearchQueryInterface;
use Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository;

/**
 * Priority website search repository.
 */
class PriorityRepository extends WebsiteSearchRepository
{
    public function getFilterSkuQuery(array $labels): SearchQueryInterface
    {
        $searchQuery = $this->createQuery();
        // Convert to lowercase for insensitive search
        $lowercaseLabels = array_map("strtolower", $labels);

        $searchQuery
            ->addSelect('label')
            ->addWhere(Criteria::expr()->in('label', $lowercaseLabels));

        return $searchQuery;
    }
}
