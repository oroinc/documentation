.. index:
    single: DataAuditBundle
    single: Logging; Entity Modifications

Logging Entity Modifications
============================

Introduction
------------

The `OroDataAuditBundle`_ leverages the Loggable `Doctrine extension`_ to
provide changelogs for your entities.

Entity Configuration
--------------------

To make a property of an entity being added to the changelog, you simple have
to enable the Loggable extension on that entity and tag the relevant properties
with the ``Versioned`` annotation::

    // src/Acme/DemoBundle/Entity/Product.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\DataAuditBundle\Metadata\Annotation as Oro;

    /**
     * @ORM\Entity
     * @Oro\Loggable
     */
    class Product
    {
        /**
         * @ORM\Column(type="string")
         */
        private $title;

        /**
         * @ORM\Column(type="string")
         * @Oro\Versioned
         */
        private $price;
    }

.. caution::

    Note that you use the ``Loggable`` annotation from the DataAuditBundle
    instead of the one from the Doctrine extensions.

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
``getAudit``  Retrieve all audit log entries
------------- ------------------------------
``getAudits`` Retrieve an audit log entry
============= ==============================

.. _`OroDataAuditBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/DataAuditBundle
.. _`Doctrine extension`: https://github.com/Atlantic18/DoctrineExtensions
