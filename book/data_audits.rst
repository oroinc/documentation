.. index:
    single: DataAuditBundle
    single: Logging; Entity Modifications

Logging Entity Modifications
============================

Introduction
------------

The `OroDataAuditBundle`_ leverages the Loggable `Doctrine extension`_
(`StofDoctrineExtension`_) to provide changelogs for your entities.

Entity Configuration
--------------------

DataAudit can be enabled only for Configurable entities. To make a property
of an entity being added to the changelog, you simple have to enable the audit
for the entity itself and some fields you want to be logged. To achieve this,
you should use the ``@Config`` and ``@ConfigField`` annotations for entity.

.. caution::

    Note that this annotation will be read only on install.
    On platform update this annotation will be read and saved in config, only  for new entities
    or for entities which were not Configurable before or have not be changed via configuration UI.

.. note::

    Audit can be enabled/disabled per whole entity or separate field in UI System->Entities->EntityManagement (attribute "Auditable").

Example of annotation configuration::

    // src/Acme/DemoBundle/Entity/Product.php
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

Now, everytime a product's price is modified, the changes are logged in the
database. The loggable manager not only stores the data being modified but
also logs a set of related information:

* The action corresponding to the operation performed by the Doctrine ORM
  (one of *create*, *update* and *delete*);

* The modified entity's class name;

* The current date and time;

* The user performing the change;

* A string representation of the modified entity. If the entity class implements
  a ``__toString()`` method, the return value of this method is used. Otherwise,
  the class name is used.

Each entity object gets its own history. Therefore, changesets get version
numbers starting with 1. Each time a new changeset is created, the a new version
number is created by increment the highest existing version number for a
particular entity by one.

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

Besides browsing the audit history with your web browser, you can also access
the data being stored via an API. It provides methods to receive your stored
results via either REST or SOAP.

Both variants provide methods to retrieve:

* A list of all audit log entries;

* A single audit log entry.

To retrieve a single entry, you need its id which you have to extract from
the list of log entries.

.. note::

    The audit log entry id isn't related to any of the entities being watched.

REST
~~~~

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

SOAP
~~~~

To access the SOAP API you use one of the two functions provided by the API:

============= ==============================
Function      Use case
============= ==============================
``getAudits`` Retrieve all audit log entries
------------- ------------------------------
``getAudit``  Retrieve an audit log entry
============= ==============================

.. _`OroDataAuditBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/DataAuditBundle
.. _`Doctrine extension`: https://github.com/Atlantic18/DoctrineExtensions
.. _`StofDoctrineExtension`: https://github.com/stof/StofDoctrineExtensionsBundle
