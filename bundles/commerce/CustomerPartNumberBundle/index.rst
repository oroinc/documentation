.. _bundle-docs-commerce-customer-part-number-bundle:

OroCustomerPartNumberBundle
===========================

.. note:: This bundle is only available in the Enterprise edition.

|OroCustomerPartNumberBundle| lets storefront customers assign their own Customer Part Numbers (CPNs) to
products, using their own procurement or inventory-tracking numbering scheme.

Architecture
------------

The bundle has one entity, ``Oro\Bundle\CustomerPartNumberBundle\Entity\CustomerPartNumber``:

* A part number tied to one customer and one product, unique per that pair.
* Implements ``ExtendEntityInterface``, so it can be extended like any other Oro entity.
* Owned on the frontend by the Customer, not the CustomerUser. This is deliberate: a part number is shared by
  everyone in that customer's organization, not private to the storefront user who created it.

Three services form the core of the bundle:

* ``Manager\CustomerPartNumberManager`` - creates and deletes part numbers. Used by the storefront AJAX
  controller, ``Controller\Frontend\CustomerPartNumberAjaxController``.
* ``Provider\CustomerPartNumbersProvider`` - the single data-access point almost everything else in the bundle
  (layout, forms, listeners) uses to fetch part numbers for a customer and a set of products.
* ``Provider\CustomerPartNumberSettingsProvider`` - the single entry point combining the
  ``oro_customer_part_number.feature_enabled`` and ``oro_customer_part_number.storefront_enabled`` options via
  ``isStorefrontEnabled()``. Used by ``Feature\Voter\CustomerPartNumberStorefrontVoter`` and anywhere storefront
  visibility needs to be checked.

Feature Toggle
--------------

The ``oro_customer_part_number`` feature is the kill switch for the whole bundle:

* Nearly every listener, provider, and form extension checks it.
* Turning it off removes the storefront UI, routes, search integration, and console commands at once - no
  separate configuration cleanup needed.
* Controlled by the ``oro_customer_part_number.feature_enabled`` option, configurable at the system level only.

.. note:: Enabling the feature does not trigger a reindex. It only applies to part numbers created afterward.
   Existing part numbers stay invisible on search-backed grids (see below) until a product reindex runs
   manually.

Storefront Visibility
^^^^^^^^^^^^^^^^^^^^^

The ``oro_customer_part_number.storefront_enabled`` option is a separate, narrower switch: it hides part
numbers from the storefront (display, creation, deletion, and filtering) without touching the feature itself
or any back-office functionality.

* Defaults to ``true`` and is configurable at the system, organization, website, customer group, and customer
  level, so individual customers, customer groups, or websites can hide part numbers on the storefront
  independently of each other.
* Has no effect unless ``oro_customer_part_number.feature_enabled`` is also enabled -
  ``Provider\CustomerPartNumberSettingsProvider::isStorefrontEnabled()`` is the single entry point that checks
  both options together.
* Enforced by ``Feature\Voter\CustomerPartNumberStorefrontVoter``, a feature toggle voter that disables the
  ``oro_customer_part_number`` feature for the resolved scope, but only on storefront requests (detected via
  ``FrontendHelper::isFrontendRequest()``). Back-office requests are never affected by this voter.

Legacy OroLab Bundle Coexistence
--------------------------------

This bundle supersedes the legacy ``OroLab\Bundle\CustomerPartNumberBundle`` (the ``orolab/customer-part-number``
extension). While an application still has the legacy bundle registered, during a phased migration, the
following mechanisms keep the two bundles from conflicting:

* Mutual exclusivity - ``EventListener\Config\MutuallyExclusiveFeatureConfigListener`` listens to the
  ``oro_config.settings_before_save`` event and keeps ``oro_customer_part_number.feature_enabled`` and the
  legacy ``oro_lab_customer_part_number.enabled`` mutually exclusive. If a system configuration save would
  leave both enabled, the option being newly turned on in that save is reverted to disabled and a warning
  flash message is shown, while the option that was already enabled is left untouched.
* Automatic migration on install - ``Migrations\Schema\OroCustomerPartNumberInstaller`` runs the first time this
  bundle's schema is installed - on a brand-new application install, or when the bundle is newly added to an
  already-installed application and ``oro:platform:update`` is run. In either case, if the legacy
  ``orolab_customer_part_number`` table already exists at that point, the installer automatically enqueues
  ``Migration\MigrateFromOroLabQuery`` to copy its rows into ``oro_customer_part_number``. Running
  ``oro:customer-part-number:migrate-from-orolab`` manually is then needed only if the legacy table did not
  exist yet at that time (e.g., the legacy extension is added later), or to re-run the migration; see
  :ref:`Migrating from the Legacy OroLab Bundle
  <bundle-docs-commerce-customer-part-number-bundle-migrating-from-orolab>` for the remaining manual steps
  (reindex, legacy entity cleanup).
* System configuration group title - ``DependencyInjection\Compiler\LegacyCpnConfigGroupTitlePass`` renames the
  legacy bundle's "cpn" system configuration group title to "OroLab Customer Part Number (Legacy)" when
  ``OroLabCustomerPartNumberBundle`` is registered in the kernel, so the two bundles' settings are easy to tell
  apart in the system configuration UI.

Storefront, Search, and Datagrid Integration
--------------------------------------------

Customer part numbers surface in three places:

* The storefront product view page - a container injected into the product view layout.
* Shopping list, checkout, and order line item grids.
* Storefront product search - an indexed, filterable, autocomplete-aware field on ``Product``.

Each surface has its own listener or layout data provider. There is no shared abstraction, because the grids
and layouts belong to several different bundles (ShoppingListBundle, OrderBundle, ProductBundle,
WebsiteSearchBundle) with no common extension point.

Data Fetch: ORM vs. Search Index
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* Search-backed surfaces (storefront product search grids) never query ``oro_customer_part_number`` directly.
  At index time, ``WebsiteSearchEventListener`` writes two per-customer fields onto the product's search
  document: a multi-value fulltext field for matching, and a JSON-encoded field for retrieving the full list
  (the multi-value field cannot be read back as a list).
* Every other surface - product view page, shopping list, checkout line items - reads live rows through
  ``Provider\CustomerPartNumbersProvider``.
* Effect: ORM-backed surfaces are always current. Search-backed surfaces reflect part numbers only as of the
  last reindex. ``ScheduleProductSearchEventListener`` reindexes a product as soon as its part numbers change.

Rendering: Server vs. Client
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Within the ORM-backed grids, rendering also splits, by column type:

* Order line items grid - a Twig-rendered ``html`` column.
  ``ProductAdditionalAttributesCustomerPartNumbersListener`` mutates the ORM result record; an existing Twig
  template turns it into HTML.
* Shopping list and checkout line item grids - a ``row_array`` column consumed by a browser-side Underscore.js
  template. ``LineItemsCustomerPartNumbersDataListener`` attaches raw ``{label, value}`` data through
  ``Oro\Bundle\ProductBundle\Event\DatagridLineItemsDataEvent``. A separate listener,
  ``ConfigurableLineItemsCustomerPartNumbersDataListener``, covers synthetic kit/configurable parent rows that
  never reach that event.

.. note:: ``Resources/config/oro/bundles.yml`` requires this bundle to load after ``OroProductBundle``,
   ``OroCustomerBundle``, ``OroWebsiteSearchBundle``, and ``ShoppingListBundle``. Its listeners and form
   extensions depend on services and grids registered by those bundles.

Customization Points
--------------------

* Feature toggle: disable ``oro_customer_part_number`` to turn off the whole bundle in one step.
* Change which characters are allowed in a part number: override the
  ``oro_customer_part_number.part_number.regex_pattern`` DI parameter (default ``/^[^^"&'<>]+$/``).
* Reuse the ``customer_part_number_orm`` datagrid filter type in any grid with an ORM datasource related to
  ``Product``.
* Read part number data in a custom layout update via the ``oro_customer_part_number_provider``.

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   migrating-from-orolab
   commands

.. include:: /include/include-links-dev.rst
   :start-after: begin
