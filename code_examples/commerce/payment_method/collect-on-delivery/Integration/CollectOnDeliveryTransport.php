<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\Integration;

use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use ACME\Bundle\CollectOnDeliveryBundle\Form\Type\CollectOnDeliverySettingsType;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

/**
 * Transport for Collect on delivery payment integration
 */
class CollectOnDeliveryTransport implements TransportInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(Transport $transportEntity)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'acme.collect_on_delivery.settings.transport.label';
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsFormType()
    {
        return CollectOnDeliverySettingsType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsEntityFQCN()
    {
        return CollectOnDeliverySettings::class;
    }
}
