Data Fixtures for Translation Entities
======================================

The article provides information about data fixtures for translatable entities.

Classes Description
-------------------

AbstractTranslatableEntityFixture
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The purpose of this class is to create translatable entities. It gathers translation files, defines existing locales, and provides service methods to perform translation.

Descended classes must define the method "loadEntities".

Constants:

* **ENTITY\_DOMAIN** - a translation domain that contains translations for translatable entities; the default value is "entities";

* **DOMAIN\_FILE\_REGEXP** - a regular expression for matching appropriate translation files and extracting the locale.

Methods:

* **load** - a method from Doctrine AbstractFixture, an entry point for the data fixture run; it sets the translator property and runs the loadEntities method;

* **setContainer** - a method from ContainerAwareInterface, sets container property;

* **loadEntities** - an abstract method, must be specified in the descendant classes to load entities;

* **getDomainFileRegExp** - returns a formed regular expression based on the source expression and the current domain;

* **getTranslationLocales** - parses all translation files and searches for files that match the formed regular expression; returns a list of locales with appropriate translations;

* **translate** - translates string for specified ID, prefix, and locale;

You can also specify parameters and the domain manually;

* **getTranslationId** - forms a translation ID based on the entity string ID and entity prefix.
