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

If the daemon process that executes the queued jobs is not running, it will
be started automatically by the ``oro:cron`` command, but you can also
:ref:`start it manually <job-daemon-start>`.

.. _sidebar-cron-work:

.. sidebar:: How Does it Work?

    When executed, the ``oro:cron`` command is the entry point for all cron
    commands (:ref:`built-in commands <built-in-cron-commands>` as well as
    :ref:`self-created commands <create-cron-command>`). It scans for all
    commands from the ``oro:cron`` namespace that implement the
    :class:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface`. For each
    found command, a new :class:`Oro\\Bundle\\CronBundle\\Entity\\Schedule`
    entry is created and registered at the cron
    :class:`Oro\\Bundle\\CronBundle\\Job\\Daemon`. The ``Daemon`` is a background
    process that manages :ref:`a queue <job-queues>` of all open jobs and
    ensures that each job is executed at the appropriate times.

.. _create-cron-command:

Creating the Command
~~~~~~~~~~~~~~~~~~~~

The ``oro:cron`` command will automatically execute all registered commands
that implement the ``CronCommandInterface`` if they are registered in the
``oro:cron`` namespace. Implementing the ``CronCommandInterface`` requires
you to implement one method -
:method:`Oro\\Bundle\\CronBundle\\Command\\CronCommandInterface::getDefaultDefinition`.
It returns the `crontab compatible`_ description of when the command should
be executed. For example, if a command should be run every day five minutes
after midnight, the appropriate value is ``5 0 * * *``. Your command will
then look like this::

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

.. _job-queues:

Job Queues
----------

The Oro Platform is capable of creating job queues which will be processed
sequentially by a daemon process.

.. seealso::

    Learn more about it in the in `JMSJobQueueBundle documentation`_.

Creating a Job
~~~~~~~~~~~~~~

You can simply queue the execution of any Symfony command by persisting a
``Job`` entity. A job references the command that will be executed once the
job itself is being run. The scheduled jobs will be executed by the daemon
process.

For example, assume that you have command that sends a newsletter to a list
of recipients::

    // src/Acme/NewsletterBundle/Command/SendNewsletterCommand.php
    namespace Acme\NewsletterBundle\Command;

    use JMS\JobQueueBundle\Entity\Job;
    use Symfony\Component\Console\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class SendNewsletterCommand extends Command
    {
        protected function configure()
        {
            $this->setName('acme:send-newsletter');
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            // do whatever is needed to send the newsletter
        }
    }

A sales manager should be able to create a newsletter in the backend and trigger
the command to send it to all registered recipients. Of course, you could
simply execute the ``SendNewsletterCommand``. But, as you may have guessed,
this is not a very clever idea. One of the drawbacks of this solution is that
sending the emails to hundreds, thousands or even more recipients likely takes
a long time blocking the response to the browser. Luckily, you can solve this
issue by only queuing the command execution. Its actual execution will be
done by a separate process::

    // src/Acme/NewsletterBundle/Controller/NewsletterController.php
    namespace Acme\NewsletterBundle\Controller;

    use JMS\JobQueueBundle\Entity\Job;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class NewsletterController extends Controller
    {
        public function sendAction()
        {
            $newsletter = ...;

            $job = new Job('acme:newsletter:send');
            $job->persist();
        }
    }

You can also configure dependencies between jobs, add relationships to other
entities or schedule jobs to be executed at a later time. Take a look at the
`examples in the JMSJobQueueBundle documentation`_ for more information.

.. _job-daemon-start:

Starting the Daemon
~~~~~~~~~~~~~~~~~~~

The ``oro:cron`` command actually doesn't run any of the cron commands. Instead,
it schedules the needed jobs in a queue. The job queue is then later on processed
by a daemon process. You will have to start the daemon either in the Web UI
or on the command line:

* On the command line, execute the ``jms-job-queue:run`` command to start
  the daemon process. You can specify the maximum runtime and the maximum
  number of concurrent jobs using the respective options:

  ========================= ============ ============= =================================
  Option                    Short option Default value Description
  ========================= ============ ============= =================================
  ``--max-runtime``         ``-r``       900           Maximum runtime in seconds
  ------------------------- ------------ ------------- ---------------------------------
  ``--max-concurrent-jobs`` ``-j``       5             Maximum number of concurrent jobs
  ========================= ============ ============= =================================

* You can also control the daemon from the web interface under *System* /
  *Job Queue*:

  .. image:: /images/book/job/daemon.png

.. _`OroCronBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/CronBundle
.. _`crontab compatible`: http://www.unix.com/man-page/linux/5/crontab/
.. _`ImapBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle
.. _`dedicated section`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImapBundle#synchronization-with-imap-servers
.. _`ReminderBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ReminderBundle
.. _`TrackingBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/TrackingBundle
.. _`IntegrationBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/IntegrationBundle
.. _`JMSJobQueueBundle documentation`: http://jmsyst.com/bundles/JMSJobQueueBundle
.. _`examples in the JMSJobQueueBundle documentation`: http://jmsyst.com/bundles/JMSJobQueueBundle/master/usage
