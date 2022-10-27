<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config;

use Oro\Bundle\PaymentBundle\Method\Config\ParameterBag\AbstractParameterBagPaymentConfig;

/**
 * Configuration class which is used to get specific configuration for Collect on delivery payment method
 * Usually it has additional get methods for payment type specific configurations
 */
class CollectOnDeliveryConfig extends AbstractParameterBagPaymentConfig implements CollectOnDeliveryConfigInterface
{
}
