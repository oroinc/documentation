.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings:
.. _admin-configuration-upload-settings:
.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-globally:

Configure Global Upload Settings
================================

To define the size and formats of the files, reduce the size of images to be uploaded into the website back-office or the storefront, you need to configure the corresponding settings in the system configuration.

To configure the upload settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. In the **System Configuration** menu to the left, expand **General Setup** and click **Upload Settings**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_system/upload_settings_2.png
   :alt: Upload settings on global level

3.In the **File Size Settings** section, clear the **Use Default** checkbox and provide the maximum file size (in MB) that is allowed to be uploaded to the application.

4. In the **MIME types** section, select a set of mime types that will be supported for the file and image attachments in the system. **MIME types** are Multipurpose Internet Mail Extension types which help identify the types of the attachments and, thus, limit the possibility of uploading the documents of inappropriate extensions.

5. Add any MIME type by writing the required file or image format in the text box.

.. hint:: The **MIME types** settings can be configured globally and :ref:`per organization <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>`.

.. hint:: Be aware that the Image Processing options are only available if libraries |JPEGOptim| and |PNGQuant| are set up.

6. In the **Externally Stored Files**

   **Allowed URLs RegExp** --- The setting determines the regular expression that describes allowed URLs for externally stored files and images. If left empty, no external files and images will be allowed.

7. In the **Image Processing** section, you can control whether to optimize or not the size of the uploading images in the storage. By default, the setting is enabled, which means that the size of all images that you upload to the system is compressed while preserving the quality.

   .. image:: /user/img/system/config_system/upload_settings_3.png
      :alt: Upload settings on global level

   **Enable Image Optimization** --- Select whether to enable the system to optimize the image, reducing the final image size. If disabled, all the images are uploaded without size modifications.

   Keep in mind that all the images uploaded in earlier application versions, remain intact. They will not be deleted or replaced even after migration. If you want to resize them, then you should delete them manually and reupload.

   **JPEG Resize Quality (%)** --- The setting determines the percentage of the .jpg image resize quality. You can set the values from 30 to 100. The higher the value, the better the image quality.

   **PNG Resize Quality (%)** --- The setting provides two options for controlling the quality of .png images. *Preserve quality* enables the system to slightly resize the image with the full preservation of the quality. *Minimize file size* enables the system to resize the image to its minimal possible size while still keeping the high quality.

8. In the **WebP Settings** section, you can control the quality of the resized images in the WebP format. By default, images are additionally converted to the WebP format, so each image is provided to browser in two variants: a resized image in the original format and a resized image in the WebP format.

   **WebP Resize Quality (%)** --- The setting determines the percentage of the .webp image resize quality. You can set the values from 30 to 100. The higher the value, the better the image quality.

   Keep in mind that all the images uploaded in earlier application versions remain intact. They will not be deleted or replaced even after migration. If you want to resize them, then delete them manually and reupload.

9. In the **File Names** section, you can control whether to use original file names. By default, the setting is enabled.

   .. hint:: The **File Names** settings can be configured globally, :ref:`per organization <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>` and :ref:`per website <upload-settings--website>`.

   **Enable Original File Names** --- When enabled, the original file name is appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") are replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is ``media/cache/attachment/filter/product_gallery_main/b6d3b12a2194f276376d682d2e7e6bd1/1/5bae287538.jpg``. If the option is enabled, the file name is displayed in the storefront as follows ``media/cache/attachment/filter/product_gallery_main/623364376a0e8125036727/1/5bae287538-coffee-maker-bosch-RND123.jpg``

   .. note::
      When this option is enabled, the **Enable Original File Names** setting for Product Images is hidden from the system configuration page.

10. In the **Image Metadata Preservation** section, you can control whether uploaded images preserve their original metadata (available as of OroCommerce version 6.1.8).

   .. image:: /user/img/system/config_system/upload_settings_metadata.png
      :alt: Image Metadata Preservation settings

   **Preserve Original Image Metadata** --- When enabled, uploaded images will keep their original metadata, such as copyright information, camera settings, and other embedded data. Keep in mind that metadata may include sensitive information such as GPS location, author identity, or other personal details. Make sure the images you upload only contain information you want to share publicly.

   .. warning::
      Modification of the default value may cause temporary storefront slow-down until all product images are regenerated with new metadata. The changes on the product listing page will not be applied immediately and will require manual start of the search re-index. Make sure that the hard-drive has at least 50% space available as the regenerated images will be stored alongside the existing ones.

11. Click **Save Settings**.

If :ref:`attachments are enabled for an entity <doc-entity-actions-create>`, the configuration of the entity will prevail and override the corresponding global one.

.. include:: /include/include-links-dev.rst
   :start-after: begin
