.. _user-guide-user-management-permissions-basic:

Access and Permissions Basics
=============================

The functionality built within OroCRM can enhance your CRM process. However, different members of the team will require 
different information and tools. For instance, the needs of marketing associates are different from those of support 
teams or company management. Because of this, OroCRM allows a good deal of flexibility when it comes to adjusting access 
and permission settings. This helps to ensure that all information is safe but still easily available. All users will be 
able to use the features and capabilities that they require. 

This guide will explain the basic ideas that make up the access and permission settings. If you are the system 
administrator, please address the :ref:`Access and Permissions Management <user-guide-user-management-permissions>`
guide.

What Defines the Permissions
----------------------------

Access and permission rights of each user depend on the following: 

- Organizations and units to which the user belongs: So users with the same role, working in different offices or 
  subdivisions, may have different access to different information. The list of organizations and units to which a user 
  belongs is defined by the system administrator in the *"Access Settings"*. 
  
- Roles assigned to the user: For example, sales representatives and system administrators need very different data and 
  require different access to it. The roles of a user are defined by the system administrator for each user in the 
  *"Groups and Role"*. 

- Ownership type of the entity: When you create a record, you may define its *"Owner"*. These may either be a single 
  user who can manage the record or an entire business unit/organization. Some record types have the ownership type 
  *"None"*, which means that all users can see them. The ownership type of each entity is defined by the system 
  administrator. 



Permissions
-----------

Access to Functionalities
^^^^^^^^^^^^^^^^^^^^^^^^^

Depending on their specific roles, users will have access to different functionalities. For example, some users may not 
be able to assign tags, share grids, or create new users.

These are defined by the system administrator in the *"Capabilities section"* of each role. Users will only be able to 
access a functionality when it has been enabled within their role. 

.. note::

    Capabilities of different roles are compounded. For example, if one role has the right to merge entities, the user 
    will have this right, regardless of the settings defined for other roles of this user.
    

Actions with Entities    
^^^^^^^^^^^^^^^^^^^^^

There is a number of actions that can be permitted for each combination of the role, organization/unit and entity.
For example, it can be defined that any user with the role "Sales Representative" who belongs to the business unit 
"California" can create and edit records of Customers, if this records were created by this user or by any other user 
from this business unit, and can only view (but not edit) similar records created by users from other business units 
(e.g. "Texas" or "Florida"). At the same time, for users with another role, for example "System Administrator", this 
records may be even not seen.

The following actions can be permitted for each role, organization/unit, and entity:
  
  
- **View**: If, for a specific entity, this action is not available to a user, the user will not see the 
  :ref:`Grids <user-guide-ui-components-grids>` nor the :ref:`View pages <user-guide-ui-components-view-pages>` 
  of this entity records.
  
- **Create**: If, for a specific entity, this action is not available to a user, the user won't be able to create new 
  entity records.

- **Edit**: If, for a specific entity, this action is not available to a user, the user won't be able to edit the entity 
  records.

- **Delete**: If, for a specific entity, this action is not available to a user, the user won't be able to delete the
  entity records.
  
- **Assign**: If, for a specific entity, this action is not available to a user, the user won't be able to change the owner 
  of the entity records.


Working in System Organizations
-------------------------------

OroCRM Enterprise edition supports the use of :ref:`multiple organizations <user-ee-multi-org>`. With this 
functionality, there can be created any number of organizations. One of them may be defined as a *"System"* organization. 
The users who are assigned to the system organization can perform an action for the entity records in any organization 
within the system, as long as they are assigned a role for which the relevant permission is set to *"System"*. 


      |
  
.. image:: ./img/multi_org/multi_org_permission.png

|

For example, before your support desk can view the details of each customer, there should be:

- A system organization (e.g., "Main Office")

- A role created (e.g., "Support") and not assigned to any specific organization

- Permission to view the customer entity defined for the role "Support" set to "System"

- Users of the support desk must have the "Support" role and be assigned to the "Main Office" organization. 


Conclusion
----------

Your screen may not always look like the images in this guide, as some capabilities may not be available to you. Please 
contact your system administrator if you require a specific functionality or capability for your work.