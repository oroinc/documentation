
Roles and Permissions
---------------------

Each OroCRM user must be assigned a role or several roles. The role defines a set of permissions that will be available
for all the users, who have been assigned this role.

Each entity in OroCRM has an :ref:`ownership type <user-guide-entity-management-create-other>` type, which defines the 
level at which permissions will be set for records of the entity.

If the ownership type is set to "None", no authorization is required to see and process the entity and all the users
within the OroCRM instance will be able to view, create, edit, delete and assign records of the entity. 

If the ownership type is set to a User /Business Unit/Organization ability to see and process the entity will appera in 
the role form.

Creating a Role
---------------



Permissions for Entity with Ownership Type "Organization"
---------------------------------------------------------

If the entity type is set to "Organization", when
the entity record is created an Organization is chosen as its Owner. 
In the "Roles" table you can choose one of the two options for each action (View, Create, Edit, Delete, Assign): None or 
Organization.
- If None is chosen, no users will be able to perform the action.
- If Organization is chosen, all the users from the Organization set up as an Owner will be able to perform the action.

Permissions for Entity with Ownership Type "Business Unit"
---------------------------------------------------------

If the entity type is set to "Business Unit", a specifi permissions to it can only be set to Organization. This means, that when
the entity record is created an Organization is chosen as its Owner. 
In the "Roles" table you can choose one of the two options for each action (View, Create, Edit, Delete, Assign): None or 
Organization.
- If None is chosen, no users will be able to perform the action.
- If Organization is chosen, all the users from the Organization set up as an Owner will be able to perform the action.


Upon the start, you always have one Organization and on user who can create other users and may be authorized to create
business units and (in the enterprise editions) new organizations. 

When creating/editing the records, you can define their basic details and the following relations.

For each organization:

- users that belong to the organization
- business units that belong to the organization. If a business units belong to an organization, all the users from this
  business unit will belong to it

For each business unit:

- organizations, to which the business unit belongs
- users that belong to the business unit
- parent units of the business unit

For each user:

- organizations, to which the user belongs
- business units, to which the user belongs


Create/Edit Users
-----------------

Create/Edit 


 You can also create other Organizations as described in the 
:ref:`Organization Management <user-management-organizations>` guide.
Users created from t

OroCRM provides a comprehensive and extremely flexible functionality to manage users and their permissions in the 
system.

Each person or group of people accessing the system with the same credentials are a :ref:`user <user-management-users>`.

Each user can belong to a :ref:`business unit <user-management-bu>` - a group of users with similar access rights.

When an entity is created in OroCRM it is assigned an Owner. Subject to the entity ownership type, the owner may be a
set to:
- a user: , a business unit, or an organization

Each user must be assigned a role. The :ref:`roles <user-management-roles>` defines the set of access level rules, 
applied for the user. For each entity and action (view, edit, create, delete, assign)there can be defined one of the 
following access levels:

- None: no users can perform the action for the entity records
- User: the user can perform the action for the entity records owned by the user, and only to them.
- Business Unit: the user can perform the action for the entity records owned by the user, as well as to the records 
  owned by other users that belong to the same business unit.
- Division: the user can perform the action for the entity records owned by the user, as well as to the records owned 
  by other users that belong to the same business unit and/or to the child business-units thereof.
- Organization: the user can perform the actions for the entity records created within the current organization.



Each user can belong to a group. The :ref:`groups <user-management-groups>` can be used to define rules for mass 
mailings. 