:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--catalog--filters-sorters--organization:

Configure Filters and Sorters Settings per Organization
=======================================================

To configure filters and sorting options per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/catalog/filters_and_sorters_org.png

4. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown.

     .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

   * **Default Filter Panel State** - controls the visibility of the filters applied to the product grids in the storefront. The filter panel can be either expanded to show all filter bars or collapsed to reduce the screen space. In this case, the collapsed filters are substituted with the text representation of all applied filters.

   * **Filter Panel Position** --- enables to select the required position of the filter bar in the storefront (applicable since OroCommerce v4.2.0. To check which application version you are running, see the :ref:`system information <system-information>`). There are two options available:

     When *Top* (default) is selected, the filter bar is displayed on the top of the product listing page.

     .. image:: /user/img/system/config_commerce/catalog/filters_panel_position_top.png
        :alt: The storefront product page illustrating the filter on the top of the product listing page

     When *Sidebar* is selected, the filter is displayed in the left sidebar.

     .. image:: /user/img/system/config_commerce/catalog/filters_panel_position_sidebar.png
        :alt: The storefront product page illustrating the filter in the left sidebar


5. To change any of the default options set on the global level:

     a) Clear the **Use System** check box next to the option.
     b) Select the necessary checkbox or a value.

6. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin