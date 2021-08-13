:oro_show_local_toc: false

.. _bundle-docs-platform-organization-bundle:

OroOrganizationBundle
=====================

OroOrganizationBundle extends the OroPlatform ACL system with organization and business unit ownership levels and provides the ability for the application users to reflect the company organizational structure in the application ACL permission scheme.

OroOrganizationBundle introduces two entities: Organization and Business Units that help with data responsibility and configuration.

An organization can have multiple business units assigned.

Each business unit must have a parent organization assigned and can have an owning Business Unit.

Each user can be assigned to multiple business units. For ease of assignment, a business units tree is located on the user update page.

Entity Ownership
-----------------

Each entity can have one of 3 ownership types defined: User, Business Unit, or Organization.

Ownership type is stored in entity config and can be defined through entity class annotation:

.. code-block:: php

    /**
        ...
     * @Configurable(
     *  defaultValues={
     *      "entity"={"label"="User", "plural_label"="Users"},
     *      "ownership"={
     *          "owner_type"="BUSINESS_UNIT",
     *          "owner_field_name"="owner",
     *          "owner_column_name"="business_unit_owner_id"
     *      }
     *  }
     * )
        ...
     */
     class User

Available Ownership Types
-------------------------

.. code-block:: none

    <table>
    <tr>
        <th>Label</th>
        <th>Code</th>
    </tr>
    <tr>
        <td>User</td>
        <td>USER</td>
    </tr>
    <tr>
        <td>Business Unit</td>
        <td>BUSINESS_UNIT</td>
    </tr>
    <tr>
        <td>Organization</td>
        <td>ORGANIZATION</td>
    </tr>
    </table>

Users with ASSIGN permission can change owners of any record to which they have access.

If change owner permission is not granted, 2 cases are possible when an entity is created:

- If the ownership type is USER, the owner is automatically set to the current user.
- If the ownership type is BUSINESS_UNIT or ORGANIZATION, a user has to choose the owner from the list of business units or organizations to which the user is assigned.

.. include:: /include/include-links-dev.rst
   :start-after: begin