<?php

namespace ACME\Bundle\FastShippingBundle\Factory;

use ACME\Bundle\FastShippingBundle\Entity\FastShippingSettings;
use ACME\Bundle\FastShippingBundle\Method\FastShippingMethod;
use ACME\Bundle\FastShippingBundle\Method\FastShippingMethodType;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Oro\Bundle\IntegrationBundle\Generator\IntegrationIdentifierGeneratorInterface;
use Oro\Bundle\IntegrationBundle\Provider\IntegrationIconProviderInterface;
use Oro\Bundle\LocaleBundle\Helper\LocalizationHelper;
use Oro\Bundle\ShippingBundle\Method\Factory\IntegrationShippingMethodFactoryInterface;
use Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * The factory to create Fast Shipping method.
 */
class FastShippingMethodFromChannelFactory implements IntegrationShippingMethodFactoryInterface
{
    private IntegrationIdentifierGeneratorInterface $identifierGenerator;
    private LocalizationHelper $localizationHelper;
    private TranslatorInterface $translator;
    private IntegrationIconProviderInterface $integrationIconProvider;

    public function __construct(
        IntegrationIdentifierGeneratorInterface $identifierGenerator,
        LocalizationHelper $localizationHelper,
        TranslatorInterface $translator,
        IntegrationIconProviderInterface $integrationIconProvider
    ) {
        $this->identifierGenerator = $identifierGenerator;
        $this->localizationHelper = $localizationHelper;
        $this->translator = $translator;
        $this->integrationIconProvider = $integrationIconProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function create(Channel $channel): ShippingMethodInterface
    {
        /** @var FastShippingSettings $transport */
        $transport = $channel->getTransport();

        return new FastShippingMethod(
            $this->identifierGenerator->generateIdentifier($channel),
            (string)$this->localizationHelper->getLocalizedValue($transport->getLabels()),
            $this->integrationIconProvider->getIcon($channel),
            $channel->isEnabled(),
            $this->createTypes()
        );
    }

    private function createTypes(): array
    {
        $withoutPresent = new FastShippingMethodType(
            $this->translator->trans('acme.fast_shipping.method.processing_type.without_present.label'),
            false
        );
        $withPresent = new FastShippingMethodType(
            $this->translator->trans('acme.fast_shipping.method.processing_type.with_present.label'),
            true
        );

        return [
            $withoutPresent->getIdentifier() => $withoutPresent,
            $withPresent->getIdentifier() => $withPresent,
        ];
    }
}
