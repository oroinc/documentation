:title: Cron Setup and Configuration in Oro Applications

.. meta::
    :description: Instructions on the time-based cron jobs setup and configuration in the Oro applications for the backend developers

.. _dev-guide-system-cron-jobs:

Cron
====

More often than not, it is essential to run regular time-based background jobs in business applications. These jobs can be maintenance tasks, such as checking for updates or synchronizing data between integrated systems, and business-related tasks, such as generating reports, sending emails, or making timely-based shifts in tasks determined by your business process flows.

The nature and algorithms of these timely-based tasks can be diverse and complicated, and the obvious way of implementing these jobs is to create specific program components.

Therefore, to strengthen the task to create and schedule such components, OroPlatform provides the :ref:`OroCronBundle <bundle-docs-platform-cron-bundle>` . With its help, it is considerably easier to run Symfony Console commands through cronjobs (on UNIX-based operating systems) or the Windows task scheduler.

The OroCronBundle provides two interfaces that help to implement console commands that should be executed by the cron:

- |CronCommandScheduleDefinitionInterface| allows defining the console command along with its schedule in a crontab compatible string in the command class.
- |CronCommandActivationInterface| allows defining a conditional logic for the cron command.

The **oro:cron:definitions:load** command scans for all commands from the oro:cron namespace that implements the |CronCommandScheduleDefinitionInterface|. For each detected command, a new |Schedule| entry is created and saved into the database. This command runs on install and update, and can also be run manually if some cron commands or command definitions are changed.

The second command is **oro:cron**. It takes all schedules from the database (created by the oro:cron:definitions:load command) and adds the commands that are due to the Message Queue. This command should run every minute.

.. note:: Please notice that oro:cron:definitions:load removes all previously loaded commands from the database. So if other commands add cron commands to the db (such as oro:workflow:definition:load), they should be run after **oro:cron:definitions:load**.

Setup and Configuration
-----------------------

To run a set of commands from your application regularly, configure your system to run the **oro:cron** command every minute.

* For UNIX-based systems, set up a crontab entry, as illustrated below:

    .. code-block:: none

        */1 * * * * /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

    .. note:: Some OS flavors require a username (usually root) in the crontab entry:

        .. code-block:: none

            */1 * * * * root /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

* For Windows, use the Control Panel to configure the Task Scheduler to do the same.

    .. note:: This entry in the crontab does not presuppose the execution of cron commands every minute. The oro:cron command only ensures that the actual commands are added to the scheduler which in its turn makes sure that they are executed at desired time.

.. _dev-cookbook-system-cron-create-commands:

Scheduled Commands in OroPlatform
---------------------------------

A scheduled command in OroPlatform is a regular Symfony console command that implements additional |CronCommandScheduleDefinitionInterface| and has the **oro:cron** namespace.

Implementing |CronCommandScheduleDefinitionInterface| requires the implementation of the **getDefaultDefinition()** method. It returns the |crontab compatible| description of when the command should be executed. For example, if a command should run every day five minutes after midnight, the appropriate
value is **5 0 \* \* \***.

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Command/SomeCronCommand.php

    namespace Acme\Bundle\DemoBundle\Command;

    use Oro\Bundle\CronBundle\Command\CronCommandScheduleDefinitionInterface;
    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class SomeCronCommand extends Command implements CronCommandScheduleDefinitionInterface
    {
        protected static $defaultName = 'oro:cron:acme_demo_some';

        /**
         * {@inheritDoc}
         */
        public function getDefaultDefinition(): string
        {
            return '5 0 * * *';
        }

        /**
         * {@inheritDoc}
         */
        protected function configure()
        {
            // ...
        }

        /**
         * {@inheritDoc}
         */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            // ...
        }
    }

Conditional Activation of Cron Commands
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, all cron commands are executed every time when the cron triggers it. But sometimes it is required
to execute a command only when certain conditions are met.
In this case a cron command should implement |CronCommandActivationInterface| interface and provide the custom activation logic in the **isActive()** method.

Synchronous Cron Commands
^^^^^^^^^^^^^^^^^^^^^^^^^

By default, **all cron commands are executed asynchronously** by sending a message to the queue.

Sometimes it is necessary to execute a cron command **immediately** when cron triggers it, without sending the message
to the queue.

To do this, a cron command should implement the |SynchronousCommandInterface| interface. In this case, the command will be executed as a background process.

.. note:: Please note that the synchronous commands must be designed well-performed and should not block process execution as it may affect scheduled execution of other commands.

Scheduling Cron Commands in DB
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

After creating the cron commands classes, run the **oro:cron:definitions:load** command to schedule the created
command in the DB. After that, the cron command will be ready to evaluate and execute it during the next **oro:cron** command tick.

**Related Topics**

* :ref:`View the List of Scheduled Tasks in UI <book-time-based-command-execution>`



.. include:: /include/include-links-dev.rst
    :start-after: begin
