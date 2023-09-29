<?php

namespace Acme\Bundle\WysiwygValidationBundle;

use Oro\Bundle\CMSBundle\DependencyInjection\OroCMSExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeWysiwygValidationBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        /** @var OroCMSExtension $extension */
        $extension = $container->getExtension('oro_cms');
        $extension->addContentRestrictionMode('content_restrictions_additional');
        $extension->addContentRestrictionMode('content_restrictions_extra');
    }
}
