.. _backend--workflows--workflow-events:


Workflow Events
===============

The platform provides several events that are triggered at various points in the workflow lifecycle. These events allow developers to hook into the workflow execution process and execute custom logic at specific points in the workflow. This is particularly useful for adding additional business logic, sending notifications, or updating external systems based on workflow activity. Special guard events can be used to prevent the transition from being executed or displayed.

Available Events
----------------

When a transition is initiated, the events are dispatched in the following order:

oro_workflow.pre_announce
^^^^^^^^^^^^^^^^^^^^^^^^^

Validate whether the transition button is allowed (triggered before pre-condition checks).
This is a guard event.

The three events being dispatched are:

- oro_workflow.pre_announce
- oro_workflow.[workflow name].pre_announce
- oro_workflow.[workflow name].pre_announce.[transition name]

oro_workflow.announce
^^^^^^^^^^^^^^^^^^^^^

Validate whether the transition button is allowed (triggered after pre-condition checks).
This is a guard event.

The three events being dispatched are:

- oro_workflow.announce
- oro_workflow.[workflow name].announce
- oro_workflow.[workflow name].announce.[transition name]

oro_workflow.pre_guard
^^^^^^^^^^^^^^^^^^^^^^

Validate whether the transition is allowed (triggered before condition checks).
This is a guard event.

The three events being dispatched are:

- oro_workflow.pre_guard
- oro_workflow.[workflow name].pre_guard
- oro_workflow.[workflow name].pre_guard.[transition name]

oro_workflow.guard
^^^^^^^^^^^^^^^^^^

Validate whether the transition is allowed (triggered after condition checks).
This is a guard event.

The three events being dispatched are:

- oro_workflow.guard
- oro_workflow.[workflow name].guard
- oro_workflow.[workflow name].guard.[transition name]

oro_workflow.leave
^^^^^^^^^^^^^^^^^^

Workflow is leaving some step (triggered for already started workflows).

The three events being dispatched are:

- oro_workflow.leave
- oro_workflow.[workflow name].leave
- oro_workflow.[workflow name].leave.[previous step name]

oro_workflow.start
^^^^^^^^^^^^^^^^^^

Workflow is starting and entering the start step (*oro_workflow.leave* will not be triggered).

The two events being dispatched are:

- oro_workflow.start
- oro_workflow.[workflow name].start

oro_workflow.enter
^^^^^^^^^^^^^^^^^^

This event is triggered right before the entity is entering the new step.

The three events being dispatched are:

- oro_workflow.enter
- oro_workflow.[workflow name].enter
- oro_workflow.[workflow name].enter.[new step name]

oro_workflow.entered
^^^^^^^^^^^^^^^^^^^^

This event is triggered right after the entity is entered the new step.

The three events being dispatched are:

- oro_workflow.entered
- oro_workflow.[workflow name].entered
- oro_workflow.[workflow name].entered.[new step name]

oro_workflow.transition
^^^^^^^^^^^^^^^^^^^^^^^

Transition logic is starting execution (triggered right before the execution of transition actions).

The three events being dispatched are:

- oro_workflow.transition
- oro_workflow.[workflow name].transition
- oro_workflow.[workflow name].transition.[transition name]

oro_workflow.completed
^^^^^^^^^^^^^^^^^^^^^^

Transition logic is being executed (triggered right after execution of transition actions).

The three events being dispatched are:

- oro_workflow.completed
- oro_workflow.[workflow name].completed
- oro_workflow.[workflow name].completed.[transition name]

oro_workflow.finish
^^^^^^^^^^^^^^^^^^^

Transition logic is being executed (triggered right after execution of transition actions).

The two events being dispatched are:

- oro_workflow.finish
- oro_workflow.[workflow name].finish


Workflow Event Listener Example
-------------------------------

Here is an example of how to enable logging every time an "opportunity_flow" workflow leaves a step:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\EventListener;

    use Psr\Log\LoggerInterface;
    use Oro\Bundle\WorkflowBundle\Event\Transition\TransitionEvent;

    class OpportunityFlowLoggingEventListener
    {
        public function __construct(
            private LoggerInterface $logger
        ) {
        }

        public function onLeave(TransitionEvent $event): void
        {
            $workflowItem = $event->getWorkflowItem();
            $transition = $event->getTransition();
            $entity = $workflowItem->getEntity();

            $this->logger->alert(sprintf(
                'Opportunity (id: "%d") performed transition "%s" from "%s" to "%s"',
                $entity->getId(),
                $transition->getName(),
                $workflowItem->getCurrentStep()->getName(),
                $transition->getResolvedStepTo($workflowItem)->getName()
            ));
        }
    }


.. code-block:: yaml


    services:
        # ...
        acme.demo.event_listener.opportunity_flow_logging_event_listener:
            class: Acme\Bundle\DemoBundle\EventListener\OpportunityFlowLoggingEventListener:
            arguments:
                - '@logger'
            tags:
                - { name: kernel.event_listener, event: oro_workflow.opportunity_flow.leave, method: onLeave }


Guard Events
------------

There are 4 events that may be used to disable transition: ``oro_workflow.pre_announce``, ``oro_workflow.announce``, ``oro_workflow.pre_guard`` and ``oro_workflow.guard``. *Announce* events may be used to hide the transition button when *guard* events are used to prevent transition execution.

.. note:: Please note that precondition checks (and announce events) are performed before transition button rendering and during condition checks before execution, so disabling transition availability in the announce event listener will also disable transition execution.

Let's review an example of the "Close As Won" transition being blocked when the Budget Amount is less than 100.

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\EventListener;

    use Oro\Bundle\WorkflowBundle\Event\Transition\GuardEvent;

    class OpportunityFlowBudgetEventListener
    {
        public function onPreAnnounce(GuardEvent $event): void
        {
            // Do nothing if the execution was already disabled
            if (!$event->isAllowed()) {
                return;
            }

            $opportunity = $event->getWorkflowItem()->getEntity();
            $event->setAllowed($opportunity->getBudgetAmount()->getValue() > 100.0);
        }
    }


.. code-block:: yaml


    services:
        # ...
        acme.demo.event_listener.opportunity_flow_budget_event_listener:
            class: Acme\Bundle\DemoBundle\EventListener\OpportunityFlowBudgetEventListener:
            tags:
                - { name: kernel.event_listener, event: oro_workflow.opportunity_flow.pre_announce.close_won, method: onPreAnnounce }


Disabling Events
----------------

Oro Workflows triggers a lot of events and allows to hook into the transition execution process at many stages. Such flexibility can be resource-consuming. If you are sure that some events are not used in the system, there is a possibility to disable event triggering by event name. To do this, add ``disableEvent`` with the event name as an argument to the ``oro_workflow.event_dispatcher`` service.

.. code-block:: yaml


    services:
        acme.demo.oro_workflow.event_dispatcher:
            decorates: oro_workflow.event_dispatcher
            calls:
                - ['disableEvent', ['announce']]


.. note:: Be careful when disabling events, for example, ACL checks and checkout workflow states are event-based.

Extending Workflow Configuration
--------------------------------

Sometimes, it's necessary to change the workflow configuration itself. This can be done using Workflow Definition Builder extensions. These extensions are called during the configuration-building process when loading workflow definitions. To create a new extension service, it must implement the ``WorkflowDefinitionBuilderExtensionInterface`` and be tagged with the ``oro.workflow.definition_builder.extension`` tag.

Let's create an example where a new attribute is added to the workflow and used at the transition form.

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Workflow;

    use Oro\Bundle\WorkflowBundle\Configuration\WorkflowDefinitionBuilderExtensionInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;

    /**
     * Add call_rating to phone_call workflow attributes and end_conversation transition form
     * if is_collaboration_workflow is enabled.
     */
    class PhoneCallConfigBuilderExtension implements WorkflowDefinitionBuilderExtensionInterface
    {
        public function prepare($workflowName, array $configuration)
        {
            if ($workflowName !== 'phone_call') {
                return $configuration;
            }
            if (empty($configuration['metadata']['is_collaboration_workflow'])) {
                return $configuration;
            }
            if (empty($configuration['transitions']['end_conversation'])) {
                return $configuration;
            }

            if (empty($configuration['attributes']['call_rating'])) {
                $configuration['attributes']['call_rating'] = [
                    'type' => 'string',
                    'label' => 'oro.workflow.phone_call.attribute.call_rating.label'
                ];
            }

            $configuration['transitions']['end_conversation']['form_options']['attribute_fields']['call_rating'] = [
                'form_type' => TextType::class,
                'label' => 'oro.workflow.checkout.state_token.attribute_label'
            ];

            return $configuration;
        }
    }


.. code-block:: yaml


    services:
        # ...
        acme.demo.workflow.phone_call_config_builder_extension:
            class: Acme\Bundle\DemoBundle\Workflow\PhoneCallConfigBuilderExtension
        tags:
            - { name: oro.workflow.definition_builder.extension }


.. note:: The extension will change the configuration during the execution of the ``oro:workflow:definitions:load`` command. Do not forget to run this command when developing configuration extensions.
