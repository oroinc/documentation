.. _user-guide-data-audit:

Data Audit
==========

With this functionality, users can see the full history of changes made to any record of an ``auditable entity``, as well as the out-of-the-box report of all such 
actions.

.. hint:: System administrator defines what entities will be available for audit. Any entity can be set as auditable. For how to do it, see step 6 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.
    
    
Data Audit Report
-----------------

You can view the data audit statistics by navigating to **System > Data Audit** in the main menu in the back-office of all Oro applications.

The report grid contains the following information:

* **ACTION** --- Defines the action that has been performed with the :term:`record`. You can see if the record has been created, updated or removed.
* **VERSION** --- Corresponds to the consecutive number of changes performed with the specific record.
* **ENTITY TYPE** --- The type of the :term:`entity` to which the record belongs.
* **ENTITY NAME** --- The name of the specific record tracked.
* **ENTITY ID** --- The ID of the entity to which the record belongs.
* **DATA** --- Details of the change.
* **AUTHOR** --- The name and email of the user that has performed the change.
* **ORGANIZATION** --- The organization within which the change has been performed.
* **LOGGED AT** --- The date and time when the event was logged.

.. image:: /img/system/data_audit/data_audit_ex.png
   :alt: The sample of a data audit report


History of Changes
------------------

A link to a specific record's history of changes is available in the top right corner of the record's details page, if Data Audit has been enabled for the user. (The :ref:`Data Audit capability <admin-capabilities-data-audit>` has been enabled for at least one of the user's :ref:`roles <user-guide-user-management-permissions>`)

.. image:: /img/system/data_audit/view_history.png
   :alt: Show the Change History link on the page of the record that has Data Audit enabled

    