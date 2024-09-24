<?php

namespace Acme\Bundle\DemoBundle\Sanitize\RuleProcessor\Field;

use Doctrine\ORM\Mapping\ClassMetadata;
use Oro\Bundle\SanitizeBundle\RuleProcessor\Field\Helper\ProcessorHelper;
use Oro\Bundle\SanitizeBundle\RuleProcessor\Field\JsonBuildPairsPostProcessor;
use Oro\Bundle\SanitizeBundle\RuleProcessor\Field\ProcessorInterface;
use Oro\Bundle\SanitizeBundle\RuleProcessor\Field\SerializeFieldCheckerTrait;

/**
 * Reverse string sanitizing rule processor for a field.
 */
class ReverseProcessor implements ProcessorInterface
{
    use SerializeFieldCheckerTrait;

    public function __construct(
        private JsonBuildPairsPostProcessor $jsonBuildPairsPostProcessor,
        private ProcessorHelper $helper
    ) {
    }

    #[\Override]
    public static function getProcessorName(): string
    {
        return 'str_reverse';
    }

    #[\Override]
    public function getIncompatibilityMessages(
        string $fieldName,
        ClassMetadata $metadata,
        array $sanitizeRuleOptions = []
    ): array {
        if (!$this->helper->isStringField($fieldName, $metadata)) {
            return [sprintf(
                ProcessorHelper::NON_DATE_FIELD_PROCESSED,
                $fieldName,
                $metadata->getName(),
                self::getProcessorName()
            )];
        }

        return [];
    }

    #[\Override]
    public function getSqls(
        string $fieldName,
        ClassMetadata $metadata,
        array $sanitizeRuleOptions = []
    ): array {
        $quotedColumnName = $this->helper->getQuotedColumnName($fieldName, $metadata);
        return [sprintf(
            "UPDATE %s SET %s=%s",
            $this->helper->quoteIdentifier($metadata->getTableName()),
            $quotedColumnName,
            $this->getUpdateSqlValue($quotedColumnName)
        )];
    }

    protected function doPrepareSerializedFieldUpdate(
        string $fieldName,
        ClassMetadata $metadata,
        array $sanitizeRuleOptions = []
    ): void {
        $updateSqlValue = $this->getUpdateSqlValue(
            sprintf("serialized_data->>%s", $this->helper->quoteString($fieldName))
        );
        $this->jsonBuildPairsPostProcessor
            ->addJsonBuildPairForTable($metadata->getTableName(), $fieldName, $updateSqlValue);
    }

    private function getUpdateSqlValue(string $quotedColumnName): string
    {
        return sprintf('REVERSE(%s)', $quotedColumnName);
    }
}
