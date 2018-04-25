.. _user-guide-contacts:

Contacts
========

To save details of actual people with whom you are getting in touch during the business activities, use the Contact 
records ("contacts"). 

A contact may be assigned as a related entity to records of other entities, e.g. to :term:`users <User>`, 
:term:`accounts <Account>`, and :term:`opportunities <Opportunity>`.

Create a Contact Record
-----------------------

In order to create a Contact record:

- Go to *Customers → Contacts*.
- Click the :guilabel:`Create Contact` button.
- Define the contact settings in the sections described below.


General
^^^^^^^
The "General" section defines the basic settings of the contact created. The following fields are mandatory and 
**must** be defined in the section.

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Define users that can manage the contact, subject to the 
  :ref:`role settings <user-guide-user-management-permissions>`."
  "**First Name** and **Last Name**","Name used to refer to the contact in the UI."
  
The rest of the fields are optional. They can be used to define 
additional details of the contact, such as the name prefix and suffix, the middle name, free-text description, emails
and phone numbers, birthday, etc.

- With the optional field *"Assigned To"* you can specify a :term:`User` record, to which the contact will be assigned.

- With the optional field *"Reports To"* you can specify another Contact record, that corresponds to a person in charge 
  of the contact added (e.g. manager of the department, CEO of the company etc.).

- You can also add a picture (upload a picture to be used for the contact in the UI) and/or 
  :term:`tags <Tag>` related to the contact.

- With the *"Addresses"* form you can define Billing and Shipping addresses of the contact. Any amount of the addresses 
  may be added.

.. note::
  
    Any custom fields added to the **User** entity can be defined in the 
    ***Additional** section.

Groups
^^^^^^

The "Groups" section contains all the :ref:`contact groups <contact_groups>` available in the system. 
Check the boxes to assign the contact to a group.

One contact may be assigned to several groups.

Accounts
^^^^^^^^

The "Accounts" section contains all the :ref:`accounts <user-guide-accounts>` available in the system. 
Check the boxes to assign the contact to an account.

One contact may be assigned to several accounts.


View and Manage a Contact Record
--------------------------------

All the contacts available are displayed in the contacts :ref:`grid <user-guide-ui-components-grid-action-icons>` 
(*Customers → Contacts*).

|
  
.. image:: /user_guide/img/contacts/action_icons.png

|

From the grid you can:

- Export or import contacts, as described in the
  :ref:`Import and Export Functionality guide <user-guide-export-import>`.

- Delete a contact from the system: |IcDelete|

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the contact: |IcEdit|

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the contact: |IcView|

- Perform :ref:`bulk delete <user-guide-ui-components-grid-edit>` of several contacts.


.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle

.. |BulkDelete| image:: /user_guide/img/contacts/bulk_delete.png

