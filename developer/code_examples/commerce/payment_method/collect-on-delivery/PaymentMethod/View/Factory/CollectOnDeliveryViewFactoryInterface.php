<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
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
