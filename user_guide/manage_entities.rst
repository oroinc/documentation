.. _user-guide-entity-management-edit:

Manage Entities
===============

Sometimes there is a need to edit existing entities of the Oro Platform from the 
Web UI.

Entities Grid 
--------------

 
The following table describes columns of the Entities grid and how they affect ability to edit the entity:

.. csv-table:: Entity Grid Columns
  :header: "Column","What's in it","Effect ability to edit?"
  :widths: 10, 30, 30

  "**LABEL***","Name used to refer to the entity in the system UI","No"
  "**SCHEMA STATUS**","Defines the state of current schema for the entity.","No, but unless its value is *Active* your 
  changes to entities an/or their fields will not have effect for the system, until you 
  :ref:`Update the Schema <user-guide-entity-management-create-update>`."
  "**IS EXTEND**","Defines if :ref:`new fields can be added <user-guide-field-management-create>` to the entity","**No**
  means that you cannot add any new fields to an entity."
  "**TYPE**","Defines whether the entity was loaded from the back-end (System) or created in the UI (Custom)","New 
  fields can always be added to custom entities. For the system entities ability to add new fields may differ subject to
  the *IS EXTEND* value. System entities cannot be deleted."
  "**AUDITABLE**","Defines if the actions performed on the entity records shall be logged","No"
  "**OWNERSHIP TYPE**","Defines the level at which permissions will be set for instances of the entity as
  described in the Create Entities guide :ref:`section <user-guide-entity-management-create-other>`","Not 
  directly, however, you need to have permissions to edit the entity (See System → User Management → Roles)"
  "**NAME** and **MODULE**","Define the name used to refer to the entity at the back-end. Comes handy if there is a 
  need to change configuration or otherwise find the entity in the code","No"
  "**UPDATED AT**","The date and time of the last schema update for the entity","No"
  "...","Hover your mouse over the *...* to access the action icons.","Use the icons to manage the entity."  

This way, ability to add :ref:`new fields <user-guide-entity-management-create-fields>` depends on the entity, 
:ref:`Edit form <user-guide-ui-components-create-pages>` is available for any entity in the system. 
List of editable properties for each of the System type entities depends on 
configuration and is created in a way reasonable and safe for the system performance and operation. 

.. note:

    If you need to add new fields to an entity that is not "EXTEND", configuration of the entity may be change in the 
    course of customization.

Actions on Entities
--------------------

The following actions are available for an entity:

From the :ref:`grid <user-guide-ui-components-grids>`

- Delete the entity: |IcDelete| (available only for custom entities)
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the entity:  |IcView|
- Get to the :ref:`Edit from <user-guide-ui-components-create-pages>` of the entity: |IcEdit|"


From the :ref:`View page <user-guide-ui-components-view-pages>`:

- Get to the :ref:`Edit from <user-guide-ui-components-create-pages>` of the entity: |IcEdit|"
- Manage the entity fields, as described in the :ref:`Field Management <user-guide-field-management>` Guide.
  

.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |IcRest| image:: ./img/buttons/IcRest.png
   :align: middle