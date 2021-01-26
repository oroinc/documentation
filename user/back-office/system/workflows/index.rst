:oro_documentation_types: OroCRM, OroCommerce

.. _mc-system-wf:
.. _user-guide--system--workflow-management:
.. _doc--system--workflow-management:

Configure Workflows in the Back-Office
======================================

In Oro, a :term:`workflow <Workflow>` is a business process that involves multiple user interactions or sequential phases. It may trigger other workflows and change the status of the items involved in a business process.

In the storefront, workflows organize and direct users’ work (e.g., during the checkout), making them follow particular steps in a pre-defined order (e.g. provide shipping address, then select shipping method from the options supported for the destination), or preventing them from performing actions that either contradict or conflict with the logical steps of a process (e.g., a customer may not be able to submit an order without their manager's approval).

In the Oro back-office, workflows help users follow standard procedures that may be of a non-linear nature with alternating flow that depends on the available information, related items status, connectivity with integrated solutions, etc.

.. _user-guide--system--workflow-management-system-custom:

System vs Custom Workflows
--------------------------

In Oro applications, any workflow may be classified as either **system** or **custom**. *System* workflows are provided out of the box. Their modification is limited in order to keep core functionality operational. However, if you create a *Custom* workflow from scratch, you can tailor it for your needs without any restrictions.

For more information on system and custom workflows, see :ref:`System Workflows <doc--workflows--actions--system>` and :ref:`Custom Workflows <doc--workflows--actions--custom>`.

.. _doc-workflows-actions-create:

Create a Workflow
-----------------

To create a workflow for an entity:

1. In the main menu, navigate to **System > Workflows**.
2. Click **Create Workflow** on the top right of the page.
3. On the **Create Workflow** page, specify the details of your workflow in the **General** section.

   .. image:: /user/img/system/workflows/4_create_wfpng.png

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

.. _doc-workflows-actions-create-designer:

Designer Section
^^^^^^^^^^^^^^^^

The **Designer** section consists of a table and an interactive chart representations of a workflow.

.. image:: /user/img/system/workflows/5_table_chart_example.png

**Within the table**, you can perform the following actions for a **transition**:

-	**Update** (clicking the transition name opens the **Edit Transition** form).
-	**Clone** (clicking the |IcClone| **Clone** icon next to the transition name opens the **Clone Transition** dialog).
-	**Delete** (clicking the |IcDelete| **Delete** icon next to the transition launches name **Delete Confirmation** dialog).

.. image:: /user/img/system/workflows/designer_tab_transition.png

**For a step**, you can perform the following action by clicking the corresponding icons in the **Actions** column:

- **Add a transition to a step** (clicking the **+** icon opens the **Add New Transition** dialog).
- **Update** (clicking the |IcEdit| **Edit** icon opens the **Edit Step** dialog).
- **Clone** (clicking the |IcClone| **Clone** icon opens the **Clone Step** dialog).
- **Delete** (clicking the |IcDelete| **Delete** icon launches the **Delete Confirmation** dialog).

.. image:: /user/img/system/workflows/designer_tab.png

**Within the chart**, you can:

- **Add a transition** (clicking the **+ Add Transition** button at the top of the chart opens the **Add Transition** dialog).
- **Add a step** (clicking the **+ Add Step** button at the top of the chart opens the **Add Step** dialog).
- **Autosort** (clicking the **Auto Sort** button at the top of the chart automatically shapes your chart).
- **Rearrange the chart** for clearer workflow view (drag-and-drop transitions and steps in the chart as required, or click the |IcExpand| **Expand** button in the top right corner of the chart).
- **Zoom in/out** (click the |IcSearchPlus| **Zoom In** / |IcSearchMinus| **Zoom Out** button in the top right corner of the chart to zoom the chart in/out, or select zoom percent from the list).

.. image:: /user/img/system/workflows/auto_sort.gif

- **Show transition labels** (select this check box in the top left corner of the chart to display transition labels in the chart).
- **Drag transitions from one step to another** (point to one of four corners of the step box, and when the cursor changes shape to the hand, click the corner and drag an arrow to another step).

.. image:: /user/img/system/workflows/drag_transition.gif

- **Undo/Redo changes** (click the |IcReply| **Undo** / |IcShare| **Redo** button at the top of the cart to revert or restore changes made to the chart).
- **Edit/Clone/Delete** a step/transition (point to the step/transition button, and when the |IcCaretDown| arrow appears, click it, and then click the |IcEdit| **Edit** / |IcClone| **Clone** / |IcDelete| **Delete** icon.

.. note:: All actions available for transitions and steps in the table are available in the chart as well.

.. image:: /user/img/system/workflows/6_manage_chart.png

A Workflow Creation Illustration
--------------------------------

As an example, we are going to create the Opportunity Support Flow workflow to show how a workflow is configured and visualized.

Add a Step
^^^^^^^^^^

To add a step to a workflow:

1. Click **Add Step** in the right corner of the Designer section.

   .. image:: /user/img/system/workflows/7_add_step.png

2. In the **Add New Step** dialog, complete the following fields:

   * **Name** --- The name of the step that will be displayed on the entity record.
   * **Position** --- A number that determines the position of the step in the workflow. The higher the number, the further the step is from the start.
   * **Final** --- This option marks the step as the logical *end* or the *outcome* of the workflow. This is a purely logical property required for distinguishing steps for the funnel charts or creating reports with the workflow data. Marking the step final has no effect on the flow itself.

For the sample Opportunity Support Flow, we will start off by creating two steps: **No Complaints** and **Complaint Received**.

.. image:: /user/img/system/workflows/8_add_step_form.png

.. image:: /user/img/system/workflows/9_add_step_form_2.png

3. Click **Apply** to save the steps.

Next, we are going to apply a transition for these steps.

Add a Transition
^^^^^^^^^^^^^^^^

To add a transition to a workflow:

1. Click **Add Transition** on the top right of the chart.

   .. image:: /user/img/system/workflows/10_add_transition.png

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

   .. image:: /user/img/system/workflows/11_add_transition_form.png

   .. important:: Self-transitions do not change steps in workflows (e.g. it can be a transition that launches an Edit form of a record within the same step)."

3. Click the **Attributes** tab, and define the following fields:

   * **Entity Field** --- This is the field of the workflow entity or its related entities that will appear on the view form of the transition. Use these if you want a user to add or edit some entity data in the transition.
   * **Label** --- Use the field if you want to change the way it is displayed on the user interface. The system label value of the entity is used by default.
   * **Required** --- Select the **Required** check box if the definition of the attribute should be mandatory for the transition.
   * **+Add** --- Click **+Add** to add a new attribute.

The following is an example of an attribute added for the **Register a Complaint** transition in the sample Opportunity Support Flow. The entity selected for the attribute is Additional Comments. Its label has been changed to **Specify the Complaint**.

.. image:: /user/img/system/workflows/12_specify_complaint.png

4. Click **Apply** to save the transition.

.. tip:: After you have configured and saved your workflow, you can also configure sending email notification to the concerned parties when a transition is performed. For this, create an email notification rule as described in the :ref:`Notification Rules <system-notification-rules>` guide, and on the notification rule create page, specify the following:

         - From the **Entity** list, select the same entity as you have selected for your workflow.
         - From the **Event Name** list, select *Workflow transition*.
         - From the **Workflow** list, select your workflow.
         - From the **Transition** list, select the transition about which you want to notify concerned parties.

         All other fields must be configured as usual.

         .. image:: /user/img/system/workflows/workflow_notification_rule.png

In the same manner, specify steps, transitions and attributes required for your custom workflow.

The sample Opportunity Support Flow has been configured the following way:

.. image:: /user/img/system/workflows/14_sample_flow_saved.png


.. _doc--workflows--actions--set-config-param:

Set Workflow Configuration Parameters
-------------------------------------

To set a workflow configuration parameters:

1. In the main menu, navigate **System > Workflows**.
2. On the workflow list, click the required workflow.
3. If the workflow has configuration parameters, you can see the **Configuration** button on the top right of the workflow view page. Click this button.

   .. image:: /user/img/system/workflows/workflow_set_config_param.png

4. On the workflow configuration page, set the required values to the configuration parameters.

   .. image:: /user/img/system/workflows/workflow_set_config_param2.png

5. Click **Save and Close**.

.. important:: You cannot create new or delete existing configuration parameters via the user interface. See :ref:`User Interface Limitations <doc--workflows--ui-limitations>` section.

               When you clone a workflow, pay attention that configuration parameters are cloned too and cannot be removed from the cloned item.


The Created Workflow Visualization
----------------------------------

Once the workflow has been configured and saved, you can see how it is visualized for the records:

- Transition buttons will be displayed on the top right of the entity record page.
- All the steps will be located on the top right of the entity record page within the workflow widget.

The sample Opportunity Support Flow has been saved and activated.

As you can see from the screenshots below, the opportunity is currently in the **No Complaints** step. Clicking **Register a Complaint** will prompt an attribute we have configured for this transition:

.. image:: /user/img/system/workflows/15_osf_ui_1.png

Submitting a complaint will launch an opportunity page with the **Resolve, Request Feedback and Close** transition buttons activated.

.. image:: /user/img/system/workflows/17_osf_ui_3.png

Clicking each of these buttons will pass the user on to the next step specified in the workflow:

.. image:: /user/img/system/workflows/18_osf_ui_4.png

**Completed steps** are green, **the step in progress** is white, **the step to follow** is grey. The completed workflow cycle will have all steps highlighted in green:

.. image:: /user/img/system/workflows/19_osf_ui.png

As an illustration, we have unselected the **Display Steps Ordered** check box in the edit mode for the same workflow. Here is what the steps look like in this case:

.. image:: /user/img/system/workflows/20_osf_ui_5.png

The workflow widget now displays only the current step that the opportunity is in.

.. image:: /user/img/system/workflows/21_osf_ui_5.png

The current step of a workflow is displayed in the **Step** column within the entity grid, as in the example below:

.. image:: /user/img/system/workflows/23_open_opps_steps.png

Multiple Active Workflows
-------------------------

It is possible to have multiple active workflows for the same record. If you have more than one active workflow, you can separately activate each of them. In the following example, two workflows are available for one record:

.. image:: /user/img/system/workflows/24_multiple_wfs.jpg

Workflow group can be expanded / collapsed, if necessary, by clicking the **+** **Expand** / **-** **Collapse** icon on the left of the workflow group, as illustrated below:

.. image:: /user/img/system/workflows/25_collapse_flow.jpg

.. _doc--workflows--ui-limitations:

User Interface Limitations
--------------------------

In Oro applications, there are two ways to create a new workflow:

* Via the user interface, as explained in the :ref:`Create a Workflow <doc-workflows-actions-create>` section above.

* In the command line console, by loading the workflow configuration files and related translations. Usually, it takes a system integrator with access to your Oro deployment to create a workflow in the command line.

Some workflow components, like an email notification, may be created only via the command line.

.. warning:: In the user interface, you cannot edit or clone workflows that contain transition actions and conditions. If you need to clone a workflow anyway, use the command line console.

.. see :ref:`How to clone a workflow via the command line console <workflows--actions--clone>`.

For how to create and manage workflows from the server side, see the Backend Developer Guide section on :ref:`Workflows <dev-doc--workflows>`.


.. _doc--system--workflow-management--activate:

Workflow Activation
-------------------

You can activate a workflow by clicking on the corresponding button on the view page of the workflow:

.. image:: /user/img/system/workflows/29_activate_wf.png

Optionally, you can select certain workflows to be deactivated. If you do not, leave the field empty and click **Activate**.

.. image:: /user/img/system/workflows/30_activate_wf_2.png

Similarly, click **Deactivate** if you wish to deactivate the selected workflow:

.. image:: /user/img/system/workflows/31_deactivate_wf.png

Activating workflows does not happen automatically for all entities. Once the flow has been activated in **System > Workflows**, you need to start it manually for the required entities:

.. image:: /user/img/system/workflows/33_start_wf_manually.png

It is possible to activate/deactivate workflows from the grid. See the previous section of this guide on Workflow Management to learn more about workflow grids.

User Permissions for Individual Workflows
-----------------------------------------

Multiple workflows functionality requires an ability to manage user permissions to run individual workflows. You can configure the following workflow permissions in **System > User Management > Roles**:

- Visibility of the entire workflow and its steps/current step.
- Ability to run workflow transactions.
- Ability to run every individual transaction.

.. image:: /user/img/system/workflows/34_roles_wfs.png

Workflow Translations
---------------------

All workflow labels can be translated into other languages, providing better localizations for users from different countries.

.. image:: /user/img/system/workflows/35_translations.png

To define a translation:

1. Click the |IcLanguage| **To Translations** icon next to the label that you want to translate. The translations list opens and is filtered to show only relevant translations.

   .. image:: /user/img/system/workflows/translations_relevantlist.png

2. From the translation list, choose the language into which you want to translate the label, and point to the corresponding cell in the **Translated Value** column.
3. Using the inline editor, specify the new translation for the label.

   .. image:: /user/img/system/workflows/translations_edit1.png

   .. image:: /user/img/system/workflows/translations_edit2.png

.. You can find more information on translations in the :ref:`Manage Translations <> guide.


Detailed Information About System Workflows
-------------------------------------------

See the following sections to get more information about the system workflows in the Oro application:

.. toctree::
   :maxdepth: 1

   System Workflows <system-workflows/index>
   Custom Workflows <custom-workflows>
   Workflow Steps, Transitions, and Attributes <steps-transitions>

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
