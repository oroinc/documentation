.. _book-time-based-command-execution:

Scheduled Tasks via Cron
========================

.. index::
    double: Cron Jobs ; Command
    double: Task Scheduler ; Command

Time-Based Command Execution
----------------------------

Some recurring tasks should be executed on schedule (for example, imap synchronization or sending email campaigns to customers). Usually, the operating system should be configured to execute a script to perform these tasks.

With OroPlatform, you can use the `OroCronBundle`_ which makes it easy
to run Symfony Console commands through cronjobs (on UNIX-based operating
systems) or through the Windows task scheduler.

You can view the scheduled tasks via the **System > Configuration** menu.

.. image:: /admin_guide/img/scheduled_tasks.png

Configuring the Entry Point Command
-----------------------------------

To regularly run a set of commands from your application,
configure your system to run the ``oro:cron`` command every minute.
On UNIX-based systems, you can simply set up a ``crontab`` entry for this:

.. code-block:: text

    */1 * * * * /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

Note: Some OS flavors will require the user name (usually root) in the crontab entry,
like this:

.. code-block:: text

    */1 * * * * root /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

On Windows, use the Control Panel to configure the Task Scheduler to do the
same.

.. note::

    This entry in the crontab does not presuppose execution of cron commands
    every minute. The ``oro:cron`` command only ensures that the actual
    commands are added to the scheduler which makes sure that they are only
    executed at the desired times (see :ref:`How Does it Work <sidebar-cron-work>` 
    for the insight into the actual process).


.. _sidebar-cron-work:

.. sidebar:: How Does it Work?

    There are two commands to set up the cron tasks shedule. The
    ``oro:cron:definitions:load``  command scans for all commands from the
    ``oro:cron`` namespace that implement the
    :class:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface`. For each
    found command, a new :class:`Oro\\Bundle\\CronBundle\\Entity\\Schedule`
    entry is created and saved to the database. This command runs on install and update.
    It can also be run manually if some cron commands or command definitions are
    changed.

    The second command is ``oro:cron``. It takes all schedules from the database (created by the
    ``oro:cron:definitions:load`` command) and adds the commands that are due to the
    Message Queue. This command should run every minute.

.. note::

    Please notice that ``oro:cron:definitions:load`` removes all previously loaded
    commands from the db. So if there are other commands that add cron commands to
    the db (such as ``oro:workflow:definition:load``), they should be run after
    ``oro:cron:definitions:load``.

.. _create-cron-command:

Creating the Command
--------------------

The ``oro:cron`` command will automatically execute all commands previously
loaded with the ``oro:cron:definitions:load`` command. It loads commands
that implement the ``CronCommandInterface`` if they are registered in the
``oro:cron`` namespace. Implementing ``CronCommandInterface`` requires
implementation of two methods. First, it is
:method:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface::getDefaultDefinition`.
It returns the `crontab compatible`_ description of when the command should
be executed. For example, if a command should be run every day five minutes
after midnight, the appropriate value is ``5 0 * * *``. Your command will
then look the following way:
:method:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface::isCronEnabled`.
It checks some pre-conditions and returns true or false. If it returns false, the
command will not be added to the Message Queue. For example, for the integrations
sync command it can check that there are more than 0 active integrations.

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

    * Reminder messages can be created by the `ReminderBundle`_. If they should
      be delivered as emails to users, they will be added to the mail queue
      which is then flushed periodically (every minute) by the
      :class:`Oro\\Bundle\\ReminderBundle\\Command\\SendRemindersCommand`.

    * Once per hour, tracking log entries are synchronized from log files in
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
