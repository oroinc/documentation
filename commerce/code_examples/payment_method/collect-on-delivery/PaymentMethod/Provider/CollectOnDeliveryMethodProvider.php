<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Provider;

use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider\CollectOnDeliveryConfigProviderInterface;
use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory\CollectOnDeliveryPaymentMethodFactoryInterface;
use Oro\Bundle\PaymentBundle\Method\Provider\AbstractPaymentMethodProvider;

/**
 * Provider for retrieving configured payment method instances
 */
class CollectOnDeliveryMethodProvider extends AbstractPaymentMethodProvider
{
    /**
     * @var CollectOnDeliveryPaymentMethodFactoryInterface
     */
    protected $factory;

    /**
     * @var CollectOnDeliveryConfigProviderInterface
     */
    private $configProvider;

    /**
     * @param CollectOnDeliveryConfigProviderInterface $configProvider
     * @param CollectOnDeliveryPaymentMethodFactoryInterface $factory
     */
    public function __construct(
        CollectOnDeliveryConfigProviderInterface $configProvider,
        CollectOnDeliveryPaymentMethodFactoryInterface $factory
    ) {
        parent::__construct();

        $this->configProvider = $configProvider;
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    protected function collectMethods()
    {
        $configs = $this->configProvider->getPaymentConfigs();
        foreach ($configs as $config) {
            $this->addCollectOnDeliveryMethod($config);
        }
    }

    /**
     * @param CollectOnDeliveryConfigInterface $config
     */
    protected function addCollectOnDeliveryMethod(CollectOnDeliveryConfigInterface $config)
    {
        $this->addMethod(
            $config->getPaymentMethodIdentifier(),
            $this->factory->create($config)
        );
    }
}
