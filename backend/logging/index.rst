.. _dev-guide-system-logging:

Logging
=======

.. wiki/spaces/ORODEV/pages/132579356/Logger+Conventions

Logging Strategy: What to Log
-----------------------------

Let us assume that in your logging strategy, you are building a diagnostics toolkit that will give you enough information for the worst case scenario. You will be able to diagnose a non-reproducible problem after it has happened. You will know the state of the critical services and you will be able to spot when a critical component or an integration went down and got unresponsive. You will know where exactly in the process you got a failure and what context and data the system was handling at the time.

To be on the safe side, log the following:

* Business operations with detailed context for every step
* Transitions (workflow transition, user banned, checkout completed)
* Integration points (calls, availability, response time)
* Resources availability (limit reached, capacity exhausted)
* Service availability (startup, shutdown, response time)
* Input and output (if it helps to find an issue)

.. danger::
    **Avoid Logging Sensitive Information**

    Never log sensitive data. Under any circumstances. Always use data anonymization or encryption to secure customer identities and their sensitive business-critical information.

Basics
------

Use Monolog logger that implements the PSR-3 LoggerInterface, de facto logging standard defined in the php-fig/log package. For an overview, please, check out logging in Symfony where we borrowed this example:

.. code:: php

   $logger->critical('I left the oven on!', [
       // include extra "context" info in your logs
       'cause' => 'in_hurry',
   ]);

Debug, info, notice, warning, error, critical, and alert methods have two arguments:

* A string with a human readable message.
* An array of the context variables with values that can help in resolving an issue.

Using Logger
------------

#. If your class provides any kind of extensibility without class modification by dispatching events or providing extensions system, add the logger as an extension or an event listener, do not inject it into the main service.
#. Inject logger to the constructor of the extension or the main service as a required dependency if you are able to change the class signature, otherwise use LoggerAwareInterface.

   You can be restricted to call __constructor() in case it is private or instantiated not using service container, by CompilerPass or factory that are not under your control etc.

#. In service container configuration, add logger (@logger) as a required argument to the constructor or in setter in case LoggerAwareInterface was used:

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

   You can reuse an existing channel only to override or extend the existing logger aware service.

#. If LoggerAwareInterface was used, every logger method call should be wrapped with the following check to ensure that the logger exists and no exceptions are triggered due to its unavailability:

   .. code:: text

      if (null !== $this->logger){
          $this->logger->debug($message, $context);
      }

#. Messages should be simple and human-readable. Any extra information should be passed in the context variables:

   .. code:: text

      $this->logger->debug(
          'Authentication failure, forward triggered.',
          ['failure_path' => $path]
      );

#. When you need a user-friendly message on production instead of a real one, use the following approach (see this sample): when something goes wrong for the user but the system is still usable, display a message similar to "Something has gone wrong, contact the system administrator" and log the real exception to facilitate the future debug process.

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

Log message should contain a short description of the action that happened. The data that define action context (e.g. who triggered the action, what the execution result was, etc.) should be placed in context variables (second parameter in LoggerInterface methods).

Do not use sprintf() to add variables to the message. Use placeholders instead and put variables into the context. This way, the message stays readable for both human and machine.

Placeholder rules:

* The message MAY contain placeholders which implementors MAY replace with values from the context array.
* Placeholder names MUST correspond to the keys in the context array.
* Placeholder names MUST be delimited with a single opening brace { and a single closing brace }. There MUST NOT be any whitespace between the delimiters and the placeholder name.
* Placeholder names SHOULD be composed only of the the following characters: A-Z, a-z, 0-9, underscore _, and period.

Context
-------

In a context array, you may pass any additional information about the trigger event and its accompanying circumstances. Here are general recommendations:

* Avoid overly lengthy objects in context. Use normalization to keep only useful information.
* Leave out any sensitive data, like user credentials.
* Use the 'exception' key for passing the Exception object (this is a MUST).
* When adding a resource, use only the ID and the information that is supposed to change as a result of the operation.

**Precaution**: Building a value for the context must neither throw an exception nor raise any php errors, warnings or notices.

Log Levels
----------

Emergency
^^^^^^^^^

Use LogLevel::EMERGENCY when the system becomes unusable.

Alert
^^^^^

Use LogLevel::ALERT when the situation calls for an immediate action. For example, the entire website is down or the database is unavailable (network connection or a database server is down). Messages of the Alert level should wake you up. They can trigger the SMS alert or notify you in any other perceptible way.

Critical
^^^^^^^^

Use LogLevel::CRITICAL to register any critical conditions. For example, you can log a critical message when the application component became unavailable, or when you are handling an unexpected exception that should not be displayed to a user (e.g. 500 Internal server error).

Error
^^^^^

Use LogLevel::ERROR for logging runtime errors that do not require immediate action but should typically be logged and monitored for a further investigation. Potential triggers for logging an error are the following:

* An expected or scheduled operation was not executed (e.g. a batch action that failed before processing any records; external API is not responding; external API response is unexpected and cannot be handled by the system).
* An unexpected exception occurred but did not lead to unwanted messages shown to the user (like 500 Internal server error).

Warning
^^^^^^^

Use LogLevel::WARNING to capture disturbing situations that are not errors:

* Incomplete operation processing (e.g. only a portion of the batch was processed).
* Expected or handled exceptions that record a non-optimal or inefficient operation, for example:

  * Deprecated API is used.
  * API is misused (wrong parameters, unsupported input values).
  * Something is done in a non-recommended way which is not necessarily wrong.
  * Action or operation that takes longer than usual.
  * Import data contains additional unknown fields and the system ignores them as it is not programmed to handle these extra data.

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
* Email is sent
* External API request is sent

Debug
^^^^^

Messages with LogLevel::DEBUG provide additional detailed debug information for the events that are logged on a higher level (info, notice, warning, error, critical, and alert). This information is usually logged only to dev.log or Symfony profiler.

Logging Exceptions
^^^^^^^^^^^^^^^^^^

You should not throw the |SPL| exceptions, but create more specific, based on them, and throw only these custom specific exceptions (like ``\Oro\Bundle\EntityMergeBundle\Exception\OutOfBoundsException``). For logging these, the DEBUG log level is usually used.

In exceptional circumstances, catch SPL exception classes (like \Exception, \OutOfBoundsException) only when you really intend to handle all exceptions in a same unified manner. Log them with the ERROR log level and re-throw on debug mode, if possible.

Do not catch exceptions just for logging, as Symfony handles uncaught exceptions for you.

Correct Exception Handling and Logging
--------------------------------------

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


Enable Logger Only on Dev Environment
-------------------------------------

Usually it can be necessary for services that log with INFO and above levels and include logger, as the dependency will affect production performance.

You should add the logger in the Decorator of the service and replace the original one with it in the container at CompilerPass based on the environment variable and logger availability. For example, check "Symfony\Component\Translation\LoggingTranslator" that replaces the original "Symfony\Component\Translation\Translator" in "Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\LoggingTranslatorPass" based on the container parameter.

Additional Information
----------------------

|How to Do Application Logging Right|


.. include:: /include/include-links-dev.rst
   :start-after: begin
