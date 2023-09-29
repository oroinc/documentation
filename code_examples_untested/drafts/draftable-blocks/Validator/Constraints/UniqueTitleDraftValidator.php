<?php

namespace Acme\Bundle\CMSBundle\Validator\Constraints;

use Acme\Bundle\CMSBundle\Entity\Block;
use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\DraftBundle\Manager\DraftableFilterManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validates whether at least one record exists (includes draft entities).
 */
class UniqueTitleDraftValidator extends ConstraintValidator
{
    private ManagerRegistry $doctrine;
    private DraftableFilterManager $filterManager;

    public function __construct(
        ManagerRegistry $doctrine,
        DraftableFilterManager $filterManager
    ) {
        $this->doctrine = $doctrine;
        $this->filterManager = $filterManager;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueTitleDraft) {
            throw new UnexpectedTypeException($constraint, UniqueTitleDraft::class);
        }

        $this->filterManager->disable(Block::class);
        try {
            $result = $this->doctrine->getRepository(Block::class)->findBy(['title' => $value]);
        } finally {
            $this->filterManager->enable(Block::class);
        }

        $countResult = count($result);
        if (0 === $countResult || (1 === $countResult && $this->context->getObject() === current($result))) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}
