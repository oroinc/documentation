.. _bundle-docs-platform-test-framework-doctrine-events:

Additional Doctrine Events
==========================

Additional doctrine events are triggered during the execution of \Oro\Bundle\TestFrameworkBundle\Test\WebTestCase.

**\Oro\Component\Testing\Doctrine\Events::ON_AFTER_TEST_TRANSACTION_ROLLBACK (onAfterTestTransactionRollback)**

This event is triggered when the transaction that provides functional test isolation is rolled back. This event is useful when you need to rollback changes made by the test fixture if the database is not the only one affected by these changes (e.g., cache)

Use the following code to subscribe to this event:

.. code-block:: php
   :linenos:

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\DBAL\Event\ConnectionEventArgs;
    use Oro\Component\Testing\Doctrine\Events;

    class LoadSomeData extends AbstractFixture
    {
        public function load(ObjectManager $manager)
        {
            // load data....

            $manager->getConnection()
                ->getEventManager()
                ->addEventListener(Events::ON_AFTER_TEST_TRANSACTION_ROLLBACK, $this);
        }

        /**
         * Will be executed when (if) this fixture will be rolled back
         */
        public function onAfterTestTransactionRollback(ConnectionEventArgs $args)
        {
            // do something (e.g. clear some caches)....
        }
    }

