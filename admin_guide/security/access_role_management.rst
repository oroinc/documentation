.. _user-guide-user-management-permissions:


Access / Role Management
========================

.. contents:: :local:
    :depth: 3


Overview
--------

Different OroCRM users require different information and tools. A user's ability to access data and perform actions in the system depends on the following:

-  Roles assigned to the user: 
	
   E.g., sales representatives and system administrators need very different data and require different access to it. 

   - Actions a user can perform with particular data depend on access levels set for these actions in the user's role.
   
   - Roles also control access to certain parts of the system. 
   
   Therefore, for some users interface may not always look like on the images in this guide. 

   Users can check which roles are assigned to them on the **My User** page (see :ref:`Access You User Page <user-guide-intro-log-in-edit-profile>` section). 

-  Organizations and units which the user has access to or is owned by: 
	
   E.g., users who work in different offices usually must have access to data exclusively within their office. 

   This information users also can see on the **My User** page.  

|   
	   
.. image:: ../img/access_roles_management/user_access.png 

|

-  An owner of particular data: 
   
   When we say that user must have access only to the data of their office, we need to specify which data belongs to which office.

   - In its turn, who can be a data owner depends on the ownership type setting for a data. This setting defines whether the data can belong to a particular user or, for example, it is something like a company address book and thus, can belong only to the whole company but not its subunits or users.   	   
  
   Users who create or edit a record can specify a record owner. The range from which they can pick up a record owner depends on the user role(s) and the ownership type of an entity the record of which they create / edit.  



.. toctree::

    access_management_roles
    access_management_roles_interface
    access_management_roles_actions
    access_management_field_level_acl 
    access_management_user_access_settings 
    access_management_ownership_type  
    access_management_access_levels 
    access_management_examples
    admin_capabilities  