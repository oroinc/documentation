 .. _user-management-users:

User Records Management
=======================

Create a User Record
--------------------

In order to create a :term:`User` record:

- Go to the *System → User Management → Users*
- Click the :guilabel:`Create User` button
- Define the user settings in the sections described below.

Create User. The "General" Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The "General" section defines the basic settings of the user created. The following fields are mandatory and **must** be 
defined in the section.

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Owner**","Define a :term:`business unit <Business Unit>`, users of which can manage the user, subject to the 
  :ref:`role settings <user-guide-user-management-permissions>`"
  "**Status**","Chose the record status. Possible values are Inactive* or *Active*"
  "**Username**","The name used to log into the system (login)"
  "**Password**","The password used to log into the system"
  "**First Name** and **Last Name**","Name used to refer to the user in the UI"
  "Primary Email","Email associated with the user in the system"
  
Along with the mandatory fields, there is a number of optional fields provided be default, that can be used to define 
additional details of the customer, such as the name prefix and suffix, the middle name, birthday, additional emails,
and phone number. You can also add the avatar (upload a picture to be used for the user in the UI) and/or 
:term:`tags <Tag>`related to the user.

The "*Send An Email Invitation*" check-box defines if an invitation email shall be sent to the user.

.. image:: ./img/user_management/user_general.png

Create User. The "Additional" Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
  
Any custom fields :ref:`added <user-guide-field-management-create>` to the "User" entity will be displayed in the 
*"Additional"* section.

Create User. The "Groups and Roles" Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The section contains all the :ref:`user groups <user-management-groups>` and 
:ref:`roles <user-guide-user-management-permissions-roles>` available in the system. Check the boxes to assign the user
created to a group/role.

One user may have several roles. All the permissions granted to at least one of the roles, are granted to the user. 

.. image:: ./img/user_management/user_groups.png

Create User. The "Access Settings" Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The section contains all the :ref:`organizations <user-management-organizations>` and 
:ref:`business units <user-guide-user-management-bu>` available in the system. Check the boxes to assign the user
to an organization/business unit.

.. image:: ./img/user_management/user_access.png

.. hint::

    In the community enterprise there can only be one organization, so organizations are not shown in the structure.





One user may have several roles. All the permissions granted to at least one of the roles, are granted to the user. 
