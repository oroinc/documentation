:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-navigation-sidebar-panel:

Sidebar Panel
=============

The sidebar panel is a host for a number of widgets that provide fast and convenient access to frequently needed 
information, such as recent emails or the task list. 

By default, the sidebar panel is located on the right side of the page. However, subject to the configuration settings of your organization, there can be a sidebar on the left, two sidebars (on the left and the right), or no sidebar at all. The system administrator defines the location of the sidebar for the whole organization.

Add a Widget to the Sidebar
---------------------------

Out of the box, any sidebar can contain widgets of three types:

- **Recent Emails** widget: Set up the widget to get access to your emails in one or several of the
  synchronized mailboxes, or to all the emails in your Oro mailbox.

- **Sticky Notes**:  Place free-text notes and reminders.

- **Task List**: See the most recent tasks assigned to you.

To add a new widget, use **+**, select the widget type and click the **OK** button.

.. image:: /user/img/getting_started/navigation/sb_select.png
   :alt: Add the widget popup

The newly added widget will appear on the sidebar, below the existing widgets. To reorder widgets on the sidebar, drag
and drop them with your mouse.

You can add more than one widget of any type if necessary. For example, you can stick any amount of notes or follow several different email folders or mailboxes synchronized to your account in the Oro application.

Expand/Collapse the Sidebar
---------------------------

Initially, the sidebar panel is minimized. Hover over the icon to see the widget header.

To expand the sidebar panel, click the |IcArrowLeft| arrow at its bottom.

To collapse the panel back, click the |IcArrowRight| arrow again.

Expand/Collapse a Widget
------------------------

To see the widget content:

- Click the icon on a minimized bar.

- Click |IcArrowChevronRight| next to the header on the expanded bar.

- Click |IcArrowChevronDown| to fold the widget.

To reorder widgets on the sidebar, drag and drop them with your mouse. This works in both the collapsed and expanded states.

This way, you can keep some of the content visible at all times and keep fewer used widgets minimized.

Manage the Widgets
------------------

As shown below, each widget contains a header (1), content (2), and icons (3).

.. image:: /user/img/getting_started/navigation/sb_view.png
   :alt: Show header, content, and icons on the widget

You can:

- |BRefresh| Refresh the content (e.g., load the most current emails or tasks).

- |IcSettings| Configure the widget settings.

- |IcDelete| Remove the widget from the sidebar.

- **x** close the widget (appears when the panel is minimized).

.. hint:: You can add several widgets of the same type and define different settings for them. For example, you can keep notes with different content or email widgets for different folders.

Default Sidebar Widgets
-----------------------

This section describes three sidebar widgets available in the Oro application out-of-the-box.

.. note:: You can find more information on dashboard widgets in the corresponding :ref:`Dashboard Widgets topic <user-guide--business-intelligence--dashboards>`.

Recent Emails Sidebar Widget
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The widget informs you about new and unread emails and gives you a convenient way to access them.

.. image:: /user/img/getting_started/navigation/sb_emails.png
   :alt: The actions you can do with a widget

From the widget, you can:

- Access the **All Emails** page and see all your emails in the Oro application (1).

- Mark all the visible emails as read (2).

- Access any of the displayed emails (3).

- Mark any of the displayed emails as read (4).

- Reply, reply to all, or forward the emails (5).

- Get to the view page of the user who sent you the email (6).

Click the |IcSettings| icon to configure the widget.

.. image:: /user/img/getting_started/navigation/sb_emails_set.png
   :alt: Configuration settings of a widget

- Configure the widget to display all the emails from your Oro mailbox, any specific folder, or the mailbox that has been synchronized.

- Change the number of emails displayed.

- Define the default action shown when the sidebar panel is expanded.

.. hint: To ensure you do not miss critical emails, configure your mailbox to sort them in a specific folder, then configure the widget to display this folder and place it at the top of your sidebar panel.

Sticky Note Sidebar Widget
^^^^^^^^^^^^^^^^^^^^^^^^^^

Sticky notes are a great way to keep reminders and memos. You can keep them organized in your Oro sidebar panel.

Click the |IcSettings| to change the content of a note.

You can keep any number of sticky notes in the panel. If the panel is expanded, you can minimize some notes and keep others visible (such as those due today). You can quickly delete the note when you don't need it anymore.

Task List Sidebar Widget
^^^^^^^^^^^^^^^^^^^^^^^^

This widget displays tasks assigned to you. Tasks are ordered by their due dates in ascending order—the earlier the due date, the higher on the list a task is displayed. Overdue tasks appear in red.

You can perform the following actions with the task list sidebar widget:

* Expand the widget by clicking |IcTasks| on the minimized sidebar and |IcCaretRight| on the maximized sidebar.

* Collapse the widget by clicking |IcTimes| on the minimized sidebar and |IcCaretDown| on the maximized sidebar.

* Refresh the list of tasks by clicking |IcRefresh|.

* Configure the parameters for a widget by clicking |IcSettings|.

* Change a number of displayed tasks by entering the required value into the **Number of tasks to show** field. Click **OK**.

* Remove the widget from a dashboard by clicking |IcDelete|.


.. include:: /include/include-images.rst
   :start-after: begin

