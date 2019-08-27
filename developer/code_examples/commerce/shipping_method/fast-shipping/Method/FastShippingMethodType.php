<?php

namespace ACME\Bundle\FastShippingBundle\Method;

use ACME\Bundle\FastShippingBundle\Form\Type\FastShippingMethodOptionsType;
use Oro\Bundle\CurrencyBundle\Entity\Price;
use Oro\Bundle\ShippingBundle\Context\ShippingContextInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodTypeInterface;

/**
 * Fast Shipping method type
 * Contains logic of calculating shipping price
 */
class FastShippingMethodType implements ShippingMethodTypeInterface
{
    public const PRICE_OPTION = 'price';

    private const WITHOUT_PRESENT_TYPE = 'without_present';
    private const WITH_PRESENT_TYPE = 'with_present';

    /**
     * @var string
     */
    private $label;

    /**
     * @var bool
     */
    private $isWithPresent;

    /**
     * @param string $label
     * @param bool $isWithPresent
     */
    public function __construct(string $label, bool $isWithPresent)
    {
        $this->label = $label;
        $this->isWithPresent = $isWithPresent;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentifier()
    {
        return $this->isWithPresent ? self::WITH_PRESENT_TYPE : self::WITHOUT_PRESENT_TYPE;
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * {@inheritDoc}
     */
    public function getSortOrder(): int
    {
        return 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionsConfigurationFormType(): string
    {
        return FastShippingMethodOptionsType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function calculatePrice(ShippingContextInterface $context, array $methodOptions, array $typeOptions): ?Price
    {
        $price = $typeOptions[static::PRICE_OPTION];

        // Provide additional price calculation logic here if required.

        return Price::create((float)$price, $context->getCurrency());
    }
}
