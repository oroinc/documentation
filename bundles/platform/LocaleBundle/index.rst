:oro_show_local_toc: false

.. _bundle-docs-platform-locale-bundle:

OroLocaleBundle
===============

|OroLocaleBundle| enables the locale management and a data localization support.

This bundle provides the next localization tools:

* numbers and datetime formatting (intl is used)
* person names and postal addresses formatting
* dictionary of currencies, phone prefixes and default locales of countries

It provides such locale settings of the application as:

* location
* time zone
* calendar
* person names formats
* addresses formats
* currency specific data
* currency symbols based on currency codes
* currency code, phone prefix, default locale based on country

Locale settings uses system configuration as a source.

.. comment: locale + language were removed as they have been removed in the scope of non-conflicting locate feature

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   locale-settings
   number-formatting
   datetime-formatting
   name-formatting
   address-formatting
   entities
   managing-localizations
   current-localization
   localized-values
   commands


.. include:: /include/include-links-dev.rst
   :start-after: begin
