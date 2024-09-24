<?php

namespace Acme\Bundle\CopyrightBundle\ContentWidget;

use Acme\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType as FormType;
use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

/**
 * Type for the copyright widgets.
 */
class CopyrightContentWidgetType extends AbstractContentWidgetType
{
    #[\Override]
    public static function getName(): string
    {
        return 'copyright';
    }

    #[\Override]
    public function getLabel(): string
    {
        return 'acme.copyright.content_widget.copyright.label';
    }

    #[\Override]
    protected function getAdditionalInformationBlock(ContentWidget $contentWidget, Environment $twig): string
    {
        return $twig->render(
            '@AcmeCopyright/CopyrightContentWidget/view.html.twig',
            ['settings' => $contentWidget->getSettings()]
        );
    }

    #[\Override]
    public function getSettingsForm(ContentWidget $contentWidget, FormFactoryInterface $formFactory): ?FormInterface
    {
        return $formFactory->create(FormType::class);
    }

    #[\Override]
    public function getDefaultTemplate(ContentWidget $contentWidget, Environment $twig): string
    {
        return $twig->render('@AcmeCopyright/CopyrightContentWidget/widget.html.twig', $contentWidget->getSettings());
    }

    #[\Override]
    public function isInline(): bool
    {
        return true;
    }
}
