.. _backend--entities-data-management--processes:

Processes
=========

Processes provide the possibility to automate tasks related to entity management. They use the main doctrine events
to perform described tasks at the right time. Each process can be performed immediately or after a timeout.
Processes use the `OroMessageQueue` component and the bundle to provide the possibility of delayed execution.

Main Entities
-------------

Three entities represent processes:

1. **Definition** is the primary entity that contains information about a specific process. It contains the most important
information: process-related entity type (e.g., user) and what the actions must be performed with this entity
(e.g., change the value of a field). Another important option is the execution order that affects the order of processes
execution if several processes are subscribed to the same event of the same entity. The process can be enabled or disabled.
Other fields of the process definition contain the process name, when this process was created and when it was last updated.

2. **Trigger** entity provides information about the trigger used to run the related process when this process is invoked.

   There are two types of triggers:

    - **event**

    The first parameter is the trigger event - one of ``create``, ``update`` or ``delete``.
    The second parameter defines the entity field name used to listen (used for the ``update`` event only) and the process that is
    invoked only if the value of this field has been changed. The trigger also contains information about when the process
    should be performed - immediately or with delay (delay interval in the seconds of PHP date interval
    format). In case of delayed execution, you can also control the execution priority of process jobs.

    - **cron**

    Allows execution of processes based on cron-definition. The cron definition itself is specified in the ``cron`` parameter
    (e.g., ``*/1 * * * *``). These triggers can be executed only if the system has configured the cron script with the ``oro:cron`` command.

    .. note:: Each trigger can define only one of these types.

3. **Job** is an entity that contains information specific to the performing process in case of delayed processing
(in this case, JMS job is created). Depending on the event, a job can contain the following data:

    - ``create`` event - entity identity;
    - ``update`` event - entity identity and change set (old and new values);
    - ``delete`` event - entity plain fields (without references).

Each job entity also contains a relation to the trigger used to create this job and entity hash (the full class name
of the related entity plus the identity of a specific entity). This entity hash is required in order to find all registered jobs
for the same entity (e.g., to remove all related jobs).

Principles
----------

Each process definition related to an entity type, and each definition can have several triggers.

When a user performs an action with an entity that is related to an enabled process definition,
all existing triggers for this process are analyzed, and the appropriate ones are found to be executed.

A trigger can be processed in two ways. The first one is immediate execution; in this case, the process action is
executed right after the entity is flushed to the database or by the cron schedule. The second one is delayed execution; it creates a job and sends it
to the queue with the specified priority. If an entity has several appropriate process triggers, then all of them
are processed in the order defined by definition.

Once a specific entity item is deleted, all job processes related to this entity are also deleted.

.. warning:: Performing the action described in the process definition can provoke triggers of other processes (or even the same process).
             You should either use an appropriate condition to avoid recursion or use the "exclude_definitions" option.

Configuration
-------------

All processes are described in the configuration. The example below illustrates a simple process configuration that performs
an action with the Contact entity.

.. code-block:: php
   :linenos:

    processes:
        definitions:                                                 # list of definitions
            contact_definition:                                      # name of process definition
                label: 'Contact Definition'                          # label of the process definition
                enabled: true                                        # this definition is enabled (activated)
                entity: Oro\Bundle\ContactBundle\Entity\Contact   # related entity
                order: 20                                            # processing order
                exclude_definitions: [contact_definition]            # during handling those definitions won't trigger
                preconditions:                                       # List of preconditions to check before scheduling process
                    @equal: [$source.name, 'other']                  # Perform process only for entities that have "other" source
                actions_configuration:                               # list of actions to perform
                    - '@find_entity':                                  # find existing entity
                        conditions:                                  # action conditions
                            @empty: $assignedTo                      # if field $assignedTo is empty
                        parameters:                                  # action parameters
                            class: Oro\Bundle\UserBundle\Entity\User # $assignedTo entity full class name
                            attribute: $assignedTo                   # name of attribute that will store entity
                            where:                                   # where conditions
                                username: 'admin'                    # username is 'admin'
        triggers:                                                    # list of triggers
            contact_definition:                                      # name of trigger
                -
                    event: create                                    # event on which the trigger performed
                -
                    event: update                                    # event on which the trigger performed
                    field: assignedTo                                # field name to listen
                    priority: 10                                     # priority of the job queue
                    queued: true                                     # this process must be executed in queue
                    time_shift: 60                                   # this process must be executed with 60 seconds delay
                -
                    cron: */1 * * * *                                # execute process every 1 minute

This configuration describes the process that relates to the ``Contact`` entity. Every 1 minute, or every time a contact is
created, or the ``Assigned To`` field is changed, the current administrator user is set as the assigned user.
In other words, a contact is assigned to the current administrator.

The described logic is implemented using one definition and two triggers.
The first trigger is processed immediately after the contact is created, and the second one creates a new process job
and sends it to the message queue with priority ``10`` and time-shift ``60``, so the job is processed a minute later than
the triggered action.

When contact ``Assigned To`` field is updated, then process "contact_definition" is eventually handled, and the
value of the ``Assigned To`` field can be changed. When the "exclude_definitions" option is specified, this process does not
provoke self-triggering.

.. note::
         - If you want to test this process configuration in a real application, you can place this configuration into the ``Oro/Bundle/WorkflowBundle/Resources/config/oro/processes.yml`` file and reload the definitions using the console command``bin/console oro:process:configuration:load``. After that, you can create a ``Contact`` of the changed assigned user and ensure that the process works.
         - Expression `$.` allows you to access the main data container; for processes, it is an instance of `Oro\Bundle\WorkflowBundle\Model\ProcessData`.
         - Expression `$` (shortcut) or `$.data` allows you to access the current entity; above in example it is `Oro\Bundle\ContactBundle\Entity\Contact`.

Console Commands
----------------

WorkflowBundle provides two following console commands to work with processes.

oro:process:configuration:load
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This command loads processes configuration from .yml configuration files to the database. It is used during application installation and update. The command has two optional options:

- **--directories** - this option specifies directories used to find configuration files (multiple values allowed)
- **--definitions** - this option specifies names of the process definitions that should be loaded (multiple values allowed)

.. note:: You should run this command if process configuration was changed to upload your changes to DB.

oro:process:handle-trigger
^^^^^^^^^^^^^^^^^^^^^^^^^^

This command handles the trigger with a specified identifier and the process name. The command has two required options:

- **--id** - the identifier of the ProcessTrigger to handle
- **--name** - the name of ProcessDefinition. The trigger should belong to this ProcessDefinition

REST API
--------

OroWorkflowBundle provides REST API that allows activation and deactivation of processes.

Activation URL attributes:

* **route:** ``oro_api_process_activate``
* **parameter:** processDefinition - the name of the appropriate process definition

Deactivation URL attributes:

* **route:** ``oro_api_process_deactivate``
* **parameter:** processDefinition - the name of the appropriate process definition



.. include:: /include/include-links-dev.rst
   :start-after: begin
