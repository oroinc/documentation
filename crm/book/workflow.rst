Workflows
=========

In a business application, entities often have a well defined state and undergo transitions between
different states. Workflows are a way to apply state to entities and to control when and how an
entity can perform the transition from one state to another.

.. seealso::

    Simple workflows can be created in the user interface. Read more about this feature
    :doc:`in the user guide </admin_guide/record_mgmt_config/workflow_management>`.

.. sidebar:: Workflows, Steps, and Transitions

    The state of an entity is called a *step*. It is represented by an instance of the
    :class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowStep` class. The process of moving an
    entity from one step to another is called a *transition*.

Configuring a Workflow
~~~~~~~~~~~~~~~~~~~~~~

Custom workflows can be configured using a YAML configuration format that will be explained below.
This configuration needs to be placed in a file named ``workflows.yml`` in the ``Resources/config/oro``
directory of your bundle.

Translations
............

Together with workflows configurations, for almost each sections that specified below there should be defined
translation messages under corresponded key to display correct UI text.
Configuration of translations are implemented in the same way as other translation resources (you might know them by
files placed under `<YourBundle>/Resources/translation/messages.en.yml` or
`<YourBundle>/Resources/translations/jsmessages.en.yml`).
For workflows there should be created their's own translations file
`<YourBundle>Resources/translations/workflows.{lang_code}.yml`
Where `{lang_code}` is your preferable language code for translations that gathered there.
Further in each section that describe workflow configuration part would be note provided with a proper
**translation key** for translatable fields that can be used in configuration section.


General information
...................

Under the ``workflows`` key each workflow is created by adding a key that is its name and is used
to identify workflows. The following example configures a workflow that defines the process of
calling a customer:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml
    workflows:
        phone_call:
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall
            start_step: start_call
            defaults:
                active: true
            priority: 10

The basic configuration contains a name that is displayed in the UI, the entity the workflow will
be applied to and the initial step that is applied when initializing the workflow for an entity.

.. note::

    Translation fields:
    - `oro.workflow.{workflow_name}.label` - label text for specified workflow


Defining the Workflow Steps
...........................

Next, you need to define the states an entity can have when the workflow is applied:

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            steps:
                start_call:
                    allowed_transitions:
                        - connected
                        - not_answered
                start_conversation:
                    allowed_transitions:
                        - end_conversation
                end_call:
                    is_final: true

In this example, the entity can have three states: ``start_call`` (which was configured as the
start step above), ``start_conversation`` and ``end_call``. The ``end_call`` step is marked as
final which means that the workflow terminates when this step is reached. The ``final`` flag does
not mean that there cannot be any further transitions, but it is used internally for additional
data manipulation (for example, report entities whose workflow is in a final step).

The ``allowed_transitions`` defines which :ref:`transitions <book-workflow-transitions>` can be
applied in a step.

.. note::

    Translation fields:
    - `oro.workflow.{workflow_name}.step.{step_name}.label` - label text for specified step in workflow
    See below example of `Resource/translations/workflow.en.yml` for previous configuration section:


.. code-block:: yaml
    :linenos:

    oro.workflows:
        phone_call:
            step:
                start_call.label: 'Start Phone Call'
                start_conversation.label: 'Call Phone Conversation'
                end_call.label: 'End Phone Call'


Workflow Attributes
...................

During the transition from one step to another step, the user can modify attributes of the
underlying entity. All attributes that can be modified in any of the transitions must be enabled
with the ``attributes`` option:

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            attributes:
                phone_call:
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneCall
                call_timeout:
                    type: integer
                call_successful:
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

    By default attribute data is stored inside the ``WorkflowItem`` entity, i.e. this data can only
    be accessed in the scope of the specific workflow for some entity. You can use the
    :ref:`property_path option <reference-format-workflow-attributes-property-path>` instead to
    automatically store and retrieve attributes data by property path (i.e. such attributes can be
    considered as links to an entity's values):

    .. code-block:: yaml
        :linenos:

        workflows:
            phone_call:
                # ...
                attributes:
                    timeout:
                        property_path: entity.call_timeout

    The ``entity`` part of the property path refers to the underlying entity. You can change the
    name using the :ref:`entity_attribute option <reference-format-workflow-entity-attribute>`.

.. note::

    Translation fields:
    - `oro.workflow.{workflow_name}.attribute.{attribute_name}.label` - label text for specified attribute in workflow
    See below example of `Resource/translations/workflow.en.yml` for previous configuration section:


.. code-block:: yaml
    :linenos:

        oro.workflows:
            phone_call:
                attribute:
                    phone_call.label: Phone Call
                    call_timeout.label: Call Timeout
                    call_successful.label: 'Call Successful'
        #... and on

.. _book-workflow-transitions:

Configuring the Transitions
...........................

Then, you need to define which transitions are available, to which step they transform the entity
and which attributes can be modified when applying a transition:

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                connected:
                    label: 'Connected'
                    step_to: start_conversation
                    transition_definition: connected_definition
                not_answered:
                    label: "Not answered"
                    step_to: end_call
                    transition_definition: not_answered_definition
                end_conversation:
                    label: 'End conversation'
                    step_to: end_call
                    transition_definition: end_conversation_definition
                    triggers:
                        -
                            cron: '* * * * *'
                            filter: "e.someStatus = 'OPEN'"


.. note:: Translation fields:

    +----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
    | Field                                                                                        | Description                                                                                                     |
    +==============================================================================================+=================================================================================================================+
    | `oro.workflow.{workflow_name}.transition.{transition_name}.label`                            | A label text for specified transition in workflow                                                               |
    +----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
    | `oro.workflow.{workflow_name}.transition.{transition_name}.warning_message`                  | A notification message text that will be shown before transition execution.                                     |
    +----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
    | `oro.workflow.{workflow_name}.transition.{transition_name}.attribute.{attribute_name}.label` | A label text for attribute in corresponding transition form defined in `attribute_fields` under `form_options`. |
    +----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+

    See below example of `Resource/translations/workflow.en.yml` for previous configuration section:4r4

.. code-block:: yaml
    :linenos:

            oro.workflows:
                phone_call:
                    transition:
                        connected:
                            label: Connected
                            warning_message: Connection performed
                        not_answered.label: Not answered
                        end_conversation.label: End conversation
            #... and on

Transition Triggers Configuration
.................................

Transition Triggers are used to perform Transition by Event or by cron-definition.

Please note that transition can be performed by trigger even if Workflow not started for the entity yet.

There are 2 types of triggers:

Event trigger:
--------------

Event trigger configuration has next options.

* **entity_class**
    Class of entity that can trigger transition.
* **event**
    Type of the event, can have the following values: `create`, `update`, `delete`.
* **field**
    Only for `update` event - field name that should be updated to handle trigger.
* **queue**
    [boolean, default = true] Handle trigger in queue (if `true`), or in realtime (if `false`)
* **require**
    String of Symfony Language Expression that should much to handle the trigger. Can use the following aliases:
    * `entity` - Entity object, that dispatched event,
    * `mainEntity` - Entity object of triggers' workflow,
    * `wd` - Workflow Definition object,
    * `wi` - Workflow Item object.
* **relation**
    Property path to `mainEntity` relative to `entity` if they are different.

Example
"""""""

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
                            entity_class: Oro\Bundle\SaleBundle\Entity\Quote    # entity class
                            event: update                                       # event type
                            field: status                                       # updated field
                            queued: false                                       # handle trigger not in queue
                            relation: call                                      # relation to Workflow entity
                            require: "entity.status = 'pending'"                # expression language condition

Cron trigger:
-------------

Cron trigger configuration has next options.

* **cron**
    Cron definition.
* **queue**
    [boolean, default = true] Handle trigger in queue (if `true`), or in realtime (if `false`)
* **filter**
    String of Symfony Language Expression that should much to handle the trigger. Can use the following aliases:
    * `e` - Entity,
    * `wd` - Workflow Definition,
    * `wi` - Workflow Item,
    * `ws` - Current Workflow Step.

Example
"""""""

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
                            cron: '* * * * *'                                   # cron definition
                            filter: "e.someStatus = 'OPEN'"                     # dql-filter


Transition Definition Configuration
...................................

Transition Definition is used by Transition to check Conditions and to perform Init Action and Post Actions.

Transition definition configuration has next options.

conditions
~~~~~~~~~~
    Configuration of Conditions that must satisfy to allow transition

post_actions
~~~~~~~~~~~~
    Configuration of Post Actions that must be performed after transit to next step will be performed.

init_actions
~~~~~~~~~~~~
    Configuration of Init Actions that may be performed on workflow item before conditions and post actions.

Example:

.. code-block:: yaml
    :linenos:

    workflows:
        phone_call:
            # ...
            transition_definitions:
                connected_definition: # Try to make call connected
                    # Check that timeout is set
                    conditions:
                        @not_blank: [$call_timeout]
                    # Set call_successfull = true
                    post_actions:
                        - @assign_value: [$call_successfull, true]
                    init_actions:
                        - @increment_value: [$call_attempt]
                not_answered_definition: # Callee did not answer
                    # Make sure that caller waited at least 60 seconds
                    conditions: # call_timeout not empty and >= 60
                        @and:
                            - @not_blank: [$call_timeout]
                            - @ge: [$call_timeout, 60]
                    # Set call_successfull = false
                    post_actions:
                        - @assign_value: [$call_successfull, false]
                end_conversation_definition:
                    conditions:
                        # Check required properties are set
                        @and:
                            - @not_blank: [$conversation_result]
                            - @not_blank: [$conversation_comment]
                            - @not_blank: [$conversation_successful]
                    # Create PhoneConversation and set it's properties
                    # Pass data from workflow to conversation
                    post_actions:
                        - @create_entity: # create PhoneConversation
                            class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation
                            attribute: $conversation
                            data:
                                result: $conversation_result
                                comment: $conversation_comment
                                successful: $conversation_successful
                                call: $phone_call

.. note::

    You can configure as many workflows as you like, even for one entity can be more than one active workflows.



.. seealso::

    Read more about all the available options in
    :doc:`the workflow reference </reference/format/workflows>`.
