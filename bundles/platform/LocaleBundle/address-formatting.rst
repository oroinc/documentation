.. _bundle-docs-platform-locale-bundle-address-formatting:

Address Formatting
==================

Formats Source
--------------

You can find address formats in the `address_format.yml` file. Address formats are grouped by country.

An example of format configuration for the US:

.. code-block:: yaml

    US:
        format: '%name%\n%organization%\n%street%\n%CITY% %REGION_CODE% %COUNTRY_ISO2% %postal_code%'

Possible format placeholders:

* *name* - address owner name
* *organization* - organization
* *street* - street
* *street2* - street line 2
* *city* - city
* *country* - country name
* *country_iso2* - country ISO2 code
* *country_iso3* - country ISO3 code
* *postal_code* - postal/ZIP code
* *region* - region
* *region_code* - region code

When a format placeholder is in the upper case, the corresponding value will also be uppercased.
Address formatter uses name formatter to format names according to the address country locale.

Additional optional data that is not currently used in the LocaleBundle is also stored in the address_format.yml stored. Possible keys are:

* *latin_format* - address format for latin characters
* *require* - an array of required address fields for country
* *region_name_type* - how a region is named in a country
* *zip_name_type* - how post code (zip) is named in a country
* *format_charset* - format charset encoding
* *postprefix* - post code prefix

PHP Address Formatter
---------------------

**Class:** ``Oro\Bundle\LocaleBundle\Formatter\AddressFormatter``

**Service id:** oro_locale.formatter.address

Formats addresses are based on the given country address format. By default, the address country is used for formatting.

Methods and Usage Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^

format
~~~~~~

string ``*public* *format*(AddressInterface *address*[, string *country*[, string *newLineSeparator*]])``

You can use this method to format objects that implement AddressInterface.
To format an address using a specific country format, set the *country* parameters.
The *newLineSeparator* parameter defines the default line separator as \n and can also be changed.

.. code-block:: php

    $formatter = $container->get('oro_locale.formatter.address');
    // $region->getCode() is CA
    // $country->getIso2Code() is US
    $region->setCountry($country);
    $address = new Address();
    $address->setStreet('726 N. Vista Street');
    $address->setCity('Los Angeles');
    $address->setRegion($region);
    $address->setPostalCode('90046');
    $address->setOrganization('Oro Inc.');
    $address->setCountry($country);
    echo $formatter->format($address);


Outputs:

.. code-block:: none

    Oro Inc.
    726 N. Vista Street
    LOS ANGELES CA US 90046

getAddressFormat
~~~~~~~~~~~~~~~~

string ``*public* *getAddressFormat*([string *localeOrRegion*])``

Get address format based on the locale or region; if the argument is not passed, locale from the system configuration will be used.

Twig
----

Filters
^^^^^^^

oro_format_address
~~~~~~~~~~~~~~~~~~

This filter uses the *format* method from the address formatter and has the same logic.

.. code-block:: none

   {{ address|oro_format_address('US') }}


oro_format_address_html
~~~~~~~~~~~~~~~~~~~~~~~

This filter outputs a formatted address where each address part (i.e., city, country, etc.) is wrapped into an HTML tag with CSS class ``address-part-PART-NAME`` and attribute ``data-part="PART_NAME"`` to allow more fine-grained control of address styling.

.. code-block:: none

   {{ address|oro_format_address_html('US') }}


JS
--

Methods and Usage Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^

format
~~~~~~

string ``*public* *format*(Object *address*[, String *country*[, String|Function *newLine*]])``

This method is used to format addresses.
To format an address using a specific country format, set the *country* parameters.

The *newLine* parameter defines the default line separator. It can be a string that will be used as a line separator or
a function that will be called for each line and must return string.

Possible address object parameters are:

* *prefix* - name prefix
* *suffix* - name suffix
* *first_name* - first name
* *middle_name* - middle name
* *last_name* - last name
* *organization* - organization
* *street* - street
* *street2* - street line 2
* *city* - city
* *country* - country name
* *country_iso2* - country ISO2 code
* *country_iso3* - country ISO3 code
* *postal_code* - postal/ZIP code
* *region* - region
* *region_code* - region code

Example:

.. code-block:: javascript

    import addressFormatter from 'orolocale/js/formatter/address';

    const data = addressModel.toJSON();

    data.formatted_address = addressFormatter.format({
        prefix: data.namePrefix,
        suffix: data.nameSuffix,
        first_name: data.firstName,
        middle_name: data.middleName,
        last_name: data.lastName,
        organization: data.organization,
        street: data.street,
        street2: data.street2,
        city: data.city,
        country: data.country,
        country_iso2: data.countryIso2,
        country_iso3: data.countryIso3,
        postal_code: data.postalCode,
        region: data.region,
        region_code: data.regionCode
    });

getAddressFormat
~~~~~~~~~~~~~~~~

string ``*public* *getAddressFormat*([string *country*])``

getAddressFormat is based on country; if the argument is not passed, the default country from system configuration is used.
