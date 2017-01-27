.. _user-management-groups:

User Groups 
===========
A *"User group"* is a system entity that represents a group of :term:`users <User>`. 
By default, user groups are used in the :ref:`notification rules <system-notification-rules>` and 
:ref:`filters <user-guide-filters-management>`.


Create a User Group
-------------------

In order to create a user group:

- Go to *System → User Management → Groups*
- Click the :guilabel:`Create Group` button
- Define the general details and the list of users for the group created:

General
^^^^^^^

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Define a business unit, members of which may be able to manage the user group, subject to the 
  :ref:`access and permission settings <user-guide-user-management-permissions>`"
  "**Name**","The name used to refer to the user group in the UI."
  
Users
^^^^^
  Check/uncheck the **HAS GROUP** box, to assign/unassign a user to/from the user group.

.. note::

    The "HAS GROUP" check-box defines if the user is assign the specific user group that you are
    creating/editing

View and Manage a User Group Record
--------------------------------------

All the user groups available are displayed in the User Groups 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → User Management → User Groups*).

From the grid you can:


- Delete a user group from the system: |IcDelete|

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the user group: |IcEdit|


.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

 
