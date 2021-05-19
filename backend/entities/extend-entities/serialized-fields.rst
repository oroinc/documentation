.. _book-entities-extended-entities-serialized-fields:

Serialized Fields
=================

.. note:: OroEntitySerializedFieldsBundle requires OroPlatform and PHP 7.1 or above.

OroPlatform provides the ability to have custom entities or extend entities with new custom fields.
The package allows to avoid schema update when you create a custom field.

However, these fields have some restrictions. Their data is stores in the `serialized_data` column as a serialized array but field `serialized_data` is hidden from the UI on entity config page.

Not supported features:

- grid filtering and sorting
- segments and reports
- charts
- search
- relations, enums and option set field types
- data audit
- usage of such fields in Doctrine query builder

After installation (described below), a new field called **Storage Type** is displayed within **New field** creation page where you need choose one of two storage types:

- `Table Column` option will allow to create custom field as usual;
- `Serialized field` option means that you can avoid schema update and start to use this field immediately. Keep in mind that in this case field types are limited to the following:

  - string
  - integer
  - smallint
  - bigint
  - boolean
  - decimal
  - date
  - datetime
  - text
  - float
  - money
  - percent

To create a serialized field via migration, use |SerializedFieldsExtension|. For example:

.. code-block:: php

    <?php

    namespace Acme\Bundle\AppBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtension;
    use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtensionAwareInterface;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddSerializedFieldMigration implements
        Migration,
        SerializedFieldsExtensionAwareInterface
    {
        /** @var SerializedFieldsExtension */
        protected $serializedFieldsExtension;

        /**
         * {@inheritdoc}
         */
        public function setSerializedFieldsExtension(SerializedFieldsExtension $serializedFieldsExtension)
        {
            $this->serializedFieldsExtension = $serializedFieldsExtension;
        }

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->serializedFieldsExtension->addSerializedField(
                $schema->getTable('my_table'),
                'my_serialized_field',
                'string',
                [
                    'extend'    => [
                        'owner' => ExtendScope::OWNER_CUSTOM,
                    ]
                ]
            );
        }
    }

Installation
------------

Package is available through Oro Package Manager.
For development purposes it can be cloned directly from the GitHub repository.

.. code-block:: bash

    git clone git@github.com:orocrm/OroEntitySerializedFieldsBundle.git
    git submodule init
    git submodule update


Update your composer.json with

.. code-block:: bash

       "autoload": {
            "psr-0": {
    ...
                "Oro\\Bundle": ["src/Oro/src", "src/OroPackages/src"],
    ...
            }
        },

.. code-block:: bash

    php composer.phar update
    php bin/console oro:platform:update --force

Run Unit Tests
--------------

To run unit tests for this package:

.. code-block:: bash

   phpunit -c PACKAGE_ROOT/phpunit.xml.dist

.. include:: /include/include-links-dev.rst
   :start-after: begin