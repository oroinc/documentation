<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\CollectOnDeliveryView;

/**
 * Factory for creating views of Collect on delivery payment method
 */
class CollectOnDeliveryViewFactory implements CollectOnDeliveryViewFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(CollectOnDeliveryConfigInterface $config)
    {
        return new CollectOnDeliveryView($config);
    }
}
