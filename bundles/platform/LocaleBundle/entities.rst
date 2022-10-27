.. _bundle-docs-platform-locale-bundle-localization:

Localization
============

Stores data for localization. It can be used to display the interface in the required language and formatting.

Localization entity contains the following fields:

* `name` (string) - a unique name of the localization, used for system purposes and not available in the user-interface
* `titles` (LocalizedFallbackValues[]) - a set of translatable titles of the Localization
* `languageCode` (string) - the language code, used to display the full title of the language by code; formatter ``Oro\Bundle\LocaleBundle\Formatter\LanguageCodeFormatter`` can be used
* `formattingCode` (string) - is used to display the full title of the formatting by code
* `formatLocale` (string) - is used to display the full title of the locale by code ``Oro\Bundle\LocaleBundle\Formatter\FormattingCodeFormatter``
* `parentLocalization` (Localization) - parent Localization

LocalizedFallbackValue
----------------------

LocalizedFallbackValue stores the translation of the necessary data for different localizations. It can be used to display the interface in the required language and formatting.

LocalizedFallbackValue entity contains the following fields:

* `fallback` (string) - fallback type
* `string` (string) - translation for a short string
* `text` (string) - translation for a long string (used if `string` is empty)
* `localization` (Localization) - localization

To retrieve the translated value for the necessary localization, use trait ``Oro\Bundle\LocaleBundle\Entity\FallbackTrait`` that provides methods `getFallbackValue()`, `getDefaultFallbackValue()` and `setDefaultFallbackValue()`.
