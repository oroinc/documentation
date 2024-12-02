<?php

namespace Acme\Bundle\DemoBundle\Workflow\EventListener;

use Oro\Component\Action\Event\ExtendableActionEvent;

/**
 * Transfer external_po_number from checkout to order on checkout finish.
 */
class FinishCheckoutEventListener
{
    public function onFinishCheckout(ExtendableActionEvent $event): void
    {
        $data = $event->getData();
        if (!$data) {
            return;
        }

        $checkout = $data->offsetGet('checkout');
        $order = $data->offsetGet('order');

        $order->setExternalPoNumber($checkout->getExternalPoNumber());
    }
}
