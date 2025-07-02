.. _configuration--guide--commerce--configuration--catalog--filters-sorters:
.. _configuration--guide--commerce--configuration--catalog--filters-sorters--globally:

Configure Global Filters and Sorters Settings
=============================================

To make sure that only the attributes of the required product family are displayed in the storefront, you can limit filters and sorting options in OroCommerce. You can also control whether to hide or disable filters and sorting options in the storefront for the products that do not belong to the selected product family or collapse and expand the display of applied filters in the filter panel.

.. hint:: Configuration for this option is available on three levels, globally, :ref:`per organization <configuration--guide--commerce--configuration--catalog--filters-sorters--organization>`, and :ref:`per website <configuration--guide--commerce--configuration--catalog--filters-sorters--website>`.

To configure filters and sorting options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/catalog/filters_and_sorters.png
   :alt: Filters and Sorters global configuration settings

3. To customize the option configuration, clear the **Use Default** checkbox next to the option and select the required value.

4. In the **Limit Filters and Sorters** section, the following configuration options are available:

   * **Hide Unrelated Product Filters and Sorting Options** --- removes unrelated filters and sorting options from the product collection page to display only those attributes that belong to the current product family. When a user adjusts the initial product data search to target the product with the desired attribute, but the attribute is no longer applicable, it gets removed from the filter.

    .. image:: /user/img/system/config_commerce/catalog/hide_unrelated_product_filters.png
       :alt: The storefront product page illustrating the Hide Unrelated Product Filters and Sorting Options configuration

   * **Don't Change Initial Filter State** --- disables unrelated attributes within a filter instead of removing it. When applying a filter to the initial product data set in the storefront, all unrelated attributes remain visible but become disabled in the filter dropdown (available only in the OroCommerce Enterprise edition). This option affects filters in the storefront only when **Hide Unrelated Product Filters and Sorting Options** is enabled. Please ensure to enable both options for this configuration.

    .. image:: /user/img/system/config_commerce/catalog/dont_change_initial_filter_state.png
       :alt: The storefront product page illustrating the Don't Change Initial Filter State configuration

    .. note:: If a multi-attribute product has only one attribute, the filter is not displayed for it in the storefront.

              For example, if a product (e.g., a shirt) has several options for the attribute of color (red, green, yellow) but only red items are available, then no filter by color will be displayed in the storefront. This way, customers will not see the filter for the attribute where multiple options are unavailable at that moment.

5. In the **Display Settings** section, select the required option for the following settings:

   * **Default Filter Panel State** --- controls the visibility of the filters applied to the product grids in the storefront. The filter panel can be either expanded to show all filter bars or collapsed to reduce the screen space. In this case, the collapsed filters are substituted with the text representation of all applied filters.

   * **Filter Panel Position** --- specifies where the filter panel should be represented in the storefront, at the top or in the sidebar.

   .. important:: The Filter Panel Position configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility. For v6.0 and above, please configure this option under :ref:`System > Theme Configuration <back-office-theme-configuration>`.

   .. hint:: To specify how to display the multi-select filter options, refer to the :ref:`theme-related settings <configuration--commerce--design--theme>`.

6. In the **Product Sorting** section, configure the options that enable you to override the default product sorting behavior in the storefront, which is typically based on a product sort order (if specified) and by relevance score.

    .. note:: The product sorting feature is only available as of OroCommerce Enterprise version 6.1.2.

    .. hint:: Before enabling the options, ensure to:

        1. Define the options for the :ref:`inventory_status <products--product-attributes>` product attribute under the Products > Product Attributes back-office menu. Drag and drop statuses to arrange them by priority (e.g., *In Stock, Out Of Stock, Discontinued*). Products with higher-priority statuses will be displayed first. Please note that the inventory_status attribute is a system product attribute, so only a system administrator of the global organization can edit it.

            .. image:: /user/img/system/config_commerce/catalog/inventory-status-attribute.png
               :alt: The details page of the Inventory status product attribute

        2. Check the :ref:`visibility of the inventory statuses <configuration--guide--commerce--configuration--inventory--allowed-statuses>` under System > Configuration > Commerce > Inventory > Allowed Statuses to ensure that products with the specified status can be visible in the storefront.

            .. image:: /user/img/system/config_commerce/catalog/inventory-status-visibility-config.png
               :alt: The config page of the Allowed Statuses commerce system menu

* **Sort Category Products by Inventory Status** --- When enabled, the items on product listing (master catalog category) pages in the storefront will be sorted by their inventory status, as configured under the Products > Product Attributes back-office menu. Products with higher-priority statuses (e.g., *In Stock*) will appear first, followed by others in the defined order. Within the same inventory status group, products are further sorted by the sort order number assigned to them in the category.

.. image:: /user/img/system/config_commerce/catalog/category-products-sorting.png
   :alt: The master catalog category details page with the products with different inventory statuses and sort order, and the storefront page that reflects the enabled sorting behavior

* **Sort Search Results by Inventory Status** --- When enabled, the items on the search results page in the storefront will be sorted by their inventory status, as configured under the Products > Product Attributes back-office menu. Products with higher-priority statuses (e.g., *In Stock*) will appear first, followed by others in the defined order.

.. image:: /user/img/system/config_commerce/catalog/search-results-sorting.png
   :alt: The storefront page that reflects the enabled sorting behavior, where the products with higher-priority status *In Stock* appear first

* **Sort Product Collection by Inventory Status** --- When enabled, the items in product collections in the storefront will be sorted by their inventory status, as configured under the Products > Product Attributes back-office menu. Products with higher-priority statuses (e.g., *In Stock*) will appear first, followed by others in the defined order. Within the same inventory status group, products are further sorted by the sort order number assigned to them in the product collection.

.. image:: /user/img/system/config_commerce/catalog/product-collection-sorting.png
   :alt: The web catalog content node details page with the assigned product collection and the storefront page that reflects the enabled sorting behavior


7. Click **Save Settings**.



