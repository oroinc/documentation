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
information: process-related entity type (e.g., user) and what actions must be performed with this entity
(e.g., change the value of a field). Another important option is the execution order which affects the order of processes
execution if several processes are subscribed to the same event of the same entity. The process can be enabled or disabled.
Other fields of the process definition contain the process name, when this process was created, and when it was last updated.

2. **Trigger** entity provides information about the trigger used to run the related process when this process is invoked.

   There are two types of triggers:

    - **event**

    The first parameter is the trigger event - one of ``create``, ``update`` or ``delete``.
    The second parameter defines the entity field name used to listen (used for the ``update`` event only) and the process that is
    invoked only if the value of this field has been changed. The trigger also contains information about when the process
    should be performed - immediately or with delay (delay interval in the seconds of PHP date interval
    format). In case of delayed execution, you can also control the execution priority of process jobs.

    - **cron**

    Allows execution of processes based on cron definition. The cron definition itself is specified in the ``cron`` parameter
    (e.g., ``*/1 * * * *``). These triggers can be executed only if the system has configured the cron script with the ``oro:cron`` command.

    .. note:: Each trigger can define only one of these types.

3. **Job** is an entity that contains information specific to the performing process in case of delayed processing
(in this case, a JMS job is created). Depending on the event, a job can contain the following data:

    - ``create`` event - entity identity;
    - ``update`` event - entity identity and change set (old and new values);
    - ``delete`` event - entity plain fields (without references).

Each job entity also contains a relation to the trigger used to create this job and entity hash (the full class name
of the related entity plus the identity of a specific entity). This entity hash is required to find all registered jobs
for the same entity (e.g., to remove all related jobs).

Principles
----------

Each process definition is related to an entity type, and each definition can have several triggers.

When a user performs an action with an entity that is related to an enabled process definition,
all existing triggers for this process are analyzed, and the appropriate ones are found to be executed.

A trigger can be processed in two ways. The first one is immediate execution; in this case, the process action is
executed right after the entity is flushed to the database or by the cron schedule. The second one is delayed execution; it creates a job and sends it
to the queue with the specified priority. If an entity has several appropriate process triggers, then all of them
are processed in the order defined by definition.

Once a specific entity item is deleted, all job processes related to this entity are also deleted.

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

This configuration describes the process that relates to the ``Contact`` entity. Every 1 minute, or every time a contact is
created, or the ``Assigned To`` field is changed, the current administrator user is set as the assigned user.
In other words, a contact is assigned to the current administrator.

The described logic is implemented using one definition and two triggers.
The first trigger is processed immediately after the contact is created, and the second one creates a new process job
and sends it to the message queue with priority ``10`` and time-shift ``60``, so the job is processed a minute later than
the triggered action.

When contact ``Assigned To`` field is updated, the process "contact_definition" is eventually handled, and the
value of the ``Assigned To`` field can be changed. This process does not provoke self-triggering when the "exclude_definitions" option is specified.

.. note::
         - If you want to test this process configuration in an actual application, you can place this configuration into the ``Oro/Bundle/WorkflowBundle/Resources/config/oro/processes.yml`` file and reload the definitions using the console command ``php bin/console oro:process:configuration:load``. After that, you can create a ``Contact`` of the changed assigned user and ensure that the process works.
         - Expression `$.` allows you to access the main data container; for processes, it is an instance of ``Oro\Bundle\WorkflowBundle\Model\ProcessData``.
         - Expression `$` (shortcut) or `$.data` allows you to access the current entity; above in example it is ``Oro\Bundle\ContactBundle\Entity\Contact``.

Console Commands
----------------

WorkflowBundle provides two following console commands to work with processes.

oro:process:configuration:load
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This command loads processes configuration from .yml configuration files to the database. It is used during application installation and update. The command has two optional options:

- **--directories** - this option specifies directories used to find configuration files (multiple values allowed)
- **--definitions** - this option specifies names of the process definitions that should be loaded (multiple values allowed)

.. note:: You should run this command if the process configuration was changed to upload your changes to DB.

oro:process:handle-trigger
^^^^^^^^^^^^^^^^^^^^^^^^^^

This command executes a process trigger with a specified identifier and the process name. The command has two required options:

- **--id** - the identifier of the ProcessTrigger to handle
- **--name** - the name of ProcessDefinition. The trigger should belong to this ProcessDefinition

REST API
--------

OroWorkflowBundle provides REST API that allows the activation and deactivation of processes.

Activation URL attributes:

* **route:** ``oro_api_process_activate``
* **parameter:** processDefinition - the name of the appropriate process definition

Deactivation URL attributes:

* **route:** ``oro_api_process_deactivate``
* **parameter:** processDefinition - the name of the appropriate process definition


.. include:: /include/include-links-dev.rst
   :start-after: begin
