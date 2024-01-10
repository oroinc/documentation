<?php

namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

use Acme\Bundle\DemoBundle\Entity\Favorite;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\MigrationBundle\Fixture\LoadedFixtureVersionAwareInterface;
use Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

/**
 * Load versioned favorites data.
 */
class LoadVersionedFavoriteData extends AbstractFixture implements
    VersionedFixtureInterface,
    LoadedFixtureVersionAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function getVersion(): string
    {
        return '2.0';
    }

    /**
     * {@inheritDoc}
     */
    public function setLoadedVersion($version = null): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager): void
    {
        $newFavorite = new Favorite();
        $newFavorite->setName('Last favorite');
        $newFavorite->setValue('Last favorite value');
        $newFavorite->setViewCount(18);
        $newFavorite->setOrganization($manager->getRepository(Organization::class)->getFirst());
        $manager->persist($newFavorite);
        $manager->flush();
    }
}
