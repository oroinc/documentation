<?php

namespace Acme\Bundle\CMSBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * This constraint can be used to check title in Block entity.
 */
class UniqueTitleDraft extends Constraint
{
    public string $message = 'acme.cms.validators.unique_title_draft_message';

    /**
     * {@inheritDoc}
     */
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
