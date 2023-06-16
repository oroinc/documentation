.. _entities-data-management-fixtures:

Fixtures and Demo Data
======================

Before your application contains an interface to create new tasks, you need to load them
programmatically. In OroPlatform, this can be done by creating :ref:`fixture classes <backend-entities-fixtures>` that are placed in the
``Migrations/Data/ORM`` subdirectory of your bundle and that implement the ``FixtureInterface``:

.. oro_integrity_check:: 0802978d3a512d579a8ef4ecfff5ae88635f9a0f

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadQuestions.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadQuestions.php
       :language: php
       :lines: 3-

Console Commands
----------------

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

Non-Default Object Managers and Reference Repositories in Fixtures
------------------------------------------------------------------

To create and reference entities managed by non-default object manager, extend your fixture class from  ``Oro\Bundle\TestFrameworkBundle\Test\DataFixtures\AbstractFixture``.

.. note:: The default object manager is available as the load method argument.

.. code-block:: php
    :caption: src/Oro/Bundle/ConfigBundle/Tests/Functional/DataFixtures/LoadConfigValue.php

    namespace Oro\Bundle\ConfigBundle\Tests\Functional\DataFixtures;

    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\ConfigBundle\Entity\Config;
    use Oro\Bundle\ConfigBundle\Entity\ConfigValue;
    use Oro\Bundle\TestFrameworkBundle\Test\DataFixtures\AbstractFixture;
    use Symfony\Component\Yaml\Yaml;

    class LoadConfigValue extends AbstractFixture
    {
        const FILENAME = 'config_value.yml';

        public function load(ObjectManager $manager)
        {
            $config = $this->getConfig(
                $this->getObjectManagerForClass(Config::class)
            );

            $configValueObjectManager = $this->getObjectManagerForClass(ConfigValue::class);

            foreach ($this->getConfigValuesData() as $name => $data) {
                $configValue = new ConfigValue();
                $configValue->setConfig($config)
                    ->setName($name)
                    ->setSection($data['section'])
                    ->setValue($data['value']);

                $configValueObjectManager->persist($configValue);
                $this->setReference($name, $configValue);
            }

            $configValueObjectManager->flush();
        }

        /**
         * @return array
         */
        protected function getConfigValuesData()
        {
            return Yaml::parse(file_get_contents(__DIR__.'/data/'.static::FILENAME));
        }

        /**
         * @param ObjectManager $manager
         * @return null|Config
         */
        protected function getConfig(ObjectManager $manager)
        {
            return $manager->getRepository(Config::class)->findOneBy([]);
        }
    }

.. admonition:: Business Tip

   If you've ever been wondering about the differences between B2C and |B2B e-commerce|, our guide will answer all of your possible questions.


.. include:: /include/include-links-dev.rst
    :start-after: begin

.. include:: /include/include-links-seo.rst
    :start-after: begin
