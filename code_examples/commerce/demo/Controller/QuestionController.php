<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Question;
use Acme\Bundle\DemoBundle\Form\Type\QuestionType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contains CRUD actions for Question
 */
#[Route(path: '/question', name: 'acme_demo_question_')]
class QuestionController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    #[Template]
    #[AclAncestor('acme_demo_question_view')]
    public function indexAction(): array
    {
        return [
            'entity_class' => Question::class
        ];
    }

    #[Route(path: '/view/{id}', name: 'view', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_demo_question_view', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Question', permission: 'VIEW')]
    public function viewAction(Question $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    #[Route(path: '/report', name: 'report')]
    #[Template]
    #[AclAncestor('acme_demo_question_report')]
    public function reportAction(): array
    {
        return [
            'entity_class' => Question::class
        ];
    }

    /**
     * Create Question
     */
    #[Route(path: '/create', name: 'create', options: ['expose' => true])]
    #[Template('@AcmeDemo/Question/update.html.twig')]
    #[Acl(id: 'acme_demo_question_create', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Question', permission: 'CREATE')]
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.question.saved.message'
        );

        return $this->update(new Question(), $request, $createMessage);
    }

    /**
     * Edit Question form
     */
    #[Route(path: '/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_demo_question_update', type: 'entity', class: 'Acme\Bundle\DemoBundle\Entity\Question', permission: 'EDIT')]
    public function updateAction(Question $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->container->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.question.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        Question $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->container->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(QuestionType::class, $entity),
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
