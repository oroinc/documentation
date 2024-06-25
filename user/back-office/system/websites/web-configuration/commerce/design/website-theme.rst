.. _configuration--commerce--design--theme--theme-settings--website:

Configure Theme Settings per Website
====================================

.. hint:: Theme is configurable on three levels -- :ref:`globally <configuration--commerce--design--theme>`, :ref:`per organization <configuration--commerce--design--theme--theme-settings--organization>` and website.

In your Oro application, you can control and customize the storefront look and feel per website.

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **Theme Settings** section, configure the following options:

   * **Theme** --- select the storefront theme from the list.  For more details on how to customize a theme from the dropdown list, refer to the :ref:`theme configuration <back-office-theme-configuration>` topic.

   * **Product Image Placeholder** --- select the image file that will appear on the product listing and product view pages for the products that have no associated images to avoid a blank image page.

   * **Category Image Placeholder** --- select the image file to be applied to the category that has no associated image. The image is usually used in various category widgets.

5. In the **Page Templates** section, select the product page template from the list. Available options are *Default*, *Tabs*, *Wide*.

   .. important:: The Page Templates configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility. For v6.0 and above, please configure this option under :ref:`System > Theme Configuration <back-office-theme-configuration>`.

6. In the **Filter Settings** section, specify how the multi-select filters should look in the storefront. Available options are *Drop-down* and *All at once*.

   .. image:: /user/img/system/config_commerce/design/filter_settings_dropdown.png
      :alt: Illustration of the multi-select filter displayed in the drop-down and all at once in the storefront

   .. hint::
      To specify where the filter panel should be represented in the storefront, at the top or in the sidebar, refer to the :ref:`theme configuration <back-office-theme-configuration>` documentation.

      To control whether to hide or disable product attributes within filters, refer to the :ref:`filters and sorting settings <configuration--guide--commerce--configuration--catalog--filters-sorters>` documentation.


7. In the **Menu Templates** section, select the user menu display mode that defines the look and feel of the user menu in the storefront.

   .. important:: The Menu Templates configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility.

8. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin