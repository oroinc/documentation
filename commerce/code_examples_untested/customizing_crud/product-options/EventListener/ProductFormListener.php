<?php

namespace Oro\Bundle\BlogPostExampleBundle\EventListener;

use Oro\Bundle\BlogPostExampleBundle\Entity\ProductOptions;
use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\ProductBundle\Entity\Product;
use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Event listener that renders product options on "product view" and "product create/update" pages
 */
class ProductFormListener
{
    /** @var TranslatorInterface */
    protected $translator;

    /** @var DoctrineHelper */
    protected $doctrineHelper;

    /** @var RequestStack */
    protected $requestStack;

    /**
     * @param TranslatorInterface $translator
     * @param DoctrineHelper $doctrineHelper
     * @param RequestStack $requestStack
     */
    public function __construct(
        TranslatorInterface $translator,
        DoctrineHelper $doctrineHelper,
        RequestStack $requestStack
    ) {
        $this->translator = $translator;
        $this->doctrineHelper = $doctrineHelper;
        $this->requestStack = $requestStack;
    }

    /**
     * @param BeforeListRenderEvent $event
     */
    public function onProductView(BeforeListRenderEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return;
        }

        // Retrieving current Product Id from request
        $productId = (int)$request->get('id');
        if (!$productId) {
            return;
        }

        /** @var Product $product */
        $product = $this->doctrineHelper->getEntityReference(Product::class, $productId);
        if (!$product) {
            return;
        }

        /** @var ProductOptions $productOptions */
        $productOptions = $this->doctrineHelper
            ->getEntityRepository(ProductOptions::class)
            ->findOneBy(['product' => $product]);

        if (null === $productOptions) {
            return;
        }

        $template = $event->getEnvironment()->render(
            'OroBlogPostExampleBundle:Product:product_options_view.html.twig',
            [
                'entity' => $product,
                'productOptions' => $productOptions
            ]
        );
        $this->addBlock($event->getScrollData(), $template, 'oro.blogpostexample.product.section.product_options');
    }

    /**
     * @param BeforeListRenderEvent $event
     */
    public function onProductEdit(BeforeListRenderEvent $event)
    {
        $template = $event->getEnvironment()->render(
            'OroBlogPostExampleBundle:Product:product_options_update.html.twig',
            ['form' => $event->getFormView()]
        );
        $this->addBlock($event->getScrollData(), $template, 'oro.blogpostexample.product.section.product_options');
    }

    /**
     * @param ScrollData $scrollData
     * @param string $html
     * @param string $label
     * @param int $priority
     */
    protected function addBlock(ScrollData $scrollData, $html, $label, $priority = 100)
    {
        $blockLabel = $this->translator->trans($label);
        $blockId    = $scrollData->addBlock($blockLabel, $priority);
        $subBlockId = $scrollData->addSubBlock($blockId);
        $scrollData->addSubBlockData($blockId, $subBlockId, $html);
    }
}
