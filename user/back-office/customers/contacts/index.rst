.. _user-guide-contacts:

Manage Contacts in the Back-Office
==================================

.. hint:: This section is part of the :ref:`Customer Management <concept-guide-customers>` topic that provides a general understanding of accounts, contacts, customers, and customer hierarchy available in the Oro applications.

In your Oro application, you can use :term:`contacts <Contact>` to save details of actual people you are getting in touch with during business activities.

.. note:: For quick guidance, please see a short demo on |accounts, contacts and customers|.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/3typtIVAU6Y" frameborder="0" allowfullscreen></iframe>

Create a Contact
----------------

.. note:: Check out a short video on |how to create and edit contact records|, or keep reading the step-by-step guidance.

In order to create a contact:

1. Navigate to **Customers > Contacts** in the main menu.
2. Click **Create Contact**.
3. In the **General** section, define the basic settings of the contact created.

   The following fields are mandatory, and **must** be defined in the section.

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**Owner**","Define users that can manage the contact, subject to the :ref:`role settings <user-guide-user-management-permissions>`."
     "**First Name** and **Last Name**","Name used to refer to the contact in the UI."

   The rest of the fields are optional. You can use them to define additional details of the contact, such as the name prefix and suffix, the middle name, free-text description, emails, phone numbers, birthday, etc.

   - With the optional field **Assigned To**, you can specify a :term:`user` record to assign the contact to.

   - With the optional field **Reports To**, you can specify another contact record that corresponds to a person in charge
     of the contact added (e.g., department manager, company CEO, etc.).

   - You can also add a picture (upload a picture to be used for the contact in the UI) and/or
     :term:`tags <Tag>` related to the contact.

   - With the **Addresses** form, you can define the Billing and Shipping addresses of the contact. You can add any number of addresses.

4. The **Groups** section contains all the :ref:`contact groups <contact_groups>` available in the system. Check the boxes to assign a contact to a group. You can assign one contact to several groups.

5. The **Accounts** section contains all the :ref:`accounts <user-guide-accounts>` available in the system. Check the boxes to assign a contact to an account. You can assign one contact to several accounts.

View and Manage a Contact
-------------------------

All contacts available in the system are displayed on the page of all contacts under **Customers > Contacts**, where you can view, edit, delete, and bulk-delete contacts.

.. image:: /user/img/customers/contacts/action_icons.png
   :alt: click the delete icon to delete contact

:ref:`Inline editing <doc-grids-actions-records-edit-inline>` can help you amend details of contacts without opening the edit contact form. For contacts, it is available from records' grids and view pages.

If the |Pencil-SVG| **Edit Inline** icon appears next to a value, you can edit it inline. You can edit contacts inline from the grid the same way.

.. image:: /user/img/customers/contacts/inline_editing_contacts.gif
   :alt: Illustrate inline editing

.. .. important:: Learn how to :ref:`export <export-bulk-items>` and :ref:`import <import-contacts>` contacts in the .csv format in corresponding topics in Oro documentation library.

Create an Address
-----------------

.. include:: /user/back-office/customers/customers/address-book.rst
   :start-after: begin
   :end-before: finish

.. toctree::
   :maxdepth: 1

   export-contacts
   import-contacts

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin


.. include:: /include/include-links-user.rst
   :start-after: begin