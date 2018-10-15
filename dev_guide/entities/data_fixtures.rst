How to Load Data Fixtures
=========================

Before your application contains an interface to create new tasks, you need to load them
programmatically. In OroPlatform, this can be done by creating classes that are placed in the
``Migrations/Data/ORM`` subdirectory of your bundle and that implement the ``FixtureInterface``:

.. code-block:: php
    :linenos:

    // src/AppBundle/Migrations/Data/ORM/LoadTasks.php
    namespace AppBundle\Migrations\Data\ORM;

    use AppBundle\Entity\Priority;
    use AppBundle\Entity\Task;
    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;

    class LoadTasks implements FixtureInterface
    {
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

.. code-block:: bash

    $ php bin/console oro:migration:data:load

.. tip::

    You can use the ``--dry-run`` option to first check which fixtures will be loaded:

    .. code-block:: bash

        $ php bin/console oro:migration:data:load

.. tip::

    You can create data fixtures that should only be loaded when you want to to present your
    application with some demo data. To do so place your data fixture classes in the
    ``Migrations/Data/Demo/ORM`` subdirectory of your bundle and use the ``--fixtures-type`` option
    of the ``oro:migration:data:load`` command to indicate that the demo data should be loaded:

    .. code-block:: bash

        $ php bin/console oro:migration:data:load --fixtures-type=demo
