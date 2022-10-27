<?php

namespace ACME\Bundle\WysiwygBundle\Controller;

use ACME\Bundle\WysiwygBundle\Entity\BlogPost;
use ACME\Bundle\WysiwygBundle\Form\Type\BlogPostType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * This controller covers basic CRUD functionality for BlogPost entity.
 */
class BlogPostCrudController extends AbstractController
{
    /**
     * @Route("/", name="acme_wysiwyg_blog_post_index")
     * @Template
     * @AclAncestor("acme_wysiwyg_blog_post_view")
     */
    public function indexAction(): array
    {
        return ['entity_class' => BlogPost::class];
    }

    /**
     * @Route("/view/{id}", name="acme_wysiwyg_blog_post_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_wysiwyg_blog_post_view",
     *      type="entity",
     *      class="ACMEWysiwygBundle:BlogPost",
     *      permission="VIEW"
     * )
     */
    public function viewAction(BlogPost $blogPost): array
    {
        return ['entity' => $blogPost];
    }

    /**
     * @Route("/create", name="acme_wysiwyg_blog_post_create")
     * @Template("@ACMEWysiwyg/BlogPostCrud/update.html.twig")
     * @Acl(
     *      id="acme_wysiwyg_blog_post_create",
     *      type="entity",
     *      class="ACMEWysiwygBundle:BlogPost",
     *      permission="CREATE"
     * )
     *
     * @return array|Response
     */
    public function createAction(Request $request)
    {
        return $this->update($request, new BlogPost());
    }

    /**
     * @Route("/update/{id}", name="acme_wysiwyg_blog_post_update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="acme_wysiwyg_blog_post_update",
     *      type="entity",
     *      class="ACMEWysiwygBundle:BlogPost",
     *      permission="EDIT"
     * )
     *
     * @return array|Response
     */
    public function updateAction(Request $request, BlogPost $blogPost)
    {
        return $this->update($request, $blogPost);
    }

    /**
     * @return array|Response
     */
    protected function update(Request $request, BlogPost $blogPost)
    {
        return $this->get(UpdateHandlerFacade::class)
            ->update(
                $blogPost,
                $this->createForm(BlogPostType::class, $blogPost),
                $this->get(TranslatorInterface::class)->trans('acme.wysiwyg.blogpost.message.saved'),
                $request,
                null,
                function (BlogPost $blogPost, FormInterface $form, Request $request) {
                    if ($blogPost->getId()) {
                        $formAction = $this->generateUrl('acme_wysiwyg_blog_post_update', ['id' => $blogPost->getId()]);
                    } else {
                        $formAction = $this->generateUrl('acme_wysiwyg_blog_post_create');
                    }

                    return [
                        'entity' => $blogPost,
                        'form' => $form->createView(),
                        'formAction' => $formAction
                    ];
                }
            );
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            UpdateHandlerFacade::class,
            TranslatorInterface::class,
        ]);
    }
}
