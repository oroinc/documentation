<?php

namespace ACME\Bundle\WysiwygValidationBundle;

use Oro\Bundle\CMSBundle\DependencyInjection\OroCMSExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The WysiwygValidationBundle bundle class.
 */
class ACMEWysiwygValidationBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        /** @var OroCMSExtension $extension */
        $extension = $container->getExtension('oro_cms');
        $extension->addContentRestrictionMode('content_restrictions_additional');
        $extension->addContentRestrictionMode('content_restrictions_extra');
    }
}
