<?php

namespace ACME\Bundle\CopyrightBundle\Tests\Unit\DependencyInjection;

use ACME\Bundle\CopyrightBundle\ContentWidget\CopyrightContentWidgetType as CopyrightFormType;
use ACME\Bundle\CopyrightBundle\DependencyInjection\ACMECopyrightExtension;
use ACME\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType as CopyrightWidgetType;
use Oro\Bundle\TestFrameworkBundle\Test\DependencyInjection\ExtensionTestCase;

class ACMECopyrightExtensionTest extends ExtensionTestCase
{
    /** @var ACMECopyrightExtension */
    private $extension;

    protected function setUp(): void
    {
        $this->extension = new ACMECopyrightExtension();
    }

    public function testLoad(): void
    {
        $this->loadExtension($this->extension);

        $this->assertDefinitionsLoaded(
            [
                CopyrightFormType::class,
                CopyrightWidgetType::class,
            ]
        );
    }
}
