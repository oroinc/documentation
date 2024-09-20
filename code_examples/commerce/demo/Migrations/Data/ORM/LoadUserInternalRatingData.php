<?php

namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\EntityExtendBundle\Entity\EnumOption;
use Oro\Bundle\EntityExtendBundle\Entity\Repository\EnumOptionRepository;
use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;
use Oro\Bundle\TranslationBundle\Migrations\Data\ORM\LoadLanguageData;

class LoadUserInternalRatingData extends AbstractFixture implements DependentFixtureInterface
{
    protected array $data = [
        '1' => true,
        '2' => false,
        '3' => false,
        '4' => false,
        '5' => false
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        /** @var EnumOptionRepository $enumRepo */
        $enumRepo = $manager->getRepository(EnumOption::class);
        $priority = 1;
        foreach ($this->data as $name => $isDefault) {
            $enumOption = $enumRepo->createEnumOption(
                'user_internal_rating',
                ExtendHelper::buildEnumInternalId($name),
                $name,
                $priority++,
                $isDefault,
            );
            $manager->persist($enumOption);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [LoadLanguageData::class];
    }
}
