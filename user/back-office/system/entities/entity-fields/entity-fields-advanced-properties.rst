:oro_documentation_types: OroCRM, OroCommerce

.. _admin-guide-create-entity-fields-advanced:

Advanced Entity Field Properties
--------------------------------

.. note:: This topic is part of the section on :ref:`Creating Entity Fields <admin-guide-create-entity-fields>`, and describes the second stage of creating a new entity field.

Once the :ref:`basic properties <admin-guide-create-entity-fields-basic>` (field name, storage type and type) have been specified, proceed to create the custom entity field as described below.

1. In the **General Information** section, provide:

   * **Label** --- Type a label that will be used for referring to the field on the interface. By default, the label is the same as **Name**.
   * **Description** --- Type a short but meaningful description that will appear as a field tooltip on the interface.  
   * **Field Type-related Properties** --- Depending on the entity type selected when defining the :ref:`basic properties <admin-guide-create-entity-fields-basic>` for the entity field you are creating, additional :ref:`type-related options <admin-guide-create-entity-fields-type-related>` appear in the **General Information** section once you click **Continue**.  
     
2. In the **Import and Export** section, specify the following information:

   .. image:: /user/img/system/entity_management/entity_field_import_and_export.png
      :alt: Basic settings of the import and export section available when creating a new entity field

   * **Column Name** --- Type a name that will be used for identifying the field in the .csv file with entity records. If left empty, the **Label** value will be used for identifying the field when you export entity records.
   * **Column Position** --- Type a number that corresponds to the position of this field in the .csv file that contains entity records.
   * **Exclude Column** --- Select *No* if you want this field to be available for export. Select *Yes* if you do not want this field to be available for export (this field will not be present in the .csv file obtained as a result of the export operation).

     .. note:: Import and export of non-default fields may not be supported until the dedicated customization is developed.

   * **Export Fields** --- When a field is a relation (many to many, many to one, one to many), in the Export Fields you can select whether all the fields of the related entity are exported, or the identity fields only.

      .. comment: May apply to import as well. Not confirmed.

3. In the **Other** section, provide the following information:

   .. image:: /user/img/system/entity_management/entity_field_other.png
      :alt: The general settings of the other section available when creating a new entity field

   * **Available in Email Templates** --- If this option is set to *Yes*, values of the field can be used for creating email patterns.
   * **Contact Information** --- Possible values are:    

      - **Empty** --- The field will not be treated as contact information.
      - **Email** --- Values of the field will be treated by :ref:`marketing lists<user-guide-marketing-lists>` as email addresses.
      - **Phone** --- Values of the field will be treated by marketing lists as phone numbers.         

   * **Show on Grid** --- If set to *Yes*, the field will be displayed in a separate column of the respective grid.
   * **Show Grid Filter** --- Not available for :ref:`serialized fields <book-entities-extended-entities-serialized-fields>`. If set to *Yes*, a corresponding filter will be added to :ref:`grid filters <doc-grids-actions-filters>` by default.
   * **Show on Form** --- If set to *Yes*, the field value appears as editable on record edit pages.

     .. warning:: If the **Show on Form** value has been set to **No** when creating the field, you cannot create or update its values from your Oro application. This is only reasonable for the field values uploaded to the system during synchronization.

   * **Show on View** --- If set to *Yes*, the field is displayed on record view pages.
   * **Exportable** --- If set to *Yes*, the value of this field will be present in the :ref:`product data export file in the storefront <sys--commerce--product--customer-settings>`.
   * **Priority** --- Defines an order of custom fields on entity record view, edit, and create pages, and on the respective grid. 
  
      Custom fields are always displayed one after another, usually below the system fields. If no priority is defined or the defined priority is 0, the fields will be displayed in the order in which they have been added to the system. The fields with a higher priority (a bigger value) will be displayed before the fields with a lower priority.

   * **Searchable** --- If set to *Yes*, the entities can be found using the :ref:`search <user-guide-getting-started-search>` by values of this field.
   * **Global Search Boost** --- Available for the OroCommerce Enterprise edition if Elasticsearch is used as the search engine. This option enables you to :ref:`boost <bundle-docs-commerce-website-elastic-search-bundle-attributes-boost>` the value of the field during search. By default, the boost for sku is set to 5, for names to 3, meaning that the searchable word is first searched among SKUs, then names, etc. The option works for searchable attributes only.
   * **The Search Result Title** --- If set to *Yes*, the field value will be included into the search result title.
   * **Auditable** --- Not available for :ref:`serialized fields <book-entities-extended-entities-serialized-fields>`. If set to *Yes*, the system will log changes made to this field values when users edit entity records.
   * **Applicable Organizations** --- Defines for what :term:`organizations <Organization>` the custom field will be added to the :term:`entity <Entity>`. **All** is selected by default. Clear the **All** check box to choose specific organizations from the list.

   .. caution:: If the **Show on Form** value has been set to *No*, there will be no way to create/update the field values from your Oro application. Thus, such configuration is reasonable only for data which is uploaded to the system during a synchronization.

   * **Allowed MIME types** --- Limits the types of files you can attach to an entity. This applies to file attributes only. For instance, using this option, you can enable application users to upload files only in .pdf format. For this, add the *File* field to the opportunity entity, and enter *application/pdf* into the *Allowed Mime types* field. If this field is left empty, the list of :ref:`MIME types defined in the system configuration <admin-configuration-upload-settings>` is applied.

4. Once all the information has been provided, click **Save and Close** on the top right.
5. On the entity page, click **Update Schema** on the top right, if the storage type for the entity field has been set to *Table Column*.


