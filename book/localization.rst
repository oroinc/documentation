Localization
============

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

- **orolocale/js/formatter/datetime** (Oro/Bundle/LocaleBundle/Resources/public/js/formatter/datetime.js)
    * formatDate(value)
    * formatTime(value)
    * formatDateTime(value)
- **orolocale/js/formatter/number** (Oro/Bundle/LocaleBundle/Resources/public/js/formatter/number.js)
    * formatDecimal(value)
    * formatInteger(value)
    * formatPercent(value)
    * formatCurrency(value)


Name Formatting
---------------

Some entities in application might have names that requires localization before rendering. Localization includes
formatting of name parts according to specified format (see `Resources/config/oro/name_format.yml`_).

On backend side such entity must implement name interface **Oro/Bundle/LocaleBundle/Model/FullNameInterface.php** -
it contain methods to extract all name parts - name prefix, first name, middle name, last name and name suffix.
Also there are separate interfaces for each name part that can be used in case if entity might have only
some specific parts.

On backend side formatting is applied by **Oro/Bundle/LocaleBundle/Formatter/NameFormatter.php** - it has method
*format(person)* that receives entity and returns string with formatted name.

The same formatting can be used in twig templates with oro_format_name filter. Here is example:

.. code-block::

    {{ entity|oro_format_name }}

For en locale such template will return following value:

.. code-block::

    Mr. John S Doe Jr.

On frontend side the same formatting can be performed with requirejs module **orolocale/js/formatter/name**
(Oro/Bundle/LocaleBundle/Resources/public/js/formatter/name.js) that has similar method *format(person)*
to format input person object.


Address Formatting
------------------

Another entities might represent addresses that should be appropriately formatted before rendering. Application
provides list of default address formats for lots of countries (see `Resources/config/oro/address_format.yml`_).
Also address entity may have person fields and implement FullNameInterface interface - in this case name will be
rendered according to default country locale and placed instead of appropriate placeholder.

To support formatting address entity should implement address interface
**Oro/Bundle/LocaleBundle/Model/AddressInterface.php**, it has methods to get all required address parts -
street, city, region name/code, postal code, country name/ISO2/ISO3 and organization.

Backend formatter **Oro/Bundle/LocaleBundle/Formatter/AddressFormatter.php** provide method *format($address)* that
returns string representation of address, that might include default new line separators (\n).

To use this formatter in template developer should use oro_format_address filter, for example:

.. code-block::

    {{ address|oro_format_address }}

For USA country such address will be rendered like that:

.. code-block::

    Mr. Roy K Greenwell
    Products Inc.
    2413 Capitol Avenue
    ROMNEY IN US 47981

The same as for other entities frontend provides appropriate JavaScript formatter registered as requirejs module
**orolocale/js/formatter/address** (Oro/Bundle/LocaleBundle/Resources/public/js/formatter/address.js)
