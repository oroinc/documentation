<?php

namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

use Acme\Bundle\DemoBundle\Entity\Favorite;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\MigrationBundle\Fixture\RenamedFixtureInterface;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

/**
 * Load renamed favorites data.
 */
class LoadRenamedFavoritesData extends AbstractFixture implements RenamedFixtureInterface
{
    #[\Override]
    public function load(ObjectManager $manager)
    {
        $organization = $manager->getRepository(Organization::class)->getFirst();

        $newFavorite = new Favorite();
        $newFavorite->setName('Second favorite');
        $newFavorite->setValue('Second favorite value');
        $newFavorite->setViewCount(5);
        $newFavorite->setOrganization($organization);
        $manager->persist($newFavorite);

        $manager->flush();
    }

    #[\Override]
    public function getPreviousClassNames(): array
    {
        return [
            'Acme\Bundle\DemoBundle\Migrations\Data\ORM\LoadFavoritesData'
        ];
    }
}
