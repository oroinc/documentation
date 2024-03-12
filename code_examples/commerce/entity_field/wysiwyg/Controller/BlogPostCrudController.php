<?php

namespace Acme\Bundle\WysiwygBundle\Controller;

use Acme\Bundle\WysiwygBundle\Entity\BlogPost;
use Acme\Bundle\WysiwygBundle\Form\Type\BlogPostType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
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
    #[Route(path: '/', name: 'acme_wysiwyg_blog_post_index')]
    #[Template]
    #[AclAncestor('acme_wysiwyg_blog_post_view')]
    public function indexAction(): array
    {
        return ['entity_class' => BlogPost::class];
    }

    #[Route(path: '/view/{id}', name: 'acme_wysiwyg_blog_post_view', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_wysiwyg_blog_post_view', type: 'entity', class: 'Acme\Bundle\WysiwygBundle\Entity\BlogPost', permission: 'VIEW')]
    public function viewAction(BlogPost $blogPost): array
    {
        return ['entity' => $blogPost];
    }

    /**
     *
     * @return array|Response
     */
    #[Route(path: '/create', name: 'acme_wysiwyg_blog_post_create')]
    #[Template('@AcmeWysiwyg/BlogPostCrud/update.html.twig')]
    #[Acl(id: 'acme_wysiwyg_blog_post_create', type: 'entity', class: 'Acme\Bundle\WysiwygBundle\Entity\BlogPost', permission: 'CREATE')]
    public function createAction(Request $request)
    {
        return $this->update($request, new BlogPost());
    }

    /**
     *
     * @return array|Response
     */
    #[Route(path: '/update/{id}', name: 'acme_wysiwyg_blog_post_update', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'acme_wysiwyg_blog_post_update', type: 'entity', class: 'Acme\Bundle\WysiwygBundle\Entity\BlogPost', permission: 'EDIT')]
    public function updateAction(Request $request, BlogPost $blogPost)
    {
        return $this->update($request, $blogPost);
    }

    /**
     * @return array|Response
     */
    protected function update(Request $request, BlogPost $blogPost)
    {
        return $this->container->get(UpdateHandlerFacade::class)
            ->update(
                $blogPost,
                $this->createForm(BlogPostType::class, $blogPost),
                $this->container->get(TranslatorInterface::class)->trans('acme.wysiwyg.blogpost.message.saved'),
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
