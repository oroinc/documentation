<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;

/**
 * Interface of factories which create payment method instances based on configuration
 */
interface CollectOnDeliveryPaymentMethodFactoryInterface
{
    /**
     * @param CollectOnDeliveryConfigInterface $config
     * @return PaymentMethodInterface
     */
    public function create(CollectOnDeliveryConfigInterface $config);
}
