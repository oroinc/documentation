<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Priority;
use Acme\Bundle\DemoBundle\Form\Type\PriorityType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contains CRUD actions for Priority
 */
#[Route(path: '/priority', name: 'acme_demo_priority_')]
class PriorityController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    #[Template]
    #[AclAncestor('acme_demo_priority_view')]
    public function indexAction(): array
    {
        return [
            'entity_class' => Priority::class
        ];
    }

    #[Route(path: '/view/{id}', name: 'view', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_demo_priority_view', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Priority', permission: 'VIEW')]
    public function viewAction(Priority $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * Create Priority
     */
    #[Route(path: '/create', name: 'create', options: ['expose' => true])]
    #[Template('@AcmeDemo/Priority/update.html.twig')]
    #[Acl(id: 'acme_demo_priority_create', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Priority', permission: 'CREATE')]
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.priority.saved.message'
        );

        return $this->update(new Priority(), $request, $createMessage);
    }

    /**
     * Edit Priority form
     */
    #[Route(path: '/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_demo_priority_update', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Priority', permission: 'EDIT')]
    public function updateAction(Priority $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.priority.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        Priority $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->container->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(PriorityType::class, $entity),
            $message,
            $request,
            null
        );
    }

    #[\Override]
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
