<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Acme\Bundle\DemoBundle\Form\Type\SmsType;
use Oro\Bundle\EntityBundle\Tools\EntityRoutingHelper;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * The controller for the Sms related functionality
 */
#[Route(path: '/sms')]
class SmsController extends AbstractController
{
    /**
     * This action is used to render the list of sms associated with the given entity
     * on the view page of this entity
     */
    #[Route(
        path: '/activity/view/{entityClass}/{entityId}',
        name: 'acme_demo_sms_activity_view',
        requirements: ['entityClass' => '\w+', 'entityId' => '\d+']
    )]
    #[AclAncestor('acme_demo_sms_view')]
    public function activityAction(string $entityClass, int $entityId): Response
    {
        return $this->render(
            '@AcmeDemo/Sms/activity.html.twig',
            [
                'entity' => $this->container->get(EntityRoutingHelper::class)->getEntity($entityClass, $entityId),
            ]
        );
    }

    #[Route(
        path: '/widget/info/{id}',
        name: 'acme_demo_sms_widget_info',
        requirements: ['id' => '\d+'],
        options: ['expose' => true]
    )]
    #[Template('@AcmeDemo/Sms/widget/info.html.twig')]
    #[AclAncestor('acme_demo_sms_view')]
    public function infoAction(Request $request, Sms $entity): array
    {
        $targetEntity = $this->getTargetEntity($request);
        $renderContexts = null !== $targetEntity;

        return [
            'entity' => $entity,
            'target' => $targetEntity,
            'renderContexts' => $renderContexts,
        ];
    }

    /**
     * Get target entity
     *
     * @param Request $request
     *
     * @return object|null
     */
    protected function getTargetEntity(Request $request)
    {
        $entityRoutingHelper = $this->container->get(EntityRoutingHelper::class);
        $targetEntityClass = $entityRoutingHelper->getEntityClassName($request, 'targetActivityClass');
        $targetEntityId = $entityRoutingHelper->getEntityId($request, 'targetActivityId');
        if (!$targetEntityClass || !$targetEntityId) {
            return null;
        }

        return $entityRoutingHelper->getEntity($targetEntityClass, $targetEntityId);
    }

    /**
     * Create Sms
     */
    #[Route(path: '/create', name: 'acme_demo_sms_create', options: ['expose' => true])]
    #[Template('@AcmeDemo/Sms/update.html.twig')]
    #[Acl(
        id: 'acme_demo_sms_create',
        type: 'entity',
        class: 'Acme\Bundle\DemoBundle\Entity\Sms',
        permission: 'CREATE'
    )]
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.sms.saved.message'
        );

        return $this->update(new Sms(), $request, $createMessage);
    }

    /**
     * Edit Sms form
     */
    #[Route(
        path: '/update/{id}',
        name: 'acme_demo_sms_update',
        requirements: ['id' => '\d+'],
        options: ['expose' => true]
    )]
    #[Template('@AcmeDemo/Sms/update.html.twig')]
    #[Acl(id: 'acme_demo_sms_update', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Sms', permission: 'EDIT')]
    public function updateAction(Sms $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.sms.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    #[Route(path: '/', name: 'acme_demo_sms_index')]
    #[Template('@AcmeDemo/Sms/index.html.twig')]
    #[AclAncestor('acme_demo_sms_view')]
    public function indexAction(): array
    {
        return [
            'entity_class' => Sms::class
        ];
    }

    #[Route(path: '/view/{id}', name: 'acme_demo_sms_view', requirements: ['id' => '\d+'], options: ['expose' => true])]
    #[Template('@AcmeDemo/Sms/view.html.twig')]
    #[Acl(id: 'acme_demo_sms_view', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Sms', permission: 'VIEW')]
    public function viewAction(Sms $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    protected function update(
        Sms $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->container->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(SmsType::class, $entity),
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
                EntityRoutingHelper::class,
            ]
        );
    }
}
