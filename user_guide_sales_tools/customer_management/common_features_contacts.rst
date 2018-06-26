.. _user-guide-contacts:

Contacts
========

.. contents:: :local:
    :depth: 3

In your Oro application, you can use contacts to save details of actual people with whom you are getting in touch during the business activities.

.. note:: For a quick guidance, please see a short demo on `accounts, contacts and customers <https://oroinc.com/orocrm/media-library/22091>`_.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/3typtIVAU6Y" frameborder="0" allowfullscreen></iframe>

Create a Contact Record
-----------------------

.. note:: Checkout a short video on `how to create and edit contact records <https://oroinc.com/orocrm/media-library/create-edit-contact-records-orocrm#play=SmkJGGwG-r0>`_, or keep reading the step-by-step guidance.

In order to create a Contact record:

1. Navigate to **Customers > Contacts** in the main menu.
2. Click **Create Contact**.
3. In the **General** section, define the basic settings of the contact created.

   The following fields are mandatory and **must** be defined in the section.

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**Owner**","Define users that can manage the contact, subject to the :ref:`role settings <user-guide-user-management-permissions>`."
     "**First Name** and **Last Name**","Name used to refer to the contact in the UI."

   The rest of the fields are optional. They can be used to define additional details of the contact, such as the name prefix and suffix, the middle name, free-text description, emails and phone numbers, birthday, etc.

   - With the optional field **Assigned To** you can specify a :term:`User` record, to which the contact will be assigned.

   - With the optional field **Reports To** you can specify another Contact record, that corresponds to a person in charge
     of the contact added (e.g. manager of the department, CEO of the company etc.).

   - You can also add a picture (upload a picture to be used for the contact in the UI) and/or
     :term:`tags <Tag>` related to the contact.

   - With the **Addresses** form you can define Billing and Shipping addresses of the contact. Any amount of the addresses
     may be added.

4. The **Groups** section contains all the :ref:`contact groups <contact_groups>` available in the system. Check the boxes to assign the contact to a group. One contact may be assigned to several groups.

5. The **Accounts** section contains all the :ref:`accounts <user-guide-accounts>` available in the system. Check the boxes to assign the contact to an account. One contact may be assigned to several accounts.

View and Manage a Contact Record
--------------------------------

:ref:`Inline editing <doc-grids-actions-records-edit-inline>` can help you amend details of contacts without opening the edit contact form. For contacts, it is available from records' grids and view pages.

If the |IcPencil| **Edit Inline** icon appears next to a value, inline editing is available for it.


.. To edit a contact from the view page, double-click on the required field or the inline editing icon |IcPencil| in the field you wish to edit, and modify the value as required.


.. |

.. .. image:: ../img/data_management/view/inline_editing_2.png

.. |

.. In some cases, you will need to select the value from a dropdown.

.. |

.. .. image:: ../img/data_management/view/inline_editing_3.png

.. |

.. From the view page, you can perform inline editing for the following fields:

.. - Fax
.. - Skype
.. - Tags
.. - Birthday
.. - Gender
.. - Source

To edit contacts from the grid using inline editing, perform the same actions as for inline editing from the contact page.


.. image:: /user_guide/img/contacts/inline_editing_contacts.png
   :alt: Click the edit icon


.. image:: /user_guide/img/contacts/inline_editing_contacts_2.png
   :alt: Type the right message


All contacts available in the system are displayed on the page of all contacts (**Customers > Contacts**).


.. image:: /user_guide/img/contacts/action_icons.png
   :alt: click the delete icon to delete contact


.. note:: On the page of all contacts, you can view, edit, delete and bulk delete contacts.

 .. important:: Learn how to :ref:`export <export-bulk-items>` and :ref:`import <import-contacts>` contacts in the .csv format in corresponding topics in Oro documentation library.

Manage Address Book
-------------------

For customer and customer users in OroCommerce and contacts in OroCRM, the address book allows to enter and view account address details.

Create an Address
^^^^^^^^^^^^^^^^^

To add an address to the address book:

1. Click **Add Address** in the right corner of the selected page.

   .. image:: /user_guide/img/contacts/acc_add_address.png
      :alt: Click add address
      :class: with-border

   A popup form appears with the following fields to fill in:

	.. csv-table::
	  :header: "Field", "Description"
	  :widths: 10, 30

	  "**Types**","Defines the type of the address to be entered:

	  - Billing
	  - Shipping
	  - Default Billing
	  - Default Shipping

	  Note: More than one type can be selected for one address."
	  "**Primary**", "Checking the **Primary** box marks the address primary. Note that only one primary address is possible. Marking a different address primary will by default delete the this mark from the address that has previously been marked Primary."
	  "**Label**", "Identify the address by adding a label. This can help distinguish addresses, if there is more than one address in the address book for one account."
	  "**Name prefix**", "If applicable, add a prefix to the name, e.g. Dr., Mrs., etc."
	  "**First name**", "Enter the first name of the account representative."
	  "**Middle name**", "Enter the middle name of the account representative."
	  "**Last name**", "Enter the last name of the account representative."
	  "**Name suffix**", "If applicable, add a suffix name, e.g. IV, Jr., etc."
	  "**Organization**",  "Specify the organization represented by the account."
	  "**Country***", "This field is mandatory. Select the country from the list. Selecting a country prompts the following fields to appear:

	  -	Street*
	  -	Street 2
	  -	City*
	  -	State
	  -	Zip/postal code*
	  -	Phone"

	Street, City and Zip are mandatory fields.

2. Click **Save** once you have filled in all the fields.

   The address and the map showing the address location is displayed on the right of the address.

   .. image:: /user_guide/img/contacts/acc_address_saved.png
      :alt: The address and the map displaying the address location
      :class: with-border

View an Address on the Map
^^^^^^^^^^^^^^^^^^^^^^^^^^

It is possible to add more addresses to the same account. If you have more than one address on the Address Book page, clicking on one or the other will prompt a map to appear that corresponds to the selected address.

.. image:: /user_guide/img/contacts/acc_address_correspondin_map.png
   :alt: View an address on the map
   :class: with-border

Manage an Address
^^^^^^^^^^^^^^^^^

* **Mark address as primary**

To mark address as primary, click the |IcEdit| on the right top of the address background, check the **Primary** box and click **Save**. The primary label will move to the updated address.

.. note:: Delete is disabled for the primary address. To delete the address marked as primary, you need to move the primary label to a different address first.

* **Edit an address**

To edit an address, click the |IcEdit| on the right top of the address background, update the address details and click **Save**.

* **Delete an address**

Delete an address by clicking the |IcDelete| next to it.



.. include:: /img/buttons/include_images.rst
   :start-after: begin
