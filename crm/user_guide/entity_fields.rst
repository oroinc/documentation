Entity Fields
=============

.. contents:: :local:
    :depth: 3


Overview
---------

Fields are used to collect details of :ref:`entity <user-guide-entity-management-from-UI>` :term:`records <Record>`. 
For example, a 'street name,' 'zip code,' and 'building number' may be fields of an 'address.' 

You can add new fields to any :term:`custom entity <Custom Entity>` or 
an :ref:`extendible <user-guide-entity-management-edit>` :term:`system entity <System Entity>`.

This guide describes how to create and modify the fields.


Actions
--------

Create a Custom Entity Field
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate **System>Entities>Entities Management**.

2. On the **All Entities** page, click the required entity in the grid. 

3. On the entity view page, click the :guilabel:`Create Field` button in the upper-right corner of the page. 

4. Specify information for the basic entity field properties. See the descriptions of the basic properties in the `Basic Entity Field Properties <./entity-fields#basic-entity-field-properties>`__ section. 

5. Click :guilabel:`Continue` button. Depending on what has been selected for **Type**, additional fields appear.

6. Specify information for additional propertoes. See the descriptions of the basic properties in the `Additional Entity Field Properties <./entity-fields#basic-entity-field-properties>`__ section.

7. Click **Save** in the upper-right corner of the page. 

|

.. image:: ./img/entity_management/new_entity_field.png

|

Edit a Custom Entity Field
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate **System>Entities>Entities Management**.

2. On the **All Entities** page, click the required entity in the grid. 

3. On the entity view page, click **Fields**. 

4. In the grid of the **Fields** section, click the required field.

5. Make the required changes according to the description provided in step 6 of the `Create a Custom Entity Field <./entity-field#create-a-custom-entiry-field>`__ section.  

.. important:: 
  The list of properties editable for system entity fields depends on configuration and is created in a way reasonable and safe for the system performance and operation.  

6. Click **Save** in the upper-right corner of the page. 


Alternatively, you can start editing an entity field from the entity view page by clicking the |IcEdit| **Edit** icon at the right-hand end of the corresponding row.



Delete a Custom Entity Field
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate **System>Entities>Entities Management**.

2. On the **All Entities** page, click the required entity in the grid. 

3. On the entity view page, click **Fields**. 

4. In the grid of the **Fields** section, choose the required entity field and click the |IcDelete| **Delete** icon at the right-hand end of the corresponding row. 

5. In the **Deletion Confirmation** dialog box, click :guilabel:`Yes`.



Basic Entity Field Properties
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

General Information Section
""""""""""""""""""""""""""""

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Field Name**","Mandatory. Type a name of the field that will be used to refer to it in the system. 
  
  This name must unique within an entity. 
  It cannot be a `reserved sql word <http://msdn.microsoft.com/en-us/library/ms189822.aspx>`_ , nor a
  `reserved php word <http://php.net/manual/en/reserved.keywords.php>`_."
  "**Storage Type**","Mandatory. Select how the field is stores in the system. There are two options:

  - **Serialized field**—Use this storage type for simple custom fields that keep information necessary for 
    an single entity. The field will appear in the system as soon as it has been added and no :ref:`schema update <user-guide-entity-management-create-update>` is required. 
  
    Serialized fields cannot be used for :ref:`grid filters <user-guide-ui-components-grid-filters>`, for the 
    :ref:`report <user-guide-reports>` and :ref:`chart <user-guide-reports-chart>` generation, for data audit, for creation 
    of :ref:`segments <user-guide-filters-segments>` and :ref:`relations <user-guide-entity-management-create-relation>`.
  
   Serialized fields cannot be files, multi-selects or option sets.
  
  - **Table column**—Store field values to a database table. If this option is selected, the field can be used without the limitations 
    applicable to a serialized field. For this type of fileds a 
    :ref:`schema update <user-guide-entity-management-create-update>` is required.
  "
  "**Type***","Mandatory. Select the field type from the list.
  
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
    
  - Relations - Relation is a field that enables users to tie record(s) of one entity to record(s) of another entity. For example each customer has an account, and each account can be assigned several contacts.
    - Many to many
    - Many to one
    - One to many
  
  "
  



Additional Entity Field Properties
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. _user-guide-entity-management-common:


Properties that can be defined may vary subject to the chosen field type. 

The following sections provide description of common properties defined for all or most of the types and peculiarities of specific types.

.. _user-guide-entity-management-general-common:

General Information Section
""""""""""""""""""""""""""""

Fields **Name**, **Storage Type**, **Type** that you filled in when specifying information for basic entity field properties (see the `Basic Entity Field Properties <./entity-fields#basic-entity-field-properties>`__ section are still present on the interface but their values cannot be changed now.
) 

There are two new fields in this section:

.. csv-table:: 
  :header: "Field","Description"
  :widths: 10,30

  "**Label**","Mandatory. Type the label which the field will be referred to on the interface by. By default label is the same as **Name**."
  "**Description**","Type the short by meaningful description that will appear as a field tooltip on the interface when you will manage the entity records."
  

.. _user-guide-entity-management-export-import-common:

Import and Export Section
""""""""""""""""""""""""""

.. csv-table:: 
  :header: "Field","Description"
  :widths: 10,30

  "**Column Name**","Type a name that is used to identify this field in the .csv file with entity records. If left blank, the **Label** value will be
  used when export."
  "**Column Position**","Type a number that corresponds to the position of this field in the .csv file with entity records."

  "**Exclude Column**", " - **No**—Select this value if you want this field to be available for export. 

  - **Yes**—Select this value if you do not want this field to be available for export (this field will not be present in the .csv file obtained as a result of the export operation).

  "
  
  
.. _user-guide-entity-management-other-common:

Other
*****

The following Yes/No options can be defined:

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
  "**Priority**","Priority defines the order of custom fields on a corresponding view page, edit and create forms and 
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







.. |IcMove| image:: ./img/buttons/IcMove.png
   :align: middle

.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |IcRest| image:: ./img/buttons/IcRest.png
   :align: middle
