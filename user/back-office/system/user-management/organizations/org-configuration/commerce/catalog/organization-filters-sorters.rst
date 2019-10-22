:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--catalog--filters-sorters--organization:

Filters and Sorters  per Organization
-------------------------------------

To configure limiting filters and sorting options per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/catalog/organization_filters_sorters.png

4. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown.

     .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

5. To change any of the default options set on the global level:

     a) Clear the **Use System** check box next to the option.
     b) Select whether to remove completely or just disable unrelated attributes in filters and sorters.

6. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin