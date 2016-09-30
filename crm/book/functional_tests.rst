.. index::
    single: Testing; Functional Testing

Functional Tests
================

Overview
--------

Functional tests check the integration of the different layers of an application.

In this article you will learn how you can improve the experience of writing
functional tests with OroPlatform. It is recommended to read the Symfony
`documentation concerning testing`_ before you continue. You should also be
familiar with `PHPUnit`_.

When to Write Functional Tests
------------------------------

Functional tests are generally written for:

* Controllers;
* Commands;
* Repositories;
* Other services.

The goal of functional tests is not to test separate classes (unit tests),
but to test the integration of the different parts of an application.

Sometimes, writing unit tests to test certain functions can be come quite
difficult. For example, you might be creating dozen of mock objects to test
Doctrine ORM queries. Besides being rather complicated, these unit tests'
behavior can also be misleading. They might pass, while when working together
with the other layers of your real application they still may produce unexpected
results. In these situtations, functional tests can be the more approriate
choice.

The Test Environment
--------------------

Initialization Client and Loading Fixtures Caveats
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To improve the performance of test execution, the initialization of a client
is only done once per test case by default. This means that the kernel of
the Symfony application will be booted once per test case. Fixtures are also
loaded only once per test case by default. On one hand, initializing and loading
fixtures once per test case increases the performance of test execution but
it can also cause bugs because the state of fixtures and the kernel (and as
a result, the service container) will be shared by default between test methods
of separate test cases. Be sure to reset this state if necessary.

Test Environment Setup
~~~~~~~~~~~~~~~~~~~~~~

You will need to configure a set of parameters for the testing environment.
For example:

.. code-block:: yaml
    :linenos:

    # app/config/parameters_test.yml
    parameters:
        database_host: 127.0.0.1
        database_port: null
        database_name: crm_test
        database_user: root
        database_password: null
        mailer_transport: smtp
        mailer_host: 127.0.0.1
        mailer_port: null
        mailer_encryption: null
        mailer_user: null
        mailer_password: null
        websocket_host: 127.0.0.1
        websocket_port: 8080
        session_handler: null
        locale: en
        secret: ThisTokenIsNotSoSecretChangeIt
        installed: '2014-08-12T09:05:04-07:00'

Next, install an application in the test environment:

.. code-block:: bash

    $ app/console oro:install --env test --organization-name Oro --user-name admin --user-email admin@example.com --user-firstname John --user-lastname Doe --user-password admin --sample-data n --application-url http://localhost --force

.. versionadded:: 1.10

For platform versions prior to 1.10 need to run user fixtures upload command:

.. code-block:: bash

     $ app/console doctrine:fixture:load --no-debug --append --no-interaction --env=test --fixtures ./vendor/oro/platform/src/Oro/Bundle/TestFrameworkBundle/Fixtures

.. versionadded:: 1.9

For platform versions prior to 1.9 run command to update schema for test entities:

.. code-block:: bash

    $ app/console oro:test:schema:update --env test

After this, you'll be able to run your tests in a command line or IDE, e.g.:

.. code-block:: bash

    $ phpunit -c app/ %path_to_your_functional_test_folder_or_file%

Database Isolation
~~~~~~~~~~~~~~~~~~

The ``@dbIsolationPerTest`` annotation adds a transaction that will be performed
before a test starts and is rolled back when a test ends.

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbIsolationPerTest
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }

The ``@dbIsolation`` annotation adds a transaction that will be performed
when a client is initialized for the first time and is rolled back when all
test methods of the class have been executed.

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbIsolation
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }

Database Reindex
~~~~~~~~~~~~~~~~

The ``@dbReindex`` annotation triggers the execution of the ``oro:search:reindex``
command when the client is first initialized. This is a workaround for MyISAM
search tables that are not transactional.

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbReindex
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }

Loading Data Fixtures
~~~~~~~~~~~~~~~~~~~~~

Use the :method:`Oro\\Bundle\\TestFrameworkBundle\\Test\\WebTestCase::loadFixtures`
method to load a fixture in a test:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient(); // must be called before!

            // loading fixtures will be executed once, use the second parameter
            // $force = true to force the loading
            $this->loadFixtures(array(
                'Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadFooData',
                'Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBazData',
            ));
        }

        // ...
    }

A fixture class must be a ``Doctrine\Common\DataFixtures\FixtureInterface``
instance. An example fixture will look like this:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBarBundle/Tests/Functional/DataFixtures/LoadFooData.php
    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
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

You can also implement the ``Doctrine\Common\DataFixtures\DependentFixtureInterface``
which allows to load fixtures depending on other fixtures being already loaded:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBarBundle/Tests/Functional/DataFixtures/LoadFooData.php
    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;

    class LoadFooData extends AbstractFixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            // load fixtures
        }

        public function getDependencies()
        {
            return array('Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBarData');
        }
    }

Further, you can use reference-specific entities from fixtures, e.g.:

.. code-block:: php
    :linenos:

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\Persistence\ObjectManager;
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
            return array('Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBarData');
        }
    }

Now, you can reference the fixture by the configured name in your test:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
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

Writing Functional Tests
------------------------

To create a functional test case, you'll always have to do a couple of things:

* Extend the :class:`Oro\\Bundle\\TestFrameworkBundle\\Test\\WebTestCase`
  class;

* Prepare the test client (an instance of the :class:`Oro\\Bundle\\TestFrameworkBundle\\Test\\Client`
  class);

* Prepare fixtures (optional);

* Prepare container (optional);

* Call test functionality;

* Verify result.

Functional Tests for Controllers
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The Control Flow
................

A functional test for a controller consists of a couple of steps:

* Make a request;
* Test the response;
* Click on a link or submit a form;
* Test the response;
* Rinse and repeat.

Prepare Client Examples
-----------------------

Simple initialization works for testing commands and services when authentication
is not required.

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
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
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            // first array is Kernel options
            $this->initClient(array('debug' => false));
        }
        // ...
    }

Initialization with authentication:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            // second array is service options
            // this example will create client with server options array('PHP_AUTH_USER' =>  'admin@example.com', 'PHP_AUTH_PW' => 'admin')
            // make sure you loaded fixture with test user
            // app/console doctrine:fixture:load --no-debug --append --no-interaction --env=test --fixtures src/Oro/src/Oro/Bundle/TestFrameworkBundle/Fixtures
            $this->initClient(array(), $this->generateBasicAuthHeader());

            // init client with custom username and password
            $this->initClient(array(), $this->generateBasicAuthHeader('custom_username', 'custom_password'));
        }
        // ...
    }

Types of Functional Tests
-------------------------

Testing Controllers
~~~~~~~~~~~~~~~~~~~

Have a look at an example of a controller test from the OroCRM:

.. code-block:: php
    :linenos:

    // src/OroCRM/Bundle/TaskBundle/Tests/Functional/Controller/TaskControllersTest.php
    namespace OroCRM\Bundle\TaskBundle\Tests\Functional\Controller;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @outputBuffering enabled
     * @dbIsolation
     * @dbReindex
     */
    class TaskControllersTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient(array(), $this->generateBasicAuthHeader());
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
            $this->assertContains("Task saved", $crawler->html());
        }

        /**
         * @depends testCreate
         */
        public function testUpdate()
        {
            $response = $this->client->requestGrid(
                'tasks-grid',
                array('tasks-grid[_filter][reporterName][value]' => 'John Doe')
            );

            $result = $this->getJsonResponseContent($response, 200);
            $result = reset($result['data']);

            $crawler = $this->client->request(
                'GET',
                $this->getUrl('orocrm_task_update', array('id' => $result['id']))
            );

            $form = $crawler->selectButton('Save and Close')->form();
            $form['orocrm_task[subject]'] = 'Task updated';
            $form['orocrm_task[description]'] = 'Description updated';

            $this->client->followRedirects(true);
            $crawler = $this->client->submit($form);
            $result = $this->client->getResponse();

            $this->assertHtmlResponseStatusCodeEquals($result, 200);
            $this->assertContains("Task saved", $crawler->html());
        }

        /**
         * @depends testUpdate
         */
        public function testView()
        {
            $response = $this->client->requestGrid(
                'tasks-grid',
                array('tasks-grid[_filter][reporterName][value]' => 'John Doe')
            );

            $result = $this->getJsonResponseContent($response, 200);
            $result = reset($result['data']);

            $this->client->request(
                'GET',
                $this->getUrl('orocrm_task_view', array('id' => $result['id']))
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
............................

In this example, a user without sufficient permissions is trying to access
a controller action. The
:method:`Oro\\Bundle\\TestFrameworkBundle\\Test\\WebTestCase::assertHtmlResponseStatusCodeEquals`
method is used to ensure that access to the requested resource actually is
denied for the user:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/UserBundle/Tests/Functional/UsersTest
    namespace Oro\Bundle\UserBundle\Tests\Functional;

    use Oro\Bundle\UserBundle\Tests\Functional\DataFixtures\LoadUserData;
    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @outputBuffering enabled
     * @dbIsolation
     */
    class UsersTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures(array('Oro\Bundle\UserBundle\Tests\Functional\API\DataFixtures\LoadUserData'));
        }

        public function testUsersIndex()
        {
            $this->client->request(
                'GET',
                $this->getUrl('oro_user_index'),
                array(),
                array(),
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
                array('limit' => 100),
                array(),
                $this->generateWsseAuthHeader(LoadUserData::USER_NAME, LoadUserData::USER_API_KEY)
            );
            $result = $this->client->getResponse();
            $this->assertJsonResponseStatusCodeEquals($result, 403);
        }
    }

Here's an example of a fixture that adds a user without permissions:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/UserBundle/Tests/Functional/DataFixtures/LoadUserData.php
    namespace Oro\Bundle\UserBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;

    use Symfony\Component\DependencyInjection\ContainerAwareInterface;
    use Symfony\Component\DependencyInjection\ContainerInterface;

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
            $role = $userManager->getStorageManager()
                ->getRepository('OroUserBundle:Role')
                ->findOneBy(array('role' => 'IS_AUTHENTICATED_ANONYMOUSLY'));

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
~~~~~~~~~~~~~~~~

When OroPlatform is installed, you can test commands by using the
:method:`Oro\\Bundle\\TestFrameworkBundle\\Test\\WebTestCase::runCommand`
method from the ``WebTestCase`` class. This method executes a command with
given parameters and returns its output as a string. For example, see
what the test for the :class:`Oro\\Bundle\\SearchBundle\\EventListener\\UpdateSchemaDoctrineListener`
class from the SearchBundle looks like:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/SearchBundle/Tests/Functional/EventListener/UpdateSchemaListenerTest.php
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

    Read `Testing Commands`_ in the official documentation for more information
    on how to test commands in a Symfony application.

Testing Services or Repositories
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To test services or repositories, you can access the service container through
the :method:`Oro\\Bundle\\TestFrameworkBundle\\Test\\WebTestCase::getContainer`
method:

.. code-block:: php
    :linenos:

    // src/Oro/Bundle/FooBarBundle/Tests/Functional/FooBarTest.php
    namespace Oro\Bundle\FooBarBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected $repositoryOrService;

        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures(array('Oro\Bundle\FooBarBundle\Tests\Functional\API\DataFixtures\LoadFooBarData'));
            $this->repositoryOrService = $this->getContainer()->get('repository_or_service_id');
        }

        public function testMethod($commandName, array $params, $expectedContent)
        {
            $expected = 'test';
            $this->assertEquals($expected, $this->repositoryOrService->callTestMethod());
        }
    }


Integration Test Example
------------------------

This is an example of how you can write an integration test for a class that
uses Doctrine ORM without mocking it's classes and using real Doctrine services:

.. code-block:: php
    :linenos:

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

            return array(
                'simple' => array(
                    'queryBuilder' => self::createQueryBuilder($em)
                        ->from('OroUserBundle:User', 'u')
                        ->select(array('u.id', 'u.username')),
                    'expectedDQL' => 'SELECT u.id FROM OroUserBundle:User u'
                ),
                'group_test' => array(
                    'queryBuilder' => self::createQueryBuilder($em)
                        ->from('OroUserBundle:User', 'u')
                        ->select(array('u.id', 'u.username as uName'))
                        ->groupBy('uName'),
                    'expectedDQL' => 'SELECT u.id, u.username as uName FROM OroUserBundle:User u GROUP BY uName'
                )
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

    If your class is responsible for retrieving data, it's better to load
    fixtures and retrieve them using a test class and then assert that the
    results are valid. Checking DQL is enough in this case because this it
    is the sole responsibility of this class to modify the query.

.. _`documentation concerning testing`: http://symfony.com/doc/current/book/testing.html#functional-tests
.. _`PHPUnit`: http://phpunit.de
.. _`Testing Commands`: http://symfony.com/doc/master/components/console/introduction.html#testing-commands
