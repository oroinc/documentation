.. _user-guide-user-management-permissions-basic:

Access and Permissions Basics
=============================

OroCRM provides a lot of functionality that can enhance your CRM process. These may be used by different members of the 
team. However, it is obvious that information and tools used by a marketing associate are different from 
those required by support teams, or by the company management. Flexible structure of the access and permissions settings 
helps to ensure that all the information is safe and available right where it is required, and all the users gain access 
to the features and capabilities meeting their needs.

This guide is aimed to explain the basic ideas of the access and permission settings. If you are the system 
administrator, please address the :ref:`Access and Permissions Management <user-guide-user-management-permissions>`
guide.

What Define the Permissions
---------------------------

Access and permission rights of each user depend on the following: 

- Organizations and units, to which the user belongs: so users with the same role, working in different offices or 
  subdivisions may have different access to different information. The list of organizations and units to which a user 
  belongs is defined by the system administrator in the *"Access Settings"*. 
  
- Roles, assigned to the user: for example the sales representatives and system administrators need very different data 
  and have different access to it. The roles of a user are defined by the system administrator for each user in the 
  *"Groups and Role"*.

- Ownership type of the entity: when you create a record, you may define its *"Owner"*: these may be the user who can 
  manage the records or a business unit/organization the members whereof can manage the record. Some record types have 
  the ownership type *"None"*, which means that all the users can see them. Ownership type of each entity is defined by 
  the system administrator. 


What You Can Be Permitted
-------------------------

Access to Functionalities
^^^^^^^^^^^^^^^^^^^^^^^^^

Users with specific roles may be allowed or not allowed to use specific functionality. For example, some users may not 
have capability to assign tags, to share grids, or to create new users.

These are defined by the system administrator in the *"Capabilities section"* of each role. Only users with a role, for 
which a capability is enabled, will be able to use the functionality. 

.. note::

    Capabilities of different roles are compounded, i.e. if one role has the right to merge entities, the user will 
    have this right, regardless of the settings defined for other roles of this user.
    

Actions with Entities    
^^^^^^^^^^^^^^^^^^^^^

There is a number of actions that can be permitted for each combination of the role, organization/unit and entity.
For example, it can be defined that any user with the role "Sales Representative" who belongs to the business unit 
"California" can create and edit records of Customers, if this records were created by this user or by any other user 
from this business unit, and can only view (but not edit) similar records created by users from other business units 
(e.g. "Texas" or "Florida"). At the same time, for users with another role, for example "System Administrator", this 
records may be even not seen.

The following actions can be permitted for each role, organization/unit and entity:
  
  
- **View**: If, for a specific entity, the action is not available to a user, the user won't see the records 
  :ref:`Grids <user-guide-ui-components-grids>` nor the :ref:`View pages <user-guide-ui-components-view-pages>` 
  of this entity records.
  
- **Create**: If, for a specific entity, the action is not available to a user, the user won't be able to create new 
  entity records.

- **Edit**: If, for a specific entity, the action is not available to a user, the user won't be able to edit the entity 
  records.

- **Delete**: If, for a specific entity, the action is not available to a user, the user won't be able to delete the
  entity records.
  
- **Assign**: If, for a specific entity, the action is not available to a user, the user won't be able to change the owner 
  of the entity records.


Working in System Organizations
-------------------------------

OroCRM Enterprise edition support the use of :ref:`multiple organizations <user-ee-multi-org>`. When this functionality
is used, there can be any number of non-system and one system organization created. The users, assigned to the system 
organization can perform an action for the entity records in any organization within the system, if they are assigned a 
role, for which the relevant permission is set to *"System"*.

      |
  
.. image:: ./img/multi_org/multi_org_permission.png

|

For example, to enable your support desk to view details of all the customers), there should be:

- A system organization (e.g. "Main Office")

- A role created(e.g. "Support")

- Permission to view the customer entity defined within the "Main Office" set to "System"

- Users of the support desk must have the role "Support" and be assigned to the "Main Office" organization. 


Conclusion
----------

Your screen may not always look as in the guides, as some capabilities may not be available to you. Please address your 
system administrator, if you feel that some functionality or capability is required for your work. 