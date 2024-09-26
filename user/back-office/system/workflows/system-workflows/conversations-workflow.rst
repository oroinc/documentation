.. _system--workflows--conversations-backoffice-workflow:

Configure Backoffice Conversations Workflow in the Back-Office
==============================================================

Oro offers a :ref:`conversation feature <doc-activities-conversations>` for easy communication between back-office and storefront users. Conversations allow back-office staff to share information and communicate with other back-office users or customer users in the storefront. The Conversations Workflow is a system workflow that provides the following default statuses for the conversation feature: Active, Inactive, Closed.

.. image:: /user/img/system/workflows/conversations/activities-conversations-view.png
   :alt: Illustration of the workflow transition on a view page of a conversation

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Conversation Workflow** to open it.

.. image:: /user/img/system/workflows/conversations/conversation-flow-grid.png
   :alt: Conversations workflow in the Workflow grid

By default, the Conversation workflow is active. On its view page, you have an option to disable the workflow by clicking **Deactivate** on the top right. As it is a system workflow, it cannot be edited or deleted.

Steps and Transitions
---------------------

The following table describes which options are available for each of the statuses of the conversation:

.. csv-table::
   :header: "Status", "Options"
   :widths: 15, 15

   "Active", Close"
   "Closed","Reopen"

.. image:: /user/img/system/workflows/conversations/conversations-wf-view-page.png
   :alt: View page of the conversation workflow showing the workflow diagram with transitions and a button to deactivate the workflow
