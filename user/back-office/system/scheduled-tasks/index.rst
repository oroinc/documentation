:oro_documentation_types: OroCRM, OroCommerce

Configure Scheduled Tasks in the Back-Office
============================================

.. index::
    double: Cron Jobs ; Command
    double: Task Scheduler ; Command

.. _book-time-based-command-execution:

Time-Based Command Execution
----------------------------

Some recurring tasks should be executed on schedule, for example, IMAP synchronization or sending email campaigns to customers). Usually, the operating system should be configured to execute a script to perform these tasks.

With Oro, you can use the |OroCronBundle|, which makes it easy to run Symfony Console commands through :ref:`cronjobs <dev-guide-system-cron-jobs>` (on UNIX-based operating systems) or Windows task scheduler.

Oro applications provide an admin UI page for admin users that displays all scheduled cron commands.

The admin UI located in the **System > Scheduled Tasks** main menu.

On the page, you can see the list of scheduled commands with their names, schedule definition strings, and the filters that allow searching for the required command in the list.

.. image:: /user/img/system/scheduled_tasks/scheduled_tasks.png
    :alt: Scheduled Tasks UI page

.. include:: /include/include-links-user.rst
   :start-after: begin

