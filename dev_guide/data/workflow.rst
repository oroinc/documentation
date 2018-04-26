.. _dev-doc--workflows:

Workflows
=========

.. contents:: :local:
   :depth: 4

Overview
--------

In a business application, a ``workflow`` is a sequence of steps or rules applied to a process from its initiation to completion.
In OroCRM, workflows organize and direct users’ work, making them follow particular steps in a pre-defined order, or preventing them from performing actions that either contradict or conflict with the logical steps of a process.

A workflow ``step`` is a state of an entity record. It is represented by an instance of the :class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowStep` class.

The process of moving an entity from one step to another is called a ``transition``.

Simple workflows can be created via the user interface. For more information on how to do it, see :ref:`Workflow Management <doc--system--workflow-management>`.

This guide provides you with the basic assistance on how to create workflows by adding information into the configuration files. For more detailed information about the workflow configuration, see `Workflow Guide <https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/WorkflowBundle/Resources/doc/reference/workflow/translations-wizard.md>`__ on GitHub.

Configure a Workflow
--------------------

To configure a custom workflow, create the ``workflows.yml`` file with the configuration and save it into the ``/Resources/config/oro`` directory of your bundle.

.. hint:: You can simplify workflow creation by cloning the existing workflow. See :ref:`How to clone a workflow <workflows--actions--clone>`.

For each entity, you can configure as many workflows as required.

.. note:: Pay attention to the business logic. When you create workflows that can be mutually exclusive, make sure that there is no possibility that they may be activated simultaneously.


Translations
^^^^^^^^^^^^

To correctly display the user interface text concerning workflow process (button labels, page names, etc.), you need to specify `translations` for it.

Create translation files as:

`<YourBundle>/Resources/translations/workflows.{lang_code}.yml`,

where `{lang_code}` is a two-letter language code, e.g. `workflows.en.yml`.

You need to create such file for each language that you will use.

.. tip:: 

   To simplify creation of the translation file, you can first create a workflow configuration, and then dump all related translation keys to the `workflows.{lang_code}.yml`. For example, if you create workflow 'my_workflow':
   
   `app/console oro:workflow:translations:dump my_workflow --locale=en > <YourBundle>/Resources/translations/workflows.en.yml`
  

For more information, see `Workflow Translation Wizard <https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/WorkflowBundle/Resources/doc/reference/workflow/translations-wizard.md>`__ on GitHub.


Add a Workflow
^^^^^^^^^^^^^^

In the ``workflows.yml``, use the ``workflows`` key to specify that you are going to add workflows.

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

The value of the ``workflows`` key is the array of workflows.

To define a new workflow, add its name to the array.

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

    workflows:
        phone_call:   # This is the workflow name.


For each workflow key, the corresponding value is the array of the workflow settings. The basic settings include the definitions of:

- An entity that the workflow is applicable to.
- The initial step that is attained upon initializing the workflow.


In the following example, you can find the configuration of the **Phone Call** workflow. This workflow defines the process of making a call to a customer:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

    workflows:
        phone_call:
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall    # This is the entity that the workflow is applicable to.
            start_step: start_call                             # This is the initial step that is attained upon initializing of the workflow.
            defaults:
                active: true
            priority: 10


Translations
""""""""""""

Define the the user-interface workflow name:

+----------------------------------------+---------------------+
| Translation Key                        | Description         |
+========================================+=====================+
| `oro.workflows.{workflow_name}.label`  | The workflow name.  |
+----------------------------------------+---------------------+

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    label: 'Phone Call'                      # The workflow name as it appears on the user interface.




Define Workflow Steps
^^^^^^^^^^^^^^^^^^^^^

Next, define the workflow steps—that is, which states the record can attain through the workflow:

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

        workflows:
        phone_call:
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall
                start_step: start_call                 # The initial state of the record is represented by the start_call step.
            defaults:
                active: true
            priority: 10
            steps:
                    start_call:                         # The workflow step.
                        allowed_transitions:            # The list of transitions that can be made from this step.
                        - connected
                        - not_answered
                    start_conversation:                 # The workflow step.
                        allowed_transitions:            # The list of transitions that can be made from this step.
                        - end_conversation
                    end_call:                           # The workflow step.
                    is_final: true

    In this example, the record can have three states:

- **start_call**
- **start_conversation**
- **end_call**

Note that the **start_call** step is specified as the start step: ``start_step: start_call``.
The **end_call** step is marked as final (``is_final: true``) which means that the workflow terminates when this step is reached.


The ``allowed_transitions`` key in the values of a step defines which transitions can be made from the step.

.. note:: The ``is_final`` flag added to the **end_call** step does not mean that you cannot specify transitions after it—you can specify as many as you require. This flag is used internally for additional data manipulation (for example, to report records on which a workflow has run to its final step).

Translations
""""""""""""

Define how the workflow step name will appear on the user interface:

+--------------------------------------------------------+--------------------------+
| Translation Key                                        | Description              |
+========================================+==========================================+
| `oro.workflow.{workflow_name}.step.{step_name}.label`  | The workflow step name.  |
+--------------------------------------------------------+--------------------------+

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    step:
                        start_call.label: 'Start Phone Call'
                        start_conversation.label: 'Call Phone Conversation'
                        end_call.label: 'End Phone Call'

Configure Transitions
^^^^^^^^^^^^^^^^^^^^^

To configure transitions, define the following:

- Which transitions are available (place transition name keys under the ``transitions`` key).
- To which steps they bring an entity record (the ``step_to`` key under the transition name key).
- Which conditions must be satisfied for the transition to be available and what actions must be taken before and after the transition.
- Which automatic triggers apply if any.

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

        workflows:
            phone_call:
                # ...
                transitions:
                    connected:                                                # The workflow transition.
                        step_to: start_conversation                           # The step the transition brings an entity record.
                        transition_definition: connected_definition           # The transition definition that defines conditions which enable the transition, and pre/post actions.
                    not_answered:
                        step_to: end_call
                        transition_definition: not_answered_definition
                    end_conversation:
                        step_to: end_call
                        transition_definition: end_conversation_definition
                        triggers:                                             # The triggers that activate the transition.
                            -
                                cron: '* * * * *'
                                filter: "e.someStatus = 'OPEN'"



Translations
""""""""""""

Define how the workflow transition name will appear on the user interface and the warning message:

+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
| Field                                                                                        | Description                                                                                                     |
+==============================================================================================+=================================================================================================================+
| `oro.workflow.{workflow_name}.transition.{transition_name}.label`                            | The transition name.                                                                                            |
+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.transition.{transition_name}.warning_message`                  | A notification message text shown before the transition is executed.                                            |
+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+



.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    transition:
                        connected:
                                    label: 'Connected'
                                warning_message: 'Connection performed!'
                    not_answered
                                label: 'Not Answered'
                    end_conversation
                                label: 'End Conversation'



Specify Modifiable Attributes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can enable a user to modify attributes of the record during transitions. To do this, list attributes that can be modified during any of the workflow's transitions under the ``attributes`` key:

.. code-block:: yaml
    :linenos:

            # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

            workflows:
        phone_call:
            # ...
            attributes:
                    phone_call:                             # The workflow attribute.
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneCall
                    call_timeout:                           # The workflow attribute.
                    type: integer
                    call_successful:                        # The workflow attribute.
                    type: boolean
                conversation_successful:
                    type: boolean
                conversation_comment:
                    type: string
                conversation_result:
                    type: string
                conversation:
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation

.. tip::

    By default, the attribute data is stored inside the ``WorkflowItem`` entity. Consequently, this data can only be accessed in the scope of the specific workflow for an entity.

    To automatically store and retrieve attributes data by a property path (i.e. such attributes can be considered as links to an entity's values), use the :ref:`property_path option <reference-format-workflow-attributes-property-path>` instead:

    .. code-block:: yaml
        :linenos:

        workflows:
            phone_call:
                # ...
                attributes:
                    timeout:
                        property_path: entity.call_timeout

    The ``entity`` part of the property path refers to the underlying entity. You can change the name using the :ref:`entity_attribute option <reference-format-workflow-entity-attribute>`.


Translations
""""""""""""

For attributes, you need to add labels into two places: first, to the list of all attribute labels, second, to the list of labels for attributes of each transition that has them.

+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.attribute.{attribute_name}.label`                              | A default label text for the attribute.                                |
+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.transition.{transition_name}.attribute.{attribute_name}.label` | A label text for attribute of the corresponding particular transition. |
+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+


.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
            phone_call:
                attribute:
                        phone_call
                                    label: 'Phone Call'
                    call_timeout
                                label: 'Call Timeout'
                    call_successful
                        label: 'Call Successful'


.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    transition:
                        connected:
                            ...
                            attribute:
                                opportunity:
                                    label: 'Call Successful'



.. _book-workflow-transitions:


Configure Transition Triggers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A ``transition trigger`` is what initiates a transition. Transitions can be automatically initiated on event (by an ``event trigger``) or by a cron job (by a ``cron trigger``).

.. important:: Please note that a trigger initiates the transition even if the workflow has not been started for the record.



Event Trigger
"""""""""""""

To set up an event trigger, configure the following options:

* **entity_class**—Specify the class of the entity that triggers the transition.
* **event**—Specify the type of the event. Enter one of the following values:

    * *create*
    * *update*
    * *delete*

* **field**—This option is applicable only for the *update* event. Enter the name of the field that should be updated to trigger the transition.
* **queued**—Whether the trigger must be queued. Specify one of the following values:

    *true*—Put the trigger into the initiation queue. This is a default value.

    .. TODO

    *false*—Process the trigger immediately.

* **require**—The condition that should be matched to activate the trigger. Define the condition using Symfony Expression Language. You can use the following aliases when constructing the expression:

    * `entity`—The entity that dispatches the event.
    * `mainEntity`—The underlying entity of the trigger' workflow.
    * `wd`—The workflow definition.
    * `wi`—The workflow item.

  .. TODO Add more info about definitions and items.

* **relation**—Property path to `mainEntity` relative to `entity` if they are different.

Example
~~~~~~~

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                connected:
                    ...
                    triggers:
                        -
                            entity_class: Oro\Bundle\SaleBundle\Entity\Quote    # The entity class: the trigger is activated when you work with the Quote entity records.
                            event: update                                       # The event type: the trigger activates on the update action.
                            field: status                                       # The field that must be updated to activate the trigger.
                            queued: false                                       # Process the trigger immediately.
                            relation: call                                      # The relation to the Workflow entity.
                            require: "entity.status = 'pending'"                # The trigger activation condition.

Cron Trigger
""""""""""""

To set up a cron trigger, configure the following options:

* **cron**—A cron definition.
* **queued**—Whether the trigger must be queued. Specify one of the following values:

    *true*—Put the trigger into the initiation queue. This is a default value.
    *false*—Process the trigger immediately.

* **filter**—The condition that should be matched to activate the trigger. Define the condition using Symfony Expression Language. You can use the following aliases when constructing the expression:

    * `e`—The entity name.
    * `wd`—The workflow definition.
    * `wi`—The workflow item.
    * `ws`—The current workflow step.

Example
~~~~~~~

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                connected:
                    ...
                    triggers:
                        -
                            cron: '* * * * *'                                   # The cron definition.
                            filter: "e.someStatus = 'OPEN'"                     # The dql-filter.


Configure Transition Definitions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A ``transition definition`` is used by a transition to check conditions and to perform the ``init action`` and ``post actions``.

To set up an event trigger, configure the following options:

* **conditions**—The condition that should be matched for transition to be initiated.
* **post_actions**—The actions that must be performed upon the transition to the next step.
* **init_actions**—The actions that may be performed on the workflow item before the conditions are matched and transition is initiated.

Example
"""""""

.. code-block:: none
    :linenos:

    workflows:
        phone_call:
            # ...
            transition_definitions:

                # Try to establish a call.

                connected_definition:

                    # Check that timeout is set.

                    conditions:
                        @not_blank: [$call_timeout]

                    # Set call_successfull = true

                    post_actions:
                        - @assign_value: [$call_successfull, true]
                    init_actions:
                        - @increment_value: [$call_attempt]

                # Callee did not answer.

                not_answered_definition:

                    # Make sure that caller waited at least 60 seconds:
                    # call_timeout not empty and >= 60

                    conditions:
                        @and:
                            - @not_blank: [$call_timeout]
                            - @ge: [$call_timeout, 60]

                    # Set call_successfull = false

                    post_actions:
                        - @assign_value: [$call_successfull, false]

                end_conversation_definition:
                    conditions:

                        # Check that required properties are set.

                        @and:
                            - @not_blank: [$conversation_result]
                            - @not_blank: [$conversation_comment]
                            - @not_blank: [$conversation_successful]

                    post_actions:

                    # Create the PhoneConversation entity and set its properties.
                    # Pass data from the workflow to the conversation.

                        - @create_entity:
                            class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation
                            attribute: $conversation
                            data:
                                result: $conversation_result
                                comment: $conversation_comment
                                successful: $conversation_successful
                                call: $phone_call





Related Topics
--------------

Read more about all the available options in the :doc:`Workflow Reference </reference/format/workflows>`.