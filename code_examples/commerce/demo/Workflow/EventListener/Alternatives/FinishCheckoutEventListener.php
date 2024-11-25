<?php

namespace Acme\Bundle\DemoBundle\Workflow\EventListener\Alternatives;

use Oro\Bundle\WorkflowBundle\Model\WorkflowManager;
use Oro\Component\Action\Event\ExtendableActionEvent;

/**
 * Transfer external_po_number from WorkflowItem to order on checkout finish.
 */
class FinishCheckoutEventListener
{
    public function __construct(
        private WorkflowManager $workflowManager
    ) {
    }

    public function onFinishCheckout(ExtendableActionEvent $event): void
    {
        $data = $event->getData();
        if (!$data) {
            return;
        }

        $checkout = $data->offsetGet('checkout');
        $order = $data->offsetGet('order');

        $workflowItem = $this->workflowManager->getWorkflowItem($checkout, 'acme_demo_checkout');
        $externalPoNumber = $workflowItem?->offsetGet('external_po_number');

        $order->setExternalPoNumber($externalPoNumber);
    }
}
