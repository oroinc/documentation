.. _doc--workflows--task-flow:

Task Flow
=========

.. contents:: :local:

The Task Flow workflow helps you proceed through phases of work on the task. The available options depend on the current status of the task.

.. note:: The Task Flow is a system workflow and cannot be edited or deleted.

Activate the Workflow
---------------------

To activate the task flow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the task workflow row in the table of all workflows, and click |IcActivate| **Activate**.
    
   .. note:: Alternatively, click once on the workflow to open its page, and on the workflow page click |IcActivate| **Activate** on the top right.


 The following table describes which options are available for each of the statuses and how the corresponding transitions change the task status.

+----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+
| Current Status | Available Options                                                                                                                                                                                    | New Status  |
+================+======================================================================================================================================================================================================+=============+
| Open           | Click **Start Progress** to start working on this task.                                                                                                                                              | In Progress |
|                +------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+
|                | Click **Close** to close the task.                                                                                                                                                                   | Closed      |
+----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+
| In Progress    | Click **Stop Progress** to denote that you have stopped working on this task, but the task is not yet completed. (E.g., the description of what neds to be done for this task is to be readjusted.)  | Open        |
|                +------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+
|                | Click **Close** to close the task.                                                                                                                                                                   | Closed      |
+----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+
| Closed         | Click **Reopen** to actualize the task again.                                                                                                                                                        | Open        |
+----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+-------------+

When the workflow is enabled, the following transitions are available on the page of a specific task:

.. image:: /user_guide/img/getting_started/activities/tasks/activities_tasks_taskflow.png
   :alt: The transitions on the page of a task when the task flow is activated

By adding a record as a context to a task, you specify that this record is related to the task. :ref:`Entity records <entities-management>` that are specified in a task context have the task displayed in the **Activity** sections on their pages. 

For a task activity on the related entity page, you can use the transition icons to progress through the Task Flow.

.. image:: /user_guide/img/getting_started/workflows/task_flow/related_activity_taskflow.png
   :alt: The transition icons for contexts in the activities section of related entities

Deactivate the Workflow
-----------------------

To deactivate the task flow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the task workflow row in the table of all workflows, and click |IcDeactivate| **Deactivate**.
    
   .. note:: Alternatively, click once on the workflow to open its page, and on the workflow page click |IcDeactivate| **Deactivate** on the top right.

**Related Topics**

* :ref:`Tasks <doc-activities-tasks>`
* :ref:`Workflow Management <doc--system--workflow-management>`



.. include:: /img/buttons/include_images.rst
   :start-after: begin