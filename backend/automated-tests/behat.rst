.. _behat-tests:

Behat Tests
===========

Concepts
--------

The information below summarizes concepts and tools that are important for understanding and use of the test framework delivered within OroBehatExtension.

* **Behavior-driven development (BDD)** is a software development process that emerged from test-driven development (TDD). The Behavior-driven development combines the general techniques and principles of TDD with ideas from domain-driven design and object-oriented analysis and design to provide software development and management teams with shared tools and a shared process to collaborate on software development.
* **Behat** is a |Behavior Driven Development framework| for PHP.
* **Mink** is an |open source browser controller/emulator| for web applications developed using PHP.
* **OroElementFactory** creates elements in contexts.
* **Symfony2 Extension** provides integration with |Symfony2|.
* **@OroTestFrameworkBundle\Behat\ServiceContainer\OroTestFrameworkExtension** provides integration with Oro BAP based applications.
* **Selenium2Driver** Selenium2Driver provides a bridge for the WebDriver's wire protocol.
* **ChromeDriver** |WebDriver| is an open-source tool for automated testing of web apps across many browsers. It provides capabilities for navigating to web pages, user input, JavaScript execution, and more.

.. _behat-conventions:

Conventions
-----------

This section summarizes the limitations and agreements that are important for shared test maintenance and use.

- **Use form mapping instead of selectors in your scenarios** to keep them clear and understandable for people from both the technical and nontechnical world.

  **Do not**:

  .. code-block:: gherkin
     :linenos:

      I fill in "oro_workflow_definition_form[label]" with "User Workflow Test"
      I fill in "oro_workflow_definition_form[related_entity]" with "User"

  **Do**:

  .. code-block:: gherkin
     :linenos:

      And I fill "Workflow Edit Form" with:
        | Name                  | User Workflow Test |
        | Related Entity        | User               |

  .. code-block:: yaml
     :linenos:

      Workflow Edit Form:
        selector: 'form[name="oro_workflow_definition_form"]'
        class: Oro\Bundle\TestFrameworkBundle\Behat\Element\Form
        options:
          mapping:
            Name: 'oro_workflow_definition_form[label]'
            Related Entity: 'oro_workflow_definition_form[related_entity]'

- Use menu and links to get the right :ref:`pages <behat-page-element>` instead of the direct page URL

  **Do**:

  .. code-block:: gherkin
     :linenos:

      And I open User Index page

  **Don't**:

  .. code-block:: gherkin
     :linenos:

      And I go to "/users"

* **Avoid scenario redundancy** (e.g., repeating the same sequence of steps, like login, in multiple scenarios).

  Cover the feature with the sequential scenarios where every following scenario reuses outcomes (the states and data) prepared by their predecessors.
  This path was chosen because of the following benefits:

    - Faster scenario execution due to the shared user session and smart data preparation. The login action in the initial scenario opens the session that is reusable by the following scenarios. Preliminary scenarios (e.g., create) prepare data for the following scenarios (e.g., delete).
    - Feature level isolation boosts execution speed, especially in the slow test environments.
    - Minimized routine development actions (e.g., you do not have to load fixtures for every scenario; instead, you reuse the available outcomes of the previous scenarios).
    - Easy handling of the application states that are difficult to emulate with data fixtures only (e.g., when adding new entity fields in the UI).

  By coupling scenarios, the ease of debugging and bug localization get sacrificed. It is difficult to debug UI features and the scenarios that happen after several preliminary scenarios. The longer the line, the harder it is to isolate the issue. Once the issue occurs, you have to spend additional time localizing it and identifying the root cause (e.g., the delete scenario may malfunction vs the delete scenario may fail due to the issues in the preliminary scenario, for example, create). The most critical actions/scenarios usually precede the less critical ones.

- **Use semantical yml fixtures**

  Use only the entities that are in the bundle you are testing. Any other entities should be included via import.  See :ref:`Alice fixtures <behat-alice-fixtures>` for more information.

- **Name elements in camelCase style without spaces**

  You can still refer to it using the camelCase style with spaces in the behat scenarios. For example, an element named ``OroProductForm`` may be mentioned in the step of the scenario as "Oro Product From":

  .. code-block:: gherkin
     :linenos:

     I fill "Oro Product From" with:

- **Use Scenario: Feature Background instead of the Background step**

Getting Started
---------------

Configuration
^^^^^^^^^^^^^

Application Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~

Use default configuration for the application installed in production mode. If you do not have any mail server configured locally, set the ``mailer_transport`` setting in *parameters.yml* to ``null``.

Behat Configuration
~~~~~~~~~~~~~~~~~~~

The base configuration is located in *behat.yml.dist*. Every application has its own *behat.yml.dist* file in the root of the application directory.
Create your *behat.yml* (it is ignored by git automatically and is never committed to the remote repository), import base configuration and change it to fit your environment:

.. code-block:: gherkin
   :linenos:

    imports:
      - ./behat.yml.dist

    default: &default
        extensions: &default_extensions
            Behat\MinkExtension:
                browser_name: chrome
                base_url: "http://your-domain.local"

Installation
^^^^^^^^^^^^

Install Dev Dependencies
~~~~~~~~~~~~~~~~~~~~~~~~

If you installed dependencies with ``--no-dev`` parameter earlier, remove ``composer.lock`` file from the root of the application directory.

Install dev dependencies using the following command:

.. code-block:: bash
   :linenos:

   composer install

Application Initial State
~~~~~~~~~~~~~~~~~~~~~~~~~

In the Oro application, the initial state is the one when the application enters after installation without demo data. Scenarios that test features should rely on this state and should create any data that is necessary for additional verifications. Data may be created by the steps of the scenario or as :ref:`fixtures <behat-fixtures>`.

Install the application without demo data in production mode using the following command:

.. code-block:: bash
   :linenos:

    bin/console oro:install  --drop-database --user-name=admin --user-email=admin@example.com  \
      --application-url=http://dev-crm.local --user-firstname=John --user-lastname=Doe \
      --user-password=admin  --organization-name=ORO --env=prod --sample-data=n --timeout=3000


Install Test Automation Tools
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To execute scenarios that use Oro application features run WebKit browser (using ChromeDriver).
To install ChromeDriver, run the following commands:

.. code-block:: bash
   :linenos:

    CHROME_DRIVER_VERSION=$(curl -sS chromedriver.storage.googleapis.com/LATEST_RELEASE)
    mkdir -p "$HOME/chrome" || true
    wget "http://chromedriver.storage.googleapis.com/${CHROME_DRIVER_VERSION}/chromedriver_linux64.zip" -O "$HOME/chrome/chromedriver_linux64_${CHROME_DRIVER_VERSION}.zip"
    unzip "$HOME/chrome/chromedriver_linux64_${CHROME_DRIVER_VERSION}.zip" -d "$HOME/chrome"
    sudo ln -s "$HOME/chrome/chromedriver" /usr/local/bin/chromedriver

.. note:: These commands create a subdirectory for Chrome in your home directory, download ChromeDriver into the directory that you just created, uncompress files, and create a symbolic link.

After the command execution is complete, you can use ``chromedriver`` in the terminal.

Test Execution
^^^^^^^^^^^^^^

Prerequisites
~~~~~~~~~~~~~

Run ChromeDriver:

.. code-block:: bash
   :linenos:

   chromedriver --url-base=wd/hub --port=4444 > /tmp/driver.log 2>&1

To run ChromeDriver in background, append ampersand symbol (&) to the end of line, like in the following examples:

.. code-block:: bash
   :linenos:

   chromedriver --url-base=wd/hub --port=4444 > /tmp/driver.log 2>&1 &

Run Tests
~~~~~~~~~

Before you begin, it is highly recommended to make yourself familiar with behat arguments and options.
Run ``bin/behat --help`` for a detailed description.

When the Oro application is installed without demo data and is running, and the ChromeDriver is running, you can start running the behat tests by feature from the root of the application.

You may use one of the following commands.

Run feature test scenario:

.. code-block:: bash
   :linenos:

    bin/behat vendor/oro/platform/src/Oro/Bundle/UserBundle/Tests/Behat/Features/login.feature -vvv

Preview all available feature steps:

.. code-block:: bash
   :linenos:

    bin/behat -dl -s OroUserBundle

View steps with full description and examples:

.. code-block:: bash
   :linenos:

    bin/behat -di -s OroUserBundle

Every bundle has its dedicated test suite that can be run separately:

.. code-block:: bash
   :linenos:

    bin/behat -s OroUserBundle

Architecture
------------

DI Containers
^^^^^^^^^^^^^

Behat is a Symfony console application with its own container and services. A Behat container may be configured through Extensions using *behat.yml* in the root of the application directory.

Application container may be used by injected Kernel in your Context after you implement ``KernelAwareContext`` and use ``KernelDictionary`` trait.

.. code-block:: php
   :linenos:

    use Behat\Symfony2Extension\Context\KernelAwareContext;
    use Behat\Symfony2Extension\Context\KernelDictionary;
    use Oro\Bundle\TestFrameworkBundle\Behat\Context\OroFeatureContext;

    class FeatureContext extends OroFeatureContext implements KernelAwareContext
    {
        use KernelDictionary;

        public function useContainer()
        {
            $doctrine = $this->getContainer()->get('doctrine');
        }
    }

Moreover, you can inject application services in behat Context:

.. code-block:: yaml
   :linenos:

    oro_behat_extension:
      suites:
        OroCustomerAccountBridgeBundle:
          contexts:
            - OroImportExportBundle::ImportExportContext:
                - '@oro_entity.entity_alias_resolver'
                - '@oro_importexport.processor.registry'

Autoload Suites
^^^^^^^^^^^^^^^

``Oro\Bundle\TestFrameworkBundle\Behat\ServiceContainer\OroTestFrameworkExtension`` is used for building testing suites.

During initialization, the extension creates a test suite with a bundle name if any ``Tests/Behat/Features`` directory exists in a bundle.
Thus, if the bundle has no Features directory - no test suite would be created for it.

If you need some specific feature steps for your bundle, create the ``AcmeDemoBundle\Tests\Behat\Context\FeatureContext`` class. This context is added to the suite with other common contexts.
The complete list of common context is configured in the behat configuration file under the ``shared_contexts``.

You can manually configure test suite for a bundle in the application behat configuration:

.. code-block:: yaml
   :linenos:

    default: &default
      suites:
        AcmeDemoBundle:
          type: symfony_bundle
          bundle: AcmeDemoBundle
          contexts:
            - Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext
            - OroDataGridBundle::GridContext
            - AcmeDemoBundle::FeatureContext
          paths:
            - 'vendor/Acme/DemoBundle/Tests/Behat/Features'

or in a bundle behat configuration ``{BundleName}/Tests/Behat/behat.yml``:

.. code-block:: yaml
   :linenos:

    oro_behat_extension:
      suites:
        AcmeDemoBundle:
          contexts:
            - Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext
            - OroDataGridBundle::GridContext
            - AcmeDemoBundle::FeatureContext
          paths:
            - '@AcmeDemoBundle/Tests/Behat/Features'

Manually configured test suits are not autoloaded by the extension.

.. _behat-feature-isolation:

Feature Isolation
^^^^^^^^^^^^^^^^^

Every feature can interact with the application and perform CRUD operations. As a result, the database may be modified. To avoid data collisions, the features are isolated: the database and cache directories are dumped before running the feature tests; they are restored after the feature tests execution is complete.

Every isolator must implement the ``Oro\Bundle\TestFrameworkBundle\Behat\Isolation\IsolatorInterface`` and ``oro_behat.isolator`` tags with priority.

Disable Feature Isolation
~~~~~~~~~~~~~~~~~~~~~~~~~

You can disable feature isolation by adding the ``--skip-isolators=database,cache`` option to behat console command. In this case, the combination of the feature tests might run much faster, but the test logic should care about the database and cache consistency.

Page Object
-----------

Elements
^^^^^^^^

Elements is a service layer in behat tests. They wrap the complex business logic. Take a minute to investigate base Mink |NodeElement|.

It has many public methods; some of them are applicable only to certain elements. Every Bundle test can contain a particular number of elements.
All elements must be described in ``{BundleName}/Tests/Behat/behat.yml`` the following way:

.. code-block:: yaml
   :linenos:

    oro_behat_extension:
      elements:
        Login:
          selector: '#login-form'
          class: Oro\Bundle\TestFrameworkBundle\Behat\Element\Form
          options:
            mapping:
              Username: '_username'
              Password: '_password'

where:

1. ``Login`` is an element name that MUST be unique.
   The element can be created in context by ``OroElementFactory`` by its name:

   .. code-block:: php
      :linenos:

      $this->elementFactory->createElement('Login')

2. ``selector`` defines how web driver shall find the element on the page.
   By default, when the selector type is not specified, the |css selector| is used.
   XPath selector is also supported and may be provided with the following configuration:

   .. code-block:: yaml
      :linenos:

       selector:
           type: xpath
           locator: //span[id='mySpan']/ancestor::form/

3. The ``class`` namespace for element's class (should be extended from ``Oro\Bundle\TestFrameworkBundle\Behat\Element\Element``).
   When omitted, the ``Oro\Bundle\TestFrameworkBundle\Behat\Element\Element`` class is used by default.

4. ``options`` is an array of additional options that are stored in the ``options`` property of the *Element* class.
   It is highly recommended to supply a class with options mapping for the form elements, as this increases test speed and ensure more accurate field mapping

Mapping Form Fields
^^^^^^^^^^^^^^^^^^^

By default, tests use the |named field selector| to map form fields. Name field selector searched for the field by its id, name, label, or placeholder. You are free to use any selector for form fields mapping or wrap an element into the particular behat element.

.. code-block:: yaml
   :linenos:

    oro_behat_extension:
      elements:
        Payment Method Config Type Field:
          class: Oro\Bundle\PaymentBundle\Tests\Behat\Element\PaymentMethodConfigType
        PaymentRuleForm:
          selector: "form[id^='oro_payment_methods_configs_rule']"
          class: Oro\Bundle\TestFrameworkBundle\Behat\Element\Form
          options:
            mapping:
              Method:
                type: 'xpath'
                locator: '//div[@id[starts-with(.,"uniform-oro_payment_methods_configs_rule_method")]]'
                element: Payment Method Config Type Field

Now you should implement the element's ``setValue`` method:

.. code-block:: php
   :linenos:

    <?php
    namespace Oro\Bundle\PaymentBundle\Tests\Behat\Element;
    use Oro\Bundle\TestFrameworkBundle\Behat\Element\Element;
    class PaymentMethodConfigType extends Element
    {
        /**
         * {@inheritdoc}
         */
        public function setValue($value)
        {
            $values = is_array($value) ? $value : [$value];
            foreach ($values as $item) {
                $parentField = $this->getParent()->getParent()->getParent()->getParent();
                $field = $parentField->find('css', 'select');
                self::assertNotNull($field, 'Select payment method field not found');
                $field->setValue($item);
                $parentField->clickLink('Add');
                $this->getDriver()->waitForAjax();
            }
        }
    }

Now you can use it in a standard step:

.. code-block:: gherkin
   :linenos:

    Feature: Payment Rules CRUD
      Scenario: Creating Payment Rule
        Given I login as administrator
        And I go to System/ Payment Rules
        And I click "Create Payment Rule"
        When I fill "Payment Rule Form" with:
          | Method | PayPal |

Embedded Form Mappings
^^^^^^^^^^^^^^^^^^^^^^

Sometimes, a form appears in the iframe. Behat can switch to the iframe by its id. To fill in the form in the iframe correctly, specify the iframe id in the form options:

.. code-block:: yaml
   :linenos:

      oro_behat_extension:
        elements:
          CustomContactUsForm:
            selector: 'div#page'
            class: Oro\Bundle\TestFrameworkBundle\Behat\Element\Form
            options:
              embedded-id: embedded-form
              mapping:
                First name: 'custom_bundle_contactus_contact_request[firstName]'
                Last name: 'custom_bundle_contactus_contact_request[lastName]'

.. _behat-page-element:

Page Element
^^^^^^^^^^^^

Page element encapsulates the entire web page with its URL and path to the page. Every Page element should extend from ``Oro\Bundle\TestFrameworkBundle\Behat\Element\Page``.

Typical Page configuration:

.. code-block:: yaml
   :linenos:

    oro_behat_extension:
      pages:
        UserProfileView:
          class: Oro\Bundle\UserBundle\Tests\Behat\Page\UserProfileView
          route: 'oro_user_profile_view'

Sample Page class:

.. code-block:: php
   :linenos:

    <?php

    namespace Oro\Bundle\UserBundle\Tests\Behat\Page;

    use Oro\Bundle\TestFrameworkBundle\Behat\Element\Page;

    class UserProfileView extends Page
    {
        /**
         * {@inheritdoc}
         */
        public function open(array $parameters = [])
        {
            $userMenu = $this->elementFactory->createElement('UserMenu');
            $userMenu->find('css', '[data-toggle="dropdown"]')->click();

            $userMenu->clickLink('My User');
        }
    }

Now you can use several meaningful steps:

.. code-block:: gherkin
   :linenos:

    And I open User Profile View page
    And I should be on User Profile View page

.. _behat-fixtures:

Fixtures
--------

Feature Fixtures
^^^^^^^^^^^^^^^^

Whenever behat runs a new feature, the application state is reset to default (see :ref:`Feature isolation <behat-feature-isolation>` for more information): there is only one admin user, one organization, one business unit, and default roles in the database.

The feature tests must rely on data that is available in the application after the oro:install command execution. In most cases, this is not enough.

Thereby you have two ways to get more data in the system: using inline fixtures or alice fixtures.

Inline Fixtures
^^^^^^^^^^^^^^^

You can create any number of entities in the feature tests. The ``FixtureContext`` guesses the entity class, creates the necessary number of objects, and uses |faker| to fill in the required fields when their value was not specified explicitly.

You use both faker and :ref:`entity references <behat-entity-references>` in inline fixtures.

.. code-block:: bash
   :linenos:

    Given the following contacts:
      | First Name | Last Name | Email     |
      | Joan       | Anderson  | <email()> |
      | Craig      | Bishop    | <email()> |
      | Jean       | Castillo  | <email()> |
      | Willie     | Chavez    | <email()> |
      | Arthur     | Fisher    | <email()> |
      | Wanda      | Ford      | <email()> |
    And I have 5 Cases
    And there are 5 calls
    And there are two users with their own 7 Accounts
    And there are 3 users with their own 3 Tasks
    And there is user with its own Account

.. _behat-alice-fixtures:

Alice Fixtures
^^^^^^^^^^^^^^

Sometimes you need many different entities with complex relationships. In such cases, you can use alice fixtures. Alice is a library that allows you to create fixtures in the *yml* format easily.

.. hint:: See |Alice documentation2| for more information.

Fixtures should be located in the ``{BundleName}/Tests/Behat/Features/Fixtures`` directory. To load a fixture before the feature tests execution, add a tag (annotation) that is constructed using the following convention ``@fixture-BundleName:fixture_file_name.yml``, e.g.:

.. code-block:: gherkin
   :linenos:

    @fixture-OroCRMBundle:mass_action.yml
    Feature: Mass Delete records

It is also possible to load fixtures for any other bundles available for application.

For example:

.. code-block:: gherkin
   :linenos:

    @fixture-OroUserBundle:user.yml
    @fixture-OroOrganizationBundle:BusinessUnit.yml
    Feature: Adding attributes for workflow transition

Additionally, Alice allows you to |include files| via extension, so you can import files from other bundles:

.. code-block:: bash
   :linenos:

    include:
        - '@OroCustomerBundle/Tests/Behat/Features/Fixtures/CustomerUserAmandaRCole.yml'

**You should always include fixtures from other bundles with entities that were declared within that bundle see :ref:`Conventions <behat-conventions>`.**

.. _behat-entity-references:

Entity References
^^^^^^^^^^^^^^^^^

You can use references to the entities in both inline and |alice fixtures|.

``{Bundle}\Tests\Behat\ReferenceRepositoryInitializer`` used to create references for objects that already exist in the database.

* It is prohibited to modify or add new entities within Initializer.
* It should implement ``ReferenceRepositoryInitializerInterface`` and should not have dependencies.
* To show all references, use the ``bin/behat --available-references`` command.

The most commonly used references:

* ``@admin`` - Admin user
* ``@adminRole`` - Administrator role
* ``@organization`` - Default organization
* ``@business_unit`` - Default business unit

Health Checkers
---------------

Behat has a native possibility to invoke formatters without executing the tests and hooks.

You can try:

.. code-block:: bash
   :linenos:

    bin/behat --dry-run

This can be useful in case you are not sure that you have declared all the necessary context for your feature.
OroBehatExtension enhances this feature and adds extra functionality.

FixturesChecker
^^^^^^^^^^^^^^^

Each feature can have alice fixtures, :ref:`added by tags <behat-alice-fixtures>`. **FixturesChecker** will check every feature for ability to load fixtures, without actually loading the fixture.

Write a Feature
---------------

Every bundle should contain its own behat tests for features in the ``{BundleName}/Tests/Behat/Features/`` directory.
Every feature is a separate file with the ``.feature`` extension and a specific syntax.

.. hint:: See more at |Cucumber doc reference|.

A feature starts with the following:

* The ``Feature:`` keyword and the feature name (these should stay on the same line),
* An optional description (can be formatted as multiple lines). A meaningful description is highly recommended.

Next goes the feature scenario - a specific example that illustrates a business rule and consists of sequential steps.
In addition to being a test specification and test documentation, a scenario defines the test steps and serves as an executable specification of the system.

Normally, a step starts with **Given**, **When**, or **Then**.

If there are multiple Given or When steps underneath each other, you can use **And** or **But** to organize them into logical groups.
Cucumber does not differentiate between the keywords, but choosing the right one is important for the readability of the scenario as a whole.

.. hint:: Take a look at the login.feature in OroUserBundle: |UserBundle/Tests/Behat/Features/login.feature|.

.. code-block:: gherkin
   :linenos:

    Feature: User login
      In order to login in application
      As an OroCRM admin
      I need to be able to authenticate

    Scenario: Success login
      Given I am on "/user/login"
      When I fill "Login Form" with:
          | Username | admin |
          | Password | admin |
      And I press "Log in"
      Then I should be on "/"

    Scenario Outline: Fail login
      Given I am on "/user/login"
      When I fill "Login Form" with:
          | Username | <login>    |
          | Password | <password> |
      And I press "Log in"
      Then I should be on "/user/login"
      And I should see "Invalid user name or password."

      Examples:
      | login | password |
      | user  | pass     |
      | user2 | pass2    |


1. The line ``Feature: User login`` starts the feature and gives it a title.
2. Behat does not parse the following three lines of text: In order to... As an... I need to... These lines provide a human-readable context to the people who will review or modify this feature. They describe the business value derived from the inclusion of the feature into the software.
3. The line ``Scenario: Success login`` starts the scenario and provides a description for it.
4. The next six lines are the scenario steps. Every step is matched to a regular expression defined in the Context.
5. The line ``Scenario Outline: Fail login`` starts the next scenario. In the scenario outline, the placeholders are used instead of the actual values, and the values for scenario execution are provided as a set of examples below the outline. Scenario Outlines helps you run these steps several times, iterating through the values provided in the ``Examples:`` section and thus testing the same flow with different input.  The Scenario Outline is a template which is never run on its own. Instead, a Scenario that follows an outline runs once for each row in the Examples section beneath it (except for the first header row that is skipped). Think of a placeholder as a variable. It is replaced with a real value from the ``Examples:`` table row, where the text between the placeholder angle brackets (e.g., <login>) matches the text of the table column header (e.g., login).

Troubleshooting
---------------

Increase application performance (Ubuntu)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Behat has :ref:`isolators <behat-feature-isolation>` to make behat features independent of each other.
One of those isolators is the database. It creates a database dump before the execution start, then drops it and restores it from the dump after each feature.
This can take a while (up to 2 minutes on slow SSD). If you run behat tests often you would like to decrease this time.
To boost the database isolator, you can mount the database directory to RAM. In the illustration below, we use |tmpfs|:

Create a tmpfs directory:

.. code-block:: bash
   :linenos:

   sudo mkdir /var/tmpfs
   sudo mount -t tmpfs -o size=4G tmpfs /var/tmpfs

Edit ``/etc/mysql/mysql.conf.d/mysqld.cnf``

.. code-block:: ini
   :linenos:

   datadir = /var/tmpfs/mysql

Add new storage to ``/etc/fstab``:

.. code-block:: ini
   :linenos:

   tmpfs  /var/tmpfs  tmpfs  nodev,nosuid,noexec,noatime,size=4G  0 0

Copy MySQL to tmpfs:

.. code-block:: bash
   :linenos:

   sudo service mysql stop
   sudo cp -Rfp /var/lib/mysql /var/tmpfs

We need to tell AppArmor to let MySQL write to the new directory by creating an alias between the default directory and the new location.

.. code-block:: bash
   :linenos:

   echo "alias /var/lib/mysql/ -> /var/tmpfs/mysql," | sudo tee -a /etc/apparmor.d/tunables/alias

For the changes to take effect, restart AppArmor:

.. code-block:: bash
   :linenos:

   sudo systemctl restart apparmor

Now you can start MySQL again:

.. code-block:: bash
   :linenos:

   sudo service mysql start

(optional) Create Startup Script
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

After you restart the computer, all the data and the database structure gets lost. Therefore, you should copy data directory manually after every restart. Alternatively, you can create a startup script that may be launched automatically as a systemd service.

To prepare for auto-recovery using a startup script:

1. Create a mysql_copy_tmpfs.sh in the bin directory (e.g. /usr/local/bin):

   .. code-block:: bash
      :linenos:

      #!/bin/bash
      cp -Rfp /var/lib/mysql /var/tmpfs

2. Create a unit configuration file */etc/systemd/system/mysql_copy_tmpfs.service* that will schedule priority of the service execution before the MySQL starts:

   .. code-block:: gherkin
      :linenos:

      [Unit]
      Description=Copy mysql to tmpfs
      Before=mysql.service
      After=mount.target

      [Service]
      User=mysql
      Type=oneshot
      ExecStart=/bash/script/path/mysql_copy_tmpfs.sh

      [Install]
      WantedBy=multi-user.target

3. Once you have created the files, enable the configured service:

   .. code-block:: bash
      :linenos:

      systemctl enable mysql_copy_tmpfs.service

   It starts automatically after rebooting the machine.

Couldn't generate random unique value for Oro\Bundle\UserBundle\Entity\User: username in 128 tries
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A hot fix:

Check your fixture.
Remove (unique) suffix in entity property in entity fixture, like in the following example:

**Incorrect fixture**:

.. code-block:: yaml
   :linenos:

   Oro\Bundle\UserBundle\Entity\User:
       charlie:
         firstName: Marge
         lastName: Marge Simpson
         username (unique): marge228

**Corrected fixture**:

.. code-block:: yaml
   :linenos:

   Oro\Bundle\UserBundle\Entity\User:
       charlie:
         firstName: Marge
         lastName: Marge Simpson
         username: marge228

**Route cause**

Alice remembers all the values for the given entity property and tries to generate a unique value, but this causes issues when there is just one value for the entity property.

This option still may be used if combined with the autogenerated fake value, like in the following example:

.. code-block:: yaml
   :linenos:

   Oro\Bundle\UserBundle\Entity\User:
       charlie:
         firstName (unique): <firstName()>
         lastName: Marge Simpson
         username: marge228

Append snippets
^^^^^^^^^^^^^^^

The feature development consists of the following design stages:

- Create a draft of the feature: implement a high-level scenario that covers the story.
  At this stage, you should have a clear understanding of the business outcome that is achieved by the feature test automation.

- Specify all the scenarios that may happen when using the feature. Exact steps are not necessary.

- Finalize the big picture of the implementation and plan the individual steps.

Some of the steps may already be fully automated. Ideally, you should automate the missing steps after you plan using them in your feature test scenarios. If the feature functionality is already implemented, it is necessary to implement the behat steps involved in the feature testing.

However, sometimes it is impossible to do right away (because of the incomplete feature implementation, blocking issues, or missing information). In this case, you can temporarily mock the steps that are missing implementation.

A quick way to do so is to dry-run your feature tests. In the console, run the following command:

.. code-block:: bash
   :linenos:

   bin/behat path/to/your.feature --dry-run --append-snippets --snippets-type=regex


The feature is executed in the *--dry-run* mode, and at the final stage of execution, you are prompted to add undefined steps mock implementation to one of the existing contexts.

How to find the necessary step
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you design test automation scenarios for the new feature, you may have trouble finding steps to reuse from the hundreds of already automated steps. Use the tips below to find the necessary step.

Auto Suggestion in PhpStorm
~~~~~~~~~~~~~~~~~~~~~~~~~~~

While designing a scenario in the feature file, PhpStorm offers you hints on the implemented steps that match the keywords.  E.g., when you type *grid* or *form*, the steps that involve these items pop up in the suggestions block.

.. image:: /img/backend/tests/phpstorm_step_suggestion.png
   :alt: PhPStorm step suggestion

If PhpStorm does not offer you any hints as you type, please, verify the following:

1. You have installed vendors for at list one application
2. You have installed behat plugin for PhpStorm

Find the Necessary Context
~~~~~~~~~~~~~~~~~~~~~~~~~~

Every Context class should implement the ``Behat\Behat\Context\Context`` interface. Get the list of implemented contexts and find the necessary one by name.

.. image:: /img/backend/tests/context_implements_interface.png
   :alt: Context implements interface

.. image:: /img/backend/tests/find_context.png
   :alt: Find context file

Usually, the name of context is self-explanatory, e.g., GridContext, FormContext, ACLContext, etc.

Use Grep in Console
~~~~~~~~~~~~~~~~~~~

If, for any reason, you do not use PhpStorm or behat plugin, you can still find the necessary step by filtering the output of the command that previews all the feature steps (use Grep).

Type the following command in your console:

.. code-block:: bash
   :linenos:

   bin/behat -dl -s AcmeDemoBundle | grep "flash message"

.. image:: /img/backend/tests/grep_flash_messages.png
   :alt: Grep flash messages in the console

.. code-block:: bash
   :linenos:

   bin/behat -dl -s AcmeDemoBundle | grep "grid"

.. image:: /img/backend/tests/grep_grid.png
   :alt: Grep flash messages in the console

You can use the behat command-line interface only after you install the application.

.. include:: /include/include-links-dev.rst
   :start-after: begin

