<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\CollectOnDelivery;
use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

/**
 * Factory creates payment method instances based on configuration
 */
class CollectOnDeliveryPaymentMethodFactory implements CollectOnDeliveryPaymentMethodFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(CollectOnDeliveryConfigInterface $config)
    {
        return new CollectOnDelivery($config);
    }
}
