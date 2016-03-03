.. _user-management-bu:

Business Unit Records Management
================================

Each enterprise is unique and has its own structure. Within one big company there may be several branches/offices, each 
of which may have some major departments, working in different directions, within which department there may be several
teams, and so on.

Within the Organization in OroCRM, you can create a hierarchy of Units. This means that each unit can have some 
child-units, which, in their turn can be parent units for other units. Therefore, you can use the Unit records to 
represent the organization elements of any level.

For example, a telecommunication service provider might have an organization that would represent its office in 
California. The organization might be divided into two sub-units - Western and Eastern. Each of these sub-units could be 
divided into other four sub-units by the work direction:

- *CaliforniaTelecom*

 - *Western California*
 
   - Western California Stationary Phones
   - Western California Mobiles
   - Western California TV
   - Western California Internet
   
 - Eastern California
 
   - Eastern California Stationary Phones
   - Eastern California Mobiles
   - Eastern California TV
   - Eastern California Internet

The tree of units can be more complex, subject to the actual structure of the organization.

Building the correct structure will help to distribute information correctly and to make sure that system users see all 
the relevant information and only the information that is relevant for them.

Create a Business Unit Record
-----------------------------

In order to create a :term:`Business Unit` record:

- Go to *System → User Management → Business Units*
- Click the :guilabel:`Create Business Unit` button
- Define the general details of the business unit created:

General
^^^^^^^

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Name**","The name used to refer to the business unit in the UI. This is the only mandatory field."
  "**Parent Business Unit**","Define the business unit to which this business unit belongs (a level higher in the 
  administrative hierarchy), if applicable. This way you can represent the whole structure, creating sub-units many 
  levels down."
  "**Phone**
  
  **Website**
  
  **Email**
  
  **Fax**","You can define these contact details of the business unit, if applicable."
  

.. image:: ./img/user_management/bu_general.png  
  
Users
^^^^^
  Check/uncheck the **HAS BUSINESS UNIT** box to assign/unassign a user to the business unit:

.. note::

    Please note that the "HAS BUSINESS UNIT" check-box defines if the user is assigned the specific business unit that 
    you are creating/editing

View and Manage a Business Unit Record
--------------------------------------

All the business units available are displayed in the Business Units 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → User Management → Business Units*).

From the grid you can:


- Delete a business unit from the system: |IcDelete|

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the business unit: |IcEdit|

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the business unit: |IcView|




.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
 