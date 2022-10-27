:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _contact_groups:

Configure Contact Groups in the Back-Office
===========================================

A **contact group** is a system entity that represents a group of :term:`contacts <Contact>`. By default, contact groups are used in :ref:`filters and segments <user-guide-filters-management>`.


Create a Contact Group
----------------------

To create a contact group:

1. Navigate to **System > Contact Groups** in the main menu.
2. Click **Create Contact Group**.
3. Define the general details and the list of contacts for the group:

   * **Owner** --- Limits the list of users who can manage the contact group to the users whose :ref:`roles <user-guide-user-management-permissions>` allow managing contact groups of the owner (e.g., the owner, members of the same business unit, system administrator, etc.).
   * **Label** --- The name used to refer to the contact group on the interface.
  
4. Select/clear the **HAS GROUP**  checkbox, to assign/unassign a contact to the contact group.

.. note::
    The **HAS GROUP** checkbox defines if the contact is assigned a specific contact group that you are creating/editing.

5. Click **Save and Close**.

Now, you can |IcEdit| edit or |IcDelete| delete a contact group from the system by clicking the corresponding icon next to the required row in the grid.

.. image:: /user/img/system/contact_groups/cont_groups_grid.png
   :alt: The actions available to contact groups from the grid

.. include:: /include/include-images.rst
   :start-after: begin
