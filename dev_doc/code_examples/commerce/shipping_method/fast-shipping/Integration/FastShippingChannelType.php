<?php

namespace ACME\Bundle\FastShippingBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

/**
 * Integration channel type for Fast Shipping integration
 */
class FastShippingChannelType implements ChannelInterface, IconAwareIntegrationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getLabel(): string
    {
        return 'acme.fast_shipping.channel_type.label';
    }

    /**
     * {@inheritDoc}
     */
    public function getIcon(): string
    {
        return 'bundles/acmefastshipping/img/fast-shipping-logo.png';
    }
}
