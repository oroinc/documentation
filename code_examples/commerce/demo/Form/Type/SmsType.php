<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Sms entity.
 */
class SmsType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'fromContact',
                TextType::class,
                ['label' => 'acme.demo.sms.from_contact.label', 'required' => false]
            )
            ->add(
                'toContact',
                TextType::class,
                ['label' => 'acme.demo.sms.to_contact.label', 'required' => false]
            )
            ->add(
                'message',
                TextareaType::class,
                ['label' => 'acme.demo.sms.message.label', 'required' => false]
            )
        ;
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sms::class
        ]);
    }
}
