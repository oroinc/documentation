.. _entities-data-management-data-audit:

Data Audit
==========

The |OroDataAuditBundle| uses the Loggable |Doctrine extension1|
(|StofDoctrineExtension|) to record changelogs for your entities.

Entity Configuration
--------------------

DataAudit can only be enabled for Configurable entities. To add an entity property to the changelog, enable the audit on the entity itself and specify the fields to log. Use the ``Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config`` and ``Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField`` attributes on the entity.

.. caution::

    This annotation is read-only on installation. On platform updates, it is read, but saved to the configuration only for new entities, entities that were not Configurable before, or entities not changed via the configuration UI.

.. note::

    You can enable or disable an audit for an entire entity or for individual fields in the UI under *System* / *Entities* / *EntityManagement* (attribute *Auditable*).

Example of attribute configuration:

.. oro_integrity_check:: 4717106d23ed7f2f97ed5b3f73f2e329de4f645f

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-61, 134

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

.. oro_integrity_check:: b4ad004e42479eacf26aa6ae2d6d1f0de2d74931

    .. literalinclude:: /code_examples/commerce/demo/Entity/Question.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Question.php
        :language: php
        :lines: 1-4, 44-49, 129-134

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

.. oro_integrity_check:: cc1f9145b59e893e8c407c19061b822d6438b4d1

    .. literalinclude:: /code_examples/commerce/demo/AcmeDemoBundle.php
        :caption: src/Acme/Bundle/DemoBundle/AcmeDemoBundle.php
        :language: php
        :lines: 1-28

Next, create a migration that will add columns to the AuditField entity:

.. oro_integrity_check:: 5be1c5e878901e86dfe547cd6de04632d539c7e0

    .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_7/AddNewAuditFieldType.php
        :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddNewAuditFieldType.php
        :language: php
        :lines: 1-20


To see the auditable option in the entity configuration, make sure your field type is in the allowed types here: **DataAuditBundle/Resources/config/oro/entity_config.yml**.

To make sure your column is displayed correctly in the grids (segments, reports), create a new column options guesser with tag **oro_datagrid.column_options_guesser** and set **frontend_type property**.

.. _entities-data-management-data-audit--configuration:

Configuration Change Audit
--------------------------

The |OroDataAuditBundle| also records system configuration changes, in addition to entity changes. Whenever a configuration setting is changed at any level (e.g., system (global), organization, website, customer group, customer, or user (**My Configuration**)), the bundle creates an audit entry. The audit entry appears in the same **System > Data Audit** grid that shows entity changes. Administrators therefore have a single, filterable trail of who changed which setting, when, and how.

This is controlled by the ``data_audit`` feature (enabled by default) and requires no per-field opt-in: every setting of every configuration level is covered.

.. note::

    Only the changes made on behalf of a user are recorded. A setting can be written without a security token, for example, by the ``oro:config:update`` command, a cron job, a scheduler, or a data fixture. Such a setting has no author to attribute the change to, so the audit does not record it.

    When a user runs a command with the ``--current-user`` option, the command runs on behalf of that user. Any changes made by the command are recorded with that user as the author.

How It Works
^^^^^^^^^^^^

The bundle listens to the ``oro_config.update_after`` event. For every changed setting, the bundle publishes a message to a dedicated message queue topic (``oro.data_audit.config_changed``). The ``ConfigChangeAuditProcessor`` processes this message asynchronously and writes the audit record. A running message consumer (``oro:message-queue:consume``) is required to process the message, consistent with the entity audit pipeline. The acting user, organization, impersonation, and the configuration level are resolved at the time of change, while the security token is still available. The bundle carries this information in the message, so the audit record stays accurate even though this record is written later.

Configuration Levels
^^^^^^^^^^^^^^^^^^^^

Each configuration level is represented by its own **Entity Type**, so the levels are distinct and you can filter them independently:

* ``global`` --- **Configuration: System**
* ``organization`` --- **Configuration: Organization**
* ``website`` --- **Configuration: Website**
* ``customer`` --- **Configuration: Customer**
* ``customer_group`` --- **Configuration: Customer Group**
* ``user`` (**My Configuration**) --- **Configuration: User**

The **Entity Type** grid filter accepts several values at once. You can therefore show multiple levels together, or show a level together with regular entities.

The levels are the configuration scopes of the application. Which levels exist depends on the installed packages. For example, the commerce levels are absent in a CRM-only installation.

.. _entities-data-management-data-audit--configuration-level:

Levels of a New Configuration Scope
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

A bundle that adds a configuration scope registers a scope manager with the ``oro_config.scope`` tag. Such a bundle gets its audit level for free, because the audit derives everything it needs from the scope name:

* the entity type stored in the record. This is the studly-cased scope name followed by ``Configuration``, in the ``Oro\Bundle\ConfigBundle`` namespace
* the system configuration tree, ``<scope>_configuration``
* the label, ``oro.dataaudit.config.type.<scope>``. If this translation key has no translation, the audit falls back to a name derived from the level.

Declaring the entity whose ID the scope carries is the only requirement. The audit record shows this entity's name as the name of what was configured:


.. code-block:: yaml
    :caption: Resources/config/oro/app.yml

    oro_data_audit:
        configuration_level_entities:
            website: Oro\Bundle\WebsiteBundle\Entity\Website

The key is the scope name used in the ``oro_config.scope`` tag. Declaring a scope that the application does not have is a configuration error, and this error fails the container build.

The global scope has no entity and declares nothing, so its records are named ``Global``. When a level declares no entity, its records are named after the scope and the id instead, for example ``Website #3``.

The name of the declared entity comes from the entity name resolver. When no entity name provider is available for that entity, the record uses a generic name, such as ``Item #3`` for it. To display a meaningful entity name at that scope level, provide a corresponding entity name provider.

A bundle can replace a scope manager and thereby change what the scope ID refers to. For example, the Enterprise edition replaces the scope for the user scope, so the ID becomes the ID of a user within an organization. The bundle also declares the entity of that scope, overriding the declaration of the bundle that originally contributed the scope.

Data Column
^^^^^^^^^^^

The **Data** column shows the human-readable location of the setting together with the old and new values. The location is the setting's breadcrumb in the configuration tree, ending with the setting label, for example ``Commerce › Product › Promotions › New Arrivals › Maximum Items``. The generic **System Configuration** root of the tree is omitted, as it carries no locating information.

Only the stable configuration key is stored. The breadcrumb is resolved when the record is displayed. The displayed breadcrumb therefore always reflects the current translations and the language of the user who views the grid. As a result, changing a translation never desynchronizes the recorded history.

Action
^^^^^^

The audit action reflects the configuration value's lifecycle:

* **Create** --- The setting received an explicit value for the first time. Before this change, the setting used the default or inherited value. The audit records only the new value. It does not record the previous default.
* **Remove** --- The setting was reset to use the default or the parent scope. The audit records only the value that was removed. It does not record the value the setting fell back to.
* **Update** --- An existing explicit value was replaced with another one.

One save produces one audit entry that lists every setting it changed. When such an entry mixes several kinds of change, its action is **Update**, while the recorded values of each setting still follow the rules above.

Inherited Values
^^^^^^^^^^^^^^^^

A setting either takes the value of its parent scope or has a value of its own. The configuration form controls this with a checkbox named after the level it inherits from, for example **Use default**, **Use Organization** or **Use Customer Group**. Clearing this checkbox stops the setting from following the parent scope, and selecting it again makes the setting follow the parent scope once more. Both are configuration changes on their own, even when the value stays exactly the same. For example, a user can pick their own language and stop following the language of their organization without changing the language itself.

The audit records such a change like any other change of the setting, and the action tells what happened: **Create** when the setting received a value of its own, and **Remove** when the setting went back to the inherited value. The recorded values follow the rules of these actions described above, so a **Create** shows the value the setting has from now on, and a **Remove** shows the value the setting no longer stores.

Saving a setting with the same value it already has does not create a change and is not recorded. The same applies to settings that already inherit their values from the parent scope. A configuration form submits all displayed fields, not only the fields that the user changed.

Value Types
^^^^^^^^^^^

Every value is stored with its real data type: a boolean is stored and displayed as a boolean (rather than ``1`` / ``0``), an integer as an integer, a decimal as a float, and a multiple-value setting as an array. All other types are stored as text.

.. _entities-data-management-data-audit--configuration-secrets:

Secret Settings
^^^^^^^^^^^^^^^

The audit does not record the value of a setting that holds a secret. The audit shows ``***`` instead. The entry still shows who changed the setting and when, without disclosing the value.

The audit recognizes a setting as a secret by the form type used to edit the setting. Every setting rendered as a password field hides its value in the configuration form, so the audit hides it as well. This covers Symfony ``PasswordType`` and every type built on it, such as ``OroEncodedPlaceholderPasswordType``, and requires no declaration. A setting is covered as soon as it is rendered as a password.

.. note::

    A credential that is not rendered as a password field, for example a token in a plain text field, is recorded like any other value, in the same way the configuration form displays it.

Searching and Filtering
^^^^^^^^^^^^^^^^^^^^^^^

In addition to the **Entity Type** filter described above, the audit grid provides a **Data** filter. This filter searches within the changed data using a *contains* condition. The **Data** filter matches:

* The changed field key, such as ``oro_product.new_arrivals_max_items``, or an entity field name.
* Any part of the displayed breadcrumb of a configuration setting. For example, searching for ``Promotions`` finds every audited setting of that group, and searching for ``Maximum Items`` finds the setting itself.
* The label of an audited entity field. For example, searching for ``Primary Email`` finds the change of ``User::email``.
* The old and the new value of text values.

Both the breadcrumb and the entity field label are resolved from the current translations, so the search always works with the names in the language the user sees.

.. note::

    Values stored with a non-text type (boolean, integer, float, array) are not matched by value. Such a change can be found by its name.

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
^^^^^^^^

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
