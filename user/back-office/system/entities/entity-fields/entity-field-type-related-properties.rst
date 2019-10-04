:oro_documentation_types: crm, commerce

.. _admin-guide-create-entity-fields-type-related:

Type-related Entity Field Properties
------------------------------------

Depending on the entity type selected when defining the :ref:`basic properties <admin-guide-create-entity-fields-basic>` for the entity field you are creating, additional options appear in the **General Information** section once you click **Continue**. The following is the list of field types and the options that appear once the types are selected.  

For the **Decimal** type:
  * *Precision* --- Maximum number of digits. E.g. 15.252 has precision 5. And 1.12 has precision 3.
  * *Scale* --- Maximum number of decimal places. E.g. 15,252 has scale 3. And 1.12 has scale 2.
      
For the **String** type:
  * *Length* --- The number of characters in the string. It is a number from 1 to 255.
     
For the **File** type:
  * *File Size* --- The maximum file size allowed for an upload (in MB).
     
   .. important:: 
      - The file extension types allowed for upload are defined in the :ref:`system settings <admin-configuration-upload-settings>`. 
      - Fields of the **File** type can be only of the **Column table** storage type.
      - These fields cannot be defined as identity fields for export/import operations.
      - Fields of the **File** type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
     
   .. warning:: Auditing is not available for actions with the entity fields of the **File** type.
     
For the **Image** type:
  * *File Size* --- The maximum file size allowed for an upload (in MB). 
  * *Thumbnail Width* --- The image thumbnail width in pixels.
  * *Thumbnail Height* --- The image thumbnail height in pixels.   
     
   .. important:: 
      - The file extension types allowed for upload are defined in the :ref:`system settings <admin-configuration-upload-settings>`.  
      - Fields of the **Image** type can be only of the **Column table** storage type.
      - These fields cannot be defined as identity fields for export/import operations.
      - Fields of the **Image** type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
     
   .. warning::  Auditing is not available for actions with the entity fields of the **File** type.
     
For the **Select** and **Multi-select** types:
  * *Options* --- Define values that will be included in the select list. 
          
     .. note::
        - To add an option, click the **+Add**. 
        - To set the default option, select the check box next to the option. 
        - Click the **Do not set as Default** link to clear the **Default** check boxes. 
        - To move an option up or down on the list, drag the |IcPosition| **Move** icon next to the option. 
        - To delete an option, click **x** next to the option.  When you delete an option, it is removed from all the entity records in the system where it is currently present.
                                              
     .. important::
       - The fields of the **Select** and **Multi-Select** types can be only of the **Column table** storage type.
       - These fields cannot be defined as identity fields for export/import operations.
       
     .. warning:: When editing system select fields, note that some options could be defined as system and cannot be deleted.  

For relations (many to many, one to many, and many to one):
  * **Target Entity** --- Select the entity which record(s)to be tied with the records of the current entity.
  * **Related Entity Data Fields** --- Select those fields of the entity selected in **Target Entity** which contain information that you want to see on the master entity record edit page. These could be a couple of important details in edition to the title which give you the most important information about the related entity record. Hold the Ctrl key to choose several fields.
  * **Related Entity Info Title** --- Select the fields of the entity selected in the Target Entity field by which the users can identify the related entity record. These fields serve as a title to the related entity record on the master entity pages. Choose these fields carefully. It would be a good idea to select a related entity name or similar information. On the view page of the master entity record, these fields will appear as links to the corresponding related entity record. On the edit page of the master entity record, you will see these fields as titles of the section that contains information selected in Related Entity Data Fields . Hold the Ctrl key to choose several fields.
  * **Related Entity Detailed** --- Select those fields of the entity selected in the Target Entity field which contain additional information that you want to see on the master entity record edit page. The values of the fields selected will be available in the dialog box that appears when you click the title of the related entity on the master page edit page. Hold the Ctrl key to choose several fields.
     
  .. important::
     - Relation fields can be only of the **Column table** storage type.
     - Relation fields cannot be defined as identity fields for export/import operations.
     - Relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 
     
  .. note:: Fields of the **Text** type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them.

.. include:: /include/include-images.rst
   :start-after: begin
