<?php

namespace Acme\Bundle\DemoBundle\Entity\Repository;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository for ORM Entity Sms.
 *
 * @method Sms|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sms|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sms[] findAll()
 * @method Sms[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sms::class);
    }
}
