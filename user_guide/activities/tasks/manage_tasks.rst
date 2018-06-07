.. _doc-activities-tasks-actions-edit-detailed:
.. _doc-activities-tasks-actions-edit-fromgrid:
.. _doc-activities-tasks-actions-edit-fromviewpage:
.. _doc-activities-tasks-actions-edit-fromuserpage:
.. _doc-activities-tasks-actions-edit-fromrelatedpage:
.. _doc-activities-tasks-actions-edit-fromcalendar:


Manage Tasks
------------

.. begin_manage_tasks

You can view, edit and delete tasks from the following pages of your Oro application:

*  `From the Page of All Tasks`_
*  `From the Task Page`_
*  `From the Assignee's Profile`_
*  `From the Page of a Related Record`_
*  `From My Calendar`_

.. note:: Please note that:

   * By default, you can edit only tasks that are assigned to you.
   * You can add reminders only to a task that is not overdue.
   * You cannot edit a task status if the :ref:`task flow <doc--workflows--task-flow>` is enabled for your Oro application.

From the Page of All Tasks
~~~~~~~~~~~~~~~~~~~~~~~~~~

To manage a specific task from the page of all tasks:

1. Navigate to **Activities > Tasks** in the main menu.
2. Click the |IcEllipsisH| **More Options** menu at the end of the corresponding task row and select one of the following actions:

    * |IcView| View
    * |IcEdit| Edit
    * |IcDelete| Delete

    .. image:: /user_guide/img/activities/AllTasksPageNew.png
      :alt: The actions you can perform to tasks from the page of all tasks

From the Task Page
~~~~~~~~~~~~~~~~~~

To manage a specific task from its page:

1. Navigate to **Activities > Tasks** in the main menu.
2. Click once on the required task to open it.
3. Select one of the following actions:

   * |IcShare| Share
   * |IcContext| Add Context
   * |IcEdit| Edit
   * |IcDelete| Delete
   * |IcSendEmail| Send Email
   * Add Comment

.. image:: /user_guide/img/activities/ManageTasksTaskPage.png
   :alt: The actions you can perform on the task page


4. If the :ref:`task flow <doc--workflows--task-flow>` is enabled, you can:

   * |IcStart| Start/ |IcStop| Stop Progress of the task
   * |IcActivate| Close the task

.. note:: To delete a bulk of tasks in one go, click the |IcEllipsisH| **More Actions** menu at the end of the table header row and then click |IcDelete| **Delete**.

            .. image:: /user_guide/img/activities/tasks/tasks_delete1.png
               :alt: Delete a bulk of tasks

From the Assignee's Profile
~~~~~~~~~~~~~~~~~~~~~~~~~~~

When user is assigned a task, it appears in the **User Tasks** subsection under **Additional Information** on their profile page.

To manage a task from the assignee's profile page:

1. Open the assignee's profile.
2. Click **Additional Information > User Tasks**.
3. Click the |IcEllipsisH| **More Options** menu at the end of the row with the task you would like to edit and select one of the following actions:

    * |IcView| View
    * |IcEdit| Edit
    * |IcDelete| Delete

.. image:: /user_guide/img/activities/TaskUserProfile.png
   :alt: Manage tasks from the assignee's profile page

From the Page of a Related Record
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Records that are specified in a task context have the task displayed in the **Activity** sections of their pages.

1. Navigate to the page of a related record.
2. Click on the task in the **Activity** section, and click to expand it and view its details.
3. Click the |IcEllipsisH| **More Options** menu at the end of the task header and select one of the following actions:

   * |IcContext| Add Context
   * |IcView| View Task
   * |IcEdit| Update Task
   * |IcDelete| Delete Task
   * |IcStart| / |IcStop| :ref:`Start/Stop Progress <doc--workflows--task-flow>`
   * |IcActivate| :ref:`Close the task <doc--workflows--task-flow>`

4. Click **Add Context** on the lower-right to add a comment to the task.

.. image:: /user_guide/img/activities/ManageTasksInRelatedRecord.png
   :alt: Add context to the task

From My Calendar
~~~~~~~~~~~~~~~~

You can also manage tasks from the My Calendar page and the Today’s Calendar widget.

1. Navigate to My User on the top right of the page.
2. Click **My Calendar**.
3. Click on a specific task in the calendar.
4. On the task information card, select one of the following actions:

   * |IcDelete| Delete
   * |IcView| View Task
   * |IcEdit| Edit task

.. image:: /user_guide/img/activities/ManageTasksInMyCalendar.png
   :alt: Task information on calendar pages

.. end_manage_tasks


.. include:: /img/buttons/include_images.rst
   :start-after: begin
