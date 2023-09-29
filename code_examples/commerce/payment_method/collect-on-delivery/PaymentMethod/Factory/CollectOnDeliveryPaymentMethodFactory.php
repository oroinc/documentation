<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\CollectOnDelivery;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

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
