.. _community--contribute--logging-conventions:

Logging Conventions
===================

.. wiki/spaces/ORODEV/pages/132579356/Logger+Conventions

Basics
------

Use Monolog logger that implements the PSR-3 LoggerInterface, de-facto logging standard defined in php-fig/log package. For an overview, please, see logging in Symfony, where we borrowed this sample:

.. code:: php

   $logger->critical('I left the oven on!', array(
       // include extra "context" info in your logs
       'cause' => 'in_hurry',
   ));

Debug, info, notice, warning, error, critical, and alert methods have two arguments:
* A string with a human readable message.
* An array of the context variables with values that can help in resolving an issue.

How to Use Logger
-----------------

#. In case your class provide any kind of extensibility without class modification, by dispatching events or providing extensions system, add logger as extension or event listener, do not inject it to the main service.
#. Inject logger to the constructor of extension or main service as required dependency if you free to change class signature, otherwise use LoggerAwareInterface.
   You can be restricted to call __constructor() in case it is private or instantiated not using service container, by CompilerPass or factory that are not under your control etc.
#. In service container configuration add logger (@logger) as required argument to constructor or in setter in case LoggerAwareInterface used:

   **Constructor injection**

   .. code:: text

      services:
          acme.logger_aware_service:
              class:     AcmeBundle\Foo\BarLoggerAwareService
              arguments: ['@logger']

   *Setter injection*

   .. code:: text

      services:
          acme.logger_aware_service:
              class:     AcmeBundle\Foo\BarLoggerAwareService
              calls:
                  - [setLogger, ['@logger']]

#. Every independent component should use its own channel with the *oro_* prefix:

   .. code:: text

      tags:
          - { name: monolog.logger, channel: oro_api }

   You can reuse existing channel only to override or extend the existing logger aware service.

#. If LoggerAwareInterface was used, every logger method call should be wrapped with the following check to ensure that the logger exists, and no exceptions are triggered due to its unavailability:

   .. code:: text

      if (null !== $this->logger){
          $this->logger->debug($message,  $context);
      }

#. Messages should be simple and human-readable. Any extra information should be passed in the context variables:

   .. code:: text

      $this->logger->debug(
          'Authentication failure, forward triggered.',
          array('failure_path'=>$path)
      );

#. When you need a user-friendly message on production instead of a real one, use the following approach (see this sample): when something goes wrong for the user, but the system is still usable, display a message like "Something has gone wrong, contact the system administrator" and log the real exception to facilitate the future debug process.
   You can use this approach when:

      * A form was submitted but the expected action was stopped which led to the exception.
      * A system is not able to save the record to the database because of a MySQL error (for example, when you use a non-unique key).
      * A system fails to send a message to the queue, or the queue does not respond.
      * A system fails to send an external request or a third-party API did not respond or responded with an unexpected message.
      * Etc.

#. Preserve the context. Always place your logging calls next to the actions it logs, in the same method or class. Avoid logging the operation progress, input, or outcome in the external class that triggers operation execution.
#. It is recommended to use debug, info, notice, warning, error, critical, and alert methods defined in LoggerInterface with a specified log level instead of the log() method.

Message
-------

Log message should contain a short description of the action that happened. The data that define action context (e.g. who triggered action, what was the execution result, etc) should be placed in context variables (second parameter in LoggerInterface methods).

Do not use sprintf() to add variables to the message. Use placeholders instead and put variables into the context. This way, the message stays readable for both human and machine.

Placeholder rules:

* The message MAY contain placeholders which implementors MAY replace with values from the context array.
* Placeholder names MUST correspond to keys in the context array.
* Placeholder names MUST be delimited with a single opening brace { and a single closing brace }. There MUST NOT be any whitespace between the delimiters and the placeholder name.
* Placeholder names SHOULD be composed only of the characters A-Z, a-z, 0-9, underscore _, and period.

Context
-------

In a context array, you may pass any additional information about the trigger event and its accompanying circumstances. Here are general recommendations:

* Avoid overly lengthy objects in context. Use normalization to keep only useful information.
* Leave out any sensitive data, like user credentials.
* Use 'exception' key for passing the Exception object (this is a MUST).
* When adding a resource, use only the id and the information that is supposed to change as a result of the operation.

**Precaution**: Building a value for the context must neither throw an exception nor raise any php error, warning or notice.

Log Levels
----------

Emergency
^^^^^^^^^

Use LogLevel::EMERGENCY when the system becomes unusable.

Alert
^^^^^

Use LogLevel::ALERT when the situation calls for immediate action. For example, the entire website is down or the database is unavailable (network connection or a database server is down). Messages of Alert level should wake you up. It could trigger the SMS alert or notify you in any other perceptible way.

Critical
^^^^^^^^

Use LogLevel::CRITICAL to register any critical conditions. For example, you can log a critical message when the application component became unavailable, or when you are handling an unexpected exception that should not be displayed to a user (e.g. 500 Internal server error).

Error
^^^^^

Use LogLevel::ERROR for logging runtime errors that do not require immediate action but should typically be logged and monitored for further investigation. Potential triggers for logging an error are the following:

* an expected or scheduled operation was not executed (e.g. a batch action that failed before processing any records; external API is not responding; external API response is unexpected and cannot be handled by the system).
* an unexpected exception occurred but did not lead to unwanted messages shown to the user (like 500 Internal server error).

Warning
^^^^^^^

Use LogLevel::WARNING to capture disturbing situations that are not errors:
* incomplete operation processing (e.g. only a portion of the batch was processed).
* expected or handled exceptions that record a non-optimal or inefficient operation, for example:

  * deprecated API is used.
  * API is misused (wrong parameters, unsupported input values).
  * something is done in a non-recommended way which is not necessarily wrong.
  * action or operation that takes longer than usual.
  * import data contains additional unknown fields and the system ignores them as it is not programmed to handle these extra data.

Notice
^^^^^^

Use LogLevel::NOTICE to record extremely significant events or high-level business operations that were executed successfully, for example:

* Import is complete
* Final transition in the workflow is complete
* Payment was sent successfully

Info
^^^^

Use LogLevel::INFO to record events of moderate significance or intermediate steps of the business process, for example:

* User logs in
* Action is complete
* Workflow transition is complete
* Email is send
* External API request is sent

Debug
^^^^^

Messages with LogLevel::DEBUG provides additional detailed debug information for the events that are logged on a higher level (info, notice, warning, error, critical, and alert). This information is usually logged only to dev.log or to the Symfony profiler.

Logging Strategy: What Should Be Logged
---------------------------------------

To get this right, think of yourself some day in the past (or future) facing a customer problem. Let us make it late night and severely urgent.
In your logging strategy, you are building a diagnostics toolkit that will give you enough information for the worst case scenario. You will be able to diagnose a non-reproducible problem after it has happened. You will know the state of the critical services and you will be able to spot when a critical component or integration went down and got unresponsive. You will know where exactly in the process you got a failure and what context and data were the system handling at the time.

To be on the safe side, log the following:

* Business operations with detailed context for every step
* Transitions (workflow transition, user banned, checkout completed)
* Integration points (calls, availability, response time)
* Resources availability (limit reached, capacity exhausted)
* Service availability (startup, shutdown, response time)
* Input and output (if it helps to find an issue)

Logging Exceptions
^^^^^^^^^^^^^^^^^^

Throw only custom extended from SPL exceptions (like \Oro\Bundle\EntityMergeBundle\Exception\OutOfBoundsException). For logging these, usually used DEBUG log level.
In exceptional circumstances, catch SPL exception classes (like \Exception, \OutOfBoundsException) only when you really intend to handle all exceptions in a same unified manner. Log them with ERROR log level and re-throw on debug mode if possible.
Do not catch exceptions just for logging, as Symfony handles uncaught exceptions for you.

Examples of Correct Exception Handling and Logging
--------------------------------------------------

Example 1
^^^^^^^^^

.. code:: php

   <?php
   // in case of injection logger to constructor
   // do some work

   catch (\Exception $e) {
       $this->logger->error($message, ['exception'=> $e]);
       // optionally
       $this->session->getFlashBag()->add('warning', $message);
       // recover
   }

Example 2
^^^^^^^^^

.. code:: php

   <?php
   // in case of using LoggerAwareInterface
   // do some work

   catch (\Exception $e) {
       if (null !== $this->logger){
           $this->logger->error($message, ['exception'=> $e]);
       }
       // optionally
       $this->session->getFlashBag()->add('warning', $message);
       // recover
   }

Example 3
^^^^^^^^^

.. code:: php

   <?php
   // do some work

   catch (MyCustomExpectedException $e) {
       $this->logger->error($message, ['exception'=> $e]);
       // recover
   }


Incorrect Exceptions Handling
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Handling exceptions without logging is incorrect:

.. code:: php

   <?php
   // do some work
   catch (Exception $e) {
   }

   <?php
   // do some work
   catch (Exception $e) {
       // do some work without logging
   }


How to Enable Logging for CLI Commands
--------------------------------------

Input of cli command will be logged automatically by OroPlatform.
Uncaught exceptions will be logged automatically as well.
Log command output to DEBUG level only if it short and is necessary for debugging while command input is known.
In case you need to log some extra information your command should extend Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand so you'll be able to get logger from container (see example `here <http://symfony.com/doc/current/console/logging.html#manually-logging-from-a-console-command>`_).

How to Enable Logger Only on Dev Environment
--------------------------------------------

Usually it can be necessary for services that log with INFO and above levels and including logger as dependency will affect production performance.
You should add logger in Decorator of the service and replace the original one with it in the container at CompilerPass based on the environment variable and logger availability. For example check "Symfony\Component\Translation\LoggingTranslator"  that replace original "Symfony\Component\Translation\Translator" in "Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\LoggingTranslatorPass" based on container parameter.

Avoid Logging Sensitive Information
-----------------------------------

Never log sensitive data. Under any circumstances. We mean it. Use data anonymizing or encryption to secure customer identity and their sensitive business-critical information.

Additional Information
----------------------

`How to Do Application Logging Right <http://arctecgroup.net/pdf/howtoapplogging.pdf>`_
