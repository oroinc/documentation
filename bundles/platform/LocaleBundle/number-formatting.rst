.. _bundle-docs-platform-locale-bundle-number-formatting:

Number Formatting
=================

PHP Number Formatter
--------------------

**Class:** ``Oro\Bundle\LocaleBundle\Formatter\NumberFormatter``

**Service id:** oro_locale.formatter.number

This class formats different styles of numbers in localized format and proxies intl extension class |NumberFormatter|.

Constants
---------

Methods of Number Formatter can receive values of original intl NumberFormatter constants.

Each constant can be passed to an appropriate method of Number Formatter as a string name, for example, case insensitive: "DECIMAL_SEPARATOR_SYMBOL", "currency_code".

Constants can be divided into the following logical groups:

Format Style Constants
^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    \NumberFormatter::PATTERN_DECIMAL
    \NumberFormatter::DECIMAL
    \NumberFormatter::CURRENCY
    \NumberFormatter::PERCENT
    \NumberFormatter::SCIENTIFIC
    \NumberFormatter::SPELLOUT
    \NumberFormatter::ORDINAL
    \NumberFormatter::DURATION
    \NumberFormatter::PATTERN_RULEBASED
    \NumberFormatter::IGNORE
    \NumberFormatter::DEFAULT_STYLE

Numeric Attribute Constants
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    \NumberFormatter::PARSE_INT_ONLY
    \NumberFormatter::GROUPING_USED
    \NumberFormatter::DECIMAL_ALWAYS_SHOWN
    \NumberFormatter::MAX_INTEGER_DIGITS
    \NumberFormatter::MIN_INTEGER_DIGITS
    \NumberFormatter::INTEGER_DIGITS
    \NumberFormatter::MAX_FRACTION_DIGITS
    \NumberFormatter::MIN_FRACTION_DIGITS
    \NumberFormatter::FRACTION_DIGITS
    \NumberFormatter::MULTIPLIER
    \NumberFormatter::GROUPING_SIZE
    \NumberFormatter::ROUNDING_MODE
    \NumberFormatter::ROUNDING_INCREMENT
    \NumberFormatter::FORMAT_WIDTH
    \NumberFormatter::PADDING_POSITION
    \NumberFormatter::SECONDARY_GROUPING_SIZE
    \NumberFormatter::SIGNIFICANT_DIGITS_USED
    \NumberFormatter::MIN_SIGNIFICANT_DIGITS
    \NumberFormatter::MAX_SIGNIFICANT_DIGITS
    \NumberFormatter::LENIENT_PARSE

Text Attribute Constants
^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

\NumberFormatter::POSITIVE_PREFIX
\NumberFormatter::POSITIVE_SUFFIX
\NumberFormatter::NEGATIVE_PREFIX
\NumberFormatter::NEGATIVE_SUFFIX
\NumberFormatter::PADDING_CHARACTER
\NumberFormatter::CURRENCY_CODE
\NumberFormatter::DEFAULT_RULESET
\NumberFormatter::PUBLIC_RULESETS

Format Symbol Constants
^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    \NumberFormatter::DECIMAL_SEPARATOR_SYMBOL
    \NumberFormatter::GROUPING_SEPARATOR_SYMBOL
    \NumberFormatter::PATTERN_SEPARATOR_SYMBOL
    \NumberFormatter::PERCENT_SYMBOL
    \NumberFormatter::ZERO_DIGIT_SYMBOL
    \NumberFormatter::DIGIT_SYMBOL
    \NumberFormatter::MINUS_SIGN_SYMBOL
    \NumberFormatter::PLUS_SIGN_SYMBOL
    \NumberFormatter::CURRENCY_SYMBOL
    \NumberFormatter::INTL_CURRENCY_SYMBOL
    \NumberFormatter::MONETARY_SEPARATOR_SYMBOL
    \NumberFormatter::EXPONENTIAL_SYMBOL
    \NumberFormatter::PERMILL_SYMBOL
    \NumberFormatter::PAD_ESCAPE_SYMBOL
    \NumberFormatter::INFINITY_SYMBOL
    \NumberFormatter::NAN_SYMBOL
    \NumberFormatter::SIGNIFICANT_DIGIT_SYMBOL
    \NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL

Methods and Usage Examples
--------------------------

format
^^^^^^

string ``*public* *format*(mixed *value*, string|int *style*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

This method can be used to format any style of numbers that are passed directly as the second argument.
A list of custom attributes, text attributes, symbols and locale can be passed as well.

.. code-block:: php

    // Simple usage default locale and related number format will be used
    echo $numberFormatter->format(1234.56789, \NumberFormatter::DECIMAL);
    // outputs: "1,234.568" if default locale is en_US

    // Use custom attributes and custom locale
    echo $numberFormatter->format(
        -100000.123,
        \NumberFormatter::DECIMAL,
        'attributes' => [\NumberFormatter::GROUPING_SIZE => 4],
        'textAttributes' => [\NumberFormatter::NEGATIVE_PREFIX => 'MINUS '],
        'symbols' => [
            \NumberFormatter::DECIMAL_SEPARATOR_SYMBOL => ',',
            \NumberFormatter::GROUPING_SEPARATOR_SYMBOL => '.',
        ],
    );
    // outputs: "MINUS 10.0000,123"

formatCurrency
^^^^^^^^^^^^^^

string ``*public* *formatCurrency*(mixed *value*, string *currency*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats currency number. Currency code should be specified, otherwise default currency string ``*public* *formatCurrency*(mixed *value*, string *currency*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])`` is used.

.. code-block:: php

    // Using default locale and currency
    echo $numberFormatter->formatCurrency(1234.56789);
    // outputs: "$1,234.57" if default locale is en_US and currency is 'USD'

    // Specify custom currency and locale
    echo $numberFormatter->formatCurrency(1234.56789, 'EUR', [], [], [], 'ru_RU');
    // outputs: "1 234,57 €"

formatDecimal
^^^^^^^^^^^^^

string ``*public* *formatDecimal*(mixed *value*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats decimal number.

.. code-block:: php

    // Using default locale and format
    echo $numberFormatter->formatDecimal(1234.56789);
    // outputs: "1,234.568" if default locale is en_US and currency is 'USD'

    // Specify custom locale and attributes
    echo $numberFormatter->formatDecimal(
        1234.56789,
        'attributes' => ['fraction_digits' => 10],
        'textAttributes' => ['positive_prefix' => '+',],
        'symbols' => [\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL => ',', \NumberFormatter::GROUPING_SEPARATOR_SYMBOL => ' '],
        'en_US'
    );
    // outputs: "+12 345,6789000000"


formatPercent
^^^^^^^^^^^^^

string ``*public* *formatPercent*(mixed *value*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats percent number.

.. code-block:: php

    echo $numberFormatter->formatPercent(1);
    // outputs: "100%"

    echo $numberFormatter->formatPercent(.567, [], [], [], 'en_US');
    // outputs: "56,7%"


formatSpellout
^^^^^^^^^^^^^^

string ``*public* *formatSpellout*(mixed *value*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats spellout number. If locale is not specified, the  default one will be used.

.. code-block:: php

    echo $numberFormatter->formatSpellout(1);
    // outputs: "one"

    echo $numberFormatter->formatSpellout(21, [], [], [], 'en_US');
    // outputs: "twenty-one"

formatDuration
^^^^^^^^^^^^^^

string ``*public* *formatDuration*(mixed *value*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats duration number. If locale is not specified, the default one is used.

.. code-block:: php

    echo $numberFormatter->formatDuration(3661);
    // outputs: "1:01:01"

    echo $numberFormatter->formatDuration(
        3661,
        [],
        [\NumberFormatter::DEFAULT_RULESET => "%with-words"],
        [],
        'en_US'
    );
    // outputs: "1 hour, 1 minute, 1 second"

formatOrdinal
^^^^^^^^^^^^^

string ``*public* *formatOrdinal*(mixed *value*[, array *attributes*[, array *textAttributes*[, array *symbols*[, string *locale*]]]])``

Formats ordinal number. If locale is not specified, the default one is used.

.. code-block:: php

    echo $numberFormatter->formatOrdinal(1);
    // outputs: "1st"

    echo $numberFormatter->formatOrdinal(3, [], [], [], 'en_US');
    // outputs: "3rd"

getAttribute
^^^^^^^^^^^^

int ``*public* *getAttribute*(string|int *attribute*[, string|int *style*[, string *locale*]])``

Gets numeric attribute of intl NumberFormatter related to passed locale. If locale is not passed, the default one is used.

.. code-block:: php

    echo $numberFormatter->getAttribute('parse_int_only', 'decimal', 'en_US');
    // outputs: 0

    echo $numberFormatter->getAttribute(\NumberFormatter::MAX_INTEGER_DIGITS, \NumberFormatter::DECIMAL, 'en_US');
    // outputs: 309

getTextAttribute
^^^^^^^^^^^^^^^^

string ``*public* *getTextAttribute*(string|int *textAttribute*[, string|int *style*[, string *locale*]])``

Gets text attribute of intl NumberFormatter related to passed locale. If locale is not passed, the default one is used.

.. code-block:: php

    echo $numberFormatter->getTextAttribute('negative_prefix', 'decimal', 'en_US');
    // outputs: "-"

    echo $numberFormatter->getTextAttribute(\NumberFormatter::\NEGATIVE_PREFIX, \NumberFormatter::CURRENCY, 'en_US');
    // outputs: "($"

getSymbol
^^^^^^^^^

string ``*public* *getSymbol*(string|int *symbol*[, string|int *style*[, string *locale*]])``

Gets symbol of intl NumberFormatter related to passed locale. If locale is not passed, default one will be used.

.. code-block:: php

    echo $numberFormatter->getSymbol('DECIMAL_SEPARATOR_SYMBOL', 'DECIMAL', 'en_US');
    // outputs: "."

    echo $numberFormatter->getSymbol(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL, \NumberFormatter::DECIMAL, 'en_US');
    // outputs: ","

Twig
----

Filters
^^^^^^^

Each filter can optionally receive attributes, textAttributes and symbols options. All possible options relates to
the names of constants of NumberFormatter:

The following filters are available in Twig templates:

oro_format_number
~~~~~~~~~~~~~~~~~

This filter formats a number to the localized format according to the passed number style and optional custom options:

Simple usage of this filter requires a style of number. The following values can be used: decimal, currency, percent, scientific, spellout, ordinal, duration.

This example outputs a string in localized format like this: 10,000.000

.. code-block:: none

   {{ 10000|oro_format_number('decimal') }}


This example outputs MINUS 10.0000,123 and shows what options could be passed to customize format.

.. code-block:: none

    {{ -100000.123|oro_format_number('decimal', {
        attributes: {grouping_size: 4},
        textAttributes: {negative_prefix: 'MINUS'},
        symbols: {decimal_separator_symbol: ',', grouping_separator_symbol: '.'},
        locale: 'en_US'
    }) }}

oro_format_currency
~~~~~~~~~~~~~~~~~~~

This filter formats currency number according to localized format.

Next example is a simple use case. If currency is not specified, the default one is used.
This line outputs a string like this $10,000.00 depending on locale settings.

.. code-block:: none

   {{ 100000|oro_format_currency }}


You can override formatting options. The following example demonstrates how custom options can be passed using this filter.

This line outputs a string: (1 2345.78 €)

.. code-block:: none

    {{ 12345.6789|oro_format_currency({
        currency: 'EUR',
        locale: 'ru_RU',
        attributes: {grouping_size: 4},
        textAttributes: {negative_prefix: '(', negative_suffix: ')'},
        symbols: {decimal_separator_symbol: '.'},
    }) }}


oro_format_decimal
~~~~~~~~~~~~~~~~~~

This filter formats decimal number according localized format.

This example outputs a string: 1,234.568

.. code-block:: none

   {{ 1234.56789|oro_format_decimal }}

You can override formatting options.
This snippet shows an example of using custom formatting options. It outputs the following string: +12 345,6789000000

.. code-block:: none

    {{ 1234.56789|oro_format_decimal({
        attributes: { fraction_digits: 10 },
        textAttributes: { positive_prefix: '+' },
        symbols: { decimal_separator: ',', grouping_separator: ' ' },
        locale: 'en_US'
    }) }}

oro_format_percent
~~~~~~~~~~~~~~~~~~

This filter formats percent number according localized format.

This example outputs a string: 100%

.. code-block:: none

   {{ 1|oro_format_percent }}

You can override formatting options.
This snippet shows an example of using custom formatting options. It outputs a string: +56,7 %

.. code-block:: none

    {{ .5671|oro_format_percent({
        attributes: { fraction_digits: 1 },
        textAttributes: { positive_prefix: '+' },
        symbols: { decimal_separator: ',' },
        locale: 'ru_RU'
    }) }}


oro_format_spellout
~~~~~~~~~~~~~~~~~~~

This filter formats a number in spellout style.

This example outputs a string: "one"

.. code-block:: none

   {{ 1|oro_format_spellout }}

This example demonstrates using custom locale in options. Other possible options are: attributes, textAttributes, symbols
like in all other Twig number formatters filters in this bundle.

This line outputs a string: twelve

.. code-block:: none

   {{ 1|oro_format_spellout({ locale: 'en_US' }) }}

oro_format_duration
~~~~~~~~~~~~~~~~~~~

This filter formats a number in duration style.

Example of simple usage, this line outputs a string: 1:01:01

.. code-block:: none

   {{ 3661|oro_format_duration }}

Next example demonstrates how custom options could be passed. Other possible options are: attributes and symbols
like in all other Twig number formatters filters in this bundle.

This line outputs a string: 1 hour, 1 minute, 1 second

.. code-block:: none

    {{ 3661|oro_format_duration({
        locale: 'en_US',
        textAttributes: { default_ruleset: '%with-words' }
    }) }}

oro_format_ordinal
~~~~~~~~~~~~~~~~~~

This filter formats a number in ordinal style.

Example of simple usage, this line outputs a string: 3rd

.. code-block:: none

   {{ 3|oro_format_ordinal }}

Next example demonstrates how custom options could be passed. Other possible options are: attributes, textAttributes and symbols
like in all other Twig number formatters filters in this bundle.

This line outputs a string: 4th

.. code-block:: none

    {{ 4|oro_format_ordinal({
        locale: 'en_US'
    }) }}

Functions
^^^^^^^^^

The following functions are available in Twig templates:

oro_locale_number_attribute
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Gets text attribute of intl NumberFormatter related to passed locale. If locale is not passed, the default one is  used.

See available values for arguments are:

* Format style constants
* Numeric attribute constants

This example uses the default locale and outputs the value of ``\NumberFormatter::PARSE_INT_ONLY`` for the given number style and locale.

.. code-block:: none

   {{ oro_locale_number_attribute('parse_int_only', 'decimal') }}

Custom locale can be passed in the third argument:

.. code-block:: none

   {{ oro_locale_number_attribute('max_integer_digits', 'decimal', 'en_US');

oro_locale_number_text_attribute
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Gets text attribute of intl NumberFormatter related to passed locale. If locale is not passed, the default one is used.

Available values for arguments are:

* Format style constants
* Text attribute constants

This example uses the default locale and outputs the value of ``\NumberFormatter::NEGATIVE_PREFIX`` for the given number style and locale.

.. code-block:: none

   {{ oro_locale_number_text_attribute('negative_prefix', 'decimal') }}

Custom locale can be passed in the third argument:

.. code-block:: none

   {{ oro_locale_number_text_attribute('negative_prefix', 'decimal', 'ru_RU') }}


oro_locale_number_symbol
~~~~~~~~~~~~~~~~~~~~~~~~

Gets symbol of intl NumberFormatter related to the passed locale. If locale is not passed, the default one is used.

Available values for arguments are:

* Format style constants
* Format symbol constants

This example uses the default locale and outputs the value of ``\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL`` for the given number style and locale.

.. code-block:: none

   {{ oro_locale_number_symbol('decimal_separator_symbol', 'decimal');

Custom locale can be passed in the third argument:

.. code-block:: none

   {{ oro_locale_number_symbol('decimal_separator_symbol', 'decimal', 'ru_RU') }}

JS
--

On JS side number formatter is available via module ``orolocale/js/formatter/number``.

Import it in your code like this:

.. code-block:: javascript

   import numberFormatter from 'orolocale/js/formatter/number';

This module provides the followig functions for different cases:

Functions
^^^^^^^^^

formatDecimal
~~~~~~~~~~~~~

Formats number to decimal localized format.

Example of usage:

.. code-block:: javascript

   import numberFormatter from 'orolocale/js/formatter/number';

   // 10,000.000 depending on locale settings
  console.log(numberFormatter.formatDecimal(10000)));


formatInteger
~~~~~~~~~~~~~

Formats number to integer localized format.

Example of usage:

.. code-block:: javascript

    import numberFormatter from 'orolocale/js/formatter/number';

    // 10,000 depending on locale settings
    console.log(numberFormatter.formatInteger(10000)));

formatPercent
~~~~~~~~~~~~~

Formats number to percent localized format.

Example of usage:

.. code-block:: javascript

    import numberFormatter from 'orolocale/js/formatter/number';

    // 50% depending on locale settings
    console.log(numberFormatter.formatPercent(.5)));

formatCurrency
~~~~~~~~~~~~~~

Formats number to currency localized format. If the currency is not specified, then the default one is used.

Example of usage:

.. code-block:: javascript

    import numberFormatter from 'orolocale/js/formatter/number';

    // ($50,000.45) depending on locale settings if default currency in USD
    console.log(numberFormatter.formatCurrency(-50000.45)));

    // €1,000.00 depending on locale settings
    console.log(numberFormatter.formatCurrency(1000, 'EUR')));

unformat
~~~~~~~~

Parses a number from a localized number string. Can be used to parse all styles of localized numbers.

Example of usage:

.. code-block:: javascript

    import numberFormatter from 'orolocale/js/formatter/number';

    // 50000.45 depending on locale settings
    console.log(numberFormatter.unformat('$50,000.45')));

    // 0.95 depending on locale settings
    console.log(numberFormatter.unformat('95%')));

    // -1000000.456 depending on locale settings
    console.log(numberFormatter.unformat('(1,000,000.456)')));

    // NaN
    console.log(numberFormatter.unformat('ssss')));

.. include:: /include/include-links-dev.rst
   :start-after: begin
