<?php

namespace ACME\Bundle\CopyrightBundle\Tests\Unit\DependencyInjection;

use ACME\Bundle\CopyrightBundle\DependencyInjection\ACMECopyrightExtension;
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
                'ACME\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType',
                'ACME\Bundle\CopyrightBundle\ContentWidget\CopyrightContentWidgetType',
            ]
        );
    }
}
