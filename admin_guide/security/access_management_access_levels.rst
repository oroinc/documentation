.. _access-management--access-level:

Access Levels
=============

.. contents:: :local:
    :depth: 3



Access levels define a hierarchy of access to data. They can be envisioned as nested boxes. The smaller the box, the more limited set of data a user can access and vice verse. If a user has no box, they have no access whatsoever.
OroCRM has a predefined set of access levels with ``None`` being the most limited and ``Global`` providing the widest access to the data. 

	
.. image:: ../img/access_roles_management/access_levels2.png 



The full list of all possible access levels can be found in the following table:  


+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| Access Level                                 |  What data a user can access?                                                                                                 |
+---------------+------------------------------+                                                                                                                               |
| EE            | CE, EE with 1 organization   |                                                                                                                               |
+===============+==============================+===============================================================================================================================+
| None          | None                         | Access is denied.                                                                                                             |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| User          | User                         | Entity records owned by the user (providing the user has access to the organization(s) for which these records were created). |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| Business Unit | Business Unit                | Entity records owned by the business unit(s) the user has access to or by any user that has access to the same business unit. |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| Division      | Division                     | Entity records:                                                                                                               |
|               |                              |                                                                                                                               |  
|               |                              | * Owned by business unit(s) the user has access to or by any user that has access to the same business unit.                  |
|               |                              | * Owned by the whole chain of the business units subordinated to those the user has access to.                                |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| Organization  | Global                       | All entity records within the organization the user has access to.                                                            |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+
| Global        |                              | All entity records within the system.                                                                                         |
+---------------+------------------------------+-------------------------------------------------------------------------------------------------------------------------------+


.. Note::
	As you can see, the exact list of access levels available in your system depends on the number of organizations defined. If there is only one organization created (for OroCRM Enterprise Edition, since OroCRM Community Edition does not provide the possibility to create several organizations), there will be no individual **Organization** access level. 


.. Important:: 
	When a user logs into the organization with global access, all their access levels, except **Global,** are treated as **None.**


How Are Access Levels Used? 
---------------------------

You set access levels when you configure a user role and define permissions it will include. For each action that can be performed on entity (view, create, delete, etc.) you can set an access level. 

For example, for the **Account** entity, **Create** action, you set the **User** access level. It means that a user with such role will be able to create accounts only with themselves as an owner. 
If you decide to grant a user permission to create accounts withing the user's division (i.e., when creating an account, the user can set any member of the same division as the account's owner), create a role that will have the **Division** access level for the **Account** entity, action **Create** 

For more information and examples on roles creation, see the :ref:`Roles <user-guide-user-management-permissions-roles>` guide.

.. important::
  There are two access levels that you can set for any entity: **None** and **Global.**

	Ability to set other access levels depends on the entity’s ownership type. You can set an access level that is ‘higher than or equal’ to the entity’s ownership type. Thus, if an entity's ownership type is **Business Unit**, you cannot set the **User** access level for any action on this entity. 

	For more information about ownership types, see the :ref:`Ownership Type <user-guide-user-management-permissions-ownership-type>` guide.



Related Articles
----------------

For general overview of roles, see the :ref:`Roles Management <user-guide-user-management-permissions-roles>` guide.
For examples on roles and access settings application, see the :ref:`Access Configuration Examples <access-management--examples>` guide.

