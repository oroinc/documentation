.. _orocloud-maintenance-scheduled-tasks:

How to Add/Remove Scheduled task
=================================

Scheduled (|cron|) tasks can be configured, as illustrated below:

.. code-block:: none
    :linenos:

    ---
    orocloud_options:
      schedule:
        'schedule1':
          command: 'uname -a'
          minute: '55'
          hour: '23'
          month: '11'
          monthday: '31'
          weekday: '1'

* **schedule** — the hash where the key is a scheduled task name, and the value is the configuration for the scheduled task.

  * `command` - command which will be executed.
  * `minute` - execution time, minute. Allowed values 0 - 59. Optional, by default '*', which means every minute.
  * `hour` - execution time, hour. Allowed values 0 - 23. Optional, by default '*', which means every hour.
  * `month` - execution time, month. Allowed values 1 - 12. Optional, by default '*', which means every month.
  * `monthday` - execution time, day of the month. Allowed values 1 - 31. Optional, by default '*', which means every day of the month.
  * `weekday` - execution time, day of week. Allowed values 0 - 7, where 0,7 are "Sunday". Optional, by default '*', which means every day.

.. include:: /include/include-links.rst
   :start-after: begin
