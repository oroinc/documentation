<?php

namespace Acme\Bundle\FastShippingBundle\Form\Type;

use Acme\Bundle\FastShippingBundle\Method\FastShippingMethodType;
use Oro\Bundle\CurrencyBundle\Rounding\RoundingServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Form type for fast shipping method options which are displayed on shipping rules page
 */
class FastShippingMethodOptionsType extends AbstractType
{
    private const BLOCK_PREFIX = 'acme_fast_shipping_options_type';

    /**
     * @var RoundingServiceInterface
     */
    protected $roundingService;

    public function __construct(RoundingServiceInterface $roundingService)
    {
        $this->roundingService = $roundingService;
    }

    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $priceOptions = [
            'scale' => $this->roundingService->getPrecision(),
            'rounding_mode' => $this->roundingService->getRoundType(),
            'attr' => ['data-scale' => $this->roundingService->getPrecision()],
        ];

        $builder
            ->add(FastShippingMethodType::PRICE_OPTION, NumberType::class, array_merge([
                'label' => 'acme.fast_shipping.method.price.label',
                'constraints' => [new NotBlank(), new Type(['type' => 'numeric'])],
            ], $priceOptions));
    }

    /**
     * @throws AccessException
     */
    #[\Override]
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => 'acme.fast_shipping.form.acme_fast_shipping_options_type.label',
        ]);
    }

    #[\Override]
    public function getBlockPrefix()
    {
        return self::BLOCK_PREFIX;
    }
}
