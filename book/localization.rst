Localization
============

Localization is the process of translating and adapting a product for a specific country or region. 
OroPlatform localization allows a user to customize date/time/datetime formats, numeric and percent values, 
monetary values as well as name and address formats.


System Configuration
--------------------

The Oro Platform system configuration which is available the System > Configuration menu has a special "Localization" 
section that defines localization parameters. Let's take a look at them:

.. image:: ./img/localization/system_configuration.png


- **Locale** defines the current system locale and is used to format date/time/datetime, numeric and percent values, monetary values and appropriate name formats.
- **Primary Location** usually refers to the current country and is used to define appropriate address formats and default currency.
- **Format address per country** is a flag used to define whether an address should be formatted by using the rules of its country, or if the primary location should be used instead.
- **First Quarter Starts on** defines the first day of the first quarter.  This value can be used in reports.
- **Timezone** defines which timezone should be used to render time and datetime values.
- **Currency** specifies the currency in monetary fields throughout the system.
- The **Temperature Unit** and **Wind Speed Unit** are used to render additional information on location maps.


Configuration files
-------------------

Localization information is located in configuration files. Each bundle can add its own localization information 
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

This file contains the most basic information for countries ("US" and "RU" are country codes). 
Each country configuration has information about that country’s currency, phone prefix and default country 
locale (e.g. the locale is used to define the appropriate name format by country for specific address).

Resources/config/oro/currency_data.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    USD:
        symbol: $
    RUB:
        symbol: руб.

This file defines currency symbols for each currency code. These symbols are used to render currency symbols 
when viewing or editing monetary fields.

Resources/config/oro/name_format.yml
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml

    en: %prefix% %first_name% %middle_name% %last_name% %suffix%
    ru: %last_name% %first_name% %middle_name%

This file specifies a name format by locale. Allowed placeholders are:

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

This file specifies the name format for addresses and, optionally, some additional address information. 
Each placeholder can be lowercase (data will be rendered as is) or uppercase (data will be rendered in upper case). 
Allowed placeholders are:

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

Both dates and numbers (decimal, percent or currency) are formatted using `INTL library`_ functions.  
This library is therefore required and dates and numbers are formatted according to the version of the library 
which is installed.

.. _INTL library: http://www.php.net/manual/en/intro.intl.php

The application provides formatter services that can be used to format dates and numbers in the backend which 
are actually simple wrappers for INTL library. Here are the formatter classes and their methods:

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

.. code-block:: text

    {{ entity.createdAt|oro_format_datetime }}
    {{ item.value|oro_format_currency }}

For example, for en locale and USD currency such template will return the following values:

.. code-block:: text

    May 28, 2014 1:40 PM
    $5,103.00

In addition to backend formatters, the application also provides similar formatters on the frontend side 
which are powered by JavaScript and can be accessed using requirejs aliases. 
Here are the JavaScript formatters and their functions:

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

Some entities in the application may have names that require localization before they’re rendered. 
Localization includes the formatting of name parts according to a specified format  
(see `Resources/config/oro/name_format.yml`_).

On the backend side, such an entity must implement the name interface 
``Oro/Bundle/LocaleBundle/Model/FullNameInterface.php``.  
This interface contains methods to extract all name parts, including the name prefix, first name, middle name, 
last name and name suffix. Further, there are separate interfaces for each name part that can be used in cases 
where an entity may have only certain specific parts.

On backend side formatting is applied by ``Oro/Bundle/LocaleBundle/Formatter/NameFormatter.php``. 
This formatter has a method, ``format(person)``, that receives an entity and returns a string with a formatted name.

The same formatting can be used in twig templates with the ``oro_format_name`` filter. Here is an example:

.. code-block:: text

    {{ entity|oro_format_name }}

For the en locale, such formatting will return the following value in the template:

.. code-block:: text

    Mr. John S Doe Jr.

On the frontend side, the same formatting can be performed with the ``orolocale/js/formatter/name`` 
requirejs module which is located in ``Oro/Bundle/LocaleBundle/Resources/public/js/formatter/name.js``.  
This module has a similar format(person) method which can be used to format a person object.


Address Formatting
------------------

Other entities may represent addresses that should be appropriately formatted before they are rendered. 
The application provides a list of default address formats for several countries  
(see `Resources/config/oro/address_format.yml`_).
Further, an address entity may have person fields and implement the ``FullNameInterface`` interface. 
In this case, the name will be rendered according to the default country locale and used instead 
of an appropriate placeholder.

To support formatting, an address entity should implement the ``Oro\Bundle\LocaleBundle\Model\AddressInterface`` 
address interface which has methods to retrieve all required address parts 
(street, city, region name/code, postal code, country name/ISO2/ISO3 and organization.)

The backend formatter, ``Oro\Bundle\LocaleBundle\Formatter\AddressFormatter``, provides a ``format(address)`` 
method which returns a string representation of an address that can include default new line separators (n).

To use this formatter in a template, use the ``oro_format_address`` filter, e.g.:

.. code-block:: text

    {{ address|oro_format_address }}

When used with the USA, such an address will be rendered like so:

.. code-block:: text

    Mr. Roy K Greenwell
    Products Inc.
    2413 Capitol Avenue
    ROMNEY IN US 47981

As with other entities, the frontend provides an appropriate JavaScript formatter, 
the ``orolocale/js/formatter/address`` requirejs module.  This module is located in 
``Oro/Bundle/LocaleBundle/Resources/public/js/formatter/address.js``, and contains a ``format(address)`` 
method which behaves exactly like the backend formatter does.
