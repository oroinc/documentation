.. _user-guide-user-management:

User Management. Administrative Structure.
==========================================

OroCRM provides a flexible user management functionality that can be tailored to reflect any specific administrative 
structure, access levels and simple grouping.

.. user-guide-user-management-admin-structure

Administrative Structure
------------------------

The lowest element of the administrative structure is a ***user***. This is a a person, group of people or a third 
party system with a specific set of credentials (login and password). 

Any amount of users can be created within one OroCRM system. 

Users can be united into ***business units***. Any amount of users can be assigned to a business unit. One user can 
belong to several business units.

Each business unit can also have child sub-units. Such business unit is called "a parent" business unit. One parent
business unit and its subunits are jointly addressed as a ***division***.


The highest element of the structure is ***organization***. It represents a real enterprise, business, firm, company or
another organization, two which the users belongs. 

.. important::

    In the community edition there is an only organization. 

    In the enterprise edition, several organizations can be created within one system.

User Groups
-----------

You can also assign a user to a User Group. User groups may be created in consideration of administrative structure or 
by any other factor of grouping (e.g. all the users with birthday in February). A user group may be used in the system
as a single aggregating entity.

By default, user groups are used in the :ref:`notification rules <system-notification-rules>` and 
:ref:`filters <user-guide-filters-management>`.

The ways to create and manage the groups is described in the 
:ref:`User Group Management guide <user-management-groups>`.

User Roles
----------

User Roles define access rights of a specific user, as described in the 
:ref:`Access and Permissions Management guide <user-guide-user-management-permissions-roles>`.

Getting Started
---------------

Upon the start, you always have one Organization and one user who can create other users and may be authorized to create
business units and (in the enterprise editions) new organizations. 

When creating/editing the records, you can define their basic details and the following relations.

***For each organization***:

- users that belong to the organization (in the Enterprise edition only)

The ways to create and manage the organization records is described in the 
:ref:`Organization Records Management guide <user-management-organization>`


***For each business unit***:

- users that belong to the business unit
- parent unit of the business unit

The ways to create and manage the business unit records is described in the 
:ref:`Business Unit Records Management guide <user-management-bu>`.

***For each user***:

- organizations the user belongs to
- business units the user belongs to
- groups the user belongs to
- role assigned to the user

The ways to create and manage the user records is described in the 
:ref:`User Records Management guide <user-management-users>`.

