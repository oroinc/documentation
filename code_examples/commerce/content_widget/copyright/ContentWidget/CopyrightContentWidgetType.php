<?php

namespace ACME\Bundle\CopyrightBundle\ContentWidget;

use ACME\Bundle\CopyrightBundle\Form\Type\CopyrightContentWidgetType as FormType;
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
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'copyright';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return 'acme.copyright.content_widget.copyright.label';
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalInformationBlock(ContentWidget $contentWidget, Environment $twig): string
    {
        return $twig->render(
            '@ACMECopyright/CopyrightContentWidget/view.html.twig',
            ['settings' => $contentWidget->getSettings()]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsForm(ContentWidget $contentWidget, FormFactoryInterface $formFactory): ?FormInterface
    {
        return $formFactory->create(FormType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultTemplate(ContentWidget $contentWidget, Environment $twig): string
    {
        return $twig->render('@ACMECopyright/CopyrightContentWidget/widget.html.twig', $contentWidget->getSettings());
    }

    /**
     * {@inheritdoc}
     */
    public function isInline(): bool
    {
        return true;
    }
}
