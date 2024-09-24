<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Priority entity with inline create & select buttons
 */
class PriorityCreateOrSelectType extends AbstractType
{
    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'acme_demo_priority',
                'create_form_route' => 'acme_demo_priority_create',
                'grid_name' => 'acme-demo-priority-grid-select'
            ]
        );
    }

    #[\Override]
    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }
}
