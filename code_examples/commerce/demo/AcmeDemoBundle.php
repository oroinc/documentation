<?php

// AcmeDemoBundle.php

namespace Acme\Bundle\DemoBundle;

use Acme\Bundle\DemoBundle\DependencyInjection\Compiler\AcmeExtendValidationPass;
use Acme\Bundle\DemoBundle\DependencyInjection\Compiler\ImagePlaceholderProviderPass;
use Oro\Bundle\DataAuditBundle\Model\AuditFieldTypeRegistry;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeDemoBundle extends Bundle
{
    #[\Override]
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new ImagePlaceholderProviderPass());
        $container->addCompilerPass(new AcmeExtendValidationPass());
        /**
         * You can also use AuditFieldTypeRegistry::overrideType to replace existing type
         * But make sure you move old data into new columns
         */
        AuditFieldTypeRegistry::addType($doctrineType = 'datetimenew', $auditType = 'datetimenew');
    }
}
