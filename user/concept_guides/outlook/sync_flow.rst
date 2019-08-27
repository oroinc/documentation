.. _admin-configuration-ms-outlook-integration-settings--sync-flow:

Synchronization Workflow
------------------------

.. begin_sync_flow

Select Sync Type: Automatic VS Manual
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When connecting your MS Outlook application to the Oro instance, you can define the sync settings to be used. Synchronization can be triggered either automatically within defined time intervals, or manually. Manual synchronization can happen either via the Outlook add-in settings, or by right-clicking on the Outlook icon at the bottom of you screen. More information on synchronization settings and conditions is described in the :ref:`Connect MS Outlook Add-in to Oro Instance <admin-configuration-ms-outlook-integration-settings--connect>` topic.

Identify a Record
^^^^^^^^^^^^^^^^^

For every synchronized record, there is a defined key. The key is a set of field values used to identify a record. Fields of a key can be chosen subject to the specific company needs and defined in the back-office.

The following keys are used by default: 

.. csv-table::
  :header: "**Entity**","**Key Fields**" 
  :widths: 10, 30
  
  "Contact","First Name, Last Name, Gender and Birthday"
  "Calendar Event","Title(Subject), Start Time, End Time and whether it is an All-day event"
  "Task","Subject and Task Priority"
  
Every contact, task and calendar event available in OroCRM has a unique ID. When a record is saved in Outlook, the ID value is saved from OroCRM in the OroCRM_id field.

Sync Records from OroCRM to Outlook
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Synchronization is run in the same way for records of activities, tasks and calendar events: 

 .. image:: /user/img/outlook/outlook_from_oro_diag.png
    :alt: A diagram that explains how to sync records from orocrm to outlook

All the records processed in OroCRM since the latest synchronization date and available to the user are checked:

- If the ID of an OroCRM record matches the OroCRM_id value of an Outlook record, the Outlook record is updated. 
  (Values of all the mapped fields in Outlook are overwritten with the corresponding values from OroCRM).
 
- If the ID of an OroCRM record does not match the OroCRM_id of any Outlook records, their keys are checked against the fields of 
  Outlook records with an empty OroCRM_id field.
  
  -  As soon as an Outlook record with empty OroCRM_id and a matching key is found, it is updated from OroCRM, and 
     the ID value is saved from OroCRM into the OroCRM_id field of the Outlook record. 

  - If no Outlook record with empty OroCRM_id and matching key is found, a new record is created in Outlook.


.. note:: 
    
    During the first synchronization, or resynchronization, all Outlook records with a non-empty OroCRM_id field are
    deleted first, and then OroCRM record keys are checked for all of them.

.. csv-table::
  :header: "**If**","**Then**" 
  :widths: 20, 30
    
  "Such record already exists in Outlook.","Values of the mapped fields of the OroCRM record replace the corresponding values for the Outlook record."
  "A record does not yet exist in Outlook.","OroCRM creates the record in Outlook."
  "Multiple matching records exist in Outlook.","OroCRM updates one of them."
  "You updated a record in OroCRM.","Values of the mapped fields of the OroCRM record replace corresponding values for the Outlook record."
  "You updated a record in Outlook.","The updates remain in the Outlook record, but are not synced into OroCRM."
  "You deleted a record in Outlook.","OroCRM creates the record again."
  "You deleted a record in OroCRM.","The record stays in Outlook with no changes."
  
.. important:: Be aware that if you add a Google-based account to the existing MS Exchange account, your default calendar may change. This is important to remember when synchronizing events between Oro and Outlook.

Sync Records from Outlook to OroCRM
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: /user/img/outlook/oro_from_outlook_diag.png
   :alt: A diagram that explains how to sync records from outlook to orocrm

All the records processed in Outlook since the latest synchronization date and available to the user are loaded:

1. If the OroCRM_id field of a record is empty, a new record is created in OroCRM.

2. If the OroCRM_id field is defined, and this is the first synchronization or resynchronization, the record is deleted.
 
3. Otherwise, the OroCRM_id is checked against ID values of the records in OroCRM:

   - if a record with the matching ID is found in OroCRM, it is updated with data from Outlook.
    
   - if a record with a matching ID is absent in OroCRM, it is deleted from Outlook.


.. csv-table::
  :header: "**If**","**Then**" 
  :widths: 20, 30
    
  "Such record (record with such ID) already exists in OroCRM.","Values of the mapped fields of the Outlook record replace the corresponding values for the OroCRM record."
  "A record does not yet exist in OroCRM.","A new record is created in OroCRM."
  "You updated a record in OroCRM.","Values of the mapped fields of the Outlook record replace the corresponding values of the OroCRM record."
  "You updated a record in Outlook.","Values of the mapped fields of the Outlook record replace the corresponding values of the OroCRM record."
  "You deleted a record in Outlook.","The record stays in OroCRM."
  "You deleted a record in OroCRM.","The record is deleted from Outlook."
  
 
Sync Records with Bidirectional Synchronization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For bidirectional synchronization, synchronization from OroCRM to Outlook is performed first and followed by synchronization from Outlook to OroCRM.

.. csv-table::
  :header: "**If**","**Then**" 
  :widths: 20, 30
    
  "A record exists in both OroCRM and Outlook.","Values of the mapped fields of the OroCRM record replace the corresponding values for the Outlook record."
  "A record does not yet exist in OroCRM.","A new record is created in OroCRM."
  "A record does not yet exist in Outlook.","A new record is created in Outlook."
  "You updated a record in OroCRM.","Values of the mapped fields of the OroCRM record replace the corresponding values of the Outlook record."
  "You updated a record in Outlook.","Values of the mapped fields of the Outlook record replace the corresponding values of the OroCRM record."
  "You updated a record in the both OroCRM and Outlook.","Subject to your conflict resolution settings."
  "You deleted a record in Outlook.","The record stays in OroCRM and is added to Outlook."
  "You deleted a record in OroCRM.","The record is deleted from Outlook."

.. finish_sync_flow
  

  
  