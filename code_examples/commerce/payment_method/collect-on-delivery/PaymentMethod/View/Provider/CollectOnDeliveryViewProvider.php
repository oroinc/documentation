<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Provider;

use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider\CollectOnDeliveryConfigProviderInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory\CollectOnDeliveryViewFactoryInterface;
use Oro\Bundle\PaymentBundle\Method\View\AbstractPaymentMethodViewProvider;

/**
 * Provider for retrieving payment method view instances
 */
class CollectOnDeliveryViewProvider extends AbstractPaymentMethodViewProvider
{
    /** @var CollectOnDeliveryViewFactoryInterface */
    private $factory;

    /** @var CollectOnDeliveryConfigProviderInterface */
    private $configProvider;

    public function __construct(
        CollectOnDeliveryConfigProviderInterface $configProvider,
        CollectOnDeliveryViewFactoryInterface $factory
    ) {
        $this->factory = $factory;
        $this->configProvider = $configProvider;

        parent::__construct();
    }

    #[\Override]
    protected function buildViews()
    {
        $configs = $this->configProvider->getPaymentConfigs();
        foreach ($configs as $config) {
            $this->addCollectOnDeliveryView($config);
        }
    }

    protected function addCollectOnDeliveryView(CollectOnDeliveryConfigInterface $config)
    {
        $this->addView(
            $config->getPaymentMethodIdentifier(),
            $this->factory->create($config)
        );
    }
}
