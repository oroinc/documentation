<?php

namespace ACME\Bundle\CMSBundle\Validator\Constraints;

use ACME\Bundle\CMSBundle\Entity\Block;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\DraftBundle\Manager\DraftableFilterManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Checks if at least one record exists (includes draft entities).
 */
class UniqueTitleDraftValidator extends ConstraintValidator
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @var DraftableFilterManager
     */
    private $filterManager;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        ManagerRegistry $registry,
        DraftableFilterManager $filterManager,
        TranslatorInterface $translator
    ) {
        $this->registry = $registry;
        $this->filterManager = $filterManager;
        $this->translator = $translator;
    }

    /**
     * @param string|null $value
     * @param UniqueTitleDraft|Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->registry->getManagerForClass(Block::class);
        $this->filterManager->disable(Block::class);
        $result = $entityManager
            ->getRepository(Block::class)
            ->findBy(['title' => $value]);

        $countResult = count($result);

        $this->filterManager->enable(Block::class);

        if (0 === $countResult || (1 === $countResult && $this->context->getObject() === current($result))) {
            return;
        }

        $message = $this->translator->trans($constraint->message);
        $this->context->buildViolation($message)->addViolation();
    }
}
