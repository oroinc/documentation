.. _user-guide-data-audit:

Data Audit
==========

With this functionality, users can see the full history of changes made to any record of an 
:ref:`auditable entity <user-guide-entity-management-create-other>`, as well as the out-of-the-box report of all such 
actions.

.. hint::

    System administrator defines what entities will be available for audit. Any entity can be 
    :ref:`set as auditable <user-guide-entity-management-create-other>`.
    
    
Data Audit Report
-----------------

The report grid contains the following columns:

.. csv-table::
  :header: "Name","Description"
  :widths: 10, 30

  "ACTION","Defines the action that has been performed with the :term:`record`. You can see if the record has been 
  created, updated or removed." 
  "VERSION","Corresponds to the consecutive number of changes performed with the specific record."
  "ENTITY TYPE","Type of the :term:`entity` to which the record belongs."
  "ENTITY NAME","Name of the specific record tracked."
  "ENTITY ID","ID of the entity to which the record belongs."
  "DATA","Details of the change."
  "AUTHOR","Name and email of the :term:`user` that has performed the change."
  "ORGANIZATION",":term:`Organization`, within which the change has been performed."
  "LOGGED AT","Date and time when the event was logged."

.. image:: ./img/data_audit/data_audit_ex.png


History of Changes
------------------

A link to a specific record's history of changes is available in the top right corner of the record's
:ref:`View page <user-guide-ui-components-view-pages>`,  if Data Audit has been enabled for the user. (The
:ref:`Data Audit capabilty <admin-capabilities-data-audit>` has been enabled for at least one of the user's 
:ref:`roles <user-guide-user-management-permissions-basic>`)

|

.. image:: ./img/data_management/view/view_history.png

|
    