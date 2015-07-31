.. _user-guide-data-audit:

Data Audit
==========

To see an out-of-the-box report of all the actions, performed with records of an
:ref:`auditable entity <user-guide-entity-management-create-other>`, go to *System → Data Audit*.

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


.. hint::

    You can order the report by any of the column values. Click the column name to do so.