.. _book-entities-extended-entities-serialized-fields:

Serialized Fields
=================

OroPlatform provides the ability to create custom entities or custom fields for extended entities.
This package provides a possibility to avoid schema update when you create custom fields.

However, these fields have some restrictions. Their data is stored in the `serialized_data` column as a serialized array but the `serialized_data` field is hidden from the UI on entity config page.

Not supported features:

- grid filtering and sorting
- segments and reports
- charts
- search
- relations, enums, and option set field types
- data audit
- usage of such fields in Doctrine query builder

.. admonition:: Serialized Fields Access

    Serialized fields are available as public class properties and handled by magic __get and __set methods in the entity. There are, therefore, no getters and setters for these fields.


The Serialized Fields bundle adds a new field called Storage Type within New field creation page where you need to choose one of the two storage types:

- The `Table Column` option enables to create custom field as usual;
- The `Serialized field` option means that you can avoid schema update and start to use this field immediately. Keep in mind that in this case field types are limited to the following:

   - BigInt
   - Boolean
   - Date
   - DateTime
   - Decimal
   - Float
   - Integer
   - Money
   - Percent
   - SmallInt
   - String
   - Text
   - WYSIWYG

.. image:: /user/img/system/entity_management/new_entity_field.png
   :alt: Basic properties available when creating a new field for an entity

To create a serialized field via migration, use |SerializedFieldsExtension|. For example:

.. oro_integrity_check:: a07efb1bbaee9541e4867596cd510c54e84ceabd

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_4/AddSerializedFieldMigration.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_4/AddSerializedFieldMigration.php
       :language: php

Serialized files support the same set of config options as other :ref:`configurable fields <backend-configuration-annotation-config-field>`.


.. admonition:: Business Tip

    The upcoming frontier of eCommerce is B2B marketplaces. Discover how a |business-to-business marketplace| can help digitally transform your company.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
