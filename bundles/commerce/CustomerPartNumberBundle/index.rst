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

Back-Office Management
----------------------

Alongside the storefront, part numbers can be viewed and created from the back-office. They are managed by
``Controller\CustomerPartNumberController`` and reached through the ``customer_part_numbers_list`` menu item,
added under the ``products_tab`` of the main application menu.

* Listing - the ``customer-part-numbers-grid`` datagrid lists existing part numbers with the part number,
  product SKU, product name, customer name, and creation date columns, all sortable and filterable.
* Creation - the ``Form\Type\CustomerPartNumberType`` form creates a part number from a product, a customer, and
  the part number value, and requires the ``oro_customer_part_number_create`` ACL.
* Per-customer shortcut - the Customer view page links to the same listing, pre-filtered by that customer, from
  its "More actions" dropdown. Contributed by ``oro_customer_part_number.widget_provider.customer_view_actions``
  in the ``activity`` view action group (the group whose label renders as "More actions").

Import and Export
-----------------

Part numbers are imported from and exported to CSV in the back-office, on top of ImportExportBundle.
``ImportExport\Configuration\CustomerPartNumberImportExportConfigurationProvider`` (the
``oro_customer_part_number`` configuration alias) declares both, and the listing page renders the buttons from it.

The import and the export do not share one column set:

* The import reads **Part Number** and **Product SKU**, which are the only two columns of the import template.
  **Customer Id** is recognized but is not a part of the template (see below), and any other column of the file is
  ignored.
* The export writes **Part Number**, **Product SKU**, **Customer Id**, and **Customer Name**, following the
  ``importexport`` entity configuration of ``Entity\CustomerPartNumber`` and the identity fields of the related
  entities.

Column titles are the translated entity field labels in both directions, so they follow the locale of the user
running the operation.

Import
^^^^^^

Part numbers are always imported for one customer, which is selected in the import dialog and is never taken from
the file:

* ``Form\Extension\ImportTypeCustomerExtension`` adds the **Customer** field to the dialog.
* ``EventListener\ImportCustomerOptionRequestListener`` copies the selected customer into the request import
  options, from where the import chain passes it to every chunk context as the ``customerId`` option.
* ``ImportExport\DataConverter\CustomerPartNumberDataConverter`` drops the customer id column of the file and
  substitutes that option instead. An exported file can therefore only be imported back for the customer it was
  exported for. The column is intentionally left out of the import template, since the file must never drive the customer.

``ImportExport\Strategy\CustomerPartNumberImportAddStrategy`` strategy drives both the **Add** and **Replace** import modes:

* **Add** - imports the part numbers as they are written in the file. A part number the customer already has for
  the same product is skipped silently.
* **Replace** - the same as above, but preceded by the removal of the part numbers the customer has for the products
  listed in the file. Part numbers for products that the file does not list are not affected, and part numbers of
  other customers are never affected.

The removal runs once from ``ImportExport\EventListener\BeforeImportChunksListener``, before the file is split into
chunks.
``ImportExport\Handler\ExistingCustomerPartNumbersRemoveHandler`` streams the file through
``ImportExport\Reader\CustomerPartNumberImportFileReader``, ``ImportExport\Provider\ProductIdsBySkusProvider``, and
``ImportExport\Manager\CustomerPartNumberRemover``, so that a file of any size is processed in batches. The remover
deletes with a bulk query, which bypasses the Doctrine listener that schedules the product search reindex, so it
requests the reindex itself.

Removal is authorized separately from the import itself: it requires the ``DELETE`` permission on the entity and a
customer of the organization of the user who started the import. Without that permission, the **Replace** strategy
is not offered in the dialog.

.. note:: Import validation runs the same checks as the import but never deletes anything, so validating the
   **Replace** strategy reports the same result as validating **Add**.

Export
^^^^^^

* The export runs the bundle's own ``customer_part_number_export_to_csv`` batch job, which reads through
  ``FilteredEntityReader``, so it exports the rows matching the filters currently applied to the
  ``customer-part-numbers-grid``.

Back-Office Order Pages
-----------------------

Part numbers of the order customer are also shown while an order is processed in the back-office: under the
product name of a line item on the order create, update, and view pages, in the product autocomplete and the
product select datagrid those pages use, and in the order PDF document.

Two rules apply across all of these elements:

* The customer always comes from the order that is being worked on, never from the logged-in user. On the order create
  page the order does not exist in the database yet, so ``Provider\OrderCustomerProvider`` takes the customer
  from the order draft of the current draft session. A customer ID that arrives in a request is resolved by
  ``Handler\CustomerIdParameterHandler`` into a customer that the current user is allowed to view. If it cannot be resolved, nothing is rendered.
* The part numbers are added under two generic keys - ``productAdditionalAttributes`` for the datagrid
  records and the PDF document payload, and ``details`` for the autocomplete rows. The templates that render them
  know nothing about customer part numbers, so another bundle can add its own attribute the same way.

Showing part numbers in a product field is opt-in:
``Form\Extension\CustomerPartNumberProductSelectTypeExtension`` adds the ``customer_part_numbers_customer``
option to ``ProductSelectType``, and only when it holds a customer does the field search by that customer's part
numbers and show them. ``Form\Extension\CustomerPartNumberOrderLineItemDraftTypeExtension`` sets the option for
the line item form of the order create and update pages, where the part numbers are rendered under the product
field through the ``oro_order_line_item_draft_product_after`` placeholder. That form is re-rendered when the
customer of the order changes.

Each remaining surface has its own listener:

* ``order-line-items-edit-grid`` of the order create and update pages -
  ``EventListener\Datagrid\OrderLineItemsEditGridCustomerPartNumberListener``.
* ``order-line-items-grid`` of the order view page -
  ``EventListener\Datagrid\OrderLineItemsViewGridCustomerPartNumberListener``, which also adds the line item
  product id to the grid query, because that grid does not select it otherwise.
* ``products-select-grid`` - ``EventListener\Datagrid\ProductSelectGridCustomerPartNumberListener``, which also
  adds the ``customer_part_number_orm`` filter to the grid.
* Product autocomplete - ``Autocomplete\CustomerPartNumbersSearchHandlerDecorator`` adds the part numbers to the
  rows, and ``EventListener\Search\ProductAutocompleteCustomerPartNumberListener`` makes it match products by
  part numbers in addition to the SKU and the name.
* Order PDF document - ``EventListener\PdfDocument\AddCustomerPartNumbersToPdfDocumentPayloadListener``, on
  ``BeforePdfDocumentGeneratedEvent``. A PDF document is generated outside of a user request, for example by a
  message queue consumer, which is why the customer has to come from the order.

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

In the storefront, customer part numbers surface in three places:

* The storefront product view page - a container injected into the product view layout.
* Storefront shopping list, checkout, and order line item grids.
* Storefront product search - an indexed, filterable, autocomplete-aware field on ``Product``.

Each surface has its own listener or layout data provider. There is no shared abstraction, because the grids
and layouts belong to several different bundles (ShoppingListBundle, OrderBundle, ProductBundle,
WebsiteSearchBundle) with no common extension point.

Data Fetch: ORM vs. Search Index
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* Search-backed surfaces never query ``oro_customer_part_number`` directly. At index time,
  ``WebsiteSearchEventListener`` writes two per-customer fields: a multi-value field of lowercased part numbers
  for matching, and a JSON-encoded field of part numbers as entered for retrieving the full list.
* Matching is case-insensitive on every engine: both ``CustomerPartNumbersSearchQueryModifier`` (search term)
  and ``Filter\CustomerPartNumberSearchFilter`` (grid filter value) lowercase before querying.
* Neither field is added to the shared ``all_text_*`` fields. The query condition targets the per-customer
  field instead, via the ``CUSTOMER_ID`` placeholder.
* Every other surface - product view page, shopping list, checkout line items, and every back-office order
  page - reads live rows through ``Provider\CustomerPartNumbersProvider``.
* Effect: ORM-backed surfaces are always current. Search-backed surfaces reflect part numbers only as of the
  last reindex. ``ScheduleProductSearchEventListener`` reindexes a product as soon as its part numbers change.

Rendering: Server vs. Client
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Within the ORM-backed grids, rendering also splits, by column type:

* Storefront order line items grid - a Twig-rendered ``html`` column.
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
  ``oro_customer_part_number.part_number.forbidden_characters`` DI parameter (default ``^ " & ' < >``).
* Reuse the ``customer_part_number_orm`` datagrid filter type in any grid with an ORM datasource related to
  ``Product``. Set its ``customer_id`` option to filter by the part numbers of a particular customer instead of
  the customer of the logged-in customer user.
* Show and search part numbers in a custom product select field: set the ``customer_part_numbers_customer``
  option of ``ProductSelectType`` to the customer whose part numbers the field works with.
* Tune the batch sizes of the **Replace** import removal: the
  ``oro_customer_part_number.importexport.product_ids_by_skus_batch_size`` and
  ``oro_customer_part_number.importexport.customer_part_number_remove_batch_size`` DI parameters control how many
  product SKUs are resolved to product ids (default ``500``), and how many products have their part numbers removed
  (default ``1000``), per query.
* Read part number data in a custom layout update via the ``oro_customer_part_number_provider``.

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   migrating-from-orolab
   commands

.. include:: /include/include-links-dev.rst
   :start-after: begin
