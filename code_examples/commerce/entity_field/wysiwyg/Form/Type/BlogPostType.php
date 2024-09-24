<?php

namespace Acme\Bundle\WysiwygBundle\Form\Type;

use Acme\Bundle\WysiwygBundle\Entity\BlogPost;
use Oro\Bundle\CMSBundle\Form\Type\WYSIWYGType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for BlogPost entity.
 */
class BlogPostType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'content',
                WYSIWYGType::class,
                [
                    'required' => false,
                    'label' => 'acme.wysiwyg.blogpost.content.label',
                ]
            )
            ->add(
                'extraContent',
                WYSIWYGType::class,
                [
                    'required' => false,
                    'label' => 'acme.wysiwyg.blogpost.extra_content.label',
                ]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => BlogPost::class,
            ]
        );
    }

    #[\Override]
    public function getBlockPrefix(): string
    {
        return 'acme_wysiwyg_blog_post';
    }
}
