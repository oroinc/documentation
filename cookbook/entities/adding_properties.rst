How to Add Properties to Core Entities
======================================

OroCRM and OroPlatform come with a lot of entities that you may have to customize to fit your
application's needs. For example, imagine that you want to store the date your contacts became
member of your company's partner network.

To achieve this you may want to add a new property ``partnerSince`` which will hold a ``DateTime``
instance that reflects the date the contact joined your network. This property is added by writing
a migration:

.. code-block:: php
    :linenos:

    // src/AppBundle/Migrations/Schema/v1_0/AddPartnerSinceToContact.php
    namespace AppBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddPartnerSinceToContact implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('orocrm_contact');
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
        }
    }

Please note that the Entity that you add new property should have ``@Config`` annotation
and should be extended from empty Extend class:

.. code-block:: php
    :linenos:

    // src/AppBundle/Entity/Contact.php
    namespace AppBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    use AppBundle\Entity\Model\ExtendContact;

    /**
     * @ORM\Entity()
     * @Config()
     */
    class Contact extends ExtendContact
    {
    }


.. code-block:: php
    :linenos:

    // src/AppBundle/Model/ExtendContact.php
    namespace AppBundle\Model;

    class Contact extends ExtendContact
    {
        /**
         * A skeleton method for the getter. You can add it to use autocomplete hints from the IDE.
         * The real implementation of this method is auto generated.
         *
         * @return \DateTime
         */
        public function getPartnerSince()
        {
        }

        /**
         * A skeleton method for the setter. You can add it to use autocomplete hints from the IDE.
         * The real implementation of this method is auto generated.
         *
         * @param \DateTime $partnerSince
         */
        public function getPartnerSince(\DateTime $partnerSince)
        {
        }
    }

The important part in this migration (which is different to common Doctrine migrations) is the
``oro_options`` key passed through the ``options`` argument of the ``addColumn()`` method. All
options nested under this key are special to OroCRM and OroPlatform and will be handled outside of
the usual Doctrine migration workflow.

The ``extend`` key is interpreted by the EntityExtendBundle from the OroPlatform. Using it will
instruct the bundle to generate PHP code in an intermediate class that deals with mapping data for
this attribute to the underlying database and to make it accessible in PHP code. This code is
generated automatically based on the configured data when the application cache is warmed up.

By using the ``ExtendScope::OWNER_CUSTOM`` value the owner attribute tells the OroPlatform that the
property was user defined and that the core system should handle how the property is shown in
grids, forms, and so on if not configured otherwise. It is also possible to set the value of the
owner attribute to ``ExtendScope::OWNER_SYSTEM``. In this case, nothing will be rendered
automatically, but the developer is responsible to handle this explicitly in code.
