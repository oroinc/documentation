<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Acme\Bundle\DemoBundle\Entity\Question;
use Oro\Bundle\FormBundle\Form\Type\OroDateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Question entity.
 */
class QuestionType extends AbstractType
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'subject',
                TextType::class,
                ['label' => 'acme.demo.question.subject.label', 'required' => true]
            )
            ->add(
                'description',
                TextType::class,
                ['label' => 'acme.demo.question.description.label', 'required' => true]
            )
            ->add(
                'dueDate',
                OroDateTimeType::class,
                ['label' => 'acme.demo.question.due_date.label', 'required' => false]
            )
            ->add(
                'priority',
                PriorityCreateOrSelectType::class,
                ['label' => 'acme.demo.question.priority.label', 'required' => false]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class
        ]);
    }
}
