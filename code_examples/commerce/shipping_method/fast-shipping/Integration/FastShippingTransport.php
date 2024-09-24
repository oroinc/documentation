<?php

namespace Acme\Bundle\FastShippingBundle\Integration;

use Acme\Bundle\FastShippingBundle\Entity\FastShippingSettings;
use Acme\Bundle\FastShippingBundle\Form\Type\FastShippingTransportSettingsType;
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

    #[\Override]
    public function init(Transport $transportEntity)
    {
        $this->settings = $transportEntity->getSettingsBag();
    }

    #[\Override]
    public function getSettingsFormType(): string
    {
        return FastShippingTransportSettingsType::class;
    }

    #[\Override]
    public function getSettingsEntityFQCN(): string
    {
        return FastShippingSettings::class;
    }

    #[\Override]
    public function getLabel(): string
    {
        return 'acme.fast_shipping.transport.label';
    }
}
