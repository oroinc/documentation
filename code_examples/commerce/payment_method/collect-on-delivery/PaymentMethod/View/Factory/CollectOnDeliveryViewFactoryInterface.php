<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;

/**
 * Factory for creating views of Collect on delivery payment method
 */
interface CollectOnDeliveryViewFactoryInterface
{
    /**
     * @param CollectOnDeliveryConfigInterface $config
     * @return PaymentMethodViewInterface
     */
    public function create(CollectOnDeliveryConfigInterface $config);
}
