.. _admin-guide--workflows--unqualified-sales-lead:

Unqualified Sales Lead Workflow
===============================

.. contents:: :local:

In OroCRM, every lead can be qualified into an opportunity, or disqualified, if it is clear that the deal is not going to progress. You can qualify leads either using the actions on the lead page, or using the steps and transitions of the enabled system Unqualified Sales Lead workflow. This workflow represents the alternative user experience and sequence of the lead qualification process, and is by default disabled.

.. note:: The Unqualified Sales Lead workflow is a system workflow and cannot be edited or deleted.

Activate the Workflow
---------------------

To enable the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the workflow row in the table of all workflows, and click |IcActivate| **Activate**.

   .. image:: /admin_guide/img/workflows/unqualified_sales_lead_activate_from_grid.png
      :alt: Activate unqualified sales lead workflow from the table of all workflows

   Alternatively, click once on the workflow to open its page, and on the workflow page click |IcActivate| **Activate** on the top right.

   .. image:: /admin_guide/img/workflows/unqualified_sales_lead_wf.png
      :alt: Unqualified sales lead workflow screen under system > workflows in the main menu

When the workflow is enabled, the following transitions are available on the lead page:

* **Qualify**
* **Disqualify**
* **Reactivate** (when the lead is disqualified)

.. image:: /admin_guide/img/workflows/unqualified_sales_lead_activated_lead_page.png
   :alt: The transitions of the unqualified sales lead workflow on the lead page

Deactivate the Workflow
-----------------------

To deactivate the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the workflow row in the table of all workflows, and click |IcDeactivate| **Deactivate**.

   .. image:: /admin_guide/img/workflows/unqualified_sales_lead_deactivate_from_grid.png
      :alt: Deactivate unqualified sales lead workflow from the table of all workflows

   Alternatively, click once on the workflow to open its page, and on the workflow page click |IcDeactivate| **Deactivate** on the top right.

   .. image:: /admin_guide/img/workflows/deactivate_unqualified_sales_lead_workflow_wf_page.png
      :alt: Deactivate unqualified sales lead workflow from its page

When the workflow is disabled, the workflow transitions are absent from the lead page. Instead, the following action buttons are available:

* **Convert to Opportunity**
* **Disqualify**

.. image:: /admin_guide/img/workflows/unqualified_sales_lead_disabled_lead_page.png
   :alt: The action buttons on the lead page when the unqualified sales lead workflow is disabled

Converting a lead into an opportunity means that you are qualifying it as a potential deal. Once the lead is converted into an opportunity, it is marked *Qualified* and is no longer available in the **Open Leads** table.

**Related Topics**

* :ref:`Leads <user-guide-system-channel-entities-leads>`
* :ref:`Opportunities <user-guide-system-channel-entities-opportunities>`
* :ref:`Business-to-business Sales <user-guide-business-to-business-sales>`
* :ref:`Workflow Management <doc--system--workflow-management>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin