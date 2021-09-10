.. _book-entities-extended-entities-enums:

Option Set Fields
=================

The option set, also named as the enum, is a special type of a field which allows to choose one or more options
from a predefined set of options. The OroPlatform provides two different data types for these purposes:

* ``enum`` (named **Select** on UI) - only one option can be selected
* ``multiEnum`` (named **Multi-Select** on UI) - several options can be selected

The option sets are quite complex types, but to understand how they work, you need to know that both
``enum`` and ``multiEnum`` types are based on regular |Doctrine associations|. The main difference between them is that
``enum`` type is based on |many-to-one association|, while ``multiEnum`` type is based on |many-to-many association|.
To add the option set field to an entity you can use |ExtendExtension|.

The following example shows how it can be done:

.. code-block:: php

    namespace Oro\Bundle\SalesBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->createTable('orocrm_sales_lead');
            $this->extendExtension->addEnumField(
                $schema,
                $table,
                'source', // field name
                'lead_source', // enum code
                false, // only one option can be selected
                false, // an administrator can add new options and remove existing ones
                [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM]
                ]
            );
        }
    }

Please mind the enum code parameter. Each option set should have code and be unique system-wide,
and with length of no more than 21 characters (due to dynamic name generation and prefix).
The same principle applies to the field name. In the case above, it should be less than 27 symbols.

To load a list of options, use data fixtures, for example:

.. code-block:: php

    namespace Oro\Bundle\DemoDataBundle\Migrations\Data\Demo\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\EntityExtendBundle\Entity\Repository\EnumValueRepository;
    use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

    class LoadLeadSourceData extends AbstractFixture
    {
        /** @var array */
        protected $data = [
            'Website'     => true,
            'Direct Mail' => false
        ];

        public function load(ObjectManager $manager)
        {
            $className = ExtendHelper::buildEnumValueClassName('lead_source');

            /** @var EnumValueRepository $enumRepo */
            $enumRepo = $manager->getRepository($className);

            $priority = 1;
            foreach ($this->data as $name => $isDefault) {
                $enumOption = $enumRepo->createEnumValue($name, $priority++, $isDefault);
                $manager->persist($enumOption);
            }

            $manager->flush();
        }
    }

As you can see in this example, we use the **buildEnumValueClassName()** method to convert the option set code
to the class name of an entity responsible for storing all options of this option set. It is important because
such entities are generated automatically by the OroPlatform and you should not use the class name directly.
There are also other functions in the |ExtendHelper| class which can be helpful when you work with option sets:

* **buildEnumCode()** - Builds an option set code based on its name.
* **generateEnumCode()** - Generates an option set code based on a field for which this option set is created.
* **buildEnumValueId()** - Builds an option identifier based on the option name. The option identifier is a
  32 characters length string.
* **buildEnumValueClassName()** - Builds the class name of an entity responsible for storing all options of the option set
  by the option set code.
* **getMultiEnumSnapshotFieldName()** - Builds the name of a field that is used to store a snapshot of selected values
  for option sets that allows to select several options. We use this data to avoid GROUP BY clause.
* **getEnumTranslationKey()** - Builds label names for option set related translations.

As mentioned above, each option set has its own table to store available options. But translations for all options
of all option sets are stored in one table. You can find more details in |EnumValueTranslation| and |AbstractEnumValue|.
The EnumValueTranslation class is used to store translations. The AbstractEnumValue is the base class for all option set
entities.

If for some reason you create system option sets and you have to render them manually, the following components can be helpful:

* |TWIG extension (Enum)| to sort and translate options. It can be used the following way:
  ``optionIds|sort_enum(enumCode)``, ``optionId|trans_enum(enumCode)``.

* Symfony form types that can be used to build forms contain option set fields: |EnumChoiceType| and |EnumSelectType|.

* Grid filters: |EnumFilter| and |MultiEnumFilter|. Check out how to use these filters in `datagrids.yml`. You can learn
  how to configure datagrid formatters for option sets in |ExtendColumnOptionsGuesser|.

  Please take in account that this class passes the class name as the option set identifier, but you can also use the enum code.


.. include:: /include/include-links-dev.rst
   :start-after: begin
