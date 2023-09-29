<?php

namespace Acme\Bundle\DemoBundle\Entity\Repository;

use Acme\Bundle\DemoBundle\Entity\DoctrineTypeField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository for ORM Entity DoctrineTypeField.
 *
 * @method DoctrineTypeField|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctrineTypeField|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctrineTypeField[] findAll()
 * @method DoctrineTypeField[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineTypeFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineTypeField::class);
    }
}
