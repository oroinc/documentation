.. _configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization:

Configure Upload Settings per Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

To configure **MIME types** per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Upload Settings** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. The following page opens:

   .. image:: /configuration_guide/img/landing/upload_settings_2.png

4. Clear the **Use Default** check box next to the option.

5. Select a set of mime types that will be supported for the file and image attachments in the system.

6. Add any MIME type by writing the required file or image format in the text box.

7. Click **Save Settings**.

If `attachments are enabled for an entity <https://www.orocrm.com/documentation/current/admin-guide/entities/entity-actions#doc-entity-actions-create>`_, the configuration of the entity will prevail and override the corresponding settings configured both globally and per organization.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin