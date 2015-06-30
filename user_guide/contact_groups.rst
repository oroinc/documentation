.. _contact_groups:

Contact Groups 
==============
A *"Contact group"* is a system entity that represents a group of :term:`contacts <Contact>`. 
By default, user groups are used in the :ref:`filters and segments <user-guide-filters-management>`.


Create a Contact Group
----------------------

In order to create a contact group:

- Go to *System → Contact Groups*
- Click the :guilabel:`Create Contact Group` button
- Define the general details and the list of contacts for the group created:

General
^^^^^^^

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Limits the list of users that can manage the contact group to the users,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing contact groups of the owner (e.g. the owner, 
  members of the same business unit, system administrator, etc.)."
  "**Label**","The name used to refer to the contact group in the UI."
  
Contacts
^^^^^^^^

  Check/uncheck the **HAS GROUP** box, to assign/unassign a contact to the contact group:

.. note::

    The "HAS GROUP" check-box defines if the contact is assign the specific contact group that you are
    creating/editing

View and Manage a Contact Group Record
--------------------------------------

All the contact groups available are displayed in the *"All Contact Groups"* 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → Contact Groups*).

From the grid you can:


- Delete a contact group from the system: |IcDelete|.

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the contact group: |IcEdit|.


.. image:: ./img/contact_groups/cont_groups_grid.png

.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

 