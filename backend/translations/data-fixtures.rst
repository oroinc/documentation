Data Fixtures for Translation Entities
======================================

Article provides information about data fixtures for translatable entities.

Classes Description
-------------------

AbstractTranslatableEntityFixture
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This class is intended for creating translatable entities. It gathers translation files,
defines existing locales and provides service methods to perform translation.

Descended classes must define method "loadEntities".

Constants:

* **ENTITY\_DOMAIN** - translation domain that contains translations for translatable entities, default value is "entities";

* **DOMAIN\_FILE\_REGEXP** - regular expression for matching appropriate translation files and extracting locale.

Methods:

* **load** - method from Doctrine AbstractFixture, entry point for data fixture run, sets translator property and runs the loadEntities method;

* **setContainer** - method from ContainerAwareInterface, sets container property;

* **loadEntities** - abstract method, must be specified in descendant classes to load entities;

* **getDomainFileRegExp** - returns formed regular expression based on source expression and current domain;

* **getTranslationLocales** - parses all translation files and searches for files that match formed regular expression, returns list of locales with appropriate translations;

* **translate** - translates string for specified ID, prefix, and locale;

Parameters and domain can also be specified manually;

* **getTranslationId** - forms translation ID based on the entity string ID and entity prefix.
