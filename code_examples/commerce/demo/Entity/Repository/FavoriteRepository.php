<?php

namespace Acme\Bundle\DemoBundle\Entity\Repository;

use Acme\Bundle\DemoBundle\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository for ORM Entity Favorite.
 *
 * @method Favorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorite[] findAll()
 * @method Favorite[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorite::class);
    }
}
