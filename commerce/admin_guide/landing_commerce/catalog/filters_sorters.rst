.. _configuration--guide--commerce--configuration--catalog--filters-sorters:

Limit Filters and Sorters
=========================

.. contents:: :local:
   :depth: 1

To make sure that only the attributes of the required product family are displayed in the storefront, you can limit filters and sorting options in OroCommerce. You can also control whether to hide or disable filters and sorting options in the storefront for the products that do not belong to the selected product family.

.. For instance, the Lawnmowers and Pressure Washers product collections usually have different product attributes: for lawnmowers these can be *Blade Type* or *Cutting Heights*, while for pressure washers the *Flow Rate* or *Temperature*. Ideally, you would not want the *Flow Rate* to be displayed as a filtering option for lawnmowers in the storefront.

Configuration for this option is available on three levels, globally, per organization, and per website.

.. note:: By default, the options are enabled for OroCommerce versions 3.0 and higher.

.. _configuration--guide--commerce--configuration--catalog--filters-sorters--globally:

Control Limiting Filters and Sorting Options Globally
-----------------------------------------------------

To configure limiting filters and sorting options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /admin_guide/img/configuration/catalog/filters_sorters/globally_filters_sorters.png

3. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the initial product data search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

    .. image:: /admin_guide/img/configuration/catalog/filters_sorters/hide_unrelated_product_filters.png

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter instead of removing it. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown (available only in the OroCommerce Enterprise edition).

    .. image:: /admin_guide/img/configuration/catalog/filters_sorters/dont_change_initial_filter_state.png

    .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

4. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select whether to remove completely or just disable unrelated attributes in filters and sorters.

5. Click **Save Settings**.


.. _configuration--guide--commerce--configuration--catalog--filters-sorters--organization:

Control Limiting Filters and Sorting Options per Organization
-------------------------------------------------------------

To configure limiting filters and sorting options per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens.

.. image:: /admin_guide/img/configuration/catalog/filters_sorters/organization_filters_sorters.png

4. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown.

     .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

5. To change any of the default options set on the global level:

     a) Clear the **Use System** check box next to the option.
     b) Select whether to remove completely or just disable unrelated attributes in filters and sorters.

6. Click **Save Settings**.
   
.. _configuration--guide--commerce--configuration--catalog--filters-sorters--website:
   
Control Limiting Filters and Sorting Options per Website
--------------------------------------------------------

To configure limiting filters and sorting options per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /admin_guide/img/configuration/catalog/filters_sorters/website_filters_sorters.png

4. The following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** - removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

   * **Don't Change Initial Filter State** - disables unrelated attributes within a filter. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown.

     .. note:: This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

5. To change any of the default options set on the system level:

     a) Clear the **Use System** check box next to the option.
     b) Select whether to remove completely or just disable unrelated attributes in filters and sorters.

6. Click **Save Settings**.
  
.. include:: /img/buttons/include_images.rst
   :start-after: begin
