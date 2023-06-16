.. _entities-data-management-data-audit:

Data Audit
==========

The |OroDataAuditBundle| leverages the Loggable |Doctrine extension1|
(|StofDoctrineExtension|) to provide changelogs for your entities.

Entity Configuration
--------------------

DataAudit can only be enabled for Configurable entities. To add a property of an entity to the changelog, enable the audit for the entity itself and specify some fields you want to be logged. To achieve this, use the ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config`` and ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField`` annotations for the entity.

.. caution::

    Note that this annotation will be read-only on installation. On platform updates, this annotation will be read and only saved in the configuration for new entities or for entities that were not Configurable before or have not been changed via the configuration UI.

.. note::

    An audit can be enabled/disabled per an entire entity or for separate fields in the UI under *System* / *Entities* / *EntityManagement* (attribute  *Auditable*).

Example of annotation configuration:

.. oro_integrity_check:: a2ff0b21ef609e4b5730712bee5cd5af2ac749ef

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-94, 208

Every time a product's price is modified, the changes are logged in the database. The logging manager not only stores the data being modified but also logs a set of related information:

* The action corresponding to the operation performed by the Doctrine ORM (one of *create*, *update* and *delete*);

* The modified entity's class name

* The current date and time

* The user performing the change

* A string representation of the modified entity. If the entity class implements a ``__toString()`` method, the return value of this method is used. Otherwise, the class name is used.

Each entity object gets its own history. Therefore, changesets get version numbers starting with 1. Each time a new changeset is created, a new version number is created by incrementing the highest existing version number for a particular entity by one.

Additional Fields
-----------------

You can store additional fields in every entry of the audit log. There are no requirements for the type of data. If the object is passed to an array, it is properly sanitized and converted to the supported format. To clarify the need for additional fields, see the example below:

Suppose you create an extension that integrates OroCRM with an external System A. This integration synchronizes Question entities between systems. However, the identifier of the Question entity is different in CRM (**id**) and System A (**subject**). System A tracks changes in CRM calling API audit endpoint and matches Questions on its side by subject, so it will be helpful to attach this field to every response (for example, when a Question is removed). To make it happen, one can use "additional fields". The entity must implement *AuditAdditionalFieldsInterface*.

In our example, it can look like this:

.. oro_integrity_check:: abcf9ebcab68a03a02fa1e3c2aed214a44a57ee1

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-4, 59-64, 201-208

Segment
-------

DataAuditBundle extends OroSegmentBundle by a new filter type "Data audit".

* This filter can be used to filter records based on if they

  * had field changed to value (e.g., Contact who changed job position to "Director")
  * had field changed to value in a period of time (e.g., Contact who changed job position to "Director" within last week)

* Following conditions have to be fulfilled to be able to filter by a specific field

  * entity has to be auditable
  * field has to be auditable

.. _bundle-docs-platform--data-audit--add-new-types:

Add New Auditable Types
-----------------------

To add new auditable types, register a new type in your bundle's boot method:

.. oro_integrity_check:: de67d0647236839f08a8d5566116210e497b9e31

    .. literalinclude:: /code_examples/commerce/demo/AcmeDemoBundle.php
        :caption: src/Acme/Bundle/DemoBundle/AcmeDemoBundle.php
        :language: php
        :lines: 1-29

Next, create a migration that will add columns to the AuditField entity:

.. oro_integrity_check:: 7dabf5bfd8c97943c712085d2bbdee2c85764fee

    .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_7/AddNewAuditFieldType.php
        :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddNewAuditFieldType.php
        :language: php
        :lines: 1-30


To see the auditable option in the entity configuration, make sure your field type is in the allowed types here: **DataAuditBundle/Resources/config/oro/entity_config.yml**.

To make sure your column is displayed correctly in the grids (segments, reports), create a new column options guesser with tag **oro_datagrid.column_options_guesser** and set **frontend_type property**.

Browsing the Change History
---------------------------

The DataAuditBundle ships with a controller that gives you access to the history of particular entities through your web browser. By default, the route path of the controller is ``/audit/history/{entity}/{id}/{_format}``. For example, if you want to view the history of the product with id 5, use the route path ``/audit/history/product/5``. The bundle will try HTML by default if you do not specify a format. You can override the path by providing your own definition for a route with id ``oro_dataaudit_history``.

API
---

Along with browsing the audit history with your web browser, you can also access the data stored via an API, which provides methods to receive your stored results via REST API.

Both variants provide methods to retrieve:

* A list of all audit log entries

* A single audit log entry

To retrieve a single entry, you need its id, which must be extracted from
the list of log entries.

.. note::

    The audit log entry id is not related to any of the entities being watched.

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

Currently, JSON is the only supported format the API controller will choose if you omit it. Use the ``latest`` value to access the most recent version of the API. Currently, this is equivalent to ``v1``, the only available version.


.. include:: /include/include-links-dev.rst
    :start-after: begin
