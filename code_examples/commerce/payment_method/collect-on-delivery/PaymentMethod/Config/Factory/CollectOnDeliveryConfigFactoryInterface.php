<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

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
