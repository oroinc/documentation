.. _user-guide-user-management-roles:

Roles Management
================
OroCRM provides a lot of functionality that can enhance your CRM process. These may be used by different members of the 
team. However, it is obvious that information and tools used by a marketing associate are different from 
those required by support teams, or by the company management. To make sure that all the information is safe and 
available right where it is required, and all the users gain access to the features and capabilities meeting their needs
and competence, you need to create Roles.

Roles represent a set of functions performed by the user in the Company and will be used to define to what data and
functionality the user will have access.

Initially, there are three roles available in OroCRM community edition: 

- **Administrator**: responsible for the OroCRM instance set-up and maintenance, installs extensions, creates 
  integrations, provides necessary system adjustment, would such a need arise. 
  
  By default, users who have this role, gain access to all the functionality and to any part of the system, however this 
  could be changed (for example, in some companies security policies would not allow the system administrator to see 
  personal details of the customers). 

- **Sales Manager**: responsible for direct communication with the customers and conversion of opportunities 
  into actual orders.  

- **Marketing Associate**: responsible for ongoing growth of the customer-base with marketing campaigns and mass 
  mailings
  
You can add any amount of roles, for example, for managers or support groups. Moreover, roles can be 
added at any moment if such a need arises, or deleted if the practice shows they are excessive.


Each OroCRM :term:`user <User>` must be assigned at least one role.
One user may have any number of roles. All the permissions granted to at least one of the roles assigned to a user, are 
granted to the user. 

Create a Role
-------------

To create a new role:

- Go to *System → User Management → Roles*.
- Click the :guilabel:`Create Role` button.

  |
  
  |role_create|

  |
  
- In the form that has emerged, define the role name that will be used to assign it to a user.

  Define other settings in the sections described below:
  
  - **Entity**: Define what permissions the users assigned this role will have for the entity records that have 
    an ownership type other than "None".
  - **Capabilities**: Define if the user that has been assigned this role will have access to certain parts of the 
    system.
  - **Users**: Select users to be assigned this role.

The "Entity" Section
^^^^^^^^^^^^^^^^^^^^

To specify if users with this role will be able to perform specific actions with the entity and at which level, choose 
the permissions for each entity and each action from the drop-down menu:

      |
  
.. image:: ./img/user_management/role_entity.png

More detailed description of the available options is provided in the 
:ref:`Access and Permissions Management <user-guide-user-management-role-permissions>` guide.

The *"Default"* field specifies the permission settings that are by default assigned to a new entity.


The "Capabilities" Section
^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable or disable a specific system functionality for the role, use the "Capabilities" section.

      |
  
.. image:: ./img/user_management/role_capabilities.png

There are only two options:

- **None**: users with the role won't be able to use the functionality.
- ***System***: users with the role will be able to use the functionality for all the records created within their
  OroCRM instance they've logged in into.

  
The "Users" Section
^^^^^^^^^^^^^^^^^^^

Choose users to be assigned the role created in the "Users" section

Check/uncheck the **HAS ROLE** box to assign/unassign a user to the role:

      |
	  
.. image:: ./img/user_management/role_users.png

.. note::

    Please note that the "HAS ROLE" check-box defines if the user is assigned the specific role that you are 
    editing/creating.

Manage Roles
------------

Once a role has been created, it will be added to the "All Roles" 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → User Management → Roles*).

From the grid you can:


- Delete the role from the system: |IcDelete|. If there is at least one user that has this role, the role cannot be 
  deleted.

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the campaign: |IcEdit|. 



.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle


.. |role_create| image:: ./img/user_management/role_create.png
   :align: middle