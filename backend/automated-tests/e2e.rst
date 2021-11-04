End-to-End Testing with Behat
=============================

With Behat framework, you can write human-readable stories that describe the behavior of your application. These stories might be auto-tested against your application.
To test the application, we transform user actions into steps and expected outcomes. Scenario steps simulate user interaction with the application through the Google Chrome browser, and as a result, you can modify the application state.

You can organize dependent scenarios into features. The features are isolated by default to avoid data collisions and dependencies between features when they are running one by one. For example, the database and cache directories are dumped before running the feature tests; they are restored once the execution of the feature tests is complete. This means that when we run Behat tests, they are connected to services used by the application, such as the database, cache, message broker, and so on, and can interact with them, bypassing the application. As a result, these tests are rather integration than end-to-end.

You can disable features isolation with the ``--skip-isolation`` option of the bin/behat console command. When isolation is disabled, tests interact only with the application by simulating a user through the browser. In this case, services are not touched, and tests become more black-box and, as a result, **end-to-end**.

Use Cases
---------

There are two main cases when end-to-end tests are helpful:

Remote Application Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^

You can test your development, staging, or even production environment remotely with the disabled isolation to ensure crucial features work as expected after deployment. When testing the production application, make sure you consider the artifacts and side effects of the tests because, with disabled isolators, tests change the application state permanently. As a consequence, you should never operate real users' data. For example, to mitigate the effects of running automated scenarios, you can create separate users explicitly for tests.

To test the external application, change the ``base_url`` option in the behat.yml file to the remote one. As many isolators do not support remote application testing, you can test external applications only with the skip-isolators option.

Preparation for Manual Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Behat features can automate tedious tasks for preparing the manual testing environment, like filling multiple forms to create testing data.

For example, you can integrate with an external payment and shipping system and create or import products with prices to manually test the checkout process when the data are ready.

Prerequisites
-------------

- |PHP 8.0|
- |Composer|
- The latest version of |Google Chrome|
- The |ChromeDriver| binary for your platform
- :ref:`The Oro Application Source Code <installation--get-files>`.

.. note:: Please avoid reusing an existing local application installation for running end-to-end tests. Instead, create a separate instance of the application with the same code.

.. hint:: If you are using previously installed application, clean up the application state before you begin:

          .. code-block:: bash

             rm -rf config/parameters.yml var/cache/prod
             composer build-parameters -n

Running Tests
-------------

1. To test a remote application, define the database server version in the config/parameters.yml file so the application does not attempt to connect to the database:

   .. code-block:: bash

      composer set-param database_server_version=8

2. Create a ``behat.yml`` file in the application folder. In this file, set the ``base_url`` option to the application URL to test.

   .. code-block:: yaml

      imports:
        - ./behat.yml.dist

      default: &default
          extensions: &default_extensions
              Behat\MinkExtension:
                  base_url: "https://example.com"
              # This configuration changes artifacts URLs to local file links.
              # Remove it if artifacts URLs are the same as for the tested application
              # or change the base_url to the custom base URL for artifacts.
              Oro\Bundle\TestFrameworkBundle\Behat\ServiceContainer\OroTestFrameworkExtension:
                  artifacts:
                      handlers:
                          local:
                              directory: '%paths.base%/public/media/behat'
                              base_url: ~ # default is '%mink.base_url%/media/behat/'
                              auto_clear: false

3. Start the ChromeDriver:

   .. code-block:: bash

      chromedriver --url-base=wd/hub --port=4444

4. You can now run behat tests with the skip-isolators option:

   .. code-block:: bash

      php bin/behat --skip-isolators -- <path-to-behat.feature>

   .. hint:: You can use the ``--stop-on-failure`` option to stop processing on the first failed scenario.

You can find Behat features provided by ORO that cover most application features by running the ``php bin/behat --available-features`` command. However, keep in mind that most of them require data fixtures to be loaded to the database, so you cannot use them as-is for the end-to-end testing without the database connection to the tested application.

.. note:: Some behat steps interact with application services. When testing the remote application, avoid using these steps or provide service connection details for the required services in the config/parameters.yml file to fulfill requirements for such step(s).

Running Tests with Data Fixtures
--------------------------------

To test a feature, you often need different data loaded (users to login, products with prices to add to the shopping list, etc.). Loading all the required data with behat steps might take a while and is often unnecessary. You can load data directly to the database with fixtures before running tests to speed up such scenarios. This requires the database connection from the application instance that runs tests to the tested one.

.. note:: Your local application source code must match the code of the tested application. Otherwise, you may face issues with the data load.

1. Provide database credentials for the tested application to the config/parameters.yml file. E.g.:

   .. code-block:: yaml

      parameters:
          database_driver:        pdo_mysql
          database_host:          10.0.0.1
          database_port:          3306
          database_name:          oro_db
          database_user:          oro_db_user
          database_password:      oro_db_pass

2. Create a ``behat.yml`` file in the application folder. In this file, set the ``base_url`` option to the application URL to test.

   .. code-block:: yaml

      imports:
        - ./behat.yml.dist

      default: &default
          extensions: &default_extensions
              Behat\MinkExtension:
                  base_url: "https://example.com"

3. Start the ChromeDriver:

   .. code-block:: bash

      chromedriver --url-base=wd/hub --port=4444

4. You can now run tests with skipped isolators, except the one that loads data fixtures:

   .. code-block:: bash

      php bin/behat --skip-isolators-but-load-fixtures -- <path-to-behat.feature>

.. include:: /include/include-links-dev.rst
   :start-after: begin
