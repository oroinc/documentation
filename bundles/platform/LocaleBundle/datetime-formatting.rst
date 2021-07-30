.. _bundle-docs-platform-locale-bundle-date-time-formatting:

Date and Datetime Formatting
============================

PHP DateTime Formatter
----------------------

DateTime formatter provides methods that allow formatting of entered data.
Formatter uses standard Intl library format types to render values:

* \IntlDateFormatter::NONE;
* \IntlDateFormatter::SHORT;
* \IntlDateFormatter::MEDIUM;
* \IntlDateFormatter::LONG;
* \IntlDateFormatter::FULL.

Each format uses its own localized format for date, time and datetime.
Default date format is \IntlDateFormatter::MEDIUM, default time format is \IntlDateFormatter::SHORT.

format
^^^^^^

**Signature:** ``format(\DateTime|string|int date, dateType = null, timeType = null, locale = null, timeZone = null, pattern = null)``

This functions provides most basic functionality to format date and time values.
It allows setting of date and time format types from Intl library, current locale as a string,
current timezone as a string and custom format pattern (in this case date and time format types will not be used).

.. code-block:: php

    echo $formatter->format(new \DateTime('2012-12-12 23:23:23'));
    // Dec 13, 2012 12:23 AM

    echo $formatter->format(new \DateTime('2012-12-12 23:23:23'), \IntlDateFormatter::FULL, \IntlDateFormatter::MEDIUM);
    // Thursday, December 13, 2012 12:23:23 AM

    echo $formatter->format(new \DateTime('2012-12-12 23:23:23'), null, null, 'ru');
    // 13.12.2012 0:23

    echo $formatter->format(new \DateTime('2012-12-12 23:23:23'), null, null, null, 'America/Los_Angeles');
    // Dec 12, 2012 1:23 PM

    echo $formatter->format(new \DateTime('2012-12-12 23:23:23'), null, null, null, null, 'yyyy-MM-dd|HH:mm:ss');
    // 2012-12-13|00:23:23


formatDate
^^^^^^^^^^

**Signature:** ``formatDate(\DateTime|string|int date, dateType = null, locale = null, timeZone = null)``

This function formats date value using _format_ function described above.
It receives date value, date format type from Intl library, current locale and current timezone.

.. code-block:: php

    echo $formatter->formatDate(new \DateTime('2012-12-12 23:23:23'));
    // Dec 13, 2012

    echo $formatter->formatDate(new \DateTime('2012-12-12 23:23:23'), \IntlDateFormatter::FULL);
    // Thursday, December 13, 2012

    echo $formatter->formatDate(new \DateTime('2012-12-12 23:23:23'), null, 'ru');
    // 13.12.2012

    echo $formatter->formatDate(new \DateTime('2012-12-12 23:23:23'), null, null, 'America/Toronto');
    // Dec 12, 2012

formatTime
^^^^^^^^^^

**Signature:** ``formatTime(\DateTime|string|int date, dateType = null, locale = null, timeZone = null)``

This function formats time value using the `format` function described above.
It receives the time value, the time format type from the Intl library, the current locale and the current timezone.

.. code-block:: php

    echo $formatter->formatTime(new \DateTime('2012-12-12 23:23:23'));
    // 12:23 AM

    echo $formatter->formatTime(new \DateTime('2012-12-12 23:23:23'), \IntlDateFormatter::FULL);
    // 12:23:23 AM GMT+02:00

    echo $formatter->formatTime(new \DateTime('2012-12-12 23:23:23'), null, 'ru');
    // 0:23

    echo $formatter->formatTime(new \DateTime('2012-12-12 23:23:23'), null, null, 'America/Toronto');
    // 4:23 PM


getPattern
^^^^^^^^^^

**Signature:** ``getPattern($dateType, $timeType, $locale = null)``

Returns the Intl library pattern for the specified date and time format types and locale.

.. code-block:: php

    echo $formatter->getPattern(\IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    // EEEE, MMMM d, y h:mm:ss a zzzz

    echo $formatter->getPattern(\IntlDateFormatter::FULL, \IntlDateFormatter::FULL, 'ru');
    // EEEE, d MMMM y 'г'. H:mm:ss zzzz


PHP DateTime Format Converters
------------------------------


OroPlatform application contains several libraries that work with datetime values.
Each library has its own datetime format placeholders, so to unify the approach to generate localized format strings
for all libraries, the LocaleBundle provides format converters.

For each used library, there must be a format converter containing rules of converting standard internal format to specific library format. Intl library format is used for internal format representation. Each format converter has an alias specified as an alias in the service configuration
and used to extract it from the registry.

The main entry point for a developer is a converter registry (DateTimeFormatConverterRegistry). It collects and stores existing format converters and allows to receive the appropriate converter by its alias.

LocaleBundle contains following format converters:

- intl (IntlDateTimeFormatConverter) - the default format converter that returns Intl formats;
- moment (MomentDateTimeFormatConverter) - the format converter for moment.js library.

The bundle also contains interface DateTimeFormatConverterInterface that all format converters must implement. Here is a list of interface functions.meFormatConverterInterface that must be implemented by all format converters.
Here is list of interface functions.

getDateFormat
^^^^^^^^^^^^^

**Signature:** getDateFormat(dateFormat = null, locale = null)

Returns localized date format for a specific library. Optionally receives date format type from the Intl library and custom locale.

.. code-block:: php

    echo $converterRegistry->getFormatConverter('intl')->getDateFormat();
    echo $converterRegistry->getFormatConverter('moment')->getDateFormat();
    // MMM d, y
    // MMM D, YYYY

    echo $converterRegistry->getFormatConverter('intl')->getDateFormat(\IntlDateFormatter::FULL, 'ru');
    echo $converterRegistry->getFormatConverter('moment')->getDateFormat(\IntlDateFormatter::FULL, 'ru');
    // EEEE, d MMMM y 'г'.
    // dddd, D MMMM YYYY [г].


getTimeFormat
^^^^^^^^^^^^^

**Signature:** ``getTimeFormat(timeFormat = null, locale = null)``

Returns localized time format for a specific library. Optionally receives time format type from Intl library and custom locale.

.. code-block:: php

    echo $converterRegistry->getFormatConverter('intl')->getTimeFormat();
    echo $converterRegistry->getFormatConverter('moment')->getTimeFormat();
    // h:mm a
    // h:mm A

    echo $converterRegistry->getFormatConverter('intl')->getTimeFormat(\IntlDateFormatter::MEDIUM, 'ru');
    echo $converterRegistry->getFormatConverter('moment')->getTimeFormat(\IntlDateFormatter::MEDIUM, 'ru');
    // H:mm:ss
    // H:mm:ss


getDateTimeFormat
^^^^^^^^^^^^^^^^^

**Signature:** ``getDateTimeFormat(dateFormat = null, timeFormat = null, locale = null)``

Returns localized datetime format for a specific library. Optionally receives date and time format types from Intl library and custom locale.

.. code-block:: php

    echo $converterRegistry->getFormatConverter('intl')->getDateTimeFormat();
    echo $converterRegistry->getFormatConverter('moment')->getDateTimeFormat();
    // MMM d, y h:mm a
    // MMM D, YYYY h:mm A

    echo $converterRegistry->getFormatConverter('intl')->getDateTimeFormat(
        \IntlDateFormatter::FULL,
        \IntlDateFormatter::MEDIUM,
        'ru'
    );
    echo $converterRegistry->getFormatConverter('moment')->getDateTimeFormat(
        \IntlDateFormatter::FULL,
        \IntlDateFormatter::MEDIUM,
        'ru'
    );
    // EEEE, d MMMM y 'г'. H:mm:ss
    // dddd, D MMMM YYYY [г]. H:mm:ss


Twig Extensions
---------------

LocaleBundle has two twig extensions that provide formatter filters and format converter functions.

Formatter Filters
^^^^^^^^^^^^^^^^^

Twig extension DateTimeExtension has the following functions:

oro_format_date
~~~~~~~~~~~~~~~

Proxy for [formatDate](#formatdate) function of DateTimeFormatter, receives date value as the first argument
and an array of options as the second argument. Allowed options:

* dateType,
* locale,
* timezone.

.. code-block:: none

    {{ entity.lastLogin|oro_format_date }}
    {# Nov 6, 2013 #}

    {{ entity.lastLogin|oro_format_date({'locale': 'ru'}) }}
    {# 06.11.2013 #}

To format the date given from the `Date` sql type, omit the `timeZone` option, for example:

.. code-block:: none

   value|oro_format_date`


To format the date part of the `DateTime` sql type value, specify the timeZone directly, for example:

.. code-block:: none

   value|oro_format_date({'timeZone': oro_timezone()})

oro_format_time
~~~~~~~~~~~~~~~

It is the proxy for the formatTime function of DateTimeFormatter, it receives the time value as the first argument
and an array of options as the second argument. Allowed options are:

* timeType,
* locale,
* timezone.

.. code-block:: none

    {{ entity.lastLogin|oro_format_time }}
    {# 7:44 PM #}

    {{ entity.lastLogin|oro_format_time({'locale': 'ru'}) }}
    {# 19:44 #}

To format the time given from the `Time` sql type, omit the `timeZone` option, for example:

.. code-block:: none

   value|oro_format_time`

To format the time part of the `DateTime` sql type value, specify the timeZone directly, for example:

.. code-block:: none

   value|oro_format_time({'timeZone': oro_timezone()})


oro_format_datetime
~~~~~~~~~~~~~~~~~~~

It is the opoxy for format function of DateTimeFormatter, it receives the datetime value as the first argument
and an array of options as the second argument. Allowed options are:

* dateType,
* timeType,
* locale,
* timezone.

.. code-block:: none

    {{ entity.lastLogin|oro_format_datetime }}
    {# Nov 6, 2013 7:44 PM #}

    {{ entity.lastLogin|oro_format_datetime({'locale': 'ru'}) }}
    {# 06.11.2013 19:44 #}

To format the date and time given from the `Date` or `Time` sql types, omit the `timeZone` option, for example:

.. code-block:: none

  value|oro_format_datetime`


To format the date and time of the `DateTime` sql type value, specify the timeZone directly, for example:

.. code-block:: none

    value|oro_format_datetime({'timeZone': oro_timezone()})

Format Converter Functions
^^^^^^^^^^^^^^^^^^^^^^^^^^

Twig extension DateFormatExtension has the following functions:

oro_date_format
~~~~~~~~~~~~~~~

It receives format converter alias, the date format type and the custom locale, and returns the date format from the appropriate format converter.

.. code-block:: none

    {{ oro_date_format('moment') }}
    {# MMM D, YYYY #}

    {{ oro_date_format('moment', null, 'ru') }}
    {# DD.MM.YYYY #}

oro_time_format
~~~~~~~~~~~~~~~

It receives the format converter alias, the time format type and the custom locale, and returns the time format from the appropriate format converter.

.. code-block:: none

    {{ oro_time_format('moment') }}
    {# h:mm A #}

    {{ oro_time_format('moment', null, 'ru') }}
    {# H:mm #}


oro_datetime_format
~~~~~~~~~~~~~~~~~~~

It receives the format converter alias, the date and time format types and the custom locale, and returns the time format from the appropriate format converter.

.. code-block:: none

    {{ oro_datetime_format('moment') }}
    {# MMM D, YYYY h:mm A #}

    {{ oro_datetime_format('moment', null, null, 'ru') }}
    {# DD.MM.YYYY H:mm #}

oro_datetime_formatter_list
~~~~~~~~~~~~~~~~~~~~~~~~~~~

It returns an array of all registered format converter aliases.

.. code-block:: none

   {{ oro_datetime_formatter_list()|join(', ') }}
   {# intl, moment, jquery_ui, fullcalendar #}


JS DateTime Formatter
---------------------

From the frontend side, JavaScript datetime converter provides functions to format datetime values.
The formatter uses library moment.js to work with the datetime values and localized formats injected from the locale settings configuration.

The formatter works with two string representations of the datetime values:

* frontend, which is localized format in the current timezone, and
* backend , which is ISO format data in UTC (for date) or with direct timezone specification (for datetime).

The formatter provides the following functions.

**getDateFormat(), getTimeFormat(), getDateTimeFormat()**

It returns the appropriate localized frontend format for the moment.js library received from the locale settings configuration.

.. code-block:: javascript

    console.log(datetimeFormatter.getDateTimeFormat());
    // MMM D, YYYY h:mm A


**isDateValid(value), isTimeValid(value), isDateTimeValid(value)**

It checks whether the input value has a valid format and can be parsed to the internal date representation.

.. code-block:: javascript

    console.log(datetimeFormatter.isDateValid('qwerty'));
    // false

    console.log(datetimeFormatter.isDateTimeValid('oct 12 2013 12:12 pm'));
    // true

**formatDate(value), formatTime(value), formatDateTime(value)**

It receives either the Date object or a valid ISO string and returns the value string in localized format.
It throws an exception if the string is invalid.

.. code-block:: javascript

    console.log(datetimeFormatter.formatDate('2013-12-12'));
    // Dec 12, 2013

    console.log(datetimeFormatter.formatDateTime(new Date()));
    // Nov 6, 2013 7:32 PM

**convertDateToBackendFormat(value), convertTimeToBackendFormat(value), convertDateTimeToBackendFormat(value, timezoneOffset)**

It receives localized string data and converts it in to an ISO format string.
*convertDateTimeToBackendFormat* can optionally receive the timezone offset; if no offset is set, the default offset is used.
It throws an exception if the string is invalid.

.. code-block:: javascript

    console.log(datetimeFormatter.convertDateToBackendFormat('Dec 12, 2013'));
    // 2013-12-12

    console.log(datetimeFormatter.convertDateTimeToBackendFormat('Nov 6, 2013 7:32 PM'));
    // 2013-11-06T19:32:00+0200

**getMomentForBackendDate(value), getMomentForBackendTime(value), getMomentForBackendDateTime(value)**

It receives either the Date object or a valid ISO string and returns the moment object instance.
It throws an exception if the string is invalid.

**getMomentForFrontendDate(value), getMomentForFrontendTime(value), getMomentForFrontendDateTime(value[, timezoneOffset])**

It receives a valid formatted string and returns the moment object instance.
It throws an exception if the string is invalid.

**unformatDate(value), unformatTime(value), unformatDateTime(value[, timezoneOffset])**

It receives a valid formatted string and returns the Date object instance.
It throws an exception if the string is invalid.

**unformatBackendDate(value), unformatBackendTime(value), unformatBackendDateTime(value)**

It receives either Date object or valid ISO string and returns Date object instance.
It throws an exception if the string is invalid.
