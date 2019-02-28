.. _dev-guide-system-cron-jobs:

Cron Jobs
=========

More often than not, it is essential to run regular time-based background jobs in business applications. These jobs can be maintenance tasks, such as checking for updates or synchronizing data between integrated systems, and business-related tasks, such as generating reports, sending emails, or making timely-based shifts in tasks determined by your business process flows.

The nature and algorithms of these timely-based tasks can be diverse and complicated, and the obvious way of implementing these jobs is to create specific program components.

Therefore, to strengthen the task to create and schedule such components, OroPlatform provides the `OroCronBundle <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/CronBundle>`_ . With its help, it is considerably easier to run Symfony Console commands through cronjobs (on UNIX-based operating systems) or the Windows task scheduler.

How It Works
------------

OroCronBundle provides `CronCommandInterface`_ and two console commands to set up the cron tasks schedule.

**CronCommandInterface** allows defining the console command along with its schedule in a crontab compatible string in the command class.

The **oro:cron:definitions:load** command scans for all commands from the oro:cron namespace that implements the `CronCommandInterface`_. For each detected command, a new `Schedule <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/CronBundle/Entity/Schedule.php>`_ entry is created and saved into the database. This command runs on install and update, and can also be run manually if some cron commands or command definitions are changed.

The second command is **oro:cron**. It takes all schedules from the database (created by the oro:cron:definitions:load command) and adds the commands that are due to the Message Queue. This command should run every minute.

.. note:: Please notice that oro:cron:definitions:load removes all previously loaded commands from the database. So if other commands add cron commands to the db (such as oro:workflow:definition:load), they should be run after **oro:cron:definitions:load**.

Setup and Configuration
-----------------------

To run a set of commands from your application regularly, configure your system to run the **oro:cron** command every minute.

* For UNIX-based systems, set up a crontab entry, as illustrated below:

  .. code-block:: bash

      */1 * * * * /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

  .. note:: Some OS flavors require a username (usually root) in the crontab entry:

      .. code-block:: bash

          */1 * * * * root /path/to/php /path/to/bin/console oro:cron --env=prod > /dev/null

* For Windows, use the Control Panel to configure the Task Scheduler to do the same.

  .. note:: This entry in the crontab does not presuppose the execution of cron commands every minute. The oro:cron command only ensures that the actual commands are added to the scheduler which in its turn makes sure that they are executed at desired time.

Getting Started
---------------

* :ref:`Create Scheduled Commands in OroPlatform <dev-cookbook-system-cron-create-commands>`
* :ref:`View List of Scheduled Tasks in UI <dev-cookbook-system-cron-view-scheduled-tasks>`

..  .* :ref:`How To Customize Registered Cron Comman <dev-cookbook-system-cron-customize-command>`

.. _`CronCommandInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/CronBundle/Command/CronCommandInterface.php