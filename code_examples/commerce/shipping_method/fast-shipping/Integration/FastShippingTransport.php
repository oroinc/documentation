<?php

namespace ACME\Bundle\FastShippingBundle\Integration;

use ACME\Bundle\FastShippingBundle\Entity\FastShippingSettings;
use ACME\Bundle\FastShippingBundle\Form\Type\FastShippingTransportSettingsType;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Transport for Fast Shipping integration
 */
class FastShippingTransport implements TransportInterface
{
    /** @var ParameterBag */
    protected $settings;

    /**
     * @param Transport $transportEntity
     */
    public function init(Transport $transportEntity)
    {
        $this->settings = $transportEntity->getSettingsBag();
    }

    /**
     * {@inheritDoc}
     */
    public function getSettingsFormType(): string
    {
        return FastShippingTransportSettingsType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getSettingsEntityFQCN(): string
    {
        return FastShippingSettings::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel(): string
    {
        return 'acme.fast_shipping.transport.label';
    }
}
