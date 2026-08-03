.. _entities-data-management-data-audit:

Data Audit
==========

The |OroDataAuditBundle| leverages the Loggable |Doctrine extension1|
(|StofDoctrineExtension|) to provide changelogs for your entities.

Entity Configuration
--------------------

DataAudit can only be enabled for Configurable entities. To add an entity property to the changelog, enable the audit on the entity itself and specify the fields to log. Use the ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config`` and ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField`` annotations on the entity.

.. caution::

    This annotation is read-only on installation. On platform updates, it is read, but saved to the configuration only for new entities, entities that were not Configurable before, or entities not changed via the configuration UI.

.. note::

    You can enable or disable an audit for an entire entity or for individual fields in the UI under *System* / *Entities* / *EntityManagement* (attribute *Auditable*).

Example of annotation configuration:

.. oro_integrity_check:: a2ff0b21ef609e4b5730712bee5cd5af2ac749ef

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-94, 208

Every time a product's price changes, the change is logged in the database. The logging manager stores the modified data along with a set of related information:

* The action corresponding to the operation performed by the Doctrine ORM (one of *create*, *update* and *delete*);

* The modified entity's class name

* The current date and time

* The user performing the change

* A string representation of the modified entity. If the entity class implements a ``__toString()`` method, the return value of this method is used. Otherwise, the class name is used.

Each entity object gets its own history, so changesets are numbered starting from 1. Each new changeset increments the entity's highest existing version number by one.

Additional Fields
-----------------

You can store additional fields in every audit log entry, with no restrictions on the data type. If the object is passed to an array, it is sanitized and converted to the supported format. The following example shows when additional fields are useful:

Suppose you create an extension that integrates Oro application with an external System A, synchronizing Question entities between the two. The Question identifier differs between them: **id** in Oro application and **subject** in System A.

System A tracks changes in Oro application by calling the API audit endpoint and matches Questions on its side by subject, so attaching that field to every response is helpful (for example, when a Question is removed). To do this, use "additional fields". The entity must implement *AuditAdditionalFieldsInterface*.

In our example, it can look like this:

.. oro_integrity_check:: abcf9ebcab68a03a02fa1e3c2aed214a44a57ee1

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-4, 59-64, 201-208

Segment
-------

DataAuditBundle extends OroSegmentBundle by a new filter type "Data audit".

* Use this filter to select records that:

  * had a field changed to a value (e.g., Contact who changed job position to "Director")
  * had a field changed to a value in a period of time (e.g., Contact who changed job position to "Director" within last week)

* To filter by a specific field, these conditions must be met:

  * the entity has to be auditable
  * the field has to be auditable

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

The DataAuditBundle ships with a controller that gives you access to a particular entity's history through your web browser. By default, the controller's route path is ``/audit/history/{entity}/{id}/{_format}``. For example, to view the history of the product with id 5, use ``/audit/history/product/5``. If you do not specify a format, the bundle defaults to HTML. To override the path, provide your own definition for a route with id ``oro_dataaudit_history``.

API
---

Besides browsing the audit history in your web browser, you can also access the stored data through an API, which provides methods to retrieve your results via REST API.

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

JSON is the only supported format, and the API controller uses it when you omit the format. Use the ``latest`` value to access the most recent version of the API; this currently equals ``v1``, the only available version.


.. include:: /include/include-links-dev.rst
    :start-after: begin
