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
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Factory that creates shipping method from the channel
 */
class FastShippingMethodFromChannelFactory implements IntegrationShippingMethodFactoryInterface
{
    /**
     * @var IntegrationIdentifierGeneratorInterface
     */
    private $identifierGenerator;

    /**
     * @var LocalizationHelper
     */
    private $localizationHelper;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var IntegrationIconProviderInterface
     */
    private $integrationIconProvider;

    /**
     * FastShippingMethodFromChannelFactory constructor.
     */
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

    public function create(Channel $channel): FastShippingMethod
    {
        $id = $this->identifierGenerator->generateIdentifier($channel);
        $label = $this->getChannelLabel($channel);
        $icon = $this->getIcon($channel);
        $types = $this->createTypes();

        return new FastShippingMethod($id, $label, $icon, $channel->isEnabled(), $types);
    }

    private function getChannelLabel(Channel $channel): string
    {
        /** @var FastShippingSettings $transport */
        $transport = $channel->getTransport();

        return (string) $this->localizationHelper->getLocalizedValue($transport->getLabels());
    }

    private function getIcon(Channel $channel): ?string
    {
        return $this->integrationIconProvider->getIcon($channel);
    }

    private function createTypes(): array
    {
        $withoutPresentLabel = $this->translator
            ->trans('acme.fast_shipping.method.processing_type.without_present.label');
        $withPresentLabel = $this->translator
            ->trans('acme.fast_shipping.method.processing_type.with_present.label');

        $withoutPresent = new FastShippingMethodType($withoutPresentLabel, false);
        $withPresent = new FastShippingMethodType($withPresentLabel, true);

        return [
            $withoutPresent->getIdentifier() => $withoutPresent,
            $withPresent->getIdentifier() => $withPresent,
        ];
    }
}
