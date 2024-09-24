<?php

namespace Acme\Bundle\DemoBundle\Sanitize\RuleProcessor\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\Mapping\ClassMetadata;
use Oro\Bundle\SanitizeBundle\RuleProcessor\Entity\ProcessorInterface;

/**
 * Sanitizing rule processor for an entity that keeps last added rows regarding primary key.
 */
class KeepLastRowsProcessor implements ProcessorInterface
{
    private const KEEP_LAST_ROWS_DEFAULT_COUNT = 10;

    public function __construct(private Connection $connection)
    {
    }

    #[\Override]
    public static function getProcessorName(): string
    {
        return 'keep_last_rows';
    }

    #[\Override]
    public function getSqls(ClassMetadata $metadata, array $sanitizeRuleOptions = []): array
    {
        try {
            $idFieldType = $metadata->getFieldMapping($metadata->getSingleIdentifierFieldName())['type'];
            if (!in_array($idFieldType, ['integer', 'bigint', 'smallint'], true)) {
                throw new \RuntimeException();
            }
        } catch (\Throwable $e) {
            throw new \Exception(spritnf(
                "Could not detect single identifier numeric field name for '%s' entity",
                $metadata->getName()
            ));
        }

        return [sprintf(
            'DELETE FROM %1$s WHERE %2$s NOT IN(SELECT %2$s FROM %1$s ORDER BY %2$s DESC LIMIT %3$s)',
            $this->connection->quoteIdentifier($metadata->getTableName()),
            $this->connection->quoteIdentifier($metadata->getSingleIdentifierFieldName()),
            ((int) ($sanitizeRuleOptions['rows_count'] ?? 0)) ?: self::KEEP_LAST_ROWS_DEFAULT_COUNT
        )];
    }
}
