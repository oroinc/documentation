.. index::
    single: Testing; Functional Testing

How To Write Functional Tests
=============================

Overview
--------

Functional tests check the integration of the different layers of an application.

From this article you will learn how you can improve experience of writing functional tests with Oro Platform.
Symfony 2 documentation about testing (http://symfony.com/doc/current/book/testing.html#functional-tests) is recommended
to read before. Also you should be familiar with PHPUnit (http://phpunit.de).

When To Write Functional Tests
------------------------------

Functional tests are generally written for:

* controllers;
* commands;
* repositories;
* other services.

Goal of function tests is not to test separate class (unit tests) but the integration of the different parts of
application.

If you encounter problems when writing a unit test, for example you are created dozen of mocks for Doctrine ORM classes to
check building of the query and retrieving data from persistence layer then stop think, probably a functional test will
be more appropriate.

Such unit tests can be dangerous because they can deceptively pass, while in the real application functionality
is not working.

Workflow of Functional Test for Controller
------------------------------------------

* Make a request;
* Test the response;
* Click on a link or submit a form;
* Test the response;
* Rinse and repeat.


Steps to Create Functional Test
-------------------------------

* Extend Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;
* Prepare test client (instance of Oro\Bundle\TestFrameworkBundle\Test\Client);
* Prepare fixtures (optional);
* Prepare container (optional);
* Call test functionality;
* Verify result.

Initialization Client and Loading Fixtures Caveats
--------------------------------------------------

For improving performance of tests execution initialization of client by default is done only once per test case.

It means that kernel of Symfony 2 application will be booted once per test case.

Fixtures are also loaded by default only once per test case.

Initialization and loading fixtures once per test case increases performance of tests execution from one side but
it also can be a cause of bugs in because the state of fixtures and kernel (and as a result service container)
will be shared by default between test methods of separate test case, so take care for resetting this state if needed.

Setup Test Environment
----------------------

You will need to provide a parameters for testing environment in app/config/parameters_test.yml. For example:

.. code-block:: yaml

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

Now you need to install an application in test environment and also run some additional commands:

.. code-block:: bash

    user@host: app/console oro:install --env test --company-short-name Oro --company-name Oro --user-name admin --user-email admin@example.com --user-firstname John --user-lastname Doe --user-password admin --sample-data n --application-url http://localhost --force
    user@host: app/console doctrine:fixture:load --no-debug --append --no-interaction --env=test --fixtures src/Oro/src/Oro/Bundle/TestFrameworkBundle/Fixtures
    user@host: app/console oro:test:schema:update --env test


After this you will be able to run your tests in a command line or IDE, for example:

.. code-block:: bash

    user@host: phpunit -c app/ %path_to_your_functional_test_folder_or_file%


Prepare client examples
-----------------------

Simple initialization, works for commands and services testing when authentication is not required.

.. code-block:: php

    <?php

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

    <?php

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

    <?php

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

Database Isolation
------------------

.. code-block:: php

    <?php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbIsolation
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }

This annotation adds transaction that will be when client is initialized first time and rollbacked when all test methods
of class will be executed.

Database Reindex
----------------

.. code-block:: php

    <?php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @dbReindex
     */
    class FooBarTest extends WebTestCase
    {
        // ...
    }


This annotation will trigger execution of command "oro:search:reindex" when first client will be initialized.
This is a workaround for MyISAM search tables that are not transactional.


Loading Data Fixtures
---------------------

Example of loading fixture in test:

.. code-block:: php

    <?php

    namespace Oro\Bundle\FooBundle\Tests\Functional;

    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class FooBarTest extends WebTestCase
    {
        protected function setUp()
        {
            $this->initClient(); // must be called before!

            // loading fixtures will be executed once, use second parameter $force = true to force loading.
            $this->loadFixtures(
                array(
                    'Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadFooData',
                    'Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures\LoadBazData',
                )
            );
        }
        // ...
    }

Fixture must be an instance of of Doctrine\Common\DataFixtures\FixtureInterface. Example of fixture:

.. code-block:: php

    <?php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\AbstractFixture;

    class LoadFooData extends AbstractFixture
    {
        public function load(ObjectManager $manager)
        {
            // $entity = new FooEntity();
            $manager->persist($entity);
            $manager->flush();
        }
    }

Also you can use Doctrine\Common\DataFixtures\DependentFixtureInterface:

.. code-block:: php

    <?php

    namespace Oro\Bundle\FooBarBundle\Tests\Functional\DataFixtures;

    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Common\DataFixtures\AbstractFixture;

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

Also you can use references specific entity from fixtures, for example:

.. code-block:: php

    <?php

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

Now you can use this reference in you test:

.. code-block:: php

    <?php

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

Testing Controllers
-------------------

Check this test as an example:

.. code-block:: php

    <?php

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


Testing ACL in Controllers
--------------------------

In this example a user without sufficient permissions is trying to access controller action:

.. code-block:: php

    <?php

    namespace Oro\Bundle\UserBundle\Tests\Functional\API;

    use Oro\Bundle\UserBundle\Tests\Functional\API\DataFixtures\LoadUserData;
    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    /**
     * @outputBuffering enabled
     * @dbIsolation
     */
    class RestUsersACLTest extends WebTestCase
    {
        const DEFAULT_USER_ID = '1';

        protected function setUp()
        {
            $this->initClient();
            $this->loadFixtures(array('Oro\Bundle\UserBundle\Tests\Functional\API\DataFixtures\LoadUserData'));
        }

        public function testGetUsers()
        {
            //get user id
            $this->client->request(
                'GET',
                $this->getUrl('oro_api_get_users'),
                array('limit' => 100),
                array(),
                $this->generateWsseAuthHeader(LoadUserData::USER_NAME, LoadUserData::USER_PASSWORD)
            );
            $result = $this->client->getResponse();
            $this->assertJsonResponseStatusCodeEquals($result, 403);
        }
    }

Testing Commands
----------------

Example of command command output:

.. code-block:: php

    <?php

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

Testing Services or Repositories
--------------------------------

Example of repository or service test:

.. code-block:: php

    <?php

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

This is an example of how you can write an integration test for class that is using Doctrine ORM
without mocking it's classes and using real Doctrine services:

.. code-block:: php

    <?php

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

    If your class is responsible for retrieving data, it will be more good idea to load fixtures and get them using test
    class and then assert that results are valid. Checking DQL in this case is enough because of specific responsibility
    of this class to modify the query.

References
----------

* `Symfony 2 Functional Testing`_
* `PHPUnit`_

.. _Symfony 2 Functional Testing: http://symfony.com/doc/current/book/testing.html#functional-tests
.. _PHPUnit: http://phpunit.de
