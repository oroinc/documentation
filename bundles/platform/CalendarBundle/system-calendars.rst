.. _bundle-docs-platform-calendar-bundle-system-calendar:

System Calendars
================

You can use system calendars to provide everyday events for all users, such as employees' birthdays, company weekends, vacations, etc. These calendars can be made available in a single organization or shared across all organizations in the system. To manage system calendars, navigate to **System > System Calendar** in the main menu. As soon as you :ref:`create a system calendar <user-guide-calendars>`, it becomes visible for all users. The visibility of organization-wide calendars can be restricted by ACL against system-wide calendars, which are always visible.

Configuration
-------------

By default, both organization and system-wide calendars are enabled, but you can disable any of them in the `config.yml` by adding the `enabled_system_calendar` option:

.. code-block:: yaml

    oro_calendar:
        enabled_system_calendar: false

The possible values of this option:

- **true** - both organization and system-wide calendars are enabled
- **false** - both organization and system-wide calendars are disabled
- **organization** - only organization wide calendars are enabled
- **system** - only system-wide calendars are enabled

Implementation
--------------

The list of system calendars is stored in the |oro_system_calendar| table. The **public** field indicates whether a calendar is organization or system-wide. System-wide calendars are marked as ``public``.

Both organization and system-wide calendars are implemented as :ref:`calendar providers <bundle-docs-platform-calendar-bundle-provider>`. For more implementation details, see the following the source code:

- |SystemCalendarProvider| - responsible for **organization wide calendars**
- |PublicCalendarProvider| - responsible for **system wide calendars**


.. include:: /include/include-links-dev.rst
   :start-after: begin