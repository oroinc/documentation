<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Provider;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider\CollectOnDeliveryConfigProviderInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory\CollectOnDeliveryPaymentMethodFactoryInterface;
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

    public function __construct(
        CollectOnDeliveryConfigProviderInterface $configProvider,
        CollectOnDeliveryPaymentMethodFactoryInterface $factory
    ) {
        parent::__construct();

        $this->configProvider = $configProvider;
        $this->factory = $factory;
    }

    #[\Override]
    protected function collectMethods()
    {
        $configs = $this->configProvider->getPaymentConfigs();
        foreach ($configs as $config) {
            $this->addCollectOnDeliveryMethod($config);
        }
    }

    protected function addCollectOnDeliveryMethod(CollectOnDeliveryConfigInterface $config)
    {
        $this->addMethod(
            $config->getPaymentMethodIdentifier(),
            $this->factory->create($config)
        );
    }
}
