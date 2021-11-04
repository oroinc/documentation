.. _bundle-docs-platform-calendar-bundle-provider:

Calendar Provider
=================

The goal of calendar providers is to allow developers to add different types of calendars to the user's calendar. The main class responsible for working with calendar providers is |Calendar Manager|. This class contains all providers and is responsible for collecting and merging data from them.

Add a Provider
--------------

To add a calendar provider, create a class implements |CalendarProviderInterface|, register it as a service, and mark it with the *oro_calendar.calendar_provider* tag. Each provider must have an alias that is a unique identifier of a provider. The following example shows how a calendar provider can be registered:

.. code-block:: yaml

    oro_calendar.calendar_provider.user:
        class: Oro\Bundle\CalendarBundle\Provider\UserCalendarProvider
        arguments:
            - '@oro_entity.doctrine_helper'
            - '@oro_entity.entity_name_resolver'
            - '@oro_calendar.calendar_event_normalizer.user'
        tags:
            - { name: oro_calendar.calendar_provider, alias: user }

As mentioned below, your provider must implement |CalendarProviderInterface| which contains only two methods:

- **getCalendarDefaultValues** - This method returns default values of a calendar properties, such as calendar name, permissions, widget options, etc.
- **getCalendarEvents** - This method returns a list of calendar events.

.. include:: /include/include-links-dev.rst
   :start-after: begin
