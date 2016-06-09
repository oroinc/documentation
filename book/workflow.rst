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

Transition Pre-Conditions and Post Actions
..........................................

.. note::

    You can configure as many workflows as you like, but you can only enable one workflow per
    entity type at the same time. Beware that any existing information associated with a workflow
    will get lost when you switch the active workflow of an entity.

.. seealso::

    Read more about all the available options in
    :doc:`the workflow reference </reference/format/workflow>`.

Applying Workflows to an Entity
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In order to be able to apply a workflow to an entity, the entity must have associations to the
:class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowItem` and
:class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowStep` classes. The property holding a
reference to a ``WorkflowItem`` instance keeps the information which workflow is currently being
applied to the entity. The ``WorkflowStep`` instance is used to store the current state of the
entity in this workflow:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/BlogPost.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
    use Oro\Bundle\WorkflowBundle\Entity\WorkflowStep;

    /**
     * @ORM\Entity()
     */
    class BlogPost
    {
        // ...

        /**
         * @ORM\OneToOne(targetEntity="Oro\Bundle\WorkflowBundle\Entity\WorkflowItem")
         */
        private $workflowItem;

        /**
         * @ORM\ManyToOne(targetEntity="Oro\Bundle\WorkflowBundle\Entity\WorkflowStep")
         */
        private $workflowStep;

        public function getWorkflowItem()
        {
            return $this->workflowItem;
        }

        public function setWorkflowItem(WorkflowItem $workflowItem)
        {
            $this->workflowItem = $workflowItem;
        }

        public function getWorkflowStep()
        {
            return $this->workflowStep;
        }

        public function setWorkflowStep(WorkflowStep $workflowStep)
        {
            $this->workflowStep = $workflowStep;
        }
    }

.. tip::

    You do not need to create those methods for extended entities or for entities created in the
    user interface. The needed properties and methods will be automatically generated when the first
    workflow is applied to them.
