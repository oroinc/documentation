<?php

namespace Acme\Bundle\CMSBundle\Form\Type;

use Acme\Bundle\CMSBundle\Entity\Block;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Block form type
 */
class BlockType extends AbstractType
{
    public const NAME = 'acme_cms_block';

    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Title',
                    'required' => true,
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => 'Content',
                    'required' => true,
                ]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Block::class,
            'csrf_token_id' => 'acme_cms_block',
            'ownership_disabled' => true,
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    #[\Override]
    public function getBlockPrefix()
    {
        return self::NAME;
    }
}
