.. _user-guide-user-management-permissions:

Access and Permissions Management
=================================

OroCRM provides a lot of functionality that can enhance your CRM process. These may be used by different members of the 
team. However, it is obvious that information and tools used by a marketing associate are different from 
those required by support teams, or by the company management. Flexible structure of the access and permissions settings 
helps to ensure that all the information is safe and available right where it is required, and all the users gain access 
to the features and capabilities meeting their needs.

Access and permission rights of each user depend on the following: 

- Organizations and units, to which the user belongs (specified for each user in the 
  :ref:`*"Access Settings"* section <user-management-users-access>` 
  
- Roles, assigned to the user (specified for each user in the 
  :ref:`*"Groups and Role"* section <user-management-users-groups-roles>`), i.e. from the *"Entity"* settings and 
  *"Capabilities*" defined for this role

- Ownership type of the entity (defined for each entity in the 
  :ref:`*"Other Settings"* section<user-guide-entity-management-create-other>` )  

This article is aimed to provide a better understanding of the functionality. 


.. _user-guide-user-management-role-permissions:

What Can Be Permitted
---------------------

Capabilities
^^^^^^^^^^^^

The *"Capabilities"* settings of each role, specify if the users assigned this role will have access to a specific 
part of the system, as shown in the picture below.

.. image:: ./img/user_management/role_entity_dropdown.png

For each role and capability pair there are only two options 

- **None**: users with the role won't be able to use the functionality.
- ***System***: users with the role will be able to use the functionality for all the records created within their
  OroCRM instance they've logged in into.
  
.. note::

    Capabilities of different roles are compounded, i.e. if one role has the right to merge entities, the user will 
    have this right, regardless of the settings defined for other roles of this user.
    

Actions with Entities    
^^^^^^^^^^^^^^^^^^^^^

There is a number of actions that can be permitted for each combination of the role, organization/unit and entity.
For example, you can define that any user with the role "Sales Representative" who belongs to the business unit 
"California" can create and edit records of Customers, if this records were created by this user or by any other user 
from this business unit, and can only view (but not edit) similar records created by users from other business units 
(e.g. "Texas" or "Florida"). At the same time, for users with another role, for example "System Administrator", this 
records may be even not seen.

The following actions can be permitted for each role, organization/unit and entity:
  
  
- View: If, for a specific entity, the action is not available to a user, the user won't see the records 
  :ref:`grid <user-guide-ui-components-grids>` nor the :ref:`View pages <user-guide-ui-components-view-pages>` 
  of this entity records.
  
- Create: If, for a specific entity, the action is not available to a user, the user won't be able to create new entity 
  records.

- Edit: If, for a specific entity, the action is not available to a user, the user won't be able to edit the entity 
  records.

- Delete: If, for a specific entity, the action is not available to a user, the user won't be able to delete the
  entity records.
  
- Assign: If, for a specific entity, the action is not available to a user, the user won't be able to change the owner 
  of the entity records.

.. image:: ./img/user_management/role_entity_dropdown.png


.. _user-guide-user-management-role-permissions-system:

Permissions in System Organizations
-----------------------------------

OroCRM Enterprise edition support the use of :ref:`multiple organizations <user-ee-multi-org>`. When this functionality
is used, there can be any number of non-system and one system organization created. The users, assigned to the system 
organization can perform an action for the entity records in any organization within the system, if they are assigned a 
role, for which the relevant permission is set to *"System"*.

      |
  
.. image:: ./img/multi_org/multi_org_permission.png

|

For example, to enable your support desk to view details of all the customers), you need to:

- create a system organization ("System Org")

-  :ref:`create a role <user-guide-user-management-roles>` (for example "Support"). 

- set the :ref:`permissions <user-guide-user-management-role-permissions-system>` for the customer entity view to 
  "System"

- for the users that represent your support desk:

  - ref:`assign the role <user-management-users-groups-roles>` "Support", and
  - ref:`assign the organization <user-management-users-access:>` "System"
  
  
.. caution::

    Any other permission setting but *"System"* defined for a role, in a system organization, will be treated as 
    *"None"*.


.. _user-guide-user-management-role-permissions-non-system:
    
Permissions in Non-System Organizations
---------------------------------------

Permissions in non-system organizations depend on the ownership type of the entity for which they are defined.


.. _user-guide-user-management-permissions-ownership-type:

Ownership Types
^^^^^^^^^^^^^^^

Each entity in OroCRM has an :ref:`ownership type <user-guide-entity-management-create-other>`, which defines the 
level at which permissions will be set for records of the entity.

If the ownership type is set to *"None"*, all the users
within the OroCRM instance will be able to view, create, edit, delete and assign records of the entity in a non-system 
organization. 

If the ownership type of an entity is set to an *"Organization"*, a *"Business Unit"* or a *"User"*, the ability to see 
and process the entity records is defined by the role(s) assigned to the user as described in the following sections.


Ownership Type "Organization"
"""""""""""""""""""""""""""""

If the entity ownership type is set to *"Organization"*, when an entity record is created, an 
:term:`organization <Organization>` is chosen as its :term:`owner <Owner>`. 

When defining a role permissions for such an entity, you can choose one of the following options for each action: 

- **None**: No users will be able to perform the action.
- **Organization**: All the users from the owner-organization will be able to perform the action.
- **System**: All the users will be able to perform the action.

  |

Ownership Type "Business Unit"
""""""""""""""""""""""""""""""

If the entity ownership type is set to *"Business Unit"*, when an entity record is created, a 
:term:`business unit <Business Unit>` is chosen as its Owner. 


When defining a role permissions for such an entity, you can choose one of the following options for each action: 

- **None**:  No users will be able to perform the action.
- **Business Unit**: All the users from the owner-business-unit will be able to perform the action.
- **Division**: All the users from the owner-business-unit and from its all of its child business units will be able to 
  perform the action.
- **Organization**: All the users from the organization to which the owner-business-unit belongs, will be able to 
  perform the action.
- **System**: All the users will be able to perform the action.

  |

"User"
""""""

If the entity type is set to "User", when an entity record is created, a :term:`user <User>` is chosen as its owner. 

When defining a role permissions, you can choose one of the following options for each action: 

- **None**: No users will be able to perform the action.
- **User**: Only the owner-user will be able to perform the action.
- **Business Unit**: All the users from the business unit to which the owner-user belongs will be able to perform the 
  action.
- **Division**: all the users from the business unit to which the owner-user belongs and from all of its child business 
  units will be able to perform the action.
- **Organization**: all the users from the organization, to which the owner-user belongs, will be able to perform the 
  action.
- **System**: all the users will be able to perform the action.


Conclusion
----------

Correctly defined capabilities, ownership types of the entities and permissions of the roles will help you to make sure 
that only duly authorized users can access and process data in the system, and at the same time will keep the employees 
from being overwhelmed with the excessive and unnecessary data and functions. 