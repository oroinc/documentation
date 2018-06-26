.. _contact_groups:

Contact Groups
==============

A ``contact group`` is a system entity that represents a group of :term:`contacts <Contact>`.
By default, contact groups are used in the :ref:`filters and segments <user-guide-filters-management>`.


Create a Contact Group
----------------------

In order to create a contact group:

1. In the main menu, navigate **System>Contact Groups**.
2. Click the :guilabel:`Create Contact Group` button.
3. Define the general details and the list of contacts for the group. See the field descriptions in the sections below.

General
^^^^^^^

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Limits the list of users that can manage the contact group to the users whose
  :ref:`roles <user-guide-user-management-permissions>` allow managing contact groups of the owner (e.g. the owner,
  members of the same business unit, system administrator, etc.)."
  "**Label**","The name used to refer to the contact group on the interface."

Contacts
^^^^^^^^

Select / clear the **HAS GROUP**  check box, to assign / unassign a contact to the contact group.

.. note::
    The **HAS GROUP** check box defines if the contact is assign the specific contact group that you are
    creating / editing.

View and Manage a Contact Group Record
--------------------------------------

All the contact groups available are displayed in the **All Contact Groups** grid (**System>Contact Groups**).

From the grid you can:


- Delete a contact group from the system: click the |IcDelete| **Delete** icon.

- Open the :ref:`edit page <user-guide-ui-components-create-pages>` of the contact group: click the |IcEdit| **Edit** icon.


.. image:: /user_guide/img/contact_groups/cont_groups_grid.png
   :alt: View and manage a contact group record

.. include:: /img/buttons/include_images.rst
   :start-after: begin
