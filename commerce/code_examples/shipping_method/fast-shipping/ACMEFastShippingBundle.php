<?php

namespace ACME\Bundle\FastShippingBundle;

use ACME\Bundle\FastShippingBundle\DependencyInjection\FastShippingExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The FastShipping bundle class.
 */
class ACMEFastShippingBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        if (!$this->extension) {
            $this->extension = new FastShippingExtension();
        }

        return $this->extension;
    }
}
