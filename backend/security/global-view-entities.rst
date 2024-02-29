.. _backend-security-bundle-global-view-entities:

Global View Entities
====================

In Enterprise editions, data from the ACL-protected entities with the User, Business Unit, and Organization ownership types are separated by organization.

You can view an entity only from the organization where it was created. You can view data from all organizations only in the Global organization when the access level to the View permission is set to Global.

A global view entity is helpful for cases when data created in one organization should be available from other non-global organizations. For example, when the administrator wants to create a predefined list of brands for products from other organizations.

If the entity is marked as a Global view, data created in the global organization will be available in non-global organizations along with
the data created in this organization.

In the datagrids for such entities, a new column called ``Organization`` is added displaying the name of the current organization if the entity was created within it and the string ``System-wide`` if the entity was created in the global organization.

You can only view a global view entity from a non-global organization. It cannot be edited, deleted, or shared.

Configuring an Entity as a Global View
--------------------------------------

To see the data created from the global organization in a non-global organization for an ACL-protected entity, configure the chosen entity with the ``global_view`` parameter of the ``ownership`` scope in the
``defaultValues`` section of the ``#[Config]`` attribute, as illustrated below:

.. code-block:: php

     #[Config(
         defaultValues: [
             ...
             'ownership' => ['global_view' => true]
         ]
     )]
     class MyEntity

If the entity already exists, create a migration to add the ``global_view`` parameter to the entity config:

.. code-block:: php

    namespace Acme\Bundle\MyBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    /**
     * Switch my entity to the global view.
     */
    class MakeMyEntityGlobalView implements Migration
    {
        /**
         * {@inheritDoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('name_of_my_table');

            $options = new OroOptions();
            $options->set('ownership', 'global_view', true);
            $table->addOption(OroOptions::KEY, $options);
        }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin