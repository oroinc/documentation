.. _book-entities-extended-entities-serialized-fields:

Serialized Fields
=================

OroPlatform lets you create custom entities or custom fields for extended entities.
Serialized fields let you add custom fields without a schema update.

These fields have some restrictions, however. Their data is stored in the `serialized_data` column as a serialized array, and this column is hidden from the UI on the entity config page.

.. admonition:: Serialized Enum Fields

    Serialized fields have different restrictions than enum fields (select, multiselect), which are also stored in the `serialized_data` column. The Enum fields functionality is described in :ref:`Option Set Fields <book-entities-extended-entities-enums>`.

Not supported features:

- grid filtering and sorting
- segments and reports
- charts
- search
- relations, and option set field types
- data audit
- usage of such fields in Doctrine query builder

.. admonition:: Serialized Fields Access

    Serialized fields are exposed as public class properties, handled by the entity's magic __get and __set methods. They therefore have no getters or setters.


The Serialized Fields bundle adds a **Storage Type** field to the new field creation page, where you choose one of two storage types:

- The `Table Column` option creates a custom field as usual.
- The `Serialized field` option lets you avoid the schema update and use the field immediately. In this case, field types are limited to the following:

   - BigInt
   - Boolean
   - Date
   - DateTime
   - Decimal
   - Float
   - Integer
   - Select
   - Multi-select
   - Money
   - Percent
   - SmallInt
   - String
   - Text
   - WYSIWYG

.. image:: /user/img/system/entity_management/new_entity_field.png
   :alt: Basic properties available when creating a new field for an entity

To create a serialized field via migration, use |SerializedFieldsExtension|. For example:

.. oro_integrity_check:: 418a439696cf34dfe77184ebf48a4b9e0d78c47a

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_4/AddSerializedFieldMigration.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_4/AddSerializedFieldMigration.php
       :language: php

Serialized fields support the same set of config options as other :ref:`configurable fields <backend-configuration-annotation-config-field>`.


.. admonition:: Business Tip

    The upcoming frontier of eCommerce is B2B marketplaces. Discover how a |business-to-business marketplace| can help digitally transform your company.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
