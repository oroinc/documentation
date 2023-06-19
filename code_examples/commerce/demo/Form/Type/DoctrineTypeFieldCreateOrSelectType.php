<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for DoctrineTypeField entity with inline create & select buttons
 */
class DoctrineTypeFieldCreateOrSelectType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'acme_demo_doctrine_type_field',
                'create_form_route' => 'acme_demo_doctrine_type_field_create',
                'grid_name' => 'acme-demo-doctrine-type-field-grid-select'
            ]
        );
    }

    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }
}
