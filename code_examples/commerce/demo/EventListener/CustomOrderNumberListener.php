<?php

declare(strict_types=1);

namespace Acme\Bundle\DemoBundle\EventListener;

use Acme\Bundle\DemoBundle\Generator\CustomOrderNumberGenerator;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Oro\Bundle\OrderBundle\Entity\Order;

class CustomOrderNumberListener
{
    public function __construct(
        private readonly CustomOrderNumberGenerator $generator
    ) {
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Order || $entity->getIdentifier()) {
            return;
        }

        $orderIdentifier = $this->generator->generate($entity);
        $entity->setIdentifier($orderIdentifier);
        $args->getObjectManager()->flush();
    }
}
