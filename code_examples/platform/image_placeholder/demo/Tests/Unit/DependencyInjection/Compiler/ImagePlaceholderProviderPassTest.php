<?php

namespace Oro\Bundle\SEOBundle\Tests\Unit\DependencyInjection\Compiler;

use ACME\Bundle\DemoBundle\DependencyInjection\Compiler\ImagePlaceholderProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ImagePlaceholderProviderPassTest extends \PHPUnit\Framework\TestCase
{
    public const CHAIN_PROVIDER_NAME = 'oro_product.provider.product_image_placeholder';

    /**
     * @var ContainerBuilder|\PHPUnit\Framework\MockObject\MockObject
     */
    private $containerBuilder;

    /**
     * @var \Symfony\Component\DependencyInjection\Definition
     */
    private $chainProvider;

    /**
     * @var ImagePlaceholderProviderPass
     */
    private $compilerPass;

    protected function setUp()
    {
        $this->containerBuilder = new ContainerBuilder();
        $this->chainProvider = $this->containerBuilder->register(self::CHAIN_PROVIDER_NAME);
        $this->compilerPass = new ImagePlaceholderProviderPass();
    }

    public function testProcess()
    {
        $this->compilerPass->process($this->containerBuilder);
        $this->assertEquals(
            [
                ['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.config')]],
                ['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.theme')]],
                ['addProvider', [new Reference('acme_demo.provider.demo_image_placeholder.default')]],
            ],
            $this->chainProvider->getMethodCalls()
        );
    }

    public function testProcessIfNoChainProviderDefinition()
    {
        $this->containerBuilder->removeDefinition(self::CHAIN_PROVIDER_NAME);
        $this->compilerPass->process($this->containerBuilder);
        $this->assertEmpty($this->chainProvider->getMethodCalls());
    }
}
