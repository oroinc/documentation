Add Properties to Core Entities
===============================

You may require to customize the default Oro entities to fit your application's needs.

Let us customize the Contact entity to store the date of when a contact becomes a member of your company's partner network. For the sake of example, we will use the Contact entity from the custom AppBundle.

To achieve this, add a new property ``partnerSince`` to store the date of when a contact joined your network. To add the property, create a migration:

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
            $table = $schema->getTable('contact');
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
        }
    }

.. note::
   Please note that the entity that you add a new property to must have the ``@Config`` annotation and should extend an empty Extend class:

   .. code-block:: php
       :linenos:

       // src/AppBundle/Entity/Contact.php
       namespace AppBundle\Entity;

       use Doctrine\ORM\Mapping as ORM;

       use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

       use AppBundle\Entity\Model\ExtendContact;

       /**
        * @ORM\Entity()
        * @ORM\Table(name="contact")
        * @Config()
        */
       class Contact extends ExtendContact
       {
       }


   .. code-block:: php
       :linenos:

       // src/AppBundle/Model/ExtendContact.php
       namespace AppBundle\Model;

       class ExtendContact
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
           public function setPartnerSince(\DateTime $partnerSince)
           {
           }
       }

The important part in this migration (which is different from common Doctrine migrations) is the ``oro_options`` key. It is passed through the ``options`` argument of the ``addColumn()`` method:

.. code-block:: php
   :linenos:
   :emphasize-lines: 3

   ...
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
   ...

All options nested under this key are handled outside of the usual Doctrine migration workflow.

When the EntityExtendBundle of the OroPlatform finds the ``extend`` key, it generates an intermediate class with getters and setters for the defined properties, thus making them accessible from every part of the code. The intermediate class is generated automatically based on the configured data when the application cache is warmed up.


The ``owner`` attribute can have the following values:

* ``ExtendScope::OWNER_CUSTOM`` --- The property is user-defined and the core system should handle how the property appears in grids, forms, etc. (if not configured otherwise).
* ``ExtendScope::OWNER_SYSTEM``--- Nothing is rendered automatically, and the developer must explicitly specify how to show the property in different parts of the system (grids, forms, views, etc.).
