
Synchronization with Outlook
============================

OroCRM enterprise version has currently provided support for data synchronization in the OroCRM and Outlook accounts.
Now, all the contacts, tasks and calendar events available for a user can be synchronized with the specified
Outlook account and back. 

From this article you will learn how to configure and run synchronization, and see the workflow used therefore.


Getting Started
---------------

Preconditions
^^^^^^^^^^^^^

- OroCRM enterprise version 1.6+
- Outlook 2010+


Plug-in Setup
^^^^^^^^^^^^^

In order to enable data synchronization from OroCRM go to *System  Configuration  --> SYSTEM CONFIGURATION --> MS 
Outlook settings* 

.. img:: ./user_guide/img/outlook/settings.png

Click the file link in the "Download" field to download MS Outlook OroCRM Plugin to integrate with your Outlook client. 
Wait for download to finish and run the installation process. .


Integration and Synchronization Settings on the OroCRM Side
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can also choose sync direction and intervals, as well as priority of the conflict resolution and set of entities
synchronized.

Initially, default settings are applied. Uncheck "Use Default" box to change the settings. 

If "Use Default" box has been checked, the default values will be applied regardless of the values entered for the 
field.

.. csv-table::
  :header: "**Setting**","**Description**","**Possible Values**","**Default Value**" 
  :widths: 10, 20, 30, 10

  "**Sync Direction**","The data synchronization direction","
  
  - OroCRM to Outlook
  - Outlook to OroCRM
  - Biderectional","Biderectional"
  "**Conflict Resolution**","Conflict resolution strategy to be used if the same data has been changed in the both 
  Outlook and CRM","
  
  - OroCRM always wins
  
  - Outlook always wins", "OroCRM always wins"
  "**CRM Sync Interval (In Seconds)**","How often changes on the CRM side will be checked","Any numeric value from 1 to 
  86399","120"
  "**Outlook Sync Interval (In Seconds)**","How often changes on Outlook side will be checked","Any numeric value from 1 
  to 86399","30" 
  "**Contacts, Tasks and Calendar Events**","Records of the entity are synchronized if the box is checked","Yes or No","
  Yes"
  

Settings on the Outlook Side
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once you have installed the .msi file, *"OroCRM for Outlook*" menu will appear in your Oultlook menu bar. 

.. img:: ./user_guide/img/outlook/outlook_menu_bar.png

Choose "Settings". *"OroCRM for Outlook Settings"* window will emerge.  The following fields are available

.. csv-table::
  :header: "**Name**","**Description**" 
  :widths: 10, 30

  "**OroCRM URL**","The URL address of your OroCRM instance. Mandatory field."
  "**Ignore self-signed certificate**","The box must be checked. Mandatory field."
  "**User**","Your Username as defined on *My user* page of the OroCRM. Mandatory field."
  "**Api Key**","API Key as generated on *My user* page of the OroCRM. Mandatory field."
  "**Enable Sync**","

  - If the box is checked, synchronization will be run automatically in the intervals defined in the 
    OroCRM.
  
  - If the box is not checked, synchronization will start only after the user has clicked :guilabel:`StartSyncNow` 
    button on the side panel
  
  "
  "**Show Alerts**","
	
  - If the box is checked, synchronization-related alerts (if any) will pop-up on the bottom panel. 
    For example, |alert|

  - If the box is not checked, alert will not appear on the bottom panel."
  
  
Synchronization Workflow
------------------------

Synchronization Start
^^^^^^^^^^^^^^^^^^^^^
Synchronization will start automatically, or as soon as the user has clicked :guilabel:`StartSyncNow` 
button on the side panel, subject to the settings defined as described above.

Identifying a Record
^^^^^^^^^^^^^^^^^^^^

Every contact, task and calendar event present in OroCRM has a unique id.

For every entity synchronized there is also a key defined. The key is a set of field values used to identify an entity
record. Fields of a key can be chosen, subject to the specific company needs.
The following keys are used by default:

.. csv-table::
  :header: "**Entity**","**Key Fields**" 
  :widths: 10, 30
  
  "Contact","First Name, Last Name, Gender and Birthday"
  "Calendar Event","Title(Subject), Start Time, End Time and whether it is an All-day event"
  "Task""????????"
  
Synchronization is run in the similar manner for records of activities: 

Synch from OroCRM to Outlook
----------------------------

First Synchronization from OroCRM to Outlook
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Keys of all the records processed in the system since the synchronization date and available to the user are 
checked:

- If the key of an OroCRM record matches a key of one or several records in Outlook, all these records in Outlook are updated. 
 (Values of all the mapped fields in Outlook are overwritten with their values from OroCRM)

- If the key of an OroCRM record does not match a key of any Outlook records, a new record is created in Outlook.

OroCRM_id field (ID) is added to each of the records in Outlook.
 
 
Next Synchronizations from OroCRM to Outlook
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
IDs of all the records processed in the system since the latest synchronization date and available to the user are 
checked:

- If the ID of an OroCRM record matches an ID of one or several records in the Outlook record(s) is updated. 
 (Values of all the mapped fields in Outlook are overwritten with their values from OroCRM)

- If the ID of an OroCRM record does not match an ID of any Outlook records, the keys are checked:

  - If the key of an OroCRM record matches a key of an Outlook record (or records), all these records in Outlook are updated.  
   (Values of all the mapped fields in Outlook are overwritten with their values from OroCRM)

  - If the key of an OroCRM record does not match a key of any Outlook records, a new record is created in Outlook.
  
Resynch from OroCRM to Outlook
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
All the records with not empty ID field are deleted from the Outlook and First Synch from OroCRM to Outlook is
performed.




Synch from Outlook to OroCRM
----------------------------

First Synch from Outlook to OroCRM
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Keys of all the records processed in the Outlook since the synchronization date are checked:

- If the key of an Outlook record matches a key of one or several records in OroCRM, all these records in OroCRM are updated. 
 (Values of all the mapped fields in OroCRM are overwritten with their values from Outlook)

- If the key of an Outlook record does not match a key of any OroCRM records, a new record is created in OroCRM.

OroCRM_id field (ID) is created for each new record added from the Outlook.
 
Next Synch from Outlook to OroCRM
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
IDs of all the records processed in the Outlook since the latest synchronization date are checked:

- If the ID of an Outlook record matches the ID an OroCRM record, the OroCRM records is updated. 
 (Values of all the mapped fields in Outlook are overwritten with their values from OroCRM)

- If the ID of an Outlook record does not match ID of any OroCRM records, the record is deleted from Outlook (???? or just the record is ignored)

- If an Outlook record has no OroCRM id value, the keys are checked:

 - If the key of an Outlook record matches a key of one or several records in OroCRM, all these records in OroCRM are updated. 
  (Values of all the mapped fields in OroCRM are overwritten with their values from Outlook)

  - If the key of an Outlook record does not match a key of any OroCRM records, a new record is created in OroCRM.
  

  
Bidirectional Synchronization  

Synchronization from OroCRM to Oultlook is performed.
Synchronization from Outlook to OroCRM is performed.
If the ID of an Outlook record does not match ID of any OroCRM records, the record is deleted from Outlook.


.. |alert| img:: ./user_guide/img/outlook/alert.png