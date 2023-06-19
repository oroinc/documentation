<?php

namespace Acme\Bundle\DemoBundle\Search;

use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
use Oro\Bundle\SearchBundle\Query\Query;
use Oro\Bundle\SearchBundle\Query\SearchRepository;

/**
 * Question search repository used to extract data from standard search index.
 */
class QuestionSearchRepository extends SearchRepository
{
    public function getQuestionIdsByOrganization(Organization $organization): array
    {
        $elements = $this->createQuery()
            ->addWhere(Criteria::expr()->eq('organization_id', $organization->getId()))
            ->setMaxResults(Query::INFINITY)
            ->getResult()
            ->getElements();

        $questionIds = [];
        foreach ($elements as $element) {
            $questionIds[] = $element->getRecordId();
        }

        return $questionIds;
    }
}
