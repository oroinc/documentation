.. _book-entities-extended-entities-enums:

Option Enum Set Fields
======================

The option set, also named as the enum, is a special type of a field which allows to choose one or more options
from a predefined set of options. The OroPlatform provides two different data types for these purposes:

* ``enum`` (named **Select** on UI) - only one option can be selected
* ``multiEnum`` (named **Multi-Select** on UI) - several options can be selected

The option sets are quite complex. Both the ``enum`` and ``multiEnum`` types are based on :ref:`serialized fields <book-entities-extended-entities-serialized-fields>`. The main difference between them is that the ``enum`` type is based on a virtual many-to-one association, while the ``multiEnum`` type is based on a virtual many-to-many association.

To add the option set field to an entity, you can use |ExtendExtension|.

The following example illustrates how to do it:

.. oro_integrity_check:: d2fdbf395065c2b201384fbbddcfb8b79e1a9759

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_3/AddEnumFieldOroUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_3/AddEnumFieldOroUser.php
       :language: php

Please mind the enum code parameter. Each option set should have code and be unique system-wide,
and with length of no more than 21 characters (due to dynamic name generation and prefix).
The same principle applies to the field name. In the case above, it should be less than 27 symbols.

To load a list of options, use data fixtures, for example:

.. oro_integrity_check:: c9713339f60d363d76351c29c6f89972bbd42a27

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadUserInternalRatingData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadUserInternalRatingData.php
       :language: php

|ExtendHelper| class which can be helpful when you work with option sets:

* **buildEnumCode()** - Builds an option set code based on its name.
* **generateEnumCode()** - Generates an option set code based on a field for which this option set is created.
* **isEnumerableType()** - Checks if the passed type is one of the enumerable.
* **isSingleEnumType()** - Checks if the passed type is 'enum', (named **Select** on UI)
* **isMultiEnumType()** - Checks if the passed type is 'multiEnum', (named **Multi-Select** on UI)
* **buildEnumInternalId()** - Builds an option identifier based on the option name The option internal identifier is a
  32 characters length string.
* **buildEnumOptionId()** - Builds an option identifier based on the option name and enum code. The option identifier is a
  100 characters length string.
* **getEnumTranslationKey()** - Builds label names for option set related translations.
* **buildEnumOptionTranslationKey()** - Builds enum option translation key (symfony translation).
* **extractEnumCode()** - Extracts the enum code from the enum option identifier.

As mentioned above, each option set has its own table to store available options. But translations for all options of all option sets are stored in one table. You can find more details in |EnumOptionTranslation| and |EnumOptionInterface|.
The EnumOptionTranslation class is used to store translations. The EnumOptionInterface is the base interface for all option set entities.

If for some reason you create system option sets and you have to render them manually, the following components can be helpful:

* |TWIG extension (Enum)| to sort and translate options. It can be used the following way:
  ``optionIds|sort_enum``, ``optionId|trans_enum``.

* Symfony form types that can be used to build forms contain option set fields: |EnumChoiceType| and |EnumSelectType|.

* Grid filters: |EnumFilter| and |MultiEnumFilter|. Check out how to use these filters in `datagrids.yml`. You can learn
  how to configure datagrid formatters for option sets in |ExtendColumnOptionsGuesser|. Keep in mind that the backend datagrid is configured in the ``/config/oro/datagrids.yml`` file, while the frontend datagrid is configured in the ``/views/layouts/<theme>/config/datagrids.yml`` file within the configuration directory of your bundle.

  Please take in account that this class passes the class name as the option set identifier, but you can also use the enum code.


.. include:: /include/include-links-dev.rst
   :start-after: begin
