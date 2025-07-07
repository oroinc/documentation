<?php

declare(strict_types=1);

namespace Acme\Bundle\DemoBundle\Generator;

use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\OrderBundle\Entity\Order;
use Oro\Bundle\PlatformBundle\NumberSequence\Manager\GenericNumberSequenceManager;

class CustomOrderNumberGenerator
{
    public function __construct(
        private readonly ManagerRegistry $doctrine
    ) {
    }

    public function generate(Order $order): string
    {
        $organizationId = $order->getOrganization()?->getId();
        $sequenceManager = new GenericNumberSequenceManager(
            $this->doctrine,
            'order',
            'organization_global',
            (string)$organizationId
        );

        $number = $sequenceManager->nextNumber();
        return sprintf('ORD-%05d', $number); // e.g., ORD-00123
    }
}
