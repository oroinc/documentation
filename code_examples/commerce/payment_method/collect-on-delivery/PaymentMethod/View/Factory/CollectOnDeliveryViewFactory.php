<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\CollectOnDeliveryView;

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
