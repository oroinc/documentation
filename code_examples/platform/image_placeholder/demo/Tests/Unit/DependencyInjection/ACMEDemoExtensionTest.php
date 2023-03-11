<?php

namespace Oro\Bundle\SEOBundle\Tests\Unit\DependencyInjection;

use ACME\Bundle\DemoBundle\DependencyInjection\ACMEDemoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ACMEDemoExtensionTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad(): void
    {
        $container = new ContainerBuilder();

        $extension = new ACMEDemoExtension();
        $extension->load([], $container);

        self::assertNotEmpty($container->getDefinitions());
    }
}
