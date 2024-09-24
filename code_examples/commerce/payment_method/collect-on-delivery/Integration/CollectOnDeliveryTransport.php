<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\Integration;

use Acme\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Acme\Bundle\CollectOnDeliveryBundle\Form\Type\CollectOnDeliverySettingsType;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

/**
 * Transport for Collect on delivery payment integration
 */
class CollectOnDeliveryTransport implements TransportInterface
{
    #[\Override]
    public function init(Transport $transportEntity)
    {
    }

    #[\Override]
    public function getLabel()
    {
        return 'acme.collect_on_delivery.settings.transport.label';
    }

    #[\Override]
    public function getSettingsFormType()
    {
        return CollectOnDeliverySettingsType::class;
    }

    #[\Override]
    public function getSettingsEntityFQCN()
    {
        return CollectOnDeliverySettings::class;
    }
}
