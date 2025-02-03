End-to-End Testing with Behat
=============================

With Behat framework, you can write human-readable stories describing your application's behavior. These stories might be auto-tested against your application.
We transform user actions into steps and expected outcomes to test the application. Scenario steps simulate user interaction with the application through the Google Chrome browser so that you can modify the application state.

You can organize dependent scenarios into features. The features are isolated by default to avoid data collisions and dependencies between features when they are running one by one. For example, the database and cache directories are dumped before running the feature tests; they are restored once the feature tests are executed. This means that when we run Behat tests, they are connected to services used by the application, such as the database, cache, message broker, and so on, and can interact with them, bypassing the application. As a result, these tests are rather integration than end-to-end.

You can disable features isolation with the ``--skip-isolation`` option of the bin/behat console command. When isolation is disabled, tests interact only with the application by simulating a user through the browser. In this case, services are not touched, and tests become more black-box and, as a result, **end-to-end**.

Use Cases
---------

There are two main cases when end-to-end tests are helpful:

Remote Application Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^

You can test your development, staging, or production environment remotely with the disabled isolation to ensure crucial features work as expected after deployment. When testing the production application, consider the artifacts and side effects of the tests because, with disabled isolators, tests change the application state permanently. As a consequence, you should never operate real users' data. For example, to mitigate the effects of running automated scenarios, you can create separate users explicitly for tests.

To test the external application, change the ``base_url`` option in the behat.yml file to the remote one. As many isolators do not support remote application testing, you can test external applications only with the skip-isolators option.

Preparation for Manual Testing
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Behat features can automate tedious tasks for preparing the manual testing environment, like filling multiple forms to create testing data.

For example, you can integrate with an external payment and shipping system and create or import products with prices to manually test the checkout process when the data are ready.

Prerequisites
-------------

- |php 8.4|
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

To test a feature, you often need different data loaded (users to log in, products with prices to add to the shopping list, etc.). Loading all the required data with behat steps might take a while and is often unnecessary. You can load data directly to the database with fixtures before running tests to speed up such scenarios. This requires the database connection from the application instance that runs tests to the tested one.

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

2. Modify your scenario with variables in format `<Secret:variable.path>``.

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

Running the Test in `Watch` Mode
---------------------------------

The Watch mode allows you to save time on correcting errors and writing with behat tests.

If the test was run with '--watch' option, it will stop every time there is an error in any step or at the end, when the last step is performed (this will simplify the process of writing the test in realtime)
After stopping in the console, we can correct the error and continue the test from the required step (you can start from the failed step or from any other step to the failed step if necessary)
If the error is not fixed correctly or the test fails at another step, the test will stop again (this process is cyclical and will continue until the test is completed or interrupted).

To run the test in the `Watch` mode, you need to add the `--watch` option to the command:

   .. code-block:: bash

      php bin/behat --watch -- <path-to-behat.feature>

1. The line number is shown before the step title in the `watch` mode:

   .. code-block:: none

      Scenario: Feature background
          16 Given sessions active:
            | Buyer | first_session  |
            | Admin | second_session |
      Scenario: Save "Requests For Quote" storefront menu item
          21 Given I proceed as the Admin
          22 And I log in as administrator
          23 And I go to System/Storefront Menus
          24 And I click view "oro_customer_menu" in the grid
          25 And I click Orders in the menu tree

2. The test stops when it fails and shows the question: `Press ENTER to continue from the current line #26, or enter the line number to continue (Ctrl+C to exit):`

You can choose several options:
    - Press Enter to continue from the current line #<line number>.
    - Write the line number to continue from and press Enter.
    - Press Ctrl+C to exit.

   .. code-block:: none

      24 And I click view "oro_customer_menu" in grid
          25 And I click Orders in menu tree
          26 And I click "CChoose Image" # incorrect element
            Behat\Mink\Exception\ElementNotFoundException: Button with id|name|title|alt|value "CChoose Image" not found. in vendor/behat/mink/src/Element/TraversableElement.php:112
      Press ENTER to continue from the current line #26, or enter the line number to continue (Ctrl+C to exit):

.. note:: This process is cyclical, if the test step fails you can run from the input line again and again.

3. Also, the step stops at the end when the last test step is passed.

You can choose several options:
    - Press Enter to continue (the test will continue from the next line - this can be useful if you are writing new test steps).
    - Press Ctrl+C to exit.

   .. code-block:: none

       Press ENTER to continue from the current line #26, or enter the line number to continue (Ctrl+C to exit): 26
          26 And I click "Choose Image"
          27 And I click "Cancel"
          28 And I click Requests For Quote in menu tree
          29 And I save the form
          30 Then I should see "Menu item saved successfully." flash message # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iShouldSeeFlashMessage()
      The last test step was passed. Press the Enter to continue or Ctrl+C to exit:

.. note:: You can also stop the test at any point during execution `press Ctrl+C to exit`.
.. note:: If an error occurred during the data fixture loading - there is no need to restore the state of the application after correcting the error, just restart.


Self-Healing
------------

This feature looks like a set of extensions that can be applied to certain types of test steps, and if a test fails, we try to fix it automatically.

Currently, there are several healers:
    1. Reload Page Healer - fixes steps that look for an element on the page and don't find it (used to fix some random crashes)
    2. OpenAI Healer - experimental (must be enabled manually) - tries to offer a fix for the test step, but does not change it.

To enable OpenAI Healer, you need to configure the extension in "behat.yml":

   .. code-block:: yaml

       default: &default
            extensions: &default_extensions
                ....
                Oro\Bundle\TestFrameworkBundle\BehatOpenAIExtension\ServiceContainer\BehatOpenAIExtension:
                api_key: <OpenAI API Key>

You can also add your own Healer. For this, you need:
    1. Create your healer class and implement the interface - `Oro\Bundle\TestFrameworkBundle\Behat\Healer\HealerInterface`
    2. Mark it with the `oro_test.behat.healer` tag, as in the example below:

   .. code-block:: yaml

       oro_test.healer.test.extension:
           class: Oro\Bundle\TestFrameworkBundle\Behat\Healer\Extension\TestHealer
           tags:
               - { name: oro_test.behat.healer, priority: 50 }

The work process of the healer can be seen in the process of performing the behat test, for example:

   .. code-block:: none

        Scenario: Save "Requests For Quote" storefront menu item
            21 Given I proceed as the Admin
            22 And I log in as administrator
            23 And I go to System/Storefront Menus
            24 And I click view "oro_customer_menu" in the grid
            25 And I click Orders in the menu tree
            Step: I click "CChoose Image" is failed
            Trying to heal the step
            Running OpenAI healer for clickable steps  # Oro\Bundle\TestFrameworkBundle\BehatOpenAIExtension\Healer\Extension\OpenAIClickableStepHealer
               Suggested changes: FROM: `I click "CChoose Image"`, TO: `I click "Choose Image"`
            Step is healed successfully
            26 And I click "CChoose Image"
              Button with id|name|title|alt|value "CChoose Image" not found. (Behat\Mink\Exception\ElementNotFoundException)
              +-- Saved artifacts:
              https://127.0.0.1:8000/media/behat/image673227019f7d7125671158.png
        Press ENTER to continue from the current line #26, or enter the line number to continue (Ctrl+C to exit): 23 And I go to System/Storefront Menus

