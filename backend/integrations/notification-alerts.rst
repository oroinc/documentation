.. _dev-integrations-notification-alerts:

Notification Alerts
===================

You may sometimes need to log the errors that arise during the sync process when synchronizing data and notify user or system administrator about such an error in order to perform steps for issue resolution.

All the alerts are stored in database and are available in the application back-office UI or via CLI command.

Implementation details
----------------------

The class that represents a notification alert for your resource type must implement |NotificationAlertInterface|.

You need to register your own notification alert manager to work with a particular integration and resource type in order to add your notification alerts. As an example, please see |NotificationAlertManager|.

The NotificationAlertManager should be registered as a service with the source type name and resource name, as illustrated below:

.. code-block:: yaml

    acme_demo.your_notification_alert_manager:
        class: Oro\Bundle\NotificationBundle\NotificationAlert\NotificationAlertManager
        arguments:
            - '<SourceTypeName>'
            - '<ResourceTypeName>'
            - '@doctrine'
            - '@oro_security.token_accessor'

By using the **acme_demo.your_notification_alert_manager** service and the notification alert object(s), you can log the alert(s) in the code and have them displayed in the datagrid and, for example, implement them as flash message notification(s).

If the alert is fixed or is no longer relevant, there are different ways to clear it:

 - in code, using resolve functions of the alert manager;
 - in UI, in the Notification Alerts datagrid via delete or mass-delete actions;
 - using the **oro:notification:alerts:cleanup** console command that deletes notification alert records.

Viewing alerts in back-office
-----------------------------

To view the datagrid that displays the list of all occurred notification alerts, navigate to **System > Alerts** in the back-office UI.

Alert entity datagrid columns:

.. csv-table::
      :header: "Column name","Data type","Description"
      :widths: 7,5,30

      "**ID**","GUID","Unique alert identifier, appears in logs for further alert cause investigation or reporting"
      "**CREATED AT**","DateTime","The date and time when an alert has been logged"
      "**UPDATED AT**","DateTime","The date and time when an alert has been updated

        .. note:: The cause of update may be alert resolving, subsequent occurrence of the same alert."
      "**USER**","relation","The value is optional. Shows the user first name and last name who has performed the operation"
      "**MESSAGE**","text","The value is optional. Error or exception message that describes the cause of the occurred alert"
      "**SOURCE**","string","The source of the alert, usually related to bundle name, integration name, CLI command, MQ job, e.g. `MicrosoftSync`, `GoogleIntegration`, `price-lists:recalculation`, etc.

        .. note:: It is recommended to name the source according to the Bundle name that is responsible for the integration|job implementation, for example: MycrosoftSync, GoogleIntegration, Pricing"
      "**RESOURCE**","string","The resource being involved during integration|job execution

        .. note:: One source may be responsible for several Resources, example `MicrosoftSync` <> `Calendar Event` entity, `MicrosoftSync` <> `Tasks` entity.

        .. note:: It is recommended to name the resource according to the entity name or use FQCN, that is related to the integration or job that caused an alert, e.g. Tasks, Calendars, Calendar Event, User, PriceList"
      "**ALERT TYPE**","string","Specifies the type of the alert, e.g. auth, sync, etc. For example, depending on Alert Type the appropriate type (Error, Warning, Notice) of the flash message can be shown for the particular user"
      "**OPERATION**","string","The value is optional. Describes the operation that caused an alert e.g. for integrations case the value can be `import`, `export`, etc."
      "**STEP**","string","The value is optional. Describes any logical part of the operation, e.g. `get_list`, `get`, `map`, `save`, `load`, etc. Usually is used to specify the alert cause more precisely for further issue investigation"
      "**ITEM ID**","integer","The value is optional. The identifier of the specific resource (Entity) item, e.g. Task id or CalendarEvent id, etc.

        .. note:: The value can be empty, for example the case when Exception triggered on the step when entity id is not defined"
      "**EXTERNAL ID**","string","The value is optional. The identifier of the specific resource item from external application, for example the Task id or CalendarEvent id of the remote service, e.g. Microsoft Calendar or Task"
      "**RESOLVED**","bool","Determines if the alert has been resolved, for example the alert can be raised during the first sync attempt due to timeout or connection issues and resolved later after retry, even without involving the administrator"

Manipulating alerts in CLI
--------------------------

List alerts
~~~~~~~~~~~

To list notification alert use ``oro:notification:alerts:list`` command.

By default the last 20 alert records are shown, use ``--page`` and ``--per-page`` command options to paginate.

The option ``--summary`` allows to display alerts in statistical mode - all the record will be grouped by source, resource and alert type with amount of similar alerts.

By default only not resolved alerts are involved in listing, to include the resolved ones into listing the option ``--resolved`` should be used for such purposes.

It is also possible to filter records by one or multiple filters, for example the ``--source-type``, ``--resource-type``, ``--alert-type``, ``--current-user`` and ``--current-organization``.

The result of the command execution will be the full or summary list of notification alerts.

.. code-block:: bash

    $ php bin/console --env=prod oro:notification:alerts:list --resource-type calendar

    +--------+------------------+------------------+---------+----------------------------------+---------------+---------------+------------+-----------+------+---------+--------------+----------+
    | Id     | Created At       | Updated At       | User    | Message                          | Source        | Resource      | Alert Type | Operation | Step | Item Id | External Id  | Resolved |
    +--------+------------------+------------------+---------+----------------------------------+---------------+---------------+------------+-----------+------+---------+--------------+----------+
    | c2f777 | 7/17/21, 7:04 PM | 7/17/21, 7:04 PM | charlie | Calendar event data has no type. | MyIntegration | calendar      | sync       | import    | map  |         | d2f8165b49f3 | No       |
    | c2f999 | 8/23/21, 7:04 PM | 8/23/21, 7:04 PM | admin   | Calendar event data has no type. | MyIntegration | calendar      | sync       | import    | map  |         | d2f8165b49f5 | No       |
    | c2f833 | 7/18/21, 7:04 PM | 7/18/21, 7:04 PM | charlie | Calendar event data has no type. | MyIntegration | calendar      | auth       | import    | map  |         | d2f8165b49f4 | No       |
    +--------+------------------+------------------+---------+----------------------------------+---------------+---------------+------------+-----------+------+---------+--------------+----------+

    $ php bin/console --env=prod oro:notification:alerts:list --resource-type calendar --summary

    +---------------+---------------+------------+---------------+
    | Source        | Resource      | Alert Type | Alerts Amount |
    +---------------+---------------+------------+---------------+
    | MyIntegration | calendar      | sync       | 2             |
    | MyIntegration | calendar      | auth       | 1             |
    +---------------+---------------+------------+---------------+

Cleanup alerts
~~~~~~~~~~~~~~

To cleanup notification alert(s) use ``oro:notification:alerts:cleanup`` command.

All the filters of the ``oro:notification:alerts:list`` are relevant for the cleanup command as well.

Additionally the ``--id`` filter is available if it is required to delete single alert record by its identifier.

When command **oro:notification:alerts:cleanup** is executed without any filters all alerts are deleted (an appropriate action confirmation will be asked).

Automatic outdated alerts cleanup
---------------------------------

The command ``oro:cron:notification:alerts:cleanup`` allows to cleanup outdated (older than 30 days) and resolved notification alerts.
It is scheduled for execution once a week at 00:00 on Sunday.

.. include:: /include/include-links-dev.rst
   :start-after: begin
