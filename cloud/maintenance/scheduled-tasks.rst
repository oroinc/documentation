.. _orocloud-maintenance-scheduled-tasks:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

How to Add/Remove Scheduled task
=================================

Scheduled (|cron|) tasks can be configured, as illustrated below:

.. code-block:: none


    ---
    orocloud_options:
      schedule:
        'schedule1':
          command: 'orocloud-cli app:console "about"',
          minute: '*/5'
          hour: '8,12,16' # in UTC timezone
          month: '1-3'
          monthday: '*'
          weekday: '*'

* **schedule** — the hash where the key is a scheduled task name, and the value is the configuration for the scheduled task.

  * `command` - command which will be executed.
  * `minute` - execution time, minute. Allowed values 0 - 59, ``*/x`` where x is a number. Optional, by default '*', which means every minute.
  * `hour` - execution time, hour. Allowed values 0 - 23, ``*/x`` where x is a number. Optional, by default '*', which means every hour.
  * `month` - execution time, month. Allowed values 1 - 12, ``*/x`` where x is a number. Optional, by default '*', which means every month.
  * `monthday` - execution time, day of the month. Allowed values 1 - 31, ``*/x`` where x is a number. Optional, by default '*', which means every day of the month.
  * `weekday` - execution time, day of week. Allowed values 0 - 7, where 0,7 are "Sunday"; ``*/x`` where x is a number. Optional, by default '*', which means every day.

.. note:: Any valid expression from |Crontab Guru| is allowed.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
