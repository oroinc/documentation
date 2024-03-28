.. _configuration--commerce--design--theme--theme-settings--organization:

Configure Theme Settings per Organization
=========================================

.. hint:: Theme is configurable on three levels -- :ref:`globally <configuration--commerce--design--theme>`, per organization and :ref:`website <configuration--commerce--design--theme--theme-settings--website>`.

In your Oro application, you can control and customize the storefront look and feel per organization.

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

#. In the **Theme Settings** section, configure the following options:

   * **Theme** --- select the storefront theme from the list. The default theme starting from version 6.1 LTS is *Refreshing Teal*.

   * **Product Image Placeholder** --- select the image file that will appear on the product listing and product view pages for the products that have no associated images to avoid a blank image page.

   * **Category Image Placeholder** --- select the image file to be applied to the category that has no associated image. The image is usually used in various category widgets (e.g., *Featured Categories*).

   * **Display Price Tiers As** --- Select a multi or single unit table. A multi-unit table shows price tiers for all product units in the same table, which might not work well for products with many units or when quantity tiers are not aligned between units. Single-unit table shows price tiers only for the currently selected unit.

#. In the **Header** section, configure the following options for the storefront design:

   * **Promotional Content** --- select a content block that will be rendered above the header.The provided content must bes sized properly to fit into the designated area.

   * **Top Navigation Menu** --- select the menu will be rendered above the header.
   * **Language and Currency Switchers** --- select where you want to place the language and currency switcher. When *Above the header* option is selected, the language and currency switchers are rendered above the header on the devices with the sufficient screen width. On smaller screens the language/currency switchers will be placed inside the "hamburger" menu (product catalog).

   * **Standalone Main Menu** --- select how you want to display your product catalog menu. It can either be rendered separately to provide easy access to its top level items on the devices with sufficient screen width, or combined with other navigational elements in the "hamburger" menu.

   * **Quick Access Button** --- The quick access button can either open an additional menu, be a direct shortcut to the product catalog or another important section of the website.

   * **Quick Links** --- The top level items from the selected menu will be added to the header to provide quick access to the most frequently used pages.

   * **Search on Smaller Screens** --- On smaller screens the search input can be rendered in its own row to provide easy access to global search.

#. In the **Page Templates** section, select the product page template from the list. Available options are *Default*, *Tabs*, *Wide*.

   A page template is used to render the product page in the storefront by default, unless the template is overridden in the product details.

   Default:

   .. image:: /user/img/system/config_commerce/design/default-page-template.png

   Tabs:

   .. image:: /user/img/system/config_commerce/design/tabbed-page-template.png

   Wide:

   .. image:: /user/img/system/config_commerce/design/wide-page-template.png

#. In the **Filter Settings** section, specify how the multi-select filters should look in the storefront. Available options are *Drop-down* and *All at once*.

   .. image:: /user/img/system/config_commerce/design/filter_settings_dropdown.png
      :alt: Illustration of the multi-select filter displayed in the drop-down and all at once in the storefront

#. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin
