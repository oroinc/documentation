.. _doc-activities-events-actions-add-detailed:
.. _doc-activities-events-actions-add-fromgrid:
.. _doc-activities-events-information:
.. _doc-activities-events-schedule:
.. _doc-activities-events-actions-add:

Add a Calendar Event
--------------------

.. start_calendar_event

You can add calendar events from the following pages in your Oro application:

.. contents:: :local: 

From the Page of All Events
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a calendar event when viewing a list of events:

1. Navigate to **Activities > Calendar Events** in the main menu.
2. On the page that opens, click **Create Calendar Event** on the top right. 

   .. image:: /user_guide/img/getting_started/activities/events_add_fromgrid.png

3. On the **Create Calendar Event** page, provide the following information: 

   .. image:: /user_guide/img/getting_started/activities/activities_events_actions_add0.png

  
   * **Owner** --- A user who is eligible to manage this event and who is responsible for it. The event appears in the calendar of the owner.

     .. note:: By default, a person who is creating an event is selected as its owner. Change the owner if required. Select another user from the list. You may use the search field to quickly find the required user: start typing the name of the user to get suggestions and then click the required name. Alternatively, you may click the hamburger menu next to the **Owner** field and select the owner in the **Select Owner** dialog box.

   * **Title** --- A name for your calendar event.
   * **Description** --- Any details regarding the event: summary, agenda, etc. Use the embedded editor to format text, add images, links, etc.

     .. important:: Whether the embedded editor is available, is specified in the configuration. If you have access to the **My Configuration** page, see the **WYSIWYG settings** section of the :ref:`Display Settings <doc-my-user-configuration-display>` description. 
     
       * If you do not have access to the page, contact your administrator who can enable the editor at the organization level. 
       * If you are an administrator, see the **WYSIWYG settings** section of the :ref:`System Display Settings <doc-configuration-display-settings>` description.

   * **Color** --- Select the color to label the event with. The first item is the calendar color and it is selected by default. Click different color to change the setting. To customize the color using a color picker, click the last color in the line (initially it is blank).


   .. image:: /user_guide/img/getting_started/activities/activities_events_actions_add2.png


   .. important:: The list of available colors is specified in the system configuration. Please contact your administrator if you want to change it. If you are an administrator, see the **Calendar settings** section of the :ref:`Display Settings <doc-configuration-display-settings>` description.

   * **Add to ...** or **Calendar** --- You will see one of these additional settings if any system calendars are defined in the system: 

     * The **Add to ...** option appears when only a single system calendar exists. When enabled, the event is added to the system calendar.
     * The **Calendar** list appears when several system calendars exist. Select the calendar from the list to move the event to it.

   * **Guests** --- People invited to the event inside and outside your company. Click the field to select add Oro user to the event. To add a person outside your company as a guest, type their email address in the field. The number of guests is not limited. The event appears in the calendar of every invited Oro users. To cancel the invitation, click the **x** icon next to the guest name.

   * **Reminders** --- A notification about the upcoming event. Click **+Add** to configure when and how OroCommerce and OroCRM remind the participants about the event:

     * Specify the type of the notification: whether to show a flash message in Oro application or send the notification email.
     * Select the time units in which the time lag between a reminder and the event is measured: minutes, hours, days, or weeks.
     * Enter what number of selected time intervals the time lag between a reminder and the event comprises.

     To remove a reminder, click the **x** icon next to it.

     .. important:: Reminders are disabled for recurring events.

     .. note:: In Oro applications, an event start time is displayed adjusted according to the recipient's timezone settings both in notification emails and flash messages.  (That is, if the event is set to start at 7 a.m. in the organizational calendar that is run according to the New York time, the start time displayed in the reminder to the user in Tokio will be 8 p.m.)

   * **Call via Hangout** --- Enable this option to plan a Google Hangout meeting for the calendar event. When enabled, a button that starts Hangout call appears on the event card and view page when viewed by the guest.

     .. important:: For Hangouts calls to be possible, integration with Google services should be created. Contact your administrator or see :ref:`Google Integration Settings <admin-configuration-integrations-google>` for more information.

     .. tip:: For more help on Hangouts calls, see `Hangouts Help <https://support.google.com/hangouts#topic=6386410>`__ on google.com.

   * **Context** --- Select a record that has a meaningful relation to the event. Start entering a record name to quickly find the required user, and when the list of suggestions appears, click the required name to select it. The event is now linked to the selected item and is displayed in its **Activity** section.

   * **Start** --- Specify day and time when the event starts. Click the day field to select a day in the calendar dialog. Click the time field to select a time from the list. Alternatively, you can type in date and time values.

     .. note:: The time option is disabled when the **All-day event** is selected.

   * **End** --- Specify day ant time when the event ends. Click the day field to select a day on the calendar dialog. Click the time field to select a time from the list. Alternatively, you can type in date and time values.

      .. note:: The time option is disabled when the **All-day event** is selected.

   * **All-day event** --- Enable this option to reserve the whole day(s) for the event.

   * **Repeat** --- Enable this option for a recurring event. Once you enable it, you can configure the event schedule. 
     
     * **Repeats**: Select how often the event repeats: daily, weekly, monthly, or yearly. 
     * **Ends**: Select when the event ends (never, after ... occurrences, by date).

4. Click **Save and Close**.

From the Page of a Related Record
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a calendar event when viewing the related record (e.g. opportunity, customer user, etc.):

1. On the page of the selected related record, click **More Actions** on the top right of the page and click **Add Event** on the list.

   .. image:: /user_guide/img/getting_started/activities/events_actions_add_related0.png
    
2. In the **Add Event** dialog box, specify event details, as described in the **Create Calendar Event From the Page of All Events**  section above.

   .. image:: /user_guide/img/getting_started/activities/events_actions_add_related.png

3. Click **Save** on the top right.

Calendar events are displayed in the **Activity** section of the pages of related records.

.. note:: If you create a calendar event from the view page of a related entity record, this entity record appears as a context of the calendar event.

.. _user-guide-activities-events-add-my-calendar:

From My Calendar
^^^^^^^^^^^^^^^^

To add calendar events on the **My Calendar** page or in the **Today's Calendar** widget:

1. Under your user name on the top right of the application page, click **My Calendar**.

2. Click the empty cell that represents the desired time period. If you are adding an event from the widget, you can alternatively click the **New Event** button on the top right of the widget.

3. In the **Add Calendar Event** dialog box, specify the event details, as described in the **Create Calendar Event From the Page of All Events**  section.
  
   .. image:: /user_guide/img/getting_started/activities/activities_events_actions_add.png

4. Click **Save**. The event appears in your calendar if you have specified yourself as an event owner or a guest.

   .. important:: Refresh a page to update the widget after you created the new event.

.. _user-guide-activities-events-add-system-calendar:

From the Page of a System Calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an event to a system calendar from its page:

1. Navigate **System > System Calendars** in the main menu.
2. Click on the required calendar.
3. On the page of the selected calendar, click **Create Calendar Event**.
4. The **Create Calendar Event** page appears. Specify the event details.
5. Click **Save and Close**.
  
  .. image:: /user_guide/img/getting_started/calendars/create_system_cal_event_new.png

.. finish_calendar_event