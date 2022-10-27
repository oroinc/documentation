.. _bundle-docs-platform-locale-bundle-name-formatting:

Name Formatting
===============

Format Source
-------------

Name formats can be found in name_format.yml. Name formats are grouped by locale.

An example of format configuration for en_US:

.. code-block:: yaml

   en_US: "%prefix% %first_name% %middle_name% %last_name% %suffix%"

Possible format placeholders:

* *prefix* - name prefix
* *first_name* - first name
* *middle_name* - middle name
* *last_name* - last name
* *suffix* - name suffix

When format placeholder is in upper case, the corresponding value will be also be uppercased.

PHP Name Formatter
------------------

**Class:** ``Oro\Bundle\LocaleBundle\Formatter\NameFormatter``

**Service id:** oro_locale.formatter.name

Formats name based on given locale.

Methods and Usage Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^

format
^^^^^^

string ``*public* *format*(*person*[, string *locale*])``

This method can be used to format objects that implement one of the following interfaces:

* *FirstNameInterface* - defines getter for first name
* *MiddleNameInterface* - defines getter for middle name
* *LastNameInterface* - defines getter for last name
* *NamePrefixInterface* - defines getter for name prefix
* *NameSuffixInterface* - defines getter for name suffix
* *FullNameInterface* - extends FirstNameInterface, MiddleNameInterface, LastNameInterface, NamePrefixInterface and NameSuffixInterface

To format a name using a specific locale format, pass *locale* parameters.

Format:

.. code-block:: yaml

   en_US: "%prefix% %first_name% %middle_name% %LAST_NAME% %suffix%"


Code:

.. code-block:: php

    $formatter = $container->get('oro_locale.formatter.name');
    // Person implements FullNameInterface
    $person->setNamePrefix('Mr.');
    $person->setFirstName('First');
    $person->setMiddleName('Middle');
    $person->setLastName('Last');
    $person->setNameSuffix('Sn.');
    echo $formatter->format($person, 'en_US');

Outputs:

.. code-block:: none

   Mr. First Middle LAST Sn.

getNameFormat
^^^^^^^^^^^^^

string ``*public* *getNameFormat*([string *locale*])``

Get the name format based on the locale; if the argument is not passed, locale from the system configuration is used.


.. _bundle-docs-platform-locale-bundle-format-name:

Twig
----

Filters
^^^^^^^

oro_format_name
~~~~~~~~~~~~~~~

This filter uses the *format* method from the name formatter, and has the same logic.

.. code-block:: none

  {{ user|oro_format_name }}

JS
--

Methods and Usage Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^

format
~~~~~~

string ``*public* *format*(Object *person*[, String *locale*])``

This method can be used to format names. To format a name using a specific locale, pass format *locale* parameters.

Possible name object parameters are the same as format placeholder keys.

Usage example:

.. code-block:: javascript

    import nameFormatter from 'orolocale/js/formatter/name';

    const formattedName = nameFormatter.format({
        prefix: 'Mr.',
        first_name: 'First',
        middle_name: 'Middle',
        last_name: 'Last',
        suffix: 'Sn.'
    });

getNameFormat
~~~~~~~~~~~~~

string ``*public* *getNameFormat*([string *locale*])``

Gets the name format based on the locale; if the argument is not passed, the locale from the system configuration is used.
