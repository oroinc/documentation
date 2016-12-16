Type-Related Entity Field Properties
=======================================

.. contents:: :local:
    :depth: 3


Common Properties
^^^^^^^^^^^^^^^^^^

Common properties are described in the :ref:`Common Settings <./entity-fields#common-properties>` section.


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


|
  


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


Relations
---------

Relation is a field that enables users to tie record(s) of one entity to record(s) of another entity.
For example each :term:`customer` has an :term:`account`, and each account can be assigned several contacts.





Many to many
^^^^^^^^^^^^^

Many to many fields have additional properties in the **General** section:

Field    Description
Target Entity     Mandatory. Select the entity which record(s) will be tied with records of the current entity. 
Related Entity Data Fields    Mandatory. Select those fields of the entity selected in **Target Entity** which you c 
Related Entity Info Title    Mandatory. Select the fields of the related entity by which the users can identify the related entity record. 
    On the view page of the current entity record, users will see only related entity's fields selected here. These fields will appear as links to the corresponding related entity record. 
    On the edit page of the current entity record, users will see these fields as titles of the section that contains information selected in **Related Entity Data Fields**. These titles will appear as links to
Related Entity Detailed    Mandatory.
                 

.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 



One to many
^^^^^^^^^^^^^

One to many fields have additional properties in the **General** section:

Field    Description
Target Entity     Mandatory. Select the entity which record(s) will be tied with records of the current entity. 



.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 



Many to one
^^^^^^^^^^^^

Many to many fields have an additional propertyies in the **General** section:

Field    Description
Target Entity     Mandatory. Select the entity which record(s) will be tied with records of the current entity. 
Target Field    Mandatory. Select the field of the entity selected in **Target Entity**


.. important::
  - The relation fields can be only of the **Column table** storage type.

  - The relation fields cannot be defined as an identity field for the :ref:`export / import <user-guide-entity-management-export-import-common>` operations.

  - The relation fields type are not displayed on a grid, so **Show on Grid** and **Show Grid Filter** properties cannot be defined for them. 