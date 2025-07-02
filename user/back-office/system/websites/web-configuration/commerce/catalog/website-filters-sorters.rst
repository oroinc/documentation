.. _configuration--guide--commerce--configuration--catalog--filters-sorters--website:

Configure Filters and Sorters Settings per Website
==================================================

.. hint:: Configuration for this option is available on three levels, :ref:`globally <configuration--guide--commerce--configuration--catalog--filters-sorters>`, :ref:`per organization <configuration--guide--commerce--configuration--catalog--filters-sorters--organization>`, and per website.

To configure filters and sorting options per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/filters_and_sorters_website.png

4. To change any of the options set on the organization level:

     a) Clear the **Use Organization** checkbox next to the option.
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


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin