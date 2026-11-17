.. _bundle-docs-extensions-smart-insights-bundle:

OroSmartInsightsBundle
======================

OroSmartInsightsBundle provides the Smart Insights mode of :ref:`OroIQ <concept-guide--oroiq>`. It runs the DQL that the assistant writes through a restricted Doctrine entity manager that exposes only the entities and fields with the **Include in Smart Insights** option (``include_in_smart_insights`` of the ``ai_agent`` entity config scope), with the ACL of the current user applied.

The entity structures contain the translated descriptions of the included entities and fields. The assistant receives only the entity descriptions.

``Oro\Bundle\SmartInsightsBundle\Provider\SmartInsightsConfigProvider`` checks the stored **Include in Smart Insights** option together with the following rules:

* ``Tagging`` is included only when ``Tag`` is included.
* ``ActivityList`` is included only when at least one activity entity of ``Oro\Bundle\ActivityListBundle\Provider\ActivityListChainProvider`` is included.
* An association field of ``ActivityList``, such as the link to ``Lead``, is included only when its target entity is included. When ``ActivityList`` is included, its organization field is always included for the ACL walker.

The :ref:`default allowlist <bundle-docs-extensions-smart-insights-bundle-allowlist>` includes ``Tagging``, ``ActivityList``, and their fields. An administrator can change the option of these entities and fields as for any other entity. A new activity association of ``ActivityList`` is not included automatically.

Query Security
--------------

``Oro\Bundle\SmartInsightsBundle\ORM\Factory\DqlQueryFactory`` applies these layers in order:

#. The restricted entity manager. ``Oro\Bundle\SmartInsightsBundle\ORM\SmartInsightsClassMetadataFactory`` hides every entity and field that is not included in Smart Insights.
#. The tree walkers of the ``oro_smart_insights.dql_tree_walkers`` option. They run before the ACL walker and see only the authored DQL. The default walkers of the ``Oro\Bundle\SmartInsightsBundle\ORM\Walker`` namespace reject :ref:`internal entities <bundle-docs-extensions-smart-insights-bundle-internal-entities>` (``RejectInternalEntitiesWalker``), UPDATE, DELETE, and ``SELECT *`` (``EnforceSelectWalker``), and fields without field-level ``VIEW`` access (``RestrictFieldAccessWalker``). ``DqlQueryFactory`` sets the ``oro_smart_insights.field_acl_filter`` query hint on every query. ``RestrictFieldAccessWalker`` reads the field ACL filter from this hint.
#. ``AclHelper::apply()`` with the ``VIEW`` permission and the ``smartInsights`` option, which adds the :ref:`Smart Insights access rules <bundle-docs-extensions-smart-insights-bundle-access-rules>`.

The ``oro_smart_insights.dql_error_messages`` option lists ``pattern`` (a regular expression) and ``message`` pairs. The first matching pattern replaces the Doctrine error message returned to the assistant.

Add a Tree Walker
^^^^^^^^^^^^^^^^^

The ``oro_smart_insights.dql_tree_walkers`` option is a list of tree walker classes. The walkers run in the listed order. Each configuration file appends its walker classes to the list. To add a walker, list its class in the ``config/config.yml`` file or in the ``Resources/config/oro/app.yml`` file of a bundle:

.. code-block:: yaml

   oro_smart_insights:
       dql_tree_walkers:
           - Acme\Bundle\DemoBundle\ORM\Walker\RejectArchivedRecordsWalker

.. _bundle-docs-extensions-smart-insights-bundle-allowlist:

Default Allowlist
-----------------

The ``Oro\Bundle\SmartInsightsBundle\Migrations\Data\ORM\UpdateEntityConfigValues`` data fixture sets the default **Include in Smart Insights** values from ``Migrations/Data/ORM/data/smart_insights_entity_config.yml``:

* A listed entity is included with the fields under its ``included_fields`` key. Its other fields are excluded. An entity listed with ``~`` is included without fields.
* A class without entity config is skipped, so the file can list entities of optional packages.
* A previously included entity that is no longer listed gets ``false`` for itself and its fields.

The fixture does not change a value that an administrator changed in Entity Management. Such changes are detected through the entity config audit log (the ``oro_entity_config_log_diff`` table), which the platform writes for changes made by a logged-in user. A value changed by an administrator at any time keeps its current value, even when a later version of the allowlist lists it differently.

The fixture is versioned, so an allowlist change takes effect with a version bump. A run without changes persists and notifies nothing.

.. _bundle-docs-extensions-smart-insights-bundle-feature-toggles:

Feature Toggles
---------------

Feature toggles hide entities from the entity structures only. ``Oro\Bundle\SmartInsightsBundle\Provider\EntityStructureDataProvider`` omits an included entity listed in the ``entities`` resources of a disabled feature, and every association that targets it. The feature state is checked per request in the organization scope, falling back to the global scope. The back-office API has no current website. For this reason, website-level states are ignored. The stored option is not changed.

The restricted entity manager and the access rules ignore feature toggles. DQL that references an entity of a disabled feature runs with the ACL applied.

``SmartInsightsConfigProvider`` checks the inclusion and the feature state with the following methods:

* ``isIncludedInSmartInsightsEntity()`` and ``isIncludedInSmartInsightsField()`` --- Check the inclusion of an entity or a field. They ignore feature toggles.
* ``isEntityAvailable()`` --- Checks that an entity is included and is not listed in the ``entities`` resources of a disabled feature.
* ``isAssociationTargetAvailable()`` --- Checks the target entity of an association field. The target entity must be enabled by feature toggles. For an association field of ``ActivityList``, the target entity must also be included. The method returns ``true`` for a field that is not an association.

Entity Structure Invalidation
-----------------------------

These ``Oro\Bundle\SmartInsightsBundle\EventListener`` listeners make the microservice re-fetch the entity structures:

* ``InvalidateStructuresOnEntityConfigChangeListener`` --- When ``include_in_smart_insights`` changes, or ``field_acl_enabled`` or ``show_restricted_fields`` of an included entity. After every extend schema update. An ``include_in_smart_insights`` change and an extend schema update also clear the restricted entity manager metadata and query caches.
* ``InvalidateStructuresOnFeaturesChangeListener`` --- When a feature with an included entity is toggled. No cache is cleared.
* ``InvalidateStructuresOnAclChangeListener`` --- When root privileges or privileges of an included entity are saved for a user or for a role with assigned users. Storefront privileges are ignored.
* ``InvalidateStructuresOnRoleAssignmentListener`` --- When user roles are reassigned or a role is deleted.

.. _bundle-docs-extensions-smart-insights-bundle-internal-entities:

Internal Entities
-----------------

An internal entity is hidden from the assistant but usable in access rule subqueries. ``SmartInsightsClassMetadataFactory`` provides it unfiltered, and ``RejectInternalEntitiesWalker`` rejects it in the authored DQL with ``RestrictedDqlException``. An entity is internal when its class is in the internal entity list, by default ``SmartInsightsClassMetadataFactory::INTERNAL_ENTITIES`` with ``ActivityOwner``.

To add internal entities, call ``setInternalEntities()`` on ``oro_smart_insights.orm.metadata_factory`` from a compiler pass. The call replaces the list:

.. code-block:: php

   $container->getDefinition('oro_smart_insights.orm.metadata_factory')
       ->addMethodCall('setInternalEntities', [[
           ...SmartInsightsClassMetadataFactory::INTERNAL_ENTITIES,
           AgreementAssignee::class,
       ]]);

.. _bundle-docs-extensions-smart-insights-bundle-access-rules:

Smart Insights Access Rules
---------------------------

The regular :ref:`access rules <backend-security-bundle-access-rules>` apply too. Rules tagged with ``smartInsights: true`` apply to Smart Insights queries only, because ``DqlQueryFactory`` passes the ``smartInsights`` option (``DqlQueryFactoryInterface::SMART_INSIGHTS_ACCESS_RULE_OPTION``) to ``AclHelper::apply()``. Use them for entities that the UI shows only inside a visible parent record.

Registered ``oro_smart_insights.access_rule.*`` services:

* ``activity_list`` (``ActivityListSmartInsightsAccessRule``) --- Shows an ``ActivityList`` row if it has no owners or the user can view one of its owners. Hides activity types that are not included.
* ``tagging`` (``TaggingSmartInsightsAccessRule``) --- Shows a tag assignment if the tagged record is visible and its entity is included.
* ``user_login_attempt`` and ``customer_user_login_attempt`` (``AclResourceSmartInsightsAccessRule``) --- Hide login attempts unless the ``oro_user_login_attempt`` or ``oro_customer_user_login_attempt`` ACL resource, if defined, is granted. The Enterprise edition grants them in the global organization only.
* ``sales_customer``, ``applied_promotion``, ``applied_coupon``, and ``applied_discount`` (``Oro\Bundle\SecurityBundle\AccessRule\AssociationAwareAccessRule``) --- Show a row only when its associated record is visible: a sales ``Customer`` by ``account``, an ``AppliedPromotion`` or ``AppliedCoupon`` by ``order``, an ``AppliedDiscount`` by ``appliedPromotion``.
* ``promotion_rule`` and ``promotion_discount_configuration`` (``ReferencingEntitySmartInsightsAccessRule``) --- Show a ``Rule`` or a ``DiscountConfiguration`` only through a visible ``Promotion`` that references it, so shipping and payment method rules stay hidden. If ``Promotion`` or its association is not included, all rows are denied.

Add an Access Rule
^^^^^^^^^^^^^^^^^^

Tag the rule with ``oro_security.access_rule`` and ``smartInsights: true``. Without this attribute, the rule also applies to every UI query of the entity. A rule that follows one association needs no class:

.. code-block:: yaml

   services:
       acme_demo.access_rule.agreement_smart_insights:
           class: Oro\Bundle\SecurityBundle\AccessRule\AssociationAwareAccessRule
           arguments: ['customer']
           tags:
               - { name: oro_security.access_rule, type: ORM, entityClass: Acme\Bundle\DemoBundle\Entity\Agreement, smartInsights: true }

``ReferencingEntitySmartInsightsAccessRule`` takes the referencing entity class, the association name, ``@doctrine``, and ``@oro_smart_insights.provider.smart_insights_config``. ``AclResourceSmartInsightsAccessRule`` takes the ACL resource ID as its third argument.

A custom rule implements ``Oro\Bundle\SecurityBundle\AccessRule\AccessRuleInterface``. Create a subquery ``Criteria`` with ``isRoot`` set to ``false`` so the ACL walker applies the ownership rules of the subquery entity, and give it a unique alias so the authored DQL cannot reuse it. Every entity in a subquery must be included in Smart Insights or be an :ref:`internal entity <bundle-docs-extensions-smart-insights-bundle-internal-entities>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
