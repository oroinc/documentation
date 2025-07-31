<?php

declare(strict_types=1);

namespace Acme\Bundle\DemoBundle\EventListener;

use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\PlatformBundle\Entity\NumberSequence;
use Oro\Bundle\PlatformBundle\Event\DeleteOldNumberSequenceEvent;

class CustomOrderSequenceCleanupListener
{
    public function __construct(
        private readonly ManagerRegistry $doctrine
    ) {
    }

    public function onDeleteOldNumberSequence(DeleteOldNumberSequenceEvent $event): void
    {
        if (
            $event->getSequenceType() !== 'order' ||
            $event->getDiscriminatorType() !== 'organization_periodic'
        ) {
            return;
        }

        $cutoffDate = new \DateTime('-3 months');
        $repository = $this->doctrine->getRepository(NumberSequence::class);

        $oldSequences = $repository->findOldSequences('order', 'organization_periodic', $cutoffDate);

        $manager = $this->doctrine->getManagerForClass(NumberSequence::class);
        foreach ($oldSequences as $sequence) {
            $manager->remove($sequence);
        }

        $manager->flush();
    }
}
