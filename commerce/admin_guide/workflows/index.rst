.. STATUS
.. OroCRM (crm/admin_guide/record_mngm_config/workflow_management.rst)
.. and OroCommerce (commerce/configuration_guide/workflows/index.rst) are aligned.
.. Copied into the shared platform folder (platform/workflow_management/index.rst)

.. _user-guide--system--workflow-management:

.. TIP:
.. Please never replace or remove the existing label (e.g., by changing the 'user-guide' with 'doc'.
.. If you really need a different label, please, put it next to the existing one.

.. _doc--system--workflow-management:

Workflow Management
===================

.. contents:: :local:
   :depth: 4

.. TODO add information on exclusive active and exclusive record group

.. TODO add workflow configuration info

Overview
--------

In OroCommerce, a workflow is a business process that involves multiple user interactions or sequential phases. It may trigger other workflows and change the status of the items involved in a business process.

In the storefront, workflows organize and direct users’ work (e.g. during the checkout), making them follow particular steps in a pre-defined order (e.g. provide shipping address, then select shipping method from the options supported for the destination), or preventing them from performing actions that either contradict or conflict with the logical steps of a process (e.g. a customer may not be able to submit an order without their manager's approval).

In the OroCommerce management console, workflows help users follow standard procedures that may be of a non-linear nature with alternating flow that depends on the available information, related items status, connectivity with integrated solutions, etc.

.. _user-guide--system--workflow-management-system-custom:

System vs Custom Workflows
--------------------------

In Oro applications, any workflow may be classified as either **system** or **custom**. *System* workflows are provided out of the box. Their modification is limited in order to keep core functionality operational. However, if you create a *Custom* workflow from scratch, you can tailor it for your needs without any restrictions.

For more information on system and custom workflows, see :ref:`System Workflows <doc--workflows--actions--system>` and :ref:`Custom Workflows <doc--workflows--actions--custom>`.


Available System Workflows
^^^^^^^^^^^^^^^^^^^^^^^^^^

The following system workflows are provided out of the box in OroCommerce:

* :ref:`Checkout <system--workflows--checkout-workflow>`

* :ref:`Alternative Checkout <system--workflows--alternative-checkout-workflow>`

* :ref:`Single Page Checkout <system--workflows--single-page-checkout>`

* :ref:`Quote Backoffice <system--workflows--quote-backoffice-workflow>`

* :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>`

* :ref:`RFQ Backoffice <system--workflows--rfq-backoffice-workflow>`

* :ref:`RFQ Frontoffice <system--workflows--rfq-frontoffice-workflow>`

* :ref:`Task Flow <doc--workflows--task-flow>`


.. _user-guide--system--workflow-management-steps-transitions:

Workflow Steps, Transitions, and Attributes
-------------------------------------------

.. TODO Fix transitions if necessary (may it launch on schedule or on event?) .. Yes, it can, the information about it is in the dev guide.

Each process or action applied to a record is called a workflow transition. On the interface, transitions are usually initiated when a user clicks the corresponding button or icon. There are two types of transitions:

-	Transitions that take a user from one state to another and connect to each step in the workflow.
-	Self-transitions that do not change steps in the workflow.

Every workflow has the **Start** transition that launches the workflow.

A transition can be defined as soon as there is at least one step besides **Start**. However, it is often simpler to define all workflow steps and then all the transitions between them.

.. image:: /admin_guide/img/workflows/1_transitions_steps.png

Attributes are characteristics of the record. For example, a ZIP code and a street name are attributes of an address. In the course of each transition, you can change some attributes of the processed record.

A workflow may have configuration parameters (also known as variables). For example, the Alternative Checkout workflow includes reviewing of an order by an authorized person. This is usually required only for orders exceeding a certain amount, so the workflow's configuration parameter enables you to set an order subtotal limit that triggers the alternative checkout.

.. image:: /admin_guide/img/workflows/workflow_config_prameters.png

If enabled (see the section below), the workflow widget displays the process steps defined in workflow configuration on the record view page. Multiple workflow widgets can be displayed for one record at the same time.

.. image:: /admin_guide/img/workflows/2_wf_steps_new.png

.. _doc-workflows-actions-create:

Create a Workflow
-----------------

To create a workflow for an entity:

1. In the main menu, navigate to **System > Workflows**.
2. Click **Create Workflow** on the top right of the page.

   .. image:: /admin_guide/img/workflows/3_create_wf_button.png

3. On the **Create Workflow** page, specify the details of your workflow in the **General** section.

   .. image:: /admin_guide/img/workflows/4_create_wfpng.png

4. Once the details in the **General** section have been specified, add steps and transitions in the **Designer** section.

5. When done, click **Save**.

.. _doc-workflows-actions-create-general:

General Section
^^^^^^^^^^^^^^^

The **General** section of the create a workflow page contains the following information:


.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30


  "**Name**", "The name of the workflow."
  "**Related Entity**", "A related entity is the entity for which the workflow is created. When the workflow is active, it can be launched and executed on the records of its related entity."
  "**Exclusive Active Groups**","Exclusive Active Groups is a list of group names for which the current workflow should be active exclusively. Determining Exclusive Record Groups allows to set up mutually exclusive workflows in order to configure how they each correlate in the system. This makes it possible for only one workflow to be active, or for an entity record to use only one workflow from the group at a time."
  "**Exclusive Record Groups**","Exclusive Record Groups specify how workflows apply to certain sets of records in order to limit their applicability. This lets users create specific workflows for specific segments (subsets) of records. For example, no concurrent transitions are possible among workflows in same exclusive record group."
  "**Default Step**", "Specifying the default steps launches the workflow in a particular step by default. For instance, when you activate Opportunity Management Flow, a newly created opportunity will appear as open, if **open** was specified as the default step.
  If no step is selected, all newly created records will have no workflow associated with them, and it must be launched with one of the starting transitions."
  "**Display Steps Ordered**", "Display Steps Ordered box is not checked by default.

   - **If checked**, all workflow steps are displayed in the workflow widget.
   - **If not checked**, only the steps that have actually been performed are displayed."

.. TODO add some clue on how to plan a workflow

.. _doc-workflows-actions-create-designer:

Using Workflow Designer
^^^^^^^^^^^^^^^^^^^^^^^

.. TODO rethink and adapt

The **Designer** section consists of a table and an interactive chart representations of a workflow.

.. image:: /admin_guide/img/workflows/5_table_chart_example.png

**Within the table**, you can perform the following actions for a **transition**:

-	**Update** (clicking the transition name opens the **Edit Transition** form).
-	**Clone** (clicking the |IcClone| **Clone** icon next to the transition name opens the **Clone Transition** dialog).
-	**Delete** (clicking the |IcDelete| **Delete** icon next to the transition launches name **Delete Confirmation** dialog).

**For a step**, you can perform the following action by clicking the corresponding icons in the **Actions** column:

- **Add a transition to a step** (clicking the **+** icon opens the **Add New Transition** dialog).
- **Update** (clicking the |IcEdit| **Edit** icon opens the **Edit Step** dialog).
- **Clone** (clicking the |IcClone| **Clone** icon opens the **Clone Step** dialog).
- **Delete** (clicking the |IcDelete| **Delete** icon launches the **Delete Confirmation** dialog).

.. image:: /admin_guide/img/workflows/designer_table.gif

**Within the chart**, you can:

- **Add a transition** (clicking the **+ Add Transition** button at the top of the chart opens the **Add Transition** dialog).
- **Add a step** (clicking the **+ Add Step** button at the top of the chart opens the **Add Step** dialog).
- **Autosort** (clicking the **Auto Sort** button at the top of the chart automatically shapes your chart).
- **Rearrange the chart** for clearer workflow view (drag-and-drop transitions and steps in the chart as required, or click the |IcExpand| **Expand** button in the top right corner of the chart).

.. image:: /admin_guide/img/workflows/auto_sort.gif

- **Zoom in/out** (click the |IcSearchPlus| **Zoom In** / |IcSearchMinus| **Zoom Out** button in the top right corner of the chart to zoom the chart in/out, or select zoom percent from the list).
- **Show transition labels** (select this check box in the top left corner of the chart to display transition labels in the chart).
- **Drag transitions from one step to another** (point to one of four corners of the step box, and when the cursor changes shape to the hand, click the corner and drag an arrow to another step).

.. image:: /admin_guide/img/workflows/drag_transition.gif

- **Undo/Redo changes** (click the |IcReply| **Undo** / |IcShare| **Redo** button at the top of the cart to revert or restore changes made to the chart).
- **Edit/Clone/Delete** a step/transition (point to the step/transition button, and when the |IcCaretDown| arrow appears, click it, and then click the |IcEdit| **Edit** / |IcClone| **Clone** / |IcDelete| **Delete** icon.

.. note:: All actions available for transitions and steps in the table are available in the chart as well.

.. image:: /admin_guide/img/workflows/6_manage_chart.png

Example Introduction
~~~~~~~~~~~~~~~~~~~~

As an example, we are going to create the Opportunity Support Flow workflow to show how a workflow is configured and visualized.

Add a Step
~~~~~~~~~~

.. TODO rethink and adapt

To add a step to a workflow:

1. Click **Add Step** in the top right corner of the chart.

   .. image:: /admin_guide/img/workflows/7_add_step.png

2. In the **Add Step** dialog, complete the following fields:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30

   "**Name**", "The name of the step that will be displayed on the entity record."
   "**Position**", "A number that determines the position of the step in the workflow. The higher the number, the further the step is from the start."
   "**Final**", "This option marks the step as the logical *end* or the *outcome* of the workflow. This is a purely logical property required for distinguishing steps for the funnel charts or creating reports with the workflow data. Marking the step final has no effect on the flow itself."


3. Click **Apply** to save the step.

Next, we are going to apply a transition for these steps.


Example
"""""""

For the sample Opportunity Support Flow, we will start off by creating two steps: **No Complaints** and **Complaint Received**.

.. image:: /admin_guide/img/workflows/8_add_step_form.png

.. image:: /admin_guide/img/workflows/9_add_step_form_2.png

Add a Transition
~~~~~~~~~~~~~~~~

.. TODO rethink and adapt

To add a transition to a workflow:

1. Click **Add Transition** on the top right of the chart.

   .. image:: /admin_guide/img/workflows/10_add_transition.png

2. In the **Add New Transition** dialog, click the **Info** tab, and provide the following information:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30

   "**Name**", "The name of the transition that will be displayed on its button."
   "**From Step**", "The workflow step, for which the transition button should appear on the entity page."
   "**To Step**", "The step to which the workflow will progress after the transition is performed."
   "**View Form**", "Transition attributes can appear in one of two available forms: in the *popup window*, which is a default transition behavior suitable for most cases, or on the *separate page*, which should be used with care and only for attribute-heavy transitions."
   "**Warning Message**", "If you want to show a warning popup message to the user before a transition is executed, put the text of the warning into this field."
   "**Button Label**", "This text appears on the transition button and as the title of the transition form. If the button label is not provided, the value of the **Name** field is used."
   "**Button Title**", "This message appears when a user moves the pointer over the transition button. Use it to provide transition description or any other additional information."
   "**Button Icon**", "An icon that will appear on the transition button before the transition name."
   "**Button Style**", "This control specifies the visual style of the transition button."
   "**Button Preview**", "This is the live preview of the transition button as it will appear on the entity page.

   .. image:: /admin_guide/img/workflows/11_add_transition_form.png

   .. important:: Self-transitions do not change steps in workflows (e.g. it can be a transition that launches an Edit form of a record within the same step)."

3. Click the **Attributes** tab, and define the following fields:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30

   "**Entity Field**","This is the field of the workflow entity or its related entities that will appear on the view form of the transition. Use these if you want a user to add or edit some entity data in the transition."
   "**Label**", "Use the field if you want to change the way it is displayed on the user interface. The system label value of the entity is used by default."
   "**Required**","Select the **Required** check box if the definition of the attribute should be mandatory for the transition."
   "**+Add**", "Click **+Add** to add a new attribute."

4. Click **Apply** to save the transition.

.. tip:: After you have configured and saved your workflow, you can also configure sending email notification to the concerned parties when a transition is performed. For this, create an email notification rule as described in the :ref:`Notification Rules <system-notification-rules>` guide, and on the notification rule create page, specify the following:

         - From the **Entity** list, select the same entity as you have selected for your workflow.
         - From the **Event Name** list, select *Workflow transition*.
         - From the **Workflow** list, select your workflow.
         - From the **Transition** list, select the transition about which you want to notify concerned parties.

         All other fields must be configured as usual.

         .. image:: /admin_guide/img/workflows/workflow_notification_rule.png

Example
"""""""

The following is an example of an attribute added for the **Register a Complaint** transition in the sample Opportunity Support Flow. The entity selected for the attribute is Additional Comments. Its label has been changed to **Specify the Complaint**.

.. image:: /admin_guide/img/workflows/12_specify_complaint.png

.. image:: /admin_guide/img/workflows/13_attribute_saved.png

In the same manner, specify steps, transitions and attributes required for your custom workflow.

The sample Opportunity Support Flow has been configured the following way:

.. image:: /admin_guide/img/workflows/14_sample_flow_saved.png

.. _doc--workflows--actions--set-config-param:

Set a Workflow Configuration Parameters
---------------------------------------

To set a workflow configuration parameters:

1. In the main menu, navigate **System > Workflows**.
2. On the workflow list, click the required workflow.
3. If the workflow has configuration parameters, you can see the **Configuration** button on the top right of the workflow view page. Click this button.

   .. image:: /admin_guide/img/workflows/workflow_set_config_param.png

4. On the workflow configuration page, set the required values to the configuration parameters.

   .. image:: /admin_guide/img/workflows/workflow_set_config_param2.png

5. Click **Save and Close**.

.. important:: You cannot create new or delete existing configuration parameters via the user interface. See :ref:`User Interface Limitations <doc--workflows--ui-limitations>` section.

               When you clone a workflow, pay attention that configuration parameters are cloned too and cannot be removed from the cloned item.


Workflow Visualization
----------------------

Once the workflow has been configured and saved, you can see how it is visualized for the records:

- Transition buttons will be displayed on the top right of the entity record page.
- All the steps will be located on the top right of the entity record page within the workflow widget.

Example
^^^^^^^

The sample Opportunity Support Flow has been saved and activated.

As you can see from the screenshots below, the opportunity is currently in the **No Complaints** step. Clicking **Register a Complaint** will prompt an attribute we have configured for this transition:

.. image:: /admin_guide/img/workflows/15_osf_ui_1.png

.. image:: /admin_guide/img/workflows/16_osf_ui_2.png

Submitting a complaint will launch an opportunity page with the **Resolve, Request Feedback and Close** transition buttons activated.

.. image:: /admin_guide/img/workflows/17_osf_ui_3.png

Clicking each of these buttons will pass the user on to the next step specified in the workflow:

.. image:: /admin_guide/img/workflows/18_osf_ui_4.png

**Completed steps** are green, **the step in progress** is white, **the step to follow** is grey. The completed workflow cycle will have all steps highlighted in green:

.. image:: /admin_guide/img/workflows/19_osf_ui.png

As an illustration, we have unselected the **Display Steps Ordered** check box in the edit mode for the same workflow. Here is what the steps look like in this case:

.. image:: /admin_guide/img/workflows/20_osf_ui_5.png

The workflow widget now displays only the current step that the opportunity is in.

.. image:: /admin_guide/img/workflows/21_osf_ui_5.png

.. image:: /admin_guide/img/workflows/22_osf_ui_5.png

The current step of a workflow is displayed in the **Step** column within the entity grid, as in the example below:

.. image:: /admin_guide/img/workflows/23_open_opps_steps.png

Multiple Active Workflows
-------------------------

It is possible to have multiple active workflows for the same record. If you have more than one active workflow, you can separately activate each of them. In the following example, two workflows are available for one record:

.. image:: /admin_guide/img/workflows/24_multiple_wfs.jpg

Workflow group can be expanded / collapsed, if necessary, by clicking the **+** **Expand** / **-** **Collapse** icon on the left of the workflow group, as illustrated below:

.. image:: /admin_guide/img/workflows/25_collapse_flow.jpg

.. image:: /admin_guide/img/workflows/26_collapse_flow_2.jpg

.. TODO: DOC-122, draft as the dev ticket is not completed.

.. The storefront and backoffice workflows are united into separate groups, each can be expanded / collapsed individually.

.. The storefront workflows are marked with the |IcCustomerUser| icon. The backoffice workflows (workflows available in the management console) are marked with the |IcUser| icon.

.. .. image:: /admin_guide/img/workflows/workflows_frontstore_backoffice.jpg

Workflow Management
-------------------

.. _doc--workflows--actions--system:

System Workflows
^^^^^^^^^^^^^^^^

Since system workflows are pre-implemented in the system, their management from the user interface is limited. From the grid, you can perform the following actions for system workflows:

- **View**: |IcView| (Go to the view page of the workflow).
- **Activate/Deactivate**: |IcCheck| / |IcTimes| (activate/deactivate the workflow).
- **Configure**: |IcSettings|

.. image:: /admin_guide/img/workflows/27_manage_wf_2.png

.. hint:: In case you need to alter a system workflow, clone it via the command line console under the different name and make the required changes. For more information on how to clone a workflow, see :ref:`How to Clone a Workflow <workflows--actions--clone>`.

.. _doc--workflows--actions--custom:

Custom Workflows
^^^^^^^^^^^^^^^^

Workflows created on the UI from scratch are custom workflows.
You can perform the following actions for them:

- **Clone**: |IcClone| (copy the workflow to be able to customize it).
- **View**: |IcView| (go to the view page of the workflow).
- **Activate/Deactivate**: |IcCheck| / |IcTimes| (activate/deactivate the workflow).
- **Edit**: |IcEdit| (open the edit form of the workflow).
- **Delete**: |IcDelete| (delete the workflow from the system).

.. image:: /admin_guide/img/workflows/28_manage_wf_1.png


.. _doc--workflows--ui-limitations:

User Interface Limitations
~~~~~~~~~~~~~~~~~~~~~~~~~~

In Oro applications, there are two ways to create a new workflow:

* Via the user interface, as explained in the :ref:`Create a Workflow <doc-workflows-actions-create>` section above.

* In the command line console, by loading the workflow configuration files and related translations. Usually, it takes a system integrator with access to your Oro deployment to create a workflow in the command line.

Some workflow components, like an email notification, may be created only via the command line.

.. warning:: In the user interface, you cannot edit or clone workflows that contain transition actions and conditions. If you need to clone a workflow anyway, see :ref:`How to clone a wokflow via the command line console <workflows--actions--clone>`.

For how to create and manage workflows from the server side, see `Workflow Documentation <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/WorkflowBundle/Resources/doc/reference/workflow/index.md>`__ in the oroinc/platform repository on GitHub.



.. _doc--system--workflow-management--activate:

Workflow Activation
^^^^^^^^^^^^^^^^^^^

You can activate a workflow by clicking on the corresponding button on the view page of the workflow:

.. image:: /admin_guide/img/workflows/29_activate_wf.png

Optionally, you can select certain workflows to be deactivated. If you do not, leave the field empty and click **Activate**.

.. image:: /admin_guide/img/workflows/30_activate_wf_2.png

Similarly, click **Deactivate** if you wish to deactivate the selected workflow:

.. image:: /admin_guide/img/workflows/31_deactivate_wf.png

.. image:: /admin_guide/img/workflows/32_deactivate_wf_2.png

Activating workflows does not happen automatically for all entities. Once the flow has been activated in **System > Workflows**, you need to start it manually for the required entities:

.. image:: /admin_guide/img/workflows/33_start_wf_manually.png

It is possible to activate/deactivate workflows from the grid. See the previous section of this guide on Workflow Management to learn more about workflow grids.

User Permissions for Individual Workflows
-----------------------------------------

Multiple workflows functionality requires an ability to manage user permissions to run individual workflows. You can configure the following workflow permissions in **System > User Management > Roles**:

- Visibility of the entire workflow and its steps/current step.
- Ability to run workflow transactions.
- Ability to run every individual transaction.

.. image:: /admin_guide/img/workflows/34_roles_wfs.png

Workflow Translations
---------------------

All workflow labels can be translated into other languages, providing better localizations for users from different countries.

.. image:: /admin_guide/img/workflows/35_translations.png

To define a translation:

1. Click the |IcLanguage| **To Translations** icon next to the label that you want to translate. The translations list opens and is filtered to show only relevant translations.

   .. image:: /admin_guide/img/workflows/translations_relevantlist.png

2. From the translation list, choose the language into which you want to translate the label, and point to the corresponding cell in the **Translated Value** column.
3. Using the inline editor, specify the new translation for the label.

   .. image:: /admin_guide/img/workflows/translations_edit1.png

   .. image:: /admin_guide/img/workflows/translations_edit2.png

.. You can find more information on translations in the :ref:`Manage Translations <> guide.

.. include:: /img/buttons/include_images.rst
   :start-after: begin

Detailed Information About System Workflows
-------------------------------------------

See the following sections to get more information about the system workflows in OroCommerce:

.. toctree::
   :maxdepth: 1

   quote_management_workflow
   backoffice_quote_flow_with_approvals
   rfq_backoffice
   rfq_frontoffice
   checkout
   alternative_checkout
   single_page_checkout_workflow
   task_flow


