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
class LoadVersionedFavoriteData extends AbstractFixture implements VersionedFixtureInterface, LoadedFixtureVersionAwareInterface
{
    protected string|null $currentDBVersion = null;

    /**
     * {@inheritdoc}
     */
    public function setLoadedVersion($version = null)
    {
        $this->currentDBVersion = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return '2.0';
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $organization = $manager->getRepository(Organization::class)->getFirst();

        $newFavorite = new Favorite();
        $newFavorite->setName('Last favorite');
        $newFavorite->setValue('Last favorite value');
        $newFavorite->setViewCount(18);
        $newFavorite->setOrganization($organization);
        $manager->persist($newFavorite);

        $manager->flush();
    }
}
