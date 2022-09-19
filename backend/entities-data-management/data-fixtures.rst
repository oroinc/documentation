.. _entities-data-management-fixtures:

Fixtures and Demo Data
======================

Before your application contains an interface to create new tasks, you need to load them
programmatically. In OroPlatform, this can be done by creating :ref:`fixture classes <backend-entities-fixtures>` that are placed in the
``Migrations/Data/ORM`` subdirectory of your bundle and that implement the ``FixtureInterface``:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadTasks.php

    namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

    use Acme\Bundle\DemoBundle\Entity\Priority;
    use Acme\Bundle\DemoBundle\Entity\Task;
    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Persistence\ObjectManager;

    class LoadTasks implements FixtureInterface
    {
        /**
         * @inheritDoc
         */
        public function load(ObjectManager $manager)
        {
            $majorPriority = new Priority();
            $majorPriority->setLabel('major');
            $manager->persist($majorPriority);

            $importantTask = new Task();
            $importantTask->setSubject('Important task');
            $importantTask->setDescription('This is an important task');
            $importantTask->setDueDate(new \DateTime('+1 week'));
            $importantTask->setPriority($majorPriority);
            $manager->persist($importantTask);

            $minorPriority = new Priority();
            $minorPriority->setLabel('minor');
            $manager->persist($minorPriority);

            $unimportantTask = new Task();
            $unimportantTask->setSubject('Unimportant task');
            $unimportantTask->setDescription('This is a not so important task');
            $unimportantTask->setDueDate(new \DateTime('+2 weeks'));
            $unimportantTask->setPriority($minorPriority);
            $manager->persist($unimportantTask);

            $manager->flush();
        }
    }

Use the ``oro:migration:data:load`` command to load all fixtures that have not been loaded yet:

.. code-block:: none

    php bin/console oro:migration:data:load

The fixtures type ("main", or "demo") can be specified with the ``--fixtures-type=<type>`` option. For example, you can create data fixtures that should only be loaded when you want to to present your application with some demo data. To do so place your data fixture classes in the ``Migrations/Data/Demo/ORM`` subdirectory of your bundle and use the ``--fixtures-type`` option of the ``oro:migration:data:load`` command to indicate that the demo data should be loaded:

.. code-block:: none

    php bin/console oro:migration:data:load --fixtures-type=demo

The ``--dry-run`` option can be used to print the list of fixtures without applying them:

.. code-block:: none

    php bin/console oro:migration:data:load --dry-run

The ``--bundles`` option can be used to load the fixtures only from the specified bundles:

.. code-block:: none

    php bin/console oro:migration:data:load --bundles=<BundleOne> --bundles=<BundleTwo> --bundles=<BundleThree>

The ``--exclude`` option will skip loading fixtures from the specified bundles:

.. code-block:: none

    php bin/console oro:migration:data:load --exclude=<BundleOne> --exclude=<BundleTwo> --exclude=<BundleThree>


.. include:: /include/include-links-dev.rst
    :start-after: begin
