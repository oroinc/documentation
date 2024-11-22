.. _backend--workflows--intro:

Introduction to Workflows
=========================

Principle
---------

An entity can have assigned workflows. It means that an entity view page has a list of passed steps and allowed transition buttons. When a user clicks a button with the start transition (and submits a transition form if it exists), then in the background, a new instance of a workflow item of a specific Workflow is created.

Each step has a list of allowed transitions, and each transition has a list of conditions that define whether this transition can be performed with a specific workflow item state. If transition is allowed, then the user can perform it. If the transition has Actions, then these Actions are performed right after the transition. So, the user can move the entity through the steps of a workflow until they reach the final step where Workflow finishes.

A workflow does not always need to have the final step, and the user can perform transitions until they are allowed.

A workflow item stores all collected data and the current step, so the user can stop their progress within the workflow at any moment and then return to it - the Workflow will have exactly the same state. Each workflow item represents the workflow started for a specific entity.

Entity Limitations
------------------

To be able to attach an entity to a specific workflow (e.g., make an entity workflow related), a few criteria should be met.

- An entity cannot have composite fields as its primary keys.
- Entity primary key can be an integer or a string (for doctrine types it is: BIGINT, DECIMAL, INTEGER, SMALLINT, STRING). In other words, all types that can be casted by SQL CAST to text representation.
- An entity should be configurable.

Workflow-Related Entity
-----------------------

The main entity for the workflow that is used as the central point of all business processes described in a particular workflow configuration.
The entity class is declared through the `entity` node as FQCN of workflow configuration.
All **OTHER** entities in context of this documentation are called *not related entities* or *not directly related*.

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

To perform transition "set_name", the user should fill first and last name, the middle name is optional. After this transition, the provided data is automatically set to the user through the attribute property paths. To perform transition "add_email", the user must enter a valid email - it must not be empty and must have a valid format.
This transition creates a new Email entity with the assigned email string and User entity, then adds it to the User entity to create a connection, and clears temporary attributes in last action.

There are 2 triggers that will try to perform transition `schedule_transition` by cron definition, or when field `status` of entity with class`Oro\\Bundle\\SaleBundle\\Entity\\Quote` is updated.

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

This command performs transitions with specified name for the WorkflowItem with a specified ID. It is used to perform scheduled transitions. The command has two required option:

- *--workflow-item* - the identifier of WorkflowItem.
- *--transition* - the name of Transition.

**oro:workflow:handle-transition-cron-trigger**

This command handles workflow transition cron trigger with specified identifier. The command has one required option:

- *--id* - identifier of the transition cron trigger.

Main Entities
-------------

Workflow consists of several related entities.

* **Step** is an entity that shows the current status of the workflow. Before rendering each transitions, check if it is allowed for the current workflow item. It contains the name and the list of allowed transitions. The entity involved in the workflow has a relation to the current workflow step.

* **Attribute** is an entity that represents one value in the workflow item, used to render the field value on a step form. Attribute knows about its type (string, object, entity etc.) and additional options. Attribute contains name.

* **Transition** is an action that changes the current step of the workflow item (i.e., moves it from one step to another). The transition is allowed if its conditions are satisfied. Pre-actions are executed before the transition is performed and pre-conditions or conditions are checked; and Actions are executed after the transition is performed. A transition can be used as a start transition. It means that this transition starts the Workflow and creates a new instance of the workflow item. Transitions optionally can have a form. In this case, this form is shown to user when the transition button is clicked. The transition contains name and some additional options. Optionally, the transition can contain a form with a list of attributes.

* **Pre-Actions** are assigned to the transition and executed before the transition button is rendered. This type of action is mainly used to predefine data used by Pre-Conditions, for example, to search for some data in the database.

* **Pre-Condition** defines whether a particular transition is available with the specified input data. Conditions can be nested. This type of condition is used to check the availability of transition buttons.

* **Condition** defines whether a specific transition is allowed and can be executed with the specified input data. Conditions can be nested.

* **Actions** are assigned to the transition and executed when the transition is performed. Actions can be used to manage entities (create, find), manipulate attributes (e.g., assign values) and perform any other action.

* **Workflow** aggregates steps, attributes, and transitions. A workflow is a model that does not have its own state but it can be referred by the workflow items.

* **Workflow Data** container is aggregated by the workflow item where each value is associated with an attribute. Those values can be entered by the user directly or assigned via Actions.

* **Workflow Item** is associated with the workflow and indirectly associated with Steps, Transitions and Attributes. It has its own state in the workflow data, the current step, and other data. The workflow item stores the entity identifier and the entity class that has an associated workflow.

* **TransitionEventTrigger** allows to perform a transition when during an entity event Doctrine triggers a corresponding event.

* **TransitionCronTrigger** allows to perform a transition by cron definition.


.. include:: /include/include-links-dev.rst
   :start-after: begin
