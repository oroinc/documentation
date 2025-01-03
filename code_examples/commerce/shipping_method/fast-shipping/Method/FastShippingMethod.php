<?php

namespace Acme\Bundle\FastShippingBundle\Method;

use Oro\Bundle\ShippingBundle\Method\ShippingMethodIconAwareInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Represents Fast Shipping method.
 */
class FastShippingMethod implements ShippingMethodInterface, ShippingMethodIconAwareInterface
{
    private string $identifier;
    private string $name;
    private string $label;
    private ?string $icon;
    private bool $enabled;
    private array $types;

    public function __construct(
        string $identifier,
        string $name,
        string $label,
        ?string $icon,
        bool $enabled,
        array $types
    ) {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->enabled = $enabled;
        $this->types = $types;
    }

    #[\Override]
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    #[\Override]
    public function isGrouped(): bool
    {
        return true;
    }

    #[\Override]
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    #[\Override]
    public function getName(): string
    {
        return $this->name;
    }

    #[\Override]
    public function getLabel(): string
    {
        return $this->label;
    }

    #[\Override]
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    #[\Override]
    public function getTypes(): array
    {
        return $this->types;
    }

    #[\Override]
    public function getType(string $identifier): ?ShippingMethodTypeInterface
    {
        return $this->types[$identifier] ?? null;
    }

    #[\Override]
    public function getOptionsConfigurationFormType(): ?string
    {
        return HiddenType::class;
    }

    #[\Override]
    public function getSortOrder(): int
    {
        return 150;
    }
}
