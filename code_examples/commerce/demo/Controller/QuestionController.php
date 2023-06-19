<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Question;
use Acme\Bundle\DemoBundle\Form\Type\QuestionType;
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
 * Contains CRUD actions for Question
 *
 * @Route("/question", name="acme_demo_question_")
 */
class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Template
     * @AclAncestor("acme_demo_question_view")
     */
    public function indexAction(): array
    {
        return [
            'entity_class' => Question::class
        ];
    }

    /**
     * @Route("/view/{id}", name="view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_demo_question_view",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Question",
     *      permission="VIEW"
     * )
     */
    public function viewAction(Question $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/report", name="report")
     * @Template
     * @AclAncestor("acme_demo_question_report")
     */
    public function reportAction(): array
    {
        return [
            'entity_class' => Question::class
        ];
    }

    /**
     * Create Question
     *
     * @Route("/create", name="create", options={"expose"=true})
     * @Template("@AcmeDemo/Question/update.html.twig")
     * @Acl(
     *      id="acme_demo_question_create",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Question",
     *      permission="CREATE"
     * )
     */
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.question.saved.message'
        );

        return $this->update(new Question(), $request, $createMessage);
    }

    /**
     * Edit Question form
     *
     * @Route("/update/{id}", name="update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_demo_question_update",
     *      type="entity",
     *      class="Acme\Bundle\DemoBundle\Entity\Question",
     *      permission="EDIT"
     * )
     */
    public function updateAction(Question $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->get(TranslatorInterface::class)->trans(
            'acme.demo.controller.question.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        Question $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(QuestionType::class, $entity),
            $message,
            $request,
            null
        );
    }

    public static function getSubscribedServices()
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
