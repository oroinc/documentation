<?php

namespace Acme\Bundle\CMSBundle\Controller;

use Acme\Bundle\CMSBundle\Entity\Block;
use Acme\Bundle\CMSBundle\Form\Type\BlockType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Acme CMS Block controller
 */
class BlockController extends AbstractController
{
    #[Route(path: '/', name: 'acme_cms_block_index')]
    #[Template]
    #[AclAncestor('acme_cms_block_view')]
    public function indexAction(): array
    {
        return ['entity_class' => Block::class];
    }

    #[Route(path: '/view/{id}', name: 'acme_cms_block_view', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_cms_block_view', type: 'entity', class: 'Acme\Bundle\CMSBundle\Entity\Block', permission: 'VIEW')]
    public function viewAction(Block $block): array
    {
        return ['entity' => $block];
    }

    #[Route(path: '/create', name: 'acme_cms_block_create')]
    #[Template('@AcmeCMS/Block/update.html.twig')]
    #[Acl(id: 'acme_cms_block_create', type: 'entity', class: 'Acme\Bundle\CMSBundle\Entity\Block', permission: 'CREATE')]
    public function createAction(): array|RedirectResponse
    {
        $block = new Block();

        return $this->update($block);
    }

    #[Route(path: '/update/{id}', name: 'acme_cms_block_update', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_cms_block_update', type: 'entity', class: 'Acme\Bundle\CMSBundle\Entity\Block', permission: 'EDIT')]
    public function updateAction(Block $block): array|RedirectResponse
    {
        return $this->update($block);
    }

    protected function update(Block $block): array|RedirectResponse
    {

        return $this->container->get(UpdateHandlerFacade::class)->handleUpdate(
            $block,
            $this->createForm(BlockType::class, $block),
            $this->container->get(TranslatorInterface::class)->trans('acme.cms.controller.saved.message')
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                UpdateHandlerFacade::class,
                TranslatorInterface::class,
            ]
        );
    }
}
