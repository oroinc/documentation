.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings:
.. _admin-configuration-upload-settings:
.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-globally:

Upload Settings
===============

.. contents:: :local:
   :depth: 2

To define the formats of the files to be uploaded into the website back-office or the storefront, you need to configure the corresponding **MIME types** settings in the system configuration.

**MIME types** are Multipurpose Internet Mail Extension types which help identify the types of the attachments and, thus, limit the possibility of uploading the documents of inappropriate extensions.

.. hint:: The **MIME types** settings can be configured globally and :ref:`per organization <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>`.

To configure **MIME types** globally:

1. Navigate to **System > Configuration** in the main menu.
2. In the **System Configuration** menu to the left, expand **General Setup** and click **Upload Settings**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. The following page opens:

   .. image:: /user_doc/img/system/config_system/upload_settings_1.png
      :alt: Upload settings on global level

4. Clear the **Use Default** check box next to the option.
5. Select a set of mime types that will be supported for the file and image attachments in the system.
6. Add any MIME type by writing the required file or image format in the text box.
7. Click **Save Settings**.

If `attachments are enabled for an entity <https://oroinc.com/doc/orocrm/current/admin-guide/entities/entity-actions#doc-entity-actions-create>`_, the configuration of the entity will prevail and override the corresponding global one.


