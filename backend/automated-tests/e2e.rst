End-to-End Testing with Behat
=============================

With the Behat framework, you can write human-readable stories that describe your application's behavior and then test them automatically against the application.

Behat turns user actions into steps and expected outcomes to test the application. Scenario steps simulate user interaction through the Google Chrome browser, so they can modify the application state.

You can organize dependent scenarios into features. Features are isolated by default to avoid data collisions and dependencies between features when they run one by one. For example, the database and cache directories are dumped before the feature tests run and restored once the tests finish.

Because of this isolation, Behat tests connect to the services the application uses --- database, cache, message broker, and so on --- and interact with them directly, bypassing the application. This makes them integration tests rather than end-to-end tests.

You can disable features isolation with the ``--skip-isolation`` option of the bin/behat console command. When isolation is disabled, tests interact only with the application by simulating a user through the browser. In this case, services are not touched, and tests become more black-box and, as a result, **end-to-end**.

Use Cases
---------

There are two main cases when end-to-end tests are helpful:

Remote Application Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^

With isolation disabled, you can test your development, staging, or production environment remotely to ensure crucial features work as expected after deployment.

When testing the production application, consider the artifacts and side effects of the tests: with isolators disabled, tests change the application state permanently. Never operate on real users' data. To mitigate the effects of running automated scenarios, create separate users explicitly for tests.

To test the external application, change the ``base_url`` option in the behat.yml file to the remote one. As many isolators do not support remote application testing, you can test external applications only with the skip-isolators option.

Preparation for Manual Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Behat features can automate tedious tasks for preparing the manual testing environment, like filling multiple forms to create testing data.

For example, you can integrate with an external payment and shipping system and create or import products with prices to manually test the checkout process when the data are ready.

Prerequisites
-------------

- |PHP 8.2|
- |Composer|
- The latest version of |Google Chrome|
- The |ChromeDriver| binary for your platform
- :ref:`The Oro Application Source Code <installation--get-files>`.

.. note:: Please avoid reusing an existing local application installation for running end-to-end tests. Instead, create a separate instance of the application with the same code.

.. hint:: If you are using a previously installed application, clean up the application state before you begin:

          .. code-block:: bash

             rm -rf var/cache/prod

Running Tests
-------------

1. Create a ``behat.yml`` file in the application folder. In this file, set the ``base_url`` option to the application URL to test.

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

2. Start the ChromeDriver:

   .. code-block:: bash

      chromedriver --url-base=wd/hub --port=4444

3. You can now run behat tests with the skip-isolators option:

   .. code-block:: bash

      php bin/behat --skip-isolators -- <path-to-behat.feature>

   .. hint:: You can use the ``--stop-on-failure`` option to stop processing on the first failed scenario.

You can find Behat features provided by Oro that cover most application features by running the ``php bin/behat --available-features`` command. However, remember that most of them require data fixtures to be loaded to the database, so you cannot use them as-is for the end-to-end testing without the database connection to the tested application.

.. note:: Some behat steps interact with application services. When testing the remote application, avoid using these steps or provide service connection details for the required services in the environment variables to fulfill requirements for such step(s).

Running Tests with Data Fixtures
--------------------------------

To test a feature, you often need different data loaded (users to log in, products with prices to add to the shopping list, etc.). Loading all the required data with behat steps can take a while and is often unnecessary. To speed up such scenarios, load the data directly into the database with fixtures before running the tests. This requires a database connection from the application instance that runs the tests to the tested one.

.. note:: Your local application source code must match the code of the tested application. Otherwise, you may face issues with the data load.

1. Provide database credentials for the tested application to the .app-env.local file. E.g.:

   .. code-block:: bash

      ORO_DB_DSN=postgres://oro_db_user:oro_db_pass@10.0.0.1:3306/oro_db

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

Using Secrets Variables in Tests
--------------------------------

To test a feature, you may need to use sensitive data like credentials which should not be defined in fixtures. You can define these variables in the secrets variable file and use those variables in your scenarios.

1. Create a ``.behat-secrets.yml`` file in the application folder, and set your configuration variables to use in the test.

   .. code-block:: yaml

      secrets:
          login:
              username: admin
              password: s3crEtPas$

2. Modify your scenario with variables in the ``<Secret:variable.path>`` format.

   .. code-block:: gherkin

      Feature: Example to use secrets variables
        Scenario: Login into Admin with variables
          Given I go to "admin"
          And I fill form with:
            | Username | <Secret:login.username> |
            | Password | <Secret:login.password> |
          And I click "Log in"

Built-in Scenarios
------------------

To configure predefined integrations, you can use one of the built-in scenarios.

1. To use scenarios, install the extension:

   .. code-block:: bash

      composer require oro/e2e-tests --dev -n

2. Copy ``.behat-secrets.yml.dist`` to ``.behat-secrets.yml`` in the application root and modify the necessary credentials to the actual one.

3. Check available scenarios in ``vendor/oro/e2e-tests/Tests/Behat/Features/``

4. Run the following scenario:

   .. code-block:: bash

      php bin/behat --skip-isolators -- vendor/oro/e2e-tests/Tests/Behat/Features/create_mailchimp_integration.feature