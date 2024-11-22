<?php

namespace Acme\Bundle\DemoBundle\Workflow\EventListener;

use Oro\Bundle\CheckoutBundle\DataProvider\Manager\CheckoutLineItemsManager;
use Oro\Bundle\CheckoutBundle\Entity\Checkout;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\CustomerBundle\Provider\CustomerUserRelationsProvider;
use Oro\Bundle\OrderBundle\Entity\Order;
use Oro\Bundle\PricingBundle\SubtotalProcessor\TotalProcessorProvider;
use Oro\Bundle\WorkflowBundle\Event\Transition\PreAnnounceEvent;

/**
 * Disallow order placement for guests if total is less than 100 USD
 */
class DisallowCheapOrdersForGuestsEventListener
{
    private const TOTAL_LIMIT = 100.0;

    public function __construct(
        private CustomerUserRelationsProvider $customerUserRelationsProvider,
        private ConfigManager $configManager,
        private TotalProcessorProvider $totalsProvider,
        private CheckoutLineItemsManager $checkoutLineItemsManager
    ) {
    }

    public function onPreAnnounce(PreAnnounceEvent $event): void
    {
        // Nothing to do, already denied
        if (!$event->isAllowed()) {
            return;
        }

        $workflowItem = $event->getWorkflowItem();
        /** @var Checkout $checkout */
        $checkout = $workflowItem->getEntity();
        if (!$checkout instanceof Checkout) {
            return;
        }

        // Do not apply the limit for non-anonymous customer group
        $customerUserGroup = $this->customerUserRelationsProvider->getCustomerGroup($checkout->getCustomerUser());
        if ($customerUserGroup?->getId() != $this->configManager->get('oro_customer.anonymous_customer_group')) {
            return;
        }

        if ($checkout->getCurrency() !== 'USD') {
            return;
        }

        if ($this->getOrderTotalForCheckout($checkout) < self::TOTAL_LIMIT) {
            $event->getErrors()?->add([
                'message' => 'Cannot proceed to checkout because total amount is less than 100 USD'
            ]);

            $event->setAllowed(false);
        }
    }

    private function getOrderTotalForCheckout(Checkout $checkout): float
    {
        $orderLineItems = $this->checkoutLineItemsManager->getData($checkout);
        $order = new Order();
        $order->setLineItems($orderLineItems);

        return $this->totalsProvider->enableRecalculation()->getTotal($order)->getAmount();
    }
}
