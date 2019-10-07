:oro_documentation_types: crm, commerce

.. _admin-guide-data-audit:
.. _user-guide-data-audit:

Data Audit
==========

Data Audit enables you to see the full history of changes made to any entity and its fields that have been marked as *auditable*, and create out-of-the-box reports based on these changes.

Mark an Entity as Auditable
---------------------------

Marking a particular entity as auditable defines whether the system logs the actions performed to this entity and who performed these actions.

To mark an entity as auditable:

1. Navigate to **System Configuration > Entities > Entity Management** in the main menu.
2. Locate the required entity and open its edit page.

   .. hint:: To save time looking for the entity, use filters at the top of the record table.

   .. image:: /img/backend/architecture/select_entity_for_data_audit.png
      :alt: Select an entity to edit

3. In the **Other** section, set the *Auditable* field to **Yes**.

   .. image:: /img/backend/architecture/auditable_field.png

   .. hint:: For more information on entities, see the :ref:`Create an Entity <doc-entity-actions-create>` topic.

4. Click **Save and Close**.

View Entity Change History
--------------------------

You can monitor changes to auditable entities on their view and edit pages by clicking on the **Change History** link on the top right.

The history includes the author and the time of the change, and the difference between the previous and the new version.

.. image:: /img/backend/architecture/changed_history.png
   :alt: Changed history of the customer entity

Make sure that the entity field of the entity are also marked as auditable if you want to track the history of its changes. For instance, if the *newArrival* entity field of the *Product* entity has the *Auditable* field set to *No*, then no changes made to this field are going to be tracked.

.. image:: /img/backend/architecture/entity_fields_auditable.png
   :alt: Auditable column for entity fields

To set an entity field as *Auditable*:

1. Open its edit page.
2. In the **Backoffice options** section, select **Yes** from the dropdown list for the *Auditable* field.

   .. image:: /img/backend/architecture/set_entity_field_to_auditable.png
      :alt: Set an entity field as auditable

   For instance, once we made the *newArrival* field as auditable, any changes to this field have become traceable, as illustrated in the screenshot below:

   .. image:: /img/backend/architecture/change_history_for_product.png
      :alt: Change history of a product

Create a Data Audit Report
---------------------------

You can create reports based on the changes that have taken place in auditable entities.

As an illustration, we are going to create a report of products that have been discontinued this year, i.e., the items that have **Inventory Status** changed to *Discontinued*.

.. hint:: First, make sure that the *Inventory Status* entity field is auditable.

1. Navigate to **Reports & Segments > Manage Custom Reports**.
2. Click **Create Report**
3. Provide the following key details in the **General** section:

   * Name --- Give the report a name.
   * Entity --- Select *Product* for entity type.
   * Report Type --- Select *Table*.

4. In **Filters**, drag and drop the **Data Audit** field to the area on the right.
5. Set the following conditions:

   * Product > Inventory Status
   * Has been changed to > is any of > Discontinued
   * Interval between > 1.01.2018-31.12.2019

    .. image:: /img/backend/architecture/data_audit_report.png
       :alt: Data audit report

6. Add the following columns to the table:

   * SKU
   * Inventory Status
   * Created At
   * Update At

7. Click **Save and Close**.

    .. image:: /img/backend/architecture/data_audit_report_generated.png
       :alt: Data audit report generated

View Changes of Auditable Entities
----------------------------------

All changes made to auditable entities and fields are logged into the system and saved under **System > Data Audit**. You can filter the table by required parameters and save the filtered page for future reference.

 .. image:: /img/backend/architecture/data_audit_grid.png
    :alt: Data audit grid under System > Data Audit

The report grid contains the following columns:

.. csv-table::
  :header: "Name","Description"
  :widths: 10, 30

  "ACTION","Defines the action that has been performed with the :term:`record`. You can see if the record has been
  created, updated or removed."
  "VERSION","Corresponds to the consecutive number of changes performed with the specific record."
  "ENTITY TYPE","Type of the :term:`entity` to which the record belongs."
  "ENTITY NAME","Name of the specific record tracked."
  "ENTITY ID","ID of the entity to which the record belongs."
  "DATA","Details of the change."
  "AUTHOR","Name and email of the :term:`user` that has performed the change."
  "ORGANIZATION",":term:`Organization`, within which the change has been performed."
  "LOGGED AT","Date and time when the event was logged."

**Related Topics**

* :ref:`Entity Management <entities-management>`
* :ref:`Reports <user-guide-reports>`