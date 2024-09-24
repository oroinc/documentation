<?php

namespace Acme\Bundle\DemoBundle\Validator;

use Acme\Bundle\DemoBundle\Entity\Priority;
use Doctrine\Common\Util\ClassUtils;
use Oro\Bundle\EntityBundle\Entity\Manager\Field\CustomGridFieldValidatorInterface;
use Oro\Bundle\EntityBundle\Exception\IncorrectEntityException;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * Validates priority entity fields to be editable inline in grid.
 */
class CustomGridFieldValidator implements CustomGridFieldValidatorInterface
{
    protected $accessor;

    public function __construct(
        PropertyAccessorInterface $accessor
    ) {
        $this->accessor = $accessor;
    }

    #[\Override]
    public function hasAccessEditField($entity, $fieldName): bool
    {
        if (!$entity instanceof Priority) {
            $className = ClassUtils::getClass($entity);
            throw new IncorrectEntityException(
                sprintf('Entity %s, is not instance of Priority class', $className)
            );
        }

        return $this->hasField($entity, $fieldName)
            && !in_array($fieldName, $this->getPriorityFieldBlockList(), true);
    }

    #[\Override]
    public function hasField($entity, $fieldName): bool
    {
        try {
            $this->accessor->isWritable($entity, $fieldName);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    protected function getPriorityFieldBlockList(): array
    {
        return [
            'updated_at',
        ];
    }
}
