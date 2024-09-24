<?php

namespace Acme\Bundle\FastShippingBundle\Form\Type;

use Acme\Bundle\FastShippingBundle\Entity\FastShippingSettings;
use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Form type for Fast Shipping integration settings
 */
class FastShippingTransportSettingsType extends AbstractType
{
    private const BLOCK_PREFIX = 'acme_fast_shipping_settings';

    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'labels',
                LocalizedFallbackValueCollectionType::class,
                [
                    'label'    => 'acme.fast_shipping.settings.labels.label',
                    'required' => true,
                    'entry_options'  => ['constraints' => [new NotBlank()]],
                ]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FastShippingSettings::class
        ]);
    }

    #[\Override]
    public function getBlockPrefix()
    {
        return self::BLOCK_PREFIX;
    }
}
