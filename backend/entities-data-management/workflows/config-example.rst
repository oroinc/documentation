.. _backend-workflows-example:

Workflow Configuration Example
==============================

The workflow configuration that we are going to illustrate has two entities:

* Phone Call
* Phone Conversation

.. image:: /img/backend/entities_data_management/configuration-reference_workflow-example-entities.png
   :alt: Workflow Diagram

When Workflow Item is created, it is connected to the Phone Call. On the first "Start Call" step , a user can proceed to the "Call Phone Conversation Step" if the recipient answered, or to the "End Phone Call" step if the recipient did not.

On step "Call Phone Conversation", the user enters Workflow Data and navigates to the "End Phone Call" step via the "End conversation" transition. On this transition, a new Entity of Phone Conversation is created and assigned to the Phone Call entity.

Configuration
-------------

.. code-block:: yaml

    workflows:
        phone_call:
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall
            start_step: start_call
            metadata:
                is_collaboration_workflow: true
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
            attributes:
                phone_call:
                    type: entity
                    options:
                        class: Acme\Bundle\DemoBundle\Entity\PhoneCall
                call_timeout:
                    type: integer
                call_successfull:
                    type: boolean
                conversation_successful:
                    type: boolean
                conversation_comment:
                    type: string
                conversation_result:
                    type: string
                unresolved_questions:
                    type: string
                conversation:
                    type: entity
                    options:
                        class: Acme\Bundle\DemoBundle\Entity\PhoneConversation
            variable_definitions:
                variables:
                    var1:
                        type: 'string'
                        value: 'Var1Value'
            transitions:
                start_call:
                    is_start: true                         # this transition used to start new workflow
                    step_to: start_conversation            # next step after transition performing
                    transition_service: acme.demo.workflow.transition.connected # An ID of the transition service
                    init_context_attribute: init_source    # name of variable which contains init context
                    init_entities:                         # list of view page entities where will be displayed transition button
                        - 'Oro\Bundle\UserBundle\Entity\User'
                        - 'Oro\Bundle\TaskBundle\Entity\Task'
                    init_datagrids:                        # list of datagrids on which rows start transition buttons should be shown for start transition from not related entity
                        - user_entity_grid
                        - task_entity_grid
                connected:
                    step_to: start_conversation
                    transition_definition: connected_definition
                not_answered:
                    step_to: end_call
                    conditional_steps_to:
                        start_call:                            # If there are open questions transit workflow to start_call step. Otherwise transit to default step_to (end_call step)
                            conditions:
                                '@not_empty': $unresolved_questions
                    transition_service: acme.phone_call.workflow.transition.not_answered
                end_conversation:
                    step_to: end_call
                    form_options:
                        attribute_fields:
                            conversation_comment: ~
                    transition_definition: end_conversation_definition
            transition_definitions:
                connected_definition: # Try to make call connected
                    # Check that timeout is set
                    conditions:
                        '@not_blank': [$call_timeout]
                    # Set call_successfull = true
                    actions:
                        - '@assign_value':
                            parameters: [$call_successfull, true]
                not_answered_definition: # Callee did not answer
                    # Make sure that caller waited at least 60 seconds
                    conditions: # call_timeout not empty and >= 60
                        '@and':
                            - '@not_blank': [$call_timeout]
                            - '@ge': [$call_timeout, 60]
                    # Set call_successfull = false
                    actions:
                        - '@assign_value':
                            parameters: [$call_successfull, false]
                end_conversation_definition:
                    conditions:
                        # Check required properties are set
                        '@and':
                            - '@not_blank': [$conversation_result]
                            - '@not_blank': [$conversation_comment]
                            - '@not_blank': [$conversation_successful]
                    # Create PhoneConversation and set it's properties
                    # Pass data from workflow to conversation
                    actions:
                        - '@create_entity': # create PhoneConversation
                            parameters:
                                class: Acme\Bundle\DemoBundle\Entity\PhoneConversation
                                attribute: $conversation
                                data:
                                    result: $conversation_result
                                    comment: $conversation_comment
                                    successful: $conversation_successful
                                    call: $phone_call

Transition Service
-------------------

In the example for the ``start_call`` transition the ``transition_service`` was set to handle the transition logic.
Here is a service implementation:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Workflow\PhoneCall\Transition;

    use Doctrine\Persistence\ManagerRegistry;
    use Oro\Bundle\ActionBundle\Provider\ButtonSearchContextProvider;
    use Oro\Bundle\UserBundle\Entity\User;
    use Oro\Bundle\WorkflowBundle\Model\TransitionServiceAbstract;

    class ConnectedTransition extends TransitionServiceAbstract
    {
        public function __construct(
            private ManagerRegistry $registry
        ) {
        }

        public function isConditionAllowed(WorkflowItem $workflowItem, Collection $errors = null): bool
        {
            $initContext = $workflowItem->getData()->get('init_context');

            return $initContext instanceof ButtonSearchContext
                && $initContext->getEntityClass()
                && $initContext->getEntityId();
        }

        public function execute(WorkflowItem $workflowItem): void
        {
            $data = $workflowItem->getData();
            $initContext = $data->get('init_context');

            $em = $this->registry->getManagerForClass($initContext->getEntityClass());
            $user = $em->find($initContext->getEntityClass(), $initContext->getEntityId());

            if ($user instanceof User) {
                $workflowItem->getEntity()->setPhone($user->getPhone());
                $em->flush();
            }
        }
    }


.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    services:
            # ...
            acme.demo.workflow.transition.connected:
                class: Acme\Bundle\DemoBundle\Workflow\PhoneCall\Transition\ConnectedTransition
                arguments:
                    - '@doctrine'
                tags:
                    - { name: 'oro_workflow.transition_service' }


Translation File Configuration
------------------------------

To define translatable textual representation of the configuration fields, create translation file `Acme\\Bundle\\DemoBundle\\Resources\\translations\\workflows.en.yml` with the  following content.

.. code-block:: yaml


    oro:
        workflow:
            phone_call:
                label: 'Demo Call Workflow'
                step:
                    start_call:
                        label: 'Start Phone Call'
                    start_conversation:
                        label: 'Call Phone Conversation'
                    end_call:
                        label: 'End Phone Call'
                attribute:
                    phone_call:
                        label: 'Phone Call'
                    call_timeout:
                        label: 'Call Timeout'
                    call_successfull:
                        label: 'Call Successful'
                    conversation_successful:
                        label: 'Conversation Successful'
                    conversation_comment:
                        label: 'Conversation Comment'
                    conversation_result:
                        label: 'Conversation Result'
                    conversation:
                        label: Conversation
                    unresolved_questions:
                        label: 'Unresolved Questions'
                transition:
                    connected:
                        label: Connected
                        warning_message: 'Going to connect...'
                    not_answered:
                        label: 'Not answered'
                    end_conversation:
                        label: 'End conversation'
                        attribute:
                            conversation_comment:
                                label: 'Comment for the call result'


As usual, for Symfony translations (messages) files, the structure of nodes can be grouped by key dots. This code above provides the full tree just as an example.
See more about translations in the :ref:`Translations Wizard <backend--workflows--translation-wizard>` topic.

PhoneCall Entity
----------------

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'acme_demo_phone_call')]
    class PhoneCall
    {
        #[ORM\Id]
        #[ORM\Column(name: 'id', type: 'integer')]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        private $id;

        #[ORM\Column(name: 'number', type: 'string', length: 255)]
        private $number;

        #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: true)]
        private $name;

        #[ORM\Column(name: 'description', type: 'text', nullable: true)]
        private $description;

        #[ORM\OneToMany(targetEntity: 'PhoneConversation', mappedBy: 'call')]
        private $conversations;

        public function __construct()
        {
            $this->conversations = new ArrayCollection();
        }

        public function getId()
        {
            return $this->id;
        }

        public function setNumber($number)
        {
            $this->number = $number;
            return $this;
        }

        public function getNumber()
        {
            return $this->number;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function getConversations()
        {
            return $this->conversations;
        }
    }


PhoneConversation Entity
------------------------

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    #[ORM\Table(name: 'acme_demo_phone_conversation')]
    class PhoneConversation
    {
        #[ORM\Id]
        #[ORM\Column(name: 'id', type: 'integer')]
        #[ORM\GeneratedValue(strategy: 'AUTO')]
        private $id;

        #[ORM\ManyToOne(targetEntity: 'PhoneCall', inversedBy: 'conversations')]
        #[ORM\JoinColumn(name: 'call_id', referencedColumnName: 'id')]
        private $call;

        #[ORM\Column(name: 'result', type: 'string', length: 255, nullable: true)]
        private $result;

        #[ORM\Column(name: 'comment', type: 'string', length: 255, nullable: true)]
        private $comment;

        #[ORM\Column(name: 'successful', type: 'boolean', nullable: true)]
        private $successful;

        public function getId()
        {
            return $this->id;
        }

        public function setResult($result)
        {
            $this->result = $result;

            return $this;
        }

        public function getResult()
        {
            return $this->result;
        }

        public function setComment($comment)
        {
            $this->comment = $comment;
            return $this;
        }

        public function getComment()
        {
            return $this->comment;
        }

        public function setSuccessful($successful)
        {
            $this->successful = $successful;
            return $this;
        }

        public function isSuccessful()
        {
            return $this->successful;
        }

        public function setCall($call)
        {
            $this->call = $call;
            return $this;
        }

        public function getCall()
        {
            return $this->call;
        }
    }


Flow Diagram
------------

.. image:: /img/backend/entities_data_management/configuration-reference_workflow-example-diagram.png
   :alt: Workflow Diagram
