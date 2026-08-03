.. _backend--workflows--intro:

Introduction to Workflows
=========================

Principle
---------

An entity can have workflows assigned to it. Its view page then shows a list of passed steps and buttons for the allowed transitions. When a user clicks a start transition button (and submits a transition form if one exists), a new workflow item of that Workflow is created in the background.

Each step has a list of allowed transitions, and each transition has conditions that define whether it can be performed in a given workflow item state. The user can perform a transition only when it is allowed.

If a transition has Actions, those Actions run right after the transition. This way, the user moves the entity through the workflow steps until reaching the final step, where the Workflow finishes.

A workflow does not always need a final step; the user can keep performing transitions as long as they are allowed.

A workflow item stores all collected data and the current step. The user can stop at any moment and return later --- the Workflow keeps exactly the same state. Each workflow item represents the workflow started for a specific entity.

Entity Limitations
------------------

To attach an entity to a specific workflow (make it workflow-related), the entity must meet a few criteria:

- An entity cannot have composite fields as its primary keys.
- The entity primary key can be an integer or a string --- for Doctrine types: BIGINT, DECIMAL, INTEGER, SMALLINT, STRING. In other words, any type that SQL CAST can convert to a text representation.
- An entity should be configurable.

Workflow-Related Entity
-----------------------

This is the main entity of the workflow, the central point of all business processes described in a particular workflow configuration.
The entity class is declared through the `entity` node as FQCN of the workflow configuration.
All **OTHER** entities in the context of this documentation are called *not related entities* or *not directly related*.

Configuration
-------------

All Workflow entities are described in the configuration. Below is an example of Workflow configuration that performs some action with `User` entity.

.. oro_integrity_check:: 57ab879a97393017b71652ea6675d9536ef7e3d3

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/workflows.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml
        :language: yaml
        :lines: 1-101

This configuration describes Workflow that includes two transitions - "set_name" and "add_email".

On step "started", a user can update the full name (first, middle and last name) using transition "set_name".
Then on step "processed", the user can add additional emails using transition "add_email".

To perform transition "set_name", the user fills in the first and last name; the middle name is optional. After this transition, the provided data is automatically set on the user through the attribute property paths.

To perform transition "add_email", the user must enter a valid email --- it must not be empty and must have a valid format. This transition creates a new Email entity with the entered email string and the User entity, adds it to the User entity to create a connection, and clears the temporary attributes in the last action.

Two triggers try to perform transition `schedule_transition`: one by cron definition, and one when the field `status` of the entity `Oro\\Bundle\\SaleBundle\\Entity\\Quote` is updated.

The following diagram shows this logic in graphical representation.

.. image:: /img/backend/entities_data_management/getting-started_workflow-diagram.png

.. note:: If you want to test this flow in real application, you can place this configuration in file Oro/Bundle/UserBundle/Resources/config/oro/workflows.yml, reload definitions using the console command ``bin/console oro:workflow:definitions:load``, and activate it from the UI. Next, you can go to the User view page and test it.

Console Commands
----------------

WorkflowBundle provides following console commands to work with workflows.

**oro:workflow:definitions:load**

This command loads workflow's configurations from .yml configuration files to the database. It is used during application installation and update processes. The command has two optional options:

- *--directories* - specifies directories used to find configuration files (multiple values allowed);
- *--workflows* - specifies the names of the workflows that should be loaded (multiple values allowed).

.. note:: You must execute this command every time workflow configurations are changed in the .yml files.

**oro:workflow:transit**

This command performs the transition with the specified name for the WorkflowItem with the specified ID. It is used to perform scheduled transitions. The command has two required options:

- *--workflow-item* - the identifier of WorkflowItem.
- *--transition* - the name of Transition.

**oro:workflow:handle-transition-cron-trigger**

This command handles workflow transition cron trigger with specified identifier. The command has one required option:

- *--id* - identifier of the transition cron trigger.

Main Entities
-------------

Workflow consists of several related entities.

* **Step** is an entity that shows the current status of the workflow. Before each transition is rendered, the system checks whether it is allowed for the current workflow item. A step contains a name and a list of allowed transitions. The entity involved in the workflow has a relation to the current workflow step.

* **Attribute** is an entity that represents one value in the workflow item, used to render the field value on a step form. Attribute knows about its type (string, object, entity etc.) and additional options. Attribute contains name.

* **Transition** is an action that changes the current step of the workflow item (moves it from one step to another). A transition is allowed if its conditions are satisfied. Pre-actions run before the transition is performed and pre-conditions or conditions are checked; Actions run after the transition is performed. A transition can be used as a start transition, which starts the Workflow and creates a new instance of the workflow item. A transition contains a name and some additional options. It can optionally contain a form with a list of attributes, which is shown to the user when the transition button is clicked.

* **Pre-Actions** are assigned to the transition and executed before the transition button is rendered. This type of action is mainly used to predefine data used by Pre-Conditions, for example, to search for some data in the database.

* **Condition** defines whether a specific transition is allowed with the specified input data. Conditions can be nested.

* **Actions** are assigned to the transition and executed when the transition is performed. There are two kinds of actions: Pre-Actions and Actions. The difference between them is that Pre-Actions are executed before the Transition, and Actions are executed after the transition. Actions can be used to manage entities (create, find), manipulate attributes (e.g., assign values) and perform any other action.

* **Workflow** aggregates steps, attributes, and transitions. A workflow is a model that does not have its own state but can be referred to by the workflow items.

* **Workflow Data** container is aggregated by the workflow item where each value is associated with an attribute. Those values can be entered by the user directly or assigned via Actions.

* **Workflow Item** is associated with the workflow and indirectly associated with Steps, Transitions and Attributes. It has its own state in the workflow data, the current step, and other data. The workflow item stores the entity identifier and the entity class that has an associated workflow.

* **TransitionEventTrigger** allows performing a transition when Doctrine triggers a corresponding event during an entity event.

* **TransitionCronTrigger** allows performing a transition by cron definition.


.. include:: /include/include-links-dev.rst
   :start-after: begin
