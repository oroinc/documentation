<?php

declare(strict_types=1);

namespace Acme\Bundle\DemoBundle\Generator;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\InvoiceBundle\DependencyInjection\Configuration;
use Oro\Bundle\InvoiceBundle\Entity\Invoice;
use Oro\Bundle\InvoiceBundle\Generator\InvoiceNumberGeneratorInterface;

class CustomInvoiceNumberGenerator implements InvoiceNumberGeneratorInterface
{
    public function __construct(
        private ConfigManager $configManager
    ) {
    }

    #[\Override]
    public function generate(?Invoice $invoice = null): string
    {
        $invoicePrefix = $this->configManager->get(
            Configuration::getConfigKeyByName(Configuration::INVOICE_PREFIX),
            scopeIdentifier: $invoice?->getOrganization()
        );
        return $invoicePrefix . \hrtime(as_number: true);
    }

    #[\Override]
    public static function getGeneratorType(): string
    {
        return 'acme_custom';
    }
}
