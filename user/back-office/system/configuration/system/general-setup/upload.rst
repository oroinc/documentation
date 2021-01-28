:oro_documentation_types: OroCRM, OroCommerce

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

3. The following page opens:

   .. image:: /user/img/system/config_system/upload_settings_2.png
      :alt: Upload settings on global level

4. Clear the **Use Default** check box next to the option.

5. In the **File Size Settings** section, provide the maximum file size (in MB) that is allowed to be uploaded to the application.

6. In the **MIME types** section, select a set of mime types that will be supported for the file and image attachments in the system. **MIME types** are Multipurpose Internet Mail Extension types which help identify the types of the attachments and, thus, limit the possibility of uploading the documents of inappropriate extensions.

7. Add any MIME type by writing the required file or image format in the text box.

.. hint:: The **MIME types** settings can be configured globally and :ref:`per organization <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>`.

.. hint::
    The **Image Processing** feature is available since OroCommerce v4.2.0. To check which application version you are running, see the :ref:`system Information <system-information>`. Be aware that the Image Processing options are only available if libraries |JPEGOptim| and |PNGQuant| are set up.

8. In the **Image Processing** section, you can control whether to optimize or not the size of the uploading images in the storage. By default, the setting is enabled, which means that the size of all images that you upload to the system is compressed while preserving the quality.

   .. image:: /user/img/system/config_system/upload_settings_3.png
      :alt: Upload settings on global level

   **Enable Image Optimization** --- Select whether to enable the system to optimize the image, reducing the final image size. If disabled, all the images are uploaded without size modifications.

   Keep in mind that all the images uploaded in earlier application versions, remain intact. They won't be deleted or replaced even after migration. If you want to resize them, then you should delete them manually and reupload.

   **JPEG Resize Quality (%)** --- The setting determines the percentage of the .jpg image resize quality. You can set the values from 30 to 100. The higher the value, the better the image quality.

   **PNG Resize Quality (%)** --- The setting provides two options for controlling the quality of .png images. *Preserve quality* enables the system to slightly resize the image with the full preservation of the quality. *Minimize file size* enables the system to resize the image to its minimal possible size while still keeping the high quality.

9. Click **Save Settings**.

If :ref:`attachments are enabled for an entity <doc-entity-actions-create>`, the configuration of the entity will prevail and override the corresponding global one.

.. include:: /include/include-links-dev.rst
   :start-after: begin
