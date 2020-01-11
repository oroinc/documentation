<?php

namespace ACME\Bundle\CMSBundle\Controller;

use ACME\Bundle\CMSBundle\Entity\Block;
use ACME\Bundle\CMSBundle\Form\Type\BlockType;
use Oro\Bundle\FormBundle\Model\UpdateHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * ACME CMS Block controller
 */
class BlockController extends AbstractController
{
    /**
     * @Route("/", name="acme_cms_block_index")
     * @Template
     * @AclAncestor("acme_cms_block_view")
     *
     * @return array
     */
    public function indexAction()
    {
        return ['entity_class' => Block::class];
    }

    /**
     * @Route("/view/{id}", name="acme_cms_block_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_cms_block_view",
     *      type="entity",
     *      class="ACMECMSBundle:Block",
     *      permission="VIEW"
     * )
     * @param Block $block
     * @return array
     */
    public function viewAction(Block $block)
    {
        return ['entity' => $block];
    }

    /**
     * @Route("/create", name="acme_cms_block_create")
     * @Template("ACMECMSBundle:Block:update.html.twig")
     * @Acl(
     *      id="acme_cms_block_create",
     *      type="entity",
     *      class="ACMECMSBundle:Block",
     *      permission="CREATE"
     * )
     *
     * @return array|RedirectResponse
     */
    public function createAction()
    {
        $block = new Block();

        return $this->update($block);
    }

    /**
     * @Route("/update/{id}", name="acme_cms_block_update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_cms_block_update",
     *      type="entity",
     *      class="ACMECMSBundle:Block",
     *      permission="EDIT"
     * )
     * @param Block $block
     * @return array|RedirectResponse
     */
    public function updateAction(Block $block)
    {
        return $this->update($block);
    }

    /**
     * @param Block $block
     * @return array|RedirectResponse
     */
    protected function update(Block $block)
    {
        return $this->get(UpdateHandler::class)->handleUpdate(
            $block,
            $this->createForm(BlockType::class, $block),
            function (Block $block) {
                return [
                    'route' => 'acme_cms_block_update',
                    'parameters' => ['id' => $block->getId()]
                ];
            },
            function (Block $block) {
                return [
                    'route' => 'acme_cms_block_view',
                    'parameters' => ['id' => $block->getId()]
                ];
            },
            $this->get(TranslatorInterface::class)->trans('acme.cms.controller.saved.message')
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                UpdateHandler::class,
                TranslatorInterface::class,
            ]
        );
    }
}
