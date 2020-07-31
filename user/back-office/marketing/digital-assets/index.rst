.. _digital-assets:

Manage Digital Assets in the Back-Office
========================================

:term:`Digital asset <Digital Assets>` management (DAM) is a tool for organizing, storing and managing digital files in one central location. For this purpose, use the Digital Assets section that has a list of all assets uploaded to the DA database of your application. Here, you can quickly find and edit the assets you need and create your personal database of the shared files.


.. image:: /user/img/marketing/digital-assets/digital_assets_main.png
   :alt: The list of all digital assets


The DAM functionality can be enabled for any entity attachment field that is of a :ref:`file, image, multiple files, or multiple images <admin-guide-create-entity-fields-basic>` type when creating an entity field. For more details, read the :ref:`Create Entity Fields <doc-entity-fields>` topic.

.. image:: /user/img/marketing/digital-assets/enable_DAM.png
   :alt: Enable DAM for the image entity field

If DAM is enabled, it changes the usual uploading behavior of the related type field for the selected entity. Now, your entity attachments are first uploaded to the DA database. Then, you can select the required asset from the list of available DA records. All attachments that are saved to the DA pool can be further re-used by any other DAM supported entity.

If DAM is disabled, the usual uploading behavior is applied, enabling you to select the asset from your local directory and do not save it to the DA pool. Such attachments cannot be shared and used by other entities.

.. image:: /user/img/system/entity_management/use_dam_difference_file.png
   :alt: The difference in the image uploading behavior when **Use DAM** is set to yes and no