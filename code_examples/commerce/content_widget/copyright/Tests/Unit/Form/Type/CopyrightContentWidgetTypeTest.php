<?php

namespace Acme\Bundle\CopyrightBundle\Tests\Unit\Form\Type;

use Acme\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType;
use Oro\Component\Testing\Unit\FormIntegrationTestCase;

class CopyrightContentWidgetTypeTest extends FormIntegrationTestCase
{
    /** @var CopyrightContentWidgetType */
    private $formType;

    protected function setUp(): void
    {
        $this->formType = new CopyrightContentWidgetType();

        parent::setUp();
    }

    /**
     * @dataProvider submitDataProvider
     */
    public function testSubmit(?array $defaultData, ?array $submittedData, array $expectedData): void
    {
        $form = $this->factory->create(CopyrightContentWidgetType::class, $defaultData);

        $this->assertEquals($defaultData, $form->getData());
        $this->assertEquals($defaultData, $form->getViewData());

        $form->submit($submittedData);
        $this->assertTrue($form->isValid());
        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($expectedData, $form->getData());
    }

    public function submitDataProvider(): array
    {
        return [
            [
                'defaultData' => null,
                'submittedData' => null,
                'expectedData' => ['isShort' => false],
            ],
            [
                'defaultData' => [],
                'submittedData' => null,
                'expectedData' => ['isShort' => false],
            ],
            [
                'defaultData' => null,
                'submittedData' => [],
                'expectedData' => ['isShort' => false],
            ],
            [
                'defaultData' => [],
                'submittedData' => [],
                'expectedData' => ['isShort' => false],
            ],
            [
                'defaultData' => ['isShort' => true],
                'submittedData' => [],
                'expectedData' => ['isShort' => false],
            ],
            [
                'defaultData' => ['isShort' => false],
                'submittedData' => ['isShort' => true],
                'expectedData' => ['isShort' => true],
            ],
            [
                'defaultData' => ['isShort' => true],
                'submittedData' => ['isShort' => false],
                'expectedData' => ['isShort' => false],
            ],
        ];
    }
}
