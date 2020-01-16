.. _web-services-api--resource-fields:

Resource Fields
===============

.. _web-services-api--resource-fields--common:

Common Resource Fields
----------------------

+--------------+---------------+-----------------------------------------------------------------------------------------------------+
| Name         | Type          | Description                                                                                         |
+==============+===============+=====================================================================================================+
| id           | integer       | The unique identifier of a resource. In most cases, it is represented by an integer value, but      |
|              |               | depending on the resource data model, it can be represented by a string or contain multiple columns |
+--------------+---------------+-----------------------------------------------------------------------------------------------------+
| createdAt    | datetime      | The date and time of resource record creation.                                                      |
+--------------+---------------+-----------------------------------------------------------------------------------------------------+
| updatedAt    | datetime      | The date and time of the last update of the resource record.                                        |
+--------------+---------------+-----------------------------------------------------------------------------------------------------+
| owner        | user          | Defines the range of users that are responsible for a record and can manage it.                     |
|              | or            | Ownership also determines access permissions.                                                       |
|              | business unit |                                                                                                     |
|              | or            |                                                                                                     |
|              | organization  |                                                                                                     |
+--------------+---------------+-----------------------------------------------------------------------------------------------------+
| organization | organization  | An organization record represents a real enterprise, business, firm, company or another             |
|              |               | organization to which the users belong. Available only in Enterprise Edition instances.             |
+--------------+---------------+-----------------------------------------------------------------------------------------------------+


.. _web-services-api--resource-fields--communication-activities:

Typical Communication Activities Fields
---------------------------------------

The term *communication activity* describes an activity that involves communications and can have a direction, that is, be incoming or outgoing.

For example, *Call*, *Email* are communication activities. When a client calls or sends an email to their manager, it is an incoming communication activity. When a manager calls a client or sends an email, it is an outgoing communication activity.

The data based on communication activities may be used to build useful forecast reports.

The table below describes fields available for the resources that support such communication activities
as *Call*, *Email*, etc.


+----------------------+----------+----------------------------------------------------------------------------------------+
| Name                 | Type     | Description                                                                            |
+======================+==========+========================================================================================+
| lastContactedDate    | datetime | The date and time of the last communication activity for the resource record.          |
+----------------------+----------+----------------------------------------------------------------------------------------+
| lastContactedDateIn  | datetime | The date and time of the last incoming communication activity for the resource record. |
+----------------------+----------+----------------------------------------------------------------------------------------+
| lastContactedDateOut | datetime | The date and time of the last outgoing communication activity for the resource record. |
+----------------------+----------+----------------------------------------------------------------------------------------+
| timesContacted       | integer  | Date and time of the last contact attempt (email sent, call logged,                    |
|                      |          | or other contact activity). Marketing emails are not counted.                          |
+----------------------+----------+----------------------------------------------------------------------------------------+
| timesContactedIn     | integer  | Date and time of the last incoming contact attempt (email received,                    |
|                      |          | incoming call logged, or other contact activity). Marketing emails are not counted.    |
+----------------------+----------+----------------------------------------------------------------------------------------+
| timesContactedOut    | integer  | Date and time of the last outgoing contact attempt (email sent, outgoing call logged,  |
|                      |          | or other contact activity). Marketing emails are not counted.                          |
+----------------------+----------+----------------------------------------------------------------------------------------+

