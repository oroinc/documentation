.. _user-guide-calendars:

Calendars: System, Organization and User
========================================

In your Oro application, you can add calendars with tasks and events related to a specific user, other users in the system
(subject to the :ref:`roles and permissions defined <user-guide-user-management-permissions>`), as well as events
defined for the whole organization or system.

Events in the system and organization calendars can be viewed by all the users within the system/organization.
The ability to create, edit, and delete events depends on the user's :ref:`roles <user-guide-user-management-permissions>` and :ref:`capabilities <admin-capabilities-org-calendar-events>`.

.. note:: See a short demo on `how to create and manage calendars <https://oroinc.com/orocrm/media-library/create-and-manage-calendars#play=fVcOy3TmuQg>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/fVcOy3TmuQg" frameborder="0" allowfullscreen></iframe>

This section described the following topics:

.. contents:: :local:

Create System and Organization Calendars
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can create as many calendars as you need under the System menu in your OroCommerce application.

To create a system or an organization calendar:

1. Navigate to **System > System Calendars** in the main menu.
2. Click the **Create System Calendar**.
3. The **Create System Calendar** page will appear:

   Define the following fields:

   .. csv-table::
      :header: "Field", "Description"
      :widths: 10, 30

      "**Calendar Name**","This is the only mandatory field. Defines the name used to refer to the calendar in the system."
      "**Color**","Choose the color used to highlight events in the calendar by default."
      "**Scope**","Define if this is a system or organization calendar (meaningful for enterprise edition only)."

  .. image:: /user_guide/img/getting_started/calendars/create_system_cal_new.png
     :alt: Create system and organization calendars

4. Click **Save**.

.. _user-guide-calendars-add-event:

Add Events to a System Calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can add event to system calendars in two ways:

* From the page of the :ref:`system calendar <user-guide-activities-events-add-system-calendar>` under **System > System Calendars**.
* From :ref:`My Calendar <user-guide-activities-events-add-system-calendar>` under your user name on the top right.

You can find detailed information on adding calendar events to user calendars in the :ref:`Calendar Events <doc-activities-events-actions-add>` topic.

.. _user-guide-calendars-manage:

.. .. note:: You can view, edit and delete calendars and calendar events from the page of all calendars.

         .. .. image:: /user_guide/img/getting_started/calendars/system_cal_grid.png

Manage My Calendar
^^^^^^^^^^^^^^^^^^

My Calendar shows you all user and system calendars subject to the permissions of your organization. You can reach My Calendar from the :ref:`Today's Calendar widget <user-guide--business-intelligence--widgets--todays-calendar>` on the dashboard, or from the :ref:`menu under your user name <doc-my-user-view-page>`.

From the calendar page, you can:

1. Open the page of all :ref:`tasks <doc-activities-tasks>`

2. Open the page of all :ref:`calendar events <doc-activities-events>`

3. :ref:`Add the calendar of another user <user-guide-calendars-add-users-calendar>`

4. :ref:`Change calendar color <user-guide-calendars-change-color>`

5. :ref:`Show/Hide selected calendars <doc-activities-events-actions-show-hide-calendar>`

6. :ref:`Remove calendars <doc-activities-events-actions-remove-calendar>`


.. image:: /user_guide/img/getting_started/calendars/My_Calendar_Navigation.png
   :alt: Add events to a system calendar

.. _user-guide-calendars-add-users-calendar:

Add the Calendar of Another User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can add or remove calendars that you want to watch from the calendar panel on the left. By default, you have **My Tasks** calendar showing your tasks by their due dates, all existing system calendars, and your personal calendar.

.. image:: /user_guide/img/getting_started/calendars/My_Calendar_Add_User_Calendar.png
   :alt: Add the calendar of another user

To start watching calendars of other users, select a user by clicking **Choose a user to add**. Use the search field to quickly find the required user: start entering their name and click the required name from the dynamically filtered suggestions. You can also click the hamburger menu next to the list to select the required user in the dialog box using filters, etc.

.. _user-guide-calendars-change-color:

Change Calendar Color
^^^^^^^^^^^^^^^^^^^^^

System calendars have default colors defined by the person who manages them, but you can change colors of your own calendars the following way:

1. Hover over the calendar name in the panel to the left.
2. Click the ellipsis menu that appears at the end of the corresponding row, and click to choose the desired color (either from the default color box, or custom color wheel).

.. image:: /user_guide/img/getting_started/calendars/My_Calendar_Change_Color.png
   :alt: Change calendar color

.. _doc-activities-events-actions-show-hide-calendar:

Show/Hide a Calendar
^^^^^^^^^^^^^^^^^^^^

Click on the selected calendar from the list in the panel to the left to show or hid it. Alternatively, click the ellipsis menu at the end of row of the selected calendar, and then click **Show calendar**/**Hide calendar**.

 .. image:: /user_guide/img/getting_started/calendars/My_Calendar_Show_Hide.png
   :alt: Show/Hide a calendar

.. note:: Hidden calendars do not appear in the right part of the page and in the :ref:`Today's Calendar <user-guide--business-intelligence--widgets--todays-calendar>` widget.

.. _doc-activities-events-actions-remove-calendar:

Remove a Calendar
^^^^^^^^^^^^^^^^^

You can remove from calendars of other users from your list:

1. Hover over the name of the selected calendar.
2. Click the ellipsis menu at the end of the corresponding row, and then click **Remove calendar**.

.. important:: You cannot remove **My Tasks**, system calendars, and your personal calendar.

.. image:: /user_guide/img/getting_started/calendars/My_Calendar_Remove.png
   :alt: Remove a calendar

Explore Calendar Event Statuses
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Icons within event cells represents invitation statuses depending on whether the invitation has been accepted:

-  |IcInvitation| **Not Responded** --- This is a basic status of the invitation. It appears in the following cases:

   - You have not given any response to the invitation.
   - You are the event owner and are not required to respond.

-  |IcInviteYes| **Accepted** --- You have agreed to attend the event (you have responded **Yes** to the event invitation).

-  |IcInviteMaybe| **Tentatively Accepted** --- You are not sure whether you are going to attend the event (you have responded **Maybe** to the event invitation).

-  No icon is displayed in the following cases:

   - You are not going to attend the event and have declined the invitation (you have responded **No** to the event invitation).
   - This is an event from the system calendar.
   - The calendar record represents a task.

- The |IcReminder| **Reminder** icon in appears when the event owner set up reminders about the event.

.. image:: /user_guide/img/getting_started/calendars/My_Calendar_Statuses.png
   :alt: Explore calendar event statuses

**Related Topic:**

* :ref:`Calendar Events <doc-activities-events>`
* :ref:`Tasks <doc-activities-tasks>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin
