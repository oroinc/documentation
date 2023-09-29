<?php

namespace Acme\Bundle\CopyrightBundle\Tests\Unit\ContentWidget;

use Acme\Bundle\CopyrightBundle\ContentWidget\CopyrightContentWidgetType;
use Acme\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType as FormType;
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
        $this->assertTrue($this->contentWidgetType->isInline());
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
            ->with('@AcmeCopyright/CopyrightContentWidget/view.html.twig', ['settings' => []])
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

    public function testGetDefaultTemplate(): void
    {
        $contentWidget = new ContentWidget();
        $contentWidget->setSettings(['param' => 'value']);

        $twig = $this->createMock(Environment::class);
        $twig->expects($this->once())
            ->method('render')
            ->with('@AcmeCopyright/CopyrightContentWidget/widget.html.twig', $contentWidget->getSettings())
            ->willReturn('rendered template');

        $this->assertEquals('rendered template', $this->contentWidgetType->getDefaultTemplate($contentWidget, $twig));
    }
}
