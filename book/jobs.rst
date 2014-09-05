Job Execution
=============

.. index::
    double: Cron Jobs ; Command
    double: Task Scheduler ; Command

Time-Based Command Execution
----------------------------

You'll often have tasks that should be executed at fixed times (for example,
sending mailings to customers or generating reports). Usually, these tasks
wouldn't be performed by visiting a particular URL using your browser. Instead,
you'll configure your operating system to execute some script which performs
the desired tasks.

With the Oro Platform, you can use the `OroCronBundle`_ which makes it easy
to run Symfony Console commands through cronjobs (on UNIX-based operating
systems) or through the Windows task scheduler.

Configuring the Entry Point Command
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

All you have to do to regularly run a set of commands from your application
is to configure your system to run the ``oro:cron`` command every minute.
On UNIX-based systems, you can simply use the Crontab for this:

.. code-block:: text

    */1 * * * * /path/to/php /path/to/app/console oro:cron --env=prod > /dev/null

On Windows, use the Control Panel to configure the Task Scheduler to do the
same.

.. note::

    This entry in the crontab doesn't mean that your cron commands are executed
    every minute. The ``oro:cron`` command only makes sure that the actual
    commands are added to the scheduler which makes sure that they are only
    executed at the desired times (see :ref:`How Does it Work <sidebar-cron-work>`
    for some insights into the actual process).

.. _sidebar-cron-work:

.. sidebar:: How Does it Work?

    When executed, the ``oro:cron`` command is the entry point for all cron
    commands (:ref:`built-in commands <built-in-cron-commands>` as well as
    :ref:`self-created commands <create-cron-command>`). It scans for all
    commands from the ``oro:cron`` namespace that implement the ``CronCommandInterface``.
    For each found command, a new ``Schedule`` entry is created registered
    at the cron ``Daemon``. The ``Daemon`` is a background process that manages
    a :ref:`queue <job-queues>` of all open jobs and ensures that each job
    is executed at the appropriate times.

.. _create-cron-command:

Creating the Command
~~~~~~~~~~~~~~~~~~~~

The ``oro:cron`` command will automatically execute all registered commands
that implement the ``CronCommandInterface`` if they are registered in the
``oro:cron`` namespace. Implementing the ``CronCommandInterface`` requires
you to implement one method - ``getDefaultDefinition()``. It returns the
`crontab compatible`_ description of when the command should be executed.
For example, if a command should be run every day five minutes after midnight,
the appropriate value is ``5 0 * * *``. Your command will then look like this::

    // src/Acme/DemoBundle/Command/DemoCommand.php
    namespace Acme\DemoBundle\Command;

    use Oro\Bundle\CronBundle\Command\CronCommandInterface;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class DemoCommand implements CronCommandInterface
    {
        public function getDefaultDefinition()
        {
            return '5 0 * * *';
        }

        protected function configure()
        {
            $this->setName('oro:cron:demo');

            // ...
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            // ...
        }
    }

.. _built-in-cron-commands:

.. sidebar:: Cron Commands in the Oro Platform

    The Oro Platform has a bunch of commands that will be run through ``oro:cron``:

    * To clean up the schedule queue, the OroCronBundle provides the ``CleanupCommand``
      which deletes orphaned entries. It is executed every five minutes.

    * Every 30 minutes, the ``EmailSyncCommand``, which is part of the `ImapBundle`_,
      loads new emails from an IMAP server and synchronizes them with the
      local database (you can find more information about the synchronization
      process in the `dedicated section`_ of the ImapBundle documentation).

    * Reminder messages can be created by the `ReminderBundle`_ If they should
      be delivered as emails to the users, they'll be added to a mail queue
      which is then flushed periodically (every minute) by the ``SendRemindersCommand``.

    * Once per hour tracking log entries are synchronized from log files in
      the file system into the database when the ``ImportLogsCommand`` from
      the `TrackingBundle`_ is executed.


.. _`OroCronBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/CronBundle
.. _`crontab compatible`: http://www.unix.com/man-page/linux/5/crontab/
.. _`ImapBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle
.. _`dedicated section`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle#synchronization-with-imap-servers
.. _`ReminderBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ReminderBundle
.. _`TrackingBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/TrackingBundle
