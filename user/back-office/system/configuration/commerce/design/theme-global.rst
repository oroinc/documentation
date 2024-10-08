.. _configuration--commerce--design--theme:

Configure Global Theme Settings
===============================

In your Oro application, you can control and customize the storefront look and feel.

.. hint:: Theme is configurable on three levels -- globally, :ref:`per organization <configuration--commerce--design--theme--theme-settings--organization>` and :ref:`website <configuration--commerce--design--theme--theme-settings--website>`.

You can set the following theme-related options that apply globally by default:

* Pre-designed theme for the storefront
* The layout for the product page details
* Style of the selector in filters
* Display mode for the user menu in the storefront, and more

To configure the storefront theme options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Design > Theme** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Theme Settings** section, configure the following options:

   * **Theme** --- select the storefront theme from the list. For more details on how to customize a theme from the dropdown list, refer to the :ref:`theme configuration <back-office-theme-configuration>` topic.

   * **Product Image Placeholder** --- select the image file that will appear on the product listing and product view pages for the products that have no associated images to avoid a blank image page.

   * **Category Image Placeholder** --- select the image file to be applied to the category that has no associated image. The image is usually used in various category widgets.

4. In the **Page Templates** section, select the product page template from the list. A page template is used to render the product page in the storefront by default, unless the template is overridden in the product details. Available options are *Default*, *Tabs*, *Wide*.

   .. important:: The Page Templates configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility. For v6.0 and above, please configure this option under :ref:`System > Theme Configuration <back-office-theme-configuration>`.

5. In the **Filter Settings** section, specify how the multi-select filters should look in the storefront. Available options are *Drop-down* and *All at once*.

   .. image:: /user/img/system/config_commerce/design/filter_settings_dropdown.png
      :alt: Illustration of the multi-select filter displayed in the drop-down and all at once in the storefront

   .. hint::
      To specify where the filter panel should be represented in the storefront, at the top or in the sidebar, refer to the :ref:`theme configuration <back-office-theme-configuration>` documentation.

      To control whether to hide or disable product attributes within filters, refer to the :ref:`filters and sorting settings <configuration--guide--commerce--configuration--catalog--filters-sorters>` documentation.

6. In the **Menu Templates** section, select the user menu display mode that defines the look and feel of the user menu in the storefront.

  .. important:: The Menu Templates configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility.

7. In the **Grid Settings** section, configure the following options:

   * **Responsive Grids** --- This option makes storefront grids responsible, realigning row cells to fit various screen sizes.

   * **Swipe Actions Grids** --- This option enables swipe actions for the storefront grids on mobile devices.

8. Click **Save Settings**.
