<?php

namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

use Acme\Bundle\DemoBundle\Entity\Priority;
use Acme\Bundle\DemoBundle\Entity\Question;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

/**
 * Load Question data fixture.
 */
class LoadQuestions implements FixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $organization = $manager->getRepository(Organization::class)->getFirst();

        $majorPriority = new Priority();
        $majorPriority->setLabel('major');
        $majorPriority->setOrganization($organization);
        $manager->persist($majorPriority);

        $importantTask = new Question();
        $importantTask->setSubject('Important task');
        $importantTask->setDescription('This is an important task');
        $importantTask->setDueDate(new \DateTime('+1 week'));
        $importantTask->setPriority($majorPriority);
        $importantTask->setOrganization($organization);
        $manager->persist($importantTask);

        $minorPriority = new Priority();
        $minorPriority->setLabel('minor');
        $minorPriority->setOrganization($organization);
        $manager->persist($minorPriority);

        $unimportantTask = new Question();
        $unimportantTask->setSubject('Unimportant task');
        $unimportantTask->setDescription('This is a not so important task');
        $unimportantTask->setDueDate(new \DateTime('+2 weeks'));
        $unimportantTask->setPriority($minorPriority);
        $unimportantTask->setOrganization($organization);
        $manager->persist($unimportantTask);

        $manager->flush();
    }
}
