.. _admin-configuration-ms-outlook-integration-settings--mapping:
.. _outlook-contact-mapping:
.. _outlook-task-mapping:
.. _outlook-calendar-mapping:


Mapping Rules Between Oro and Outlook
-------------------------------------

.. begin_mapping

Specific values of the fields of OroCRM and Outlook records are mapped during synchronization of contacts, tasks, and events.

Contact Mapping Rules
^^^^^^^^^^^^^^^^^^^^^

The following rules represent the mapping strategy of the OroCRM contact record fields into the Outlook contact record fields.

.. csv-table::
  :header: "**OroCRM Field**","**Outlook Field**","**Note**"
  :widths: 20, 20, 20

  "First Name","First Name","If no **First Name** is defined in the Outlook record, the **Last Name** value is used for
  the both first name and last name in OroCRM."
  "Middle Name","Middle Name","---"
  "Last Name","Last Name","If no **Last Name** is defined in the Outlook record, the **First Name** value is used for
  both the first name and the last name in OroCRM."
  "Name Suffix","Name Suffix","---"
  "Description","Notes","---"
  "Email","Email","All the existing email addresses are mapped."
  "Phone","Primary Phone","Only the first OroCRM phone number is mapped."
  "Job Title","Job Title","---"
  "Birthday","Birthday","---"
  "Gender","Gender","---"
  "Fax","Fax","---"
  "Address of a **Billing** Type","Business Address","---"
  "Address of a **Shipping** Type","Home Address","---"
  "Address with no type defined","Other Address","---"

Task Mapping Rules
^^^^^^^^^^^^^^^^^^

The following fields of an OroCRM task record are mapped into the following fields of an Outlook task record.

.. csv-table::
  :header: "**OroCRM Field**","**Outlook Field**"
  :widths: 20, 20

  "Subject","Subject"
  "Priority","Priority"
  "Due Date","Due Date"

OroCRM statuses are mapped into Outlook unchanged:

.. csv-table::
  :header: "**OroCRM Task Status**","**Outlook Task Status**"
  :widths: 20, 20

  "In progress","In progress"
  "Closed","Closed"
  "Open","Open"

The Outlook statuses that are not available in OroCRM are mapped as follows:

.. csv-table::
  :header: "**Outlook Task Status**","**OroCRM Task Status**"
  :widths: 20, 20

  "Not Started","Open"
  "Completed","Closed"
  "Waiting on someone else","In progress"
  "Deferred","In Progress"

Calendar Mapping Rules
^^^^^^^^^^^^^^^^^^^^^^

The following fields of an OroCRM calendar event record are mapped to the following fields of an Outlook appointment.

.. csv-table::
  :header: "**OroCRM Field**","**Outlook Field**"
  :widths: 20, 20

  "Title","Subject"
  "Start","Start time"
  "End","End time"
  "All-Day Event ","All day event"

.. note::

     Only a calendar assigned to the specified user is mapped, regardless of access settings.

     Invitations, received by the user are sent to Outlook as regular calendar events.


.. .. important:: Be aware that if you add a Google-based account to the existing MS Exchange account, your default calendar may change. This is important to remember when synchronizing events between Oro and Outlook.

.. finish_mapping