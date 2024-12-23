.. _concept-guide-customers:

Customer Management Concept Guide
=================================

The power of commerce is in building strong relationships between customers and businesses. One of the most crucial ingredients that helps improve this bond is the database of existing and potential customers that businesses use to communicate with them or address a required issue in a proper and timely manner. That is where Oro applications come in hand. Oro applications provide the ability to manage your customers from different perspectives, storing customers’ contact information, their entire purchase history, lifetime sales value, marketing activity, references to leads and opportunities in one easily accessible place. Having a single location for this aggregated information reduces the time spent on customer management.

To work with customers in Oro, you need to understand how Oro represents customers, which entities they include, how these entities differ and interconnect. You need to distinguish the main concepts of customers and customer users, customer groups and roles, accounts and contacts to ensure that the necessary information is displayed to the correct person. This also enables you to track information about companies and people and keep it up-to-date. In the sections below, we are going to explain it all in detail.

Customer Management Entities
----------------------------

In Oro applications, people and businesses are represented by the following entities:

* Customers
* Customer Users
* Customer Groups
* Accounts
* Contacts

These are located under **Customers** in the main menu of the application but the availability of these entities depends on the type of application you use and your role permissions.

.. image:: /user/img/concept-guides/customers/customers_menu.png
   :alt: Customers menu

:term:`Accounts <Account>` and :term:`customers <Customer>` are businesses, while :term:`contacts <Contact>` and :term:`customer users <Customer User>` are individuals who act on behalf of the company.

You can track information about companies and people within one application.

Specifics of Each Customer Entity
---------------------------------

Even though the information in Accounts, Contacts, and Customers may seem similar, there is a significant difference that shows the advantage of their usage.

An **account** aggregates data from all channels and all sources (e.g., Contacts, Business Customers, Commerce Customers) providing a 360-degree view of all the information about the company. All interactions with a particular customer are displayed on a single page where you can also track sales through opportunities.

A **contact** is used to associate a person with a specific account. It contains personal information of every contact, their position in the company, address information, and other related data.

The main difference between a **contact** and a **customer user** is that a contact represents a person who may not use the Commerce segment (for example, the CEO of a company who does not buy anything personally).

Customer Hierarchy
------------------

To manage the customers efficiently, study the following hierarchical structure and customer responsibility areas:

1. In OroCommerce, you work with several entities related to customer management: *Customers, Customer Users, Customer Groups, Customer User Roles*.
2. Remember that **customers** are businesses, while **customer users** are people who act on behalf of those businesses, the employees. For example, Company A is a customer, and Amanda Smith is a customer user.
3. Customers can be grouped into categories with parent-child relations.

   .. image:: /user/img/concept-guides/customers/customers_hierarchy.png
      :alt: Customers hierarchy
      :align: center

4. You can organize customers into **customer groups** regardless of the hierarchy but based on the common usage parameters, such as taxes, payment terms, price lists, location, and so on.

   .. image:: /user/img/concept-guides/customers/customer_groups.png
      :alt: Customer groups
      :align: center

5. You can associate :term:`Lifetime Sales Value` with a customer to track financial statistics related to a specific customer or account.

6. Each **customer user** has their own personal information and must be assigned to the required customer.

7. Users may be assigned a **customer role** (administrator, buyer, guest, etc) and **access levels** subject to the job a user is responsible for (*Corporate, Department, User* or *None*).

8. **Customer user roles** are customer-specific which means that different customers can be assigned the same role but with different capabilities and permissions, like in the example below:

   .. image:: /user/img/concept-guides/customers/customer_user_roles.png
      :alt: Customer user roles
      :align: center

**Related Topics**

* :ref:`Accounts <user-guide-accounts>`
* :ref:`Contacts <user-guide-contacts>`
* :ref:`Customers <user-guide--customers>`
* :ref:`Customer Users <user-guide--customers--customer-users>`
* :ref:`Customer Groups <user-guide--customer-groups>`
* :ref:`Customer User Roles <user-guide--customers--customer-user-roles>`



