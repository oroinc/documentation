.. _dev-integrations-notification-alerts:

Notification Alerts
===================

Notification alerts enable developers to log the errors detected during data synchronization and notify a user or a system administrator about these errors for them to take actions to resolve the issues.

All the alerts are stored in the database and are available in the :ref:`application back-office UI <user-back-office-system-alerts>`, under **System > Alerts**, or via a CLI command.

Implementation Details
----------------------

The class that represents a notification alert for your resource type must implement |NotificationAlertInterface|.

You need to register your own notification alert manager to work with a particular integration and resource type in order to add your notification alerts. As an example, please see |NotificationAlertManager|.

The NotificationAlertManager should be registered as a service with the source type and resource names, as illustrated below:

.. code-block:: yaml

    acme_demo.your_notification_alert_manager:
        class: Oro\Bundle\NotificationBundle\NotificationAlert\NotificationAlertManager
        arguments:
            - '<SourceTypeName>'
            - '<ResourceTypeName>'
            - '@doctrine'
            - '@oro_security.token_accessor'

Use the **acme_demo.your_notification_alert_manager** service and the notification alert object(s) to log the alert(s) in code and display them in the datagrid, or implement them as flash message notification(s).

If the alert is fixed or is no longer relevant, there are different ways to clear it:

 - in code, using resolve functions of the alert manager;
 - in UI, in the Notification Alerts datagrid via the *delete* or *mass-delete* actions;
 - using the **oro:notification:alerts:cleanup** console command that deletes notification alert records.

View Alerts in the Back-Office
------------------------------

To view the list of all occurred notification alerts, navigate to **System > Alerts** in the back-office UI.

The datagrid displays the following details:

.. csv-table::
      :header: "Column name","Data type","Description"
      :widths: 7,5,30

      "**ID**","GUID","Unique alert identifier that appears in logs for further alert cause investigation or reporting."
      "**CREATED AT**","DateTime","The date and time when the alert was logged."
      "**UPDATED AT**","DateTime","The date and time when the alert was updated.

        .. note:: The cause of update may be alert resolving, subsequent occurrence of the same alert."
      "**USER**","relation","The first and last names of the user who performed the operation (optional)."
      "**MESSAGE**","text","The error or exception message that describes the cause of the occurred alert (optional)."
      "**SOURCE**","string","The source of the alert, usually related to bundle name, integration name, CLI command, MQ job, e.g., `MicrosoftSync`, `GoogleIntegration`, `price-lists:recalculation`, etc.

        .. note:: It is recommended to name the source as the bundle name that is responsible for the integration or job implementation, e.g., MycrosoftSync, GoogleIntegration, Pricing. "
      "**RESOURCE**","string","The resource that is involved during integration or job execution.

        .. note:: One source can be responsible for several resources, e.g., `MicrosoftSync` <> `Calendar Event` entity, `MicrosoftSync` <> `Tasks` entity.

        .. note:: It is recommended to name the resource as the entity name or to use FQCN that is related to the integration or job that caused an alert, e.g., Tasks, Calendars, Calendar Event, User, PriceList."
      "**ALERT TYPE**","string","Specifies the type of the alert (e.g., auth, sync, etc). Based on the alert type (error, warning, notice), the corresponding flash message is shown to a user."
      "**OPERATION**","string","Describes the operation that has caused the alert (optional). For instance, the value for integration operation can be `import`, `export`, etc."
      "**STEP**","string","Describes the logical part of the operation where the error has been detected, e.g., `get_list`, `get`, `map`, `save`, `load`, etc. Usually, it is used to specify the alert cause more precisely for further issue investigation."
      "**ITEM ID**","integer","The identifier of the specific resource (Entity) item, e.g., Task id or CalendarEvent id, etc. (optional).

        .. note:: The value can be empty, as in the case with the Exception triggered on the step when entity id is not defined"
      "**EXTERNAL ID**","string","The identifier of the specific resource item from external application (optional)."
      "**RESOLVED**","bool","Determines if the alert has been resolved, for example the alert can be raised during the first sync attempt due to timeout or connection issues and resolved later after retry, even without involving the administrator"

Manage Alerts in CLI
--------------------

View Alerts
^^^^^^^^^^^

1. Run the ``oro:notification:alerts:list`` command to view the list of notification alerts. By default, the last 20 alert records are displayed. Keep in mind that the list includes unresolved alerts only. To include the resolved ones into listing, use the ``--resolved`` command option.

2. Use the ``--page`` and ``--per-page`` command options to paginate the list.

3. Use the ``--summary`` option to display alerts in statistical mode. All the record are to be grouped by source, resource, and the alert type with the number of similar alerts.

4. Use ``--source-type``, ``--resource-type``, ``--alert-type``, ``--current-user``, and ``--current-organization`` to filter the records by one or multiple filters.

You can get either a full list of notification alerts or its summarized version.

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

Clean up Alerts
^^^^^^^^^^^^^^^

1. Run the ``oro:notification:alerts:cleanup`` command to clean up notification alert(s). The command also cleans up all the filters of ``oro:notification:alerts:list``.

2. Use the ``--id`` filter to delete a single alert record by its identifier.

3. Run the ``oro:notification:alerts:cleanup`` command without filters to delete all alerts. You will be prompted to confirm the action.

Clean up Outdated Alerts Automatically
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run the ``oro:cron:notification:alerts:cleanup`` command to clean up the outdated (older than 30 days) and resolved notification alerts. The cleanup is scheduled for execution once a week at 00:00 on Sunday.

.. include:: /include/include-links-dev.rst
   :start-after: begin
