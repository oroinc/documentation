System Localization
===================

Localization is a general approach used to translate and adapt a product for a specific country or region.
OroPlatform localization allows to customize date/time/datetime formats, numeric and percent values, money,
and name and address formats.


System Configuration
--------------------

OroPlatform system configuration that available in menu System > Configuration has special section "Localization"
that defines localization parameters. Let's look on this parameters.

.. image:: ./img/localization/system_configuration.png

**Locale** defines current system locale and used to format date/time/datetime, numeric and percent values,
money and appropriate name format.

**Primary Location** usually shows current country and used to define appropriate address format and default currency.

**Format address per country** flag used to define whether address should be formatted by it's own country,
or primary location should be used.

**First Quarter Starts on** defines first day of the first quarter, this value can be used in reports.

**Timezone** defines which timezone should be used to render time and datetime values.

**Currency** specifies used currency all over the system for money field representation.

**Temperature Unit** and **Wind Speed Unit** are used to render additional information on location maps.


Configuration files
-------------------

Localization information is localed in configuration files. Each bundle can adds it's own localization information
using appropriate files.

Resources/config/oro/locale_data.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    US:
        currency_code: USD
        phone_prefix: '1'
        default_locale: en_US
    RU:
        currency_code: RUB
        phone_prefix: '7'
        default_locale: ru

File contains most basic information for countries ("US" and "RU" are country codes). Each country configuration
has information about country currency, phone prefix and default country locale (f.e. locale is used to define
appropriate name format by country for specific address).

Resources/config/oro/currency_data.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    USD:
        symbol: $
    RUB:
        symbol: руб.

File defines currency symbols for each currency code. These symbols are used to render currency symbols on money field
view and edit.

Resources/config/oro/name_format.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    en: %prefix% %first_name% %middle_name% %last_name% %suffix%
    ru: %last_name% %first_name% %middle_name%

File specifies name format by locale. Allowed placeholders are:

- %prefix%
- %first_name%
- %middle_name%
- %last_name%
- %suffix%

Resources/config/oro/address_format.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    US:
        format: '%name%\n%organization%\n%street%\n%CITY% %REGION_CODE% %COUNTRY_ISO2% %postal_code%'
    RU:
        format: '%postal_code% %COUNTRY% %CITY%\n%STREET%\n%organization%\n%name%'

File specifies name format by addresses and, optionally, some additional address information. Each placeholder can be
lowercase (data will be rendered as is) or uppercase (data will be rendered in upper case). Allowed placeholders are:

- %name%
- %street%
- %city%
- %country%
- %country_iso2%
- %country_iso3%
- %region%
- %region_name%
- %region_code%
- %postal_code%
- %organization%


Date and Numeric Formatting
---------------------------

Both dates and numbers (decimal, percent, currency) are formatted using `INTL library`_ functions, so this library
is required and dates and number are formatted according to installed version.

.. _INTL library: http://www.php.net/manual/en/intro.intl.php

Application provides formatter services that can be used to format dates and numbers on backend - in fact, they are
simple wrappers for INTL library. Here are formatter classes and their methods:

- **Oro/Bundle/LocaleBundle/Formatter/DateTimeFormatter.php**
    * formatDate(\DateTime)
    * formatTime(\DateTime)
    * format(\DateTime)
- **Oro/Bundle/LocaleBundle/Formatter/NumberFormatter.php**
    * formatDecimal(value)
    * formatPercent(value)
    * formatCurrency(value)
    * formatSpellout(value)
    * formatDuration(value)
    * formatOrdinal(value)

These formatter methods can be used in twig templates as filters:

- oro_format_date
- oro_format_time
- oro_format_datetime
- oro_format_number
- oro_format_currency
- oro_format_decimal
- oro_format_percent
- oro_format_spellout
- oro_format_duration
- oro_format_ordinal

.. code-block::

    {{ entity.createdAt|oro_format_datetime }}
    {{ item.value|oro_format_currency }}

For example, for en locale and USD currency such template will return values:

.. code-block::

    May 28, 2014 1:40 PM
    $5,103.00

In addition to backend formatters application also provides similar formatters on frontend side from JavaScript.
They can be accessed by requirejs aliases. Here are JavaScript formatters and their functions:

- **orolocale/js/formatter/datetime** (Resources/public/js/formatter/datetime.js)
    * formatDate(value)
    * formatTime(value)
    * formatDateTime(value)
- **orolocale/js/formatter/number** (Resources/public/js/formatter/number.js)
    * formatDecimal(value)
    * formatInteger(value)
    * formatPercent(value)
    * formatCurrency(value)


Name Formatting
---------------


Address Formatting
------------------
