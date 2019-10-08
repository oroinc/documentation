:oro_documentation_types: OroCRM, OroCommerce

.. _admin-guide-manage-entity-fields:

Manage Entity Fields
====================

In your Oro applications, you can manage the already existing and newly added entity fields. Specifically, you can edit and delete them, as well as import fields in bulk. To make sure that the new or updated fields are successfully added to entities, you update the schema.

Edit Custom Entity Fields
-------------------------

.. warning:: If the **Show on Form** value has been set to **No** when creating the field, you cannot create or update its values from the Oro application. This is only reasonable for the field values uploaded to the system during synchronization. 

To edit a custom entity field:

1. Navigate to **System > Entities > Entities Management**.
2. On the **All Entities** page, click the required entity to select it. 
3. On the page of the selected entity, click **Fields**. 

   .. image:: /user/img/system/entity_management/opportunity_entity_fields.png
      :alt: A list of custom entity fields displayed in the field section

4. In the **Fields** section, click the required field.
5. Update the field, as described in the :ref:`Create Entity Fields <admin-guide-create-entity-fields>` topic. 
6. Click **Save**. 

.. note:: Alternatively, you can edit an entity field from the page of the selected entity by clicking the |IcEdit| **Edit** icon at the right end of the corresponding row.

Delete Custom Entity Fields
---------------------------

To delete a custom entity field:

1. Navigate to **System > Entities > Entities Management**.
2. On the **All Entities** page, click the required entity to select it. 
3. On the page of the selected entity, click **Fields**. 
4. In the  **Fields** section, choose the required entity field and click the |IcDelete| **Delete** icon at the right end of the corresponding row. 
5. In the **Deletion Confirmation** dialog box, click **Yes**.
6. :ref:`Update the schema <admin-guide-update-schema>` (if the storage type for the field is set to **Table Column**). 

.. _admin-guide-import-entity-fields:

Import Fields
-------------

To simplify creation of entity fields, you can import a .csv file with a list of properties and their fields.

.. important:: You can only import data saved in the .csv (comma separated values) format. 

1. Navigate to **System > Entities > Entity Management**.
2. In the grid on the **All Entities** page, click the required entity.
3. On the page of the entity, click **Import File** on the top right.

   .. image:: /user/img/system/entity_management/entity_import_dialog.png
      :alt: A popup dialog that opens when clicking the import file button

4. In the dialog that opens, you can:

   * **Export Template** --- Enables you to download a .csv file with sample data.
   * **Validate** --- Enables you to check the file for errors before uploading it. Validation results are sent to your email. If there are any records with errors, you can fix them in the .csv file before importing to the application.
   * **Upload the file** --- Click **Choose File** to select the .csv file you prepared, and click **Submit**.

5. :ref:`Update the schema <admin-guide-update-schema>` to apply the changes if the storage type for the field is set to **Table Column**.

.. _admin-guide-update-schema:
.. _schema update:

Update Schema
-------------

Every time you create or delete :ref:`entity fields <doc-entity-fields>` with the storage type set to **Table Column**, you need to update the schema (i.e. the internal structure) to apply your changes. This has to be done so that the system knows how the existing fields are interconnected and where to find them in the database. 

.. important:: Schema update is not required for entity fields with the **Serialized field** storage type.

1. Click **Update Schema** on the page of the selected entity.
2. In the **Schema update confirmation** dialog box, click **Yes, Proceed**. Keep in mind that schema update may take some time to finish.

    .. image:: /user/img/system/entity_management/update_schema.png
       :alt: An interactive message that appears once the schema is updated

**Related Topics**

* :ref:`Create Entity Fields <admin-guide-create-entity-fields>`
* :ref:`Examples of Creating Custom Entity Fields <admin-guide-create-entity-fields-example>`
* :ref:`Provide Basic Entity Field Properties <admin-guide-create-entity-fields-basic>`
* :ref:`Provide Advanced Entity Field Properties <admin-guide-create-entity-fields-advanced>`

.. include:: /include/include-images.rst
   :start-after: begin