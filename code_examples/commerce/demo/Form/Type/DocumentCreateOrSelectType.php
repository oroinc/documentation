<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Document entity with inline create & select buttons
 */
class DocumentCreateOrSelectType extends AbstractType
{
    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'acme_demo_document',
                'create_form_route' => 'acme_demo_document_create',
                'grid_name' => 'acme-demo-document-grid-select'
            ]
        );
    }

    #[\Override]
    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }
}
