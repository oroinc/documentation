<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

use Acme\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Acme\Bundle\CollectOnDeliveryBundle\Entity\Repository\CollectOnDeliverySettingsRepository;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Acme\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory\CollectOnDeliveryConfigFactoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * Allows to get configs of Collect on delivery payment method
 */
class CollectOnDeliveryConfigProvider implements CollectOnDeliveryConfigProviderInterface
{
    /**
     * @var ManagerRegistry
     */
    protected $doctrine;

    /**
     * @var CollectOnDeliveryConfigFactoryInterface
     */
    protected $configFactory;

    /**
     * @var CollectOnDeliveryConfigInterface[]
     */
    protected $configs;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        ManagerRegistry $doctrine,
        LoggerInterface $logger,
        CollectOnDeliveryConfigFactoryInterface $configFactory
    ) {
        $this->doctrine = $doctrine;
        $this->logger = $logger;
        $this->configFactory = $configFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentConfigs()
    {
        $configs = [];

        $settings = $this->getEnabledIntegrationSettings();

        foreach ($settings as $setting) {
            $config = $this->configFactory->create($setting);

            $configs[$config->getPaymentMethodIdentifier()] = $config;
        }

        return $configs;
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentConfig($identifier)
    {
        $paymentConfigs = $this->getPaymentConfigs();

        if ([] === $paymentConfigs || false === array_key_exists($identifier, $paymentConfigs)) {
            return null;
        }

        return $paymentConfigs[$identifier];
    }

    /**
     * {@inheritDoc}
     */
    public function hasPaymentConfig($identifier)
    {
        return null !== $this->getPaymentConfig($identifier);
    }

    /**
     * @return CollectOnDeliverySettings[]
     */
    protected function getEnabledIntegrationSettings()
    {
        try {
            /** @var CollectOnDeliverySettingsRepository $repository */
            $repository = $this->doctrine
                ->getManagerForClass(CollectOnDeliverySettings::class)
                ->getRepository(CollectOnDeliverySettings::class);

            return $repository->getEnabledSettings();
        } catch (\UnexpectedValueException $e) {
            $this->logger->critical($e->getMessage());

            return [];
        }
    }
}
