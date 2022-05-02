.. _entities-data-management-data-audit:

Data Audit
==========

The |OroDataAuditBundle| leverages the Loggable |Doctrine extension1|
(|StofDoctrineExtension|) to provide changelogs for your entities.

Entity Configuration
--------------------

DataAudit can only be enabled for Configurable entities. To add a property
of an entity to the changelog, you simply have to enable the audit
for the entity itself and specify some fields you want to be logged. To achieve this,
you should use the ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config``
and ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField``
annotations for the entity.

.. caution::

    Note that this annotation will be read-only on installation. On platform
    updates, this annotation will be read and only saved in the configuration
    for new entities, or for entities which were not Configurable before or
    have not be changed via the configuration UI.

.. note::

    Audit can be enabled/disabled per an entire entity or for separate fields
    in the UI under *System* / *Entities* / *EntityManagement* (attribute
    *Auditable*).

Example of annotation configuration:

.. code-block:: php
   :caption: src/Acme/DemoBundle/Entity/Product.php

    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @ORM\Entity
     * @Config( # entity default configuration
     *      routeName="acme_product_index", # optional, used to represent entity instances count as link
     *                                      # in EntityManagement UI
     *      routeView="acme_product_view",  # optional
     *      defaultValues={
     *          "entity"={ # entity configuration scope 'entity'
     *              "icon"="icon-product" # default icon class which will be used
     *                                    # can be changed via UI
     *          },
     *          "dataaudit"={ # entity configuration scope 'dataaudit'
     *              "auditable"=true # will enable dataaudit for this entity
     *                               # if not specified will be false
     *                               # but you will be able to enable audit via UI
     *          },
     *          # ...
     *          # any other entity scope default configuration
     *          # ...
     *      }
     * )
     */
    class Product
    {
        /**
         * @ORM\Column(type="string")
         */
        private $title;

        /**
         * @ORM\Column(type="string")
         * @ConfigField( # field default configuration
         *      defaultValues={
         *          "dataaudit"={
         *              "auditable"=true
         *          },
         *          # ...
         *          # any other entity scope default configuration
         *          # ...
         *      }
         * )
         */
        private $price;
    }

Now, every time a product's price is modified, the changes are logged in the
database. The logging manager not only stores the data being modified but
also logs a set of related information:

* The action corresponding to the operation performed by the Doctrine ORM
  (one of *create*, *update* and *delete*);

* The modified entity's class name

* The current date and time

* The user performing the change

* A string representation of the modified entity. If the entity class implements
  a ``__toString()`` method, the return value of this method is used. Otherwise,
  the class name is used.

Each entity object gets its own history. Therefore, changesets get version
numbers starting with 1. Each time a new changeset is created, a new version
number is created by incrementing the highest existing version number for a
particular entity by one.

Additional Fields
-----------------

You can store additional fields in every entry of the audit log. There are no requirements for the type of data.
If the object is passed to an array, it is properly sanitized and converted to the supported format.
To clarify the need of additional fields, see the example below:

Suppose a developer creates an extension that integrates OroCRM with an external System A. This integration synchronizes Product entities between systems. However, the identifier of the Product entity is different in CRM (**id**) and System A (**system_id**). System A tracks changes in CRM calling API audit endpoint and matches Products on its side by system_id, so it will be helpful to attach this field to every response (for example, when a Product is removed). To make it happen, one can use "additional fields". The entity must implement *AuditAdditionalFieldsInterface*.

In our example, it can look like this:

.. code-block:: php

    namespace MyBundle\Entity;

    use Oro\Bundle\DataAuditBundle\Entity\AuditAdditionalFieldsInterface;

    class Product implements AuditAdditionalFieldsInterface
    {
        // rest of code

        public function getAdditionalFields()
        {
            return ['system_id' => $this->getSystemId()];
        }
    }

Segment
-------

DataAuditBundle extends OroSegmentBundle by new filter type "Data audit".

* This filter can be used to filter records based on if they

  * had field changed to value (e.g. Contact who changed job position to "Director")
  * had field changed to value in period of time (e.g. Contact who changed job position to "Director" within last week)

* Following conditions have to be fulfilled in order to be able to filter by specific field

  * entity has to be auditable
  * field has to be auditable

.. _bundle-docs-platform--data-audit--add-new-types:

Add New Auditable Types
-----------------------

To add new auditable types, register a new type in your bundle's boot method:

.. code-block:: php

    use Oro\Bundle\DataAuditBundle\Model\AuditFieldTypeRegistry;

    class MyBundle extends Bundle
    {
        public function boot(): void
        {
            parent::boot();

            /**
             * You can also use AuditFieldTypeRegistry::overrideType to replace existing type
             * But make sure you move old data into new columns
             */
            AuditFieldTypeRegistry::addType($doctrineType = 'datetimetz', $auditType = 'datetimetz');
        }
    }


Next, create a migration which will add columns to the AuditField entity:

.. code-block:: php

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtension;
    use Oro\Bundle\DataAuditBundle\Migration\Extension\AuditFieldExtensionAwareInterface;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class MyMigration implements Migration, AuditFieldExtensionAwareInterface
    {
        /** @var AuditFieldExtension */
        private $auditFieldExtension;

        public function setAuditFieldExtension(AuditFieldExtension $extension)
        {
            $this->auditFieldExtension = $extension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->auditFieldExtension->addType($schema, $doctrineType = 'datetimetz', $auditType = 'datetimetz');
        }
    }


To see the auditable option in the entity configuration, make sure your field type is in the allowed types here: **DataAuditBundle/Resources/config/oro/entity_config.yml**.

To make sure your column is displayed correctly in the grids (segments, reports...), it might be necessary to create new column options guesser with tag **oro_datagrid.column_options_guesser** and set **frontend_type property**.

Browsing the Change History
---------------------------

The DataAuditBundle ships with a controller that gives you access to the history
of particular entities through your web browser. By default, the route path
of the controller is ``/audit/history/{entity}/{id}/{_format}``. For example,
if you want to view the history the product with id 5, you'll use the route
path ``/audit/history/product/5``. If you don't specify a format, the bundle
will try HTML by default. You can override the path by providing your own
definition for a route with id ``oro_dataaudit_history``.

API
---

Along with browsing the audit history with your web browser, you can also access
the data being stored via an API which provides methods to receive your stored
results via REST API.

Both variants provide methods to retrieve:

* A list of all audit log entries

* A single audit log entry

To retrieve a single entry, you need its id which must be extracted from
the list of log entries.

.. note::

    The audit log entry id isn't related to any of the entities being watched.

REST API
~~~~~~~~

The two REST API endpoints are controlled by the ``oro_api_get_audit`` and
``oro_api_get_audits`` routes:

====================== ========================================= ==============================
Route                  Path                                      Use case
====================== ========================================= ==============================
``oro_api_get_audits`` /api/rest/{version}/audits.{_format}      Retrieve all audit log entries
---------------------- ----------------------------------------- ------------------------------
``oro_api_get_audit``  /api/rest/{version}/audits/{id}.{_format} Retrieve an audit log entry
====================== ========================================= ==============================

Currently, JSON is the only format being supported which will also be chosen
by the API controller if you omit it. Use the special ``latest`` value to
access the most recent version of the API. At the moment, this is equivalent
to ``v1`` which is the only available version.


.. include:: /include/include-links-dev.rst
   :start-after: begin
