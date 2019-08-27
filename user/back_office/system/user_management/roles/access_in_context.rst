.. _user-guide-user-management-permissions-roles--examples:

End-to-end Access Configuration in Context
==========================================

We are going to illustrate how to configure access in |oro_application| on a simple example of AMCE company that consists of two organizations (ACME Manufacturing and ACME Services). We will focus on the ACME Services organization that has two regional divisions, one in the USA and the other one in the EU. Each of these two divisions has smaller subdivisions. In the USA these are *Los Angeles*, *Dallas* and *New York*, and in the EU it is *Western Europe* and *Eastern Europe*.

.. image:: /user/img/system/user_management/sales_structure.png

We now need to configure roles and access settings in such a way that the sales representatives could access only the data they own. Area sales managers must be able to access data of their subdivision (e.g. LA or NY), while the regional sales managers have access to data of all areas in their region. The sales director must be able to view all company data.

Step 1: Create Business Units
-----------------------------

The first step is to :ref:`create the corresponding business units <user-management-bu>`, which are the following:

* Main Office 
* USA
* EU
* Los Angeles
* Dallas
* New York
* Western Europe
* Eastern Europe

When creating business units, we need to specify parent business units. In this scenario, the *Main Office* does not have a parent business unit as it represents the business unit that has access to the whole organization. 

.. image:: /user/img/system/user_management/sales_bu_usa.png

The *Main Office* is the parent business unit for the *USA* and *EU* business units. The *USA* business unit is the parent unit for *Los Angeles, Dallas, New York*. The *EU* business unit is the parent unit for *Western Europe, Eastern Europe*.

.. image:: /user/img/system/user_management/sales_bu_la.png

Step 2: Create Roles and Apply Permissions 
------------------------------------------

Once we have created business units, we need to :ref:`create the following roles <user-guide-user-management-permissions-roles--actions>`:

* Sales rep with **User** access level:

  .. image:: /user/img/system/user_management/sales_role_rep.png

* Area sales manager with **Business Unit** access level:

  .. image:: /user/img/system/user_management/sales_role_asm.png

* Regional sales manager with the **Division** access level.

  .. image:: /user/img/system/user_management/sales_role_rsm.png

* Sales director with the **Organization** access level:
 
  .. image:: /user/img/system/user_management/sales_role_dir.png

These roles are created on the global level as they apply to both ACME organizations.

Step 3: Assign Roles to Users
-----------------------------

We now need to :ref:`assign four roles to users <user-management-users>` and define which business units the users must have access to.

1. **Sales Director**

   The sales director has the following settings: 

   * **Status** --- Active
   * **Roles** --- System-wide sales director role

     .. image:: /user/img/system/user_management/sales_user_sd_roles.png
 
   * **Organization** --- ACME Services

     .. image:: /user/img/system/user_management/sales_user_sd_organization.png

  As the sales director has permissions with **global** access level, there is no need to specify which business units the sales director must have access to. 

2. **Regional Sales Manager**

   The regional sales manager has the following settings: 

   * **Roles** --- Regional Sales Manager   
   * **Organization** --- ACME Services
   * **Organization Business Units** --- Either USA or EU
     
   Regional sales managers have permissions with **division** access level. 
   
   .. note:: A division is a business unit with the chain of its sub business units and their sub business units. We, therefore, need to specify only the top business unit in this chain.

3. **Area Sales Manager**

   Area sales managers have the following settings: 

   * **Roles** --- Area Sales Manager  
   * **Organization** --- ACME Services
   * **Organization Business Units** --- One of the lower level business units: Los Angeles, Dallas, New York, Western Europe, or Eastern Europe

4. **Sales Representatives**

   The sales representatives have the following settings:

   * **Roles** -- Sales Rep   
   * **Organization** --- ACME Services
   * **Organization Business Units** --- One of the lower level business units: Los Angeles, Dallas, New York, Western Europe, Eastern Europe    
    
For example, when Alan Wise, a sales representative in Los Angeles, creates an account, he can assign only himself as the owner of this account (the account belongs to him). He can see only his accounts, unless his managers share other accounts with him.

Nina Anders, who is a sales manager, can manage accounts created by sales representatives of her business unit and by herself:

.. image:: /user/img/system/user_management/sales_acc_nina.png

Samuel Lee, a USA regional sales manager, can see and manage accounts of Nina's business unit (for Los Angeles sales) and all other business units in USA.

.. image:: /user/img/system/user_management/sales_acc_sam.png

A sales director has access to all company accounts.
 
Work with Multiple Organizations
--------------------------------

The marketing department in AMCE handles campaigns for both ACME Manufacturing and ACME Services organizations.

Jill, who is a marketing team manager, monitors two organizations and is given access to both of them.

John and Jane in the marketing team have organization level permissions. John works with ACME Manufacturing and Jane works with ACME Services.

Each of these marketing managers creates two campaigns in |oro_application|:

.. image:: /user/img/system/user_management/multi.png

John and Jane can only log into the organization they work with, while Jill can log into both.

.. comment .. image:: /user/img/system/user_management/multi_login.png

Access to Multiple Business Units
----------------------------------

The ACME Manufacturing has the Business Development (BD) team in two geographically distributed business units, Los Angeles and New York.
 
We will look closer at Alex, Aaron, and Anna, who are business development representatives.

Alex is in the Los Angeles business unit and Anna is in the New York one.
  
Aaron manages both business units and he is granted access to Los Angeles and New York BUs.

Each of the team members creates a lead record in |oro_application|:

.. image:: /user/img/system/user_management/leads_structure.png

The diagrams below illustrate what information each of the team members can see:

.. image:: /user/img/system/user_management/leads_visibility_aaron.png

*Aaron has access to both LA and NY BUs and all their records.*

.. image:: /user/img/system/user_management/leads_visibility_alex.png

.. image:: /user/img/system/user_management/leads_visibility_anna.png


*Because Aaron has access to LA and NY BUs, the data he owns belongs to both of these BUs. That is why Alex and Anna can access Aaron's record.*


**Related Articles**

* :ref:`Blueprints of User Access Configuration <doc-user-management-users-access-examples>`
* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Field Level Permissions <user-guide-user-management-permissions-roles--field-level-acl>`
* :ref:`Entity and System Capabilities <admin-capabilities>`
* :ref:`Create and Manage Roles <user-guide-user-management-permissions-roles--actions>` 
* :ref:`Create Business Units <user-management-bu>`
* :ref:`Create and Manage Organizations <user-management-organizations>`
* :ref:`Work with Multiple Organizations <user-ee-multi-org>`



.. include:: /include/include_images.rst
   :start-after: begin

.. |oro_application| replace:: OroCommerce