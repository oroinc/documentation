<?php

namespace Acme\Bundle\CopyrightBundle\Tests\Unit\DependencyInjection;

use Acme\Bundle\CopyrightBundle\DependencyInjection\AcmeCopyrightExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeCopyrightExtensionTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad(): void
    {
        $container = new ContainerBuilder();

        $extension = new ACMECopyrightExtension();
        $extension->load([], $container);

        self::assertNotEmpty($container->getDefinitions());
    }
}
