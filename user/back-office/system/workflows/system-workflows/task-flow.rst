:oro_documentation_types: OroCRM, OroCommerce

.. _doc--workflows--task-flow:

Configure Task Flow in the Back-Office
======================================

Overview
--------

The **Task Flow** workflow helps you proceed through phases of work on the task.

Available options depend on the current status of the task. The following table describes which options are available for each of the statuses and how the corresponding transitions change the task status.

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

For information on workflows, see the :ref:`Workflow Management <doc--system--workflow-management>` guide.

Follow the Workflow
-------------------

From the Task View Page
^^^^^^^^^^^^^^^^^^^^^^^

The corresponding section on the task view pages contains the transition buttons.

.. image:: /user/img/system/workflows/activities_tasks_taskflow.png

From the Related Entity View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By adding a record as a context to a task, you specify that this record is somehow related to the task. Entity records that are specified in a task context have the task displayed in the **Activity** sections on their view pages.

For a task activity on the related entity view page, you can use the transition icons to progress through the **Task Flow** workflow.

.. image:: /user/img/system/workflows/related_activity_taskflow.png


