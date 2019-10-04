<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

/**
 * Interface for config provider which allows to get configs based on payment method identifier
 */
interface CollectOnDeliveryConfigProviderInterface
{
    /**
     * @return CollectOnDeliveryConfigInterface[]
     */
    public function getPaymentConfigs();

    /**
     * @param string $identifier
     * @return CollectOnDeliveryConfigInterface|null
     */
    public function getPaymentConfig($identifier);

    /**
     * @param string $identifier
     * @return bool
     */
    public function hasPaymentConfig($identifier);
}
