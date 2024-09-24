<?php

namespace Oro\Bundle\BlogPostExampleBundle\Form\Type;

use Oro\Bundle\BlogPostExampleBundle\Entity\ProductOptions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for ProductOptions entity
 */
class ProductOptionsType extends AbstractType
{
    const BLOCK_PREFIX = 'oro_blogpostexample_product_options';

    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value');
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => ProductOptions::class
            ]
        );
    }

    #[\Override]
    public function getBlockPrefix()
    {
        return self::BLOCK_PREFIX;
    }
}
