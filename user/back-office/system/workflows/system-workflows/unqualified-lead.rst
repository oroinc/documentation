:oro_documentation_types: OroCRM

.. _system--workflows--unqualified-sales-lead-workflow:

Configure Unqualified Sales Lead Workflow in the Back-Office
============================================================

.. begin

To enable the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the workflow row in the table of all workflows, and click |IcActivate| **Activate**.

   .. image:: /user/img/system/workflows/unqualified_sales_lead_activate_from_grid.png
      :alt: Activate unqualified sales lead workflow from the table of all workflows

   Alternatively, click once on the workflow to open its page, and on the workflow page click |IcActivate| **Activate** on the top right.

   .. image:: /user/img/system/workflows/unqualified_sales_lead_wf.png
      :alt: Unqualified sales lead workflow screen under system > workflows in the main menu

When the workflow is enabled, the following transitions are available on the lead page:

* **Qualify**
* **Disqualify**
* **Reactivate** (when the lead is disqualified)

.. image:: /user/img/system/workflows/unqualified_sales_lead_activated_lead_page.png
   :alt: The transitions of the unqualified sales lead workflow on the lead page

To deactivate the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Hover over the more options menu at the end of the workflow row in the table of all workflows, and click |IcDeactivate| **Deactivate**.

   .. image:: /user/img/system/workflows/unqualified_sales_lead_deactivate_from_grid.png
      :alt: Deactivate unqualified sales lead workflow from the table of all workflows

   Alternatively, click once on the workflow to open its page, and on the workflow page click |IcDeactivate| **Deactivate** on the top right.

   .. image:: /user/img/system/workflows/deactivate_unqualified_sales_lead_workflow_wf_page.png
      :alt: Deactivate unqualified sales lead workflow from its page

When the workflow is disabled, the workflow transitions are absent from the lead page. Instead, the following action buttons are available:

* **Convert to Opportunity**
* **Disqualify**

.. image:: /user/img/system/workflows/unqualified_sales_lead_disabled_lead_page.png
   :alt: The action buttons on the lead page when the unqualified sales lead workflow is disabled

Converting a lead into an opportunity means that you are qualifying it as a potential deal. Once the lead is converted into an opportunity, it is marked *Qualified* and is no longer available in the **Open Leads** table.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin
