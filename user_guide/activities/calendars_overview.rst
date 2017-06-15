.. _user-guide-calendars:

System and Organization Calendars
=================================

Efficient business today is hard to imagine without an easy-to-understand and up-to-date schedule. 
OroCRM provides each user with a calendar with tasks and events related to the specific user, to other users 
(subject to the :ref:`roles and permissions defined <user-guide-user-management-permissions>`), as well as to events 
defined for the whole organization or system.

Events in the System and Organization calendars can be viewed by all the users within the system/organization.
The ability to create, edit, and delete events depends on the user's 
:ref:`roles <user-guide-user-management-permissions>`
and :ref:`capabilities <admin-capabilities-org-calendar-events>`.


Create System and Organization Calendars
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Go to the **System>System Calendars**.

2. Click the :guilabel:`Create System Calendar` button.

3. The **Create System Calendar** page will appear:

Define the following fields:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Calendar Name***","This is the only mandatory field. Defines the name used to refer to the calendar in the system."
  "**Color***","Choose the color used to highlight events in the calendar by default."
  "**Scope***","Define if this is a system or organization calendar (meaningful for enterprise edition only)."

For example, we have created a System Calendar "Sales update meeting" that will displayed at the yellow background:

      |
  
.. image:: ../img/calendars/create_system_cal.png

|

Click the button in the top right corner to save the calendar. 

Add an Event to a Calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^

In order to add an event to a calendar:

1. Go to the :ref:`view page <user-guide-ui-components-view-pages>` of the calendar.

2. Click the :guilabel:`Create Calendar Event` button.

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
  
For example, we have created an event "Weekly report" event that will take place on July 16, 2015 from 3:35 to 4:35 PM.
The event will be highlighted as defined for the calendar by default.

     |
 
.. image:: ../img/calendars/create_system_cal_event.png


.. _user-guide-calendars-manage:

Manage System and Organization Calendars
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following actions can be performed for each calendar and calendar event from their 
:ref:`grids <doc-grids>`:

.. image:: ../img/calendars/system_cal_grid.png

|

- Delete a calendar/event from the system : click the |IcDelete| **Delete** icon.
  
- Get to the edit page of the  calendar/event: click the |IcEdit| **Edit** icon.
  
- Get to the view page of the  calendar/event: click the |IcView| **View** icon.

  From the view page you can also get to the edit page of delete the record using the corresponding buttons.
  You can also :ref:`add a comment <user-guide-activities-comments>` to the calendar event from its view page.





.. |UserMenu| image:: ../../img/buttons/user_menu.png
   :align: middle
   
.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle