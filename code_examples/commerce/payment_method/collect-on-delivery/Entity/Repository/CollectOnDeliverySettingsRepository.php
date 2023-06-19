<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\Entity\Repository;

use Acme\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Doctrine\ORM\EntityRepository;

/**
 * Repository for CollectOnDeliverySettings entity
 */
class CollectOnDeliverySettingsRepository extends EntityRepository
{
    /**
     * @return CollectOnDeliverySettings[]
     */
    public function getEnabledSettings()
    {
        return $this->createQueryBuilder('settings')
            ->innerJoin('settings.channel', 'channel')
            ->andWhere('channel.enabled = true')
            ->getQuery()
            ->getResult();
    }
}
