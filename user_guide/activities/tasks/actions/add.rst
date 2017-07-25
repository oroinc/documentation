.. _doc-activities-tasks-actions-add-detailed:

Create a Task
^^^^^^^^^^^^^

.. contents:: :local:
   :depth: 1

.. _doc-activities-tasks-actions-add-fromgrid:

From the Tasks Grid
~~~~~~~~~~~~~~~~~~~

.. begin_create_task

To add a task when viewing a list of tasks:

1. In the main menu, navigate to **Activities>Tasks**.

   The **Tasks** page opens.



2. On the **Tasks** page, click the **Create Task** button in the upper-right corner of the page.

   |

   .. image:: /user_guide/img/activities/tasks/tasks_add_fromgrid.png

   |

   The **Create Task** page opens.


3. On the **Create Task** page, fill in the required information as described in the :ref:`Detailed Task Information <doc-activities-tasks-information>` section.

   |

   .. image:: /user_guide/img/activities/tasks/activities_tasks_actions_add0.png

   |

4. Click **Save and Close** in the upper-right corner of the page.

.. finish_create_task

.. _doc-activities-tasks-actions-add-fromuserpage:

From the User Profile
~~~~~~~~~~~~~~~~~~~~~

From a user profile, you can create a task and automatically assign it the user.

To create a task from a user profile:

1. Open the profile of the user to whom you want to assign a task.

2. Click **More Actions** in the upper-right corner of the page and then click **Assign Task** on the list.

   |

   .. image:: /user_guide/img/activities/tasks/activities_tasks_actions_add_userpage1.png

   |

3. In the **Assign Task To** dialog, specify the required data. For the description of the fields see the :ref:`Complete Task Information <doc-activities-tasks-information>` section.

   |

   .. image:: /user_guide/img/activities/tasks/activities_tasks_actions_add_userpage2.png

   |

4. Click **Create Task**. The task appears in the **Additional Information** section, **Tasks** subsection of the user profile.


.. note:: An administrator may define that users can be specified as a context for a task. In this case, the **More Actions** list on the user's profile page will have two similar options: **Assign Task** and **Add Task**. The difference between them is the following:

 - When you select **Assign Task**, the task that you create will be assigned to the user from which profile you perform this action.
 - When you select **Add Task**, the task that you create can be assigned to any user, but the user from which profile you perform the action, will appear as a context of the task.

 See more about **Add Task** in the :ref:`Create a Task from the Related Entity Record View Page <doc-activities-tasks-actions-add-fromrelated>` section.


.. _doc-activities-tasks-actions-add-fromrelated:

From the Related Entity Record View Page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: By сreating a task from a record view page, you specify that this record relates to the call in some way.

To create a task when viewing the related record (e.g. opportunity, customer user, etc.), complete the following:

1. On the related entity view page, click **More Actions** in the upper-right corner of the page and click **Add Task** on the list.

     |

     .. image:: /user_guide/img/activities/tasks/tasks_actions_add_related0.png

     |

2. In the **Add Task** dialog, specify the required data. For the description of the fields see the :ref:`Complete Task Information <doc-activities-tasks-information>` section.

   |

   .. image:: /user_guide/img/activities/tasks/tasks_actions_add_related.png

   |

3. Click **Save**.

You can see the task in the **Activity** section of the entity view page.

.. note::
   If you create a task from the view page of a related entity record, this entity record appears as a context of the task.

.. _doc-activities-tasks-information:

Detailed Task Information
~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin_detailed_task_info

When adding or editing a task, fill in the following information:


* **Subject**—Short, one-phrase description of what the task is about. It serves as a name of the task.

* **Description**—Detailed statement of what work is to be done in relation to the task. Use the embedded editor to format text, add images, links, etc.

  .. important::
   Whether the embedded editor is available, is specified in the configuration. If you have access to the **My Configuration** page, see the **WYSIWYG settings** section of the :ref:`Display Settings <doc-my-user-configuration-display>` description.

     If you do not have access to the page, contact your administrator who can enable the editor at the organization level.

     If you are an administrator, see the **WYSIWYG settings** section of the :ref:`System Display Settings <doc-configuration-display-settings>` description.

* **Due Date**—The day and time when the task must be completed.

   Click the day field to select a day in the calendar dialog.

   Click the time field to select a time from the list.

   Alternatively, you can type in date and time values.

* **Status**— The phase of work on the task. See :ref:`Task Statuses <doc-activities-tasks-statuses>` for more information.

  .. important:: You cannot set the task status if the task flow is enabled.

* **Priority**— Nominates an order in which the task should be managed. Can be *High*, *Normal*, or *Low*. Higher-priority tasks should be managed first.

* **Assigned To**—The user who is responsible for doing the work related to the task. The task appears in the calendar of the assignee.

  .. note:: By default, a person who creates an task is selected as its assignee. Change the assignee if required. Select another user from the list. You may use the search field to quickly find the required user: start typing the name of the user and when suggestions appear, click the required name. Alternatively, you may click the hamburger menu next to the field and select the owner in the **Select Assigned To** dialog.


* **Reminders**—A notification about the upcoming task's due date.

  Click the **+Add** button to configure when and how OroCommerce and OroCRM remind the participants about the task:

  + Specify the type of the notification: whether to show a flash message in Oro application or send the notification email.

  + Select the time units in which the time lag between a reminder and the task's due date is measured: minutes, hours, days, or weeks.

  + Enter what number of selected time intervals the time lag between a reminder and the task's due date comprises.

  To remove a reminder, click the **x** icon next to it.

  .. note:: In Oro applications, a task due date and time is displayed adjusted according to the recipient's timezone settings both in notification emails and flash messages.  (That is, if the task due time is displayed as 7 a.m. at the level of the organization run according to the New York time, the due time displayed in the reminder to the user who uses the Tokio time will be 8 p.m.)

* **Context**—Select a record that has a meaningful relation to the task. Start entering a record name, and when the list of suggestions appears, click the required name to select it. The task is now linked to the selected item and is displayed in its **Activity** section.

.. finish_detailed_task_info

