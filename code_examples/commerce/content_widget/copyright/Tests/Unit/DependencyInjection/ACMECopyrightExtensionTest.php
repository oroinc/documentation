<?php

namespace ACME\Bundle\CopyrightBundle\Tests\Unit\DependencyInjection;

use ACME\Bundle\CopyrightBundle\DependencyInjection\ACMECopyrightExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ACMECopyrightExtensionTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad(): void
    {
        $container = new ContainerBuilder();

        $extension = new ACMECopyrightExtension();
        $extension->load([], $container);

        self::assertNotEmpty($container->getDefinitions());
    }
}
