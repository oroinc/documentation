<?php

namespace ACME\Bundle\DemoBundle\Tests\Unit;

use ACME\Bundle\DemoBundle\ACMEDemoBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ACMEDemoBundleTest extends \PHPUnit\Framework\TestCase
{
    public function testBuild()
    {
        $container = $this->createMock(ContainerBuilder::class);
        $bundle = new ACMEDemoBundle();

        $container
            ->expects($this->atLeastOnce())
            ->method('addCompilerPass')
        ;

        $bundle->build($container);
    }
}
