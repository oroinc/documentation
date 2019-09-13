<?php

namespace ACME\Bundle\CopyrightBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Copyright content widget form type.
 */
class CopyrightContentWidgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'isShort',
            CheckboxType::class,
            ['label' => 'acme.copyright.settings.is_short.label', 'required' => false]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'acme_copyright_content_widget';
    }
}
