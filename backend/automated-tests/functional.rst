.. _functional-tests:

Functional Testing with PHPUnit
===============================

Functional tests check the integration of the different layers of an application.

In this article, you will learn how you can improve the experience of writing functional tests with OroPlatform. We recommend that you read the Symfony |documentation concerning testing|  before you continue. You should also be familiar with |PHPUnit|.

When to Write Functional Tests
------------------------------

Functional tests are generally written for:

* Controllers
* Commands
* Repositories
* Other services

The goal of functional tests is not to test separate classes (unit tests), ut to test the integration of the different parts of an application.

Add functional tests to supplement unit tests for the following reasons:

* You can test the multi-component system and ensure it works as a whole.
* You can skip mocking the complicated interface or data manipulation layer (like doctrine classes to build a query).
* Unit tests can pass even when functionality works incorrectly.

Test Environment
----------------

Initialization Client and Loading Fixtures Caveats
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To improve the performance of test execution, the initialization of a client is only done once per test case by default. This means that the kernel of the Symfony application will be booted once per test case. Fixtures are also loaded only once per test case by default. On the one hand, initializing and loading fixtures once per test case increases the performance of test execution, but it can also cause bugs because the state of fixtures and the kernel (and, as a result, the service container) will be shared by default between test methods of separate test cases. Be sure to reset this state if necessary.

Test Environment Setup
^^^^^^^^^^^^^^^^^^^^^^

You need to configure the following parameters for the testing environment:

1. Create a separate database for tests (e.g., add '_test' suffix):
2. Set up host, port, and authentication parameters for the database and the mail server in the .env-app.test.local file:

   For example:

   .. code-block:: bash
      :caption: .env-app.test.local

       ORO_DB_DSN=postgresql://root@127.0.0.1/crm_test
       ORO_MAILER_DSN=smtp://127.0.0.1

3. Install the application in the test environment:

   .. code-block:: none

       $ php bin/console oro:install --env=test

   .. note::

       When the following options are not provided, they are set up automatically for the ``test`` environment:
           * --user-name=admin
           * --user-email=admin\@example.com
           * --user-firstname=John
           * --user-lastname=Doe
           * --user-password=admin
           * --sample-data=n
           * --organization-name=OroInc
           * --application-url=http://localhost/
           * --language=en
           * --formatting-code=en_US
           * --skip-translations
           * --no-interaction
           * --timeout=600

   The database structure is set up during installation, and standard fixtures are loaded.

   .. hint:: See the :ref:`oro:install <bundle-docs-platform-installer-bundle-oro-install-command>` command reference for more information.

4. Run tests using phpunit with an appropriate --testsuite option (unit or functional).

   .. caution:: Currently, running different automated tests together is not supported. Therefore, it is strongly not recommended to run unit and functional tests side by side in one run, as this produces errors. Unit tests create mock objects that later interfere with functional test execution and create unnecessary ambiguity. It is possible to disable unit tests on test startup with the help of the test suite option:

   .. code-block:: none

         $ php bin/phpunit -c ./ --testsuite=functional

   .. code-block:: none

         $ php bin/phpunit -c ./ --testsuite=unit

Database Isolation
^^^^^^^^^^^^^^^^^^

The ``@dbIsolationPerTest`` annotation adds a transaction that will be performed before a test starts and is rolled back when a test ends.

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbIsolationPerTest
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }


Loading Data Fixtures
^^^^^^^^^^^^^^^^^^^^^

Use the ``Oro\Bundle\TestFrameworkBundle\Test\WebTestCase::loadFixtures`` method to load a fixture in a test:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient(); // must be called before!

            // loading fixtures will be executed once, use the second parameter
            // $force = true to force the loading
            $this->loadFixtures([
                'Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadFooData',
                '@OroFooBarBundle/Tests/Functional/DataFixtures/bar_data.yml',
            ]);
        }

        // ...
    }

A fixture must be either a class name that implements ``Doctrine\Common\DataFixtures\FixtureInterface`` or a path to the |nelmio/alice| file.

An example of a fixture:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBarBundle/Tests/Functional/DataFixtures/LoadFooData.php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\FooBarBundle\Entity\FooEntity;

    class LoadFooData extends AbstractFixture
    {
        public function load(ObjectManager $manager)
        {
            $entity = new FooEntity();
            $manager->persist($entity);
            $manager->flush();
        }
    }

.. code-block:: yaml
   :caption: src/Oro/Bundle/FooBarBundle/Tests/Functional/DataFixtures/bar_data.yml

        Oro\Bundle\FooBarBundle\Entity\BarEntity:
            bar:
                name: test

You can also implement the ``Doctrine\Common\DataFixtures\DependentFixtureInterface`` which enables you to load fixtures depending on other loaded fixtures:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBarBundle/Tests/Functional/DataFixtures/LoadFooData.php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;

    class LoadFooData extends AbstractFixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            // load fixtures
        }

        public function getDependencies()
        {
            return ['Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBarData'];
        }
    }

Further, you can use reference-specific entities from fixtures, e.g.:

.. code-block:: php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Common\DataFixtures\AbstractFixture;

    use Oro\Bundle\FooBarBundle\Entity\FooEntity;

    class LoadFooData extends AbstractFixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            $entity = new FooEntity();
            $manager->persist($entity);
            $manager->flush();

            $this->addReference('my_entity', $entity);
        }

        public function getDependencies()
        {
            return ['Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBarData'];
        }
    }

Now, you can reference the fixture by the configured name in your test:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected $entity;

        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures('Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadFooData');
            $this->entity = $this->getReference('my_entity');
        }

        // ...
    }

.. hint::

    By default, the entity manager is cleared after loading each fixture. To prevent clearing a fixture can implement ``Oro\Bundle\TestFrameworkBundle\Test\DataFixtures\InitialFixtureInterface``.

.. hint::

    Sometimes you need a reference for an admin organization, a user, or a business unit. You can use the following fixtures to load them:

    - ``Oro\Bundle\TestFrameworkBundle\Tests\Functional\DataFixtures\LoadOrganization``
    - ``Oro\Bundle\TestFrameworkBundle\Tests\Functional\DataFixtures\LoadUser``
    - ``Oro\Bundle\TestFrameworkBundle\Tests\Functional\DataFixtures\LoadBusinessUnit``

Writing Functional Tests
------------------------

To create a functional test case:

1. Extend the ``Oro\Bundle\TestFrameworkBundle\Test\WebTestCase`` class
2. Prepare the test client (an instance of the ``Oro\Bundle\TestFrameworkBundle\Test\Client`` class)
3. Prepare fixtures (optional)
4. Prepare container (optional)
5. Call test functionality
6. Verify the result

Functional Tests for Controllers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Control Flow
~~~~~~~~~~~~~~~~

A functional test for a controller consists of a couple of steps:

1. Make a request
#. Test the response
#. Click on a link or submit a form
#. Test the response
#. Rinse and repeat

Prepare Client Examples
-----------------------

Simple initialization works for testing commands and services when authentication is not required.

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient(); // initialization occurres only once per test class
            // now varialbe $this->client is available
        }
        // ...
    }

Initialization with custom AppKernel options:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            // first array is Kernel options
            $this->initClient(['debug' => false]);
        }
        // ...
    }

Initialization with authentication:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            // second array is service options
            // this example will create client with server options ['PHP_AUTH_USER' => 'admin@example.com', 'PHP_AUTH_PW' => 'admin']
            // make sure you loaded fixture with test user
            // bin/console doctrine:fixture:load --no-debug --append --no-interaction --env=test --fixtures src/Oro/src/Oro/Bundle/TestFrameworkBundle/Fixtures
            $this->initClient([], $this->generateBasicAuthHeader());

            // init client with custom username and password
            $this->initClient([], $this->generateBasicAuthHeader('custom_username', 'custom_password'));
        }
        // ...
    }

Types of Functional Tests
-------------------------

Testing Controllers
^^^^^^^^^^^^^^^^^^^

Have a look at an example of a controller test from OroCRM:

.. code-block:: php
   :caption: src/OroCRM/Bundle/TaskBundle/Tests/Functional/Controller/TaskControllersTest.php

    namespace Oro\Bundle\TaskBundle\Tests\Functional\Controller;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @outputBuffering enabled
     */
    class TaskControllersTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient([], $this->generateBasicAuthHeader());
        }

        public function testCreate()
        {
            $crawler = $this->client->request('GET', $this->getUrl('orocrm_task_create'));

            $form = $crawler->selectButton('Save and Close')->form();
            $form['orocrm_task[subject]'] = 'New task';
            $form['orocrm_task[description]'] = 'New description';
            $form['orocrm_task[dueDate]'] = '2014-03-04T20:00:00+0000';
            $form['orocrm_task[owner]'] = '1';
            $form['orocrm_task[reporter]'] = '1';

            $this->client->followRedirects(true);
            $crawler = $this->client->submit($form);
            $result = $this->client->getResponse();
            $this->assertHtmlResponseStatusCodeEquals($result, 200);
            $this->assertContains('Task saved', $crawler->html());
        }

        /**
         * @depends testCreate
         */
        public function testUpdate()
        {
            $response = $this->client->requestGrid(
                'tasks-grid',
                ['tasks-grid[_filter][reporterName][value]' => 'John Doe']
            );

            $result = $this->getJsonResponseContent($response, 200);
            $result = reset($result['data']);

            $crawler = $this->client->request(
                'GET',
                $this->getUrl('orocrm_task_update', ['id' => $result['id']])
            );

            $form = $crawler->selectButton('Save and Close')->form();
            $form['orocrm_task[subject]'] = 'Task updated';
            $form['orocrm_task[description]'] = 'Description updated';

            $this->client->followRedirects(true);
            $crawler = $this->client->submit($form);
            $result = $this->client->getResponse();

            $this->assertHtmlResponseStatusCodeEquals($result, 200);
            $this->assertContains('Task saved', $crawler->html());
        }

        /**
         * @depends testUpdate
         */
        public function testView()
        {
            $response = $this->client->requestGrid(
                'tasks-grid',
                ['tasks-grid[_filter][reporterName][value]' => 'John Doe']
            );

            $result = $this->getJsonResponseContent($response, 200);
            $result = reset($result['data']);

            $this->client->request(
                'GET',
                $this->getUrl('orocrm_task_view', ['id' => $result['id']])
            );
            $result = $this->client->getResponse();

            $this->assertHtmlResponseStatusCodeEquals($result, 200);
            $this->assertContains('Task updated - Tasks - Activities', $result->getContent());
        }

        /**
         * @depends testUpdate
         */
        public function testIndex()
        {
            $this->client->request('GET', $this->getUrl('orocrm_task_index'));
            $result = $this->client->getResponse();
            $this->assertHtmlResponseStatusCodeEquals($result, 200);
            $this->assertContains('Task updated', $result->getContent());
        }
    }

Testing ACLs in a Controller
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In this example, a user without sufficient permissions is trying to access a controller action. The ``Oro\Bundle\TestFrameworkBundle\Test\WebTestCase::assertHtmlResponseStatusCodeEquals`` method is used to ensure that access to the requested resource is denied for the user:

.. code-block:: php
   :caption: src/Oro/Bundle/UserBundle/Tests/Functional/UsersTest

    namespace Oro\Bundle\UserBundle\Tests\Functional;

    use Oro\Bundle\UserBundle\Tests\Functional\DataFixtures\LoadUserData;
    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @outputBuffering enabled
     */
    class UsersTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures(['Oro\Bundle\UserBundle\Tests\Functional\API\DataFixtures\LoadUserData']);
        }

        public function testUsersIndex()
        {
            $this->client->request(
                'GET',
                $this->getUrl('oro_user_index'),
                [],
                [],
                $this->generateBasicAuthHeader(LoadUserData::USER_NAME, LoadUserData::USER_PASSWORD)
            );
            $result = $this->client->getResponse();
            $this->assertHtmlResponseStatusCodeEquals($result, 403);
        }

        public function testGetUsersAPI()
        {
            $this->client->request(
                'GET',
                $this->getUrl('oro_api_get_users'),
                ['limit' => 100],
                [],
                $this->generateWsseAuthHeader(LoadUserData::USER_NAME, LoadUserData::USER_API_KEY)
            );
            $result = $this->client->getResponse();
            $this->assertJsonResponseStatusCodeEquals($result, 403);
        }
    }

Here is an example of a fixture that adds a user without permissions:

.. code-block:: php
   :caption: src/Oro/Bundle/UserBundle/Tests/Functional/DataFixtures/LoadUserData.php

    namespace Oro\Bundle\UserBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;

    use Symfony\Component\DependencyInjection\ContainerAwareInterface;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    use Oro\Bundle\UserBundle\Entity\Role;
    use Oro\Bundle\UserBundle\Entity\UserApi;

    class LoadUserData extends AbstractFixture implements ContainerAwareInterface
    {
        const USER_NAME     = 'user_wo_permissions';
        const USER_API_KEY  = 'user_api_key';
        const USER_PASSWORD = 'user_password';

        private $container;

        public function setContainer(ContainerInterface $container = null)
        {
            $this->container = $container;
        }

        public function load(ObjectManager $manager)
        {
            /** @var \Oro\Bundle\UserBundle\Entity\UserManager $userManager */
            $userManager = $this->container->get('oro_user.manager');

            // Find role for user to able to authenticate in test.
            // You can use any available role that you want dependently on test logic.
            $role = $manager->getRepository(Role::class)
                ->findOneBy(['role' => 'IS_AUTHENTICATED_ANONYMOUSLY']);

            // Creating new user
            $user = $userManager->createUser();

            // Creating API entity for user, we will reference it in testGetUsersAPI method,
            // if you are not going to test API you can skip it
            $api = new UserApi();
            $api->setApiKey(self::USER_API_KEY)
                ->setUser($user);

            // Creating user
            $user
                ->setUsername(self::USER_NAME)
                ->setPlainPassword(self::USER_PASSWORD) // This value is referenced in testUsersIndex method
                ->setFirstName('Simple')
                ->setLastName('User')
                ->addRole($role)
                ->setEmail('test@example.com')
                ->setApi($api)
                ->setSalt('');

            // Handle password encoding
            $userManager->updatePassword($user);

            $manager->persist($user);
            $manager->flush();
        }
    }


Testing Commands
^^^^^^^^^^^^^^^^

When OroPlatform is installed, you can test commands by using the ``runCommand()`` method from the ``Oro\Bundle\TestFrameworkBundle\Test\WebTestCase`` class. This method executes a command with given parameters and returns its output as a string. For example, see what the test for the ``Oro\Bundle\SearchBundle\EventListener\UpdateSchemaDoctrineListener`` class from the SearchBundle looks like:

.. code-block:: php
   :caption: src/Oro/Bundle/SearchBundle/Tests/Functional/EventListener/UpdateSchemaListenerTest.php

    namespace Oro\Bundle\SearchBundle\Tests\Functional\EventListener;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class UpdateSchemaListenerTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient();
        }

        /**
         * @dataProvider commandOptionsProvider
         */
        public function testCommand($commandName, array $params, $expectedContent)
        {
            $result = $this->runCommand($commandName, $params);
            $this->assertContains($expectedContent, $result);
        }

        public function commandOptionsProvider()
        {
            return [
                'otherCommand' => [
                    'commandName'     => 'doctrine:mapping:info',
                    'params'          => [],
                    'expectedContent' => 'OK'
                ],
                'commandWithoutOption' => [
                    'commandName'     => 'doctrine:schema:update',
                    'params'          => [],
                    'expectedContent' => 'Please run the operation by passing one - or both - of the following options:'
                ],
                'commandWithAnotherOption' => [
                    'commandName'     => 'doctrine:schema:update',
                    'params'          => ['--dump-sql' => true],
                    'expectedContent' => 'ALTER TABLE'
                ],
                'commandWithForceOption' => [
                    'commandName'     => 'doctrine:schema:update',
                    'params'          => ['--force' => true],
                    'expectedContent' => 'Schema update and create index completed'
                ]
            ];
        }
    }

.. seealso::

    Read |Testing Commands| in the official documentation for more information on how to test commands in a Symfony application.

Testing Services or Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To test services or repositories, you can access the service container through the ``Oro\Bundle\TestFrameworkBundle\Test\WebTestCase::getContainer`` method:

.. code-block:: php
   :caption: src/Oro/Bundle/FooBarBundle/Tests/Functional/FooBarTest.php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected $repositoryOrService;

        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures(['Oro\Bundle\FooBarBundle\Tests\Functional\API\DataFixtures\LoadFooBarData']);
            $this->repositoryOrService = $this->getContainer()->get('repository_or_service_id');
        }

        public function testMethod($commandName, array $params, $expectedContent)
        {
            $expected = 'test';
            $this->assertEquals($expected, $this->repositoryOrService->callTestMethod());
        }
    }

Functional Test Example
-----------------------

This is an example of how you can write an integration test for a class that uses Doctrine ORM without mocking its classes and using real Doctrine services:

.. code-block:: php

    namespace Oro\Bundle\BatchBundle\Tests\Functional\ORM\QueryBuilder;

    use Doctrine\ORM\Query\Expr\Join;
    use Doctrine\ORM\QueryBuilder;
    use Doctrine\ORM\EntityManager;
    use Oro\Bundle\BatchBundle\ORM\QueryBuilder\CountQueryBuilderOptimizer;
    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class CountQueryBuilderOptimizerTest extends WebTestCase
    {
        /**
         * @dataProvider getCountQueryBuilderDataProvider
         * @param QueryBuilder $queryBuilder
         * @param string $expectedDql
         */
        public function testGetCountQueryBuilder(QueryBuilder $queryBuilder, $expectedDql)
        {
            $optimizer = new CountQueryBuilderOptimizer();
            $countQb = $optimizer->getCountQueryBuilder($queryBuilder);
            $this->assertInstanceOf('Doctrine\ORM\QueryBuilder', $countQb);
            // Check for expected DQL
            $this->assertEquals($expectedDql, $countQb->getQuery()->getDQL());
            // Check that Optimized DQL can be converted to SQL
            $this->assertNotEmpty($countQb->getQuery()->getSQL());
        }

        /**
         * @return array
         */
        public function getCountQueryBuilderDataProvider()
        {
            self::initClient();
            $em = self::getContainer()->get('doctrine.orm.entity_manager');

            return [
                'simple' => [
                    'queryBuilder' => self::createQueryBuilder($em)
                        ->from('OroUserBundle:User', 'u')
                        ->select(['u.id', 'u.username']),
                    'expectedDQL' => 'SELECT u.id FROM OroUserBundle:User u'
                ],
                'group_test' => [
                    'queryBuilder' => self::createQueryBuilder($em)
                        ->from('OroUserBundle:User', 'u')
                        ->select(['u.id', 'u.username as uName'])
                        ->groupBy('uName'),
                    'expectedDQL' => 'SELECT u.id, u.username as uName FROM OroUserBundle:User u GROUP BY uName'
                ]
            );
        }

        /**
         * @param EntityManager $entityManager
         * @return QueryBuilder
         */
        public static function createQueryBuilder(EntityManager $entityManager)
        {
            return new QueryBuilder($entityManager);
        }
    }

.. caution::

    If your class is responsible for retrieving data, it is better to load fixtures and retrieve them using a test class and then assert that the results are valid. Checking DQL is enough in this case, as it is the sole responsibility of this class to modify the query.

.. include:: /include/include-links-dev.rst
   :start-after: begin
