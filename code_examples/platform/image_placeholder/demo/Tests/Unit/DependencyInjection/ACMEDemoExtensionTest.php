<?php

namespace Oro\Bundle\SEOBundle\Tests\Unit\DependencyInjection;

use ACME\Bundle\DemoBundle\DependencyInjection\ACMEDemoExtension;
use Oro\Bundle\TestFrameworkBundle\Test\DependencyInjection\ExtensionTestCase;

class ACMEDemoExtensionTest extends ExtensionTestCase
{
    public function testLoad()
    {
        $this->loadExtension(new ACMEDemoExtension());
        $expectedDefinitions = [
            // Services
            'acme_demo.provider.demo_image_placeholder.config',
            'acme_demo.provider.demo_image_placeholder.theme',
            'acme_demo.provider.demo_image_placeholder.default',
        ];

        $this->assertDefinitionsLoaded($expectedDefinitions);
    }
}
