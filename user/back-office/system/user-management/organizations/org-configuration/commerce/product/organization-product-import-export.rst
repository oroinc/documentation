.. _sys--users--organization--commerce--products--import-export:

Configure Settings for Product Import/Export per Organization
=============================================================

You can define how product categories are exported and identified during product import. Product Import/Export settings below help ensure predictable category assignment by controlling which category attributes are included in export files and how categories are resolved when importing products, particularly in scenarios where category titles or paths are not unique within the master catalog.

.. note:: You can also configure category options :ref:`globally <configuration--guide--commerce--product-import-export>`.

To configure the settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Product Import/Export** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Configure the following options by clearing the **Use System** checkbox next to the required option:

   * **Export Category Path** --- When enabled, the export includes the ``category.path`` column with the full category path, starting from the Master Catalog root. The path is composed of the short default (non-translated) titles of the category and its parent categories and uses `` / `` (space, slash, space) as a delimiter (for example, ``All Products / Electronics / Chargers / Phone Chargers``). If the delimiter occurs within an individual category title, it is encoded as `` // `` (space, slash, slash, space), for example, the title ``Chargers / Power Banks" will appear in the path as "Chargers // Power Banks`` to avoid ambiguity.

   * **Export Category Default Title** --- When enabled, the export includes the ``category.default.title`` column with the category's short default (non-translated) title only (for example, Phone Chargers).

   * **Category Identification When Not Unique** --- If the import file does not contain the ``category.id`` value, categories are matched by ``category.path`` (preferred) or by ``category.default.title``. Because category paths and titles may not be unique, this option defines whether the import should fail when multiple matches are found, or assign the first match.

   * **Category ID and Path/Title Mismatch Resolution** -- Defines how the import behaves when ``category.id`` is provided together with ``category.path`` and/or ``category.default.title``, and the resolved category does not match the category with the specified ID. This check helps detect potential user mistakes, for example when the category ID is provided but the path or title was modified without updating the ID, while still allowing intentional overrides. The ID identifies the target category; the path or title is used only for validation. If both ``category.path`` and ``category.default.title`` are present and the path resolves to a category, the title is not used for lookup or comparison.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

