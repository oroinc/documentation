<?php

namespace Oro\Bundle\SEOBundle\Tests\Unit\DependencyInjection;

use Acme\Bundle\DemoBundle\DependencyInjection\AcmeDemoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeDemoExtensionTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad(): void
    {
        $container = new ContainerBuilder();

        $extension = new AcmeDemoExtension();
        $extension->load([], $container);

        self::assertNotEmpty($container->getDefinitions());
    }
}
