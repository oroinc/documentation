Workflow Management
===================

*Used application: OroCRM 1.2.0*

This article provides description of Workflow Management feature from the the user's point of view.

Basics
------

Let's start with description of the primary concept and definition of terms.

**Workflow** is a set of ordered actions that can be performed with the specific entity. Workflow allows the user to manage entities, update existing ones and create new. From the user's POV workflow appears as a set of buttons which may open forms that allow to manipulate entity data.

Each entity may have unlimited number of workflows related to it, bun only one of them can be active. Each entity record at any given moment in time can be subject to only one workflow. It is possible however to have several flows for one entity and switch between them if you need to do so. When a workflow is deleted, all its existing relations to entities and entity records are lost.

**Step** is a "static" element of a workflow. At any given moment in time, the entity record that is subject to the workflow ("the workflow entity" hereinafter) must be in some step – as a consequence, every workflow must consist of at least one step. One of the workflow steps can be designated as the **default step.** Designating some step as the default means that newly created records of workflow entity will have a workflow started in the default step.

Workflow steps are shown in the small widget on the workflow entity view page in a particular step ("step view" hereinafter). This widget shows all past steps of the workflow in black, the current step in green, and, optionally, future steps in grey. The latter option is determined by the "display steps ordered" flag (see below).

Please note that workflow step should not be confused with entity status. It is especially important when they have similar names, e.g. "New Lead" step of a Sales Process and "New" status for the related Lead. The difference between the two should be clearly explained to users to avoid confusion.

Workflow steps can be used in filtering queries and conditions in reports.

**Transition** is a "dynamic" element of a workflow. Transitions are used to move the workflow from one step to another, and to manipulate entity data (not restricted to the workflow entity data). Transitions appear as buttons on the step view. Each transition may have ACL resource that specifies whether the particular transition is available for the current user.

Each workflow step must have at least one transition, either incoming, or outgoing. A transition can point to the same step it is initiated from – in this case it is called "self-transition". Steps and transitions together form a so-called `directed graph`_, where steps are nodes and transitions are arcs.

**Starting transition** is a special case of transition. The main difference from a regular transition is that it has no starting step (this special point is referred to as the "Start" in the workflow management UI). Every workflow must have either a default step, or a starting transition.

**Transition form** is a form that (if defined) is shown to the user after he clicks the transition button. It allows the user to manipulate entity data during the transition, and the data is not restricted to just workflow entity data – e.g., in the Sales Process workflow the form for qualifying the Lead includes attributes for the Opportunity that will be created as a result of the transition.

Forms are optional, and transition may have no form attached to it (e.g. Disqualify Lead in the Sales Process workflow). Most transition forms appear in the popup windows, but in some elaborate cases like starting transitions for the Sales Process workflow they require a full page view.

**Preconditions** is a set of conditions that determine whether the transition is available to the user. Preconditions are checked every time the step view is accessed, and if they are not met, the transition button will not appear on the step view. Preconditions are also checked when the transition form (see above) is committed, and if they are not met, the transaction is not conducted.

*Preconditions are not yet available on the UI and can be accessed only via configuration files.*

**Conditions,** unlike preconditions, are checked only when the transition form is committed, and they determine whether the transaction will be conducted. If a transition has both, preconditions are checked first, and then are conditions.

*Conditions are not yet available on the UI and can be accessed only via configuration files.*

**Post actions** are committed after the transaction is conducted (i.e. the transition form is submitted, preconditions and conditions are met, and the workflow is moved to the destination step). Those actions may include, but not limited to, creation of another entity, manipulation of the existing entity data, email notifications, etc.

Note that if a post action creates a new record of an entity that has an active workflow with default step, it will be started automatically.

*Post actions are not yet available on the UI and can be accessed only via configuration files.*

.. _directed graph: http://en.wikipedia.org/wiki/Directed_graph


Workflow Grid
-------------

Workflow grid displays a list of all existing workflows in the system. This grid is available in the main menu under "System" > "Workflow". The image below shows an example of such grid.

.. image:: ./img/workflow_management/workflow_grid.png

The user can create a new workflow directly from this page using the correspondingly named "Create workflow" button in the header.

A default workflow grid contains the following columns:

* **Name** is a human-readable name of the workflow that is used to identify it.

* **Related entity** is the name of the entity the workflow is assigned to.

* **Active** – this flag shows whether the current workflow is active or not. Each entity can have no more than one active workflow at any given moment in time (i.e. one or none). The user can activate or deactivate workflow directly from the grid using the respective row actions (see below). Note that activating a different workflow resets all existing workflow data for all workflow entity records.

* **System** – workflows denoted by this flag can only be viewed or cloned, and cannot be modified or removed. Usually system workflows are the default ones that come out of the box, and non-system workflows are workflows created by the users.

* **Created** is a date when the workflow has been created.

Each workflow can have the following row actions:

* **View** |icon_view| – opens the workflow view page (see below) with the compact representation of workflow: Basic information, list of steps and transitions.

* **Activate** |icon_activate| – activates the current workflow. **Important note:** Activating the workflow resets all existing workflow data for all records of workflow entity. (The process runs in the background an may take some prolonged time for large amounts of data.) This action can be applied to inactive workflows only.

* **Deactivate** |icon_deactivate| – deactivates current worfklow without any additional actions. This action can be applied to active workflows only.

* **Clone** |icon_clone| – opens a workflow edit page with the copy of the cloned workflow. This action is useful if you want to tweak an existing workflow – no need to create it from scratch.

* **Edit** |icon_edit| – opens the workflow edit page. This action is not available for system workflows.

* **Delete** |icon_delete| – deletes the workflow. All related data will be removed automatically. (The process runs in the background an may take some prolonged time for large amounts of data.) This action is not available to system workflows.

.. |icon_view| image:: ./img/workflow_management/icon_view.png
.. |icon_activate| image:: ./img/workflow_management/icon_activate.png
.. |icon_deactivate| image:: ./img/workflow_management/icon_deactivate.png
.. |icon_clone| image:: ./img/workflow_management/icon_clone.png
.. |icon_edit| image:: ./img/workflow_management/icon_edit.png
.. |icon_delete| image:: ./img/workflow_management/icon_delete.png


View Page
---------

Workflow view page displays the basic information of a workflow (see image below).

.. image:: ./img/workflow_management/workflow_view.png

The view page may contain several action buttons – "Activate," "Deactivate," "Clone," "Edit," and "Delete." All these
actions are identical to the workflow grid row actions described above.

**General information**

This information block contains the basic information of a workflow: Its name, related entity, default step and "display steps ordered" flag.

Default step is the step that will be automatically assigned to a newly created entity record (see the definition above). Default step is optional, and if the workflow has no default step, the user will have to manually start the workflow with one of the starting transitions.

The "display steps ordered" flag defines whether the workflow widget need to show all steps (including not passed) at the entity view page. Usually this option should be checked only if the workflow is linear in its nature, i.e. the entity must be passed through all workflow steps.

**Steps and transitions**

The "Configuration" block contains a table with the list of steps and transitions. It has the following columns:

* **Step** is a name of the step, as it will appear in the UI. Some steps can be marked as final (see details below). The first row in the table is a service "step" labelled **(Start)** – this step is virtual, it cannot be edited, and it does not correspond to any actual workflow step. Its ony purpose is to define starting transitions that must start from it.

* **Transitions** is a list of all transitions available for the particular step. To the left of an arrow is the transition name, to the right of an arrow is the destination step of the transition.

* **Position** is the number that determines order of steps in the step widget. The higher is the number, the further to the right this step will appear in the step widget.


Edit Page
---------

Workflow edit page is used when you are creating the new workflow, editing or cloning an existing one. Example of such page is shown on a screenshot below.

.. image:: ./img/workflow_management/workflow_edit_overview.png

As you can see, the edit page is very similar in appearance to the view page, and consists of the same information blocks. The only differences are:
* Add transition and Add step buttons above the table
* Steps' and transitions' names in the table are clickable
* The table has additional Actions column

Add step and Add transition are used to create new step or transition. To edit existing ones, clck on the step or transition name in the table. In both cases, a popup window with a form will appear – so let's take a more detailed look on these forms.

**Edit step form**

This form consists of two tabs: "Info" and "Transitions."

.. image:: ./img/workflow_management/workflow_edit_step_info.png

On the "Info" the user can specify step name, its relative position in the workflow, and designate the step as final.

The standard practice for naming steps is to use adjectives, adding the entity name for distinction when necessary – e.g. the Abandoned Shopping Cart flow has two steps: Converted and Converted to Opportuninty. In the former case, the entity name is omitted meaning the actions leading to this step relate only to the workflow entity (Shopping Cart). The inlcusion of Opportunity into the latter step name informs the user that getting to this step involved manipulations with Opportunities.

When you are specifying positions of the workflow steps, think ahead: You might want to include additional steps later, and there should be some space for growth. Good practice is to use numbers like 10, 20, 30, and so on for the positioning.

The designation of the step as final applies to the business logic of the workflow, but it does not mean that there is no way out of the final step – it only means that such "reverse" transition is an exception to the natural order of things. See the Sales Process flow as an example: Its final steps are Disqualified Lead, Won Opportunity and Lost Opportunity, and each of these steps has a "reverse" transition (Reactivate and Reopen, respectively), but these transitions completely reset the workflow data and should be used only in exceptional cases.

.. image:: ./img/workflow_management/workflow_edit_step_transitions.png

The "Transitions" tab contains the table with the list of all transitions available from this step, very similar to the main Steps and Transitions table. Here the user can delete unwanted transitions from the step.


**Edit transition form**

This form also consists of two tabs: "Info" and "Attributes."

.. image:: ./img/workflow_management/workflow_edit_transition_info.png

On the "Info" tab the user can modify the transition name; its initial ("from") and destination ("to") steps; specify the view form type (popup window or full page); add a warning or confirmation message if it's needed; and customize the icon and style of transition button with the live preview.

Transition name is a text that will appear on its button in the step view. It is considered a good practice to start transition names with a verb, and keep them as short as possible.

"From step" and "To step" are the initial and destination steps for this transition. Its button will be available on the "from" step, and after transition is performed, the workflow will be moved to the "to" step. Both steps can be the same, in this case the transition will be a self-transition (e.g. the Log Call transition in the Abandoned Shopping Cart flow). If you want to create a starting transition, select "Start" in the From step dropdown menu.

View from type has two options - "Popup window" and "Separate page". First tells that transition attributes must be
rendered as regular popup window over the entity view page, second - transition will be shown as a separate page.

Warning message is optional and used to warn user about something before performing of transition. It can be extremely
useful if transition does some changes that can't be undone.

Button icon and style allows user to customise look of transition button - icon and background color.

.. image:: ./img/workflow_management/workflow_edit_transition_attributes.png

"Attributes" tab shows list of existing attributes for this step and has small form to add new ones.
Transition attributes are optional, so if there will be no attributes, then there will be no transition window -
transition will be performed immediately.

Add/edit from has only three fields - entity field, label and required flag.

Entity field selector allows user
to select required field from main entity or form it's relations. The way how this field will be rendered in
transition window is defined automatically based on field type.

Value at label field overrides default system field label. If label is not defined, default system field label
will be used.

Required flag specifies whether this field must be filled before transition execution.

Attributes field table has exactly the same columns, and each columns shows appropriate value. Also this table has
additional actions column - it allows to edit and remove attribute fields.


**Steps and transitions**

Steps and transitions table is really similar to such table on a view page (same columns, same information), but also
it has additional functionality.

Step names in column "Step" are links that open step window that allows user to modify step information.
Transition names in column "Transitions" are also links that open transition window to modify transition parameters.
To the right of transition name there are two additional icons that provide functionality to clone and delete
current transition.

Unlike table from view page, this table has additional actions column. It provides ability to add new transition
to this step, and modify, clone or delete current step.


Step by step example of workflow creation
-----------------------------------------

Now lets create simple flow to show how workflow functionality works in action. Here is schema of this flow:

.. image:: ./img/workflow_management/workflow_example_schema.png

* rectangles are steps;
* arrows are transitions;
* related entity is Contact;
* "Started" is default step;
* "Finished" is final step;
* steps must be displayed ordered at view page.

**General Information**

First user have to set basic parameters -  workflow name, related entity and displayed steps ordered flag. Default step
should be empty because there are no steps for now.

.. image:: ./img/workflow_management/workflow_example_general_information.png

**Steps**

Now lets create steps. There are three steps - "Started", "Processed" and "Finished", and each of them
should be created with "Add step" button. Also user need to set appropriate step order (10, 20, 30) and mark step
"Finished" as final step.

Step "Started":

.. image:: ./img/workflow_management/workflow_example_step_1.png

Step "Processed":

.. image:: ./img/workflow_management/workflow_example_step_2.png

Step "Finished":

.. image:: ./img/workflow_management/workflow_example_step_3.png

Now user can select step "Started" as default step, and whole page should look like image below.

.. image:: ./img/workflow_management/workflow_example_all_steps.png

**Transitions**

Next four transitions must be created - "Process", "Finish", "Restart" and "Reset". They can be created either using
"Add transition" button or with appropriate action with plus icon from steps and transitions table.

Transition attributes and parameters:

* Process - First Name (required), Middle Name, Last Name (required);
* Finish - Assign To, Reports To;
* Restart - no attributes, must have confirmation;
* Reset - no attributes, must have confirmation.

Transition "Process":

.. image:: ./img/workflow_management/workflow_example_transition_1_1.png
.. image:: ./img/workflow_management/workflow_example_transition_1_2.png

Transition "Finish":

.. image:: ./img/workflow_management/workflow_example_transition_2_1.png
.. image:: ./img/workflow_management/workflow_example_transition_2_2.png

Transition "Restart":

.. image:: ./img/workflow_management/workflow_example_transition_3.png

Transition "Reset":

.. image:: ./img/workflow_management/workflow_example_transition_4.png

**Saving and activation**

Now when all steps and transitions are created workflow finally can be saved. Lets click "Save and close" button - and
workflow will be saved. If this is a first workflow for custom or extended entity then saving might take some time
(up to 1 minute).

After saving user will be redirected to workflow view page with a short description of created flow. But now
this workflow is inactive, so it must be activated first. To do that user must click button "Activate" at the top
of view page and confirm activation (also activate action can be executed from workflow grid).

Here is how view page should look like.

.. image:: ./img/workflow_management/workflow_example_view.png

And now user can return to the workflow grid and ensure that new flow is there and it marked as active.

.. image:: ./img/workflow_management/workflow_example_grid.png

**Testing**

Finally, user need to test that this flow is actually works. Here is it's schema:

.. image:: ./img/workflow_management/workflow_example_schema.png

For current flow there are two cases - when new entity is created, and when existing entity is used. For new entity
workflow will be automatically started with default step, and for existing entity user have to start it manually
using start workflow button on entity view page. For this flow it will look like this:

.. image:: ./img/workflow_management/workflow_testing_no_workflow.png

After clicking on it workflow will be started. View page shows steps widget with the list of all workflow steps
(black are passed steps, green is current step, grey are not passed steps) and transition buttons.
Now entity is in step "Started" and transition "Process" is available.

.. image:: ./img/workflow_management/workflow_testing_step_started.png

After clicking on Process transition button transition window appears. It shows three defined attributes with required
marks, and it allows to change values.

.. image:: ./img/workflow_management/workflow_testing_transition_process.png

Let's set Middle name to "Unknown" and click "Submit" - after that transition is performed, and now entity is in
step "Processed". Steps widget is changed, and there are two new transition buttons - "Finish" and "Restart".

.. image:: ./img/workflow_management/workflow_testing_step_processed.png

After clicking on Finish transition button transition window will appear - it looks the same to previous one,
but contains other fields.

.. image:: ./img/workflow_management/workflow_testing_transition_finish.png

Let's set some user and contact in appropriate fields, click "Submit" and ensure that appropriate fields in
contact were changed. Now entity is in step "Finished" and one transition "Reset" is available.

.. image:: ./img/workflow_management/workflow_testing_step_finished.png

Clicking on Reset transition button will show the confirmation that was configured in transition. The same confirmation
will appear for Restart transition from step "Processed".

.. image:: ./img/workflow_management/workflow_testing_confirmation_reset.png

And after clicking on OK button entity will be in step "Started" again with Process transition available.

.. image:: ./img/workflow_management/workflow_testing_step_started_again.png

Transitions can be executed any amount of times for the same entity, and all entered data will be stored at entity
fields.
