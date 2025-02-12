<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

/**
 * Integration channel type for Collect on delivery payment integration
 */
class CollectOnDeliveryChannelType implements ChannelInterface, IconAwareIntegrationInterface
{
    const TYPE = 'collect_on_delivery';

    #[\Override]
    public function getLabel()
    {
        return 'acme.collect_on_delivery.channel_type.label';
    }

    #[\Override]
    public function getIcon()
    {
        return 'bundles/oromoneyorder/img/money-order-icon.png';
    }
}
