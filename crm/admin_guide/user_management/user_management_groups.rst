.. _user-management-groups:

User Groups 
===========
A ``user group`` is a system entity that represents a group of :term:`users <User>`.
By default, user groups are used in the :ref:`notification rules <system-notification-rules>` and 
:ref:`filters <user-guide-filters-management>`.


Create a User Group
-------------------

In order to create a user group, complete as follows:

1. In the main menu, navigate **System>User Management>Groups**.
2. Click the :guilabel:`Create Group` button.
3. Define the general details and the list of users for the group. The description of the fields see in the sections below.

General
^^^^^^^

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Define a business unit, members of which may be able to manage the user group, subject to the 
  :ref:`access and permission settings <user-guide-user-management-permissions>`"
  "**Name**","The name used to refer to the user group on the interface."
  
Users
^^^^^

  Select / clear the **HAS GROUP** check box, to assign/unassign a user to/from the user group.

.. note::

    The **HAS GROUP** check box defines if the user is assign the specific user group that you are
    creating/editing

View and Manage a User Group Record
--------------------------------------

All the user groups available are displayed in the **User Groups**
grid (**System>User Management>User Groups**).

From the grid you can:


- Delete a user group from the system: click the |IcDelete| **Delete** icon.

- Get to the :ref:`Edit page <user-guide-ui-components-create-pages>` of the user group: click the |IcEdit| **Edit** icon.


.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

 
