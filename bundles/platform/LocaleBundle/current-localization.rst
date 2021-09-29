.. _bundle-docs-platform-locale-bundle-current-localization:

Current Localization
====================

Receive Current Localization
----------------------------

To receive the current localization, use ``Oro\Bundle\LocaleBundle\Helper\LocalizationHelper::getCurrentLocalization()`` or ``oro_locale.helper.localization->getCurrentLocalization()``.

Provide Current Localization
----------------------------

To provide the current localization, create a custom extension, implement ``Oro\Bundle\LocaleBundle\Extension\CurrentLocalizationExtensionInterface``, and register it by tag ``oro_locale.extension.current_localization``.

.. code-block:: yaml

    services:
        ...
        acme_demo.extension.current_localization:
            class: Acme\Bundle\DemoBundle\Extension\CurrentLocalizationExtension
            arguments:
                ...
            tags:
                - { name: oro_locale.extension.current_localization }


.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Extension;

    use Oro\Bundle\LocaleBundle\Entity\Localization;
    use Oro\Bundle\LocaleBundle\Extension\CurrentLocalizationExtensionInterface;

    class CurrentLocalizationExtension implements CurrentLocalizationExtensionInterface
    {
        /**
         * @return Localization|null
         */
        public function getCurrentLocalization()
        {
            // your custom logic to receive current localization
        }
    }
