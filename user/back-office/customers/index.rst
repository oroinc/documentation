:oro_documentation_types: OroCRM, OroCommerce

:title: Customers Management in the OroCommerce and OroCRM Back-Office

.. meta::
   :description: Extensive documentation on accounts, contacts, customers, customer groups, customer users, and user roles management for the OroCommerce and OroCRM back-office users


Customers
=========

In the applications where an integration between Commerce and CRM is configured, the Customer menu contains references to entities from both applications:

.. image:: /user/img/customers/accounts/customers_menu.png
    :alt: The entities under the customer menu

*Account* and *Contact* come from CRM, while *Customers* and *Customer Users* come from Commerce.

An account and a :ref:`customer <user-guide--customers>` represent a company or a division. A contact and a customer user represent a real person who acts on behalf of the company.

This has been implemented to track this hierarchy independently if CRM or Commerce are installed separately. When both are integrated, additional options to source and retrieve the data become available. You can use the modules separately; for example, if employees work with OroCRM, they can refer to accounts and contacts while those working with OroCommerce can work with Customers and Customer Users. In both cases, they have the ability to track information about companies and people.

Even though the information in Account, Contact, and Customer may seem similar, there is a significant difference that shows the advantage of using CRM and Commerce together.

An account aggregates data from all channels (CRM, Commerce, or others) and all sources (e.g., Contacts, Business Customers, Commerce Customers) providing a 360-degree view of all the information about the company. All interactions with a particular customer are displayed on a single page where you can also track sales though opportunities.

A contact is a CRM concept that is used to associate a person with a specific account. It contains a contact's personal information, their position in the company, address information, and other related data.

The main difference between a contact and a customer user is that a contact represents a person who may not use the Commerce segment (for example, the CEO of a company who does not buy anything personally).

Another important concept is a Customer. Out-of-the-box, OroCommerce supports three types of customers:

 * *OroCommerce Customers* (from Commerce package) are used to represent OroCommerce-specific data, such as Commerce Customers, Commerce Customer Users, Shopping Lists, RFQs, Quotes, Orders, and Opportunities.

 * *Business Customers* (from CRM package) are used to represent Business Customers who are not Commerce Customers and also CRM-specific data, such as B2B Customers, Contacts, Leads, Opportunities.

Additionally, you can associate :term:`Lifetime Sales Value` with a customer and track financial statistics related to a specific customer or account.

Below is an illustration of the account hierarchy where CRM-related concepts are marked grey, and Commerce-related concepts are marked white.

.. image:: /user/img/customers/accounts/account_customer_schema.png
   :width: 50%
   :alt: An illustration of the account hierarchy


.. toctree::
   :hidden:
   :titlesonly:
   :maxdepth: 1

   accounts/index
   contacts/index
   customers/index
   customer-groups/index
   customer-users/index
   customer-user-roles/index
   business-customers/index
