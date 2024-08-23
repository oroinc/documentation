.. _backend--workflows--transition-services:

Workflow Transition Services
============================

Workflow transitions are a critical part of the workflow engine. They define the movement between different steps within a workflow.

Transition Services allow developers to define transitions in PHP, allowing more complex logic and calculations than YAML. Transition Services provides improved maintainability and reusability. Transition logic written in PHP can be encapsulated in functions or classes, making it reusable across multiple transitions or workflows. Developers can take advantage of IDE features such as auto-completion, refactoring tools, and syntax checking, making it easier to write and maintain transition logic. PHP logic can be debugged using traditional debugging tools that allow step-by-step execution, breakpoints, and variable inspection. An important part of the development process is writing tests, which is simplified for Transition Services. PHP allows you to easily integrate with external services, APIs, or databases so that transitions can interact with other systems or retrieve external data. You can use object-oriented programming principles to organize logic into classes and objects, promoting cleaner and more modular code.

To create a transition service, implement the ``Oro\Bundle\WorkflowBundle\Model\TransitionServiceInterface`` in a PHP class. This class will define the logic for preconditions, conditions, and the execution of the transition.


.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Workflow\PhoneCall\Transition;

    use Doctrine\Common\Collections\Collection;
    use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
    use Oro\Bundle\WorkflowBundle\Model\TransitionServiceInterface;

    class ConnectedTransition implements TransitionServiceInterface
    {
        /**
         * Check if preconditions for the transition are met.
         */
        public function isPreConditionAllowed(WorkflowItem $workflowItem, Collection $errors = null): bool
        {
            // Implement custom precondition logic
            // Return true if preconditions are met, otherwise false
            return true;
        }

        /**
         * Check if conditions for the transition are met.
         */
        public function isConditionAllowed(WorkflowItem $workflowItem, Collection $errors = null): bool
        {
            // Implement custom condition logic
            // Return true if conditions are met, otherwise false
            return true;
        }

        /**
         * Execute the transition logic.
         */
        public function execute(WorkflowItem $workflowItem): void
        {
            // Implement custom execution logic
            // Perform actions related to the transition
        }
    }


To make Transition Service available in workflow it should be registered in DIC and tagged with ``oro_workflow.transition_service`` tag.


.. code-block:: yaml


    services:
        services:
            # ...
            acme.demo.workflow.transition.connected:
                class: Acme\Bundle\DemoBundle\Workflow\PhoneCall\Transition\ConnectedTransition
                tags:
                    - { name: 'oro_workflow.transition_service' }
