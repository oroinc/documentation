<?php

namespace Acme\Bundle\DemoBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\DictionaryValueListProviderInterface;
use Oro\Bundle\EntityExtendBundle\Provider\EnumValueListProvider;

/**
 * Acme dictionary value provider.
 */
class AcmeDictionaryValueListProvider extends EnumValueListProvider implements DictionaryValueListProviderInterface
{
    protected const ACME_PREFIX = 'Acme';

    public function supports($className): bool
    {
        return str_ends_with($className, static::ACME_PREFIX) || parent::supports($className);
    }
}
