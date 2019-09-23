.. _user-management-bu:

Business Units
==============

A business unit represents a group of users with similar business or administrative tasks/roles. 

For instance, one toy company with three toy shops can be set up as the main organization with three child business units created under it, one for each toy store. Permissions could be used to restrict access for these business units.

.. note:: If strict data isolation is needed between business units, it makes sense to use the :ref:`multi-organization <user-ee-multi-org-system>` approach.

.. note:: See a short demo on |how to create organizations and business units| or keep reading the step-by-step guidance below.

    .. raw:: html

         <iframe width="560" height="315" src="https://www.youtube.com/embed/_PpE536CQ9c" frameborder="0" allowfullscreen></iframe>

To create a new business unit:

1. Navigate to **System > User Management > Business Units** in the main menu.
2. Click **Create Business Unit** on the top right.
3. In the **General** section, provide the following information:

   * **Name** --- The name used to refer to the business unit on the interface. This is the only mandatory field.
   * **Parent Business Unit** --- The business unit to which this business unit belongs (a level higher in the administrative hierarchy).
   * **Phone** --- The phone number specified for the business unit record.
   * **Website** --- The website specified for the business unit record.
   * **Email** --- The email address specified for the business unit record.
   * **Fax** --- The fax number specified for the business unit record.

   .. image:: /user/img/system/user_management/users_bu_create.png

4. In the **Additional** section, provide a short description of the business unit record.
5. In the **Users** section, select the **Has Group** check box next to the required users to add them to the business unit you are creating.   

   .. note:: One user can belong to more than one business unit.

6. Click **Save and Close**.

Once saved, the business unit is available on the list of all business units under **System > User Management > Business Units**, where you can filter business units by name, view, edit and delete them.

.. image:: /user/img/system/user_management/user_business_unit_grid.png

**Related Articles**

* :ref:`Create and Manage User Groups <user-management-groups>`
* :ref:`Create and Manage Organizations <user-management-organizations>`
* :ref:`Work with Multiple Organizations <user-ee-multi-org>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`

.. include:: /include/include-links.rst
   :start-after: begin
