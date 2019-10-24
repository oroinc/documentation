<?php

namespace ACME\Bundle\CopyrightBundle\Tests\Unit\ContentWidget;

use ACME\Bundle\CopyrightBundle\ContentWidget\CopyrightContentWidgetType;
use ACME\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType as FormType;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Symfony\Component\Form\Forms;
use Twig\Environment;

class CopyrightContentWidgetTypeTest extends \PHPUnit\Framework\TestCase
{
    /** @var CopyrightContentWidgetType */
    private $contentWidgetType;

    protected function setUp(): void
    {
        $this->contentWidgetType = new CopyrightContentWidgetType();
    }

    public function testGetName(): void
    {
        $this->assertEquals('copyright', $this->contentWidgetType::getName());
    }

    public function testGetLabel(): void
    {
        $this->assertEquals('acme.copyright.content_widget.copyright.label', $this->contentWidgetType->getLabel());
    }

    public function testIsInline(): void
    {
        $this->assertFalse($this->contentWidgetType->isInline());
    }

    public function testGetWidgetData(): void
    {
        $this->assertEquals([], $this->contentWidgetType->getWidgetData(new ContentWidget()));
    }

    public function testGetSettingsForm(): void
    {
        $form = $this->contentWidgetType->getSettingsForm(new ContentWidget(), Forms::createFormFactory());

        $this->assertEquals('copyright_content_widget', $form->getName());
        $this->assertInstanceOf(FormType::class, $form->getConfig()->getType()->getInnerType());
    }

    public function testGetBackOfficeViewSubBlocks(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig->expects($this->once())
            ->method('render')
            ->with('@ACMECopyright/CopyrightContentWidget/view.html.twig', ['settings' => []])
            ->willReturn('rendered template');

        $this->assertEquals(
            [
                [
                    'title' => 'oro.cms.contentwidget.sections.additional_information.label',
                    'subblocks' => [['data' => ['rendered template']]]
                ]
            ],
            $this->contentWidgetType->getBackOfficeViewSubBlocks(new ContentWidget(), $twig)
        );
    }
}
