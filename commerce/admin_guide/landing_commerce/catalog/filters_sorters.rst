.. _configuration--guide--commerce--configuration--catalog--filters-sorters:

Limit Filters and Sorters
=========================

.. contents:: :local:
   :depth: 1

To make sure that only the attributes of the required product family are displayed in the storefront, you can limit filters and sorting options in OroCommerce. 

When unrelated product filters and sorting options are hidden, only those attributes that belong to the current product family are displayed in the storefront.

.. For instance, the Lawnmowers and Pressure Washers product collections usually have different product attributes: for lawnmowers these can be *Blade Type* or *Cutting Heights*, while for pressure washers the *Flow Rate* or *Temperature*. Ideally, you would not want the *Flow Rate* to be displayed as a filtering option for lawnmowers in the storefront.

Configuration for this option is available on two levels, globally and per website.

.. note:: By default, the option is enabled for OroCommerce versions 3.0 and higher. 

.. _configuration--guide--commerce--configuration--catalog--filters-sorters--globally:

Control Limiting Filters and Sorting Options Globally
-----------------------------------------------------

To enable/disable limiting filters and sorters globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Filters and Sorters** in the panel to the left.

   The following page is displayed:

   .. image:: /admin_guide/img/configuration/catalog/filters_sorters/globally_filters_sorters.png

   By default, the option is enabled. 

3. To disable it, clear the **Use Default** option first and then the **Hide Unrelated Product Filters and Sorting Options** setting.
4. Click **Save Settings**.
   
.. _configuration--guide--commerce--configuration--catalog--filters-sorters--website:
   
Control Limiting Filters and Sorting Options per Website
--------------------------------------------------------

To enable/disable limiting filters and sorters per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Filters and Sorters** in the menu to the left.

   The following page is displayed:

   .. image:: /admin_guide/img/configuration/catalog/filters_sorters/website_filters_sorters.png

   By default, the option is enabled.

4. To disable it, clear the **Use System** option first and then the **Hide Unrelated Product Filters and Sorting Options** setting.
5. Click **Save Settings**.

  
.. include:: /img/buttons/include_images.rst
   :start-after: begin
