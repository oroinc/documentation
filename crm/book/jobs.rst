.. _book-job-execution:

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

With OroPlatform, you can use the `OroCronBundle`_ which makes it easy
to run Symfony Console commands through cronjobs (on UNIX-based operating
systems) or through the Windows task scheduler.

Configuring the Entry Point Command
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

All you have to do to regularly run a set of commands from your application
is to configure your system to run the ``oro:cron`` command every minute.
On UNIX-based systems, you can simply set up a ``crontab`` entry for this:

.. code-block:: text

    */1 * * * * /path/to/php /path/to/app/console oro:cron --env=prod > /dev/null

Note: Some OS flavors will require the user name (usually root) in the crontab entry,
like this:

.. code-block:: text

    */1 * * * * root /path/to/php /path/to/app/console oro:cron --env=prod > /dev/null

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

    There're two commands to set up the cron tasks shedule. The command
    ``oro:cron:definitions:load`` scans for all commands from the
    ``oro:cron`` namespace that implement the
    :class:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface`. For each
    found command, a new :class:`Oro\\Bundle\\CronBundle\\Entity\\Schedule`
    entry is created and saved to the db. This command runs on install and update.
    It can also be run manually if some cron commands or command definitions are
    changed.

    The seconf command is ``oro:cron``. It takes all schedules from the db (created by
    ``oro:cron:definitions:load`` command) and adds the commands that is due to the
    Message Queue. It should run every minute.

.. _create-cron-command:

Creating the Command
~~~~~~~~~~~~~~~~~~~~

The ``oro:cron`` command will automatically execute all commands previously
loaded with ``oro:cron:definitions:load`` command. The command loads commands
that implement the ``CronCommandInterface`` if they are registered in the
``oro:cron`` namespace. Implementing the ``CronCommandInterface`` requires
you to implement two methods -
:method:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface::getDefaultDefinition`.
It returns the `crontab compatible`_ description of when the command should
be executed. For example, if a command should be run every day five minutes
after midnight, the appropriate value is ``5 0 * * *``. Your command will
then look like this:
:method:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface::isCronEnabled`.
It checks some pre-conditions and returns true or false. If it returns false the
command will not be added to the Message Queue. For example for the integrations
sync command it can check that there're more than 0 active integrations.

.. code-block:: php
    :linenos:

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

        public function isCronEnabled()
        {
            // check some pre-conditions

            return $condition ? true : false;
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

.. sidebar:: Cron Commands in OroPlatform

    OroPlatform has a bunch of commands that will be run through ``oro:cron``:

    * To clean up the schedule queue, the OroCronBundle provides the
      :class:`Oro\\Bundle\\CronBundle\\Command\\CleanupCommand` which deletes
      orphaned entries. It is executed every five minutes.

    * Every 30 minutes, the :class:`Oro\\Bundle\\ImapBundle\\Command\\Cron\\EmailSyncCommand`,
      which is part of the `ImapBundle`_, loads new emails from an IMAP server
      and synchronizes them with the local database (you can find more information
      about the synchronization process in the `dedicated section`_ of the
      ImapBundle documentation).

    * Reminder messages can be created by the `ReminderBundle`_ If they should
      be delivered as emails to the users, they'll be added to a mail queue
      which is then flushed periodically (every minute) by the
      :class:`Oro\\Bundle\\ReminderBundle\\Command\\SendRemindersCommand`.

    * Once per hour tracking log entries are synchronized from log files in
      the file system into the database when the
      :class:`Oro\\Bundle\\TrackingBundle\\Command\\ImportLogsCommand` from
      the `TrackingBundle`_ is executed.

    * The ``oro:cron:integration:sync`` command runs integration jobs configured
      through the `IntegrationBundle`_ every five minutes.


.. _`OroCronBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/CronBundle
.. _`crontab compatible`: http://www.unix.com/man-page/linux/5/crontab/
.. _`ImapBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle
.. _`dedicated section`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle#synchronization-with-imap-servers
.. _`ReminderBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ReminderBundle
.. _`TrackingBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/TrackingBundle
.. _`IntegrationBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/IntegrationBundle
