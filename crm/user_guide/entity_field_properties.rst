
Entity Field Properties
==========================

.. contents:: :local:
    :depth: 3


The creation of the entity field takes two steps. In step 1, you specify just the very basic properties: name, field type and field storage type. In step 2, you specify more advanced properties, some of which can be field type-related.

Basic Entity Field Properties
-------------------------------

General Information Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|

.. image:: ./img/entity_management/new_entity_field.png

|

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Field Name**","Mandatory. Type a name of the field that will be used to refer to it in the system. 
  
  This name must unique within an entity. 
  It cannot be a `reserved SQL word <http://msdn.microsoft.com/en-us/library/ms189822.aspx>`_ , nor a
  `reserved PHP word <http://php.net/manual/en/reserved.keywords.php>`_."
  "**Storage Type**","Mandatory. Select how the field is stores in the system. There are two options:

  - **Serialized field**—Use this storage type for simple custom fields that keep information necessary for 
    an single entity. The field will appear in the system as soon as it has been added and no :ref:`schema update <user-guide-entity-management-create-update>` is required. 
  
    .. important:: 
      Serialized fields cannot be used for :ref:`grid filters <user-guide-ui-components-grid-filters>`, for the :ref:`report <user-guide-reports>` and :ref:`chart <user-guide-reports-chart>` generation, for data audit, for creation of :ref:`segments <user-guide-filters-segments>` and :ref:`relations <user-guide-entity-management-create-relation>`.
  
      Serialized fields cannot be used for files, multi-selects or option sets.
  
  - **Table column**—Store field values to a database table. If this option is selected, the field can be used without the limitations applicable to a serialized field. For this type of fileds a :ref:`schema update <user-guide-entity-management-create-update>` is required.
  "
  "**Type**","Mandatory. Select the field type from the list.
  
  The following types are available:

  - Fields
  
    - BigInt  
    
    - Boolean
    
    - Currency
    
    - Date
    
    - DataTime
    
    - Decimal
      
    - File
    
    - Float
    
    - Image
    
    - Integer
    
    - Multi-Select
    
    - Percent
    
    - Select
    
    - SmallInt
    
    - String
    
    - Text
    
  - Relations—Relation is a field that enables users to tie record(s) of one entity to record(s) of another entity. For example each customer has an account, and each account can be assigned several contacts.
  
    - Many to many
    
    - Many to one
    
    - One to many
  
  For the help on selection the field that is right for your purposes, see the `Entity Field Types <./entity-fields-types>`__ guide. 
  "
  



Advanced Entity Field Properties
---------------------------------


Properties that can be defined may vary subject to the chosen field type. 

The following sections provide description of common properties defined for all or most of the types and peculiarities of specific types.

Common Properties
^^^^^^^^^^^^^^^^^^^


General Information Section
""""""""""""""""""""""""""""

|

.. image:: ./img/entity_management/entity_field_general_information2.png

|


Fields **Name**, **Storage Type**, **Type** that you filled in when specifying information for basic entity field properties (see the `Basic Entity Field Properties <./entity-field-properties#basic-entity-field-properties>`__ section are still present on the interface but their values cannot be changed now.
) 

There are two new fields in this section:

.. csv-table:: 
  :header: "Field","Description"
  :widths: 10,30

  "**Label**","Mandatory. Type the label which the field will be referred to on the interface by. By default label is the same as **Name**."
  "**Description**","Type the short by meaningful description that will appear as a field tooltip on the interface."
  



Import and Export Section
""""""""""""""""""""""""""

|

.. image:: ./img/entity_management/entity_field_import_and_export.png

|

.. csv-table:: 
  :header: "Field","Description"
  :widths: 10,30

  "**Column Name**","Type a name that is used to identify this field in the .csv file with entity records. If left empty, the **Label** value will be
  used when you  export the entity records."
  "**Column Position**","Type a number that corresponds to the position of this field in the .csv file with entity records."

  "**Exclude Column**", " - **No**—Select this value if you want this field to be available for export. 

  - **Yes**—Select this value if you do not want this field to be available for export (this field will not be present in the .csv file obtained as a result of the export operation).

  "
  
  


Other
""""""

|

.. image:: ./img/entity_management/entity_field_other.png

|


.. csv-table:: 
  :header: "Option","Description"
  :widths: 10,30

  "**Available in Email Templates**","If set to *Yes*, values of the field can be used to create email patterns."
  "**Contact Information**","Possible values are:
    
    - If empty, the field will not be treated as a contact information.
    - **Email**—Values of the field will be treated by the :ref:`marketing lists<user-guide-marketing-lists>`
      as an email address.
    - **Phone**—Values of the field will be treated by the marketing lists as a phone number.

  "
  "**Show on Grid**","If set to *Yes*, the field will be displayed in a separate column of the respective grid."
  "**Show Grid Filter**","Not available for serialized fields. If set to *Yes*, a corresponding filter will be added to 
  the :ref:`grid filters <user-guide-ui-components-grid-filters>` by default." 
  "**Show on Form**","If set to *Yes*, the field value can be edited from the edit form of the record."
  "**Show on View**","If set to *Yes*, the field is displayed on the *View* page."
  "**Priority**","Priority defines the order of custom fields on the entity record view page, edit and create pages and and 
  grid. 
  
  Custom fields are always displayed one after another, usually below the system fields. If no priority is defined or the 
  defined priority is 0, the fields will be displayed in the order they have been added to the system (the later - the
  lower). The fields with a higher priority (a bigger value) will be displayed before the fields with a lower priority."
  "**Searchable**","If set to *Yes*, the entities can be found with OroCRM's 
  :ref:`search functionality <user-guide-getting-started-search>` by values of this field."
  "**The Search Result Title**","If set to *Yes*, the field value will be included into the search result title."
  "**Auditable**","Not available for serialized fields. If set to *Yes*, data on the field processing details is 
  logged."
  "**Applicable Organizations**","Defines for what :term:`organizations <Organization>` the custom field will be added 
  to the :term:`entity <Entity>`.
  
  **All** is chosen by default. Uncheck to choose specific organizations from the list."


.. caution:: 

      If the **Show on Form** value has been set to **No**, there will be no way to create/update the field values from 
      OroCRM. This is only reasonable for the fields values which are uploaded to the system during a synchronization. 






Type-Related Properties
-------------------------


Decimal
^^^^^^^

Decimal fields have two additional optional properties that can be defined in the **General** section:

+-----------+----------------------------------------------------------------------------------+
| Field     | Description                                                                      |
+===========+==================================================================================+
| Precision | Maximum number of digits. E.g. 15.252 has precision 5. And 1.12 has precision 3. |
+-----------+----------------------------------------------------------------------------------+
| Scale     | Maximum number of decimal places. E.g. 15,252 has scale 3. And 1.12 has scale 2. |
+-----------+----------------------------------------------------------------------------------+



String
^^^^^^^

String fields have an additional optional property in the **General** section:

+--------+-----------------------------------------------------------------------+
| Field  | Description                                                           |
+========+=======================================================================+
| Length | The number of characters in the string. It is a number from 1 to 255. |
+--------+-----------------------------------------------------------------------+



Text
^^^^^


.. TODO

.. important::
   - The fields of the **Text** type aren't displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 



  


File
^^^^^

File fields have an additional property in the **General** section:

+-----------+-----------------------------------------------------------------+
| Field     | Description                                                     |
+===========+=================================================================+
| File Size | Mandatory. The maximum file size allowed for an upload (in MB). |
+-----------+-----------------------------------------------------------------+

.. important::

  - Only MS Office .doc, MS Office .xls, .pdf, .zip, .gif", .jpeg, and .png will be allowed for upload for file fields.

  - The fields of the **File** type can be only of the **Column table** storage type.

  - These fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.
  
  - The fields of the **File** type aren't displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
  

.. warning::
  - Auditing is not available for actions with the entity fields of the **File** type.




Image
^^^^^^

Image fields have three additional property in the **General** section:

+------------------+------------------------------------------------------+
| Field            | Description                                          |
+==================+======================================================+
| File Size        | The maximum file size allowed for an upload (in MB). |
+------------------+------------------------------------------------------+
| Thumbnail Width  | The image thumbnail width in pixels.                 |
+------------------+------------------------------------------------------+
| Thumbnail Height | The image thumbnail height in pixels.                |
+------------------+------------------------------------------------------+


.. important::

  - Only .gif, .jpeg and .png file extansion will be allowed for upload for image fields.

  - The fields of the **Image** type can be only of the **Column table** storage type.

  - These fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.
  
  - The fields of the **Image** type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
  

.. warning::
  - Auditing is not available for actions with the entity fields of the **File** type.


  
Select 
^^^^^^^

Select fields have an additional property in the **General** section:


+---------+----------------------------------------------------------------------------------------------------------------------------------------------------+
| Field   | Description                                                                                                                                        |
+=========+====================================================================================================================================================+
| Options | Define values that will be included in the select list.                                                                                            |
|         |                                                                                                                                                    |
|         | To add an option, click the :guilabel:`+Add` button.                                                                                               |
|         |                                                                                                                                                    |
|         | To set the default option, select the check box next to the option. Click the **Do not set as Default** link to clear the **Default** check boxes. |
|         |                                                                                                                                                    |
|         | To move an option up or down on the list, drag the |IcMove| **Move** icon next to the option.                                                      |
|         |                                                                                                                                                    |
|         | To delete an option, click the :guilabel:`x` icon next to the option. Please note that if you delete an option,                                    |
|         |                                                                                                                                                    |
|         | it will be removed from all the entity records in the system where it is currently present.                                                        |
+---------+----------------------------------------------------------------------------------------------------------------------------------------------------+



.. important::
  - The fields of the **Select** type can be only of the **Column table** storage type.

  - These fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.
  
.. warning::
  When editing system select fields note, that some options could be defined as system and cannot be deleted.  


Multi-Select
^^^^^^^^^^^^^

Multi-select fields have an additional property in the **General** section:


+---------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Field   | Description                                                                                                                                                                             |
+=========+=========================================================================================================================================================================================+
| Options | Define values that will be included in the multi-select list.                                                                                                                           |
|         |                                                                                                                                                                                         |
|         | To add an option, click the :guilabel:`+Add` button.                                                                                                                                    |
|         |                                                                                                                                                                                         |
|         | To set the default option, select the check box next to the option. You can set several default options. Click the **Do not set as Default** link to clear the **Default** check boxes. |
|         |                                                                                                                                                                                         |
|         | To move an option up or down on the list, drag the |IcMove| **Move** icon next to the option.                                                                                           |
|         |                                                                                                                                                                                         |
|         | To delete an option, click the :guilabel:`x` icon next to the option. Please note that if you delete an option,                                                                         |
|         |                                                                                                                                                                                         |
|         | it will be removed from all the entity records in the system where it is currently present.                                                                                             |
+---------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+



.. important::
  - The fields of the **Multi-Select** type can be only of the **Column table** storage type.

  - These fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.
  
.. warning::
   When editing system select fields note, that some options could be defined as system and cannot be deleted.  



Many to many
^^^^^^^^^^^^^

Many to many fields have additional properties in the **General** section:

+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Field                      | Description                                                                                                                                                                                              |
+============================+==========================================================================================================================================================================================================+
| Target Entity              | Mandatory. Select the entity which record(s) will be tied with records of the current entity.                                                                                                            |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Data Fields | Mandatory. Select those fields of the entity selected in **Target Entity** which contain information that you want to see on the master entity record edit page.                                         |
|                            |                                                                                                                                                                                                          |
|                            | This is like a couple of important details in edition to the title which give you the most important information about the related entity record.                                                        |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Info Title  | Mandatory. Select the fields of the entity selected in **Target Entity** by which the users can identify the related entity record.                                                                      |
|                            |                                                                                                                                                                                                          |
|                            | These fields serve as a title to the related entity record on the master entity pages. Choose these fields carefully. The good decision would be to select a related entity name or similar information. |
|                            |                                                                                                                                                                                                          |
|                            | On the view page of the master entity record, these fields will appear as links to the corresponding related entity record.                                                                              |
|                            |                                                                                                                                                                                                          |
|                            | On the edit page of the master entity record, you will see these fields as titles of the section that contains information selected in **Related Entity Data Fields** .                                  |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Detailed    | Mandatory. Select those fields of the entity selected in **Target Entity** which contain additional information that you want to see on the master entity record edit page.                              |
|                            |                                                                                                                                                                                                          |
|                            | The values of the fields selected will be available in the dialog box that appears when you click the title of the realted entity on the master page edit page.                                          |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

                

.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 



One to many
^^^^^^^^^^^^^

One to many fields have additional properties in the **General** section:

+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Field                      | Description                                                                                                                                                                                              |
+============================+==========================================================================================================================================================================================================+
| Target Entity              | Mandatory. Select the entity which record(s) will be tied with records of the current entity.                                                                                                            |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Data Fields | Mandatory. Select those fields of the entity selected in **Target Entity** which contain information that you want to see on the master entity record edit page.                                         |
|                            |                                                                                                                                                                                                          |
|                            | This is like a couple of important details in edition to the title which give you the most important information about the related entity record.                                                        |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Info Title  | Mandatory. Select the fields of the entity selected in **Target Entity** by which the users can identify the related entity record.                                                                      |
|                            |                                                                                                                                                                                                          |
|                            | These fields serve as a title to the related entity record on the master entity pages. Choose these fields carefully. The good decision would be to select a related entity name or similar information. |
|                            |                                                                                                                                                                                                          |
|                            | On the view page of the master entity record, these fields will appear as links to the corresponding related entity record.                                                                              |
|                            |                                                                                                                                                                                                          |
|                            | On the edit page of the master entity record, you will see these fields as titles of the section that contains information selected in **Related Entity Data Fields** .                                  |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Related Entity Detailed    | Mandatory. Select those fields of the entity selected in **Target Entity** which contain additional information that you want to see on the master entity record edit page.                              |
|                            |                                                                                                                                                                                                          |
|                            | The values of the fields selected will be available in the dialog box that appears when you click the title of the realted entity on the master page edit page.                                          |
|                            |                                                                                                                                                                                                          |
|                            | Hold the **Ctrl** key to choose several fields.                                                                                                                                                          |
+----------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+



.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 


Example
"""""""
Let us create a field **Friend** that relates to contacts that were recommended by a specific business customer. This is a 'one to many' relation, as one business customer may advise many friends.

Our **Friends** field has the following values:

- **Target Entity**—Select **Contact**.

- **Related Entity Data Fields**—Select **Description**, **Gender**, and **Job Title**.
 
- **Related Entity Info Title**—Select **First name** and **Last name**.

- **Related Entity Detailed**— Select all the fields available.

|

.. image:: ./img/entity_management/entity_field_example_newfield.png

|

Now we create a business customer:

The following grid appears once you've clicked the :guilabel:`+Add` button against the **Friend** field on the record edit or ceate page:

|
  
.. image:: ./img/entity_management/entity_field_example_bc1.png

|

It contains all the fields defined for the **Related Entity Data Fields**.

We have added three contacts. The title contain properties defined for the **Related Entity Info Title** and **Related Entity Data Fields** are displayed for each record below the link.

|
  
.. image:: ./img/entity_management/entity_field_example_bc2.png

|
   
If you click the title of one of the opportunities, a dialog box with all the details specified in the **Related Entity Detailed** appears.

|

.. image:: ./img/entity_management/entity_field_example_bc3.png

|
   
The **Related Entity Info Title** properties are also used to represent the related contacts on the view page.

.. image:: ./img/entity_management/entity_field_example_bc4.png


Many to one
^^^^^^^^^^^^

Many to many fields have an additional propertyies in the **General** section:

+---------------+-------------------------------------------------------------------------------------------------------------------+
| Field         | Description                                                                                                       |
+===============+===================================================================================================================+
| Target Entity | Mandatory. Select the entity which record(s) will be tied with records of the current entity.                     |
+---------------+-------------------------------------------------------------------------------------------------------------------+
| Target Field  | Mandatory. Select the field of the entity selected in **Target Entity** which the entity records will be tied by. |
+---------------+-------------------------------------------------------------------------------------------------------------------+


.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
  



Example
"""""""

Let us create a relation 'Business Unit' and specify:

- **Target Entity**—Select **Business Unit**.

- **Target Field**—Select **Name**.

Now, when creating/editing an opportunity record, you can choose a related business unit from the list. Business unit records in the list are represented with their **Name** values.  

|

.. image:: ./img/entity_management/entity_field_example2_1.png

|

.. image:: ./img/entity_management/entity_field_example2_2.png

|


Links
------

For the information about entity fields, see the `Entity Fields <./entity-fields>`__ guide. 

For the overview of the entities, see the `Entities <./entities>`__ guide. 