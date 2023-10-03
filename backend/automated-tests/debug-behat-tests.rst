.. _debug-behat-tests:

Debugging Behat Tests
=====================

Debugging behat tests is sometimes necessary for:

- Identifying Test Failures. Debugging allows you to pinpoint the exact cause of test failures. By examining failing tests, you can determine whether the issue lies in the application code or the test scenario itself.

- Verifying Test Logic. Behat tests are written in a high-level language that mirrors user behavior. Debugging helps verify that the test logic accurately represents the desired user actions and expected outcomes.

- Handling Dynamic Elements. Modern web applications often contain dynamic elements such as AJAX-based content or dynamically generated IDs. Debugging allows you to inspect these elements during test execution and ensure that your tests interact with the correct elements.

- Troubleshooting Environment Issues. Debugging can help identify environmental factors that impact test execution, such as server configuration, network connectivity, or compatibility issues with third-party dependencies.

How to Debug Behat Tests
------------------------

Enable Very Verbose Output
^^^^^^^^^^^^^^^^^^^^^^^^^^

You can increase the output verbosity to see more details on what's going on by adding the ``-v``, ``-vv``, or ``-vvv`` option to ``php bin/behat``.
This enables verbose, very verbose, or very very verbose output accordingly.

- ``-v, --verbose[=VERBOSE]`` -- Increase verbosity of exceptions.

.. code-block:: bash

    php bin/behat path/to/your.feature -vv

Review Error Messages
^^^^^^^^^^^^^^^^^^^^^

When a test fails, Behat provides error messages that can give you insights into the cause of failure. Analysis of error messages, stack traces, and exception details can help identify specific issues in your test scenarios or application code.

Isolate the Problem
^^^^^^^^^^^^^^^^^^^

If you encounter a failing test, reproduce the issue in isolation. Simplify the scenario or remove unnecessary steps to identify the specific step or condition causing the failure. This approach helps narrow down the problem and focus your debugging efforts.

Logging and Dumping Variables
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Behat supports logging and variable dumping during test execution. By strategically adding logging statements or using built-in functions like ``dump()``, you can inspect the values of variables, objects, or page elements at specific points in your test scenarios. This technique helps you understand the state of the application during test execution.

Interactive Debugging
^^^^^^^^^^^^^^^^^^^^^

Behat can integrate with debugging tools like Xdebug or Zend Debugger. By configuring your environment and IDE appropriately, you can set breakpoints within your test code and step through it line by line. This method allows for real-time inspection of variables, execution flow, and overall test behavior.

An example of setting up a debugging environment:

.. image:: /img/backend/tests/behat_configuration.png
    :alt: Behat configuration

Running a Group of Behat Tests
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can also run a group of tests. For this purpose, mark them with the right tag (for example, @failed-behat-test) and run the test with it.

.. image:: /img/backend/tests/behat_configuration_with_tag.png
    :alt: Behat configuration with tag

Taking Screenshots
^^^^^^^^^^^^^^^^^^

To see the browser page state at the exact moment, you can capture a screenshot during the execution of a Behat scenario use the following step:

.. code-block:: gherkin

  And I take screenshot

This step allows you to capture a snapshot of the current page.

.. code-block:: gherkin

  Scenario: Create new user
    Given I login as administrator               # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::loginAsUserWithPassword()
    And go to System/User Management/Users       # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iOpenTheMenuAndClick()
    And I take screenshot                        # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iTakeScreenshot()
      │ Screenshot: http://commerce-crm-ee.loc/media/behat/image6479bdb28341c221899532.png
    And click "Create User"                      # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::pressButton()
    When I fill "User Form" with:                # Oro\Bundle\FormBundle\Tests\Behat\Context\FormContext::iFillFormWith()
      | Username          | userName       |
      | Password          | Pa$$w0rd       |
      | Re-Enter Password | Pa$$w0rd       |
      | First Name        | First Name     |
      | Last Name         | Last Name      |
      | Primary Email     | email@test.com |
      | Roles             | Administrator  |
      | Enabled           | Enabled        |
    And I save and close form                    # Oro\Bundle\FormBundle\Tests\Behat\Context\FormContext::iSaveAndCloseForm()
    Then I should see "User saved" flash message # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iShouldSeeFlashMessage()


You can take screenshots in other Contexts steps for more precise results by using the ``ScreenshotTrait`` and calling the ``ScreenshotTrait::takeScreenshot`` method.

.. code-block:: gherkin

  Scenario: Create new user
    Given I login as administrator               # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::loginAsUserWithPassword()
      │ Screenshot: http://commerce-crm-ee.loc/media/behat/image6479bdaf3b968129573073.png
    And go to System/User Management/Users       # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iOpenTheMenuAndClick()
    And click "Create User"                      # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::pressButton()
    When I fill "User Form" with:                # Oro\Bundle\FormBundle\Tests\Behat\Context\FormContext::iFillFormWith()
      | Username          | userName       |
      | Password          | Pa$$w0rd       |
      | Re-Enter Password | Pa$$w0rd       |
      | First Name        | First Name     |
      | Last Name         | Last Name      |
      | Primary Email     | email@test.com |
      | Roles             | Administrator  |
      | Enabled           | Enabled        |
    And I save and close form                    # Oro\Bundle\FormBundle\Tests\Behat\Context\FormContext::iSaveAndCloseForm()
    Then I should see "User saved" flash message # Oro\Bundle\TestFrameworkBundle\Tests\Behat\Context\OroMainContext::iShouldSeeFlashMessage()


Stop the Execution of the Behat Script at a Required Place
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To stop the behat script at some point (e.g., you have some steps that are not implemented and you click through them manually, then continue the behat, or you need to see the position of the element on the page), you can use a step ``I wait for action``.

  .. code-block:: gherkin

     And I wait for action

In the console where the test is running, the message "Press [RETURN] to continue..." will appear.
After performing the necessary actions, the behat script continues to run.
Run tests only locally and for debugging purposes.

Debugging behat tests is an essential skill for ensuring the reliability and effectiveness of your BDD test suite.

.. hint:: The screenshots created during failed Behat tests include the cursor the last position mouse when moving the mouse around, except for situations when there are alerts on the page. This helps identify where the failure occurred, making it quicker to take corrective action.

    .. image:: /img/backend/tests/cursor_position_at_failed_behat_tests.png
        :alt: Cursor position at failed behat tests
