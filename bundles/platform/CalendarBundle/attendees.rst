Attendees
=========

An attendee entity represents a guest of `OroCalendarEvent:Event` and association with a related entity.
The only supported related entity at the moment is ``Oro\Bundle\UserBundle\Entity\User``. Attendee is associated with ``Oro\Bundle\UserBundle\Entity\User`` based on the matching logic. In the UI, attendees of an event are displayed with the label `Guests`.

Fields
------

The attendee entity has the following fields:

* `email` - String. An email of the attendee. This field cannot be blank in the API request if `displayName` is empty.
* `displayName` - String. The name of the attendee is used to display it on the view. This field cannot be blank in the API request if `email` is empty.
* `user` - A relation to ``Oro\Bundle\UserBundle\Entity\User``. This field is not available in the API create/update requests.
* `calendarEvent` - A relation to `OroCalendarEvent:Event`.  This field is required in persistence and not available in the API.
* `status` - Enum. The default values are: `none`, `accepted`, `declined`, `tentative`. In addition to the API, a user can change this value from the view page of `OroCalendarEvent:Event`.
* `type` - Enum. Default values are: `organizer`, `optional`, `required`. At the moment there is no business logic related to this field.

Matching Logic
--------------

This logic uses the email of `OroCalendarEvent:Attendee` to find ``Oro\Bundle\UserBundle\Entity\User`` with the same email and organization.

Notification logic
------------------

When an event is updated in UI user is asked to confirm notification of attendees.

In API POST or PUT request, you can pass property `notifyAttendees`. For example:

.. code-block:: none

    PUT /api/rest/latest/calendarevents/1
    {
        "title" : "Test Event",
        "notifyAttendees" : all
    }

The following values of `notifyAttendees` are supported:

- `all` - notification will be sent to all attendees.
- `none` - notification will not be sent.
- `added_or_deleted` - notification will be sent only to attendees who were added or removed via the request (i.e., such option could be used when PUT request updates the attendees of the event).

In API DELETE request, you can pass the parameter `notifyAttendees`. For example:

.. code-block:: none

   DELETE /api/rest/latest/calendarevents/1?notifyAttendees=all

AttendeeRelationManager
-----------------------

Class ``Oro\Bundle\CalendarBundle\Manager\AttendeeManager`` is responsible for maintaining the entity's relation to other entities like ``Oro\Bundle\UserBundle\Entity\User``.

API Example
-----------

In API PUT/POST requests, the following fields are supported for the attendee: `email`, `status`,  `type`, `displayName`.

In GET responses, the following fields are additionally exposed: `userId`, `createdAt`, `updatedAt`.

GET Query Example
^^^^^^^^^^^^^^^^^

To get calendar events with attendees from the server, send a GET request to ``/api/rest/latest/calendarevents/{id}``.

In a GET response, attendees are exposed in property `attendees` which contains an array. Each element of the array contains a JSON object
with supported fields.

For example:

.. code-block:: none

    GET /api/rest/latest/calendarevents/1
    {
        "id": 1,
        ...
        "attendees": [
              {
                "displayName": "Admin Admin",
                "email": "admin@email.com",
                "createdAt": "2021-09-30T10:08:23+00:00",
                "updatedAt": "2021-09-30T10:08:23+00:00",
                "status": "none",
                "type": "organizer",
                "fullName": "Admin Admin",
                "userId": 1
              },
              {
                "displayName": "David Duran",
                "email": "david.duran_da377@aol.com",
                "createdAt": "2021-09-30T10:07:24+00:00",
                "updatedAt": "2021-09-30T10:07:24+00:00",
                "status": "none",
                "type": "required",
                "fullName": "David Duran",
                "userId": 47
              },
              {
                "displayName": "John Doe",
                "email": null,
                "createdAt": "2021-09-30T10:09:53+00:00",
                "updatedAt": "2021-09-30T10:09:53+00:00",
                "status": "none",
                "type": "required",
                "fullName": "",
                "userId": null
              }

Note that in this example, the first attendee has property `userId`. It means this instance of ``Oro\Bundle\CalendarBundle\Entity\Attendee`` is bound to ``Oro\Bundle\UserBundle\Entity\User`` in the application. In the meantime, the last attendee is not bound to any user in the application.

POST Query Example
^^^^^^^^^^^^^^^^^^

POST request should be send to ``/api/rest/latest/calendarevents`` in the JSON format. For example:

.. code-block:: none

    POST /api/rest/latest/calendarevents
    {
        "start": "2016-05-04T11:29:46+00:00",
        "end": "2016-05-04T11:29:46+00:00",
        "calendar": 1,
        "title":" Test Event",
        "attendees": [
            {
                "displayName": "John Doe",
                "email":"admin@example.com",
                "status": "none",
                "type": "organizer"
            },
            {
                "email": "sales_man@user.com",
                "displayName": "test name",
                "status": "none"
            },
            {
                "email": "user@user.com",
                "displayName": "test name",
                "type": "required",
                "status": "none"
            }
        ]
    }


Response on this will be json: `{"id": 1}` where `1` is a calendar event id that was created.

Keep in mind that there is no `userId` property for the attendee in this request. Instead, property `email` is used to match an existing user in the same organization.
So, in this case, the server tries to find users for emails `admin@example.com`, `sales_man@user.com`, `user@user.com` and associate them
with the corresponding attendees using the `user` property.

If a user is matched, an additional instance of `OroCalendarEvent:Event` is created in the calendar of the matched user.

PUT Query Example
^^^^^^^^^^^^^^^^^

PUT request should be sent to ``/api/rest/latest/calendarevents/{id}`` in the JSON format where `{id}` is the ID of the calendar event to update.
For example:

.. code-block:: none

    PUT /api/rest/latest/calendarevents/1
    {
        "title": "Test Event",
        "attendees": [
            {
                "displayName": "Jack Smith",
                "status": "tentative"
            }
        ]
    }


This request would remove all previous attendees if they existed before. As a result, the event will have only one attendee `Jack Smith`.

The response for this request has no content; the response code for success is `204`.


DELETE Query Example
^^^^^^^^^^^^^^^^^^^^

To remove attendees from an event, send a PUT request. For example:

.. code-block:: none

    PUT /api/rest/latest/calendarevents/1
    {
        "attendees": []
    }

You can also remove a calendar event of the attendee user. For example:

.. code-block:: none

   DELETE to `/api/rest/latest/calendarevents/{id}`
