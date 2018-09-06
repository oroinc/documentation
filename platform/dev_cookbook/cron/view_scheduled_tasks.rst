.. _dev-cookbook-system-cron-view-scheduled-tasks:

View List of Scheduled Tasks in UI
==================================

Oro applications provide admin UI page for admin users that allows see all scheduled cron commands.

The admin UI located on the **System -> Scheduled Tasks** menu item.  On the page, you can see the list of scheduled
commands with their names and schedule definition strings, and the filters that allow to search the needed command in the list.

.. image:: /dev_cookbook/cron/img/scheduled_tasks.jpg
    :alt: Scheduled Tasks UI page

Cron Commands in OroPlatform
----------------------------

OroPlatform has a number of commands that run through **oro:cron**:

* To clean up the schedule queue, the `OroCronBundle`_ provides the `CleanupCommand`_ which deletes orphaned entries. It is executed every five minutes.
* Every 30 minutes, the `EmailSyncCommand`_ (which is part of `ImapBundle`_) loads new emails from an IMAP server and synchronizes them with the local database (you can find more information about the synchronization process in the `dedicated section <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ImapBundle#synchronization-with-imap-servers>`_ of the ImapBundle documentation).
* Reminder messages can be created by the `ReminderBundle`_. If they should be delivered as emails to users, they will be added to the mail queue which is then flushed periodically (every minute) by the `SendRemindersCommand`_.
* Once per hour, tracking log entries are synchronized from log files in the file system into the database when the `ImportLogsCommand`_ from the `TrackingBundle`_ is executed.
* The **oro:cron:integration:sync** command runs integration jobs configured through the `IntegrationBundle`_ every five minutes.

.. _`OroCronBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/CronBundle
.. _`CleanupCommand`: http://phpdoc.orocrm.com/platform/classes/Oro.Bundle.CronBundle.Command.CleanupCommand.html
.. _`EmailSyncCommand`: http://phpdoc.orocrm.com/platform/classes/Oro.Bundle.ImapBundle.Command.Cron.EmailSyncCommand.html
.. _`ImapBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ImapBundle
.. _`ReminderBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ReminderBundle
.. _`SendRemindersCommand`: http://phpdoc.orocrm.com/platform/classes/Oro.Bundle.ReminderBundle.Command.SendRemindersCommand.html
.. _`ImportLogsCommand`: http://phpdoc.orocrm.com/platform/classes/Oro.Bundle.TrackingBundle.Command.ImportLogsCommand.html
.. _`TrackingBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/TrackingBundle
.. _`IntegrationBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/IntegrationBundle
