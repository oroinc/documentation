:oro_documentation_types: OroCommerce

.. _configuration--commerce--design--theme--theme-settings--globally:
.. _configuration--commerce--design--theme--page-templates:
.. _configuration--commerce--design--theme--filter-settings:
.. _configuration--commerce--design--theme--menu-templates:
.. _configuration--commerce--design--theme:

Configure Global Theme Settings
===============================

In your Oro application, you can control and customize the storefront look and feel.

.. hint:: This can be done on three levels -- globally, :ref:`per organization <configuration--commerce--design--theme--theme-settings--organization>` and :ref:`website <configuration--commerce--design--theme--theme-settings--website>`.

You can set the following theme-related options that apply globally by default:

* Pre-designed theme for the storefront
* The layout for the product page details (default tabbed view, short, two column, or list)
* Style of the selector in filters
* Display mode for the user menu in the storefront

To configure the storefront theme options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Design > Theme** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/design/design_theme_global.png
      :alt: Global theme configuration settings

3. In the **Theme Settings** section, configure the following options:

   * **Theme** --- select the theme from the list. The theme controls general design of the storefront that defines its look and feel. *Default*, *blank*, and *custom* themes are available out of the box for the storefront.

   For example, this is how the address book looks in the storefront for the default and custom themes:

   **Default theme**

   .. image:: /user/img/system/config_commerce/design/MyProfileAddressBooks.png
      :alt: A sample of the Address Book menu in the storefront if the default theme is enabled

   **Custom theme**

   .. image:: /user/img/system/config_commerce/design/address_book_compact.png
      :alt: A sample of the Address Book menu in the storefront if the custom theme is enabled

   **Product Image Placeholder** --- select the image file that will appear on the product listing and product view pages for the products that have no associated images to avoid a blank image page.

   .. image:: /user/img/system/config_commerce/design/product_image_placeholder.png
      :alt: A sample of the product image placeholder on the product listing page

   **Category Image Placeholder** --- select the image file to be applied to the category that has no associated image. The image is usually used in various category widgets (e.g., *Featured Categories*).

   .. image:: /user/img/system/config_commerce/design/category_image_placeholder.png
      :alt: A sample of the product image placeholder for the on the product listing age

4. In the **Page Templates** section, select the product page template from the list.

   This page template is used to render the product page in the storefront by default, unless the template is overridden in the product details.

   *Default template* (tabbed), *Short page*, *Two-column page*, and *List page* templates are available out of the box. For preview and more information on these options, see the :ref:`Manage Product Page Design with Page Templates <user-guide--page-templates>` topic.

   Select the **Use Parent Scope Value** check box to use the default value.

5. In the **Filter Settings** section, specify how the multi-select filters should look in the storefront. Available options are *Drop-down* and *All at once*.

   For example, this is how the user menu looks for different values:

   **Drop-down**

   .. image:: /user/img/system/config_commerce/design/filter_settings_dropdown.png
      :alt: Illustration of the multi-select filter dispayed in the drop-down in the storefront

   **All at once**

   .. image:: /user/img/system/config_commerce/design/filter_settings_allatonce.png
      :alt: Illustration of the multi-select filter displayed all at once in the storefront

6. In the **Menu Templates** section, select the user menu display mode that defines the look and feel of the user menu in the storefront.

   For example, this is how the user menu looks for different values:

   **Show all items at once**

   .. image:: /user/img/system/config_commerce/design/ShowAllItemsAtOnce.png
      :alt: The storefront user menu look when the Show all items at once option is enabled

   **Show subitems in a popup**

   .. image:: /user/img/system/config_commerce/design/ShowSubitemsInPopup.png
      :alt: The storefront user menu look when the Show subitems in a popup option is enabled

7. In the **Grid Settings** section, configure the following options:

   **Responsive Grids** --- This option makes storefront grids responsible, realigning row cells to fit various screen sizes.

   **Swipe Actions Grids** --- This option enables swipe actions for the storefront grids on mobile devices.

8. Click **Save Settings**.


