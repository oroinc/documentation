.. _user-guide-calendars:

System and Organization Calendars
=================================

In your Oro application, you can add calendars with tasks and events related to a specific user, other users in the system
(subject to the :ref:`roles and permissions defined <user-guide-user-management-permissions>`), as well as events 
defined for the whole organization or system.

Events in the System and Organization calendars can be viewed by all the users within the system/organization.
The ability to create, edit, and delete events depends on the user's :ref:`roles <user-guide-user-management-permissions>` and :ref:`capabilities <admin-capabilities-org-calendar-events>`.

.. note:: See a short demo on `how to create and manage calendars <https://www.orocrm.com/media-library/create-and-manage-calendars#play=fVcOy3TmuQg>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/fVcOy3TmuQg" frameborder="0" allowfullscreen></iframe>

This section details how to:

.. contents:: :local:

Create System and Organization Calendars
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a system calendar:

1. Navigate to **System > System Calendars** in the main menu.
2. Click the **Create System Calendar**.
3. The **Create System Calendar** page will appear:

   Define the following fields:
   
   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30
   
     "**Calendar Name***","This is the only mandatory field. Defines the name used to refer to the calendar in the system."
     "**Color***","Choose the color used to highlight events in the calendar by default."
     "**Scope***","Define if this is a system or organization calendar (meaningful for enterprise edition only)."

   .. image:: ../img/calendars/create_system_cal.png

4. Click **Save**. 

Add an Event to a Calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an event to a calendar:

1. Navigate to the calendar page.
2. Click **Create Calendar Event**.
3. The **Create Calendar Event** page will appear. The form has the following fields:

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30
   
     "**Title***","The event name. Must be defined."
     "**Description**","A free text field that you can use for additional information about the event"
     "**Start***","Time the event starts. Must be specified." 
     "**End***","Time the event ends. Must be specified."
     "**All day event**","Defines whether the event will take place for a whole day."
     "**Color**","Defines the color to be used to highlight the event when displayed in the calendar."
  
   .. image:: ../img/calendars/create_system_cal_event.png

.. _user-guide-calendars-manage:

.. note:: You can view, edit and delete calendars and calendar events from the page of all calendars.

         .. image:: ../img/calendars/system_cal_grid.png


.. include:: /img/buttons/include_images.rst
   :start-after: begin

