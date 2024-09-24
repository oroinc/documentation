<?php

namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

use Acme\Bundle\DemoBundle\Entity\Favorite;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

/**
 * Load favorites data 1.0.
 */
class LoadFavoritesData extends AbstractFixture implements VersionedFixtureInterface
{
    #[\Override]
    public function getVersion(): string
    {
        return '1.0';
    }

    #[\Override]
    public function load(ObjectManager $manager)
    {
        $organization = $manager->getRepository(Organization::class)->getFirst();

        $newFavorite = new Favorite();
        $newFavorite->setName('First favorite');
        $newFavorite->setValue('First favorite value');
        $newFavorite->setViewCount(14);
        $newFavorite->setOrganization($organization);
        $manager->persist($newFavorite);

        $manager->flush();
    }
}
