<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Document;
use Acme\Bundle\DemoBundle\Form\Type\DocumentType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contains CRUD actions for Document
 *
 * @Route("/document", name="acme_demo_document_")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Template
     * @AclAncestor("acme_demo_document_view")
     */
    public function indexAction(): array
    {
        return [
            'entity_class' => Document::class
        ];
    }

    /**
     * @Route("/view/{id}", name="view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_demo_document_view",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Document",
     *      permission="VIEW"
     * )
     */
    public function viewAction(Document $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * Create Document
     *
     * @Route("/create", name="create", options={"expose"=true})
     * @Template("@AcmeDemo/Document/update.html.twig")
     * @Acl(
     *      id="acme_demo_document_create",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Document",
     *      permission="CREATE"
     * )
     */
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.document.saved.message'
        );

        return $this->update(new Document(), $request, $createMessage);
    }

    /**
     * Edit Document form
     *
     * @Route("/update/{id}", name="update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_demo_document_update",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Document",
     *      permission="EDIT"
     * )
     */
    public function updateAction(Document $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.document.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        Document $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->container->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(DocumentType::class, $entity),
            $message,
            $request,
            null
        );
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                TranslatorInterface::class,
                UpdateHandlerFacade::class,
            ]
        );
    }
}
