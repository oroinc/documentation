<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Acme\Bundle\DemoBundle\Entity\DoctrineTypeField;
use Oro\Bundle\FormBundle\Form\Type\OroDurationType;
use Oro\Bundle\FormBundle\Form\Type\OroMoneyType;
use Oro\Bundle\FormBundle\Form\Type\OroPercentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for DoctrineTypeField entity.
 */
class DoctrineTypeFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'percentField',
                OroPercentType::class,
                ['label' => 'acme.demo.doctrinetypefield.percent_field.label', 'required' => false]
            )
            ->add(
                'moneyField',
                OroMoneyType::class,
                ['label' => 'acme.demo.doctrinetypefield.money_field.label', 'required' => false]
            )
            ->add(
                'durationField',
                OroDurationType::class,
                ['label' => 'acme.demo.doctrinetypefield.duration_field.label', 'required' => false]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DoctrineTypeField::class
        ]);
    }
}
