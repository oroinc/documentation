.. _configuration--guide--commerce--configuration--catalog--filters-sorters--organization:

Configure Filters and Sorters Settings per Organization
=======================================================

.. hint:: Configuration for this option is available on three levels, :ref:`globally <configuration--guide--commerce--configuration--catalog--filters-sorters>`, per organization, and :ref:`per website <configuration--guide--commerce--configuration--catalog--filters-sorters--website>`.

To configure filters and sorting options per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/catalog/filters_and_sorters_org.png


4. To change any of the default options set on the global level:

     a) Clear the **Use System** checkbox next to the option.
     b) Select the necessary checkbox or a value.

5. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

   .. image:: /user/img/system/config_commerce/catalog/hide_unrelated_product_filters.png
      :alt: The storefront product page illustrating the Hide Unrelated Product Filters and Sorting Options configuration

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown.

   .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

   .. image:: /user/img/system/config_commerce/catalog/dont_change_initial_filter_state.png
      :alt: The storefront product page illustrating the Don't Change Initial Filter State configuration

   * **Default Filter Panel State** - controls the visibility of the filters applied to the product grids in the storefront. The filter panel can be either expanded to show all filter bars or collapsed to reduce the screen space. In this case, the collapsed filters are substituted with the text representation of all applied filters.

   * **Filter Panel Position** --- specifies where the filter panel should be represented in the storefront, at the top or in the sidebar.

   .. important:: The Filter Panel Position configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility. For v6.0 and above, please configure this option under :ref:`System > Theme Configuration <back-office-theme-configuration>`.

   .. hint:: To specify how to display the multi-select filter options, refer to the :ref:`theme-related settings <configuration--commerce--design--theme>`.


6. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin