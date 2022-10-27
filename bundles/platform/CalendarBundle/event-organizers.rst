Calendar Event Ownership
========================

Fields
------

Each CalendarEvent object should have information about its owner. This data is composed of four fields:

* ``isOrganizer`` - defines if the current user is the organizer of this event. The value is calculated automatically.

* ``organizerEmail`` - defines the organizer's email. If not set, the value is copied from the current user's email.

* ``organizerDisplayName`` - defines the name that shows in the UI. If not set, the value is copied from the current user's email.

* ``organizerUserId`` - is organizer email was matched with the system user email, his user profile will be linked.

Keep in mind that once set, these fields cannot be changed.

Logic and Behavior
------------------

To calculate the isOrganizer param, call the ``CalendarEvent::calculateIsOrganizer()`` method.

If the owner data is provided for the CalendarEvent object, the `isOrganizer` is set to false.
Otherwise, an organizer's data should be retrieved from the Calendar owner (usually, a current user), and `isOrganizer` is set to true.

Additionally, if the CalendarEvent object is a child of the other CalendarEvent, `isOrganizer` should be set to false,
and other organizer fields should be copied from the parent CalendarEvent.

This logic was introduced for synchronization reasons -- to handle the situation when a child CalendarEvents
is synchronized before a parent CalendarEvent. The organizer and `uid` fields help maintain consistency in the database.

API Example
-----------

In the API PUT/POST requests, the following fields are supported for a CalendarEvent:

* `organizerEmail`
* `organizerDisplayName`

GET responses additionally return the `isOrganizer` and `organizerUserId` fields values.

GET Query Example
^^^^^^^^^^^^^^^^^

To get a calendar event's organizer via API from the server, send GET request to ``/api/rest/latest/calendarevents/{id}``.

For example:

.. code-block:: none

    GET /api/rest/latest/calendarevents/1
    {
        "id": 1,
        ...
        "isOrganizer": true,
        "organizerEmail": "admin@example.com",
        "organizerDisplayName": "John Smith",
        "organizerUserId": "1",
    }