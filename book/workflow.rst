Workflows
=========

In a business application, entities often have a well defined state and undergo transitions between
different states. Workflows are a way to apply state to entities and to control when and how an
entity can perform the transition from one state to another.

.. seealso::

    Simple workflows can be created in the user interface. Read more about this feature
    :doc:`in the user guide </user_guide/workflow_management>`.

.. sidebar:: Workflows, Steps, and Transitions

    The state of an entity is called a *step*. It is represented by an instance of the
    :class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowStep` class. The process of moving an
    entity from one step to another is called a *transition*.

Configuring a Workflow
~~~~~~~~~~~~~~~~~~~~~~

Custom workflows can be configured using a YAML configuration format that will be explained below.
This configuration needs to be placed in a file named ``workflow.yml`` in the ``Resources/config``
directory of your bundle.

General information
...................

Under the ``workflows`` key each workflow is created by adding a key that is its name and is used
to identify workflows. The following example configures a workflow that defines the process of
calling a customer:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/workflow.yml
    workflows:
        phone_call:
            label: 'Call Customer'
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall
            enabled: true
            start_step: start_call

The basic configuration contains a name that is displayed in the UI, the entity the workflow will
be applied to and the initial step that is applied when initializing the workflow for an entity.

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
                    label: 'Start Phone Call'
                    allowed_transitions:
                        - connected
                        - not_answered
                start_conversation:
                    label: 'Call Phone Conversation'
                    allowed_transitions:
                        - end_conversation
                end_call:
                    label: 'End Phone Call'
                    is_final: true

In this example, the entity can have three states: ``start_call`` (which was configured as the
start step above), ``start_conversation`` and ``end_call``. The ``end_call`` step is marked as
final which means that the workflow terminates when this step is reached. The ``final`` flag does
not mean that there cannot be any further transitions, but it is used internally for additional
data manipulation (for example, report entities whose workflow is in a final step).

The ``allowed_transitions`` defines which :ref:`transitions <book-workflow-transitions>` can be
applied in a step.

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
                    label: Phone Call
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneCall
                call_timeout:
                    type: integer
                    label: 'Call Timeout'
                call_successfull:
                    type: boolean
                    label: 'Call Successful'
                conversation_successful:
                    type: boolean
                    label: 'Conversation Successful'
                conversation_comment:
                    type: string
                    label: 'Conversation Comment'
                conversation_result:
                    type: string
                    label: 'Conversation Result'
                conversation:
                    type: entity
                    label: 'Conversation'
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
                        label: 'Call Timeout'
                        property_path: entity.call_timeout

    The ``entity`` part of the property path refers to the underlying entity. You can change the
    name using the :ref:`entity_attribute option <reference-format-workflow-entity-attribute>`.

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
    :doc:`the workflow reference </reference/format/workflow>`.
