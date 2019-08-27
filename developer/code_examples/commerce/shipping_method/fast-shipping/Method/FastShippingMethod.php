<?php

namespace ACME\Bundle\FastShippingBundle\Method;

use Oro\Bundle\ShippingBundle\Method\ShippingMethodIconAwareInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Fast Shipping method class
 */
class FastShippingMethod implements ShippingMethodInterface, ShippingMethodIconAwareInterface
{
    /**
     * @var array
     */
    private $types;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @param string $identifier
     * @param string $label
     * @param string|null $icon
     * @param bool $enabled
     * @param array $types
     */
    public function __construct(string $identifier, string $label, ?string $icon, bool $enabled, array $types)
    {
        $this->identifier = $identifier;
        $this->label = $label;
        $this->icon = $icon;
        $this->enabled = $enabled;
        $this->types = $types;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * {@inheritDoc}
     */
    public function isGrouped(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
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
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * {@inheritDoc}
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * {@inheritDoc}
     */
    public function getType($type): ?ShippingMethodTypeInterface
    {
        if (array_key_exists($type, $this->types)) {
            return $this->types[$type];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionsConfigurationFormType(): string
    {
        return HiddenType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getSortOrder(): int
    {
        return 150;
    }
}
