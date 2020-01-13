<?php

namespace ACME\Bundle\CMSBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * This constraint can be used to check title in Block entity.
 */
class UniqueTitleDraft extends Constraint
{
    /**
     * @var string
     */
    public $message = 'acme.cms.validators.unique_title_draft_message';

    /**
     * @var array
     */
    public $fields;

    /**
     * @return string
     */
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    /**
     * {@inheritdoc}
     */
    public function validatedBy(): string
    {
        return 'acme_cms_unique_title_draft_validator';
    }
}
