.. _backend--entities-data-management--processes:

Processes
=========

Processes automate tasks related to entity management. They use the main doctrine events to perform the described
tasks at the right time. Each process runs either immediately or after a timeout. For delayed execution, processes
use the `OroMessageQueue` component and the bundle.

Main Entities
-------------

Three entities represent processes:

1. **Definition** is the primary entity that holds information about a specific process. Its most important data is the
   process-related entity type (e.g., user) and the actions to perform with this entity (e.g., change the value of a field).

   Another important option is the execution order, which controls the order of execution when several processes
   subscribe to the same event of the same entity.

   A process can be enabled or disabled. Other definition fields hold the process name and the dates it was created and
   last updated.

2. **Trigger** holds information about the trigger used to run the related process.

   There are two types of triggers:

    - **event**

    The first parameter is the trigger event --- one of ``create``, ``update``, or ``delete``.
    The second parameter defines the entity field name to listen on (used for the ``update`` event only); the process
    runs only when this field's value changes.

    The trigger also defines when the process runs --- immediately or with a delay (the delay interval in seconds, in
    PHP date interval format). For delayed execution, you can also set the execution priority of process jobs.

    - **cron**

    Runs processes based on a cron definition, specified in the ``cron`` parameter (e.g., ``*/1 * * * *``). These triggers
    run only if the system has the cron script configured with the ``oro:cron`` command.

    .. note:: Each trigger can define only one of these types.

3. **Job** holds information specific to a process performed with delayed processing (in this case, a JMS job is created).
   Depending on the event, a job can contain the following data:

    - ``create`` event --- entity identity;
    - ``update`` event --- entity identity and change set (old and new values);
    - ``delete`` event --- entity plain fields (without references).

Each job entity also holds a relation to the trigger that created it and an entity hash (the related entity's full class
name plus the specific entity's identity). This entity hash lets you find all registered jobs for the same entity
(e.g., to remove all related jobs).

Principles
----------

Each process definition is related to an entity type, and each definition can have several triggers.

When a user performs an action on an entity related to an enabled process definition, the system analyzes all triggers
for this process and runs the appropriate ones.

A trigger can be processed in two ways: immediate or delayed execution.

With immediate execution, the process action runs right after the entity is flushed to the database, or on the cron
schedule.

With delayed execution, the trigger creates a job and sends it to the queue with the specified priority.

If an entity has several appropriate process triggers, the system processes them in the order set by the definition.

When a specific entity item is deleted, all job processes related to it are also deleted.

.. warning:: Performing the action described in the process definition can provoke triggers of other processes (or even the same process).
             You should either use an appropriate condition to avoid recursion or the "exclude_definitions" option.

Configuration
-------------

All processes are described in the configuration. The example below illustrates a simple process configuration that performs
an action with the Contact entity.

.. oro_integrity_check:: 8e5064b706ad86523ed1e05592ad7de392d46dee

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/processes.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/processes.yml
        :language: yaml
        :lines: 1-31

This configuration describes a process for the ``Contact`` entity. Every 1 minute, every time a contact is created, or
when the ``Assigned To`` field changes, the current administrator user is set as the assigned user. In other words, the
contact is assigned to the current administrator.

This logic uses one definition and two triggers. The first trigger runs immediately after the contact is created. The
second creates a new process job and sends it to the message queue with priority ``10`` and time-shift ``60``, so the
job runs a minute after the triggered action.

When the contact's ``Assigned To`` field is updated, the process "contact_definition" eventually runs and can change the
value of the ``Assigned To`` field. The "exclude_definitions" option prevents this process from self-triggering.

.. note::
         - If you want to test this process configuration in an actual application, you can place this configuration into the ``Oro/Bundle/WorkflowBundle/Resources/config/oro/processes.yml`` file and reload the definitions using the console command ``php bin/console oro:process:configuration:load``. After that, you can create a ``Contact`` of the changed assigned user and ensure that the process works.
         - Expression `$.` allows you to access the main data container; for processes, it is an instance of ``Oro\Bundle\WorkflowBundle\Model\ProcessData``.
         - Expression `$` (shortcut) or `$.data` allows you to access the current entity; above in example it is ``Oro\Bundle\ContactBundle\Entity\Contact``.

Console Commands
----------------

WorkflowBundle provides two console commands to work with processes.

oro:process:configuration:load
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This command loads the process configuration from .yml files into the database. It runs during application installation and update. The command has two optional options:

- **--directories** --- this option specifies directories used to find configuration files (multiple values allowed)
- **--definitions** --- this option specifies names of the process definitions that should be loaded (multiple values allowed)

.. note:: Run this command after changing the process configuration to upload your changes to the DB.

oro:process:handle-trigger
^^^^^^^^^^^^^^^^^^^^^^^^^^

This command executes a process trigger with a specified identifier and the process name. The command has two required options:

- **--id** --- the identifier of the ProcessTrigger to handle
- **--name** --- the name of ProcessDefinition. The trigger should belong to this ProcessDefinition

REST API
--------

OroWorkflowBundle provides a REST API to activate and deactivate processes.

Activation URL attributes:

* **route:** ``oro_api_process_activate``
* **parameter:** processDefinition - the name of the appropriate process definition

Deactivation URL attributes:

* **route:** ``oro_api_process_deactivate``
* **parameter:** processDefinition - the name of the appropriate process definition


.. include:: /include/include-links-dev.rst
   :start-after: begin
