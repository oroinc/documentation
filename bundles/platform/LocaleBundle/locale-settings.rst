.. _bundle-docs-platform-locale-bundle-locale-settings:

Locale Settings
===============

Locale Settings is a service of the ``Oro\Bundle\LocaleBundle\Model\LocaleSettings`` class with the ``oro_locale.settings`` ID.

You  can use this service to get locale-specific settings of the application, such as:

* locale based on localization
* language based on localization
* location
* calendar
* time zone
* list of person names formats
* list of addresses formats
* currency-specific data

  * currency symbols based on currency codes
  * currency code, phone prefix, default locale based on country

Locale
------

Locale settings can provide the default application locale. This setting is based on the system
configuration (oro_locale.default_localization) and vary per user. Locale is used by all formatters,
such as names, addresses, numbers, dates, and times.

Example of getting current locale:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    $locale = $locale->getLocale();


Locale Settings class also provides help static methods related to locales:

1. ``Oro\Bundle\LocaleBundle\Model\LocaleSettings::getValidLocale`` validates the given locale according to the actual data of the environment. This method aims to ensure that the locale is valid in the current environment (PHP intl extension, ICU version). If locale is not supported, then the fallback valid default one is used. This method also strips all parts of locale different from \Locale::LANG_TAG, \Locale::SCRIPT_TAG, and \Locale::REGION_TAG.

   Example of usage:

   .. code-block:: php

        // outputs ru_RU
        echo \Oro\Bundle\LocaleBundle\Model\LocaleSettings::getValidLocale('ru_RU');

        // outputs en_US
        echo \Oro\Bundle\LocaleBundle\Model\LocaleSettings::getValidLocale('en_Hans_CN_nedis_rozaj_x_prv1_prv2');

        // outputs en_US if this is a default locale
        echo \Oro\Bundle\LocaleBundle\Model\LocaleSettings::getValidLocale('unknown');

2. ``Oro\Bundle\LocaleBundle\Model\LocaleSettings::getLocales`` returns the list of all available locales.

3. ``Oro\Bundle\LocaleBundle\Model\LocaleSettings::getCountryByLocale`` gets country by locale. If it could not find the result, than it returns the default country.

Language
--------

Locale settings provide the application language configuration. This setting is based on the system
configuration (oro_locale.default_localization) and can be different per user. The application language affects
translations and representation of date times. For example, if you set the locale to en_US and set the language
to French, the date/times will be localized using the en_US locale formats but with the French language.
To get the current language, use the following method:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    $language = $locale->getLanguage();

Calendar
--------

Locale settings can provide an instance of a localized Calendar class (``Oro\Bundle\LocaleBundle\Model\Calendar``). This class
can be used to get localized calendar data based on the application locale and the application language.

An example of getting the calendar from the locale settings:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    $calendar = $locale->getCalendar();


The calendar provides the following information:

First Day of the Week
^^^^^^^^^^^^^^^^^^^^^

The first day of the week depends on the locale set in the Locale Settings.

.. code-block:: php

    // Returns one of constants of Calendar: DOW_SUNDAY, DOW_MONDAY, DOW_TUESDAY, DOW_WEDNESDAY, DOW_THURSDAY, DOW_FRIDAY, DOW_SATURDAY
    $firstDayOfWeek = $calendar->getFirstDayOfWeek();

Month Names
^^^^^^^^^^^

Month names depends on the application language in the Locale Settings.

.. code-block:: php

    // [
    //   1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July',
    //   'August', 'September', 'October', 'November', 'December',
    // ]
    $wideMonthNames = $calendar->getMonthNames();
    $wideMonthNames = $calendar->getMonthNames(Calendar::WIDTH_WIDE);

    // [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    $abbreviatedMonthNames = $calendar->getMonthNames(Calendar::WIDTH_ABBREVIATED);

    $shortMonthNames = $calendar->getMonthNames(Calendar::WIDTH_SHORT);

    // [1 => 'J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
    $narrowMonthNames = $calendar->getMonthNames(Calendar::WIDTH_NARROW);

Days of Week Names
^^^^^^^^^^^^^^^^^^

Names for days of the week depend on the application language in the Locale Settings.

.. code-block:: php

    // [
    //   Calendar::DOW_SUNDAY    => 'Sunday',
    //   Calendar::DOW_MONDAY    => 'Monday',
    //   Calendar::DOW_TUESDAY   => 'Tuesday',
    //   Calendar::DOW_WEDNESDAY => 'Wednesday',
    //   Calendar::DOW_THURSDAY  => 'Thursday',
    //   Calendar::DOW_FRIDAY    => 'Friday',
    //   Calendar::DOW_SATURDAY  => 'Saturday',
    // ];
    $wideDowNames = $calendar->getDayOfWeekNames();
    $wideDowNames = $calendar->getDayOfWeekNames(Calendar::WIDTH_WIDE);

    // [
    //   Calendar::DOW_SUNDAY    => 'Sun',
    //   Calendar::DOW_MONDAY    => 'Mon',
    //   Calendar::DOW_TUESDAY   => 'Tue',
    //   Calendar::DOW_WEDNESDAY => 'Wed',
    //   Calendar::DOW_THURSDAY  => 'Thu',
    //   Calendar::DOW_FRIDAY    => 'Fri',
    //   Calendar::DOW_SATURDAY  => 'Sat',
    // ];
    $abbreviatedDowNames = $calendar->getDayOfWeekNames(Calendar::WIDTH_ABBREVIATED);
    $shortDowNames = $calendar->getDayOfWeekNames(Calendar::WIDTH_SHORT);

    // [
    //   Calendar::DOW_SUNDAY    => 'S',
    //   Calendar::DOW_MONDAY    => 'M',
    //   Calendar::DOW_TUESDAY   => 'T',
    //   Calendar::DOW_WEDNESDAY => 'W',
    //   Calendar::DOW_THURSDAY  => 'T',
    //   Calendar::DOW_FRIDAY    => 'F',
    //   Calendar::DOW_SATURDAY  => 'S',
    // ];
    $narrowDowNames = $calendar->getDayOfWeekNames(Calendar::WIDTH_NARROW);

Location
--------

Location is a country associated with locale settings. Locations affect formatting of addresses in the  mode when
addresses are not formatted using their Countries.

An example of getting country location from locale settings is below:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    // US or some other code of the country
    $country = $locale->getCountry();


Additional locale data is available in the Locale Settings. Using this data based on the country, you can access the following information:

* currency code
* phone prefix
* default locale

This data is loaded from bundle's ``./Resources/config/oro/locale_data.yml`` file. Other bundles can provide their files
to extend this data. An example of the locale_data.yml file:

.. code-block:: yaml

    AD:
        currency_code: EUR
        phone_prefix: '376'
        default_locale: ca
    AE:
        currency_code: AED
        phone_prefix: '971'
        default_locale: ar_AE

Time Zone
---------

All dates in application are stored in UTC time zone. When dates are displayed on the UI they are formatted via date/time
formatter. This formatter uses time zone setting from Locale Settings to display date times with respect of time zone.

See the |List of available timezones in PHP|.

An example of getting the time zone from the Locale settings is below:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    // America/Los_Angeles or some other time zone
    $timeZone = $locale->getTimeZone();

Currencies
----------

Locale Settings stores default currency of application. The :ref:`number formatter <bundle-docs-platform-locale-bundle-number-formatting>` uses it for
formatting when currency is not specified.

An example of getting the currency from the Locale Settings:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    // USD or some other currency code
    $currency = $localeSettings->getCurrency();

An example of getting the currency symbol by the currency code:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    // $
    $symbol = $localeSettings->getCurrencySymbolByCurrency('USD');

Names Formats
-------------

This data is used by :ref:`name formatter <bundle-docs-platform-locale-bundle-name-formatting>`. Locale settings can gets the full list of name formats
that are available:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    $nameFormats = $localeSettings->getNameFormats();

Name formats are loaded from bundle's file ``./Resources/config/oro/name_format.yml``. Other bundles could provide their files
to extend name formats configuration.

Example of name_format.yml file:

.. code-block:: yaml

    en: "%prefix% %first_name% %middle_name% %last_name% %suffix%"
    en_US: "%prefix% %first_name% %middle_name% %last_name% %suffix%"
    ru: "%last_name% %first_name% %middle_name%"
    ru_RU: "%last_name% %first_name% %middle_name%"

See name formats in the :ref:`Name Formatting topic <bundle-docs-platform-locale-bundle-name-formatting>`.

Addresses Formats
-----------------

This data is used by :ref:`address formatter <bundle-docs-platform-locale-bundle-address-formatting>`. Locale settings can gets the full list of addresses
formats that are available:

.. code-block:: php

    $localeSettings = $this->get('oro_locale.settings');
    $addressesFormats = $localeSettings->getAddressFormats();

Addresses formats are loaded from bundle's file ``./Resources/config/oro/address_format.yml``. Other bundles could provide
their files to extend address formats configuration.

Example of address_format.yml file:

.. code-block:: yaml

    AD:
        format: '%name%\n%organization%\n%street%\n%postal_code% %REGION%\n%COUNTRY%'
        require: [street, region]
        region_name_type: parish
    AE:
        format: '%name%\n%organization%\n%street%\n%city%\n%country%'
        require: [street, city]
    AG:
        require: [street]
    AM:
        format: '%name%\n%organization%\n%street%\n%postal_code%\n%city%\n%region%\n%country%'
        latin_format: '%name%\n%organization%\n%street%\n%postal_code%\n%city%\n%region%\n%country%'

See address formats in the :ref:`Address Formatting topic <bundle-docs-platform-locale-bundle-address-formatting>`.

Localization Dumping
--------------------

Localization information is stored in ``*.yml`` files in appropriate bundles, but during installation these data is dumped to container parameters (on backend) and to file ``oro.locale_data.js`` (on frontend).

If a user wants to regenerate these dumped information, they need to execute two commands - ``cache:clear`` to clear the cache and ``oro:localization:dump`` to dumps locale settings for use in JavaScript:

.. code-block:: php

    $ php bin/console cache:clear
    Clearing the cache for the dev environment with debug true
    $ php bin/console oro:localization:dump
    17:28:34 [file+] oro.locale_data.js


First command will update all application cache including container parameters, second command will build ``*.js`` file that contain all localization information used on frontend.

.. include:: /include/include-links-dev.rst
   :start-after: begin