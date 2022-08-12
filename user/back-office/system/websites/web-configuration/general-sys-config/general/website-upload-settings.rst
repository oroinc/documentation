:oro_documentation_types: OroCommerce

.. _upload-settings--website:

Configure Upload Settings per Website
=====================================

To configure the upload settings for a particular website:

1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > General Setup > Upload Settings** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **File Names** section, you can control whether to use original file names.

   .. image:: /user/img/system/websites/web_configuration/upload_settings_websites.png
      :alt: File names section on website level

   .. hint:: The **File Names** setting is available starting from v4.2.11. and can be configured :ref:`globally <admin-configuration-upload-settings>`, :ref:`per organization <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>` and per website.

   **Enable Original File Names** --- When enabled, the original file name is appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") are replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is ``media/cache/attachment/filter/product_gallery_main/b6d3b12a2194f276376d682d2e7e6bd1/1/5bae287538.jpg``. If the option is enabled, the file name is displayed in the storefront as follows ``media/cache/attachment/filter/product_gallery_main/623364376a0e8125036727/1/5bae287538-coffee-maker-bosch-RND123.jpg``

   .. note::
      When this option is enabled, the **Enable Original File Names** setting for Product Images is hidden from the system configuration page.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin
