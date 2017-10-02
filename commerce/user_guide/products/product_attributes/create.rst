.. _products--product-attributes--create:

.. begin
.. TODO add definition to every option

Create a Product Attribute
^^^^^^^^^^^^^^^^^^^^^^^^^^

See a short demo on `how to create product attributes <https://www.orocommerce.com/media-library/create-product-attributes-families>`_, or keep reading the step-by-step guidance below.

The creation of an attribute takes two steps:

* In step 1, you specify the basic properties, such as the attribute name and type.
* In step 2, you specify more advanced properties, some of which may depend on the selected attribute type.

Step 1
~~~~~~

To create an attribute:

1. Navigate to **Products > Product Attributes** using the main menu.

   .. image:: /user_guide/img/products/product_attributes/ProductAttributes.png
      :class: with-border

2. Click **Create Attribute**.

   The following page opens:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate.png
      :class: with-border

3. Complete the following fields:

   .. csv-table::
      :header: "Field", "Description"
      :widths: 10, 30

      "**Field Name**", "Fill in the field name that should be used to store the values of the product attribute. It should be between 2 and 22 characters long. Use only alphabetic symbols, underscore and numbers. "
      "**Type**","Select an attribute type.

      Select one of the **Fields** type to store the value of the specific data type.

        - BigInt
        - Select
        - String
        - Boolean
        - Currency
        - Date
        - DateTime
        - Decimal
        - File
        - Float
        - HTML
        - Image
        - Integer
        - Multi-Select
        - Percent
        - SmallInt
        - Text

      Select one of the **Relations** for the attribute to connect your custom entities as product information (these can be used for business intelligence and segments):

        - **Many to many** -- No limit of how many entity records of the selected type can be connected to the attribute, e.g. many custom entity records can be related to many products.
        - **Many to one** -- Attributes cannot have more than one entity record related to them, e.g. Products A-Z can relate to Promotion A. Product A cannot relate to multiple promotions. You can reuse the same promotion in multiple product details.
        - **One to many** -- One attribute can relate to many entity records, but every related entity record may be connected only once, e.g. Product A can be related to many promotions, but Promotion A cannot be related to multiple products."

4. Click **Continue**.

   The page with more product attribute details opens.

Step 2
~~~~~~

Proceed to create the attribute as described below.

1. Fill in remaining general information:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1.png
      :width: 450px
      :class: with-border

   * **Label** -- Enter the attribute label. It will be displayed both in the management console and in the front store.
   * **Description** -- When filled in, the description will be used as a field tooltip when the attribute appears on the forms.

2. Provide additional information for product attributes depending on their type:

   .. csv-table::
      :header: "Attribute Type", "Steps"
      :widths: 15, 50

      "**Select** and **Multi-Select**","Perform the following actions:
       1. Click **+ Add** next to *Options*.
       2. Type in the option label. Enable the check box next to the default option.

          .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Select2.png
             :class: with-border

       3. Repeat for more options.

          .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Select3.png
             :class: with-border

       4. Click **Do not set as default** link to clear the *Default* flag."
      "**Image**","Enter the maximum allowed file size and provide the thumbnail dimensions.

          .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Image.png
             :class: with-border"
      "**File**","Enter the maximum allowed file size.

         .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_File.png
            :class: with-border"
      "**Relations**:
         - Many to Many
         - One to many
         - Many to One","Complete the following fields:
       - **Target Entity** -- Select the entity you wish to relate your current attribute to.
       - **Bidirectional** -- Select *Yes* or *No*. If set to *Yes*, the attribute and the selected entity will be interconnected.
       - **Related Entity Data Fields** -- Available only for Many to Many and One to Many relations. Select those fields of the entity selected in *Target Entity* which contain information that you want to see on the master entity record edit page. These could be a couple of important details in addition to the title which gives you the most important information about the related entity record. Hold the Ctrl key to choose several fields.
       - **Related Entity Info Title** -- Available only for Many to Many and One to Many relations. Select the fields of the entity selected in *Target Entity* by which the users can identify the related entity record. These fields serve as a title to the related entity record on the master entity pages. Choose these fields carefully. It would be a good idea to select a related entity name or similar information. On the view page of the master entity record, these fields will appear as links to the corresponding related entity record. On the edit page of the master entity record, you will see these fields as titles of the section that contains information selected in Related Entity Data Fields. Hold the Ctrl key to choose several fields.
       - **Related Entity Detailed** -- Available only for Many to Many and One to Many relations. Select those fields of the entity selected in *Target Entity* which contain additional information that you want to see on the master entity record edit page. The values of the fields selected will be available in the dialog box that appears when you click the title of the related entity on the master page edit page. Hold the Ctrl key to choose several fields.
       - **Target Field** -- Available only for Many to One relation. Select the field of the entity selected in Target Entity by which the entity records will be tied."

3. Fill in **Import & Export** details, if the products should be eligible for import/export:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Import.png
      :class: with-border

   * **Column Name** -- Enter the name of the column (in a CSV file) that would represent the attribute you are creating. If left blank, a label will be used.
   * **Column Position** -- Type a number that corresponds to the position of the attribute in a CSV file.
   * **Use As Identity** -- Specify whether this column should be used as an identifier of the entity record. Select *No*, *Only when not empty*, or *Always*. If set to *Only when not empty*, the field may be omitted in the identity when it has no value.
   * **Exclude Column** -- Select *No*, if you want this field available for export, or *Yes* if you wish to exclude the column.

4. In the **Other** section, specify the configuration options for the product attribute view, search and use in the management console and front store.

   .. note:: Please note that additional options in the **Other** section depend on the type selected for the attribute (e.g. image, text, multi-select, etc.).

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreateOther.png
      :class: with-border

  ..  In the management console:

   .. csv-table::
      :header: "Field", "Description"
      :widths: 15, 50

      "**Available In Email Templates**","Select *Yes* if you wish this field to be available in email templates. The following is a sample flow of using the attribute in templates:
       1.  When creating and attribute, mark it as *Available in Templates*.
       2.  Navigate to **System > Emails > Templates** and click **Create Email Template**.
       3.  In the template, select *Product* as the entity that the template should relate to.
       4.  On the entity variables list on the right, find the attribute and click on it to add to the template.

           .. image:: /user_guide/img/products/product_attributes/AttributeInTemplate.png
              :class: with-border"
      "**Add To Grid Settings**","The option controls the availability and display of a field in the Products grid:
       - By default, *Yes and Display* is selected which makes the field available for use in the grid.
       - The *Yes and do not display* option means that the field is hidden by default.
       - The *Yes as Mandatory* option adds it permanently to all grid views."
      "**Show Grid Filter**","Select *Yes* to display the filter for the field on the user interface. Select *No*, and it will not be displayed by default, but you can add it as a filter if needed."
      "**Show on Form**","In the Show on Form field, select *Yes* if you wish to have this field displayed and be editable on record and page edits."
      "**Applicable Organization**","This check box determines whether you want this field to be available throughout all organizations.

         .. image:: /user_guide/img/products/product_attributes/AttributesApplicableOrganization.png
            :class: with-border"
      "**Contact Information**","Contact Information field has 3 possible values:
       - If you leave the field empty, it will not be treated as contact information.
       - Selecting *Email* in this field means that the values of the field are treated by marketing lists as email addresses.
       - If Phone is selected, the values of the field are treated by marketing lists as a phone number.

          .. image:: /user_guide/img/products/product_attributes/AttributesContactInformation.png.
             :class: with-border"
      "**Show On View**","Select *Yes* if you wish to have this field displayed on the Product view page."
      "**Priority**","Priority defines the order of the fields in view, edit, create pages and the grid.
                      Custom fields are always displayed one after another, usually below the system fields. If no priority is defined or the defined priority is 0, the fields will be displayed in the order in which they have been added to the system. The fields with a higher priority (a smaller value) will be displayed before the fields with a lower priority."
      "**Searchable**","When set to *Yes*, the attribute is included into the search options in the management console."
      "**Auditable**","When set to *Yes*, the the system will log changes made to this field values when users edit entity records."

.. In the front store
    .. csv-table::
      :header: "Field", "Description"
      :widths: 15, 50
      "**Searchable**","If enabled, attribute content can be found in the front store."
      "**Filterable**","Defines whether filter is available for the attribute in the front store."
      "**Filter By**","This field defines the type of filtering to be applied to the attribute." 
      "**Sortable**","Defines whether sorting is available for the attribute in the front store."
      "**Enabled**","Defines whether the attribute is enabled in the front store."
      "**Visible**","Defines whether the attribute is visible or hidden in the front store."


5. Once all options and information are provided, click **Save**.

6. If the created attribute is of a *table column* storage type, click **Update Schema** to reindex the data for search and filter.

   .. note:: The product attribute storage type is set to *table column* for the attribute with Select of Multi-Select data type, and also for the attribute of any type with *Filterable* or *Sortable* option enabled. If this step is omitted, the newly created attribute will not appear in the select attribute options in other areas of OroCommerce (e.g. product families configuration).

   .. image:: /user_guide/img/products/product_attributes/AttributeStorageType.png

.. TO DO Add links to entity management doc to explain table column + serialized fields.

.. finish
