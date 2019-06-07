<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
use Oro\Bundle\PaymentBundle\Entity\PaymentTransaction;
use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;

/**
 * Payment method class that describes main business logic of Collect on delivery payment method
 * It creates invoice payment transaction
 */
class CollectOnDelivery implements PaymentMethodInterface
{
    /**
     * @var CollectOnDeliveryConfigInterface
     */
    private $config;

    /**
     * @param CollectOnDeliveryConfigInterface $config
     */
    public function __construct(CollectOnDeliveryConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($action, PaymentTransaction $paymentTransaction)
    {
        $paymentTransaction->setAction(PaymentMethodInterface::INVOICE);
        $paymentTransaction->setActive(true);
        $paymentTransaction->setSuccessful(true);

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->config->getPaymentMethodIdentifier();
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable(PaymentContextInterface $context)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($actionName)
    {
        return $actionName === self::PURCHASE;
    }
}
