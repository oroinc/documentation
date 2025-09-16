<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\DoctrineTypeField;
use Acme\Bundle\DemoBundle\Form\Type\DoctrineTypeFieldType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contains CRUD actions for DoctrineTypeField
 */
#[Route(path: '/doctrine_type_field', name: 'acme_demo_doctrine_type_field_')]
class DoctrineTypeFieldController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    #[Template('@AcmeDemo/DoctrineTypeField/index.html.twig')]
    #[AclAncestor('acme_demo_doctrine_type_field_view')]
    public function indexAction(): array
    {
        return [
            'entity_class' => DoctrineTypeField::class
        ];
    }

    #[Route(path: '/view/{id}', name: 'view', requirements: ['id' => '\d+'])]
    #[Template('@AcmeDemo/DoctrineTypeField/view.html.twig')]
    #[Acl(
        id: 'acme_demo_doctrine_type_field_view',
        type: 'entity',
        class: 'Acme\Bundle\DemoBundle\Entity\DoctrineTypeField',
        permission: 'VIEW'
    )]
    public function viewAction(DoctrineTypeField $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * Create DoctrineTypeField
     */
    #[Route(path: '/create', name: 'create', options: ['expose' => true])]
    #[Template('@AcmeDemo/DoctrineTypeField/update.html.twig')]
    #[Acl(
        id: 'acme_demo_doctrine_type_field_create',
        type: 'entity',
        class: 'Acme\Bundle\DemoBundle\Entity\DoctrineTypeField',
        permission: 'CREATE'
    )]
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.doctrine_type_field.saved.message'
        );

        return $this->update(new DoctrineTypeField(), $request, $createMessage);
    }

    /**
     * Edit DoctrineTypeField form
     */
    #[Route(path: '/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    #[Template('@AcmeDemo/DoctrineTypeField/update.html.twig')]
    #[Acl(
        id: 'acme_demo_doctrine_type_field_update',
        type: 'entity',
        class: 'Acme\Bundle\DemoBundle\Entity\DoctrineTypeField',
        permission: 'EDIT'
    )]
    public function updateAction(DoctrineTypeField $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.doctrine_type_field.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        DoctrineTypeField $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->container->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(DoctrineTypeFieldType::class, $entity),
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
