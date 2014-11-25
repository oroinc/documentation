
.. _user-guide-marketing-lists:

Marketing Lists
===============

Marketing lists define rules used to select sets of contact details for marketing purposes. 

For example, you can create a list that will contain only details of leads added to the system after October 1 with 
addresses in California. 

The article describes how to :ref:`create <user-guide-marketing-lists-create>` and 
:ref:`manage <user-guide-marketing-lists-actions>` marketing lists, as well as provides detailed description of the 
:ref:`marketing list *"View"* page <user-guide-marketing-lists-view-page>`. 


.. _user-guide-marketing-lists-create:

Creating a Marketing List
------------------------

1. Go to the *Marketing --> Marketing Lists* and click :guilabel:`Create Marketing List` button 
   in the top right corner of the grid.

2. Define :ref:`general details <user-guide-marketing-marketing-list-create-general>` of the marketing list

3.  Define conditions in the *Filters* section. Only the records that meet the conditions will be added to the marketing
    list.
  
4.  Choose the :ref:`columns <user-guide-marketing-marketing-list-create-columns>` that will be visible on the *"View*" 
    page of the list and available to third-party systems following integration
    
5. Save the campaign in the system with the button in the top right corner of the page.
  

.. _user-guide-marketing-marketing-list-create-general:
  
General Details  
^^^^^^^^^^^^^^^

.. image:: .img./marketing/list_general_details

The following fields are mandatory and *must* be specified:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Name**","Name used to refer to the marketing list in the system."
  "**Entity**","Choose an entity from the drop-down. Only entities that have contact details (E-mail or phone 
  number) are available."
  "**Type**","Chose the list type from the drop-down.
 
  - Dynamic lists are updated as soon as any changes have taken place in the system 
  
  - On demand list will be updated only if the user has requested to do so."
  "Owner","Limits the list of users that can manage the marketing list to its owner and users, whose roles allow 
  managing marketing lists of the owner (e.g. members of the same business unit, system administrator, etc.)"

Optional filed **Description** can be filled with free text to help you and other users to understand the purpose or 
peculiarities of the list in future.

Custom fields may be added subject to specific business-needs. 
  
.. image:: .img./marketing/list_general_details_ex


.. _user-guide-marketing-marketing-list-create-filters:
  
Filters
^^^^^^^
.img./marketing/list_filters

To define the marketing list settings, you can use the following:

- Field Condition : only records that meet the condition are added to the list

- Conditions Group: a set of field conditions

- Apply Segment: only records from a specific :term:`segment` are added to the list. (Segments are subject to a separate
  document)

Field conditions, condition groups and segment settings can be united or ORed to define the final set of conditions. 

Field Condition
"""""""""""""""

To define a field condition (for example, that all the Leads in the list have been created within the last month):

- Drag *"Field condition"* to the box on the right

.. image:: .img./marketing/list_filters_field_condition

- Click *Choose a field* link and select necessary field (e.g *"Created at"*) 

-  Click links and choose a drop-down value. (e.g. "day" "more than" Oct 1, 2014, 12:00 AM)

.. image:: .img./marketing/list_filters_field_condition_value


Condition Group
"""""""""""""""

To add a condition group (e.g. state in the address of the lead or of the lead's B2B customer's contact shall be 
"California" or "CA"):

- Drag *"Conditions Group"* to the box on the right

.. image:: .img./marketing/list_filters_condition_group_01

- Add several field conditions to the group

.. image:: .img./marketing/list_filters_condition_group_02

- Define the field conditions and choose AND or OR conjunction for the conditions

.. image:: .img./marketing/list_filters_condition_group_03


.. user-guide-marketing-marketing-list-create-columns:

Columns
^^^^^^^

image:: .img./marketing/list_columns

In the "*Columns*" section, define the set of fields displayed in the grid of the marketing list *"View"* page.
It serves two main purposes:

- Inside the system, it helps to visualise the list and see the instances included
- In case of integration with external marketing services to run the mailings (such as MailChimp) values of these fields
  can be sent to these external systems from OroCRM.
- Running marketing activities requires some contact information, so at least one column the contains it must be 
  selected. The list of such fields is provided in the *"Designer"* section. (e.g. or contacts these are Primary Email 
  and Primary Phone fields).

image:: .img./marketing/list_columns_01
  
- Choose the fields from the drop-down in the *"Column*" section.

- Label is the way the field will be referred to in the grid. The value defined for the field will be added by default, 
  but can be changed. 
  
- Define the sorting order if you want the grid to be sorted by the field.

- Click :guilabel:`Add` button

image:: .img./marketing/list_columns_ex

Use action icons in the last column to edit the grid:

- Delete a column from the list with |IcDelete|

- Edit the column settings with |IcEdit|

- You can change the column position, dragging the column by |IcMove| icons


.. _user-guide-marketing-lists-actions:

Marketing List Actions
----------------------

The following actions are available for a marketing list from the grid

.. image:: ./img/marketing/list_action_icons.png

- Delete the list from the system : |IcDelete| 

- Get to the *"Edit"* form of the list : |IcEdit| 

- Get to the *"View"* page of the list :  |IcView| 

You can change the list details or delete the list from the :ref:`Edit form <user-guide-ui-edit-forms>`.


.. _user-guide-marketing-campaigns-view-page:

*Campaign View Page*
--------------------

View page of a marketing list contains:

- Action buttons




.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcMove| image:: ./img/buttons/IcMove.png
   :align: middle



