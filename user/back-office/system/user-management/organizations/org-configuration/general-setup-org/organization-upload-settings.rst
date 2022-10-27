:oro_documentation_types: OroCRM, OroCommerce

.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization:

Configure Upload Settings per Organization
==========================================

To configure **MIME types** per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Upload Settings** in the menu on the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/general/upload_settings_2.png
      :alt: Selecting mime types for a file or an image in the upload settings menu

4. Clear the **Use Default** checkbox next to the option.

5. Select a set of mime types that will be supported for the file and image attachments in the system.

6. Add any MIME type by writing the required file or image format in the text box.

7. In the **File Names** section, you can control whether to use original file names. By default, the setting is enabled.

   .. image:: /user/img/system/user_management/org_configuration/general/upload_settings_3.png
      :alt: File names section on organization level

   .. hint:: The **File Names** settings can be configured :ref:`globally <admin-configuration-upload-settings>`, per organization and :ref:`per website <upload-settings--website>`.

   **Enable Original File Names** --- When enabled, the original file name is appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") are replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is ``media/cache/attachment/filter/product_gallery_main/b6d3b12a2194f276376d682d2e7e6bd1/1/5bae287538.jpg``. If the option is enabled, the file name is displayed in the storefront as follows ``media/cache/attachment/filter/product_gallery_main/623364376a0e8125036727/1/5bae287538-coffee-maker-bosch-RND123.jpg``

   .. note::
      When this option is enabled, the **Enable Original File Names** setting for Product Images is hidden from the system configuration page.

8. Click **Save Settings**.

If :ref:`attachments are enabled for an entity <doc-entity-actions-create>`, the configuration of the entity will prevail and override the corresponding settings configured both globally and per organization.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
