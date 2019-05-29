:orphan:

.. _doc-user-management-users-access-examples:

Blueprints of User Access Configuration
=======================================

.. warning:: As a precondition, we have ensured that there is a sales assistant role with the **Business Unit** access level granted for the sales-related entities and the sales manager role with the **Division** access level granted for the same entities. The users in the examples below have one of these roles assigned.

.. contents:: :local:
    :depth: 2

Example 1: Access to Business Units of the Same Organization
------------------------------------------------------------

A sales assistant Todd needs access to the business units highlighted in yellow that are in the same organization.

.. image:: /user_doc/img/system/user_management/user_bu_2_org_1_sch.png

Select each of the business units in **Access Settings**:

.. image:: /user_doc/img/system/user_management/user_bu_2_org_1.png

Example 2: Access to Business Units in Different Organizations
--------------------------------------------------------------

If a sales assistant Todd is helping in the sibling organization, he might need access to the business units highlighted in yellow that belong to the different organizations:

.. image:: /user_doc/img/system/user_management/user_bu_2_org_2_sch.png

Select each of the organizations and business units to which Todd must have access in the **Access Settings** section:

.. image:: /user_doc/img/system/user_management/user_bu_2_org_2.png

Example 3: Access to the Business Unit with Subunits
----------------------------------------------------

When Todd is promoted to the sales manager, his role changes to the one with the division access level, and he gets access to the business units and the chain of its subunits.

.. image:: /user_doc/img/system/user_management/user_bu_2dl_org_1_sch.png

.. note:: A division is a business unit with the whole chain of its subunits, so you can select only the top business unit of the division (**ACME East** in our example) in **Access Settings** to automatically give Todd access to the entire division.

When a new business unit is added to the division, the sales manager has the necessary access to monitor it.

.. image:: /user_doc/img/system/user_management/user_bu_2dl_org_1_sch2.png

**Related Articles**

* :ref:`End-to-end Access Configuration in Context <user-guide-user-management-permissions-roles--examples>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Field Level Permissions <user-guide-user-management-permissions-roles--field-level-acl>`
* :ref:`Entity and System Capabilities <admin-capabilities>`
* :ref:`Create and Manage Roles <user-guide-user-management-permissions-roles--actions>`
* :ref:`Create Business Units <user-management-bu>`
* :ref:`Create and Manage Organizations <user-management-organizations>`
* :ref:`Work with Multiple Organizations <user-ee-multi-org>`


