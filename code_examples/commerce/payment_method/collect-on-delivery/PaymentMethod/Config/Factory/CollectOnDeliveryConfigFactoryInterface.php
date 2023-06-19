<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

use Acme\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

/**
 * Interface for Collect on delivery payment method config factory
 * Creates instances of CollectOnDeliverySettings with configuration for payment method
 */
interface CollectOnDeliveryConfigFactoryInterface
{
    /**
     * @param CollectOnDeliverySettings $settings
     * @return CollectOnDeliveryConfigInterface
     */
    public function create(CollectOnDeliverySettings $settings);
}
