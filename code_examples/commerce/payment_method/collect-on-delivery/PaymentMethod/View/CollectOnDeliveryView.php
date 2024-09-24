<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;

/**
 * View for Collect on delivery payment method
 */
class CollectOnDeliveryView implements PaymentMethodViewInterface
{
    /**
     * @var CollectOnDeliveryConfigInterface
     */
    protected $config;

    public function __construct(CollectOnDeliveryConfigInterface $config)
    {
        $this->config = $config;
    }

    #[\Override]
    public function getOptions(PaymentContextInterface $context)
    {
        return [];
    }

    #[\Override]
    public function getBlock()
    {
        return '_payment_methods_collect_on_delivery_widget';
    }

    #[\Override]
    public function getLabel()
    {
        return $this->config->getLabel();
    }

    #[\Override]
    public function getShortLabel()
    {
        return $this->config->getShortLabel();
    }

    #[\Override]
    public function getAdminLabel()
    {
        return $this->config->getAdminLabel();
    }


    #[\Override]
    public function getPaymentMethodIdentifier()
    {
        return $this->config->getPaymentMethodIdentifier();
    }
}
