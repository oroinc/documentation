:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--catalog--filters-sorters:

Configure Global Filters and Sorters Settings
=============================================

To make sure that only the attributes of the required product family are displayed in the storefront, you can limit filters and sorting options in OroCommerce. You can also control whether to hide or disable filters and sorting options in the storefront for the products that do not belong to the selected product family or collapse and expand the display of applied filters in the filter panel.

.. For instance, the Lawnmowers and Pressure Washers product collections usually have different product attributes: for lawnmowers these can be *Blade Type* or *Cutting Heights*, while for pressure washers the *Flow Rate* or *Temperature*. Ideally, you would not want the *Flow Rate* to be displayed as a filtering option for lawnmowers in the storefront.

.. hint:: Configuration for this option is available on three levels, globally, :ref:`per organization <configuration--guide--commerce--configuration--catalog--filters-sorters--organization>`, and :ref:`per website <configuration--guide--commerce--configuration--catalog--filters-sorters--website>`.

.. note:: By default, the options are enabled for OroCommerce versions 3.0 and higher.

.. _configuration--guide--commerce--configuration--catalog--filters-sorters--globally:

To configure filters and sorting options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /user/img/system/config_commerce/catalog/filters_and_sorters.png
   :alt: Filters and Sorters global configuration settings

3. In the **Limit Filters and Sorters** section, the following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** --- removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the initial product data search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

    .. image:: /user/img/system/config_commerce/catalog/hide_unrelated_product_filters.png
       :alt: The storefront product page illustrating the Hide Unrelated Product Filters and Sorting Options configuration

   * **Don't Change Initial Filter State** --- disables unrelated attributes within a filter instead of removing it. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown (available only in the OroCommerce Enterprise edition). This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

    .. image:: /user/img/system/config_commerce/catalog/dont_change_initial_filter_state.png
       :alt: The storefront product page illustrating the Don't Change Initial Filter State configuration

   .. note:: If a multi-attribute product has only one attribute, the filter is not displayed for it in the storefront.

             For example, if a product (e.g., a shirt) has several options for the attribute of color (red, green, yellow) but only red items are available, then no filter by color will be displayed in the storefront. This way, customers will not see the filter for the attribute where multiple options are unavailable at that moment.

4. In the **Display Settings** section, select the required option for the following settings:

   * **Default Filter Panel State** --- controls the visibility of the filters applied to the product grids in the storefront. The filter panel can be either expanded to show all filter bars or collapsed to reduce the screen space. In this case, the collapsed filters are substituted with the text representation of all applied filters.

    .. image:: /user/img/system/config_commerce/catalog/filters_and_sorters_storefront.png
       :alt: The storefront product page illustrating the Default Filter Panel State configuration

    * **Filter Panel Position** --- enables to select the required position of the filter bar in the storefront. There are two options available:

     When *Top* (default) is selected, the filter bar is displayed on the top of the product listing page.

     .. image:: /user/img/system/config_commerce/catalog/filters_panel_position_top.png
        :alt: The storefront product page illustrating the filter on the top of the product listing page

     When *Sidebar* is selected, the filter is displayed in the left sidebar.

     .. image:: /user/img/system/config_commerce/catalog/filters_panel_position_sidebar.png
        :alt: The storefront product page illustrating the filter in the left sidebar


5. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the necessary checkbox or a value.

6. Click **Save Settings**.
