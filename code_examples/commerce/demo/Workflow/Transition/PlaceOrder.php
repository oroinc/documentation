<?php

namespace Acme\Bundle\DemoBundle\Workflow\Transition;

use Doctrine\Common\Collections\Collection;
use Oro\Bundle\ActionBundle\Model\ActionExecutor;
use Oro\Bundle\CheckoutBundle\Entity\Checkout;
use Oro\Bundle\WorkflowBundle\Entity\WorkflowItem;
use Oro\Bundle\WorkflowBundle\Model\TransitionServiceInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * PlaceOrder transition customization for Demo Checkout.
 */
class PlaceOrder implements TransitionServiceInterface
{
    public function __construct(
        private TransitionServiceInterface $baseTransition,
        private AuthorizationCheckerInterface $authorizationChecker,
        private ActionExecutor $actionExecutor
    ) {
    }

    public function isPreConditionAllowed(WorkflowItem $workflowItem, Collection $errors = null): bool
    {
        if ($workflowItem->getCurrentStep()?->getName() === 'manager_approval'
            && !$this->authorizationChecker->isGranted('acme_demo_checkout_approve')
        ) {
            $errors?->add(['message' => 'Pending approval']);

            return false;
        }

        return $this->baseTransition->isPreConditionAllowed($workflowItem, $errors);
    }

    public function isConditionAllowed(WorkflowItem $workflowItem, Collection $errors = null): bool
    {
        return $this->baseTransition->isConditionAllowed($workflowItem, $errors);
    }

    public function execute(WorkflowItem $workflowItem): void
    {
        /** @var Checkout $checkout */
        $checkout = $workflowItem->getEntity();
        // Do not execute place order transition logic if conditions are not met.
        if (str_starts_with($checkout->getExternalPoNumber(), 'EXT-')
            && !$this->authorizationChecker->isGranted('acme_demo_checkout_approve')
        ) {
            $this->actionExecutor->executeAction(
                'flash_message',
                [
                    'message' => 'This checkout requires manager approval.',
                    'type' => 'warning'
                ]
            );

            return;
        }

        $this->baseTransition->execute($workflowItem);
    }
}
